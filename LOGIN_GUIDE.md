# 🔐 PANDUAN LOGIN ACHMAD NUHAN

## Akun Tersedia

Anda memiliki **3 akun dengan nama Achmad Nuhan** dengan role berbeda:

---

### 👑 SUPER ADMIN (Full Access)

**Email:** `achmadnuhan@gmail.com`  
**Password:** `achmadnuhan123`  
**Username:** `achmadnuhan`

**Akses:**
- ✅ Dashboard Admin
- ✅ Kelola Destinasi (Tambah/Edit/Hapus)
- ✅ Kelola Tiket
- ✅ Kelola Kategori Wisata
- ✅ **Kelola User/Admin** (HANYA SUPER ADMIN)
- ✅ Moderasi Ulasan

---

### 🛠️ ADMIN (Kelola Konten)

**Email:** `achmadnuhan.admin@gmail.com`  
**Password:** `nuhan123`  
**Username:** `achmadnuhan_admin`

**Akses:**
- ✅ Dashboard Admin
- ✅ Kelola Destinasi (Tambah/Edit/Hapus)
- ✅ Kelola Tiket
- ✅ Moderasi Ulasan
- ❌ Kelola User/Admin (Hanya Super Admin)

---

### 👤 PENGUNJUNG (User Biasa)

**Email:** `achmadnuhan.visitor@gmail.com`  
**Password:** `visitor123`  
**Username:** `achmadnuhan_visitor`

**Akses:**
- ✅ Halaman Utama
- ✅ Cari & Lihat Destinasi
- ✅ Lihat Detail Destinasi + Gambar
- ✅ Tulis Ulasan & Rating
- ✅ Booking Tiket
- ✅ Proses Pembayaran
- ✅ Lihat Riwayat Pemesanan
- ✅ Edit Profil

---

## 🚀 Cara Login

1. **Buka aplikasi:**
   ```
   http://localhost:8000
   ```

2. **Klik tombol "Login"** di halaman utama

3. **Masukkan email & password** sesuai akun yang dipilih

4. **Klik "Login"** atau tekan Enter

---

## 📊 USER LAINNYA

Aplikasi juga memiliki user lain untuk testing:

| No | Nama | Email | Username | Role | Password |
|----|------|-------|----------|------|----------|
| 1 | Ahmad Fauzan | noxindocraft@gmail.com | neiaozora | Super Admin | fauzan123 |
| 2 | Alyasyi Thobiq | thobiw@gmail.com | thobiw | Admin | thobiw123 |
| 3 | Bobon Santoso | bobon@gmail.com | bobon | Pemilik Wisata | bobon123 |
| 4 | Garox Santoso | garox@gmail.com | garox | Pengunjung | garox123 |

---

## 🔄 RESET PASSWORD

Jika lupa password:

1. **Edit file:** `database/seeders/PenggunaSeeder.php`

2. **Ubah password pada akun Achmad:**
   ```php
   'password' => Hash::make('PASSWORD_BARU_ANDA'),
   ```

3. **Jalankan:**
   ```bash
   php artisan migrate:fresh --seed
   ```

---

## 💡 TIPS

- **Super Admin** gunakan untuk test fitur kelola user
- **Admin** gunakan untuk test kelola destinasi & tiket
- **Pengunjung** gunakan untuk test booking & payment
- Semua akun bisa melihat halaman utama
- Arahkan browser ke `/admin/dashboard` untuk langsung akses admin panel (jika sudah login)

---

## ✅ Testing Checklist

- [ ] Login dengan Super Admin
- [ ] Login dengan Admin
- [ ] Login dengan Pengunjung
- [ ] Lihat halaman destinasi
- [ ] Lihat detail destinasi + gambar
- [ ] Booking tiket
- [ ] Lihat riwayat pemesanan
- [ ] Tulis ulasan
- [ ] Edit profil
- [ ] Upload destinasi baru (Admin)
- [ ] Moderasi ulasan (Admin)

---

**Selamat testing! 🎉**
