#!/bin/bash

echo "🚨 EMERGENCY FIX - Portfolio Website"
echo "===================================="

# Step 1: Clear all caches
echo "🧹 Clearing all caches..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
php artisan optimize:clear

# Step 2: Regenerate autoload
echo "🔄 Regenerating autoload..."
composer dump-autoload

# Step 3: Generate application key if missing
echo "🔑 Checking application key..."
php artisan key:generate --force

# Step 4: Create storage link
echo "🔗 Creating storage link..."
php artisan storage:link

# Step 5: Set proper permissions
echo "🔐 Setting permissions..."
chmod -R 755 storage
chmod -R 755 bootstrap/cache
chmod -R 755 public

# Step 6: Check if images exist
echo "🖼️ Checking images..."
if [ ! -f "public/images/geeta-profile.jpg" ]; then
    echo "Creating missing profile image..."
    mkdir -p public/images
    curl -s -o "public/images/geeta-profile.jpg" "https://via.placeholder.com/300x300/2c3e50/ffffff?text=Geeta+Kuikel"
fi

# Create testimonial images if missing
for img in "bhesraj-pokhrel.jpg" "ahmed-al-rashid.jpg" "rajesh-sharma.jpg"; do
    if [ ! -f "public/images/$img" ]; then
        echo "Creating missing testimonial image: $img"
        curl -s -o "public/images/$img" "https://via.placeholder.com/150x150/2c3e50/ffffff?text=Photo"
    fi
done

# Step 7: Check database connection
echo "🗄️ Testing database connection..."
php artisan migrate:status 2>/dev/null || echo "⚠️ Database not connected - run migrations manually if needed"

echo ""
echo "✅ EMERGENCY FIX COMPLETE!"
echo "=========================="
echo ""
echo "🚀 Now start the server:"
echo "   php artisan serve"
echo ""
echo "🌐 Then open in browser:"
echo "   http://localhost:8000"
echo ""
echo "💡 If still having issues:"
echo "   1. Close ALL browser tabs"
echo "   2. Clear browser cache completely"
echo "   3. Try incognito/private mode"
echo "   4. Try a different browser"
