# Sistem API Manajemen Inventaris Gudang

##### Proyek ini untuk memenuhi tugas Ujian Akhir Semester Mata Kuliah Web Services

Anggota Kelompok :

> 22003030017 - Arya Hidayat Pratama

> 2203030011 - Almer Ibra Maulana

> 2203030005 - Yoga Dui Azhari

## Deskripsi Singkat  
Sistem API untuk manajemen inventaris gudang berbasis Laravel dengan autentikasi JWT. Sistem ini memungkinkan pengguna untuk mengelola produk, kategori, gudang, stok, serta melakukan pencatatan perpindahan barang antar gudang.

---

## Cara Menjalankan Sistem

### 1. Clone Repository
```bash
git clone https://github.com/username/repo-inventaris.git
cd repo-inventaris
```
### 2. Install Dependencies (Composer)
```bash
composer install
composer require tymon/jwt-auth
```
### 3. Setup JWT Authentication
```bash
php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
php artisan jwt:secret
```
### 4. Konfigurasi .env
```bash
cp .env.example .env
php artisan key:generate
```
### Sesuaikan konfigurasi database di file .env:
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=wms
DB_USERNAME=root
DB_PASSWORD=
```
### 5. Setup Database
```bash
php artisan migrate
php artisan db:seed
```
### 6. Jalankan Server
```bash
php artisan serve
```
### Server akan berjalan di:
http://localhost:8000
---

### Akun Uji Coba
- **Email**: admin@example.com
- **Password**: password

### API Endpoint
Base URL: http://localhost:8000/api

### 🔐 Autentikasi
- POST /login - Login pengguna (mendapatkan token)
- POST /register - Registrasi pengguna baru
- POST /logout - Logout

### 👤 User
- GET /users - Melihat daftar user (admin)
- POST /users - Tambah user baru

### 📦 Produk & Kategori
- GET /products - Lihat semua produk
- POST /products - Tambah produk baru
- GET /categories - Lihat semua kategori
- POST /categories - Tambah kategori baru

### 🏬 Gudang
- GET /warehouses - Lihat daftar gudang
- POST /warehouses - Tambah gudang baru
### 📊 Inventaris
- GET /inventories - Lihat stok produk di gudang

### 🔁 Pergerakan Stok
- GET /stock-movements - Lihat histori pergerakan stok
- POST /stock-movements - Tambah pergerakan stok (in, out, transfer)

### Dokumentasi API Menggunakan PostMan
https://documenter.getpostman.com/view/41485287/2sB34mgx6U

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
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
