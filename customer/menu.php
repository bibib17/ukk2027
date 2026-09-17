<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/auth.php';

require_role('customer');

// Filter kategori & pencarian
$category = sanitize($_GET['category'] ?? '');
$search   = sanitize($_GET['search'] ?? '');

$sql = "SELECT * FROM menus WHERE status = 'available'";
$params = [];

if (!empty($category) && $category !== 'all') {
    $sql .= " AND category = ?";
    $params[] = $category;
}

if (!empty($search)) {
    $sql .= " AND (name LIKE ? OR description LIKE ?)";
    $params[] = "%{$search}%";
    $params[] = "%{$search}%";
}

$sql .= " ORDER BY category ASC, name ASC";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $menus = $stmt->fetchAll();
} catch (PDOException $e) {
    $menus = [];
}

$pageTitle = 'Katalog Menu Cafe';
require_once __DIR__ . '/../includes/header.php';
?>

<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <h2 class="fw-bold mb-1"><i class="bi bi-grid-fill me-2 text-warning"></i>Katalog Menu Cafe</h2>
        <p class="text-muted small mb-0">Silakan pilih makanan dan minuman favorit Anda</p>
    </div>
    <div>
        <a href="<?php echo base_url('customer/order.php'); ?>" class="btn btn-warning rounded-pill px-4 py-2 fw-bold shadow-sm">
            <i class="bi bi-bag-check-fill me-1"></i> Mulai Formulir Order
        </a>
    </div>
</div>

<!-- Filter & Search Bar -->
<div class="card border-0 shadow-sm p-3 mb-4 bg-white">
    <form action="<?php echo base_url('customer/menu.php'); ?>" method="GET" class="row g-2 align-items-center">
        <!-- Kategori Nav Pills -->
        <div class="col-lg-7 d-flex flex-wrap gap-2">
            <a href="<?php echo base_url('customer/menu.php' . (!empty($search) ? '?search=' . urlencode($search) : '')); ?>" 
               class="btn btn-sm rounded-pill px-3 <?php echo (empty($category) || $category === 'all') ? 'btn-dark' : 'btn-outline-secondary'; ?>">
               Semua Kategori
            </a>
            <a href="<?php echo base_url('customer/menu.php?category=Makanan' . (!empty($search) ? '&search=' . urlencode($search) : '')); ?>" 
               class="btn btn-sm rounded-pill px-3 <?php echo ($category === 'Makanan') ? 'btn-dark' : 'btn-outline-secondary'; ?>">
               <i class="bi bi-egg-fried me-1"></i> Makanan
            </a>
            <a href="<?php echo base_url('customer/menu.php?category=Minuman' . (!empty($search) ? '&search=' . urlencode($search) : '')); ?>" 
               class="btn btn-sm rounded-pill px-3 <?php echo ($category === 'Minuman') ? 'btn-dark' : 'btn-outline-secondary'; ?>">
               <i class="bi bi-cup-straw me-1"></i> Minuman
            </a>
            <a href="<?php echo base_url('customer/menu.php?category=Snack' . (!empty($search) ? '&search=' . urlencode($search) : '')); ?>" 
               class="btn btn-sm rounded-pill px-3 <?php echo ($category === 'Snack') ? 'btn-dark' : 'btn-outline-secondary'; ?>">
               <i class="bi bi-cookie me-1"></i> Snack / Camilan
            </a>
        </div>

        <!-- Search Input -->
        <div class="col-lg-5">
            <div class="input-group">
                <?php if (!empty($category)): ?>
                    <input type="hidden" name="category" value="<?php echo htmlspecialchars($category); ?>">
                <?php endif; ?>
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari nama menu..." value="<?php echo htmlspecialchars($search); ?>">
                <button class="btn btn-sm btn-warning fw-semibold px-3" type="submit">
                    <i class="bi bi-search me-1"></i> Cari
                </button>
                <?php if (!empty($search) || (!empty($category) && $category !== 'all')): ?>
                    <a href="<?php echo base_url('customer/menu.php'); ?>" class="btn btn-sm btn-outline-secondary" title="Reset Filter">
                        <i class="bi bi-x-lg"></i>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </form>
</div>

<!-- Daftar Menu Cards -->
<div class="row g-4">
    <?php if (empty($menus)): ?>
        <div class="col-12">
            <div class="card border-0 shadow-sm text-center py-5">
                <i class="bi bi-search fs-1 text-muted"></i>
                <h5 class="fw-bold mt-3 mb-1">Menu Tidak Ditemukan</h5>
                <p class="text-muted small">Coba ubah kata kunci pencarian atau filter kategori Anda.</p>
                <div>
                    <a href="<?php echo base_url('customer/menu.php'); ?>" class="btn btn-sm btn-outline-dark rounded-pill px-4">
                        Tampilkan Semua Menu
                    </a>
                </div>
            </div>
        </div>
    <?php else: ?>
        <?php foreach ($menus as $menu): ?>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm card-menu">
                    <div class="menu-img-wrapper position-relative">
                        <img src="<?php echo get_menu_image_url($menu['image']); ?>" alt="<?php echo htmlspecialchars($menu['name']); ?>">
                        <span class="badge bg-dark bg-opacity-75 position-absolute top-0 start-0 m-2 rounded-pill small">
                            <?php echo htmlspecialchars($menu['category']); ?>
                        </span>
                    </div>
                    <div class="card-body d-flex flex-column p-3">
                        <h6 class="fw-bold mb-1 text-dark"><?php echo htmlspecialchars($menu['name']); ?></h6>
                        <p class="text-muted small flex-grow-1 mb-2 lh-sm" style="min-height: 38px;">
                            <?php echo htmlspecialchars($menu['description']); ?>
                        </p>
                        <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                            <div>
                                <span class="fw-bold text-success fs-6"><?php echo format_rupiah($menu['price']); ?></span>
                            </div>
                            <a href="<?php echo base_url('customer/order.php?select=' . $menu['id']); ?>" class="btn btn-sm btn-warning rounded-pill px-3 fw-semibold">
                                <i class="bi bi-plus-lg me-1"></i> Pesan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
