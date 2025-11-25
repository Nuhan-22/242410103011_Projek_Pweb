# 🎬 VISUAL STEP-BY-STEP GUIDE

## Cara Jalankan Migration di Railway - DENGAN SCREENSHOT DESCRIPTIONS

---

## ✅ LANGKAH 1: BUKA RAILWAY DASHBOARD

```
URL: https://railway.app

Anda akan lihat:
┌─────────────────────────────┐
│  Railway                    │
│  Dashboard                  │
│                             │
│  Projects:                  │
│  ✓ 242410103011_Projek_Pweb  ← KLIK INI
│  ✓ Other Project            │
└─────────────────────────────┘
```

**Klik:** Project `242410103011_Projek_Pweb`

---

## ✅ LANGKAH 2: PROJECT DASHBOARD

```
Setelah klik project, Anda lihat:

┌──────────────────────────────────────┐
│  242410103011_Projek_Pweb            │
├──────────────────────────────────────┤
│  Services:                           │
│                                      │
│  🔵 Web App (Laravel)                │ ← KLIK INI!
│  🔵 MySQL (Database)                 │
│                                      │
└──────────────────────────────────────┘
```

**PENTING:** Klik Web App (berwarna biru), BUKAN MySQL!

---

## ✅ LANGKAH 3: WEB APP DASHBOARD

```
Setelah klik Web App:

┌──────────────────────────────────────────────────┐
│  Web App                                         │
├──────────────────────────────────────────────────┤
│ [Deployments] [Logs] [Variables] [Shell] [...]  │ ← TABS
│                                                  │
│  Status: RUNNING ✓                              │
│  URL: https://web-wisata-xyz.up.railway.app    │
│                                                  │
└──────────────────────────────────────────────────┘
```

**Klik:** Tab "Shell" atau "Execute"

---

## ✅ LANGKAH 4: SHELL TAB

```
Setelah klik Shell:

┌──────────────────────────────────────────────────┐
│  Shell                                           │
├──────────────────────────────────────────────────┤
│                                                  │
│  $ _  ← Prompt untuk input command              │
│                                                  │
│  [Execute] [Clear] [Copy]                       │
│                                                  │
└──────────────────────────────────────────────────┘
```

Ini adalah command prompt. Ready untuk input!

---

## ✅ LANGKAH 5: COPY COMMAND

```
Command yang harus Anda copy:

php artisan migrate:fresh --seed

Salin teks di atas dengan Ctrl + C
```

---

## ✅ LANGKAH 6: PASTE DI RAILWAY SHELL

```
Setelah paste:

┌──────────────────────────────────────────────────┐
│  Shell                                           │
├──────────────────────────────────────────────────┤
│                                                  │
│  $ php artisan migrate:fresh --seed              │
│    ↑ Command sudah muncul di sini                │
│                                                  │
│  [Execute] [Clear] [Copy]                       │
│                                                  │
└──────────────────────────────────────────────────┘
```

---

## ✅ LANGKAH 7: TEKAN ENTER

```
Klik tombol Execute atau tekan ENTER

┌──────────────────────────────────────────────────┐
│  Shell                                           │
├──────────────────────────────────────────────────┤
│                                                  │
│  $ php artisan migrate:fresh --seed              │
│  Dropping all tables .................... ✓      │
│                                                  │
│  [Running...]  ⏳                               │
│                                                  │
└──────────────────────────────────────────────────┘
```

---

## ✅ LANGKAH 8: TUNGGU OUTPUT

```
Tunggu 1-2 menit, akan muncul output:

┌──────────────────────────────────────────────────┐
│  Shell Output                                    │
├──────────────────────────────────────────────────┤
│                                                  │
│  Dropping all tables .................... ✓     │
│                                                  │
│  Running migrations .................... ✓     │
│    ✓ 2024_01_01_000000_create_users             │
│    ✓ 2024_01_01_000001_create_pengguna         │
│    ✓ 2024_01_01_000002_create_tempat_wisata    │
│    ... (lebih banyak)                           │
│                                                  │
│  Running seeders ......................         │
│    ✓ CarouselSeeder                            │
│    ✓ KategoriSeeder                            │
│    ✓ TempatWisataSeeder                        │
│    ✓ UlasanSeeder                              │
│                                                  │
│  Database seeded successfully! ✓               │
│                                                  │
└──────────────────────────────────────────────────┘
```

**JIKa ada ini = BERHASIL! ✅**

---

## 🎯 RINGKASAN VISUAL

```
STEP 1         STEP 2          STEP 3
Railway   →    Project    →    Web App
Dashboard      Dashboard       Dashboard
                                   ↓
                            STEP 4: Shell Tab
                                   ↓
                            STEP 5: Copy Command
                                   ↓
                            STEP 6: Paste Command
                                   ↓
                            STEP 7: Press ENTER
                                   ↓
                     STEP 8: Tunggu Output
                                   ↓
            "Database seeded successfully!"
                                   ↓
                            BERHASIL! ✅
```

---

## 📸 SCREENSHOT LOCATIONS

**Jika kebingungan, cari:**

1. **Dashboard:** Top-left Railway logo
2. **Project:** Search atau scroll
3. **Web App:** Blue-colored service
4. **Shell:** Top tabs dalam service
5. **Command Input:** Center area dengan cursor
6. **Execute Button:** Green button atau ENTER key

---

## ✅ FINAL CHECKLIST

Sebelum tekan Execute:

- [ ] Buka https://railway.app
- [ ] Login dengan GitHub
- [ ] Buka project: 242410103011_Projek_Pweb
- [ ] Klik Web App (berwarna biru) ← PENTING!
- [ ] Buka Shell tab
- [ ] Copy command: `php artisan migrate:fresh --seed`
- [ ] Paste command di Shell
- [ ] Tekan ENTER
- [ ] Tunggu 1-2 menit
- [ ] Lihat: "Database seeded successfully!"

---

## 🚀 NEXT ACTION

```
1. Follow visual guide di atas
2. Jalankan migration di Railway Shell
3. Tunggu output "Database seeded successfully!"
4. Lapor status: "Migration selesai!"
5. Lanjut ke STEP 6: Test Aplikasi Live
```

---

**Siap? Mari mulai dari STEP 1! 🚀**
