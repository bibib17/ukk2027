<?php
if (!isset($modulTitle)) {
    $modulTitle = 'Panduan Lengkap Pembuatan Sistem Cafe';
}
if (!isset($modulNumber)) {
    $modulNumber = -1; // -1 for index page, 0 for modul 00, 1-12 for steps 1-12
}

$modules = [
    0  => ['slug' => '00-root-arsitektur.php',       'title' => '00. Fondasi Root & Peta Folder',       'icon' => 'bi-folder-symlink-fill'],
    1  => ['slug' => '01-database.php',             'title' => '01. Desain Database & 4 Tabel Relasi', 'icon' => 'bi-database-fill-gear'],
    2  => ['slug' => '02-koneksi-helper.php',        'title' => '02. Koneksi PDO & Kumpulan Helper',    'icon' => 'bi-plug-fill'],
    3  => ['slug' => '03-layout-landing.php',        'title' => '03. Master Layout & Landing Page',    'icon' => 'bi-layout-text-window-reverse'],
    4  => ['slug' => '04-register.php',              'title' => '04. Registrasi & Password Hash',      'icon' => 'bi-person-plus-fill'],
    5  => ['slug' => '05-login-session.php',         'title' => '05. Login Multi-Role & Sesi',         'icon' => 'bi-box-arrow-in-right'],
    6  => ['slug' => '06-katalog-customer.php',      'title' => '06. Dashboard & Katalog Menu',        'icon' => 'bi-grid-fill'],
    7  => ['slug' => '07-taking-order-js.php',       'title' => '07. Taking Order & Kalkulasi Live',   'icon' => 'bi-calculator-fill'],
    8  => ['slug' => '08-transaksi-pdo.php',         'title' => '08. Transaksi Atomik Multi-Item',     'icon' => 'bi-arrow-left-right'],
    9  => ['slug' => '09-riwayat-pesanan.php',       'title' => '09. Riwayat Pesanan & Status Order',  'icon' => 'bi-clock-history'],
    10 => ['slug' => '10-kelola-menu-upload.php',    'title' => '10. Kelola Menu & Upload Gambar',     'icon' => 'bi-cloud-arrow-up-fill'],
    11 => ['slug' => '11-kelola-pesanan-cetak.php',  'title' => '11. Kelola Pesanan & Cetak Struk',    'icon' => 'bi-printer-fill'],
    12 => ['slug' => '12-laporan-keamanan.php',      'title' => '12. Laporan Omset & Keamanan Sistem', 'icon' => 'bi-shield-check'],
];

// Helper base path materi-ukk
$isSubdir = strpos($_SERVER['SCRIPT_NAME'], '/modul/') !== false;
$baseMateriUrl = $isSubdir ? '../' : './';
$baseAppUrl = $isSubdir ? '../../' : '../';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($modulTitle); ?> - Panduan Sistem Cafe UKK</title>
    
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Fira+Code:wght@400;500;600&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- Custom Light Neumorphism Cafe CSS -->
    <link rel="stylesheet" href="<?php echo $baseMateriUrl; ?>assets/css/neumorphism.css">
</head>
<body>

    <!-- Neumorphic Header Navigation -->
    <header class="neu-navbar sticky-top">
        <div class="container d-flex flex-wrap justify-content-between align-items-center gap-3">
            <a href="<?php echo $baseMateriUrl; ?>index.php" class="d-flex align-items-center gap-2 text-decoration-none text-dark fw-bold">
                <span class="neu-badge neu-badge-primary p-2" style="background: #fbf8f4; color: #5c3d2e;">
                    <i class="bi bi-cup-hot-fill fs-5 text-warning"></i>
                </span>
                <div>
                    <span class="fs-5 fw-extrabold d-block lh-1 text-dark">Modul UKK <span style="color: #d97706;">Cafe</span></span>
                    <small class="text-muted" style="font-size: 0.75rem;">Panduan Langkah demi Langkah dari Root ke Laporan</small>
                </div>
            </a>

            <!-- Quick Module Dropdown -->
            <div class="d-flex align-items-center gap-2">
                <div class="dropdown">
                    <button class="neu-btn neu-btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-journal-bookmark-fill me-1 text-neu-accent"></i> 
                        <?php 
                        if ($modulNumber === 0) echo 'Langkah 00: Root Fondasi';
                        elseif ($modulNumber > 0 && isset($modules[$modulNumber])) echo 'Langkah ' . str_pad($modulNumber, 2, '0', STR_PAD_LEFT) . ' dari 12';
                        else echo 'Daftar 13 Modul Belajar'; 
                        ?>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 p-2" style="border-radius: 14px; max-height: 440px; overflow-y: auto; width: 330px;">
                        <li><h6 class="dropdown-header text-uppercase fw-bold text-muted small">Peta Langkah Belajar</h6></li>
                        <li>
                            <a class="dropdown-item rounded-3 py-2 <?php echo ($modulNumber === -1) ? 'active bg-neu-primary' : ''; ?>" href="<?php echo $baseMateriUrl; ?>index.php">
                                <i class="bi bi-house-door-fill me-2"></i> Peta Kurikulum Utama
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <?php foreach ($modules as $num => $mod): ?>
                            <li>
                                <a class="dropdown-item rounded-3 py-2 d-flex align-items-center gap-2 <?php echo ($modulNumber === $num) ? 'active bg-neu-primary' : ''; ?>" 
                                   href="<?php echo $isSubdir ? $mod['slug'] : 'modul/' . $mod['slug']; ?>">
                                    <i class="bi <?php echo $mod['icon']; ?>"></i>
                                    <span class="small fw-semibold"><?php echo $mod['title']; ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- Tombol ke Aplikasi Nyata -->
                <a href="<?php echo $baseAppUrl; ?>index.php" class="neu-btn neu-btn-sm neu-btn-primary" target="_blank" title="Buka Sistem Aplikasi Nyata">
                    <i class="bi bi-arrow-up-right-square me-1"></i> Buka Aplikasi
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content Container -->
    <main class="container my-4">
