<?php
$modulTitle = 'Langkah 01: Desain Database & 4 Tabel Relasi';
$modulNumber = 1;
require_once __DIR__ . '/../includes/header.php';
?>

<!-- Header Breadcrumb & Title -->
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <div>
        <span class="neu-badge neu-badge-primary mb-2">
            <i class="bi bi-diagram-3 me-1 text-neu-accent"></i> Fondasi Proyek - Tahap 1 dari 12
        </span>
        <h2 class="fw-extrabold mb-1 text-dark">Langkah 01: Perancangan Database MySQL & 4 Tabel Relasi</h2>
        <p class="text-muted mb-0">Membuat skema database `taking_order_cafe` dan merancang tabel users, menus, orders, serta order_details.</p>
    </div>
    <span class="neu-badge neu-badge-warning">
        <i class="bi bi-clock me-1"></i> Estimasi Belajar: 20 Menit
    </span>
</div>

<!-- Petunjuk Rute / Root Praktik Siswa -->
<div class="neu-card p-4 mb-4" style="border-left: 6px solid var(--neu-primary);">
    <h5 class="fw-bold text-neu-primary mb-2">
        <i class="bi bi-signpost-2-fill text-neu-accent me-2"></i> Jalur Praktik Siswa (Student Action Roadmap)
    </h5>
    <div class="row g-3 small">
        <div class="col-md-4">
            <div class="p-2 neu-inset bg-white rounded-3">
                <strong>1. Lokasi Berkas (Root File):</strong><br>
                <code class="text-primary font-monospace">c:\xampp\htdocs\ukk2027\database.sql</code>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-2 neu-inset bg-white rounded-3">
                <strong>2. Tindakan Nyata Siswa:</strong><br>
                Buka <em>phpMyAdmin</em> di browser (<code>http://localhost/phpmyadmin</code>) lalu jalankan skrip SQL di bawah ini pada tab <strong>SQL</strong>.
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-2 neu-inset bg-white rounded-3">
                <strong>3. Hasil Pengujian Sukses:</strong><br>
                Database <code>taking_order_cafe</code> terbentuk dengan 4 tabel: <code>users</code>, <code>menus</code>, <code>orders</code>, dan <code>order_details</code>.
            </div>
        </div>
    </div>
</div>

<!-- 1. Konsep & Analogi Guru Besar (ELI5) -->
<div class="row g-4 mb-4">
    <div class="col-lg-7">
        <div class="neu-card p-4 h-100">
            <h5 class="fw-bold text-neu-primary mb-3">
                <i class="bi bi-mortarboard-fill me-2 text-neu-accent"></i> Penjelasan Guru Besar: Mengapa 4 Tabel?
            </h5>
            <p class="text-muted">
                Dalam arsitektur perangkat lunak profesional, kita menerapkan prinsip <strong>Normalisasi Database (Database Normalization)</strong>. Tujuannya adalah mencegah data ganda (*redundancy*) dan menjaga keutuhan data (*data integrity*).
            </p>
            <ul class="text-muted small ps-3 mb-0">
                <li class="mb-2"><strong>`users`</strong>: Menyimpan identitas pengguna (Admin dan Customer) serta kata sandi terenkripsi.</li>
                <li class="mb-2"><strong>`menus`</strong>: Menyimpan katalog menu makanan & minuman, harga, status ketersediaan, dan gambar.</li>
                <li class="mb-2"><strong>`orders` (Header)</strong>: Menyimpan ringkasan satu transaksi pesanan (Kode Pesanan, Siapa Pemesan, Total Harga, Tanggal, dan Status).</li>
                <li class="mb-0"><strong>`order_details` (Detail Item)</strong>: Menyimpan rincian item apa saja yang dibeli pada nomor pesanan tersebut (misal: 2 Kopi Latte & 1 Roti Bakar).</li>
            </ul>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="neu-card p-4 h-100">
            <h5 class="fw-bold text-neu-primary mb-3">
                <i class="bi bi-lightbulb-fill text-warning me-2"></i> Analogi Super Gampang (ELI5)
            </h5>
            <div class="analogy-box my-0 p-3">
                <p class="mb-2 small">
                    Bayangkan kamu makan di cafe dan diberi <strong>Kertas Bon / Struk Kasir</strong>:
                </p>
                <ul class="mb-0 small ps-3">
                    <li><strong>Bagian Atas Bon (Header - Tabel `orders`)</strong>: Berisi Nomor Meja, Tanggal, Nama Kasir/Tamu, dan Total Bayar.</li>
                    <li><strong>Tabel Baris di Bon (Detail - Tabel `order_details`)</strong>: Berisi daftar pesanan: baris 1 (2 Es Kopi), baris 2 (1 Kentang Goreng).</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- 2. Pojok Dosen Senior: Kamus & Bedah Istilah Sulit -->
<div class="neu-card p-4 mb-4">
    <h5 class="fw-bold text-neu-primary mb-3">
        <i class="bi bi-book-half text-neu-accent me-2"></i> Kamus Istilah Programmer Senior: Bedah Kata Sulit SQL
    </h5>
    
    <div class="row g-3">
        <div class="col-md-6">
            <div class="p-3 neu-inset bg-white rounded-3 h-100">
                <h6 class="fw-bold text-danger mb-1"><i class="bi bi-shield-lock-fill me-1"></i> Apa itu `CONSTRAINT`?</h6>
                <p class="small text-muted mb-2">
                    <strong>Artinya:</strong> <em>Batasan</em> atau <em>Aturan Hukum yang Mengikat</em> di dalam database.
                </p>
                <p class="small text-muted mb-0">
                    <strong>Penjelasan Guru:</strong> Kata kunci <code>CONSTRAINT</code> memberi nama pada sebuah aturan relasi. Jika kamu menulis <code>CONSTRAINT fk_orders_user FOREIGN KEY (user_id) REFERENCES users(id)</code>, artinya: <em>"Database, tolong jaga aturan ini: Kolom user_id di tabel orders HANYA BOLEH diisi dengan ID orang yang benar-benar terdaftar di tabel users. Jika ada input ID hantu, tolak seketika!"</em>
                </p>
            </div>
        </div>

        <div class="col-md-6">
            <div class="p-3 neu-inset bg-white rounded-3 h-100">
                <h6 class="fw-bold text-primary mb-1"><i class="bi bi-trash3-fill me-1"></i> Apa itu `ON DELETE CASCADE` vs `RESTRICT`?</h6>
                <p class="small text-muted mb-2">
                    <strong>`ON DELETE CASCADE` (Hapus Berantai):</strong> Jika akun pelanggan dihapus dari tabel <code>users</code>, maka seluruh riwayat pesanannya di tabel <code>orders</code> ikut terhapus otomatis agar tidak meninggalkan data sampah tak bertuan.
                </p>
                <p class="small text-muted mb-0">
                    <strong>`ON DELETE RESTRICT` (Dilarang Hapus):</strong> Menu makanan di tabel <code>menus</code> TIDAK BOLEH dihapus jika sudah pernah dibeli di tabel <code>order_details</code>, agar riwayat pembukuan dan laporan keuangan kasir tidak rusak!
                </p>
            </div>
        </div>

        <div class="col-md-6">
            <div class="p-3 neu-inset bg-white rounded-3 h-100">
                <h6 class="fw-bold text-success mb-1"><i class="bi bi-currency-dollar me-1"></i> Mengapa `DECIMAL(10,2)` bukan `INT` atau `FLOAT`?</h6>
                <p class="small text-muted mb-0">
                    Tipe <code>FLOAT</code> atau <code>DOUBLE</code> memiliki kelemahan pembulatan biner (*floating point precision error*) yang bisa menyebabkan selisih 0.000001 perak. Tipe <code>DECIMAL(10,2)</code> adalah tipe data eksak mutlak yang wajib digunakan untuk nilai mata uang finansial di industri perbankan dan kasir.
                </p>
            </div>
        </div>

        <div class="col-md-6">
            <div class="p-3 neu-inset bg-white rounded-3 h-100">
                <h6 class="fw-bold text-warning mb-1"><i class="bi bi-cpu-fill me-1"></i> Apa itu `ENGINE=InnoDB` & `utf8mb4`?</h6>
                <p class="small text-muted mb-0">
                    <code>InnoDB</code> adalah mesin penyimpanan MySQL yang mendukung <strong>Transaksi ACID</strong> dan <strong>Foreign Key</strong> (berbeda dengan <code>MyISAM</code> yang sudah kuno). Sedangkan <code>utf8mb4</code> memastikan database bisa menyimpan semua karakter teks modern, simbol internasional, hingga emoji.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- 3. Live ERD / Interactive Database Schema Viewer -->
<div class="neu-card p-4 mb-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold text-neu-primary mb-0">
            <i class="bi bi-eye-fill me-2 text-neu-accent"></i> Visualisasi Relasi Antar Tabel (Entity Relationship)
        </h5>
        <span class="neu-badge neu-badge-primary">MySQL Relational InnoDB</span>
    </div>
    
    <div class="row g-3">
        <!-- Tabel Users -->
        <div class="col-md-6 col-lg-3">
            <div class="neu-card-sm p-3 bg-white h-100">
                <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-2">
                    <strong class="text-neu-primary"><i class="bi bi-people-fill me-1"></i> users</strong>
                    <span class="badge bg-secondary">Master</span>
                </div>
                <div class="small font-monospace" style="font-size: 0.8rem;">
                    <div><span class="text-danger fw-bold"><i class="bi bi-key-fill"></i> id</span> (INT PK AI)</div>
                    <div>username (VARCHAR 50)</div>
                    <div>password (VARCHAR 255)</div>
                    <div>name (VARCHAR 100)</div>
                    <div>role (ENUM admin/customer)</div>
                    <div>created_at (TIMESTAMP)</div>
                </div>
            </div>
        </div>

        <!-- Tabel Menus -->
        <div class="col-md-6 col-lg-3">
            <div class="neu-card-sm p-3 bg-white h-100">
                <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-2">
                    <strong class="text-neu-primary"><i class="bi bi-cup-hot-fill me-1"></i> menus</strong>
                    <span class="badge bg-secondary">Master</span>
                </div>
                <div class="small font-monospace" style="font-size: 0.8rem;">
                    <div><span class="text-danger fw-bold"><i class="bi bi-key-fill"></i> id</span> (INT PK AI)</div>
                    <div>name (VARCHAR 100)</div>
                    <div>category (ENUM)</div>
                    <div>price (DECIMAL 10,2)</div>
                    <div>status (ENUM available/...)</div>
                    <div>image (VARCHAR 255)</div>
                </div>
            </div>
        </div>

        <!-- Tabel Orders (Header) -->
        <div class="col-md-6 col-lg-3">
            <div class="neu-card-sm p-3 bg-white h-100" style="border: 2px solid #5c3d2e;">
                <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-2">
                    <strong class="text-neu-primary"><i class="bi bi-receipt me-1"></i> orders</strong>
                    <span class="badge bg-primary">Header</span>
                </div>
                <div class="small font-monospace" style="font-size: 0.8rem;">
                    <div><span class="text-danger fw-bold"><i class="bi bi-key-fill"></i> id</span> (INT PK AI)</div>
                    <div>order_code (VARCHAR 20)</div>
                    <div><span class="text-primary fw-bold"><i class="bi bi-link-45deg"></i> user_id</span> (FK users)</div>
                    <div>total_amount (DECIMAL)</div>
                    <div>status (ENUM)</div>
                    <div>created_at (TIMESTAMP)</div>
                </div>
            </div>
        </div>

        <!-- Tabel Order Details -->
        <div class="col-md-6 col-lg-3">
            <div class="neu-card-sm p-3 bg-white h-100" style="border: 2px solid #d97706;">
                <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-2">
                    <strong class="text-neu-primary"><i class="bi bi-list-check me-1"></i> order_details</strong>
                    <span class="badge bg-warning text-dark">Detail</span>
                </div>
                <div class="small font-monospace" style="font-size: 0.8rem;">
                    <div><span class="text-danger fw-bold"><i class="bi bi-key-fill"></i> id</span> (INT PK AI)</div>
                    <div><span class="text-primary fw-bold"><i class="bi bi-link-45deg"></i> order_id</span> (FK orders)</div>
                    <div><span class="text-primary fw-bold"><i class="bi bi-link-45deg"></i> menu_id</span> (FK menus)</div>
                    <div>quantity (INT)</div>
                    <div>price (DECIMAL)</div>
                    <div>subtotal (DECIMAL)</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 4. Source Code SQL (DDL & DML) -->
<div class="neu-card p-4 mb-4">
    <h5 class="fw-bold text-neu-primary mb-3">
        <i class="bi bi-code-square me-2 text-neu-accent"></i> Skrip Lengkap SQL Database (`database.sql`)
    </h5>

    <div class="neu-tabs mb-3">
        <button class="neu-tab-btn active" data-tab="tab-ddl">1. Skrip Pembuatan Tabel (DDL)</button>
        <button class="neu-tab-btn" data-tab="tab-dml">2. Data Awal / Seeder (DML)</button>
        <button class="neu-tab-btn" data-tab="tab-relasi">3. Aturan Foreign Key (FK)</button>
    </div>

    <!-- Tab 1: DDL -->
    <div class="neu-tab-content active" id="tab-ddl">
        <div class="code-container">
            <button type="button" class="btn-copy-code"><i class="bi bi-clipboard"></i> Salin SQL</button>
            <pre><code>-- 1. Buat Database
CREATE DATABASE IF NOT EXISTS `taking_order_cafe` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `taking_order_cafe`;

-- 2. Tabel Users (Admin & Customer)
CREATE TABLE IF NOT EXISTS `users` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(50) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `name` VARCHAR(100) NOT NULL,
    `role` ENUM('admin', 'customer') NOT NULL DEFAULT 'customer',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 3. Tabel Menus (Katalog Produk Cafe)
CREATE TABLE IF NOT EXISTS `menus` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) NOT NULL,
    `category` ENUM('coffee', 'non-coffee', 'snack', 'heavy-meal', 'dessert') NOT NULL,
    `price` DECIMAL(10, 2) NOT NULL,
    `description` TEXT NULL,
    `status` ENUM('available', 'unavailable') NOT NULL DEFAULT 'available',
    `image` VARCHAR(255) NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 4. Tabel Orders (Header Transaksi Pemesanan)
CREATE TABLE IF NOT EXISTS `orders` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `order_code` VARCHAR(20) NOT NULL UNIQUE,
    `user_id` INT NOT NULL,
    `total_amount` DECIMAL(10, 2) NOT NULL DEFAULT 0.00,
    `status` ENUM('pending', 'processing', 'completed', 'cancelled') NOT NULL DEFAULT 'pending',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT `fk_orders_user` FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 5. Tabel Order Details (Item Menu di Setiap Pesanan)
CREATE TABLE IF NOT EXISTS `order_details` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `order_id` INT NOT NULL,
    `menu_id` INT NOT NULL,
    `quantity` INT NOT NULL DEFAULT 1,
    `price` DECIMAL(10, 2) NOT NULL,
    `subtotal` DECIMAL(12, 2) NOT NULL,
    CONSTRAINT `fk_details_order` FOREIGN KEY (`order_id`) REFERENCES `orders`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `fk_details_menu` FOREIGN KEY (`menu_id`) REFERENCES `menus`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;</code></pre>
        </div>
    </div>

    <!-- Tab 2: DML -->
    <div class="neu-tab-content" id="tab-dml">
        <div class="code-container">
            <button type="button" class="btn-copy-code"><i class="bi bi-clipboard"></i> Salin Seeder</button>
            <pre><code>-- Data Awal Akun Admin (Password: password) & Customer (Password: password)
INSERT INTO `users` (`username`, `password`, `name`, `role`) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrator Cafe', 'admin'),
('budi', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Budi Santoso', 'customer');

-- Data Awal Menu Makanan & Minuman
INSERT INTO `menus` (`name`, `category`, `price`, `description`, `status`, `image`) VALUES
('Espresso Single', 'coffee', 15000.00, 'Ekstraksi kopi murni kaya aroma crema tebal.', 'available', 'espresso.svg'),
('Caffe Latte', 'coffee', 22000.00, 'Perpaduan espresso mantap dengan steamed fresh milk lembut.', 'available', 'latte.svg'),
('Croissant Butter', 'snack', 18000.00, 'Pastry renyah berlapis dengan butter premium gurih.', 'available', 'croissant.svg');</code></pre>
        </div>
    </div>

    <!-- Tab 3: Relasi -->
    <div class="neu-tab-content" id="tab-relasi">
        <div class="code-container">
            <button type="button" class="btn-copy-code"><i class="bi bi-clipboard"></i> Salin Info</button>
            <pre><code>/* Penjelasan Foreign Key:
1. fk_orders_user:
   - Menghubungkan orders.user_id -> users.id
   - ON DELETE CASCADE: Jika akun user dihapus, riwayat pesanan otomatis terhapus bersih.

2. fk_details_order:
   - Menghubungkan order_details.order_id -> orders.id
   - ON DELETE CASCADE: Jika 1 struk pesanan dihapus, seluruh baris rincian itemnya ikut terhapus.

3. fk_details_menu:
   - Menghubungkan order_details.menu_id -> menus.id
   - ON DELETE RESTRICT: Menu tidak boleh dihapus dari database jika sudah pernah dibeli di riwayat pesanan (menjaga integritas laporan akuntansi).
*/</code></pre>
        </div>
    </div>
</div>

<!-- 5. Jembatan Keledai & Trik Hafalan Asesor UKK -->
<div class="trick-box">
    <h5 class="fw-bold text-neu-primary mb-2">
        <i class="bi bi-bookmark-star-fill text-warning me-2"></i> Rumus Jembatan Keledai: Cara Menghafal 4 Tabel Tanpa Lupa
    </h5>
    <p class="mb-2 small">
        Ingat singkatan <strong>"U-M-O-D"</strong> (*User Mau Order Detail*):
    </p>
    <div class="d-flex flex-wrap gap-2">
        <span class="neu-badge neu-badge-primary"><strong>U</strong>sers (Orangnya)</span>
        <span class="neu-badge neu-badge-primary"><strong>M</strong>enus (Makanannya)</span>
        <span class="neu-badge neu-badge-primary"><strong>O</strong>rders (Struknya)</span>
        <span class="neu-badge neu-badge-primary"><strong>D</strong>etails (Rincian Barisnya)</span>
    </div>
    <div class="mt-2 small text-muted">
        <strong>Pertanyaan Favorit Asesor UKK:</strong> <em>"Kenapa harga disimpan lagi di order_details padahal sudah ada di tabel menus?"</em><br>
        <strong>Jawaban Cerdas Anda:</strong> <em>"Karena jika di masa depan harga menu naik, riwayat transaksi pesanan lama di order_details tidak boleh ikut berubah agar laporan keuangan tetap akurat!"</em>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
