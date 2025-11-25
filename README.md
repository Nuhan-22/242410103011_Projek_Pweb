# 🌍 Web Wisata Indonesia

**Aplikasi booking destinasi wisata Indonesia dengan Laravel 11**

---

## 🚀 Quick Start

### Prerequisites
- PHP 8.3+
- Composer
- Node.js & npm
- MySQL/SQLite

### Installation

```bash
# Clone & setup
git clone https://github.com/Nuhan-22/242410103011_Projek_Pweb.git
cd 242410103011_Projek_Pweb

# Install dependencies
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Database
php artisan migrate:fresh --seed

# Build assets
npm run build

# Serve
php artisan serve
```

**Access:** http://localhost:8000

---

## 📋 Features

✅ Browse 20+ tourism destinations  
✅ Booking system with tickets  
✅ User authentication & profiles  
✅ Admin dashboard  
✅ Rating & review system  
✅ Image gallery  
✅ Multi-role access (Admin, Owner, Visitor)

---

## 🔐 Demo Credentials

```
Admin: noxindocraft@gmail.com / fauzan123
User: garox@gmail.com / garox123
```

---

## 🏗️ Tech Stack

- **Backend:** Laravel 11, PHP 8.3
- **Frontend:** Vue 3, Tailwind CSS, Alpine.js
- **Database:** MySQL (Production), SQLite (Local)
- **Assets:** Vite, Chart.js
- **Hosting:** Railway.app

---

## 📁 Project Structure

```
app/              # Application logic
config/           # Configuration files
database/         # Migrations & seeders
resources/        # Views & assets
routes/           # Route definitions
public/           # Public assets
storage/          # Images & files
```

---

## 🌐 Deployment

### Railway

1. Push to GitHub
2. Connect GitHub to Railway
3. Run migration in Shell: `php artisan migrate:fresh --seed`
4. Access production URL

---

## 📞 Support

For issues & questions, check the code or review the application structure.

---

## 📄 License

MIT License - Free to use & modify.
