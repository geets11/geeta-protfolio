#!/bin/bash

echo "🌐 Preparing Netlify deployment..."

# Make build script executable
chmod +x netlify-build.sh

# Add Netlify configuration
git add netlify.toml netlify-build.sh public/index.php

# Commit changes
git commit -m "Add Netlify deployment configuration

- Add netlify.toml with build settings
- Add netlify-build.sh script
- Fix Laravel directories creation
- Configure PHP 8.2 environment"

# Push to GitHub
git push origin main

echo ""
echo "✅ Netlify configuration ready!"
echo ""
echo "🚀 Next steps:"
echo "1. Go to https://netlify.com"
echo "2. Click 'Add new site' → 'Import an existing project'"
echo "3. Connect your GitHub repository: geets11/geeta-protfolio"
echo "4. Netlify will auto-detect the netlify.toml configuration"
echo "5. Click 'Deploy site'"
echo ""
echo "🎯 Your site will be available at:"
echo "https://geeta-portfolio.netlify.app"
echo ""
echo "🔐 Admin access:"
echo "https://geeta-portfolio.netlify.app/admin/login"
echo "Email: geetskuikel@gmail.com"
echo "Password: 12345678"
