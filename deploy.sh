#!/bin/bash

# Deployment script untuk production
# Usage: ./deploy.sh

echo "🚀 Starting deployment process..."

# 1. Pull latest code
echo "📥 Pulling latest code from git..."
git pull origin main

# 2. Install dependencies
echo "📦 Installing PHP dependencies..."
composer install --no-dev --optimize-autoloader

# 3. Install Node dependencies
echo "📦 Installing Node dependencies..."
npm install

# 4. Build assets
echo "🔨 Building frontend assets..."
npm run build

# 5. Cache everything for production
echo "⚙️ Caching configuration, routes, and views..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 6. Run migrations
echo "🗄️ Running database migrations..."
php artisan migrate --force

# 7. Create storage symlink
echo "🔗 Creating storage symbolic link..."
php artisan storage:link

# 8. Clear all caches
echo "🧹 Clearing application cache..."
php artisan cache:clear

# 9. Restart queue (if using)
echo "♻️ Restarting queue workers..."
php artisan queue:restart

echo "✅ Deployment completed successfully!"
echo "🌐 Your application is now live!"
