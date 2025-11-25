# 🚀 ACTION PLAN - HOSTING STEP BY STEP

Ikuti langkah-langkah di bawah dengan URUT. Jangan skip step!

---

## ⏱️ WAKTU ESTIMASI: 20 MENIT

---

## ✅ STEP 1: SETUP RAILWAY ACCOUNT (5 MENIT)

**YANG ANDA LAKUKAN:**

1. Buka browser (Chrome, Firefox, Edge, dll)
2. Kunjungi: **https://railway.app**
3. Klik tombol besar **"Start a New Project"**
4. Pilih **"Deploy from GitHub"**
5. Klik **"Authorize Railway"** dan follow instruksi
6. Authorize untuk akun GitHub: **nuhan-22**

**HASIL YANG DIHARAPKAN:**
- Railway dashboard muncul
- Anda masuk ke Railway dengan akun GitHub

**JIKA STUCK:**
- Buat akun Railway gratis di railway.app jika belum ada
- Pastikan GitHub sudah terkoneksi

✅ **LANJUT KE STEP 2**

---

## ✅ STEP 2: DEPLOY APLIKASI (5 MENIT)

**YANG ANDA LAKUKAN:**

1. Di Railway dashboard, cari repository: **`242410103011_Projek_Pweb`**
2. Klik repository tersebut
3. Klik tombol **"Deploy Now"** atau **"Create Project"**
4. **TUNGGU** proses build (2-5 menit)
   - Ada loading bar atau status progress
   - Status berubah dari loading → SUCCESS ✅
5. Jika ada warning, abaikan saja (normal!)

**HASIL YANG DIHARAPKAN:**
- Build selesai (centang hijau ✅)
- Railway memberikan URL, misal: `https://web-wisata-abc123.up.railway.app`
- **CATAT URL INI!**

**JIKA BUILD ERROR:**
- Check logs di Railway dashboard
- Tidak fatal, lanjut ke STEP 3

✅ **LANJUT KE STEP 3**

---

## ✅ STEP 3: ADD MYSQL DATABASE (3 MENIT)

**YANG ANDA LAKUKAN:**

1. Di Railway dashboard, cari tombol **"Add Service"**
2. Cari dan pilih **"MySQL"** (atau "Database" → "MySQL")
3. **TUNGGU** 1-2 menit, MySQL ter-create
4. Status berubah hijau = selesai

**HASIL YANG DIHARAPKAN:**
- MySQL service sudah ada di dashboard
- Railway otomatis set database credentials (Anda tidak perlu setting manual)

**JIKA TIDAK KETEMU:**
- Coba scroll di "Add Service" list
- Pastikan mencari "MySQL" bukan "PostgreSQL"

✅ **LANJUT KE STEP 4**

---

## ✅ STEP 4: SET ENVIRONMENT VARIABLES (2 MENIT)

**YANG ANDA LAKUKAN:**

1. Di Railway dashboard, **klik aplikasi Anda** (bukan database)
2. Cari tab **"Variables"**
3. Verify sudah ada variable:
   ```
   APP_ENV = production
   APP_DEBUG = false
   APP_KEY = base64:5H6KTAsw2RXF0Lqj7wYuBsT+m2A7sX35xCRXGPjeYCQ=
   APP_URL = https://web-wisata-abc123.up.railway.app
   (etc)
   ```
4. Jika ada yang kurang, tambah manual
5. Klik **"Save"** atau **"Deploy"**

**HASIL YANG DIHARAPKAN:**
- Semua variable sudah ada
- Aplikasi auto-redeploy dengan variable baru

**JIKA RAGU:**
- Copy dari file `.env` atau `.env.production` di repository

✅ **LANJUT KE STEP 5**

---

## ✅ STEP 5: JALANKAN DATABASE MIGRATIONS (5 MENIT)

**YANG ANDA LAKUKAN:**

### PILIH CARA A (PALING MUDAH):

1. Di Railway dashboard, klik aplikasi
2. Cari tombol **"Shell"** atau menu 3 titik (**⋮**)
3. Click **"Execute Command"** atau **"Open Shell"**
4. Copy-paste command ini:
   ```
   php artisan migrate:fresh --seed
   ```
5. Tekan **Enter**
6. **TUNGGU** 1-2 menit (ada loading)

**HASIL YANG DIHARAPKAN:**
```
✓ Migrated: 2024_01_01_00001_create_catat_pengunjung_table
✓ Migrated: 2024_01_01_00002_create_pengguna_table
...
✓ Seeding: CarouselSeeder
✓ Seeding: TempatWisataSeeder
✓ Seeding: KategoriSeeder
Database seeded successfully!
```

**JIKA GAGAL:**
- Check error message di logs
- Pastikan MySQL sudah terkoneksi (STEP 3)
- Coba ulangi command

### ATAU CARA B (JIKA CARA A TIDAK BEKERJA):

Jalankan di terminal lokal:
```bash
npm install -g @railway/cli
railway login
railway link
railway run php artisan migrate:fresh --seed
```

✅ **DATABASE SIAP!**

---

## ✅ STEP 6: TEST APLIKASI LIVE (5 MENIT)

**YANG ANDA LAKUKAN:**

1. Railway memberikan URL, contoh:
   ```
   https://web-wisata-abc123.up.railway.app
   ```

2. **Buka URL di browser** (Chrome, Firefox, dll)

3. **Verifikasi halaman muncul:**
   - ✅ Homepage terlihat
   - ✅ Carousel dengan gambar
   - ✅ Destinasi wisata terlihat
   - ✅ Tidak ada error merah

4. **TEST LOGIN:**
   - Email: `noxindocraft@gmail.com`
   - Password: `fauzan123`
   - Klik **Login**

5. **JIKA LOGIN BERHASIL:**
   - ✅ Dashboard muncul
   - ✅ Lihat menu destinasi
   - ✅ Klik detail destinasi
   - ✅ **VERIFIKASI GAMBAR MUNCUL**

6. **TEST FITUR:**
   - Klik "Destinasi Wisata" → lihat list
   - Klik salah satu destinasi → lihat detail + gambar
   - Scroll lihat review/rating
   - (Opsional) Coba booking tiket

**HASIL YANG DIHARAPKAN:**
- Semua halaman muncul tanpa error
- Gambar-gambar terlihat dengan baik
- Login berfungsi
- Database terkoneksi (data ada)

**JIKA ADA ERROR:**
- Jangan panic, normal! 
- Check Railway logs: Dashboard → Deployments → Logs
- Catat error message
- Troubleshoot menggunakan error message

✅ **APLIKASI LIVE!**

---

## ✅ STEP 7: SHARE KE ORANG LAIN (1 MENIT)

**YANG ANDA LAKUKAN:**

1. Copy URL aplikasi dari Railway:
   ```
   https://web-wisata-abc123.up.railway.app
   ```

2. **Share ke orang lain:**
   - WhatsApp message
   - Telegram
   - Email
   - Instagram
   - Social media lain

3. **Mereka bisa langsung akses** tanpa install apapun!

**CONTOH SHARE MESSAGE:**
```
Halo! Aplikasi Web Wisata kami sudah online! 🎉

Bisa diakses di sini: https://web-wisata-abc123.up.railway.app

Coba login dan lihat destinasi wisata kita!
Email: garox@gmail.com
Password: garox123

Terima kasih!
```

✅ **SELESAI! APLIKASI BISA DIAKSES ORANG LAIN!**

---

## 📋 CHECKLIST FINAL

Sebelum declare "SUKSES", pastikan:

- [ ] URL bisa dibuka di browser
- [ ] Homepage muncul tanpa error merah
- [ ] Login berhasil dengan credentials
- [ ] Destinasi wisata terlihat di list
- [ ] Klik destinasi → detail + gambar muncul
- [ ] Tidak ada 500 error atau error lain
- [ ] Database terisi data (bukan kosong)
- [ ] Responsive di mobile
- [ ] Bisa share URL ke orang lain dan mereka bisa akses

**Jika semua ✅ → HOSTING BERHASIL! 🎉**

---

## 🆘 JIKA ADA MASALAH

### Error: "Build Failed"
```
✓ Solusi: Check Railway logs, biasanya NPM build error
✓ Aplikasi masih bisa jalan, terus ke STEP 5
```

### Error: "500 Internal Server Error"
```
✓ Solusi: Jalankan di Railway Shell:
  php artisan config:cache
  php artisan route:cache
  php artisan cache:clear
```

### Error: "Database Connection Error"
```
✓ Solusi: Pastikan:
  1. MySQL sudah di-add di STEP 3
  2. Migrate sudah jalan di STEP 5
  3. Variables sudah di-set di STEP 4
```

### Error: "Gambar tidak muncul"
```
✓ Solusi: Jalankan di Railway Shell:
  php artisan storage:link
```

### Deploy gagal terus-terus
```
✓ Solusi:
  1. Push update ke GitHub
  2. Railway auto-redeploy
  3. Cek logs untuk lihat error detail
```

---

## 📞 DOKUMENTASI LENGKAP

Jika butuh info lebih detail:

- **HOSTING_GUIDE_LENGKAP.md** - Di repository ini
- **RAILWAY_DEPLOYMENT_STEPS.md** - Di repository ini
- **Railway Docs** - https://docs.railway.app
- **Laravel Docs** - https://laravel.com/docs

---

## 🎉 YANG TERJADI SETELAH BERHASIL

Setelah selesai 7 step di atas:

✅ Aplikasi Anda **LIVE di internet**  
✅ Bisa diakses oleh **siapa saja** dari mana saja  
✅ Punya **database MySQL** yang real  
✅ **Auto-deploy** dari GitHub (push code = update otomatis)  
✅ **SSL certificate gratis** (HTTPS)  
✅ **Mobile responsive** (bisa akses dari HP)  

---

## 🚀 SELAMAT HOSTING! 

**URL Aplikasi Anda:**
```
https://web-wisata-[YOUR-ID].up.railway.app
```

**Orang lain sekarang bisa akses aplikasi Anda!**

---

**Butuh bantuan? Hubungi admin atau check logs di Railway dashboard.**
