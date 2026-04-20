# sistemrs-laravel
Aplikasi web manajemen rumah sakit yang dibangun dengan Laravel 12. Sistem ini punya dua sisi, halaman publik untuk masyarakat umum dan panel admin untuk pengelolaan data internal rumah sakit.

## Fitur

HALAMAN PUBLIK

Pengunjung bisa mengakses informasi rumah sakit tanpa perlu login. Tersedia profil dan jadwal dokter, daftar departemen atau poli, formulir pendaftaran pasien online, artikel kesehatan, informasi fasilitas seperti IGD dan rawat inap, serta halaman sejarah dan visi misi rumah sakit.

PANEL ADMIN

Setelah login, admin bisa mengelola seluruh data lewat dashboard. Mulai dari data pasien, dokter, departemen, hingga pendaftaran dan antrian. Setiap modul ada fitur export ke Excel. Admin juga bisa membuat, mengedit, dan menghapus artikel kesehatan.

## Tech Stack

| | |
|---|---|
| Framework | Laravel 12 |
| PHP | 8.2 ke atas |
| Database | MySQL |
| Frontend Build | Vite |
| Testing | PHPUnit 11 |

## Persyaratan

Pastikan komputer atau server sudah terinstal hal berikut sebelum mulai.

- PHP 8.2 ke atas dengan extension pdo_mysql, mbstring, openssl, tokenizer, dan xml
- Composer
- Node.js dan NPM
- MySQL

## Instalasi

1. Clone repository

```bash
git clone https://github.com/Yusufffasdw/sistemrs-laravel.git
cd sistemrs-laravel
```

2. Install dependensi

```bash
composer install
npm install
```

3. Salin file konfigurasi dan generate key

```bash
cp .env.example .env
php artisan key:generate
```

4. Sesuaikan konfigurasi database di file .env

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sistemrs
DB_USERNAME=root
DB_PASSWORD=
```

5. Jalankan migrasi database

```bash
php artisan migrate
```

6. Build aset frontend

```bash
npm run build
```

7. Jalankan server

```bash
php artisan serve
```

Aplikasi bisa diakses di http://localhost:8000

Atau kalau mau praktis, langkah 2 sampai 6 bisa dijalankan sekaligus dengan perintah berikut.

```bash
composer run setup
```

## Penggunaan

Untuk membuat akun admin, buka halaman register di /register lalu isi data yang diminta. Setelah itu login lewat /login untuk masuk ke panel admin.

Untuk pendaftaran pasien, tidak perlu login. Pasien bisa langsung mengisi formulir di /pasien/create dari halaman publik.

## Struktur Database

| Tabel | Keterangan |
|---|---|
| users | Akun pengguna atau admin sistem |
| departemen | Data departemen atau poli |
| dokter | Data dokter termasuk spesialisasi, foto, dan status aktif |
| pasien | Data pasien termasuk rekam medis, identitas, dan riwayat penyakit |
| pendaftaran | Data antrian dan pendaftaran pasien |
| artikel | Konten artikel kesehatan |
| beranda | Konten dinamis halaman beranda |

## Struktur Direktori

```
sistemrs-laravel/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php
│   │   │   ├── BerandaController.php
│   │   │   ├── DashboardController.php
│   │   │   ├── DokterController.php
│   │   │   ├── PasienController.php
│   │   │   ├── PendaftaranController.php
│   │   │   ├── DepartemenController.php
│   │   │   └── ArtikelController.php
│   │   └── Middleware/
│   │       └── CheckAdminLogin.php
│   └── Models/
│       ├── User.php
│       ├── Dokter.php
│       ├── Pasien.php
│       ├── Pendaftaran.php
│       ├── Departemen.php
│       └── Artikel.php
├── database/
│   └── migrations/
├── routes/
│   └── web.php
└── resources/
    └── views/
```

## Route Utama

PUBLIK (tanpa login)

| Method | URL | Keterangan |
|---|---|---|
| GET | /jadwaldokter | Jadwal dokter |
| GET | /daftardokter | Daftar dan profil dokter |
| GET | /pasien/create | Formulir pendaftaran pasien |
| GET | /artikel | Daftar artikel kesehatan |
| GET | /fasilitas | Halaman fasilitas |
| GET | /instalasi-igd | Halaman IGD |
| GET | /instalasi-rawat-inap | Halaman rawat inap |

ADMIN (memerlukan login)

| Method | URL | Keterangan |
|---|---|---|
| GET | /dashboard | Dashboard admin |
| GET/POST/PUT/DELETE | /pasien | Manajemen data pasien |
| GET/POST/PUT/DELETE | /dokter | Manajemen data dokter |
| GET/POST/PUT/DELETE | /departemen | Manajemen departemen |
| GET/POST/PUT/DELETE | /pendaftaran | Manajemen pendaftaran |
| PATCH | /pendaftaran/{id}/status | Update status antrian |
| GET | /pasien/export | Export data pasien ke Excel |
| GET | /dokter/export | Export data dokter ke Excel |

## Testing

```bash
php artisan test
```

## Lisensi

Proyek ini dikembangkan sebagai sistem informasi manajemen rumah sakit. Bebas digunakan dan dimodifikasi sesuai kebutuhan.
