#!/usr/bin/env bash
# Restores CMS-managed text (page banners/cards) on an existing HMS deployment.
# Usage: bash fix-page-content.sh /path/to/healix-hms
set -euo pipefail

APP_DIR="${1:-/var/www/html}"

if [ ! -f "$APP_DIR/artisan" ]; then
    echo "No artisan file in $APP_DIR - pass the correct app directory as the first argument." >&2
    exit 1
fi

cd "$APP_DIR"

echo "Seeding page content..."
php artisan db:seed --class=PageContentSeeder --force

echo "Verifying..."
php artisan tinker --execute="echo App\\Models\\PageCard::count().' cards, '.App\\Models\\PageBanner::count().' banners'.PHP_EOL;"

echo "Done. Reload the homepage in your browser."
