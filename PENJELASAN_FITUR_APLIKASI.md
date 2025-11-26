# 📱 Dokumentasi Lengkap Fitur Aplikasi Web Wisata Indonesia

## 🎯 Gambaran Umum Aplikasi

**Nama:** Web Wisata Indonesia  
**Tipe:** Aplikasi Booking Destinasi Wisata  
**Platform:** Laravel 11 + PHP 8.3  
**Status:** Production Ready  
**Database:** 20+ destinasi wisata + 12,000+ data test

---

## 🌟 Fitur Utama Aplikasi

### 1. **🏠 Homepage / Landing Page**
**File:** `resources/views/welcome.blade.php`  
**Route:** `/` (Public)  
**Deskripsi:** Halaman utama yang menampilkan:
- ✅ Carousel/Galeri destinasi wisata
- ✅ Search bar untuk mencari wisata
- ✅ Status login user (Profile / Login)
- ✅ Responsive design (Mobile + Desktop)
- ✅ Dark mode support
- ✅ Link ke dokumentasi dan resources

**Teknologi:**
```
- Tailwind CSS untuk styling
- Vite untuk build optimization
- Responsive breakpoints (sm, md, lg, xl, 2xl)
- Font Figtree dari Bunny CDN
```

**Controller:** `HomepageController::index()`

---

### 2. **🔍 Cari & Lihat Daftar Destinasi Wisata**
**File:** `resources/views/visitor-pages/pages/cari-wisata.blade.php`  
**Route:** `/cari-wisata` (Public)  
**Deskripsi:**
- ✅ List semua destinasi wisata (20+)
- ✅ Filter berdasarkan kategori
- ✅ Search by nama destinasi
- ✅ Tampil rating & review
- ✅ Harga tiket termurah
- ✅ Pagination / Load more

**Data yang ditampil:**
```
- Nama destinasi
- Gambar/thumbnail
- Rating (1-5 bintang)
- Jumlah review
- Kategori (Pantai, Gunung, Taman, dll)
- Harga tiket mulai dari
```

**Controller:** `ListDestinationController::index()`  
**API Endpoint:** `GET /api/destinations`

---

### 3. **📍 Detail Destinasi Wisata**
**File:** `resources/views/visitor-pages/pages/detail-wisata.blade.php`  
**Route:** `/tempat-wisata/{id}` (Public)  
**Deskripsi:**
- ✅ Informasi lengkap destinasi
- ✅ Galeri foto/video
- ✅ Fasilitas yang tersedia
- ✅ Jam operasional
- ✅ Kontak & Alamat
- ✅ Daftar review + rating
- ✅ Form tambah review (untuk user yang login)
- ✅ Tombol booking tiket

**Data yang ditampil:**
```
- Nama & Deskripsi lengkap
- Gallery photos (gambar_tempat_wisata)
- Fasilitas list (Parkir, Kamar Mandi, Restoran, dll)
- Info kontak (Telepon, Email, Alamat)
- Social media links (Instagram, WhatsApp, TikTok)
- Daftar ulasan dengan rating bintang
- Form review (hanya untuk user login)
```

**Controller:** `DestinationDetailController::index()`

---

### 4. **⭐ Sistem Ulasan & Rating (Review)**
**File:** `resources/views/visitor-pages/pages/form-ulasan.blade.php`  
**Route:** `POST /tempat-wisata/{id}/ulasan` (Authenticated)  
**Admin Page:** `/admin/kelola-ulasan` (MustAdminsMiddleware)  
**Deskripsi:**
- ✅ User bisa memberikan rating 1-5 bintang
- ✅ User bisa menulis komentar
- ✅ Upload foto untuk review
- ✅ Admin bisa lihat & hapus review
- ✅ Cascade delete untuk foto review
- ✅ Flash message success/error

**Model:** `Ulasan` + `GambarUlasan`

**Database:**
```sql
-- Tabel ulasan
id_ulasan (Primary Key)
id_pengguna (FK) → pengguna
id_tempat_wisata (FK) → tempat_wisata
rating (1-5)
teks_ulasan (text)
created_at, updated_at

-- Tabel gambar_ulasan
id_gambar_ulasan (Primary Key)
id_ulasan (FK) → ulasan ON DELETE CASCADE
path_gambar
created_at, updated_at
```

**Controller:** `ManageComments::class`
- `store()` - Simpan review
- `index()` - Lihat semua review (Admin)
- `deleteComment()` - Hapus review (Admin)

---

### 5. **🎫 Sistem Booking & Pemesanan Tiket**
**File:** `resources/views/visitor-pages/pages/booking/`  
**Route:** 
- `GET /booking-tiket` - Pilih jumlah tiket
- `GET /booking-tiket/payment` - Metode pembayaran
- `POST /booking-tiket/payment` - Proses pembayaran
- `GET /booking-tiket/semua-pesanan` - List tiket saya
- `GET /booking-tiket/detail` - Detail pesanan

**Deskripsi:**
- ✅ Pilih tipe tiket (umum, anak, pelajar, dll)
- ✅ Pilih jumlah tiket
- ✅ Hitung total harga
- ✅ Pilih metode pembayaran
- ✅ Nomor rekening bank
- ✅ Konfirmasi pesanan
- ✅ Lihat history pesanan
- ✅ Download invoice/bukti pembayaran

**Model:** `PesananTiket`, `Tiket`, `TipeTiket`, `RekeningBank`

**Controller:** `BookingTicketController::class` + `MyBookedTicketController::class`

---

### 6. **👤 Autentikasi & Login**
**Route:**
- `GET /login` - Form login (Guest)
- `POST /login` - Proses login autentikasi
- `GET /register` - Form registrasi (Guest)
- `POST /register` - Proses registrasi user
- `GET /logout` - Logout user

**Tipe Role/Role:**
```
Role 1: Super Admin (Kelola semua + User management)
Role 2: Admin (Kelola destinasi, review, tiket)
Role 3: Pemilik Wisata (Kelola destinasi sendiri)
Role 4: Pengunjung (Browse & Booking tiket)
```

**Controller:** 
- `LoginController`
- `RegisterController`

**Credentials Demo:**
```
Admin: noxindocraft@gmail.com / fauzan123
User: garox@gmail.com / garox123
```

**Middleware:**
- `GuestMiddleware` - Hanya guest/logout
- `AuthMiddleware` - Hanya authenticated users
- `MustAdminsMiddleware` - Hanya admin (role 2+)
- `AdminMiddleware` - Admin level tertentu (role 1)

---

### 7. **👨‍💼 Admin Dashboard**
**Route:** `GET /admin/dashboard` (MustAdminsMiddleware)  
**File:** `resources/views/admin-pages/pages/dashboard.blade.php`  
**Deskripsi:**
- ✅ Analytics & statistik
- ✅ Chart revenue/booking
- ✅ Widget key metrics
- ✅ Recent bookings
- ✅ Navigation sidebar

**Chart Library:** Chart.js

**Controller:** `DashboardController::index()`

---

### 8. **🏛️ Kelola Destinasi Wisata (Admin)**
**Route:**
- `GET /admin/kelola-wisata` - List destinasi
- `GET /admin/tempat-wisata/tambah` - Form tambah
- `GET /admin/tempat-wisata/{id}/ubah` - Form edit
- `POST /admin/tempat-wisata/tambah` - Proses simpan
- `PUT /admin/tempat-wisata/ubah` - Proses update
- `DELETE /admin/tempat-wisata/{id}/hapus` - Hapus

**Fitur:**
- ✅ CRUD destinasi wisata
- ✅ Upload multiple gambar
- ✅ Tambah/edit fasilitas
- ✅ Tambah/edit tiket
- ✅ Input kontak & alamat
- ✅ Tambah social media links
- ✅ Input nomor rekening bank

**Model:** `TempatWisata`, `GambarTempatWisata`, `Fasilitas`, `Tiket`, `RekeningBank`, `SosialMedia`

**Controller:** `DestinationController::class` + `ManageDestinationController::class`

**Data Form:**
```
- Nama destinasi
- Deskripsi (text editor)
- Kategori wisata
- Alamat lengkap
- Rating awal
- Jam operasional
- Harga ticket
- Gallery gambar
- Fasilitas (dynamic add/remove)
- Tiket types (dynamic add/remove)
- Social media links
- Bank account info
```

---

### 9. **📋 Kelola Review/Ulasan (Admin)**
**Route:**
- `GET /admin/kelola-ulasan` - List review
- `DELETE /admin/kelola-ulasan/{id}/hapus` - Hapus review

**File:** `resources/views/admin-pages/pages/kelola-ulasan.blade.php`  
**Fitur:**
- ✅ Lihat semua review dengan datatable
- ✅ Filter berdasarkan destinasi
- ✅ Show pengguna & rating
- ✅ Hapus review dengan konfirmasi
- ✅ Cascade delete foto review
- ✅ Flash message success/error

**Controller:** `ManageComments::class`

---

### 10. **🎫 Kelola Tiket / Konfirmasi Booking (Admin)**
**Route:**
- `GET /admin/kelola-tiket` - List semua tiket
- `GET /admin/konfirmasi-tiket` - Konfirmasi pembayaran

**Fitur:**
- ✅ Lihat daftar pesanan tiket
- ✅ Filter status pembayaran
- ✅ Konfirmasi pembayaran manual
- ✅ Download bukti pembayaran
- ✅ Cetak tiket/invoice

**Controller:** `TicketController::class`

---

### 11. **🏷️ Kelola Kategori Wisata (Admin)**
**Route:**
- `GET /admin/kategori-wisata` - List kategori
- `POST /admin/kategori-wisata/store` - Tambah kategori
- `POST /admin/kategori-wisata/update` - Edit kategori
- `GET /admin/kategori-wisata/destroy/{id}` - Hapus kategori

**Fitur:**
- ✅ CRUD kategori (Pantai, Gunung, Taman, dll)
- ✅ Link ke destinasi
- ✅ Filter destinasi by kategori

**Controller:** `CategoryController::class`

**Model:** `Kategori`, `KategoriWisata`

---

### 12. **👨‍💻 Manajemen User (Super Admin)**
**Route:**
- `GET /admin/kelola-pengguna` - List user
- `GET /admin/kelola-pengguna/tambah` - Form tambah user
- `GET /admin/kelola-pengguna/ubah/{id}` - Form edit user
- `POST /admin/kelola-pengguna/tambah` - Simpan user
- `PUT /admin/kelola-pengguna/ubah/{id}` - Update user
- `DELETE /admin/kelola-pengguna/hapus/{id}` - Hapus user

**Middleware:** `AdminMiddleware::class . ":1"` (Hanya Super Admin)

**Fitur:**
- ✅ CRUD user/admin
- ✅ Set role user
- ✅ Enable/disable user
- ✅ Reset password

**Controller:** `ManageUserController::class`

---

### 13. **👤 Profile & Settings User**
**Route:**
- `GET /profile` - Lihat profile
- `GET /settings` - Edit profile
- `PUT /settings` - Simpan profile

**Fitur:**
- ✅ Edit nama lengkap
- ✅ Edit email
- ✅ Upload foto profile
- ✅ Edit nomor telepon
- ✅ Edit alamat
- ✅ Change password

**Controller:** `ProfileController::class`

---

### 14. **📊 API Endpoints**
**Public API:**

```
GET /api/destinations
- Get list destinasi dalam format JSON
- Query params: kategori, search, limit, page
- Response: [{id, nama, rating, image, harga_tiket, ...}]

POST /api/visitor-data
- Get data pengunjung (analytics)
- Response: {total_visitors, total_bookings, ...}
```

**Controller:** `ListDestinationController`, `VisitorController`

---

## 🗂️ Struktur Database Utama

### Tabel Utama:

```
pengguna (Users)
├── id_pengguna (PK)
├── nama_lengkap
├── email (unique)
├── password (hashed)
├── no_telepon
├── alamat
├── foto_profil
└── id_role (FK) → role

tempat_wisata (Tourism Destinations)
├── id_tempat_wisata (PK)
├── nama_tempat_wisata
├── deskripsi
├── alamat
├── jam_operasional
├── rating (float)
└── id_kategori (FK) → kategori

ulasan (Reviews)
├── id_ulasan (PK)
├── id_pengguna (FK) → pengguna
├── id_tempat_wisata (FK) → tempat_wisata
├── rating (1-5)
├── teks_ulasan (text)
└── created_at

gambar_ulasan (Review Images)
├── id_gambar_ulasan (PK)
├── id_ulasan (FK) → ulasan [CASCADE]
└── path_gambar

tiket (Tickets)
├── id_tiket (PK)
├── id_tempat_wisata (FK) → tempat_wisata
├── id_tipe_tiket (FK) → tipe_tiket
└── harga

pesanan_tiket (Orders)
├── id_pesanan_tiket (PK)
├── id_pengguna (FK) → pengguna
├── id_tempat_wisata (FK) → tempat_wisata
├── jumlah_tiket
├── total_harga
├── metode_pembayaran
└── status_pembayaran

fasilitas (Facilities)
├── id_fasilitas (PK)
├── nama_fasilitas
└── id_tempat_wisata (FK) → tempat_wisata

kategori (Categories)
├── id_kategori (PK)
└── nama_kategori

role (Roles)
├── id_role (PK)
└── nama_role
```

---

## 🎨 Frontend Technologies

| Teknologi | Kegunaan |
|-----------|----------|
| **Tailwind CSS** | Styling & Responsive Design |
| **Vue 3** | Frontend framework interaktif |
| **Alpine.js** | Lightweight interactivity |
| **Vite** | Build tool & dev server |
| **Chart.js** | Analytics & graphs |
| **DataTables** | Table dengan sorting & pagination |
| **Figtree Font** | Custom font dari Bunny CDN |

---

## 🔐 Security Features

- ✅ CSRF Token Protection (`@csrf`)
- ✅ Password Hashing (bcrypt)
- ✅ SQL Injection Prevention (Eloquent ORM)
- ✅ Role-based Access Control (Middleware)
- ✅ Input Validation (Form Request)
- ✅ Rate limiting
- ✅ Secure session management

---

## 📊 Sample Data

**Database seeded dengan:**
- 🏛️ 20 destinasi wisata
- 👥 Multiple pengguna per role
- 🎫 50+ tiket types
- 🏷️ 5 kategori wisata
- 🛏️ 200+ fasilitas
- 💬 Auto-generated reviews
- 📸 Gallery images per destination

---

## 🚀 Performance Features

- ✅ Eager loading (avoid N+1 queries)
- ✅ Database indexing pada FK
- ✅ Caching configuration
- ✅ Optimized images
- ✅ Vite asset bundling
- ✅ CDN untuk external fonts

---

## 📱 Responsive Design

**Breakpoints:**
- Mobile: 0px - 640px
- Tablet: 641px - 1024px
- Desktop: 1025px+

**Tested on:**
- ✅ iPhone (Safari)
- ✅ Android (Chrome)
- ✅ Desktop (Chrome, Firefox, Safari)
- ✅ Dark mode compatibility

---

## ✅ Testing Status

- [x] Semua 32 migrations berfungsi
- [x] Database seeded dengan 12,000+ records
- [x] Semua route responsive
- [x] Login & authentication tested
- [x] Booking system functional
- [x] Review system dengan cascade delete
- [x] Admin dashboard operational
- [x] Mobile responsiveness verified
- [x] Dark mode support confirmed
- [x] Production ready

---

## 🌐 Deployment

**Production:** Railway.app  
**Local:** `php artisan serve`  
**Build:** `npm run build`

Lihat **DEPLOY.md** untuk instruksi deployment lengkap.

---

## 📞 Quick Links

| Fitur | Route |
|-------|-------|
| Homepage | `/` |
| Login | `/login` |
| Register | `/register` |
| Cari Wisata | `/cari-wisata` |
| Detail Wisata | `/tempat-wisata/{id}` |
| Booking Tiket | `/booking-tiket` |
| Profile | `/profile` |
| Admin Dashboard | `/admin/dashboard` |
| Kelola Destinasi | `/admin/kelola-wisata` |
| Kelola Review | `/admin/kelola-ulasan` |
| Kelola User | `/admin/kelola-pengguna` |
| Kelola Kategori | `/admin/kategori-wisata` |
| Kelola Tiket | `/admin/kelola-tiket` |

---

**Status: ✅ PRODUCTION READY**  
Aplikasi Web Wisata Indonesia siap digunakan! 
