#!/bin/bash

# 🚀 WEB WISATA PRODUCTION DEPLOYMENT SCRIPT
# Deployment otomatis ke Railway.app
# Status: PRODUCTION READY

echo "🚀 Starting Web Wisata Production Deployment..."
echo ""

# Step 1: Verify Git Status
echo "📋 Step 1: Verifying Git Status..."
git status

# Step 2: Add all changes
echo ""
echo "📝 Step 2: Adding changes to Git..."
git add .

# Step 3: Commit with deployment message
echo ""
echo "✅ Step 3: Creating deployment commit..."
git commit -m "Deploy: Production ready version - $(date '+%Y-%m-%d %H:%M:%S')"

# Step 4: Push to GitHub (Railway will auto-deploy)
echo ""
echo "🔄 Step 4: Pushing to GitHub (Railway will auto-deploy)..."
git push origin master

echo ""
echo "✅ Code pushed to GitHub!"
echo ""
echo "⏳ Railway will now:"
echo "   1. Build application"
echo "   2. Create MySQL database"
echo "   3. Deploy to production"
echo ""
echo "🎯 Next steps:"
echo "   1. Go to: https://railway.app"
echo "   2. Login with GitHub"
echo "   3. Open project: 242410103011_Projek_Pweb"
echo "   4. Go to Web App → Shell"
echo "   5. Run: php artisan migrate:fresh --seed"
echo ""
echo "📍 Your production URL will be:"
echo "   https://web-wisata-XXXXX.up.railway.app"
echo ""
echo "✨ Deployment initiated! Check Railway dashboard for progress..."
