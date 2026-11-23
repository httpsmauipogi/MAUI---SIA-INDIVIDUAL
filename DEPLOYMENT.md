# Deploying Healix HMS to AWS (single EC2 + S3)

This guide deploys the Laravel app to **one EC2 instance** at your existing Elastic IP
`http://13.236.57.159`, with MySQL in Docker on that instance and uploads stored in S3.

```
Internet --HTTP:80--> Elastic IP 13.236.57.159 --> EC2 (Ubuntu)
                                                   ├── Docker: nginx + PHP-FPM (app)
                                                   ├── Docker: MySQL 8 (EBS volume)
                                                   └── IAM role --> S3 bucket (uploads)
```

> The AWS CLI is not installed in this workspace. Run the AWS CLI commands below from
> your own machine (or use AWS CloudShell in the console). SSH/`docker` commands run on
> the EC2 instance.

## What changed in the application

- `Dockerfile`, `docker/`, `docker-compose.yml`, `.dockerignore` – container build/runtime.
- `.env.production.example` – production environment template pre-filled with your IP.
- `app/helpers.php` – new `storage_url()` helper so uploaded images resolve to S3 URLs.
- 19 views/models switched from `asset('storage/…')` to `storage_url(…)`.
- `league/flysystem-aws-s3-v3` added via Composer.
- `config/filesystems.php` – `public` disk can be S3-backed; new `private` disk.
- Lab reports now go to the private disk and are served by an authenticated route
  (`GET /lab-results/{labOrder}`), never from a public S3 URL.

---

## 0. Quick fix: missing text on the current (older) deployment

If the live site at `http://13.236.57.159` shows images, animations and fixed headings but
the CMS-managed text is blank (welcome text, statistics, service cards, opening hours,
testimonials, blog posts, CTA banner), the `page_cards` / `page_banners` tables are empty.

On the **current** server (after backing up its database), run:

```bash
cd /path/to/current/healix-hms
php artisan db:seed --class=PageContentSeeder --force
php artisan tinker --execute="echo App\Models\PageCard::count().' cards, '.App\Models\PageBanner::count().' banners'.PHP_EOL;"
```

Or copy `scripts/fix-page-content.sh` from this repo to the server and run:

```bash
bash fix-page-content.sh /path/to/current/healix-hms
```

Reload the homepage — the missing text should appear. Doctors, blog posts and site
settings are separate data and are added from the admin panel (or their own seeders).
The full deployment in this guide runs the same seeder, so the new deployment will not
have this problem.

> Do not replace the old instance until you know whether its database contains real
> patient/appointment data — see section 5a below.

---

## 1. Commit and push the deployment changes

```bash
cd healix-hms
git add -A
git commit -m "Add AWS EC2 deployment with S3 uploads"
git push origin main
```

(`.env` is gitignored; `.env.production.example` is committed.)

---

## 2. Create the S3 bucket for uploads

Replace `BUCKET` with a globally unique name, e.g. `healix-hms-uploads-87284509958`
(use your AWS account ID). Use the same region as your EC2 instance — examples use
`us-east-1`.

```bash
export BUCKET=healix-hms-uploads-87284509958
aws s3 mb s3://$BUCKET --region us-east-1

# Allow ACLs: Laravel's S3 adapter sends an ACL header with each upload.
aws s3 put-bucket-ownership-controls \
  --bucket "$BUCKET" \
  --ownership-controls 'Rules=[{ObjectOwnership=BucketOwnerPreferred}]'

# Since images are public, allow public reads but explicitly deny the private/ prefix.
cat > bucket-policy.json <<EOF
{
  "Version": "2012-10-17",
  "Statement": [
    {
      "Sid": "PublicReadForImages",
      "Effect": "Allow",
      "Principal": "*",
      "Action": "s3:GetObject",
      "Resource": "arn:aws:s3:::$BUCKET/*"
    },
    {
      "Sid": "DenyPublicReadForLabResults",
      "Effect": "Deny",
      "Principal": "*",
      "Action": "s3:GetObject",
      "Resource": "arn:aws:s3:::$BUCKET/private/*"
    }
  ]
}
EOF
aws s3api put-bucket-policy --bucket "$BUCKET" --policy file://bucket-policy.json
aws s3api put-public-access-block --bucket "$BUCKET" \
  --public-access-block-configuration \
  BlockPublicAcls=false,IgnorePublicAcls=false,BlockPublicPolicy=false,RestrictPublicBuckets=false
```

> **Privacy note:** only public images (logos, banners, avatars, doctor photos) may live
> outside `private/`. Lab reports are stored under `private/` and the explicit deny above
> makes them inaccessible even if someone guesses the S3 URL. For a stricter setup, use a
> CloudFront distribution with OAC and keep the bucket entirely private.

---

## 3. Create the IAM role for the EC2 instance

This lets the app write to S3 **without storing AWS access keys in `.env`**.

```bash
cat > healix-s3-policy.json <<EOF
{
  "Version": "2012-10-17",
  "Statement": [
    {
      "Effect": "Allow",
      "Action": "s3:ListBucket",
      "Resource": "arn:aws:s3:::$BUCKET"
    },
    {
      "Effect": "Allow",
      "Action": ["s3:GetObject", "s3:PutObject", "s3:DeleteObject"],
      "Resource": "arn:aws:s3:::$BUCKET/*"
    }
  ]
}
EOF
aws iam create-policy --policy-name HealixS3Access \
  --policy-document file://healix-s3-policy.json

cat > ec2-trust.json <<'EOF'
{
  "Version": "2012-10-17",
  "Statement": [{
    "Effect": "Allow",
    "Principal": {"Service": "ec2.amazonaws.com"},
    "Action": "sts:AssumeRole"
  }]
}
EOF
aws iam create-role --role-name HealixEC2Role \
  --assume-role-policy-document file://ec2-trust.json
aws iam attach-role-policy --role-name HealixEC2Role \
  --policy-arn "arn:aws:iam::$(aws sts get-caller-identity --query Account --output text):policy/HealixS3Access"
aws iam create-instance-profile --instance-profile-name HealixEC2Profile
aws iam add-role-to-instance-profile \
  --instance-profile-name HealixEC2Profile --role-name HealixEC2Role
```

In the EC2 console: select your instance → **Actions → Security → Modify IAM role** →
choose `HealixEC2Role`.

---

## 4. Prepare the EC2 instance

1. Confirm the Elastic IP `13.236.57.159` is associated with this instance
   (**Elastic IPs → Associate address**).
2. Security group inbound rules:
   - **HTTP, TCP 80, Source `0.0.0.0/0`**
   - **SSH, TCP 22, Source: your own IP only** (never `0.0.0.0/0`)
3. Recommended instance: Ubuntu 24.04 LTS, `t3.small` or larger, 20 GB+ EBS.
4. Attach the `HealixEC2Role` IAM instance profile (above).

SSH in, then install Docker:

```bash
sudo apt-get update
sudo apt-get install -y ca-certificates curl git
sudo install -m 0755 -d /etc/apt/keyrings
curl -fsSL https://download.docker.com/linux/ubuntu/gpg \
  | sudo gpg --dearmor -o /etc/apt/keyrings/docker.gpg
sudo chmod a+r /etc/apt/keyrings/docker.gpg
echo "deb [arch=$(dpkg --print-architecture) signed-by=/etc/apt/keyrings/docker.gpg] \
https://download.docker.com/linux/ubuntu $(. /etc/os-release && echo $VERSION_CODENAME) stable" \
  | sudo tee /etc/apt/sources.list.d/docker.list > /dev/null
sudo apt-get update
sudo apt-get install -y docker-ce docker-ce-cli containerd.io docker-buildx-plugin docker-compose-plugin
sudo usermod -aG docker ubuntu
exit
```

Reconnect via SSH so the `docker` group takes effect.

---

## 4a. Decide what to do with the old deployment's data

The Docker setup creates a **new, empty MySQL database**. If the site currently at the
EIP has real records (patients, appointments, invoices, users), do not discard it:

**MySQL → MySQL (your case).** On the old server, dump the database:

```bash
# If MySQL runs natively:
mysqldump -u <old_db_user> -p --single-transaction --routines --triggers <old_db_name> > old-healix.sql

# If the old app runs MySQL in Docker, use its container name instead:
docker exec <old_mysql_container> sh -c 'mysqldump -u"$MYSQL_USER" -p"$MYSQL_PASSWORD" "$MYSQL_DATABASE"' > old-healix.sql
```

Copy it to the new instance and import it into the fresh `db` container **before**
starting the app against it:

```bash
scp old-healix.sql ubuntu@13.236.57.159:/srv/healix-hms/
cd /srv/healix-hms
docker compose up -d db
docker compose exec -T db sh -c 'mysql -u root -p"$MYSQL_ROOT_PASSWORD" "$MYSQL_DATABASE"' < old-healix.sql
```

Then continue with `docker compose up -d --build`, `php artisan migrate --force` and the
seeders in section 5. `migrate` applies only the migrations the old database hasn't run.

- If the old app uses SQLite (`database/database.sqlite`), copy that file to the new
  instance and use a conversion/import step before switching `DB_CONNECTION` to MySQL,
  or keep SQLite temporarily (set `DB_CONNECTION=sqlite` and mount the file into the
  container). Ask me for the exact conversion commands if you have data to keep.

**Reuse the old `APP_KEY`.** Copy the `APP_KEY=base64:…` line from the old server's `.env`
into the new `.env`. Generating a new key makes existing encrypted values, remembered
sessions and password-reset tokens unreadable. The step in section 5 that generates a key
is only for a clean install.

**Copy existing uploads too.** Old files under `storage/app/public` must be synced to the
new S3 bucket (section 6), otherwise logos, doctor photos and banners stored in the
database will point to missing objects.
- If the old site only contains demo/test data, start clean and run the seeders as
  described below.

Also note port 80 is already occupied by the old web server — stop it before starting
the new containers, otherwise `docker compose up` will fail to bind the port.

---

## 5. Deploy the application

```bash
sudo mkdir -p /srv/healix-hms && sudo chown ubuntu:ubuntu /srv/healix-hms
cd /srv/healix-hms
git clone https://github.com/<your-username>/healix-hms.git .
cp .env.production.example .env
```

Edit `.env` (`nano .env`) and set:

| Variable | Value |
| --- | --- |
| `APP_URL` | `http://13.236.57.159` (already set) |
| `AWS_BUCKET` | your bucket name |
| `AWS_DEFAULT_REGION` | bucket region, e.g. `us-east-1` |
| `AWS_URL`, `PUBLIC_DISK_URL` | `https://<bucket>.s3.<region>.amazonaws.com` |
| `DB_PASSWORD`, `DB_ROOT_PASSWORD` | long random passwords |
| `MAIL_FROM_ADDRESS` | your sender address |

Set the app key:

```bash
# Clean install only - generate a new key:
echo "APP_KEY=base64:$(openssl rand -base64 32)"
# replace the empty APP_KEY= line in .env with the output
```

If you are preserving the old database, **do not run the command above** — copy the
existing `APP_KEY` from the old `.env` instead (see section 4a).

Build and start the containers:

```bash
docker compose up -d --build
docker compose ps          # wait until app is healthy
curl -i http://13.236.57.159/up   # expect: OK
```

Run migrations and the required seeders:

```bash
docker compose exec app php artisan migrate --force
docker compose exec app php artisan db:seed --class=RoleSeeder --force
docker compose exec app php artisan db:seed --class=SuperAdminSeeder --force
docker compose exec app php artisan db:seed --class=PageContentSeeder --force
docker compose exec app php artisan db:seed --class=BranchSeeder --force
```

The seeded super admin is `admin@healix.com` with password `password` — **change it
immediately**:

```bash
docker compose exec app php artisan tinker --execute="App\Models\User::where('email','admin@healix.com')->first()->update(['password' => Illuminate\Support\Facades\Hash::make('YOUR_NEW_PASSWORD')]);"
```

Cache configuration for performance:

```bash
docker compose exec app php artisan config:cache
docker compose exec app php artisan view:cache
```

> Do **not** run `route:cache`: `routes/web.php` contains a closure, which Laravel cannot
> serialize. After any code change, run `docker compose restart app` (OPcache has
> timestamp validation disabled).

---

## 6. Move any existing uploads to S3 (skip for a fresh install)

Run this on the machine that has your current `storage/app/public` files, with AWS CLI
configured:

```bash
export BUCKET=healix-hms-uploads-87284509958
aws s3 cp storage/app/public/ s3://$BUCKET/ --recursive
aws s3 cp storage/app/public/lab-results/ s3://$BUCKET/private/lab-results/ --recursive
```

Both commands use the same relative keys the app stores in the database, so existing
records keep working. The old local `lab-results/` copies are no longer referenced.

---

## 7. Verify

1. `http://13.236.57.159/` – homepage loads with images and CSS.
2. Log in as `admin@healix.com` with your new password.
3. Upload a logo/doctor photo in the admin panel → view page source: the `src` should be
   an `https://<bucket>.s3...` URL that opens publicly.
4. Upload a lab report on a lab order → the "View uploaded file" link points to
   `/lab-results/{id}` and works while logged in; opening the raw `s3://…/private/…`
   object URL directly returns **403**.
5. `http://13.236.57.159/up` returns **OK**.

---

## 8. Day-to-day operations

**Logs**

```bash
docker compose logs -f app       # nginx + PHP-FPM + Laravel
docker compose logs -f db
```

**Backups** (store dumps in the private prefix of the same bucket)

```bash
cd /srv/healix-hms
docker compose exec db sh -c 'mysqldump -u"$MYSQL_USER" -p"$MYSQL_PASSWORD" "$MYSQL_DATABASE"' \
  > backup-$(date +%F).sql
aws s3 cp backup-$(date +%F).sql s3://$BUCKET/private/backups/
```

**Application updates**

```bash
cd /srv/healix-hms
git pull
docker compose up -d --build
docker compose exec app php artisan migrate --force
docker compose exec app php artisan config:clear && docker compose exec app php artisan config:cache
docker compose restart app
```

**Security / scaling notes**

- Keep SSH restricted to your IP. The app is intentionally HTTP-only for now; to add
  HTTPS later, point a domain at the EIP and put an ALB + ACM certificate (or Caddy with
  Let's Encrypt) in front of port 80.
- MySQL data lives in the Docker named volume `db_data` on the EBS volume. For stronger
  durability, migrate to RDS MySQL Multi-AZ and set `DB_HOST` to the RDS endpoint.
- If you replace the instance, re-associate the EIP, re-attach `HealixEC2Role`, restore
  the DB dump, and re-create the containers. S3 files are preserved independently.

---

## Troubleshooting

| Symptom | What to check |
| --- | --- |
| `502 Bad Gateway` | `docker compose logs app` – PHP-FPM crash; usually missing PHP extension or bad `.env`. |
| `SQLSTATE[HY000] [2002]` | `DB_HOST=db`, DB credentials match `MYSQL_*` values; `docker compose ps` shows db healthy. |
| Images show broken links | `PUBLIC_DISK_URL` must be the bucket base URL (no trailing `/path`); bucket policy must allow public `GetObject`. |
| `AccessDenied` on upload | IAM role attached to instance; `AWS_BUCKET`/region correct; bucket ACLs enabled (BucketOwnerPreferred). |
| Lab result link 404 | File must be under `private/lab-results/` in the bucket; run the `aws s3 cp ... private/lab-results/` command above. |
| Changes not visible after deploy | `docker compose restart app` (OPcache), then `php artisan config:clear && php artisan view:clear`. |
