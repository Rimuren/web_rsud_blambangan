# Web RSUD Blambangan

Project website **RSUD Blambangan** yang dibangun menggunakan framework **Laravel** dengan sistem **Role-Based Access Control (RBAC)** untuk manajemen hak akses pengguna.

---

## 🧰 Teknologi yang Digunakan

| Kategori | Teknologi |
|----------|-----------|
| **Framework** | Laravel 12 |
| **PHP Version** | PHP 8.2.* |
| **Authentication** | Laravel Fortify |
| **Authorization** | Spatie Laravel Permission (RBAC) |
| **Frontend** | Blade Template Engine + Livewire 4 |
| **UI Component** | Flux UI 2.9 |
| **CSS Framework** | Tailwind CSS 4 |
| **Build Tool** | Vite |
| **Database** | SQLite (default) / MySQL / MariaDB |
| **Package Manager** | Composer & NPM |

---

## ⚙️ Requirements

Sebelum menjalankan project, pastikan sudah menginstall:

- PHP >= 8.2
- Composer
- Node.js >= 18
- NPM
- SQLite / MySQL / MariaDB (sesuai kebutuhan)
- Git

---

## 📦 Installation

Clone repository terlebih dahulu:

```bash
git clone https://github.com/Rimuren/web_rsud_blambangan.git
```

Masuk ke folder project:

```bash
cd web_rsud_blambangan
```

Install dependency PHP (Laravel):

```bash
composer install
```

Install dependency frontend:

```bash
npm install
```

---

## 🔧 Environment Setup

Copy file `.env`:

```bash
cp .env.example .env
```

Atau buat file `.env` baru dan isi dengan konfigurasi berikut:

```env
APP_NAME="RSUD Blambangan"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug
```

Generate application key:

```bash
php artisan key:generate
```

---

## 🗄️ Database Configuration

### Menggunakan MySQL

Edit file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rsud_blambangan
DB_USERNAME=root
DB_PASSWORD=
```

Buat database di MySQL terlebih dahulu:

```bash
mysql -u root -p -e "CREATE DATABASE rsud_blambangan;"
```

Lalu jalankan migration:

```bash
php artisan migrate
```

Lalu jalankan seeder:

```bash
php artisan db:seed
```

atau jika ingin melakukan reset database sekaligus menjalankan seeder:
```bash
php artisan migrate:fresh --seed
```

---

## ▶️ Cara Menjalankan Project

### Mode Development

Jalankan server Laravel dan Vite secara bersamaan:

```bash
composer run dev
```

Atau jalankan secara terpisah:

**Terminal 1 - Server Laravel:**

```bash
php artisan serve
```

**Terminal 2 - Vite (Frontend):**

```bash
npm run dev
```

Akses aplikasi di browser:

```
http://127.0.0.1:8000
```

### Mode Production

Build frontend:

```bash
npm run build
```

Jalankan server:

```bash
php artisan serve
```

