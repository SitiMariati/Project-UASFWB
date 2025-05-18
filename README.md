<!-- <p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development/)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT). -->

P<div align="center">

# 🎬 Pembelian Tiket Bioskop Online
<br>

<img src="LOGO UNSULBAR.jpg" alt="Logo Kampus" width="100">

<br></br>

_Siti Mariati_  
_D0223322_

<br>
**Pembelian Tiket Bioskop Online** adalah aplikasi berbasis web untuk mempermudah pengguna dalam melihat jadwal film dan memesan tiket bioskop secara online. Aplikasi ini mendukung berbagai peran pengguna dengan fitur dan hak akses yang sesuai, serta memanfaatkan relasi antar tabel untuk pengelolaan data film, jadwal tayang, dan transaksi pemesanan.

---

## 🔐 Role dan Fitur-fiturnya

### 🛡️ Admin
- Mengelola data film
- Mengatur jadwal tayang film
- Mengelola pengguna dan petugas

### 📋 Petugas
- Melihat dan mencetak data pesanan tiket
- Membantu proses pembayaran dan validasi tiket

### 👥 Pengguna
- Melihat daftar film dan jadwal tayang
- Melakukan pemesanan tiket
- Melihat riwayat pesanan dan statusnya

---

## 🗃️ Tabel-tabel Database

### Tabel `pengguna`

| Nama Field |   Tipe Data   |              Keterangan          |
|------------|---------------|----------------------------------|
| id         | bigIncrements | Primary key                      |
| nama       | string        | Nama lengkap pengguna            |
| email      | string        | Email unik untuk login           |
| password   | string        | Kata sandi terenkripsi           |
| role       | enum          | ['admin', 'petugas', 'pengguna'] |

---

### Tabel `user_profiles`

|   Nama Field  |   Tipe Data   |      Keterangan        |
|---------------|---------------|------------------------|
| id            | bigIncrements | Primary key            |
| pengguna_id   | foreignId     | FK ke tabel pengguna   |
| alamat        | string        | Alamat pengguna        |
| no_hp         | string        | Nomor HP               |
| tanggal_lahir | date          | Tanggal lahir          |
| timestamps    | timestamps    | Created_at /Updated_at |

---

### Tabel `film`

| Nama Field |   Tipe Data   |      Keterangan         |
|------------|---------------|-------------------------|
| id         | bigIncrements | Primary key             |
| judul      | string        | Judul film              |
| genre      | string        | Genre film              |
| durasi     | integer       | Durasi film             |
| deskripsi  | text          | Deskripsi  film         |
| timestamps | timestamps    | Created_at & Updated_at |

---

### Tabel `jadwal_tayang`

| Nama Field | Tipe Data     |       Keterangan        |
|------------|---------------|-------------------------|
| id         | bigIncrements | Primary key             |
| film_id    | foreignId     | FK ke tabel film        |
| tanggal    | date          | Tanggal tayang          |
| jam_tayang | time          | Jam tayang              |
| harga      | integer       | Harga tiket             |
| timestamps | timestamps    | Created_at & Updated_at |

---

### Tabel `pesanan`

| Nama Field       | Tipe Data     |              Keterangan               |
|------------      |-----------    |---------------------------------------|
| id               | bigIncrements | Primary key                           |
| user_profiles_id | foreignId     | FK ke tabel user_profiles             |
| jadwal_tayang_id | foreignId     | FK ke tabel jadwal_tayang             |
| jumlah_tiket     | integer       | Jumlah tiket dipesan                  |
| total_harga      | integer       | Total harga yang harus dibayar        |
| status           | enum          | ['menunggu', 'dibayar', 'dibatalkan'] |
| timestamps       | timestamps    | Created_at & Updated_at               |

---

### Tabel Pivot `film_pengguna` (Many to Many)

| Nama Field  |   Tipe Data   |      Keterangan         |
|-------------|---------------|-------------------------|
| id          | bigIncrements | Primary key             |
| pengguna_id | foreignId     | FK ke tabel pengguna    |
| film_id     | foreignId     | FK ke tabel film        |
| timestamps  | timestamps    | Created_at & Updated_at |

---

## 🔗 Relasi Antar Tabel

- `pengguna` ↔ `user_profiles` = One to One
- `film` ↔ `jadwal_tayang` = One to Many
- `user_profiles` ↔ `pesanan` = One to Many
- `jadwal_tayang` ↔ `pesanan` = One to Many
- `pengguna` ↔ `film` = Many to Many (melalui `film_pengguna`)

---



## 🎯 Tujuan Sistem

Sistem ini dirancang untuk:
- Memudahkan proses pembelian tiket bioskop secara online
- Memberikan pengalaman pengguna yang efisien tanpa harus datang langsung ke loket
- Memberikan kontrol data film dan jadwal tayang kepada admin dan petugas

---
