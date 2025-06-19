#!/bin/bash

echo "🚀 Building Geeta Portfolio for Netlify..."

# Create required Laravel directories BEFORE composer install
echo "📁 Creating Laravel directories..."
mkdir -p bootstrap/cache
mkdir -p storage/framework/{cache,sessions,views}
mkdir -p storage/logs
mkdir -p database
mkdir -p public/storage

# Set permissions
chmod -R 755 bootstrap/cache
chmod -R 755 storage

# Create SQLite database
touch database/database.sqlite
chmod 666 database/database.sqlite

echo "📦 Installing Composer dependencies..."
composer install --no-dev --optimize-autoloader --no-interaction

# Generate APP_KEY
echo "🔑 Generating application key..."
php artisan key:generate --force

# Create .env file for build
cat > .env << EOF
APP_NAME="Geeta Portfolio"
APP_ENV=production
APP_KEY=$(php artisan key:generate --show)
APP_DEBUG=false
APP_URL=https://geeta-portfolio.netlify.app

DB_CONNECTION=sqlite
DB_DATABASE=/opt/build/repo/database/database.sqlite

ADMIN_EMAIL=${ADMIN_EMAIL}
ADMIN_PASSWORD=${ADMIN_PASSWORD}
EOF

# Clear and cache config
echo "⚙️ Configuring Laravel..."
php artisan config:clear
php artisan config:cache

# Run migrations
echo "🗄️ Running migrations..."
php artisan migrate --force

# Create admin user
echo "👤 Creating admin user..."
php artisan tinker --execute="
if (!\App\Models\User::where('email', '${ADMIN_EMAIL}')->exists()) {
    \App\Models\User::create([
        'name' => 'Admin',
        'email' => '${ADMIN_EMAIL}',
        'password' => bcrypt('${ADMIN_PASSWORD}'),
        'email_verified_at' => now()
    ]);
    echo 'Admin user created';
}
"

# Cache routes and views
echo "⚡ Caching for production..."
php artisan route:cache
php artisan view:cache

# Create storage link
php artisan storage:link

echo "✅ Build complete!"
