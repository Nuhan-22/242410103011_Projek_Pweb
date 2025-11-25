# 🚀 PANDUAN HOSTING WEB PROJEK WISATA

## Pilihan Platform Hosting

### 1️⃣ **HEROKU** (Rekomendasi untuk Pemula)
**Kelebihan:**
- Easy deployment
- Free tier tersedia
- Automatic scaling
- PostgreSQL/MySQL terintegrasi

**Langkah Deployment:**

```bash
# 1. Install Heroku CLI
# Download dari https://devcenter.heroku.com/articles/heroku-cli

# 2. Login ke Heroku
heroku login

# 3. Buat aplikasi baru
heroku create nama-app-anda

# 4. Set environment variables
heroku config:set APP_ENV=production
heroku config:set APP_DEBUG=false
heroku config:set APP_KEY=base64:5H6KTAsw2RXF0Lqj7wYuBsT+m2A7sX35xCRXGPjeYCQ=
heroku config:set DB_CONNECTION=mysql
heroku config:set DB_HOST=your-host
heroku config:set DB_DATABASE=your-db
heroku config:set DB_USERNAME=your-user
heroku config:set DB_PASSWORD=your-pass

# 5. Push ke Heroku
git push heroku main

# 6. Run migrations
heroku run php artisan migrate:fresh --seed

# 7. Buka aplikasi
heroku open
```

---

### 2️⃣ **RAILWAY.APP** (Modern & User-Friendly)
**Kelebihan:**
- Zero-config deployment
- Support MySQL/PostgreSQL
- GitHub integration
- Pay-as-you-go pricing

**Langkah Deployment:**

1. Visit https://railway.app
2. Click "New Project"
3. Select "Deploy from GitHub"
4. Connect repository Anda
5. Add MySQL plugin
6. Set environment variables di Railway dashboard
7. Deploy!

---

### 3️⃣ **AWS LIGHTSAIL**
**Kelebihan:**
- Affordable monthly pricing
- Full server control
- Good for production
- Support semua stack

**Setup:**
1. Buat Lightsail instance (Ubuntu)
2. SSH ke server
3. Install: Apache, PHP 8.2, MySQL
4. Clone repository
5. Run: `composer install`, `npm run build`
6. Configure Apache virtual host
7. Setup SSL with Certbot

---

### 4️⃣ **SHARED HOSTING LOKAL** (e.g., Niagahoster, IDCloudHost)
**Kelebihan:**
- Murah
- Support Indonesia
- Easy management
- cPanel interface

**Setup:**
1. Upload file via FTP
2. Upload database via phpMyAdmin
3. Configure .env untuk database
4. Set public folder sebagai public_html
5. Jalankan migrations

---

## Database Migration untuk Production

### MySQL (Recommended)

```bash
# Local export
php artisan migrate:fresh --seed

# Create SQL backup
mysqldump -u root -p database_name > backup.sql

# Upload ke server dan import
mysql -u user -p database_name < backup.sql
```

### SQLite (Simple)

Jika menggunakan SQLite di production:
1. Copy `database/database.sqlite` ke server
2. Pastikan writable permissions: `chmod 666 database/database.sqlite`
3. Run: `php artisan migrate` jika diperlukan

---

## File & Folder Structure untuk Production

```
/
├── app/
├── bootstrap/
├── config/
├── database/
│   └── database.sqlite  (atau MySQL)
├── public/              (Web Root)
│   ├── build/           (Compiled assets)
│   ├── storage/         (Symbolic link)
│   └── index.php
├── resources/
├── routes/
├── storage/
│   ├── app/
│   │   └── public/      (Gambar & files)
│   └── logs/
├── vendor/
├── .env                 (Production config)
├── .env.production      (Reference)
└── Procfile             (Untuk Heroku/Railway)
```

---

## Step-by-Step Deployment Checklist

### ✅ Pre-Deployment

- [ ] `php artisan config:cache`
- [ ] `php artisan route:cache`
- [ ] `php artisan view:cache`
- [ ] `npm run build` (compile assets)
- [ ] Verify `.env` production settings
- [ ] Database backup created
- [ ] Storage folder permissions checked
- [ ] Git repository initialized

### ✅ Deployment

- [ ] Choose hosting platform
- [ ] Configure database connection
- [ ] Set environment variables
- [ ] Push code to platform
- [ ] Run database migrations
- [ ] Create symbolic link: `php artisan storage:link`
- [ ] Verify SSL certificate

### ✅ Post-Deployment

- [ ] Test homepage loading
- [ ] Test login/register
- [ ] Test destination details
- [ ] Test image loading
- [ ] Test booking flow
- [ ] Monitor logs: `tail -f storage/logs/laravel.log`
- [ ] Setup automated backups

---

## Environment Variables untuk Production

```env
# Application
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

# Database
DB_CONNECTION=mysql
DB_HOST=your-host.com
DB_DATABASE=your_db
DB_USERNAME=db_user
DB_PASSWORD=secure_password

# Mail (Optional)
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=app-specific-password
MAIL_ENCRYPTION=tls

# Cache & Session
CACHE_DRIVER=database
SESSION_DRIVER=database
QUEUE_CONNECTION=database
```

---

## Troubleshooting

### ❌ 500 Error
```bash
# Check logs
tail -f storage/logs/laravel.log

# Clear caches
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

### ❌ Storage Link Error
```bash
# Create symbolic link
php artisan storage:link

# Or manually create
ln -s /path/to/storage/app/public /path/to/public/storage
```

### ❌ Database Connection Error
```bash
# Check .env database credentials
# Verify database exists
# Check user permissions
# Test connection: php artisan tinker
```

### ❌ 403 Permission Denied
```bash
# Fix folder permissions
chmod -R 755 storage bootstrap/cache
chmod -R 777 storage/app/public
```

---

## Recommended Hosting for Your Project

| Platform | Price | Difficulty | Recommendation |
|----------|-------|------------|-----------------|
| Heroku | Free - $50/mo | Easy | ✅ Best for beginners |
| Railway | Pay-as-you-go | Easy | ✅ Modern alternative |
| AWS Lightsail | $3.50/mo | Medium | ⭐ Best value |
| Shared Hosting | $2-5/mo | Easy | ✅ Cheapest option |
| VPS | $5-20/mo | Hard | For experts |

---

## Post-Launch Optimization

1. **Enable caching:**
   ```bash
   php artisan config:cache
   php artisan route:cache
   ```

2. **Setup backup automation:**
   ```bash
   # Daily backup script
   0 2 * * * cd /app && mysqldump -u user -p db > backup.sql
   ```

3. **Monitor performance:**
   - Setup New Relic or DataDog
   - Monitor logs regularly
   - Track error rates

4. **Security:**
   - Force HTTPS
   - Setup firewall
   - Regular updates: `composer update`, `npm update`

---

## Support & Resources

- Laravel Documentation: https://laravel.com/docs
- Deployment Guide: https://laravel.com/docs/deployment
- Heroku Buildpack: https://github.com/heroku/heroku-buildpack-php
- Railway Docs: https://docs.railway.app

**Happy Deployment! 🚀**
