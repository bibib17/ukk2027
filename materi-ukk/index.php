<?php
$modulTitle = 'Panduan Lengkap Pembangunan Sistem Taking Order Cafe (Langkah demi Langkah)';
$modulNumber = -1;
require_once __DIR__ . '/includes/header.php';
?>

<!-- Hero Banner Neumorphic Warm Cafe -->
<div class="neu-card p-4 p-md-5 mb-5 text-center">
    <span class="neu-badge neu-badge-primary mb-3">
        <i class="bi bi-mortarboard-fill me-1 text-neu-accent"></i> Modul Praktikum UKK: Zero to Hero
    </span>
    <h1 class="display-5 fw-extrabold mb-3">
        Panduan Lengkap Pembuatan <span class="text-neu-accent">Sistem Taking Order Cafe</span>
    </h1>
    <p class="lead text-muted mx-auto mb-4" style="max-width: 820px;">
        Panduan praktis langkah demi langkah mulai dari pengenalan struktur root folder, database MySQL, koneksi PDO, form login & register, formulir pemesanan dengan kalkulasi JavaScript, transaksi atomik, upload gambar, hingga laporan omset dan cetak struk kasir.
    </p>
    <div class="d-flex flex-wrap justify-content-center gap-3">
        <a href="modul/00-root-arsitektur.php" class="neu-btn neu-btn-primary px-4 py-3">
            <i class="bi bi-compass-fill me-2 text-warning"></i> Mulai dari Langkah 00: Fondasi Root
        </a>
        <a href="../index.php" class="neu-btn px-4 py-3" target="_blank">
            <i class="bi bi-cup-hot-fill me-2 text-neu-accent"></i> Buka Aplikasi Cafe Nyata
        </a>
    </div>
</div>

<!-- Highlight Modul 00: Fondasi Root -->
<div class="neu-card p-4 mb-5" style="border: 2px solid var(--neu-primary); background: linear-gradient(135deg, #f4eee5 0%, #fbf8f4 100%);">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
        <div class="d-flex align-items-center gap-3">
            <div class="neu-card-sm p-3 text-neu-primary">
                <i class="bi bi-folder-symlink-fill fs-2"></i>
            </div>
            <div>
                <span class="neu-badge neu-badge-success mb-1">Wajib Dipelajari Pertama</span>
                <h4 class="fw-bold mb-1 text-dark">Langkah 00: Peta Struktur Direktori (Root) & Arsitektur Sistem</h4>
                <p class="text-muted small mb-0">Memahami fungsi setiap folder (`config`, `includes`, `assets`, `auth`, `customer`, `admin`), alur HTTP server Apache, dan peta aliran data end-to-end.</p>
            </div>
        </div>
        <div>
            <a href="modul/00-root-arsitektur.php" class="neu-btn neu-btn-primary px-4 py-2">
                Buka Modul Root <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>
    </div>
</div>

<!-- Roadmap 12 Langkah Pembangunan Aplikasi -->
<div class="mb-4 d-flex justify-content-between align-items-center">
    <div>
        <h3 class="fw-bold mb-1 text-neu-primary"><i class="bi bi-diagram-3-fill me-2"></i> Peta Kurikulum Langkah 01 s/d 12</h3>
        <p class="text-muted small mb-0">Ikuti urutan kronologis di bawah ini untuk membangun aplikasi secara mandiri dari awal hingga selesai.</p>
    </div>
    <span class="neu-badge neu-badge-primary d-none d-md-inline-block">Kurikulum Terstruktur</span>
</div>

<div class="row g-4 mb-5">
    <?php
    $stepsData = [
        [
            'num' => 1,
            'file' => '01-database.php',
            'title' => 'Desain Database & 4 Tabel Relasi',
            'icon' => 'bi-database-fill-gear',
            'desc' => 'Membuat database `taking_order_cafe` dan 4 tabel terelasi: users, menus, orders, dan order_details beserta tipe datanya.',
            'analogi' => 'Buku Kasir & Lembaran Bon: 1 pesanan memiliki banyak rincian menu.',
            'badge' => 'Langkah 1: Database'
        ],
        [
            'num' => 2,
            'file' => '02-koneksi-helper.php',
            'title' => 'Koneksi PDO & Helper Global',
            'icon' => 'bi-plug-fill',
            'desc' => 'Membangun koneksi PDO anti-SQL-injection, try-catch, dan fungsi utilitas (format_rupiah, sanitasi input XSS, kode pesanan).',
            'analogi' => 'Pipa Saluran Air Utama & Kotak Perkakas Serbaguna milik montir.',
            'badge' => 'Langkah 2: Backend Core'
        ],
        [
            'num' => 3,
            'file' => '03-layout-landing.php',
            'title' => 'Master Layout & Landing Page',
            'icon' => 'bi-layout-text-window-reverse',
            'desc' => 'Membuat struktur layout modular (header.php, navbar, hero banner publik, dan footer.php) bertema hangat cafe.',
            'analogi' => 'Pintu Masuk & Etalase Kaca Depan Restoran yang menyapa tamu.',
            'badge' => 'Langkah 3: UI & Layout'
        ],
        [
            'num' => 4,
            'file' => '04-register.php',
            'title' => 'Registrasi & Password Hash',
            'icon' => 'bi-person-plus-fill',
            'desc' => 'Membuat formulir pendaftaran akun customer, validasi kecocokan password, dan enkripsi satu arah password_hash().',
            'analogi' => 'Pembuatan Paspor Resmi dengan mesin penggiling rahasia.',
            'badge' => 'Langkah 4: Security Auth'
        ],
        [
            'num' => 5,
            'file' => '05-login-session.php',
            'title' => 'Login Multi-Role & Sesi',
            'icon' => 'bi-box-arrow-in-right',
            'desc' => 'Pemeriksaan kredensial dengan password_verify(), pencatatan $_SESSION, hak akses Admin vs Customer, dan proses Logout.',
            'analogi' => 'Pemeriksaan KTP oleh satpam untuk mendapatkan gelang tiket VIP.',
            'badge' => 'Langkah 5: Session & RBAC'
        ],
        [
            'num' => 6,
            'file' => '06-katalog-customer.php',
            'title' => 'Dashboard & Katalog Menu',
            'icon' => 'bi-grid-fill',
            'desc' => 'Menyusun antarmuka pelanggan untuk melihat menu aktif dengan Bootstrap Grid responsif dan badge harga Rupiah.',
            'analogi' => 'Buku menu fisik bergambar yang diletakkan di atas meja tamu.',
            'badge' => 'Langkah 6: Customer View'
        ],
        [
            'num' => 7,
            'file' => '07-taking-order-js.php',
            'title' => 'Taking Order & Kalkulasi Live',
            'icon' => 'bi-calculator-fill',
            'desc' => 'Merancang form pemesanan interaktif dengan tombol kuantitas (+/-) dan JavaScript hitung Subtotal & Total instan.',
            'analogi' => 'Kalkulator pintar di tangan pelayan yang otomatis menjumlahkan bon.',
            'badge' => 'Langkah 7: Interactive JS'
        ],
        [
            'num' => 8,
            'file' => '08-transaksi-pdo.php',
            'title' => 'Transaksi Atomik Multi-Item',
            'icon' => 'bi-arrow-left-right',
            'desc' => 'Memproses penyimpanan pesanan multi-item dengan PDO Transaction (beginTransaction, lastInsertId, commit, rollback).',
            'analogi' => 'Kasir belanja swalayan: Semua item tersimpan utuh atau dibatalkan total jika listrik padam.',
            'badge' => 'Langkah 8: ACID Transaction'
        ],
        [
            'num' => 9,
            'file' => '09-riwayat-pesanan.php',
            'title' => 'Riwayat Pesanan & Status Order',
            'icon' => 'bi-clock-history',
            'desc' => 'Menampilkan daftar pesanan pelanggan via SQL JOIN, format tanggal Indonesia, dan aksi pembatalan pesanan pending.',
            'analogi' => 'Layar monitor pelacak pesanan di restoran cepat saji.',
            'badge' => 'Langkah 9: SQL JOIN & Flow'
        ],
        [
            'num' => 10,
            'file' => '10-kelola-menu-upload.php',
            'title' => 'Kelola Menu & Upload Gambar',
            'icon' => 'bi-cloud-arrow-up-fill',
            'desc' => 'Membangun CRUD Menu Admin dengan validasi upload file fisik ($_FILES, move_uploaded_file, unlink file lama).',
            'analogi' => 'Dapur & Papan Menu yang dapat diperbarui koki setiap hari.',
            'badge' => 'Langkah 10: CRUD & Upload'
        ],
        [
            'num' => 11,
            'file' => '11-kelola-pesanan-cetak.php',
            'title' => 'Kelola Pesanan & Cetak Struk',
            'icon' => 'bi-printer-fill',
            'desc' => 'Manajemen antrean pesanan kasir, pembaruan status (Proses/Selesai), dan cetak struk thermal kasir dengan @media print.',
            'analogi' => 'Mesin Kasir POS dan printer mini struk belanja.',
            'badge' => 'Langkah 11: POS & Print'
        ],
        [
            'num' => 12,
            'file' => '12-laporan-keamanan.php',
            'title' => 'Laporan Omset & Keamanan Sistem',
            'icon' => 'bi-shield-check',
            'desc' => 'Filter tanggal laporan penjualan, agregat omset SUM/COUNT, proteksi Role Guard 403, dan checklist asesmen UKK.',
            'analogi' => 'Buku Laporan Keuangan Bulanan & Sistem Brankas Keamanan Berlapis.',
            'badge' => 'Langkah 12: Analytics & Audit'
        ]
    ];

    foreach ($stepsData as $step):
    ?>
    <div class="col-md-6 col-lg-4">
        <div class="neu-card p-4 h-100 d-flex flex-column justify-content-between">
            <div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="neu-badge neu-badge-primary">
                        <i class="bi bi-check2-circle me-1 text-neu-accent"></i> <?php echo $step['badge']; ?>
                    </span>
                    <span class="fs-4 fw-extrabold text-muted opacity-50">#<?php echo str_pad($step['num'], 2, '0', STR_PAD_LEFT); ?></span>
                </div>
                <div class="d-flex align-items-center gap-2 mb-2">
                    <div class="neu-card-sm p-2 text-neu-primary">
                        <i class="bi <?php echo $step['icon']; ?> fs-4"></i>
                    </div>
                    <h5 class="fw-bold mb-0 text-dark"><?php echo $step['title']; ?></h5>
                </div>
                <p class="text-muted small mb-3">
                    <?php echo $step['desc']; ?>
                </p>
                <div class="analogy-box py-2 px-3 my-2" style="font-size: 0.82rem;">
                    <strong><i class="bi bi-lightbulb-fill text-warning me-1"></i> Analogi:</strong> <?php echo $step['analogi']; ?>
                </div>
            </div>
            <div class="mt-3 pt-2 border-top border-secondary border-opacity-10">
                <a href="modul/<?php echo $step['file']; ?>" class="neu-btn neu-btn-sm neu-btn-primary w-100">
                    Pelajari Modul Ini <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
