<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/auth.php';

// Lindungi akses hanya untuk role customer
require_role('customer');

$user = current_user();
$userId = $user['id'];

// Ambil statistik ringkas customer
try {
    // Total Order
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM orders WHERE user_id = ?");
    $stmt->execute([$userId]);
    $totalOrders = (int)$stmt->fetchColumn();

    // Order Aktif (Menunggu atau Diproses)
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM orders WHERE user_id = ? AND status IN ('Menunggu', 'Diproses')");
    $stmt->execute([$userId]);
    $activeOrders = (int)$stmt->fetchColumn();

    // 5 Order Terakhir
    $stmt = $pdo->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY id DESC LIMIT 5");
    $stmt->execute([$userId]);
    $recentOrders = $stmt->fetchAll();
} catch (PDOException $e) {
    $totalOrders = 0;
    $activeOrders = 0;
    $recentOrders = [];
}

$pageTitle = 'Dashboard Pelanggan';
require_once __DIR__ . '/../includes/header.php';
?>

<!-- Welcome Section -->
<div class="row mb-4">
    <div class="col-12">
        <div class="p-4 bg-white rounded-4 shadow-sm border-0 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <span class="badge bg-warning text-dark px-3 py-1 rounded-pill mb-2">Pelanggan Setia</span>
                <h2 class="fw-bold mb-1">Halo, <?php echo htmlspecialchars($user['name']); ?>! 👋</h2>
                <p class="text-muted mb-0">Mau makan atau minum apa hari ini? Pesan langsung dari meja Anda dengan praktis.</p>
            </div>
            <div class="d-flex gap-2">
                <a href="<?php echo base_url('customer/order.php'); ?>" class="btn btn-warning rounded-pill px-4 py-2 fw-bold shadow-sm">
                    <i class="bi bi-bag-plus-fill me-1"></i> Pesan Sekarang
                </a>
                <a href="<?php echo base_url('customer/menu.php'); ?>" class="btn btn-outline-dark rounded-pill px-3 py-2">
                    <i class="bi bi-grid me-1"></i> Lihat Menu
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Stats Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="card stat-card shadow-sm border-0 p-3 bg-white">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon-box bg-primary bg-opacity-10 text-primary">
                    <i class="bi bi-receipt"></i>
                </div>
                <div>
                    <h6 class="text-muted small mb-0">Total Seluruh Pesanan</h6>
                    <h3 class="fw-bold mb-0"><?php echo $totalOrders; ?> <span class="fs-6 fw-normal text-muted">transaksi</span></h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card stat-card shadow-sm border-0 p-3 bg-white">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon-box bg-warning bg-opacity-25 text-dark">
                    <i class="bi bi-hourglass-split"></i>
                </div>
                <div>
                    <h6 class="text-muted small mb-0">Pesanan Sedang Berlangsung</h6>
                    <h3 class="fw-bold mb-0"><?php echo $activeOrders; ?> <span class="fs-6 fw-normal text-muted">pesanan aktif</span></h3>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Pesanan Terakhir Card -->
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
        <h5 class="fw-bold mb-0"><i class="bi bi-clock-history me-2 text-warning"></i>Pesanan Terakhir Anda</h5>
        <a href="<?php echo base_url('customer/orders.php'); ?>" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
            Lihat Semua Pesanan <i class="bi bi-arrow-right ms-1"></i>
        </a>
    </div>
    <div class="card-body p-0">
        <?php if (empty($recentOrders)): ?>
            <div class="text-center py-5">
                <i class="bi bi-bag-x fs-1 text-muted"></i>
                <p class="text-muted mt-2 mb-3">Anda belum pernah melakukan pemesanan.</p>
                <a href="<?php echo base_url('customer/order.php'); ?>" class="btn btn-warning rounded-pill px-4">
                    Mulai Pesan Menu Pertama
                </a>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Kode Order</th>
                            <th>Tanggal & Waktu</th>
                            <th>Total Pembayaran</th>
                            <th>Status Pesanan</th>
                            <th class="text-end pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recentOrders as $ord): ?>
                            <tr>
                                <td class="ps-4 fw-bold font-monospace text-primary">
                                    <?php echo htmlspecialchars($ord['order_code']); ?>
                                </td>
                                <td class="text-muted small">
                                    <?php echo date('d/m/Y H:i', strtotime($ord['created_at'])); ?> WIB
                                </td>
                                <td class="fw-bold">
                                    <?php echo format_rupiah($ord['total']); ?>
                                </td>
                                <td>
                                    <?php echo render_status_badge($ord['status']); ?>
                                </td>
                                <td class="text-end pe-4">
                                    <a href="<?php echo base_url('customer/orders.php#order-' . $ord['id']); ?>" class="btn btn-sm btn-outline-dark rounded-pill px-3">
                                        <i class="bi bi-eye me-1"></i> Rincian
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
