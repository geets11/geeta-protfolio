#!/bin/bash

echo "🔧 Fixing Render Dockerfile issue..."

# Rename Dockerfile.render to Dockerfile
if [ -f "Dockerfile.render" ]; then
    mv Dockerfile.render Dockerfile
    echo "✅ Renamed Dockerfile.render to Dockerfile"
else
    echo "❌ Dockerfile.render not found, creating new Dockerfile..."
fi

# Create the correct Dockerfile for Render
cat > Dockerfile << 'EOF'
FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    sqlite3 \
    libsqlite3-dev \
    && docker-php-ext-install pdo pdo_mysql pdo_sqlite mbstring exif pcntl bcmath gd \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Enable Apache rewrite module
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Create necessary directories with proper permissions FIRST
RUN mkdir -p /var/www/html/bootstrap/cache \
    && mkdir -p /var/www/html/storage/app/public \
    && mkdir -p /var/www/html/storage/framework/cache \
    && mkdir -p /var/www/html/storage/framework/sessions \
    && mkdir -p /var/www/html/storage/framework/views \
    && mkdir -p /var/www/html/storage/logs \
    && mkdir -p /var/www/html/database \
    && touch /var/www/html/database/database.sqlite \
    && chmod -R 777 /var/www/html/bootstrap/cache \
    && chmod -R 777 /var/www/html/storage \
    && chmod 666 /var/www/html/database/database.sqlite

# Copy application files
COPY . .

# Install PHP dependencies (directories now exist)
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Set final permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Copy Apache configuration
COPY docker/apache-render.conf /etc/apache2/sites-available/000-default.conf

# Copy startup script
COPY render-start.sh /usr/local/bin/render-start.sh
RUN chmod +x /usr/local/bin/render-start.sh

EXPOSE 10000

CMD ["/usr/local/bin/render-start.sh"]
EOF

# Update render.yaml to use standard Dockerfile
cat > render.yaml << 'EOF'
services:
  - type: web
    name: geeta-portfolio
    env: docker
    envVars:
      - key: APP_NAME
        value: "Geeta Portfolio"
      - key: APP_ENV
        value: production
      - key: APP_DEBUG
        value: false
      - key: APP_KEY
        generateValue: true
      - key: DB_CONNECTION
        value: sqlite
      - key: DB_DATABASE
        value: /var/www/html/database/database.sqlite
      - key: ADMIN_EMAIL
        value: geetskuikel@gmail.com
      - key: ADMIN_PASSWORD
        value: "12345678"
      - key: MAIL_MAILER
        value: smtp
      - key: MAIL_HOST
        value: smtp.gmail.com
      - key: MAIL_PORT
        value: "587"
      - key: MAIL_USERNAME
        value: geetskuikel@gmail.com
      - key: MAIL_FROM_ADDRESS
        value: geetskuikel@gmail.com
      - key: MAIL_FROM_NAME
        value: "Geeta Portfolio"
EOF

echo ""
echo "✅ Fixed Render configuration!"
echo ""
echo "🚀 Next steps:"
echo "1. git add ."
echo "2. git commit -m 'Fix Dockerfile for Render deployment'"
echo "3. git push origin main"
echo "4. Render will automatically redeploy"
echo ""
echo "🎯 Your portfolio will be live at: https://geeta-portfolio.onrender.com"
