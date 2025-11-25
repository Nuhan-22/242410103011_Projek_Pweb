# ⚡ QUICK START: DEPLOY KE RAILWAY (Rekomendasi)

Railway adalah platform hosting modern yang sangat mudah digunakan. Berikut adalah langkah tercepat untuk deploy:

## 🚀 5 Menit Setup

### Step 1: Persiapan
```bash
cd C:\laragon\www\Projek-Pweb

# Pastikan assets sudah di-build
npm run build

# Pastikan semua cache sudah di-clear
php artisan config:clear
php artisan cache:clear
```

### Step 2: Setup Git Repository
```bash
# Jika belum ada git repo
git init
git add .
git commit -m "Initial commit: Web Wisata App"

# Jika sudah ada GitHub repo
git remote add origin https://github.com/username/projek-pweb.git
git branch -M main
git push -u origin main
```

### Step 3: Buka Railway.app
1. Kunjungi https://railway.app
2. Click **"Start a New Project"**
3. Select **"Deploy from GitHub"** (pastikan GitHub sudah connect)
4. Pilih repository `Projek-Pweb`
5. Authorize Railway untuk akses repository

### Step 4: Add Database
1. Di Railway dashboard, click **"Add Service"**
2. Pilih **"MySQL"** atau **"PostgreSQL"**
3. Railway akan automatically generate credentials

### Step 5: Configure Environment
Di Railway, buka **"Variables"** tab dan isi:

```
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:5H6KTAsw2RXF0Lqj7wYuBsT+m2A7sX35xCRXGPjeYCQ=
APP_URL=https://your-app-name.up.railway.app

DB_CONNECTION=mysql
DB_HOST=${{ Mysql.MYSQLHOST }}
DB_PORT=${{ Mysql.MYSQLPORT }}
DB_DATABASE=${{ Mysql.MYSQLDATABASE }}
DB_USERNAME=${{ Mysql.MYSQLUSER }}
DB_PASSWORD=${{ Mysql.MYSQLPASSWORD }}

FILESYSTEM_DISK=local
SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database
```

### Step 6: Deploy
Railway akan automatic deploy ketika Anda push code ke GitHub.

Untuk manual deploy atau troubleshoot:
1. Click **"Logs"** untuk melihat error
2. Jika ada error, perbaiki di local kemudian push lagi

### Step 7: Run Migrations
Setelah deploy berhasil, jalankan migrations:

Cara 1: Gunakan Railway CLI
```bash
# Install Railway CLI
npm i -g @railway/cli

# Login
railway login

# Connect ke project
railway link <project-id>

# Run migrations
railway run php artisan migrate:fresh --seed
```

Cara 2: Gunakan Railway Dashboard
- Click aplikasi Anda
- Open shell dari "Deployments" → "View Logs" 
- Jalankan: `php artisan migrate:fresh --seed`

### Step 8: Verify
1. Buka aplikasi Anda di URL yang diberikan Railway
2. Test homepage
3. Test login (gunakan credentials dari seeding)
4. Test destinasi detail & gambar

✅ **Done! Aplikasi Anda sudah live!**

---

## 🔑 Test Credentials (Seeded Data)

```
Email: noxindocraft@gmail.com
Username: noxindocraft
Password: fauzan123
Role: Super Admin

Email: thobiw@gmail.com
Username: thobiw
Password: thobiw123
Role: Admin

Email: bobon@gmail.com
Username: bobon
Password: bobon123
Role: Pemilik Wisata

Email: garox@gmail.com
Username: garox
Password: garox123
Role: Pengunjung
```

---

## 🐛 Troubleshooting Railway

### Error: "Application crashed"
1. Check logs: Click "Deployments" → View logs
2. Common issues:
   - Missing environment variables
   - Database connection failed
   - Migrations error

### Error: "500 Internal Server Error"
```bash
# SSH ke Railway environment
railway shell

# Clear caches
php artisan config:clear
php artisan cache:clear
php artisan view:clear

# Check logs
tail -f storage/logs/laravel.log
```

### Images not showing
```bash
# Inside Railway shell
php artisan storage:link
chmod -R 755 storage/app/public
```

### Database migrations failed
```bash
# Run manually
railway run php artisan migrate:fresh --seed
```

---

## 💰 Railway Pricing

- **Free Tier**: $5/month free credit
- **Usage-based**: Bayar hanya yang dipakai
- **Starter**: ~$10-20/month untuk aplikasi sedang
- **Skala**: Unlimited scaling

---

## 📚 Alternative Platforms

Jika Railway tidak cocok, coba:

### **Heroku** (Sunset tapi masih bisa)
- Lebih mature tapi sekarang freemium
- Support 24/7
- Banyak extensions (add-ons)

### **PythonAnywhere / Render.com**
- Free tier generous
- Simple deployment
- Good documentation

### **DigitalOcean App Platform**
- Affordable ($5/month)
- Full control
- Good for scaling

### **Vercel** (Untuk frontend saja)
- Terbaik untuk Next.js/Frontend
- Gratis untuk hobby projects
- CDN global

---

## ✨ Next Steps After Deployment

1. **Setup Custom Domain**
   - Buy domain dari Namecheap/GoDaddy
   - Update DNS di Railway settings
   - Railway auto-provision SSL

2. **Enable Backups**
   - Railway auto-backup MySQL
   - Download backups reguler

3. **Monitor Performance**
   - Setup uptime monitoring
   - Alert setup untuk errors

4. **Add More Features**
   - Email notifications
   - Payment gateway integration
   - Analytics dashboard

---

**Selamat! 🎉 Aplikasi Anda sudah di deploy!**

Untuk support lebih lanjut, buka documentation:
- Railway: https://docs.railway.app
- Laravel: https://laravel.com/docs

**Happy Coding! 🚀**
