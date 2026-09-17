<?php
if (!isset($pageTitle)) {
    $pageTitle = 'Taking Order Cafe';
}
$currentUser = function_exists('current_user') ? current_user() : null;
$role = $currentUser['role'] ?? 'guest';
$currentScript = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Taking Order Cafe - Sistem Pemesanan Cafe Berbasis Web untuk UKK Asisten Pengembang Web">
    <title><?php echo htmlspecialchars($pageTitle); ?> - Taking Order Cafe</title>
    
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
</head>
<body class="d-flex flex-column min-vh-100 bg-light">

    <!-- Top Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm py-2">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2 fw-bold" href="<?php 
                if ($role === 'admin') echo base_url('admin/dashboard.php');
                elseif ($role === 'customer') echo base_url('customer/dashboard.php');
                else echo base_url('index.php');
            ?>">
                <span class="brand-icon bg-warning text-dark d-inline-flex align-items-center justify-content-center rounded-circle p-2 shadow-sm">
                    <i class="bi bi-cup-hot-fill fs-5"></i>
                </span>
                <span class="fs-5 tracking-tight">Taking Order <span class="text-warning">Cafe</span></span>
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-3">
                    <?php if ($role === 'admin'): ?>
                        <!-- Navigasi Admin -->
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($currentScript === 'dashboard.php') ? 'active fw-bold' : ''; ?>" href="<?php echo base_url('admin/dashboard.php'); ?>">
                                <i class="bi bi-speedometer2 me-1"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($currentScript === 'menus.php') ? 'active fw-bold' : ''; ?>" href="<?php echo base_url('admin/menus.php'); ?>">
                                <i class="bi bi-grid-fill me-1"></i> Kelola Menu
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($currentScript === 'orders.php' || $currentScript === 'order-detail.php') ? 'active fw-bold' : ''; ?>" href="<?php echo base_url('admin/orders.php'); ?>">
                                <i class="bi bi-receipt-cutoff me-1"></i> Kelola Pesanan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($currentScript === 'reports.php') ? 'active fw-bold' : ''; ?>" href="<?php echo base_url('admin/reports.php'); ?>">
                                <i class="bi bi-bar-chart-line-fill me-1"></i> Laporan
                            </a>
                        </li>
                    <?php elseif ($role === 'customer'): ?>
                        <!-- Navigasi Pelanggan -->
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($currentScript === 'dashboard.php') ? 'active fw-bold' : ''; ?>" href="<?php echo base_url('customer/dashboard.php'); ?>">
                                <i class="bi bi-house-door me-1"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($currentScript === 'menu.php') ? 'active fw-bold' : ''; ?>" href="<?php echo base_url('customer/menu.php'); ?>">
                                <i class="bi bi-grid-fill me-1"></i> Menu Cafe
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($currentScript === 'order.php') ? 'active fw-bold' : ''; ?>" href="<?php echo base_url('customer/order.php'); ?>">
                                <i class="bi bi-bag-plus-fill me-1"></i> Buat Pesanan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($currentScript === 'orders.php') ? 'active fw-bold' : ''; ?>" href="<?php echo base_url('customer/orders.php'); ?>">
                                <i class="bi bi-clock-history me-1"></i> Pesanan Saya
                            </a>
                        </li>
                    <?php else: ?>
                        <!-- Navigasi Publik / Tamu -->
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($currentScript === 'index.php') ? 'active fw-bold' : ''; ?>" href="<?php echo base_url('index.php'); ?>">
                                <i class="bi bi-house-fill me-1"></i> Beranda
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>

                <!-- User Area / Auth Buttons -->
                <div class="d-flex align-items-center gap-2">
                    <a href="<?php echo base_url('materi-ukk/index.php'); ?>" class="btn btn-outline-info rounded-pill px-3 py-1 text-light border-info" title="Buka Modul Edukasi Soft UI">
                        <i class="bi bi-mortarboard-fill me-1 text-info"></i> Materi UKK
                    </a>

                    <?php if ($currentUser): ?>
                        <div class="dropdown">
                            <button class="btn btn-outline-light dropdown-toggle d-flex align-items-center gap-2 rounded-pill px-3 py-1" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="badge bg-<?php echo ($role === 'admin') ? 'danger' : 'warning text-dark'; ?> text-uppercase" style="font-size: 0.7rem;">
                                    <?php echo htmlspecialchars($role); ?>
                                </span>
                                <span><?php echo htmlspecialchars($currentUser['name']); ?></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                                <li class="dropdown-header text-muted small">Login sebagai: <strong><?php echo htmlspecialchars($currentUser['username']); ?></strong></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item text-danger d-flex align-items-center gap-2" href="<?php echo base_url('auth/logout.php'); ?>" onclick="return confirm('Apakah Anda yakin ingin logout?');">
                                        <i class="bi bi-box-arrow-right"></i> Logout
                                    </a>
                                </li>
                            </ul>
                        </div>
                    <?php else: ?>
                        <a href="<?php echo base_url('auth/login.php'); ?>" class="btn btn-outline-warning rounded-pill px-3">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Login
                        </a>
                        <a href="<?php echo base_url('auth/register.php'); ?>" class="btn btn-warning rounded-pill px-3 fw-semibold">
                            <i class="bi bi-person-plus me-1"></i> Daftar
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content Container -->
    <main class="flex-grow-1 py-4">
        <div class="container">
            <?php 
            if (function_exists('render_flash_message')) {
                render_flash_message();
            }
            ?>
