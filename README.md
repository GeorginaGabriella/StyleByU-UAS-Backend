# 👕 StyleByU - E-Commerce Fashion Web App

Aplikasi e-commerce berbasis web yang dibangun untuk memenuhi tugas Ujian Akhir Semester (UAS) mata kuliah Back-End Programming. StyleByU adalah sistem toko online fashion yang mengimplementasikan konsep MVC (Model-View-Controller) menggunakan framework Laravel dan database MySQL.

## 🛠️ Tech Stack
- **Language:** PHP
- **Framework:** Laravel 12
- **Database:** MySQL
- **Version Control:** Git & GitHub
- **Server:** PHP Built-in Development Server

## 👥 Anggota Kelompok

| NIM | Nama | Jabatan | Username Github | Kontribusi Utama |
| :--- | :--- | :--- | :--- | :--- |
| 535250014 | Georgina Gabriella | Ketua | [GeorginaGabriella](https://github.com/GeorginaGabriella) | Order System, Payment, Coupon, Integrasi |
| 535250017 | Garini Cinkalisty | Anggota | [GariniCinkalisty](https://github.com/GariniCinkalisty) | Cart System, Product Variant, Wishlist |
| 535250018 | Celine Aurora A. | Anggota | [envybird](https://github.com/envybird) | Auth System, Review, Notifikasi, Homepage |
| 535250029 | Felicia Angeline | Anggota | [feliciaangeline007](https://github.com/feliciaangeline007) | Product CRUD, Category, Brand, Banner |
| 535250037 | Fransiska | Anggota | [fransiska23ci12-ops](https://github.com/fransiska23ci12-ops) | Checkout, Address, Shipping, User Profile |

## ✨ Fitur Utama

### 🧑 Customer (User)
- Autentikasi (Register, Login, Logout)
- Homepage dengan Banner Promo dan Produk Terbaru
- Smart Search & Filter Produk
- Detail Produk dengan pilihan Variant (Ukuran/Warna)
- Keranjang Belanja (Add, Update Qty, Delete)
- Wishlist Produk
- Manajemen Alamat Pengiriman
- Checkout (Pilih Alamat, Kurir, Pembayaran)
- Riwayat Pesanan & Invoice Digital
- Simulasi Pembayaran (COD, QRIS, Transfer)
- Review & Rating Produk (Hanya jika pesanan Completed)
- Sistem Notifikasi User

### 🧑‍💼 Admin
- Dashboard Admin Terpisah
- Manajemen Master Data (Category, Brand, Banner)
- Manajemen Produk & Variant (Stok per Ukuran/Warna)
- Manajemen Pesanan (Lihat semua pesanan user)
- Update Status Pesanan (Pending -> Paid -> Packed -> Shipped -> Completed)
- Master Data Logistik (JNE, J&T, SiCepat)
- Manajemen Kupon Diskon

## 🗄️ Database Structure (16 Tables)
Aplikasi ini menggunakan 16 tabel utama yang saling terhubung melalui Eloquent ORM:
`users`, `products`, `categories`, `brands`, `banners`, `product_variants`, `carts`, `cart_items`, `wishlists`, `addresses`, `shipping_methods`, `payment_methods`, `orders`, `order_items`, `payments`, `coupons`, `reviews`, `notifications`.

## ⚙️ Cara Menjalankan (Localhost)

Pastikan komputer sudah terinstall **PHP, Composer, dan MySQL (XAMPP/Laragon)**.

1. **Clone Repository**
   ```bash
   git clone https://github.com/GeorginaGabriella/StyleByU.git
   cd StyleByU
   ```

2. **Install Dependencies**
   ```bash
   composer install
   ```

3. **Setup Environment File**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Konfigurasi Database**
   Buka file `.env`, lalu sesuaikan bagian berikut dengan database MySQL kamu:
   ```env
   DB_DATABASE=stylebyu_db
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Migrate & Seed Database**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

6. **Jalankan Aplikasi**
   ```bash
   php artisan serve
   ```
   Buka browser: `http://127.0.0.1:8000`

## 🔑 Akun Default Untuk Testing

Jika sudah menjalankan `php artisan db:seed`, gunakan akun berikut untuk login:

**Admin:**
- Email: `admin@stylebyu.com`
- Password: `admin123`

**User:** (Bisa langsung register baru melalui halaman web)

## 🔄 Alur Transaksi Sistem
Register/Login -> Browse Product -> Pilih Variant -> Add to Cart -> Checkout (Pilih Alamat & Ongkir) -> Proses Order -> Pembayaran (Simulasi) -> Admin Update Status -> User Terima Barang -> User Beri Review.

---
© 2026 StyleByU - Kelompok 4 Back-End Programming Universitas Tarumanagara
```
