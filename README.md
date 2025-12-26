# 🚗 Sistem Pemesanan Kendaraan

Aplikasi **Sistem Pemesanan Kendaraan** adalah aplikasi berbasis web yang digunakan untuk mengelola pemesanan kendaraan operasional dengan sistem **persetujuan berjenjang (minimal 2 level)**, dashboard grafik pemakaian kendaraan, serta laporan periodik yang dapat diexport ke Excel.

---

## 👤 Daftar Akun Login

### 🔹 Admin
| Username | Password |
|--------|----------|
| admin@gmail.com | admin123 |

### 🔹 Pihak Penyetuju
| Role | Username | Password |
|------|---------|----------|
| Approver Level 1 | ap1@gmail.com | approver2 |
| Approver Level 2 | ap2@gmail.com | approver2 |

---

## 🛠️ Spesifikasi Teknologi

- **Framework** : Laravel 10
- **Bahasa Pemrograman** : PHP
- **PHP Version** : PHP 8.1
- **Database** : MySQL
- **Database Version** : MySQL 8.0

---
## 🚀 Cara Menjalankan Aplikasi

Pastikan perangkat telah terinstall **PHP 8.1**, **Composer**, dan **MySQL**, kemudian masuk ke direktori project. Jalankan perintah berikut untuk menginstall dependency, menyiapkan konfigurasi environment, dan menghasilkan application key:

```bash
composer install
cp .env.example .env
php artisan key:generate

Selanjutnya buat database kosong di MySQL dan sesuaikan konfigurasi database pada file .env. Aplikasi ini tidak menggunakan file database (.sql) karena struktur database dan data awal dibuat otomatis menggunakan Laravel Migration dan Seeder. Jalankan perintah berikut untuk membuat tabel sekaligus mengisi data dummy seperti Admin, Pihak Penyetuju, Kendaraan, dan Driver:
php artisan migrate --seed
Setelah proses selesai, jalankan aplikasi dengan perintah:
php artisan serve
Akses aplikasi melalui browser pada alamat http://127.0.0.1:8000. Login menggunakan akun dummy yang tersedia pada README, setelah berhasil login pengguna akan otomatis diarahkan ke halaman dashboard sesuai dengan perannya. Untuk keluar dari aplikasi, klik ikon profile di pojok kanan atas, kemudian pilih menu Logout pada dropdown yang muncul.


