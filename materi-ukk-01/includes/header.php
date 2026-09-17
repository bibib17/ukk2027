<?php
if (!isset($modulTitle)) {
    $modulTitle = 'Materi UKK Asisten Pengembang Web';
}
if (!isset($modulNumber)) {
    $modulNumber = 0;
}

$modules = [
    1  => ['slug' => '01-button.php',      'title' => '01. Tombol & Aksi Form',       'icon' => 'bi-hand-index-thumb'],
    2  => ['slug' => '02-card.php',        'title' => '02. Card & Katalog Menu',      'icon' => 'bi-card-image'],
    3  => ['slug' => '03-login.php',       'title' => '03. Form Login & Sesi',        'icon' => 'bi-box-arrow-in-right'],
    4  => ['slug' => '04-register.php',    'title' => '04. Registrasi & Hash',        'icon' => 'bi-person-plus'],
    5  => ['slug' => '05-order.php',       'title' => '05. Taking Order & Kalkulasi', 'icon' => 'bi-calculator'],
    6  => ['slug' => '06-table.php',       'title' => '06. Tabel Data & Badge',       'icon' => 'bi-table'],
    7  => ['slug' => '07-transaction.php', 'title' => '07. Transaksi PDO Atomik',     'icon' => 'bi-arrow-left-right'],
    8  => ['slug' => '08-statcard.php',    'title' => '08. Statistik & COUNT/SUM',    'icon' => 'bi-speedometer2'],
    9  => ['slug' => '09-reports.php',     'title' => '09. Filter Laporan & Cetak',   'icon' => 'bi-printer'],
    10 => ['slug' => '10-roleguard.php',   'title' => '10. Otorisasi & 403 Guard',    'icon' => 'bi-shield-lock'],
    11 => ['slug' => '11-upload.php',      'title' => '11. Upload Gambar & CRUD',     'icon' => 'bi-cloud-arrow-up'],
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
    <title><?php echo htmlspecialchars($modulTitle); ?> - Modul Edukasi UKK</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- Custom Light Neumorphism CSS -->
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
                    <span class="fs-5 fw-extrabold d-block lh-1 text-dark">Materi UKK <span style="color: #d97706;">Cafe</span></span>
                    <small class="text-muted" style="font-size: 0.75rem;">Bedah Komponen & Logika PHP Native</small>
                </div>
            </a>

            <!-- Quick Module Dropdown -->
            <div class="d-flex align-items-center gap-2">
                <div class="dropdown">
                    <button class="neu-btn neu-btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-grid-3x3-gap me-1"></i> Pilih Modul (1 - 11)
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 p-2" style="border-radius: 14px; min-width: 260px;">
                        <li><h6 class="dropdown-header small fw-bold text-muted">Daftar Modul Pembelajaran:</h6></li>
                        <?php foreach ($modules as $num => $mod): ?>
                            <li>
                                <a class="dropdown-item small py-2 rounded-2 d-flex align-items-center gap-2 <?php echo ($modulNumber === $num) ? 'bg-primary text-white' : ''; ?>" 
                                   href="<?php echo $isSubdir ? $mod['slug'] : 'modul/' . $mod['slug']; ?>">
                                    <i class="bi <?php echo $mod['icon']; ?>"></i> <?php echo $mod['title']; ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item small text-muted" href="<?php echo $baseMateriUrl; ?>index.php">
                                <i class="bi bi-house-door me-1"></i> Beranda Materi UKK
                            </a>
                        </li>
                    </ul>
                </div>

                <a href="<?php echo $baseAppUrl; ?>index.php" class="neu-btn neu-btn-sm" title="Kembali ke Aplikasi Utama">
                    <i class="bi bi-cup-hot me-1"></i> Aplikasi Cafe
                </a>
            </div>
        </div>
    </header>

    <!-- Main Container -->
    <main class="container py-3">
