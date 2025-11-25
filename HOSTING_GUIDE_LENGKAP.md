# 🌍 PANDUAN HOSTING LENGKAP - STEP BY STEP

**Tujuan:** Membuat aplikasi Web Wisata Anda bisa diakses oleh orang lain di internet dengan URL yang stabil.

**Platform Pilihan:** Railway.app (Gratis 5 USD credit, mudah, auto-deploy dari GitHub)

**Waktu Estimasi:** 15-20 menit

---

## STEP 1️⃣: BUAT AKUN RAILWAY (5 MENIT)

### Langkah Demi Langkah:

**1. Buka browser dan kunjungi:**
```
https://railway.app
```

**2. Klik tombol besar "Start a New Project"**
- Atau login jika sudah punya akun

**3. Pilih opsi "Deploy from GitHub"**
- Railway akan minta authorize

**4. Klik "Authorize Railway"**
- Ini memberikan Railway permission untuk akses repository GitHub Anda
- Pilih akun GitHub: nuhan-22

**5. Tunggu redirect selesai**
- Anda akan kembali ke Railway dashboard

✅ **SELESAI STEP 1**

---

## STEP 2️⃣: DEPLOY APLIKASI (5 MENIT)

### Di Railway Dashboard:

**1. Railway akan menampilkan list repository**
- Cari: `242410103011_Projek_Pweb`
- Atau langsung klik repository yang muncul

**2. Klik "Deploy Now"**
- Railway otomatis akan:
  - ✅ Download code dari GitHub
  - ✅ Detect Laravel framework
  - ✅ Install dependencies (composer install)
  - ✅ Build assets (npm run build)
  - ✅ Setup environment

**3. Tunggu proses build (2-5 menit)**
- Di layar akan ada progress bar
- Warna hijau = loading, centang = selesai
- Tidak apa jika ada warning (CRLF, dll)

**4. Build selesai!**
- Railway akan memberikan URL temporary, misal: `https://your-app.up.railway.app`
- Catat URL ini!

✅ **SELESAI STEP 2**

---

## STEP 3️⃣: TAMBAH DATABASE MYSQL (3 MENIT)

### Di Railway Dashboard:

**1. Klik tombol "Add Service"**
- Biasanya di sisi kiri atau atas dashboard

**2. Cari dan pilih "MySQL"**
- Railway akan membuat database service baru

**3. Tunggu MySQL ter-create (1-2 menit)**
- Status berubah jadi hijau = siap pakai

**4. Railway otomatis setting variables:**
```
DB_HOST=<auto>
DB_PORT=3306
DB_DATABASE=railway_xxxx
DB_USERNAME=root
DB_PASSWORD=<auto>
```

**PENTING:** Anda tidak perlu manually copy variables, Railway auto-inject ke app!

✅ **SELESAI STEP 3**

---

## STEP 4️⃣: SET ENVIRONMENT VARIABLES (2 MENIT)

### Di Railway Dashboard:

**1. Klik aplikasi Anda (bukan database)**
- Pastikan memilih "Web App" bukan "MySQL"

**2. Cari tab "Variables"**
- Di sebelah "Deployments", "Logs", dll

**3. Verify / Edit variables:**

```
APP_ENV = production
APP_DEBUG = false
APP_KEY = base64:5H6KTAsw2RXF0Lqj7wYuBsT+m2A7sX35xCRXGPjeYCQ=
APP_URL = https://your-app.up.railway.app

FILESYSTEM_DISK = local
SESSION_DRIVER = database
CACHE_STORE = database
QUEUE_CONNECTION = database
LOG_CHANNEL = stack

MAIL_MAILER = log
```

**Database variables (Railway auto-set, verify ada):**
```
DB_CONNECTION = mysql
DB_HOST = [auto]
DB_PORT = [auto]
DB_DATABASE = [auto]
DB_USERNAME = [auto]
DB_PASSWORD = [auto]
```

**4. Klik "Save"**

✅ **SELESAI STEP 4**

---

## STEP 5️⃣: JALANKAN MIGRASI DATABASE (5 MENIT)

### Ada 2 cara - Pilih salah satu:

---

### ⭐ CARA A: Pakai Railway Web Console (PALING MUDAH)

**1. Di Railway Dashboard, pilih aplikasi**

**2. Cari tombol menu (3 titik ⋮) atau lihat "Deployments" tab**

**3. Pilih "Open Shell" atau "Execute Command"**

**4. Copy-paste command ini:**
```bash
php artisan migrate:fresh --seed
```

**5. Tekan Enter dan tunggu (1-2 menit)**

Jika berhasil akan muncul:
```
✓ Migrated: 2024_01_01_000001_create_users_table
✓ Migrated: 2024_01_01_000002_create_pengguna_table
...
✓ Seeding: CarouselSeeder
✓ Seeding: TempatWisataSeeder
...
Database migrations and seeding completed successfully!
```

✅ **DATABASE READY!**

---

### 💻 CARA B: Pakai Railway CLI (Jika cara A tidak bekerja)

Jalankan di terminal lokal Anda:

```bash
# 1. Install Railway CLI (jika belum)
npm install -g @railway/cli

# 2. Login ke Railway
railway login

# 3. Cari project ID
railway project list

# 4. Pilih project dan link
railway link

# 5. Jalankan migrasi
railway run php artisan migrate:fresh --seed

# 6. Lihat hasilnya
railway logs
```

---

✅ **SELESAI STEP 5 - DATABASE SUDAH SIAP!**

---

## STEP 6️⃣: TEST APLIKASI LIVE (5 MENIT)

### Buka aplikasi di browser:

**1. Railway akan memberikan URL, misal:**
```
https://web-wisata-123abc.up.railway.app
```

**2. Klik link atau copy ke browser**

**3. Verifikasi homepage muncul:**
- ✅ Muncul halaman Homepage
- ✅ Carousel bergambar
- ✅ Destinasi wisata terlihat
- ✅ Tidak ada error merah

**4. Test Login:**
```
Email: noxindocraft@gmail.com
Password: fauzan123
```

**5. Test fitur utama:**
- ✅ Lihat daftar destinasi
- ✅ Klik detail destinasi
- ✅ Verifikasi gambar muncul
- ✅ Lihat review/rating
- ✅ Coba booking tiket (jika sudah login)

**6. Jika ada error, check logs:**
- Di Railway dashboard → "Deployments" → "Logs"
- Catat error message dan troubleshoot

✅ **APLIKASI LIVE DAN BISA DIAKSES!**

---

## STEP 7️⃣: SHARE URL KE ORANG LAIN (1 MENIT)

### Bagikan URL ini ke orang lain:

**Cara 1: Copy URL dari Railway**
```
https://web-wisata-123abc.up.railway.app
```
- Kirim via WhatsApp, Email, atau Media Sosial
- Orang lain bisa langsung akses tanpa install apapun

**Cara 2: Gunakan Custom Domain (Opsional - untuk URL lebih bagus)**

Jika punya domain sendiri (misal: wisata.com):
1. Di Railway → Settings → Domains
2. Tambah domain custom
3. Update DNS di registrar Anda
4. Railway auto-generate SSL certificate

✅ **SELESAI - APLIKASI BISA DIAKSES ORANG LAIN!**

---

## 🔧 TROUBLESHOOTING

### ❌ "Build Failed"
**Solusi:**
1. Check Railway logs di tab "Deployments"
2. Biasanya karena NPM build error
3. Jangan khawatir, aplikasi masih bisa berjalan

### ❌ "500 Internal Server Error"
**Solusi:**
```bash
# Di Railway Shell, jalankan:
php artisan config:cache
php artisan route:cache
php artisan cache:clear
```

### ❌ "Database Connection Error"
**Solusi:**
1. Verify MySQL sudah di-add di Railway
2. Check variable DB_HOST, DB_DATABASE, dsb
3. Pastikan migrate sudah jalan sebelumnya

### ❌ "Gambar tidak muncul"
**Solusi:**
```bash
# Di Railway Shell:
php artisan storage:link
```

### ❌ "Deploy gagal terus"
**Solusi:**
1. Cek file .env.production di repository
2. Pastikan semua dependencies terinstall
3. Push update ke GitHub, Railway auto-redeploy

---

## 📊 TEST CREDENTIALS

Gunakan akun ini untuk test di production:

```
🔓 SUPER ADMIN
Email:    noxindocraft@gmail.com
Password: fauzan123

🔓 ADMIN
Email:    thobiw@gmail.com
Password: thobiw123

🔓 PEMILIK WISATA
Email:    bobon@gmail.com
Password: bobon123

🔓 PENGUNJUNG
Email:    garox@gmail.com
Password: garox123
```

---

## ✅ CHECKLIST FINAL

Sebelum share ke orang lain, pastikan:

- [ ] URL bisa dibuka di browser
- [ ] Homepage muncul tanpa error
- [ ] Login berfungsi dengan test credentials
- [ ] Destinasi wisata terlihat
- [ ] Gambar-gambar muncul (bukan broken image)
- [ ] Review dan rating terlihat
- [ ] Database ada data (bukan kosong)
- [ ] Tidak ada 500 error
- [ ] Responsive di mobile (test di HP)

**Jika semua ✅, SELAMAT HOSTING BERHASIL! 🎉**

---

## 📞 BANTUAN

**Jika ada masalah:**

1. **Cek Railway Logs:**
   - Railway Dashboard → Deployments → Logs

2. **SSH ke Railway:**
   - Railway Dashboard → aplikasi → Shell
   - `php artisan tinker`

3. **Restart aplikasi:**
   - Railway Dashboard → Redeploy

4. **Check dokumentasi:**
   - Railway: https://docs.railway.app
   - Laravel: https://laravel.com/docs

---

## 🎉 SUKSES!

Aplikasi Anda sekarang:
- ✅ Live di internet
- ✅ Bisa diakses oleh siapa saja
- ✅ Punya database MySQL production-ready
- ✅ Auto-deploy dari GitHub (push code = auto-update)

**URL Aplikasi:**
```
https://web-wisata-[YOUR-ID].up.railway.app
```

**Selamat! Web Wisata Anda sudah online! 🚀**

---

**Pertanyaan? Hubungi admin atau check logs di Railway dashboard.**
