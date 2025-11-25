# 🔍 CARA CEK DEPLOYMENT - STEP BY STEP

**Panduan detail untuk monitor dan verifikasi deployment Anda!**

---

## 📍 CEK 1: APAKAH KODE SUDAH DI GITHUB?

### **Buka GitHub:**
```
https://github.com/Nuhan-22/242410103011_Projek_Pweb
```

### **Yang harus Anda lihat:**
- ✅ Repository name: `242410103011_Projek_Pweb`
- ✅ Owner: `Nuhan-22`
- ✅ Branch: `master` (di dropdown paling atas)
- ✅ Files: Semua file Laravel terlihat (app/, config/, resources/, etc)
- ✅ Commits: 325+ commits

**Jika semua terlihat = KODE SUDAH DI GITHUB! ✅**

---

## 📍 CEK 2: APAKAH RAILWAY SUDAH DETECT PROJECT?

### **Langkah-langkah:**

**1. Buka https://railway.app**

**2. Login dengan GitHub**

**3. Di Railway Dashboard, lihat:**
```
Projects → Cari: 242410103011_Projek_Pweb
```

**Jika project terlihat = RAILWAY SUDAH DETECT! ✅**

---

## 📍 CEK 3: APAKAH DEPLOYMENT SEDANG BERJALAN?

### **Di Railway Dashboard:**

**1. Klik project: `242410103011_Projek_Pweb`**

**2. Lihat dua service:**
```
🔵 Web App (biru/hijau)
🟣 MySQL (ungu)
```

**3. Cek status Web App:**

**JIKA BERWARNA HIJAU/BIRU = SEDANG BUILD/RUNNING ✅**

**JIKA BERWARNA MERAH = ERROR ❌**

### **Lihat Build Status:**

1. Klik: **"Deployments"** tab
2. Lihat status:
   ```
   ⏳ Building... (sedang build)
   ✅ Build successful (build selesai)
   ❌ Build failed (error)
   ```

**Jika "Build successful" = BUILD SELESAI! ✅**

---

## 📍 CEK 4: APAKAH DATABASE SUDAH CONNECTED?

### **Di Railway Dashboard:**

**1. Lihat MySQL service (warna ungu)**

**Jika berwarna HIJAU = DATABASE CONNECTED! ✅**

**Jika berwarna MERAH = ERROR ❌**

---

## 📍 CEK 5: APAKAH APLIKASI SUDAH RUNNING?

### **Di Railway Dashboard Web App:**

**1. Lihat status di kanan atas:**
```
Status: Running
```

**2. Cari bagian "URL" atau "Domain":**
```
Domain: web-wisata-XXXXX.up.railway.app
```

**JIKA ADA URL = APLIKASI SUDAH RUNNING! ✅**

---

## 📍 CEK 6: APAKAH BISA BUKA APLIKASI DI BROWSER?

### **Copy URL dari Railway Dashboard:**
```
https://web-wisata-XXXXX.up.railway.app
```

### **Buka di browser baru:**

1. Copy-paste URL
2. Tekan ENTER
3. Tunggu 5-10 detik

### **Apa yang harus Anda lihat:**

**BERHASIL ✅:**
```
- Homepage muncul
- Logo/judul terlihat
- Carousel gambar terlihat
- Tombol "Login" ada
- Tidak ada error merah
```

**GAGAL ❌:**
```
- Error 502 / 503
- Blank page
- "Connection refused"
- Timeout
```

**Jika berhasil = APLIKASI SUDAH LIVE! ✅**

---

## 📍 CEK 7: APAKAH DATABASE SUDAH SEEDED?

### **Di Railway Dashboard:**

**1. Klik Web App → Tab "Shell"**

**2. Lihat prompt:**
```
railway@web-wisata:~$
```

**3. Copy-paste command:**
```
php artisan migrate:fresh --seed
```

**4. Tekan ENTER**

### **Cek output:**

**BERHASIL ✅:**
```
... (banyak output)
✓ Database seeded successfully!
```

**GAGAL ❌:**
```
Error: ... (error message)
[Exception] Database connection error
```

**Jika "Database seeded successfully!" = DATABASE SEEDED! ✅**

---

## 📍 CEK 8: APAKAH LOGIN BERFUNGSI?

### **Buka aplikasi di browser:**
```
https://web-wisata-XXXXX.up.railway.app
```

### **Klik tombol "Login"**

### **Masukkan credentials:**
```
Email: noxindocraft@gmail.com
Password: fauzan123
```

### **Klik "Login"**

### **Cek hasil:**

**BERHASIL ✅:**
```
- Redirect ke dashboard
- Sidebar muncul (menu Destinasi, Pesanan, Profile, etc)
- User profile terlihat
- Tidak ada error
```

**GAGAL ❌:**
```
- Error 500
- Blank page
- "Unauthorized"
- Still di login page
```

**Jika dashboard muncul = LOGIN BERFUNGSI! ✅**

---

## 📍 CEK 9: APAKAH DESTINASI TERLIHAT?

### **Di dashboard aplikasi:**

**1. Klik "Destinasi Wisata"** (di sidebar)**

### **Cek hasil:**

**BERHASIL ✅:**
```
- List destinasi muncul
- Ada 20+ destinasi
- Setiap item punya:
  - Nama destinasi
  - Gambar
  - Rating
  - Harga tiket
```

**GAGAL ❌:**
```
- List kosong
- Error 500
- Gambar tidak muncul
- Data tidak terlihat
```

**Jika list terlihat = DESTINASI OK! ✅**

---

## 📍 CEK 10: APAKAH GAMBAR LOADING?

### **Di halaman destinasi:**

**1. Klik salah satu destinasi**

**2. Buka detail page**

### **Cek gambar:**

**BERHASIL ✅:**
```
- Gambar destinasi muncul
- Ukuran gambar normal
- Tidak ada error icon
- Gambar clear & sharp
```

**GAGAL ❌:**
```
- Gambar broken (X icon)
- Blank space
- Error 404
- Placeholder image
```

**Jika gambar muncul = GAMBAR OK! ✅**

---

## 📍 CEK 11: APAKAH BISA DIBUKA ORANG LAIN?

### **Share link ke teman:**
```
https://web-wisata-XXXXX.up.railway.app
```

### **Beri tahu mereka:**
```
Login dengan:
Email: garox@gmail.com
Password: garox123
```

### **Tanya mereka:**
- ✅ Bisa buka link?
- ✅ Homepage terlihat?
- ✅ Bisa login?
- ✅ Destinasi terlihat?

**Jika semua "ya" = ORANG LAIN BISA AKSES! ✅**

---

## 🎯 CHECKLIST KESELURUHAN

```
CEK 1: Kode di GitHub?              [ ] ✅
CEK 2: Railway detect project?      [ ] ✅
CEK 3: Deployment berjalan?         [ ] ✅
CEK 4: Database connected?          [ ] ✅
CEK 5: Aplikasi running?            [ ] ✅
CEK 6: Bisa buka browser?           [ ] ✅
CEK 7: Database seeded?             [ ] ✅
CEK 8: Login berfungsi?             [ ] ✅
CEK 9: Destinasi terlihat?          [ ] ✅
CEK 10: Gambar loading?             [ ] ✅
CEK 11: Orang lain bisa akses?      [ ] ✅
```

**Semua ✅ = DEPLOYMENT BERHASIL 100%!** 🎉

---

## 🚨 KALAU ADA ERROR - INI YANG DILAKUKAN:

### **Error 502/503:**
- Tunggu 1-2 menit (Rails warming up)
- Refresh page (F5)
- Check Railway logs

### **Database connection error:**
- Tunggu 2-3 menit (MySQL setup)
- Run migration ulang
- Check MySQL status di Railway

### **Gambar tidak muncul:**
- Di Railway Shell, run:
  ```
  php artisan storage:link
  ```
- Refresh browser

### **Login error:**
- Check database seeding (sudah run migration?)
- Try with email: garox@gmail.com / garox123
- Check Railway logs

### **Build failed:**
- Check Railway logs (Deployments tab)
- Cari error message
- Usually auto-retry setelah beberapa menit

---

## 📊 DASHBOARD RAILWAY - APA YANG DICEK?

**Di Railway Dashboard, perhatikan:**

```
1. PROJECT STATUS:
   - Web App: Hijau ✅ / Merah ❌
   - MySQL: Hijau ✅ / Merah ❌

2. DEPLOYMENTS TAB:
   - Status: "Build successful" ✅
   - Build time: ~5-10 menit
   - Latest commit: Terlihat

3. DOMAIN/URL:
   - Terlihat di bagian kanan
   - Format: web-wisata-XXXXX.up.railway.app

4. LOGS TAB:
   - Lihat application logs
   - Check untuk errors

5. SHELL TAB:
   - Jalankan migration command
   - Check migration output
```

---

## 📱 VERIFIKASI FINAL

**Setelah semua CEK selesai, lakakan ini:**

### **1. Buka aplikasi di HP:**
```
Buka link di mobile browser
Lihat apakah responsive (tidak error)
```

### **2. Share link via WhatsApp:**
```
Minta teman buka link
Verifikasi bisa diakses orang lain
```

### **3. Test semua menu:**
```
- Homepage: ✅
- Destinasi: ✅
- Detail destinasi: ✅
- Booking: ✅
- User profile: ✅
```

### **4. Jika semua OK = APLIKASI PRODUCTION READY! 🚀**

---

## 🎊 SUMMARY

**Untuk verifikasi deployment:**

1. ✅ Cek GitHub - kode ada
2. ✅ Cek Railway - project terdeteksi
3. ✅ Cek status build - selesai?
4. ✅ Cek database - connected?
5. ✅ Cek URL - ada?
6. ✅ Cek di browser - bisa buka?
7. ✅ Run migration - seeded?
8. ✅ Test login - berfungsi?
9. ✅ Test destinasi - terlihat?
10. ✅ Test gambar - loading?
11. ✅ Share link - orang lain bisa akses?

**SEMUA ✅ = SELESAI! APLIKASI LIVE! 🎉**

---

**Jika ada yang error, cek bagian ERROR HANDLING di atas!**

**Tidak ada yang sulit, semua bisa dicek dengan mudah! 💪**
