#!/bin/bash

echo "🎨 Starting Geeta's Portfolio on Render..."

# Update Apache to listen on port 10000 (Render requirement)
echo "Listen 10000" >> /etc/apache2/ports.conf

# Set environment variables with defaults
export APP_ENV=${APP_ENV:-production}
export APP_DEBUG=${APP_DEBUG:-false}
export DB_CONNECTION=${DB_CONNECTION:-sqlite}
export DB_DATABASE=${DB_DATABASE:-/var/www/html/database/database.sqlite}

# Ensure database and directories exist
mkdir -p /var/www/html/database
mkdir -p /var/www/html/bootstrap/cache
mkdir -p /var/www/html/storage/framework/{cache,sessions,views}
mkdir -p /var/www/html/storage/logs

touch /var/www/html/database/database.sqlite
chmod 666 /var/www/html/database/database.sqlite
chmod -R 777 /var/www/html/storage
chmod -R 777 /var/www/html/bootstrap/cache

# Generate APP_KEY if not set
if [ -z "$APP_KEY" ]; then
    echo "🔑 Generating APP_KEY..."
    php artisan key:generate --force
fi

# Clear caches
echo "🧹 Clearing caches..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Run migrations
echo "📊 Running database migrations..."
php artisan migrate --force

# Create admin user
echo "👤 Creating admin user..."
php artisan tinker --execute="
try {
    if (!\App\Models\User::where('email', '${ADMIN_EMAIL:-geetskuikel@gmail.com}')->exists()) {
        \App\Models\User::create([
            'name' => 'Geeta Admin',
            'email' => '${ADMIN_EMAIL:-geetskuikel@gmail.com}',
            'password' => bcrypt('${ADMIN_PASSWORD:-SecureAdminPassword123!}'),
            'email_verified_at' => now(),
        ]);
        echo 'Admin user created: ${ADMIN_EMAIL:-geetskuikel@gmail.com}';
    } else {
        echo 'Admin user already exists';
    }
} catch (Exception \$e) {
    echo 'Error creating admin user: ' . \$e->getMessage();
}
"

# Cache for production
echo "⚡ Caching for production..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "✅ Portfolio setup complete!"
echo "🌐 Starting Apache on port 10000..."

# Start Apache
apache2-foreground
