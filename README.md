# Laravel Project

Ini adalah proyek Laravel mentah yang dapat Anda gunakan sebagai referensi atau dasar pengembangan. Ikuti langkah-langkah berikut untuk mengunduh dan menjalankan proyek ini di mesin lokal Anda.

## Persyaratan

Pastikan Anda telah menginstal:
- PHP (versi 8.x atau lebih baru)
- Composer
- Git
- MySQL atau MariaDB untuk database

## Instalasi

1. **Clone Repository**  
   Clone repository ini ke direktori lokal Anda:
   ```bash
   git clone https://github.com/username/nama-repository.git

   cd nama-repository

   composer install

2. **Buka file `.env` dan masukkan konfigurasi database Anda:**  

3. **Buat kunci aplikasi dengan menjalankan perintah berikut:**  
`php artisan key:generate`

4. **Jika proyek ini memiliki migrasi, jalankan migrasi database:**  
`php artisan migrate`

5. **Terakhir, jalankan server pengembangan Laravel:**  
`php artisan serve`

