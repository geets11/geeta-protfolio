#!/bin/bash

echo "🔧 Fixing Git setup and preparing for Render..."

# Go back to parent directory
cd ..

# Remove the nested clone
echo "Removing nested repository..."
rm -rf geeta-portfolio/geeta-protfolio

# Work directly in the cloned repository
cd geeta-protfolio

echo "📁 Now in the correct repository directory"
pwd

# Clean up Railway files and add Render files
echo "🧹 Cleaning up Railway files..."
rm -f railway.json railway-start.sh nixpacks.toml
rm -f *railway*.sh emergency-deploy.sh deploy-now.sh final-cleanup.sh

# Add Render-specific files
echo "📝 Creating Render deployment files..."

# The files will be created by the CodeProject above

echo "✅ Repository ready for Render!"
echo ""
echo "🚀 Next steps:"
echo "1. git add ."
echo "2. git commit -m 'Add Render deployment files'"
echo "3. git push"
echo "4. Deploy on Render.com"
