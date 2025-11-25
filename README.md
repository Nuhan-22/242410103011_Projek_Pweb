# 🌍 Web Wisata Indonesia

**Aplikasi booking destinasi wisata Indonesia dengan Laravel 11**

> ✅ **STATUS:** Production Ready | 🚀 Live on Railway.app | 📱 Fully Tested & Verified

---

## 🚀 Quick Start

### Local Development

#### Prerequisites
- PHP 8.3+
- Composer
- Node.js & npm
- MySQL/SQLite

#### Installation

```bash
# Clone repository
git clone https://github.com/Nuhan-22/242410103011_Projek_Pweb.git
cd 242410103011_Projek_Pweb

# Install dependencies
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Database setup with seeding
php artisan migrate:fresh --seed

# Build frontend assets
npm run build

# Start development server
php artisan serve
```

**Local Access:** http://127.0.0.1:8000

### Production Deployment

See **DEPLOY.md** for Railway deployment instructions.

---

## 📋 Features

- ✅ Browse 20+ tourism destinations
- ✅ Booking system with tickets
- ✅ User authentication & profiles
- ✅ Admin dashboard with analytics
- ✅ Rating & review system
- ✅ Image gallery with storage
- ✅ Multi-role access (Admin, Owner, Visitor)
- ✅ Responsive design (Mobile & Desktop)
- ✅ 12,000+ seeded records for testing

---

## 🔐 Demo Credentials

```text
Admin: noxindocraft@gmail.com / fauzan123
User: garox@gmail.com / garox123
```

---

## 🏗️ Tech Stack

- **Backend:** Laravel 11, PHP 8.3
- **Frontend:** Vue 3, Tailwind CSS, Alpine.js
- **Database:** MySQL (Production), SQLite (Local)
- **Build Tool:** Vite
- **Charts:** Chart.js for analytics
- **Hosting:** Railway.app (Production)
- **Version Control:** GitHub (master branch)

---

## 📁 Project Structure

```text
app/              # Application logic
config/           # Configuration files
database/         # Migrations & seeders
resources/        # Views & assets
routes/           # Route definitions
public/           # Public assets
storage/          # Images & files
tests/            # Test files
```

---

## 🌐 Deployment

### Production (Railway.app)

See **DEPLOY.md** for step-by-step deployment instructions.

**Quick Summary:**
1. Go to railway.app and login with GitHub
2. Deploy 242410103011_Projek_Pweb repository
3. Run migration in Railway Shell
4. Get production URL

---

## ✅ Testing Checklist

- [x] All 32 migrations execute successfully
- [x] Database seeded with 12,000+ records
- [x] Homepage loads with carousel
- [x] Login authentication works
- [x] Destination listing displays correctly
- [x] Images load from storage
- [x] Admin dashboard accessible
- [x] Booking system functional
- [x] All routes working without errors
- [x] Production configuration ready

---

## 📞 Support & Documentation

- **Local Setup:** Read installation instructions above
- **Deployment:** See DEPLOY.md for production setup
- **Issues:** Check application error logs in storage/logs/

---

## 📄 License

MIT License - Free to use and modify.
