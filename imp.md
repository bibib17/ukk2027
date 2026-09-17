# Implementation Plan: Taking Order Cafe Web Application (UKK 2027)

Membangun aplikasi **Taking Order Cafe** berbasis web menggunakan **PHP Native, PDO, MySQL, dan Bootstrap 5** sesuai dengan spesifikasi [prd.md](file:///c:/xampp/htdocs/ukk2027/prd.md) dan kriteria uji kompetensi [soal.md](file:///c:/xampp/htdocs/ukk2027/soal.md). Rencana ini juga mencakup pembuatan modul pembelajaran lengkap [tutorial.md](file:///c:/xampp/htdocs/ukk2027/tutorial.md) dari awal hingga akhir per komponen sistem agar mudah dipelajari oleh siswa SMK.

---

## User Review Required

> [!NOTE]
> Sistem dibangun dengan arsitektur **PHP Native + PDO** dan **Bootstrap 5** yang bersih, modular, dan terstruktur sesuai standar UKK (Uji Kompetensi Keahlian) Asisten Pengembang Web.
> Semua alur role (Admin dan Customer) diproteksi dengan session-based authorization dan prepared statements untuk keamanan.

---

## Proposed Architecture & Structure

```text
c:/xampp/htdocs/ukk2027/
├── admin/
│   ├── dashboard.php          # Dashboard statistik Admin
│   ├── orders.php             # Pengelolaan semua data pesanan
│   ├── order-detail.php       # Detail pesanan & perubahan status
│   └── reports.php            # Laporan penjualan & filter tanggal
├── customer/
│   ├── dashboard.php          # Dashboard customer & quick links
│   ├── menu.php               # Katalog menu cafe berbasis card & kategori
│   ├── order.php              # Form pemesanan (taking order) multi-item & kalkulasi
│   └── orders.php             # Riwayat pesanan customer & detail
├── auth/
│   ├── login.php              # Form & proses login (Admin & Customer)
│   ├── register.php           # Form & proses registrasi customer baru
│   └── logout.php             # Proses logout & destroy session
├── config/
│   └── database.php           # Koneksi PDO ke MySQL (taking_order_cafe)
├── includes/
│   ├── header.php             # Template header & navigation bar responsive
│   ├── footer.php             # Template footer & script loader
│   ├── auth.php               # Middleware cek sesi & role access guard
│   └── functions.php          # Helper (format rupiah, sanitize, status badge, flash)
├── assets/
│   ├── css/style.css          # Custom styling tema Minimalist Cafe
│   ├── js/script.js           # Interaksi kalkulasi order, konfirmasi, filter
│   └── img/                   # Aset gambar menu & logo cafe
├── index.php                  # Landing page publik & redirect router
├── database.sql               # Skrip DDL & DML database taking_order_cafe
├── README.md                  # Dokumentasi instalasi, konfigurasi, & kredensial
└── tutorial.md                # Panduan langkah-demi-langkah pembuatan per komponen
```

---

## Proposed Changes

### 1. Database & Konfigurasi
#### [NEW] [database.sql](file:///c:/xampp/htdocs/ukk2027/database.sql)
- Pembuatan database `taking_order_cafe`.
- Tabel `users` (`id`, `name`, `username`, `password`, `role`, `created_at`).
- Tabel `menus` (`id`, `name`, `category`, `description`, `price`, `image`, `status`, `created_at`).
- Tabel `orders` (`id`, `order_code`, `user_id`, `total`, `status`, `created_at`).
- Tabel `order_details` (`id`, `order_id`, `menu_id`, `price`, `quantity`, `subtotal`).
- Foreign keys & indexes relasi tabel.
- Seeding data default:
  - Admin: `admin` / `password`
  - Customer: `customer` / `password`
  - Menu: Makanan, Minuman, dan Snack lengkap beserta harga dan foto/ilustrasi.

#### [NEW] [config/database.php](file:///c:/xampp/htdocs/ukk2027/config/database.php)
- Koneksi PDO dengan penanganan error Exception dan fetch mode `FETCH_ASSOC`.
- Variabel konfigurasi host, dbname, user, pass yang mudah disesuaikan di XAMPP.

---

### 2. Helper & Layout Shared Components
#### [NEW] [includes/functions.php](file:///c:/xampp/htdocs/ukk2027/includes/functions.php)
- `sanitize()` untuk mencegah XSS.
- `format_rupiah()` untuk standarisasi format mata uang IDR.
- `render_status_badge()` untuk badge Bootstrap warna-warni status (Menunggu, Diproses, Selesai, Dibatalkan).
- `set_flash_message()` & `get_flash_message()` untuk alert Bootstrap dinamis.
- `generate_order_code()` untuk kode pesanan unik berformat `ORD-YYYYMMDD-XXXX`.

#### [NEW] [includes/auth.php](file:///c:/xampp/htdocs/ukk2027/includes/auth.php)
- `check_login()` mengecek apakah user sudah login.
- `require_role($allowed_roles)` memblokir akses jika role tidak cocok.
- `current_user()` mengembalikan data user yang aktif.

#### [NEW] [includes/header.php](file:///c:/xampp/htdocs/ukk2027/includes/header.php)
- Load Bootstrap 5 CSS & Bootstrap Icons CDN.
- Navbar responsif dengan brand cafe, menu navigasi sesuai role (Admin/Customer/Guest), dan info user login.

#### [NEW] [includes/footer.php](file:///c:/xampp/htdocs/ukk2027/includes/footer.php)
- Footer cafe bersih & Copyright.
- Load Bootstrap 5 JS Bundle & `assets/js/script.js`.

---

### 3. Autentikasi
#### [NEW] [auth/login.php](file:///c:/xampp/htdocs/ukk2027/auth/login.php)
- Tampilan kartu login modern dan validasi form.
- Verifikasi password hash via `password_verify()`.
- Set session dan redirect sesuai role:
  - `admin` $\rightarrow$ `admin/dashboard.php`
  - `customer` $\rightarrow$ `customer/dashboard.php`

#### [NEW] [auth/register.php](file:///c:/xampp/htdocs/ukk2027/auth/register.php)
- Form registrasi pelanggan (Nama, Username, Password, Konfirmasi Password).
- Validasi username unik dan kecocokan password.
- Insert customer baru dengan password hash aman.

#### [NEW] [auth/logout.php](file:///c:/xampp/htdocs/ukk2027/auth/logout.php)
- Session destroy & redirect ke `auth/login.php` dengan notifikasi sukses.

---

### 4. Modul Landing Page Publik
#### [NEW] [index.php](file:///c:/xampp/htdocs/ukk2027/index.php)
- Hero section "Taking Order Cafe", cuplikan menu favorit, tombol Login / Register / Pesan Sekarang.
- Redirect otomatis jika user sudah login.

---

### 5. Modul Pelanggan (Customer)
#### [NEW] [customer/dashboard.php](file:///c:/xampp/htdocs/ukk2027/customer/dashboard.php)
- Welcome card, ringkasan pesanan aktif, tombol cepat menuju katalog menu & riwayat pesanan.

#### [NEW] [customer/menu.php](file:///c:/xampp/htdocs/ukk2027/customer/menu.php)
- Katalog menu makanan & minuman dengan tab kategori filter (Semua, Makanan, Minuman, Snack).
- Kartu menu interaktif dengan badge harga, deskripsi, dan tombol "Tambah ke Pesanan".

#### [NEW] [customer/order.php](file:///c:/xampp/htdocs/ukk2027/customer/order.php)
- Halaman Taking Order: pemilihan menu, penentuan kuantitas, kalkulasi subtotal & grand total secara otomatis.
- Proses penyimpanan pesanan dengan PDO Transaction (insert ke `orders` dan `order_details`).
- Tampilan konfirmasi order berhasil beserta nomor order.

#### [NEW] [customer/orders.php](file:///c:/xampp/htdocs/ukk2027/customer/orders.php)
- Tabel daftar riwayat pesanan milik customer bersangkutan.
- Modal / accordion rincian menu yang dipesan, harga, status, dan waktu pesanan.

---

### 6. Modul Administrator (Admin)
#### [NEW] [admin/dashboard.php](file:///c:/xampp/htdocs/ukk2027/admin/dashboard.php)
- Kartu statistik: Total Pesanan, Menunggu, Diproses, Selesai, Total Pendapatan.
- Tabel 5 pesanan terbaru yang butuh perhatian cepat.

#### [NEW] [admin/orders.php](file:///c:/xampp/htdocs/ukk2027/admin/orders.php)
- Pengelolaan seluruh pesanan pelanggan.
- Filter status (Semua, Menunggu, Diproses, Selesai, Dibatalkan).
- Aksi cepat ubah status langsung atau lihat rincian.

#### [NEW] [admin/order-detail.php](file:///c:/xampp/htdocs/ukk2027/admin/order-detail.php)
- Detail lengkap item pesanan, identitas pelanggan, waktu, total transaksi.
- Form pembaruan status pesanan (Menunggu $\rightarrow$ Diproses $\rightarrow$ Selesai / Dibatalkan).
- Tampilan struk / rincian yang siap dicetak.

#### [NEW] [admin/reports.php](file:///c:/xampp/htdocs/ukk2027/admin/reports.php)
- Laporan rekapitulasi data penjualan.
- Filter rentang tanggal (Tanggal Awal - Tanggal Akhir) & filter status.
- Kalkulasi total order & total omzet menggunakan SQL `SUM()` dan `COUNT()`.
- Tombol cetak laporan (`window.print()`).

---

### 7. Assets & Tampilan Visual
#### [NEW] [assets/css/style.css](file:///c:/xampp/htdocs/ukk2027/assets/css/style.css)
- Styling pendukung Bootstrap 5: font Inter/Poppins, warna aksen warm coffee & clean minimalis, badge styling, print stylesheet.

#### [NEW] [assets/js/script.js](file:///c:/xampp/htdocs/ukk2027/assets/js/script.js)
- Skrip interaktif: kalkulasi total pesanan dinamis di halaman order, alert auto-dismiss, validasi konfirmasi hapus/batal.

#### [NEW] [assets/img/](file:///c:/xampp/htdocs/ukk2027/assets/img/)
- Aset gambar/ikon menu (SVG / gambar ilustrasi clean) untuk Nasi Goreng, Mie Goreng, Ayam Geprek, Kentang Goreng, Es Teh, Kopi Susu, Matcha Latte, Croissant.

---

### 8. Dokumentasi & Panduan Pembelajaran Lengkap
#### [NEW] [README.md](file:///c:/xampp/htdocs/ukk2027/README.md)
- Deskripsi sistem, spesifikasi teknologi, langkah instalasi XAMPP, akun demo (admin & customer), dan daftar fitur lengkap.

#### [NEW] [tutorial.md](file:///c:/xampp/htdocs/ukk2027/tutorial.md)
- Tutorial komprehensif, langkah demi langkah dari nol hingga selesai yang dibagi per komponen:
  1. **Konsep & Persiapan**: Struktur Folder & Setting XAMPP.
  2. **Database & Pemodelan Data**: DDL, DML, Relasi 1-to-N, Foreign Keys.
  3. **Koneksi Database & Helper Functions**: PDO, Sanitasi XSS, Format Rupiah, Flash Message.
  4. **Sistem Autentikasi & Otorisasi**: Password Hashing, Session Management, Role Middleware.
  5. **Membangun Layout & UI/UX**: Navbar, Responsive Grid Bootstrap 5, Footer.
  6. **Komponen Pelanggan (Customer)**: Katalog Menu, Keranjang/Kalkulasi Pemesanan, Transaksi PDO, Riwayat Order.
  7. **Komponen Administrator**: Dashboard Statistik, Manajemen Pesanan, Pembaruan Status, Laporan Penjualan & Print.
  8. **Pengujian & Troubleshooting**: Uji fungsionalitas, pencegahan logical/runtime errors, dan checklist kriteria UKK.

---

## Verification Plan

### Automated / Syntax Check
- Memvalidasi seluruh sintaks PHP menggunakan linter CLI:
  ```powershell
  php -l index.php
  php -l config/database.php
  php -l includes/functions.php
  php -l includes/auth.php
  php -l auth/login.php
  php -l auth/register.php
  php -l auth/logout.php
  php -l customer/dashboard.php
  php -l customer/menu.php
  php -l customer/order.php
  php -l customer/orders.php
  php -l admin/dashboard.php
  php -l admin/orders.php
  php -l admin/order-detail.php
  php -l admin/reports.php
  ```

### Functional & Flow Verification
1. **Database Import**: Menjalankan skrip `database.sql` ke MySQL localhost via CLI / PHP skrip verifikasi.
2. **Auth Flow**: Uji login Admin, login Customer, password salah, registrasi akun baru, dan logout.
3. **Role Access Guard**: Pastikan customer tidak bisa akses `/admin/*` dan unauthenticated user diredirect ke login.
4. **Customer Order Flow**: Buat order baru, cek perhitungan subtotal dan grand total, simpan order, cek riwayat di `/customer/orders.php`.
5. **Admin Order & Status Flow**: Buka `/admin/orders.php`, ubah status order menjadi 'Diproses' $\rightarrow$ 'Selesai', cek rincian menu di `/admin/order-detail.php`.
6. **Reports Flow**: Buka `/admin/reports.php`, uji filter tanggal dan filter status, validasi total pendapatan dan total order.
7. **Responsiveness & UI**: Validasi tampilan mobile, tablet, dan desktop.
