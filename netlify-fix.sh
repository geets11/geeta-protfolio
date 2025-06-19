#!/bin/bash

echo "🔧 Fixing Netlify deployment issues..."

# Remove any problematic files
rm -f netlify-build.sh
rm -f netlify-deploy.sh

# Create a simple, working netlify.toml
cat > netlify.toml << 'EOF'
[build]
  command = "php -v && composer install --no-dev --optimize-autoloader && php artisan key:generate --force && php artisan config:cache"
  publish = "public"

[build.environment]
  PHP_VERSION = "8.2"

[[redirects]]
  from = "/*"
  to = "/index.php"
  status = 200
EOF

# Create a simple build script
cat > build.sh << 'EOF'
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
EOF

chmod +x build.sh

# Update netlify.toml to use the simple build script
cat > netlify.toml << 'EOF'
[build]
  command = "./build.sh"
  publish = "public"

[build.environment]
  PHP_VERSION = "8.2"

[[redirects]]
  from = "/*"
  to = "/index.php"
  status = 200
EOF

echo "✅ Netlify configuration fixed!"
echo "📝 Committing changes..."

git add .
git commit -m "Fix Netlify deployment configuration"
git push origin main

echo "🚀 Ready for Netlify deployment!"
echo "Go to your Netlify dashboard and trigger a new deploy."
