# 🚀 CARA JALANKAN APLIKASI DI TERMINAL LOCAL

**Status:** Aplikasi sudah di-start! ✅

---

## ✅ APLIKASI SUDAH JALAN!

Server sudah running di:
```
http://127.0.0.1:8000
```

---

## 📌 APA YANG SUDAH TERJADI

1. ✅ Terminal menjalankan: `php artisan serve`
2. ✅ Server berjalan di port 8000
3. ✅ Aplikasi siap diakses

---

## 🌐 CARA AKSES APLIKASI

### **Opsi 1: Buka di Browser**
1. Buka browser (Chrome/Firefox)
2. Ketik URL: **http://127.0.0.1:8000**
3. ENTER

### **Opsi 2: Klik Link**
**Klik di sini:** http://127.0.0.1:8000

### **Opsi 3: Copy URL**
```
http://127.0.0.1:8000
```

---

## 📊 STATUS SERVER

```
Laravel Application running on: http://127.0.0.1:8000
Port: 8000
Database: SQLite (local)
Status: RUNNING ✅
```

---

## 🎯 YANG BISA ANDA LAKUKAN SEKARANG

### **1. Test Homepage**
- Buka http://127.0.0.1:8000
- Lihat halaman utama
- Lihat carousel

### **2. Test Login**
- Klik button Login
- Gunakan credentials:
  ```
  Email: noxindocraft@gmail.com
  Password: fauzan123
  ```

### **3. Test Destinasi**
- Klik menu Destinasi
- Lihat list destinasi
- Klik detail destinasi
- Verify gambar muncul

### **4. Test Fitur Lain**
- Browse halaman
- Test semua menu
- Lihat apakah ada error

---

## ⏹️ CARA STOP SERVER

Jika ingin stop aplikasi:

**Di terminal, tekan:** `Ctrl + C`

Server akan stop dan Anda bisa jalankan command lagi.

---

## 🔄 CARA RESTART SERVER

Jika ingin restart:

1. **Stop:** Ctrl + C di terminal
2. **Mulai ulang:** `php artisan serve`
3. **Open browser:** http://127.0.0.1:8000

---

## 💻 TERMINAL COMMANDS

### **Jalankan Server**
```bash
php artisan serve
```

### **Jalankan Server di Port Custom**
```bash
php artisan serve --port=3000
```
(akan jalan di http://127.0.0.1:3000)

### **Clear Cache**
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

### **Run Migrations**
```bash
php artisan migrate:fresh --seed
```
(akan reset dan populate database lokal)

### **Enter Tinker Console**
```bash
php artisan tinker
```
(untuk debug dan test code)

---

## 🎯 LOCAL vs PRODUCTION

| Aspek | Local | Production (Railway) |
|-------|-------|----------------------|
| URL | http://127.0.0.1:8000 | https://web-wisata-xyz.railway.app |
| Database | SQLite | MySQL |
| Purpose | Development | Live untuk orang lain |
| Akses | Hanya Anda di laptop | Siapa saja di dunia |
| Restart | `Ctrl + C` & jalankan ulang | Automatic di Railway |

---

## 📋 CHECKLIST

- [ ] Server jalan (terminal menunjukkan "Server running")
- [ ] Browser bisa akses http://127.0.0.1:8000
- [ ] Homepage muncul
- [ ] Tidak ada error merah
- [ ] Bisa test login
- [ ] Bisa browse destinasi

---

## ⚠️ TROUBLESHOOTING

### **Error: "Port already in use"**
```
Solusi: 
1. Gunakan port berbeda: php artisan serve --port=3000
2. Atau stop aplikasi lain yang pakai port 8000
```

### **Error: "Database connection error"**
```
Solusi:
1. Run migration: php artisan migrate:fresh --seed
2. Buat .env file dari .env.example
```

### **Error: "Class not found"**
```
Solusi:
1. Run: composer install
2. Run: composer dump-autoload
```

### **Browser tidak bisa akses**
```
Solusi:
1. Check terminal, server harus running
2. Double check URL: http://127.0.0.1:8000
3. Bukan https, tapi http!
```

---

## 📞 COMMANDS YANG SERING DIGUNAKAN

```bash
# Jalankan server
php artisan serve

# Jalankan migrations
php artisan migrate:fresh --seed

# Clear cache
php artisan cache:clear

# Lihat log
tail -f storage/logs/laravel.log

# Test database
php artisan tinker
>>> DB::connection()->getDatabaseName()

# Generate key
php artisan key:generate
```

---

## 🌟 NEXT STEPS

### **Jika semua OK di local:**
1. Test semua fitur
2. Jika OK, lanjut ke production (Railway)
3. Jika ada bug, fix dan commit ke GitHub
4. Railway auto-deploy setelah push

### **Untuk deploy ke Railway:**
1. Push code ke GitHub
2. Railway auto-build dan deploy
3. Run migrations di Railway Shell
4. Test di production URL
5. Share ke orang lain!

---

## 💡 TIPS

1. **Buat Terminal baru:** Jangan close terminal yang running server
2. **Buka terminal baru:** untuk jalankan command lain
3. **Development hot-reload:** Beberapa perubahan auto-reload tanpa restart
4. **Database reset:** `php artisan migrate:fresh --seed` untuk reset & seed data
5. **Logs:** Check storage/logs/laravel.log jika ada error

---

## 🎉 SELAMAT!

Aplikasi Anda sudah jalan di local! 🚀

Sekarang bisa:
- ✅ Test semua fitur
- ✅ Test login & browse
- ✅ Verify gambar loading
- ✅ Lihat database working
- ✅ Fix any bugs
- ✅ Siap deploy ke Railway!

---

**Status:** Server running at http://127.0.0.1:8000 ✅

**Next:** Test aplikasi atau deploy ke Railway!
