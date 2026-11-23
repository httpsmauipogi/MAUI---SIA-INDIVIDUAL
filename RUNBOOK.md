# Healix HMS — AWS EC2 cutover runbook

Target: `http://13.236.57.159` · AWS account `87284509958` · region `us-east-1`

**Fill these in before starting** (keep passwords out of chat):

| Placeholder | Meaning | Your value |
| --- | --- | --- |
| `REPO_URL` | Git clone URL for this repo | ______________________ |
| `OLD_APP_DIR` | Current app directory on the server (e.g. `/var/www/html`) | ______________________ |
| `OLD_DB` | Current MySQL database name | ______________________ |
| `OLD_DB_USER` | Current MySQL username | ______________________ |
| `OLD_MYSQL_CONTAINER` | Only if old MySQL runs in Docker; otherwise ignore | ______________________ |

Set them once in your shell on the server:

```bash
export OLD_APP_DIR=/var/www/html
export OLD_DB=healix
export OLD_DB_USER=healix
export REPO_URL=https://github.com/YOUR_USER/healix-hms.git
```

Estimated time: 30–45 minutes.

---

## A. On your computer — publish the code

```bash
cd healix-hms
git add -A
git commit -m "Add AWS EC2 deployment with S3 uploads"
git push origin main
```

---

## B. On the current server — save data BEFORE anything is stopped

### B1. Restore the missing text in the old database

```bash
cd "$OLD_APP_DIR"
php artisan db:seed --class=PageContentSeeder --force
```

Reload `http://13.236.57.159/` — the blank text sections should now be filled.

### B2. Save the old APP_KEY and dump the database

```bash
grep '^APP_KEY=' "$OLD_APP_DIR/.env"          # copy this value; you'll paste it into the new .env

# If MySQL runs natively:
mysqldump -u "$OLD_DB_USER" -p --single-transaction --routines --triggers "$OLD_DB" > /root/old-healix.sql

# If MySQL runs in Docker instead, use this line:
# docker exec OLD_MYSQL_CONTAINER sh -c 'mysqldump -u"$MYSQL_USER" -p"$MYSQL_PASSWORD" "$MYSQL_DATABASE"' > /root/old-healix.sql
```

### B3. Copy existing uploads to S3 (run after section C creates the bucket)

```bash
export BUCKET=healix-hms-uploads-87284509958
# Exclude lab reports from the public sync (the bucket policy only protects /private/*).
aws s3 sync "$OLD_APP_DIR/storage/app/public/" "s3://$BUCKET/" --region us-east-1 --exclude "lab-results/*"
aws s3 sync "$OLD_APP_DIR/storage/app/public/lab-results/" "s3://$BUCKET/private/lab-results/" --region us-east-1
```

If the server has no AWS CLI configured, run these two lines from your computer after
copying the `storage/app/public` folder locally. Skip if there are no uploads yet.

---

## C. AWS setup (console or AWS CLI from your computer)

```bash
export BUCKET=healix-hms-uploads-87284509958
export ACCOUNT=87284509958

aws s3 mb s3://$BUCKET --region us-east-1
aws s3 put-bucket-ownership-controls --bucket "$BUCKET" \
  --ownership-controls 'Rules=[{ObjectOwnership=BucketOwnerPreferred}]'

cat > /tmp/bucket-policy.json <<EOF
{
  "Version": "2012-10-17",
  "Statement": [
    {"Sid":"PublicReadForImages","Effect":"Allow","Principal":"*","Action":"s3:GetObject","Resource":"arn:aws:s3:::$BUCKET/*"},
    {"Sid":"DenyPublicReadForLabResults","Effect":"Deny","Principal":"*","Action":"s3:GetObject","Resource":"arn:aws:s3:::$BUCKET/private/*"}
  ]
}
EOF
aws s3api put-bucket-policy --bucket "$BUCKET" --policy file:///tmp/bucket-policy.json
aws s3api put-public-access-block --bucket "$BUCKET" \
  --public-access-block-configuration \
  BlockPublicAcls=false,IgnorePublicAcls=false,BlockPublicPolicy=false,RestrictPublicBuckets=false

cat > /tmp/s3-policy.json <<EOF
{
  "Version": "2012-10-17",
  "Statement": [
    {"Effect":"Allow","Action":"s3:ListBucket","Resource":"arn:aws:s3:::$BUCKET"},
    {"Effect":"Allow","Action":["s3:GetObject","s3:PutObject","s3:DeleteObject"],"Resource":"arn:aws:s3:::$BUCKET/*"}
  ]
}
EOF
aws iam create-policy --policy-name HealixS3Access --policy-document file:///tmp/s3-policy.json

cat > /tmp/ec2-trust.json <<'EOF'
{"Version":"2012-10-17","Statement":[{"Effect":"Allow","Principal":{"Service":"ec2.amazonaws.com"},"Action":"sts:AssumeRole"}]}
EOF
aws iam create-role --role-name HealixEC2Role --assume-role-policy-document file:///tmp/ec2-trust.json
aws iam attach-role-policy --role-name HealixEC2Role \
  --policy-arn "arn:aws:iam::$ACCOUNT:policy/HealixS3Access"
aws iam create-instance-profile --instance-profile-name HealixEC2Profile
aws iam add-role-to-instance-profile --instance-profile-name HealixEC2Profile --role-name HealixEC2Role
```

In the EC2 console: instance → **Actions → Security → Modify IAM role** → `HealixEC2Role`.
Security group: port 80 from `0.0.0.0/0`, port 22 from your IP only.

---

## D. On the server — free port 80 and install Docker

```bash
# Stop the old web server but leave the old MySQL running (we need the dump already saved).
sudo systemctl stop nginx 2>/dev/null || true
sudo systemctl stop apache2 2>/dev/null || true
docker ps --format '{{.Names}}' | grep -i -E 'nginx|web|app' | xargs -r docker stop

# Install Docker (Ubuntu):
sudo apt-get update
sudo apt-get install -y ca-certificates curl git
sudo install -m 0755 -d /etc/apt/keyrings
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo gpg --dearmor -o /etc/apt/keyrings/docker.gpg
sudo chmod a+r /etc/apt/keyrings/docker.gpg
echo "deb [arch=$(dpkg --print-architecture) signed-by=/etc/apt/keyrings/docker.gpg] https://download.docker.com/linux/ubuntu $(. /etc/os-release && echo $VERSION_CODENAME) stable" | sudo tee /etc/apt/sources.list.d/docker.list > /dev/null
sudo apt-get update
sudo apt-get install -y docker-ce docker-ce-cli containerd.io docker-buildx-plugin docker-compose-plugin
sudo usermod -aG docker ubuntu
```

**Log out and SSH back in** so the `docker` group takes effect.

---

## E. Deploy the new stack

```bash
sudo mkdir -p /srv/healix-hms && sudo chown ubuntu:ubuntu /srv/healix-hms
cd /srv/healix-hms
git clone "$REPO_URL" .
cp .env.production.example .env
nano .env
```

In `.env`, set:
- `APP_KEY` = the value you copied in B2 (**do not generate a new one**)
- `DB_DATABASE` = `$OLD_DB`
- `DB_PASSWORD`, `DB_ROOT_PASSWORD` = your chosen strong passwords
- confirm `AWS_BUCKET=healix-hms-uploads-87284509958`, `APP_URL=http://13.236.57.159`

```bash
# Start only MySQL, then import the dump:
docker compose up -d db
docker compose exec -T db sh -c 'mysql -u root -p"$MYSQL_ROOT_PASSWORD" "$MYSQL_DATABASE"' < /root/old-healix.sql

# Build and start the app:
docker compose up -d --build

# Apply newer migrations, restore CMS text, and make sure caches are fresh:
docker compose exec app php artisan migrate --force
docker compose exec app php artisan db:seed --class=PageContentSeeder --force
docker compose exec app php artisan db:seed --class=RoleSeeder --force
docker compose exec app php artisan cache:clear
docker compose exec app php artisan config:clear && docker compose exec app php artisan config:cache
docker compose exec app php artisan view:cache
```

Change the seeded admin password:

```bash
docker compose exec app php artisan tinker --execute="App\Models\User::where('email','admin@healix.com')->first()->update(['password' => Illuminate\Support\Facades\Hash::make('YOUR_NEW_PASSWORD')]);"
```

---

## F. Verify

```bash
docker compose ps                                # app + db healthy
curl -s -o /dev/null -w '%{http_code}\n' http://13.236.57.159/up          # 200
curl -s http://13.236.57.159/ | grep -c 'Complete Medical Solutions'      # 1
```

Also open the site in a browser, log in as `admin@healix.com`, upload an image, and
confirm the `src` URL points to the S3 bucket. A raw `s3://.../private/...` lab report URL
must return **403**.

**Rollback if needed:** stop the new stack (`docker compose down`) and restart the old
web server (`sudo systemctl start nginx` or your old container). The MySQL dump at
`/root/old-healix.sql` is untouched.

Full details and troubleshooting: `DEPLOYMENT.md`.
