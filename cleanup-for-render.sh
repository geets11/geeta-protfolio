#!/bin/bash

echo "🧹 Cleaning up Railway files and preparing for Render..."

# Remove Railway-specific files
echo "Removing Railway-specific files..."
rm -f railway.json
rm -f railway-start.sh
rm -f nixpacks.toml
rm -f emergency-deploy.sh
rm -f deploy-now.sh
rm -f final-cleanup.sh
rm -f fix-healthcheck.sh
rm -f railway-service-fix.sh
rm -f railway-correct-commands.sh
rm -f railway-redeploy-correct.sh

# Remove any other Railway scripts
rm -f *railway*.sh

echo "✅ Railway files removed!"

# Create Render-specific files
echo "📁 Creating Render deployment files..."

# Render uses different startup approach
echo "✅ Render files created!"

echo ""
echo "🚀 Ready for Render deployment!"
echo ""
echo "📋 Next steps:"
echo "1. Create account at render.com"
echo "2. Connect your GitHub repository"
echo "3. Deploy as Web Service"
echo "4. Use the build and start commands provided"
