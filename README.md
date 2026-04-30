# Web RSUD Blambangan

Project website **RSUD Blambangan** yang dibangun menggunakan framework **Laravel** dengan sistem **Role-Based Access Control (RBAC)** untuk manajemen hak akses pengguna.

---

## 🧰 Teknologi yang Digunakan

| Kategori            | Teknologi                          |
| ------------------- | ---------------------------------- |
| **Framework**       | Laravel 12                         |
| **PHP Version**     | PHP 8.2.*                          |
| **Authentication**  | Laravel Fortify                    |
| **Authorization**   | Spatie Laravel Permission (RBAC)   |
| **Frontend**        | Blade Template Engine + Livewire 4 |
| **UI Component**    | Flux UI 2.9                        |
| **CSS Framework**   | Tailwind CSS 4                     |
| **Build Tool**      | Vite                               |
| **Database**        | SQLite (default) / MySQL / MariaDB |
| **Package Manager** | Composer & NPM                     |

---

## ⚙️ Requirements

Sebelum menjalankan project, pastikan sudah menginstall:

* PHP >= 8.2
* Composer
* Node.js >= 18
* NPM
* SQLite / MySQL / MariaDB (sesuai kebutuhan)
* Git

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

Install dependency:

```bash
composer install
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

Jalankan migration & seeder:

```bash
php artisan migrate
php artisan db:seed
```

Atau reset database sekaligus seed:

```bash
php artisan migrate:fresh --seed
```

---

## 🔄 Custom Artisan Commands

Project ini menyediakan beberapa perintah khusus untuk sinkronisasi data:

```bash
php artisan sync:all
php artisan sync:dokter
php artisan sync:poliklinik
```

### Penjelasan:

* `sync:all` → sinkronisasi semua data (dokter + poliklinik)
* `sync:dokter` → sinkronisasi data dokter
* `sync:poliklinik` → sinkronisasi data poliklinik

---

## ⚡ Queue Worker

Jika project menggunakan queue (misalnya untuk proses sync atau job async), jalankan:

```bash
php artisan queue:work
```

---

## ▶️ Cara Menjalankan Project

### Mode Development

Jalankan semua service sekaligus:

```bash
composer run dev
```

Atau manual:

**Terminal 1 - Laravel:**

```bash
php artisan serve
```

**Terminal 2 - Vite:**

```bash
npm run dev
```

---

### Mode Production

Build frontend terlebih dahulu:

```bash
npm run build
```

Lalu jalankan server:

```bash
php artisan serve
```

---

## 🌐 Akses Aplikasi

```
http://127.0.0.1:8000
```

---

## 📝 Catatan

* Pastikan queue worker berjalan jika menggunakan fitur async
* Jalankan command sync jika data dokter/poliklinik tidak muncul
* Gunakan `.env` sesuai environment (local/production)

---
