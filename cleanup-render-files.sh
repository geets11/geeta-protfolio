#!/bin/bash

echo "🧹 Cleaning up Render deployment files..."

# Remove Render-specific files
echo "Removing Render configuration files..."
rm -f render.yaml
rm -f Dockerfile
rm -f Dockerfile.render
rm -f render-start.sh
rm -f railway-start.sh

# Remove Render deployment scripts
echo "Removing Render deployment scripts..."
rm -f deploy-to-render.sh
rm -f render-troubleshoot.sh
rm -f render-quick-fix.sh
rm -f render-check-status.sh
rm -f fix-render-dockerfile.sh
rm -f render-deploy-fixed.sh

# Remove Railway files too
echo "Removing Railway files..."
rm -f railway.json
rm -f railway-*.sh
rm -f nixpacks.toml

# Remove Docker-related files
echo "Removing Docker files..."
rm -rf docker/
rm -f .dockerignore

# Remove other deployment files
echo "Removing other deployment files..."
rm -f RENDER_DEPLOYMENT.md
rm -f RAILWAY_DEPLOYMENT.md
rm -f .env.railway
rm -f .env.render

# Clean up any backup files
echo "Cleaning up backup files..."
rm -f *.bak
rm -f *~

echo "✅ Cleanup complete!"
echo ""
echo "📁 Remaining deployment files:"
echo "  ✅ netlify.toml"
echo "  ✅ netlify-build.sh"
echo "  ✅ netlify-deploy.sh"
echo ""
echo "🚀 Ready for Netlify deployment!"
echo "Run: git add . && git commit -m 'Clean up deployment files, keep only Netlify' && git push"
