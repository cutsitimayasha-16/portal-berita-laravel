# Portal Berita (Laravel)

Tugas praktikum Pemrograman Web, Prodi Teknologi Informasi UIN Ar-Raniry Banda Aceh.
Aplikasi portal berita sederhana dengan fitur CRUD artikel, autentikasi, dan tampilan yang sudah dipercantik.

## Cara menjalankan

1. composer install
2. copy .env.example .env
3. php artisan key:generate
4. php artisan migrate --seed
5. php artisan serve

Akun uji: praktikan@example.com / password

## Bug yang ditemukan

- **Pagination error `View [default] not found`**
  - Lokasi: resources/views/articles/index.blade.php, baris 48
  - Penyebab: tampilan `pagination::default` tidak tersedia di Laravel 13
  - Perbaikan: diganti menjadi `pagination::bootstrap-4`