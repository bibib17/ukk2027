# MODUL PEMBELAJARAN LENGKAP: MEMBANGUN SISTEM TAKING ORDER CAFE BERBASIS WEB

### Panduan Langkah Demi Langkah Dari Awal Hingga Akhir Per Komponen
**Skema Sertifikasi Nasional:** Asisten Pengembang Web (*Assistant Web Developer*)  
**Kode Standar Kompetensi Kerja Nasional Indonesia (SKKNI):**
- **J.620100.005.01:** Mengimplementasikan User Interface
- **J.620100.010.02:** Menerapkan Perintah Eksekusi Bahasa Pemrograman Berbasis Teks, Grafik, dan Multimedia
- **J.620100.015.01:** Menyusun Fungsi, File atau Sumber Daya Pemrograman dalam Organisasi yang Rapi
- **J.620100.016.01:** Menulis Kode dengan Prinsip Sesuai Guidelines dan Best Practices
- **J.620100.017.02:** Mengimplementasikan Pemrograman Terstruktur
- **J.620100.019.02:** Menggunakan Library atau Komponen Pre-existing

**Teknologi Utama:** PHP Native (PDO) + MySQL + Bootstrap 5 + JavaScript Native (ES6)

---

## DAFTAR ISI MODUL

1. [Bab 1: Konsep Dasar & Arsitektur Alur Sistem](#bab-1-konsep-dasar--arsitektur-alur-sistem)
2. [Bab 2: Struktur Direktori & Organisasi File Proyek](#bab-2-struktur-direktori--organisasi-file-proyek)
3. [Bab 3: Perancangan & Pembuatan Database MySQL](#bab-3-perancangan--pembuatan-database-mysql)
4. [Bab 4: Komponen Konfigurasi Database PDO (`config/database.php`)](#bab-4-komponen-konfigurasi-database-pdo-configdatabasephp)
5. [Bab 5: Komponen Utilitas & Middleware (`includes/`)](#bab-5-komponen-utilitas--middleware-includes)
   - 5.1 Helper Functions & Bulletproof Base URL (`includes/functions.php`)
   - 5.2 Auth Middleware & Role Guard (`includes/auth.php`)
   - 5.3 Shared Header Template & Dynamic Navbar (`includes/header.php`)
   - 5.4 Shared Footer Template (`includes/footer.php`)
6. [Bab 6: Aset Visual & Client-Side Scripts (`assets/`)](#bab-6-aset-visual--client-side-scripts-assets)
   - 6.1 Custom CSS & Styling Print Kasir (`assets/css/style.css`)
   - 6.2 JavaScript Kalkulasi Pemesanan Real-time (`assets/js/script.js`)
7. [Bab 7: Komponen Autentikasi Pengguna (`auth/`)](#bab-7-komponen-autentikasi-pengguna-auth)
   - 7.1 Form & Verifikasi Login Multi-Role (`auth/login.php`)
   - 7.2 Registrasi Akun Pelanggan (`auth/register.php`)
   - 7.3 Pembersihan Sesi Logout (`auth/logout.php`)
8. [Bab 8: Halaman Publik / Landing Page (`index.php`)](#bab-8-halaman-publik--landing-page-indexphp)
9. [Bab 9: Komponen Modul Pelanggan (`customer/`)](#bab-9-komponen-modul-pelanggan-customer)
   - 9.1 Dashboard Ringkas Pelanggan (`customer/dashboard.php`)
   - 9.2 Katalog Menu & Filter Kategori (`customer/menu.php`)
   - 9.3 Formulir Taking Order & Transaksi Database PDO (`customer/order.php`)
   - 9.4 Riwayat & Rincian Pesanan Pelanggan (`customer/orders.php`)
10. [Bab 10: Komponen Modul Administrator (`admin/`)](#bab-10-komponen-modul-administrator-admin)
    - 10.1 Dashboard Statistik & Omzet Real-time (`admin/dashboard.php`)
    - 10.2 Manajemen Seluruh Pesanan Masuk (`admin/orders.php`)
    - 10.3 Detail Pesanan, Ubah Status & Cetak Struk (`admin/order-detail.php`)
    - 10.4 Rekapitulasi Laporan Penjualan & Cetak Laporan (`admin/reports.php`)
11. [Bab 11: Panduan Pengujian & Rubrik Penilaian Asesor UKK](#bab-11-panduan-pengujian--rubrik-penilaian-asesor-ukk)

---

# Bab 1: Konsep Dasar & Arsitektur Alur Sistem

Sistem **Taking Order Cafe** dibangun untuk menghubungkan pelanggan yang ingin memesan menu cafe secara mandiri dengan pihak administrator/barista yang memproses pesanan dan memantau laporan penjualan.

### Diagram Alur Data (Data Flow):

```text
       ┌───────────────────────────────────────────────────────────┐
       │                   PELANGGAN (CUSTOMER)                    │
       └─────────────────────────────┬─────────────────────────────┘
                                     │ 1. Login / Registrasi
                                     │ 2. Pilih Menu & Qty
                                     │ 3. Submit Order
                                     ▼
                      ┌─────────────────────────────┐
                      │    PHP Native + PDO         │
                      │  (Transaction & Validation) │
                      └──────────────┬──────────────┘
                                     │ INSERT orders & order_details
                                     ▼
                      ┌─────────────────────────────┐
                      │    MySQL Database           │
                      │  (taking_order_cafe)        │
                      └──────────────┬──────────────┘
                                     │ SELECT & UPDATE status
                                     ▼
                      ┌─────────────────────────────┐
                      │    ADMINISTRATOR (ADMIN)    │
                      │ 1. Cek Pesanan Masuk        │
                      │ 2. Ubah: Menunggu->Diproses │
                      │    ->Selesai                │
                      │ 3. Cetak Struk / Laporan    │
                      └─────────────────────────────┘
```

---

# Bab 2: Struktur Direktori & Organisasi File Proyek

Susun struktur folder proyek pada direktori web server XAMPP (`c:\xampp\htdocs\ukk2027\`) secara modular dan rapi:

```text
ukk2027/
├── admin/                     <-- Modul Operasional & Laporan Admin
│   ├── dashboard.php          <-- Ringkasan statistik (Total Order, Omzet)
│   ├── orders.php             <-- Daftar semua pesanan masuk + filter status
│   ├── order-detail.php       <-- Detail item pesanan, ganti status & cetak struk
│   └── reports.php            <-- Rekapitulasi omzet + filter tanggal + cetak laporan
│
├── customer/                  <-- Modul Pengguna Pelanggan
│   ├── dashboard.php          <-- Ringkasan akun & pesanan aktif customer
│   ├── menu.php               <-- Katalog menu cafe + filter kategori & pencarian
│   ├── order.php              <-- Form taking order + kalkulasi harga otomatis
│   └── orders.php             <-- Riwayat transaksi & rincian pesanan saya
│
├── auth/                      <-- Modul Autentikasi Pengguna
│   ├── login.php              <-- Form login Admin & Pelanggan
│   ├── register.php           <-- Form registrasi akun pelanggan baru
│   └── logout.php             <-- Proses logout & penghapusan session
│
├── config/
│   └── database.php           <-- Konfigurasi koneksi PDO ke MySQL
│
├── includes/                  <-- File Shared (Digunakan Bersama)
│   ├── header.php             <-- Template header & navigasi dinamis
│   ├── footer.php             <-- Template footer & script loader
│   ├── auth.php               <-- Middleware session & role authorization guard
│   └── functions.php          <-- Kumpulan fungsi pembantu (helper)
│
├── assets/                    <-- File Statis
│   ├── css/style.css          <-- Kustom CSS & media query cetak struk/laporan
│   ├── js/script.js           <-- Interaksi DOM, kalkulasi pesanan real-time
│   └── img/                   <-- Ilustrasi gambar menu (*.svg)
│
├── index.php                  <-- Landing page publik & etalase menu
├── database.sql               <-- Skrip struktur tabel & seed data awal
└── README.md                  <-- Dokumentasi teknis & panduan instalasi
```

---

# Bab 3: Perancangan & Pembuatan Database MySQL

Database `taking_order_cafe` memiliki 4 tabel dengan integritas relasi *Foreign Key*:

1. **`users`**: Menyimpan akun pengguna (Admin dan Pelanggan).
2. **`menus`**: Menyimpan daftar makanan, minuman, dan snack beserta harga dan gambar.
3. **`orders`**: Menyimpan header pesanan (kode order, user yang memesan, total belanja, status pesanan, dan tanggal).
4. **`order_details`**: Menyimpan setiap rincian item menu yang ada di dalam sebuah pesanan.

### Skrip DDL & DML Database (`database.sql`):

```sql
CREATE DATABASE IF NOT EXISTS `taking_order_cafe` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `taking_order_cafe`;

-- 1. Tabel users
CREATE TABLE IF NOT EXISTS `users` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `username` VARCHAR(50) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `role` ENUM('admin', 'customer') NOT NULL DEFAULT 'customer',
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 2. Tabel menus
CREATE TABLE IF NOT EXISTS `menus` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `category` VARCHAR(50) NOT NULL,
    `description` TEXT,
    `price` DECIMAL(10, 2) NOT NULL,
    `image` VARCHAR(255) DEFAULT 'default-menu.png',
    `status` ENUM('available', 'unavailable') NOT NULL DEFAULT 'available',
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 3. Tabel orders
CREATE TABLE IF NOT EXISTS `orders` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `order_code` VARCHAR(50) NOT NULL UNIQUE,
    `user_id` INT NOT NULL,
    `total` DECIMAL(12, 2) NOT NULL DEFAULT 0.00,
    `status` ENUM('Menunggu', 'Diproses', 'Selesai', 'Dibatalkan') NOT NULL DEFAULT 'Menunggu',
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT `fk_orders_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 4. Tabel order_details
CREATE TABLE IF NOT EXISTS `order_details` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `order_id` INT NOT NULL,
    `menu_id` INT NOT NULL,
    `price` DECIMAL(10, 2) NOT NULL,
    `quantity` INT NOT NULL DEFAULT 1,
    `subtotal` DECIMAL(12, 2) NOT NULL,
    CONSTRAINT `fk_order_details_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `fk_order_details_menu` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

---

# Bab 4: Komponen Konfigurasi Database PDO (`config/database.php`)

Gunakan ekstensi **PDO (PHP Data Objects)** karena menyediakan lapisan abstraksi yang aman dengan *Prepared Statements*.

```php
<?php
$host     = 'localhost';
$dbname   = 'taking_order_cafe';
$username = 'root';
$password = ''; // Default XAMPP

try {
    $dsn = "mysql:host={$host};dbname={$dbname};charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Melempar exception saat terjadi error SQL
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Format hasil query berupa array asosiatif
        PDO::ATTR_EMULATE_PREPARES   => false,                  // Menggunakan prepared statement asli MySQL
    ];
    
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    die("<h3>Koneksi Database Gagal:</h3> " . htmlspecialchars($e->getMessage()));
}
```

---

# Bab 5: Komponen Utilitas & Middleware (`includes/`)

## 5.1 Helper Functions (`includes/functions.php`)
Menyediakan fungsi-fungsi esensial yang digunakan berulang kali:

1. **`base_url($path)`**: Menghitung URL dasar proyek secara dinamis dan akurat:
   ```php
   function base_url($path = '') {
       static $base = null;
       if ($base === null) {
           $docRoot = isset($_SERVER['DOCUMENT_ROOT']) ? str_replace('\\', '/', realpath($_SERVER['DOCUMENT_ROOT'])) : '';
           $appRoot = str_replace('\\', '/', realpath(__DIR__ . '/..'));
           
           if (!empty($docRoot) && strpos($appRoot, $docRoot) === 0) {
               $base = substr($appRoot, strlen($docRoot));
           } else {
               $scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));
               $parts = explode('/', trim($scriptDir, '/'));
               $base = isset($parts[0]) && $parts[0] !== '' ? '/' . $parts[0] : '';
           }
           $base = '/' . trim($base, '/');
           if ($base === '/') $base = '';
       }
       return $base . '/' . ltrim($path, '/');
   }
   ```
2. **`sanitize($data)`**: Membersihkan input string dengan `htmlspecialchars` untuk mencegah serangan XSS (*Cross-Site Scripting*).
3. **`format_rupiah($number)`**: Mengonversi angka menjadi format mata uang Indonesia (`Rp 22.000`).
4. **`generate_order_code($pdo)`**: Membuat kode pesanan otomatis berformat `ORD-YYYYMMDD-XXXX` (contoh: `ORD-20260917-0001`).
5. **`render_status_badge($status)`**: Menghasilkan elemen HTML Badge Bootstrap warna-warni berdasarkan status order.
6. **`set_flash_message()` & `render_flash_message()`**: Mengelola feedback notifikasi (*Flash Alert*) berbasis sesi.

## 5.2 Auth Middleware & Role Guard (`includes/auth.php`)
Memastikan setiap pengguna hanya dapat mengakses halaman yang sesuai dengan hak aksesnya:

```php
function require_role($allowedRoles) {
    if (!is_array($allowedRoles)) {
        $allowedRoles = [$allowedRoles];
    }
    
    // 1. Cek status login
    if (!is_logged_in()) {
        set_flash_message('danger', 'Silakan login terlebih dahulu.');
        header("Location: " . base_url('auth/login.php'));
        exit;
    }
    
    // 2. Cek kecocokan role
    $userRole = $_SESSION['user']['role'] ?? '';
    if (!in_array($userRole, $allowedRoles, true)) {
        http_response_code(403);
        // Tampilkan halaman 403 Akses Ditolak
        exit;
    }
}
```

---

# Bab 6: Aset Visual & Client-Side Scripts (`assets/`)

## 6.1 Custom CSS & Styling Khusus Cetak (`assets/css/style.css`)
Mengatur tampilan tema cafe yang bersih dan modern serta stylesheet cetak:

```css
/* Styling Kartu & Efek Interaktif */
.card-menu:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08) !important;
}

/* Aturan CSS Khusus Cetak (Printer Thermal / PDF) */
@media print {
    nav, footer, .no-print, .btn, .alert {
        display: none !important;
    }
    body { background-color: #fff !important; font-size: 12pt; }
    .print-only { display: block !important; }
}
```

## 6.2 Kalkulasi Pesanan Real-Time (`assets/js/script.js`)
Ketika user mengubah kuantitas menu (`+` atau `-`), JavaScript secara langsung:
1. Menghitung $\text{Subtotal} = \text{Harga Satuan} \times \text{Kuantitas}$.
2. Menjumlahkan $\text{Grand Total} = \sum \text{Subtotal}$.
3. Mengaktifkan tombol *Submit Pesanan* jika $\text{Total Item} \ge 1$.

---

# Bab 7: Komponen Autentikasi Pengguna (`auth/`)

## 7.1 Login Multi-Role (`auth/login.php`)
1. Mengambil input `username` dan `password`.
2. Melakukan query:
   ```sql
   SELECT * FROM users WHERE username = ? LIMIT 1
   ```
3. Menguji kecocokan hash password dengan fungsi `password_verify($password, $user['password'])`.
4. Mengisi data sesi:
   ```php
   $_SESSION['user'] = [
       'id'       => $user['id'],
       'name'     => $user['name'],
       'username' => $user['username'],
       'role'     => $user['role']
   ];
   ```
5. Mengalihkan admin ke `/admin/dashboard.php` dan pelanggan ke `/customer/dashboard.php`.

## 7.2 Registrasi Pelanggan (`auth/register.php`)
1. Memvalidasi bahwa password dan konfirmasi password identik.
2. Memastikan username belum terdaftar sebelumnya.
3. Mengenkripsi password menggunakan `password_hash($password, PASSWORD_DEFAULT)`.
4. Menyimpan record baru ke tabel `users` dengan `role = 'customer'`.

## 7.3 Logout (`auth/logout.php`)
Menghapus seluruh variabel `$_SESSION`, mematikan session cookie, dan memanggil `session_destroy()`.

---

# Bab 8: Halaman Publik / Landing Page (`index.php`)

Berfungsi sebagai etalase utama yang ramah pengguna:
* Menampilkan *Hero Banner* dengan CTA (*Call to Action*).
* Menampilkan daftar menu unggulan dari database (`SELECT * FROM menus LIMIT 6`).
* Mendeteksi status login pengguna secara otomatis untuk menyesuaikan navigasi tombol.

---

# Bab 9: Komponen Modul Pelanggan (`customer/`)

## 9.1 Dashboard Pelanggan (`customer/dashboard.php`)
* Menampilkan ucapan selamat datang personal.
* Menyajikan kartu ringkasan jumlah pesanan dan pesanan yang sedang aktif.
* Menyajikan tabel 5 pesanan terakhir.

## 9.2 Katalog Menu Cafe (`customer/menu.php`)
* Menyajikan seluruh menu aktif dengan filter kategori (*Makanan, Minuman, Snack*) serta fitur pencarian menu.
* Tombol *Pesan* yang langsung mengarahkan user ke formulir order dengan parameter `?select=ID`.

## 9.3 Formulir Taking Order & Transaksi PDO (`customer/order.php`)
Komponen paling krusial dalam sistem taking order:
* Menerima input kuantitas untuk beberapa menu sekaligus.
* Menjalankan **Database Transaction** agar proses penyimpanan header pesanan (`orders`) dan rincian item (`order_details`) bersifat **Atomik** (jika salah satu gagal, seluruh transaksi di-*rollback* sehingga data tetap konsisten).

```php
$pdo->beginTransaction();

// 1. Simpan Header Pesanan
$stmtOrder = $pdo->prepare("INSERT INTO orders (order_code, user_id, total, status, created_at) VALUES (?, ?, ?, 'Menunggu', NOW())");
$stmtOrder->execute([$orderCode, $userId, $grandTotal]);
$orderId = $pdo->lastInsertId();

// 2. Simpan Rincian Menu
$stmtDetail = $pdo->prepare("INSERT INTO order_details (order_id, menu_id, price, quantity, subtotal) VALUES (?, ?, ?, ?, ?)");
foreach ($orderItems as $item) {
    $stmtDetail->execute([$orderId, $item['menu_id'], $item['price'], $item['quantity'], $item['subtotal']]);
}

// 3. Commit Transaksi
$pdo->commit();
```

## 9.4 Riwayat Pesanan Saya (`customer/orders.php`)
* Menampilkan daftar seluruh transaksi yang pernah dibuat oleh pelanggan yang bersangkutan.
* Dilengkapi rincian item yang dipesan, harga satuan, dan status pengerjaan pesanan.

---

# Bab 10: Komponen Modul Administrator (`admin/`)

## 10.1 Dashboard Administrator (`admin/dashboard.php`)
Menampilkan ringkasan metrik operasional cafe menggunakan query agregat:
* Total Pesanan: `SELECT COUNT(*) FROM orders`
* Pesanan Menunggu: `SELECT COUNT(*) FROM orders WHERE status = 'Menunggu'`
* Pesanan Sedang Dimasak: `SELECT COUNT(*) FROM orders WHERE status = 'Diproses'`
* Total Pendapatan Selesai: `SELECT SUM(total) FROM orders WHERE status = 'Selesai'`

## 10.2 Manajemen Seluruh Pesanan (`admin/orders.php`)
* Menyajikan seluruh transaksi dari semua pelanggan dengan filter status (*Menunggu, Diproses, Selesai, Dibatalkan*).
* Dilengkapi fitur pencarian kode order atau nama pelanggan.

## 10.3 Rincian Pesanan & Cetak Struk (`admin/order-detail.php`)
* Admin dapat memeriksa rincian menu yang dipesan pelanggan.
* Admin dapat memperbarui status pesanan dari dropdown:
  $$\text{Menunggu} \longrightarrow \text{Diproses} \longrightarrow \text{Selesai}$$
* Menyediakan tombol *Cetak Struk* yang memicu `window.print()` dengan layout struk kasir profesional.

## 10.4 Laporan Penjualan & Rekapitulasi (`admin/reports.php`)
* Menampilkan rekapitulasi data penjualan dengan filter rentang tanggal (`start_date` s.d `end_date`) dan status.
* Menghitung total omzet penjualan selesai secara otomatis.
* Dilengkapi layout cetak laporan resmi yang siap diprint atau diekspor ke PDF lengkap dengan kolom tanda tangan pengesahan.

---

# Bab 11: Panduan Pengujian & Rubrik Penilaian Asesor UKK

| Aspek Penilaian UKK | Prosedur Pengujian | Hasil yang Diharapkan |
| :--- | :--- | :--- |
| **1. Desain Antarmuka (UI/UX)** | Buka web di resolusi Laptop, Tablet, dan Smartphone. | Tampilan rapi, navigasi responsif, tidak ada elemen yang tumpang tindih. |
| **2. Autentikasi & Keamanan** | Login dengan password salah; Login dengan `admin` dan `customer`. | Password salah ditolak; user diarahkan ke dashboard sesuai role masing-masing. |
| **3. Otorisasi (Hak Akses)** | Saat login sebagai `customer`, buka URL `admin/dashboard.php`. | Muncul pesan **403 Akses Ditolak** dan dicegah masuk ke area admin. |
| **4. Fitur Taking Order** | Pilih beberapa menu di form pemesanan, ubah kuantitasnya. | Subtotal dan total harga terhitung otomatis; setelah order dikirim, data tersimpan di database. |
| **5. Pengelolaan Pesanan** | Buka menu admin, ubah status pesanan menjadi *Diproses* lalu *Selesai*. | Status pesanan berhasil berubah dan tercermin secara real-time di akun customer. |
| **6. Laporan & Cetak** | Buka menu laporan di admin, tentukan filter tanggal, lalu klik Cetak. | Laporan menampilkan total order dan omzet yang sesuai; tampilan cetak bersih tanpa navbar. |

---
*Modul ini dirancang khusus untuk pembelajaran praktis kejuruan SMK Rekayasa Perangkat Lunak (RPL) / Pengembangan Perangkat Lunak dan Gim (PPLG).*
