# Panduan Instalasi Proyek Laravel

## Persyaratan Sistem

Pastikan sistem Anda telah menginstal:

-   PHP ≥ 8.0
-   Composer
-   MySQL

---

## 1. Clone Repository

Unduh atau clone proyek Laravel dengan perintah berikut:

```bash
 git clone
 example git clone https://link-ke-repositori.com
```

Lalu masuk ke folder proyek:

```bash
 cd nama_folder_proyek
```

---

## 2. Install Dependensi

Jalankan perintah berikut untuk menginstal semua dependensi PHP:

```bash
 composer install
```

## 3. Konfigurasi Environment

Buat file `.env` dengan menyalin dari template:

```bash
 cp .env.example .env
```

Edit file `.env` dan sesuaikan konfigurasi database:

```env
 DB_CONNECTION=mysql
 DB_HOST=127.0.0.1
 DB_PORT=3306
 DB_DATABASE=nama_database
 DB_USERNAME=root
 DB_PASSWORD=
```

---

## 4. Impor Database

Jika terdapat file database dalam format `Database_ekspor.sql`, impor ke MySQL:

Gunakan **phpMyAdmin** untuk impor secara manual.

Jika database kosong dan perlu migrasi, jalankan:

```bash
 php artisan migrate --seed
```

---

## 5. Menjalankan Aplikasi

Gunakan perintah berikut untuk menjalankan server lokal Laravel:

```bash
 php artisan serve
```

Akses aplikasi di browser dengan URL:

```
 http://127.0.0.1:8000
```

Proyek Laravel Anda sekarang telah berhasil diinstal dan siap digunakan!
