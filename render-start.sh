#!/bin/bash

echo "🚀 Starting Geeta Portfolio on Render..."

# Wait for database to be ready
sleep 2

# Generate APP_KEY if not set
if [ -z "$APP_KEY" ]; then
    echo "🔑 Generating APP_KEY..."
    export APP_KEY=$(php artisan key:generate --show)
fi

# Create .env file
cat > .env << EOF
APP_NAME="Geeta Portfolio"
APP_ENV=production
APP_KEY=${APP_KEY}
APP_DEBUG=false
APP_URL=${RENDER_EXTERNAL_URL:-http://localhost:10000}

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=sqlite
DB_DATABASE=/var/www/html/database/database.sqlite

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=${MAIL_MAILER:-smtp}
MAIL_HOST=${MAIL_HOST:-smtp.gmail.com}
MAIL_PORT=${MAIL_PORT:-587}
MAIL_USERNAME=${MAIL_USERNAME}
MAIL_PASSWORD=${MAIL_PASSWORD}
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=${MAIL_FROM_ADDRESS:-noreply@example.com}
MAIL_FROM_NAME="${MAIL_FROM_NAME:-Geeta Portfolio}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_HOST=
PUSHER_PORT=443
PUSHER_SCHEME=https
PUSHER_APP_CLUSTER=mt1

VITE_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
VITE_PUSHER_HOST="${PUSHER_HOST}"
VITE_PUSHER_PORT="${PUSHER_PORT}"
VITE_PUSHER_SCHEME="${PUSHER_SCHEME}"
VITE_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

ADMIN_EMAIL=${ADMIN_EMAIL:-admin@example.com}
ADMIN_PASSWORD=${ADMIN_PASSWORD:-password}
EOF

echo "📝 Environment file created"

# Clear and cache config
php artisan config:clear
php artisan config:cache

# Run migrations
echo "🗄️ Running database migrations..."
php artisan migrate --force

# Create admin user if it doesn't exist
echo "👤 Creating admin user..."
php artisan tinker --execute="
if (!\App\Models\User::where('email', env('ADMIN_EMAIL'))->exists()) {
    \App\Models\User::create([
        'name' => 'Admin',
        'email' => env('ADMIN_EMAIL'),
        'password' => bcrypt(env('ADMIN_PASSWORD')),
        'email_verified_at' => now()
    ]);
    echo 'Admin user created successfully';
} else {
    echo 'Admin user already exists';
}
"

# Create storage link
echo "🔗 Creating storage link..."
php artisan storage:link

# Set final permissions
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

echo "✅ Laravel application ready!"
echo "🌐 Starting Apache server on port 10000..."

# Start Apache in foreground
apache2-foreground
