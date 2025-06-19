#!/bin/bash

echo "🎨 Deploying Geeta's Portfolio to Render..."

# Check if git is initialized
if [ ! -d ".git" ]; then
    echo "📦 Initializing Git repository..."
    git init
    git add .
    git commit -m "Initial commit: Laravel portfolio for Render deployment"
fi

# Add Render deployment files
echo "📋 Adding Render deployment files..."
git add .
git commit -m "Add Render deployment configuration

- render.yaml for service configuration
- Dockerfile.render optimized for Render
- Apache configuration for port 10000
- Startup script with proper initialization
- Environment variables for production"

echo ""
echo "✅ Render deployment files ready!"
echo ""
echo "🚀 Next steps:"
echo "1. Push to GitHub:"
echo "   git remote add origin https://github.com/YOUR_USERNAME/geeta-portfolio.git"
echo "   git branch -M main"
echo "   git push -u origin main"
echo ""
echo "2. Go to https://render.com"
echo "3. Click 'New +' → 'Web Service'"
echo "4. Connect your GitHub repository"
echo "5. Render will auto-detect the render.yaml file"
echo "6. Click 'Deploy'"
echo ""
echo "🔐 Your admin credentials:"
echo "Email: geetskuikel@gmail.com"
echo "Password: 12345678"
echo ""
echo "📧 To enable contact form emails:"
echo "1. Enable 2FA on Gmail"
echo "2. Generate App Password"
echo "3. Add MAIL_PASSWORD environment variable in Render dashboard"
echo ""
echo "🎯 Your portfolio will be live at: https://geeta-portfolio.onrender.com"

chmod +x deploy-to-render.sh
