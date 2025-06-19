#!/bin/bash
set -e

echo "🚀 Starting Laravel build for Netlify..."

# Create required directories
mkdir -p bootstrap/cache
mkdir -p storage/framework/{cache,sessions,views}
mkdir -p storage/logs
mkdir -p database

# Set permissions
chmod -R 755 bootstrap/cache
chmod -R 755 storage

# Create database
touch database/database.sqlite

# Install dependencies
composer install --no-dev --optimize-autoloader --no-interaction

# Create .env
cat > .env << ENVEOF
APP_NAME="Geeta Portfolio"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://luminous-ganache-99f18e.netlify.app

DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite

ADMIN_EMAIL=geetskuikel@gmail.com
ADMIN_PASSWORD=12345678
ENVEOF

# Generate key
php artisan key:generate --force

# Run migrations
php artisan migrate --force

echo "✅ Build complete!"
