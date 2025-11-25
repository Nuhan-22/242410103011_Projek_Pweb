# 📌 QUICK START - HOSTING DALAM 20 MENIT

## 🎯 TUJUAN
Membuat aplikasi Web Wisata bisa diakses orang lain di internet dengan URL stabil

## ⏱️ WAKTU: 20 MENIT

---

## ✅ SEBELUM MULAI - PASTIKAN PUNYA:

- ✅ Internet connection
- ✅ Browser (Chrome, Firefox, Edge)
- ✅ Akun GitHub: **nuhan-22** (sudah ada)
- ✅ Repository: **242410103011_Projek_Pweb** (sudah di-push)

---

## 🚀 7 STEP HOSTING

### STEP 1: Buka Railway.app (5 menit)
```
1. https://railway.app
2. Klik "Start a New Project"
3. Pilih "Deploy from GitHub"
4. Authorize Railway
```
✅ **Selesai → Railway dashboard terbuka**

---

### STEP 2: Deploy Aplikasi (5 menit)
```
1. Cari repository: 242410103011_Projek_Pweb
2. Klik "Deploy Now"
3. TUNGGU build selesai (2-5 menit)
4. CATAT URL: https://web-wisata-abc123.up.railway.app
```
✅ **Selesai → Aplikasi ter-deploy**

---

### STEP 3: Add MySQL Database (3 menit)
```
1. Klik "Add Service"
2. Pilih "MySQL"
3. TUNGGU 1-2 menit
4. Status menjadi hijau
```
✅ **Selesai → Database ter-create**

---

### STEP 4: Set Environment Variables (2 menit)
```
1. Klik aplikasi (bukan database)
2. Buka tab "Variables"
3. Verify ada: APP_ENV, APP_KEY, DB_HOST, etc
4. Klik "Save" atau "Deploy"
```
✅ **Selesai → Variables ter-set**

---

### STEP 5: Run Database Migrations (5 menit)
```
1. Klik aplikasi → Shell
2. Copy-paste:
   php artisan migrate:fresh --seed
3. Tekan Enter
4. TUNGGU 1-2 menit
```
✅ **Selesai → Database ter-populate dengan data**

---

### STEP 6: Test Aplikasi Live (5 menit)
```
1. Buka URL: https://web-wisata-abc123.up.railway.app
2. Verify:
   - Homepage muncul
   - Login dengan: noxindocraft@gmail.com / fauzan123
   - Destinasi terlihat
   - Gambar muncul
```
✅ **Selesai → Aplikasi live!**

---

### STEP 7: Share URL (1 menit)
```
Share URL ini ke orang lain:
https://web-wisata-abc123.up.railway.app

Mereka bisa langsung akses tanpa install apapun!
```
✅ **Selesai → Aplikasi bisa diakses orang lain!**

---

## 📊 TEST CREDENTIALS

```
SUPER ADMIN:
Email: noxindocraft@gmail.com
Password: fauzan123

PENGUNJUNG:
Email: garox@gmail.com
Password: garox123
```

---

## ✅ BERHASIL JIKA:

- ✅ URL bisa dibuka
- ✅ Homepage muncul
- ✅ Login berfungsi
- ✅ Destinasi terlihat
- ✅ Gambar muncul
- ✅ Tidak ada error merah
- ✅ Orang lain bisa akses

---

## 🆘 BANTUAN

**Dokumentasi Lengkap:**
- ACTION_PLAN_HOSTING.md - Step-by-step detail
- HOSTING_GUIDE_LENGKAP.md - Info lengkap
- RAILWAY_DEPLOYMENT_STEPS.md - Railway specific

**Repository:**
https://github.com/Nuhan-22/242410103011_Projek_Pweb

---

## 🎉 SETELAH SUKSES

Aplikasi Anda:
- ✅ LIVE di internet
- ✅ Accessible dari mana saja
- ✅ Punya database production
- ✅ Auto-deploy dari GitHub

**URL:** https://web-wisata-[YOUR-ID].up.railway.app

---

**Mulai dari STEP 1! Selamat hosting! 🚀**
