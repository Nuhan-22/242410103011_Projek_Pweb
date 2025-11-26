# 📸 Panduan Penanganan Gambar di Aplikasi

## 🔍 Masalah yang Ditemukan

**Gejala:** Gambar tidak tampil di halaman, meski file ada di server  
**Penyebab:** Path gambar di-handle tidak konsisten antara database dan view

---

## 📁 Struktur Penyimpanan Gambar

```
project/
├── storage/
│   └── app/
│       ├── private/          ← Private files (tidak bisa diakses public)
│       └── public/           ← Public files (bisa diakses via /storage)
│           ├── pantai-kuta.jpg
│           ├── gunung-bromo.jpg
│           ├── candi-prambanan.jpg
│           └── ... (semua file gambar di sini)
├── public/
│   └── storage/              ← Symbolic link ke storage/app/public
│       ├── pantai-kuta.jpg   ← Accessible via /storage/pantai-kuta.jpg
│       └── ...
└── bootstrap/
    └── app.php
```

**Symbolic Link Status:** ✅ Sudah dibuat
```
c:\laragon\www\Projek-Pweb\public\storage → storage/app/public
```

---

## 🗄️ Format URL Gambar di Database

### Tabel: `gambar_tempat_wisata`

| Column | Value | Format |
|--------|-------|--------|
| `id_gambar_tempat_wisata` | 1 | INT |
| `url_gambar` | `pantai-kuta.jpg` | Hanya nama file |
| `id_tempat_wisata` | 1 | FK |

**Catatan:** `url_gambar` hanya menyimpan **nama file saja**, tanpa path `storage/`

---

## ✅ Cara Menampilkan Gambar dengan BENAR

### ❌ SALAH (saat ini):
```blade
{{ asset($destination->gambar_tempat_wisata->first()['url_gambar']) }}
```
**Hasil:** `/assets/pantai-kuta.jpg` ← TIDAK ADA file di sini!

---

### ✅ BENAR - Opsi 1 (Recommended):
```blade
{{ asset('storage/' . $destination->gambar_tempat_wisata->first()['url_gambar']) }}
```
**Hasil:** `/storage/pantai-kuta.jpg` ← ✅ File ditemukan!

---

### ✅ BENAR - Opsi 2 (Menggunakan Storage Facade):
```blade
{{ Storage::url($destination->gambar_tempat_wisata->first()['url_gambar']) }}
```
**Hasil:** `/storage/pantai-kuta.jpg` ← ✅ Lebih portable

---

### ✅ BENAR - Opsi 3 (Helper Function):
```blade
{{ asset('storage/' . basename($destination->gambar_tempat_wisata->first()['url_gambar'])) }}
```
**Lebih aman** jika ada path subdirectory di database.

---

## 🔧 Implementasi Perbaikan

### File yang perlu diperbaiki:

**1. `resources/views/visitor-pages/pages/detail-tempat-wisata.blade.php`**

Sebelum:
```blade
<img src="{{ asset($destination->gambar_tempat_wisata->first()['url_gambar']) }}"
```

Sesudah:
```blade
<img src="{{ asset('storage/' . $destination->gambar_tempat_wisata->first()['url_gambar']) }}"
```

---

**2. `resources/views/visitor-pages/pages/daftar-pesanan-tiket.blade.php`**

Sebelum:
```blade
{{ asset($pesanan->tikets->first()->tipe_tiket->first()->tempat_wisata->first()->gambar_tempat_wisata->first()->url_gambar) }}
```

Sesudah:
```blade
{{ asset('storage/' . $pesanan->tikets->first()->tipe_tiket->first()->tempat_wisata->first()->gambar_tempat_wisata->first()->url_gambar) }}
```

---

**3. `resources/views/visitor-pages/partials/navbar.blade.php`** (Profile Picture)

Sudah benar ✅:
```blade
asset('storage/' . \Illuminate\Support\Facades\Auth::user()->foto_profil)
```

---

## 🎯 Testing Checklist

- [ ] Homepage carousel images muncul
- [ ] Destination list images muncul
- [ ] Detail wisata image muncul
- [ ] Profile picture user muncul
- [ ] Admin kelola-wisata images muncul
- [ ] Booking pesanan images muncul
- [ ] Right-click save image works
- [ ] Mobile responsive images
- [ ] Dark mode images visible

---

## 📝 Controller File Upload Handler

### Saat upload gambar, pastikan:

```php
// Dalam Controller (misalnya DestinationController)

// ✅ BENAR - Simpan hanya nama file:
$gambar = $request->file('gambar')->store('', 'public');
// Hasil di DB: "pantai-kuta.jpg"

// ❌ SALAH - Simpan dengan path:
$gambar = $request->file('gambar')->store('images/destinations', 'public');
// Hasil di DB: "images/destinations/pantai-kuta.jpg"
// (Akan double ketika di-asset)
```

**Recommended approach:**
```php
$fileName = uniqid() . '.' . $request->file('gambar')->getClientOriginalExtension();
$request->file('gambar')->storeAs('', $fileName, 'public');
// Simpan ke DB: $fileName (hanya nama file)
```

---

## 🔐 Security Considerations

1. **Validasi file type:**
```php
$request->validate([
    'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
]);
```

2. **Sanitize filename:**
```php
$fileName = Str::slug(pathinfo($request->file('gambar')->getClientOriginalName(), PATHINFO_FILENAME)) 
            . '.' . $request->file('gambar')->getClientOriginalExtension();
```

3. **Gunakan unique ID:**
```php
$fileName = uniqid() . '_' . time() . '.' . $extension;
```

---

## 🚀 Optimization Tips

### 1. Lazy Loading:
```blade
<img src="..." loading="lazy" alt="...">
```

### 2. Image Compression:
```php
// Resize image saat upload
Image::make($file)->resize(800, 600)->save();
```

### 3. Cache Busting:
```blade
<img src="{{ asset('storage/' . $image . '?v=' . time()) }}">
```

### 4. Responsive Images:
```blade
<img src="{{ asset('storage/' . $small) }}"
     srcset="{{ asset('storage/' . $medium) }} 600w,
             {{ asset('storage/' . $large) }} 1200w"
     sizes="(max-width: 600px) 100vw, 50vw"
     alt="...">
```

---

## 📊 Status File Gambar

| File | Location | Size | Status |
|------|----------|------|--------|
| pantai-kuta.jpg | storage/app/public | 129 KB | ✅ Ada |
| gunung-bromo.jpg | storage/app/public | 35 KB | ✅ Ada |
| candi-prambanan.jpg | storage/app/public | 45 KB | ✅ Ada |
| danau-toba.jpg | storage/app/public | 38 KB | ✅ Ada |
| pulau-komodo.jpg | storage/app/public | 25 KB | ✅ Ada |
| pantai-parangtritis.jpg | storage/app/public | 45 KB | ✅ Ada |
| ujung-kulon.jpg | storage/app/public | 49 KB | ✅ Ada |
| kawah-ijen.jpg | storage/app/public | 88 KB | ✅ Ada |
| raja-ampat.jpg | storage/app/public | 41 KB | ✅ Ada |

**Total:** 16 file gambar destinasi + 2 file user upload

---

## 🔗 URL Reference

| Tujuan | URL | Path |
|--------|-----|------|
| Homepage | `/` | `/` |
| Gambar Destinasi | `/storage/pantai-kuta.jpg` | `public/storage/pantai-kuta.jpg` |
| Assets | `/assets/images/logo.svg` | `public/assets/images/logo.svg` |
| Profile | `/storage/user_profile_xyz.jpg` | `public/storage/user_profile_xyz.jpg` |

---

## 🎓 Kesimpulan

✅ **Symbolic link:** Sudah ada  
✅ **File gambar:** Semua ada di storage/app/public  
❌ **View code:** Perlu diperbaiki (path handling)  
✅ **Database:** Format URL konsisten (hanya nama file)

**Action:** Update view files untuk menambah `'storage/'` prefix saat menampilkan gambar.

---

**Status: ⏳ PERLU PERBAIKAN**
