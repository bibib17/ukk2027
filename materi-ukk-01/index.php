<?php
$modulTitle = 'Portal Materi UKK Interaktif - Bedah Komponen & PHP';
$modulNumber = 0;
require_once __DIR__ . '/includes/header.php';
?>

<!-- Hero Banner Neumorphic -->
<div class="neu-card p-4 p-md-5 mb-5 text-center">
    <span class="neu-badge neu-badge-primary mb-3">
        <i class="bi bi-stars me-1"></i> Modul Pembelajaran Super Detail & Ramah Pemula
    </span>
    <h1 class="display-5 fw-extrabold mb-3">
        Bedah Tuntas Komponen Web & <span class="text-primary">Logika Pemrosesan PHP</span>
    </h1>
    <p class="lead text-muted mx-auto mb-4" style="max-width: 780px;">
        Pelajari cara kerja setiap elemen antarmuka, CSS Soft UI (*Neumorphism*), hingga bagaimana data ditangkap dan diproses oleh PHP dan database MySQL secara mendalam dengan analogi kehidupan nyata dan trik hafalan cepat.
    </p>
    <div class="d-flex flex-wrap justify-content-center gap-3">
        <a href="modul/01-button.php" class="neu-btn neu-btn-primary px-4 py-3">
            <i class="bi bi-play-circle-fill me-2"></i> Mulai dari Modul 01: Tombol
        </a>
        <a href="../index.php" class="neu-btn px-4 py-3">
            <i class="bi bi-cup-hot me-2"></i> Buka Aplikasi Taking Order Cafe
        </a>
    </div>
</div>

<!-- Grid 10 Modul Pembelajaran -->
<div class="row g-4 mb-5">
    <?php
    $cardsData = [
        [
            'num' => 1,
            'file' => '01-button.php',
            'title' => 'Tombol & Aksi Form',
            'icon' => 'bi-hand-index-thumb',
            'desc' => 'Memahami fungsi tombol submit, state hover/active cembung & cekung, dan deteksi POST di PHP.',
            'analogi' => 'Bel pintu rumah yang memicu bel di dalam dapur server.',
            'badge' => 'UI & Event'
        ],
        [
            'num' => 2,
            'file' => '02-card.php',
            'title' => 'Card & Katalog Menu',
            'icon' => 'bi-card-image',
            'desc' => 'Merancang kartu produk responsif dengan Bootstrap Grid, gambar menu, dan perulangan loop PHP.',
            'analogi' => 'Buku menu fisik cafe yang disajikan di atas meja tamu.',
            'badge' => 'Grid & Loop'
        ],
        [
            'num' => 3,
            'file' => '03-login.php',
            'title' => 'Form Login & Sesi',
            'icon' => 'bi-box-arrow-in-right',
            'desc' => 'Input inset Neumorphic, verifikasi password hash dengan password_verify(), dan pembuatan $_SESSION.',
            'analogi' => 'Pemeriksaan KTP oleh satpam untuk mendapatkan gelang tanda masuk VIP.',
            'badge' => 'Auth & Session'
        ],
        [
            'num' => 4,
            'file' => '04-register.php',
            'title' => 'Registrasi & Hash',
            'icon' => 'bi-person-plus',
            'desc' => 'Validasi kecocokan password, pengacakan password_hash(), dan query INSERT record customer baru.',
            'analogi' => 'Pendaftaran paspor resmi yang menyandikan data rahasia.',
            'badge' => 'Security & Insert'
        ],
        [
            'num' => 5,
            'file' => '05-order.php',
            'title' => 'Taking Order & Kalkulasi',
            'icon' => 'bi-calculator',
            'desc' => 'Kuantitas plus-minus, perhitungan real-time subtotal via JavaScript, dan penyimpanan pesanan multi-item.',
            'analogi' => 'Pelayan mencatat nota pesanan dan menghitung total harga di kertas bon.',
            'badge' => 'Interactive Calc'
        ],
        [
            'num' => 6,
            'file' => '06-table.php',
            'title' => 'Tabel Data & Badge',
            'icon' => 'bi-table',
            'desc' => 'Tabel riwayat pesanan, format mata uang Rupiah, dan status badge dinamis (Menunggu, Selesai).',
            'analogi' => 'Papan jadwal status penerbangan bandara yang selalu up-to-date.',
            'badge' => 'Table & Formatting'
        ],
        [
            'num' => 7,
            'file' => '07-transaction.php',
            'title' => 'Transaksi PDO Atomik',
            'icon' => 'bi-arrow-left-right',
            'desc' => 'Menjamin keutuhan data orders & order_details dengan beginTransaction, commit, dan rollBack.',
            'analogi' => 'Mesin ATM yang membatalkan seluruh proses jika uang macet saat keluar.',
            'badge' => 'Database Atomicity'
        ],
        [
            'num' => 8,
            'file' => '08-statcard.php',
            'title' => 'Statistik & COUNT/SUM',
            'icon' => 'bi-speedometer2',
            'desc' => 'Membuat kartu metrik dashboard admin dengan query agregat SQL COUNT(*) dan SUM(total).',
            'analogi' => 'Panel instrumen spedometer mobil yang mengukur performa kendaraan.',
            'badge' => 'SQL Analytics'
        ],
        [
            'num' => 9,
            'file' => '09-reports.php',
            'title' => 'Filter Laporan & Cetak',
            'icon' => 'bi-printer',
            'desc' => 'Filter data rentang tanggal dengan klausa WHERE, rekapitulasi omzet, dan cetak struk via @media print.',
            'analogi' => 'Mencetak rekening koran transaksi bank pada kertas laporan resmi.',
            'badge' => 'Report & Print'
        ],
        [
            'num' => 10,
            'file' => '10-roleguard.php',
            'title' => 'Otorisasi & 403 Guard',
            'icon' => 'bi-shield-lock',
            'desc' => 'Melindungi halaman admin agar tidak bisa diakses customer dengan middleware pengecekan role.',
            'analogi' => 'Pintu berlabel "Khusus Karyawan" yang membunyikan alarm jika dimasuki tamu.',
            'badge' => 'Access Control'
        ],
        [
            'num' => 11,
            'file' => '11-upload.php',
            'title' => 'Upload Gambar & CRUD',
            'icon' => 'bi-cloud-arrow-up',
            'desc' => 'Menangani form input file enctype, validasi gambar $_FILES, move_uploaded_file, dan soft delete.',
            'analogi' => 'Menempelkan foto menu baru pada etalase kaca kasir cafe.',
            'badge' => 'File & CRUD'
        ],
    ];

    foreach ($cardsData as $c):
    ?>
        <div class="col-md-6 col-lg-4">
            <div class="neu-card h-100 p-4 d-flex flex-column">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="neu-badge neu-badge-primary">
                        <i class="bi <?php echo $c['icon']; ?>"></i> Modul <?php echo str_pad($c['num'], 2, '0', STR_PAD_LEFT); ?>
                    </span>
                    <span class="badge bg-white text-dark shadow-sm rounded-pill small border"><?php echo $c['badge']; ?></span>
                </div>
                
                <h4 class="fw-bold mb-2 text-dark"><?php echo $c['title']; ?></h4>
                <p class="text-muted small flex-grow-1 mb-3">
                    <?php echo $c['desc']; ?>
                </p>

                <div class="analogy-box p-2 mb-3 small">
                    <strong class="text-primary d-block mb-1"><i class="bi bi-lightbulb-fill me-1"></i> Analogi Singkat:</strong>
                    <span><?php echo $c['analogi']; ?></span>
                </div>

                <a href="modul/<?php echo $c['file']; ?>" class="neu-btn neu-btn-primary w-100 justify-content-center">
                    Pelajari Modul Ini <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
