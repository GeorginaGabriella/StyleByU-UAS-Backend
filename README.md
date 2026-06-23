---

# 👕 StyleByU - E-Commerce Fashion Web App

Aplikasi e-commerce berbasis web yang dibangun untuk memenuhi tugas Ujian Akhir Semester (UAS) mata kuliah Back-End Programming. StyleByU adalah sistem toko online fashion yang mengimplementasikan konsep MVC (Model-View-Controller) menggunakan framework Laravel dan database MySQL.

---

## 🛠️ Tech Stack

* **Language:** PHP
* **Framework:** Laravel 12
* **Database:** MySQL
* **Version Control:** Git & GitHub
* **Server:** PHP Built-in Development Server

---

## 👥 Anggota Kelompok

| NIM       | Nama               | Jabatan | Username Github     | Kontribusi Utama                          |
| :-------- | :----------------- | :------ | :------------------ | :---------------------------------------- |
| 535250014 | Georgina Gabriella | Ketua   | GeorginaGabriella   | Order System, Payment, Coupon, Integrasi  |
| 535250017 | Garini Cinkalisty  | Anggota | GariniCinkalisty    | Cart System, Product Variant, Wishlist    |
| 535250018 | Celine Aurora A.   | Anggota | envybird            | Auth System, Review, Notifikasi, Homepage |
| 535250029 | Felicia Angeline   | Anggota | feliciaangeline007  | Product CRUD, Category, Brand, Banner     |
| 535250037 | Fransiska          | Anggota | fransiska23ci12-ops | Checkout, Address, Shipping, User Profile |

---

## ✨ Fitur Utama

### 🧑 Customer (User)

* Autentikasi (Register, Login, Logout)
* Homepage dengan Banner Promo dan Produk Terbaru
* Smart Search & Filter Produk
* Detail Produk dengan Variant (Ukuran/Warna)
* Keranjang Belanja (Add, Update Qty, Delete)
* Wishlist Produk
* Manajemen Alamat Pengiriman
* Checkout (Alamat, Kurir, Pembayaran)
* Riwayat Pesanan & Invoice
* Simulasi Pembayaran (COD, QRIS, Transfer)
* Review & Rating Produk
* Notifikasi User

---

### 🧑‍💼 Admin

* Dashboard Admin
* Manajemen Produk, Category, Brand, Banner
* Manajemen Variant Produk (Size & Color)
* Manajemen Pesanan (Order System)
* Update Status Pesanan (Pending → Paid → Packed → Shipped → Completed)
* Master Data Shipping
* Manajemen Kupon Diskon

---

## 🗄️ Database Structure (16 Tables)

users, products, categories, brands, banners, product_variants, carts, cart_items, wishlists, addresses, shipping_methods, payment_methods, orders, order_items, payments, coupons, reviews, notifications

---

## ⚙️ Cara Menjalankan Project

### 1. Clone Repository

```bash
git clone https://github.com/GeorginaGabriella/StyleByU.git
cd StyleByU
```

### 2. Install Dependency

```bash
composer install
```

### 3. Setup Environment

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Atur Database (.env)

```
DB_DATABASE=stylebyu_db
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Migration & Seed

```bash
php artisan migrate
php artisan db:seed
```

### 6. Jalankan Server

```bash
php artisan serve
```

Buka:
[http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## 🔑 Login Default

**Admin**

* email: [admin@stylebyu.com](mailto:admin@stylebyu.com)
* password: admin123

**User**

* Register langsung di website

---

## 🔄 Flow Sistem

Login/Register → Browse Product → Select Variant → Add to Cart → Checkout → Order Created → Payment Simulation → Admin Update Status → Delivered → Review Product

---

© 2026 StyleByU - Kelompok 4 Back-End Programming Universitas Tarumanagara

---