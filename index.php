<?php
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/auth.php';

$pageTitle = 'Beranda - Selamat Datang di Taking Order Cafe';

// Ambil menu favorit/unggulan (maksimal 6 menu)
try {
    $stmt = $pdo->prepare("SELECT * FROM menus WHERE status = 'available' ORDER BY id ASC LIMIT 6");
    $stmt->execute();
    $featuredMenus = $stmt->fetchAll();
} catch (PDOException $e) {
    $featuredMenus = [];
}

require_once __DIR__ . '/includes/header.php';
?>

<!-- Hero Banner -->
<section class="hero-banner p-4 p-md-5 mb-5 shadow">
    <div class="row align-items-center">
        <div class="col-lg-7">
            <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold mb-3">
                <i class="bi bi-stars me-1"></i> Sistem Taking Order Tercepat & Praktis
            </span>
            <h1 class="display-4 fw-extrabold text-white mb-3">
                Nikmati Menu Favorit <span class="text-warning">Tanpa Antri</span>
            </h1>
            <p class="lead text-light opacity-75 mb-4">
                Pesan makanan, minuman, dan camilan favorit Anda secara online dari meja atau rumah dengan mudah, cepat, dan transparan.
            </p>
            <div class="d-flex flex-wrap gap-3">
                <?php if (is_logged_in()): ?>
                    <?php if ($currentUser['role'] === 'admin'): ?>
                        <a href="<?php echo base_url('admin/dashboard.php'); ?>" class="btn btn-warning btn-lg px-4 py-3 rounded-pill fw-bold">
                            <i class="bi bi-speedometer2 me-2"></i> Buka Dashboard Admin
                        </a>
                    <?php else: ?>
                        <a href="<?php echo base_url('customer/order.php'); ?>" class="btn btn-warning btn-lg px-4 py-3 rounded-pill fw-bold">
                            <i class="bi bi-bag-plus-fill me-2"></i> Pesan Sekarang
                        </a>
                        <a href="<?php echo base_url('customer/menu.php'); ?>" class="btn btn-outline-light btn-lg px-4 py-3 rounded-pill">
                            <i class="bi bi-grid me-2"></i> Lihat Semua Menu
                        </a>
                    <?php endif; ?>
                <?php else: ?>
                    <a href="<?php echo base_url('auth/login.php'); ?>" class="btn btn-warning btn-lg px-4 py-3 rounded-pill fw-bold">
                        <i class="bi bi-box-arrow-in-right me-2"></i> Masuk untuk Memesan
                    </a>
                    <a href="<?php echo base_url('auth/register.php'); ?>" class="btn btn-outline-light btn-lg px-4 py-3 rounded-pill">
                        <i class="bi bi-person-plus me-2"></i> Daftar Akun Baru
                    </a>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-lg-5 text-center mt-4 mt-lg-0">
            <div class="p-4 bg-white bg-opacity-10 rounded-4 border border-white border-opacity-25 shadow-sm">
                <img src="<?php echo base_url('assets/img/kopi-susu.svg'); ?>" alt="Taking Order Cafe" class="img-fluid" style="max-height: 240px;">
                <h5 class="text-white mt-3 fw-bold mb-1">Kopi & Masakan Khas Cafe</h5>
                <p class="text-light small mb-0 opacity-75">Bahan segar pilihan dengan cita rasa istimewa</p>
            </div>
        </div>
    </div>
</section>

<!-- Langkah Pemesanan -->
<section class="mb-5">
    <div class="text-center mb-4">
        <h2 class="fw-bold">Cara Mudah Memesan</h2>
        <p class="text-muted">Hanya 3 langkah mudah untuk menikmati hidangan cafe kami</p>
    </div>
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm text-center p-4">
                <div class="stat-icon-box bg-warning bg-opacity-25 text-warning mx-auto mb-3">
                    <i class="bi bi-card-checklist fs-3 text-dark"></i>
                </div>
                <h5 class="fw-bold mb-2">1. Pilih Menu</h5>
                <p class="text-muted small mb-0">Eksplorasi katalog menu makanan, minuman, dan snack lezat pilihan Anda.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm text-center p-4">
                <div class="stat-icon-box bg-primary bg-opacity-10 text-primary mx-auto mb-3">
                    <i class="bi bi-cart-check fs-3"></i>
                </div>
                <h5 class="fw-bold mb-2">2. Konfirmasi Pesanan</h5>
                <p class="text-muted small mb-0">Tentukan jumlah porsi, periksa total belanjaan, dan buat pesanan Anda.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm text-center p-4">
                <div class="stat-icon-box bg-success bg-opacity-10 text-success mx-auto mb-3">
                    <i class="bi bi-emoji-smile fs-3"></i>
                </div>
                <h5 class="fw-bold mb-2">3. Siap Dihidangkan</h5>
                <p class="text-muted small mb-0">Pesanan Anda langsung diproses oleh barista dan koki cafe dengan sigap.</p>
            </div>
        </div>
    </div>
</section>

<!-- Menu Unggulan Section -->
<section class="mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Menu Pilihan Hari Ini</h2>
            <p class="text-muted small mb-0">Dibuat fresh setiap hari dengan bahan berkualitas tinggi</p>
        </div>
        <?php if (is_logged_in() && $currentUser['role'] === 'customer'): ?>
            <a href="<?php echo base_url('customer/menu.php'); ?>" class="btn btn-outline-dark rounded-pill px-3">
                Lihat Semua <i class="bi bi-arrow-right ms-1"></i>
            </a>
        <?php endif; ?>
    </div>

    <div class="row g-4">
        <?php if (empty($featuredMenus)): ?>
            <div class="col-12">
                <div class="alert alert-info text-center py-4">
                    <i class="bi bi-info-circle me-2"></i> Belum ada menu yang tersedia saat ini.
                </div>
            </div>
        <?php else: ?>
            <?php foreach ($featuredMenus as $menu): ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm card-menu">
                        <div class="menu-img-wrapper">
                            <img src="<?php echo get_menu_image_url($menu['image']); ?>" alt="<?php echo htmlspecialchars($menu['name']); ?>">
                        </div>
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <span class="badge bg-light text-dark border"><?php echo htmlspecialchars($menu['category']); ?></span>
                                <span class="fw-bold text-success fs-5"><?php echo format_rupiah($menu['price']); ?></span>
                            </div>
                            <h5 class="card-title fw-bold mb-2"><?php echo htmlspecialchars($menu['name']); ?></h5>
                            <p class="card-text text-muted small flex-grow-1">
                                <?php echo htmlspecialchars($menu['description']); ?>
                            </p>
                            <div class="mt-3 pt-2 border-top">
                                <?php if (is_logged_in() && $currentUser['role'] === 'customer'): ?>
                                    <a href="<?php echo base_url('customer/order.php'); ?>" class="btn btn-warning w-100 rounded-pill fw-semibold">
                                        <i class="bi bi-bag-plus me-1"></i> Pesan Menu
                                    </a>
                                <?php elseif (!is_logged_in()): ?>
                                    <a href="<?php echo base_url('auth/login.php'); ?>" class="btn btn-outline-dark w-100 rounded-pill">
                                        <i class="bi bi-lock me-1"></i> Login untuk Memesan
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
