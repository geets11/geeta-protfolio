#!/bin/bash

echo "🧹 Cleaning up and committing changes..."

# Run cleanup
chmod +x cleanup-render-files.sh
./cleanup-render-files.sh

# Add changes to git
echo "📝 Adding changes to git..."
git add .
git add -u  # This stages deleted files

# Commit changes
echo "💾 Committing cleanup..."
git commit -m "Clean up deployment files

- Remove all Render/Railway deployment files
- Remove Docker configuration
- Keep only Netlify deployment setup
- Ready for Netlify deployment"

# Push to GitHub
echo "🚀 Pushing to GitHub..."
git push origin main

echo ""
echo "✅ Cleanup complete and pushed to GitHub!"
echo ""
echo "🌐 Next steps:"
echo "1. Go to https://netlify.com"
echo "2. Click 'Add new site' → 'Import an existing project'"
echo "3. Connect GitHub and select 'geets11/geeta-protfolio'"
echo "4. Deploy (Netlify will use netlify.toml automatically)"
echo ""
echo "Your portfolio will be live at: https://geeta-portfolio.netlify.app"
