# 🛒 NotSoSimpleShop

A Laravel-based e-commerce application built with Laravel, Livewire, WireUI, and MySQL.  
It includes media handling powered by Spatie Media Library for images and PDF processing.

---

# 🚀 Tech Stack

- Laravel
- Livewire
- WireUI
- MySQL
- Spatie Media Library

---

# ⚠️ Requirements

Before running this project, make sure your environment includes:

## Core Requirements
- PHP (compatible with the Laravel version used in this project)
- Composer
- Node.js + npm
- MySQL (or compatible database)

---

## Media Processing Requirements (IMPORTANT)

This project uses Spatie Media Library for handling uploads, images, and PDF previews.

The following system dependencies are required for full functionality:

### PHP Extensions
- GD (php-gd) → image processing
- Imagick (php-imagick) → advanced image manipulation

### System Tools
- Ghostscript → required for PDF rendering and preview generation

> ⚠️ If any of these are missing, image conversions or PDF previews may fail.

---

# 📦 Installation Guide

## 1. Clone the repository

```bash
git clone <repository-url>
cd NotSoSimpleShop
```

## 2. Install PHP dependencies

```bash
composer install
```

## 3. Install frontend dependencies

```bash
npm install
```

## 4. Setup environment file

```bash
cp .env.example .env
php artisan key:generate
```

Configure your database in `.env`:

```env
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

## 5. Run migrations

```bash
php artisan migrate
```

(Optional seed data if available)

```bash
php artisan db:seed
```

## 6. Link storage

```bash
php artisan storage:link
```

## 7. Build frontend assets

Development:

```bash
npm run dev
```

Production:

```bash
npm run build
```

## 8. Start server

```bash
php artisan serve
```

Open:
http://127.0.0.1:8000

---

# 🧩 Media Library Notes

Uses Spatie Media Library for uploads and conversions.

Requires:
- GD
- Imagick
- Ghostscript

---

# 🛠️ Troubleshooting

- Image issues → check GD + Imagick
- PDF preview issues → check Ghostscript
- Assets not updating → run npm run dev
