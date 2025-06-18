#!/bin/bash

echo "🎨 Starting Render Laravel Application..."

# Set environment variables with defaults
export APP_ENV=${APP_ENV:-production}
export APP_DEBUG=${APP_DEBUG:-false}
export DB_CONNECTION=${DB_CONNECTION:-sqlite}
export DB_DATABASE=${DB_DATABASE:-/var/www/html/database/database.sqlite}

# Ensure database directory exists and has correct permissions
mkdir -p /var/www/html/database
touch /var/www/html/database/database.sqlite
chown www-data:www-data /var/www/html/database/database.sqlite
chmod 664 /var/www/html/database/database.sqlite

# Generate APP_KEY if not set
if [ -z "$APP_KEY" ]; then
    echo "🔑 Generating APP_KEY..."
    php artisan key:generate --force
fi

# Clear and cache config
echo "🔧 Setting up Laravel..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear

# Run migrations
echo "📊 Running database migrations..."
php artisan migrate --force

# Create admin user if it doesn't exist
echo "👤 Setting up admin user..."
php artisan tinker --execute="
try {
    if (!\App\Models\User::where('email', '${ADMIN_EMAIL:-geetskuikel@gmail.com}')->exists()) {
        \App\Models\User::create([
            'name' => 'Admin',
            'email' => '${ADMIN_EMAIL:-geetskuikel@gmail.com}',
            'password' => bcrypt('${ADMIN_PASSWORD:-SecureAdminPassword123}'),
            'email_verified_at' => now(),
        ]);
        echo 'Admin user created successfully';
    } else {
        echo 'Admin user already exists';
    }
} catch (Exception \$e) {
    echo 'Error creating admin user: ' . \$e->getMessage();
}
"

# Cache config for production
php artisan config:cache
php artisan route:cache

echo "✅ Laravel setup complete!"
echo "🌐 Starting Apache..."

# Start Apache
exec apache2-foreground
