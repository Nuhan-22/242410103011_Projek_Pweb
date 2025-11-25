# 🚀 RAILWAY DEPLOYMENT - STEP BY STEP

## ✅ Status Sekarang
- Repository: ✅ **PUSHED to GitHub**
- Branch: `master` 
- GitHub URL: https://github.com/Nuhan-22/242410103011_Projek_Pweb
- Code: Ready for deployment

---

## 🎯 LANGKAH-LANGKAH DEPLOY KE RAILWAY

### **1️⃣ Buka Railway.app**

1. Kunjungi: https://railway.app
2. Click tombol **"Start a New Project"**
3. Pilih **"Deploy from GitHub"**
4. Authorize Railway untuk akses GitHub Anda

![Railway Login](https://cdn.railway.app/img/social-preview.jpg)

---

### **2️⃣ Hubungkan Repository**

1. Setelah authorize, Railway akan menampilkan daftar repository
2. Cari dan pilih: **`242410103011_Projek_Pweb`**
3. Click **"Deploy Now"** atau **"Create Project"**

Railway akan automatically:
- ✅ Detect Laravel framework
- ✅ Setup build process
- ✅ Configure PHP runtime
- ✅ Start building assets

**Tunggu 2-5 menit untuk build selesai**

---

### **3️⃣ Add MySQL Database**

Setelah deploy pertama berhasil:

1. Di Dashboard Railway, click **"Add Service"**
2. Pilih **"Database"** → **"MySQL"**
3. Railway akan auto-create database dengan credentials

Credentials akan di-set otomatis sebagai environment variables:
```
DB_HOST=<auto>
DB_PORT=<auto>
DB_DATABASE=<auto>
DB_USERNAME=<auto>
DB_PASSWORD=<auto>
```

---

### **4️⃣ Set Environment Variables**

Di Railway Dashboard → pilih app Anda → **"Variables"**

Add/Update ini:

```env
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:5H6KTAsw2RXF0Lqj7wYuBsT+m2A7sX35xCRXGPjeYCQ=
APP_URL=https://your-app-id.up.railway.app

FILESYSTEM_DISK=local
SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database
LOG_CHANNEL=stack

MAIL_MAILER=log
```

Database variables (untuk referensi, Railway auto-fill):
```
DB_CONNECTION=mysql
DB_HOST=${{ Mysql.MYSQLHOST }}
DB_PORT=${{ Mysql.MYSQLPORT }}
DB_DATABASE=${{ Mysql.MYSQLDATABASE }}
DB_USERNAME=${{ Mysql.MYSQLUSER }}
DB_PASSWORD=${{ Mysql.MYSQLPASSWORD }}
```

---

### **5️⃣ Run Database Migrations**

**OPSI A: Menggunakan Railway CLI (Recommended)**

```bash
# Install Railway CLI (jika belum)
npm install -g @railway/cli

# Login ke Railway
railway login

# Cari project ID Anda
railway project list

# Link ke project
railway link <project-id>

# Jalankan migrations dengan seeding
railway run php artisan migrate:fresh --seed

# Lihat logs
railway logs
```

**OPSI B: Menggunakan Railway Web Dashboard**

1. Di Dashboard, buka app Anda
2. Click menu **⋮** (three dots)
3. Pilih **"Open Shell"**
4. Jalankan command:
```bash
php artisan migrate:fresh --seed
```

---

### **6️⃣ Verify Aplikasi Live**

1. Railway akan memberikan URL: `https://your-app-id.up.railway.app`
2. Buka URL tersebut di browser
3. Verify beberapa hal:

✅ **Homepage muncul tanpa error**
```bash
# Check logs untuk errors
railway logs
```

✅ **Login berfungsi**
- Gunakan: `noxindocraft@gmail.com` / `fauzan123`

✅ **Gambar loading**
- Klik destinasi → check gambar muncul

✅ **Database connected**
- Klik destinasi list → verify data muncul

---

## 🔧 Troubleshooting Railway

### ❌ Build Error
**Error: "Build failed"**

```bash
# Check build logs di Railway dashboard
# Biasanya karena:
1. Missing packages: npm install
2. Version mismatch: check PHP version
3. File permissions: chmod 755 storage/

# Fix dan push ke GitHub:
git add .
git commit -m "Fix build error"
git push origin master
# Railway auto-rebuild
```

### ❌ Database Connection Error
**Error: "SQLSTATE[HY000]"**

```bash
# Check database credentials di Railway Variables
# Verify DB_HOST, DB_PORT, DB_USERNAME, DB_PASSWORD

# Test connection:
railway run php artisan tinker
>>> DB::connection()->getDatabaseName()
```

### ❌ 500 Internal Server Error
```bash
# Check application logs
railway logs

# Clear caches
railway run php artisan cache:clear
railway run php artisan config:clear
railway run php artisan view:clear

# Restart application
# Di Railway dashboard, click "Redeploy"
```

### ❌ Migrations tidak jalan
```bash
# Jalankan ulang migrations
railway run php artisan migrate:fresh --seed

# Atau step by step
railway run php artisan migrate --step
railway run php artisan seed
```

### ❌ Gambar tidak muncul
```bash
# Create storage symlink
railway run php artisan storage:link

# Check permissions
railway run chmod -R 755 storage/app/public
```

---

## 🌐 Custom Domain (Optional)

Jika mau pakai domain sendiri:

1. Di Railway dashboard → app → **"Settings"**
2. Cari **"Domains"**
3. Click **"+ Add Domain"**
4. Masukkan domain Anda
5. Follow instruksi update DNS

Railway akan auto-provision SSL certificate!

---

## 📊 Monitoring & Maintenance

### Daily Check
```bash
railway logs | head -50
# Check untuk errors atau warnings
```

### Weekly Backup
Railway auto-backup database, tapi sebaiknya:
```bash
# Export backup manual
railway run mysqldump -u $DB_USERNAME -p $DB_PASSWORD $DB_DATABASE > backup.sql

# Download dari server via FTP atau SCP
```

### Update Application
Ketika ada update code:
```bash
git add .
git commit -m "Update: [description]"
git push origin master
# Railway auto-redeploy
```

---

## 🚀 First 24 Hours Checklist

- [ ] Aplikasi live dan accessible
- [ ] Homepage muncul dengan gambar
- [ ] Login/Register berfungsi
- [ ] Destinasi detail page bekerja
- [ ] Booking system accessible
- [ ] Database terhubung dengan benar
- [ ] Error logs checked
- [ ] Backup database sudah ada

---

## 📞 Contacts & Support

**Railway Support:** https://docs.railway.app/help
**Discord Community:** https://discord.gg/railway
**GitHub Issues:** https://github.com/Nuhan-22/242410103011_Projek_Pweb/issues

---

## 🎉 Success Indicators

Aplikasi sukses di-deploy jika:

✅ URL accessible di browser  
✅ Tidak ada 500 error  
✅ Database terisi dengan data  
✅ Gambar-gambar muncul  
✅ Semua routes berfungsi  
✅ Login/Register working  

**Jika semua ✅, Anda sudah BERHASIL! 🎊**

---

## 🆘 Butuh Bantuan?

Jika ada masalah:

1. **Check Railway Logs** → `/deployments` tab
2. **Check Application Logs** → `railway logs`
3. **SSH ke Railway** → `railway shell`
4. **Cek Database** → `railway run php artisan tinker`

Untuk debug:
```bash
# SSH ke container
railway shell

# Di dalam shell
php artisan tinker
>>> \DB::connection()->getDatabaseName()
>>> \App\Models\TempatWisata::count()
```

---

**🚀 READY TO DEPLOY!**

Ikuti langkah di atas dan aplikasi Anda akan live dalam hitungan menit!
