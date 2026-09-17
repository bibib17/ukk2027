<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/auth.php';

// Lindungi akses hanya untuk role admin
require_role('admin');

$admin = current_user();

try {
    // 1. Total Semua Order
    $stmt = $pdo->query("SELECT COUNT(*) FROM orders");
    $totalOrders = (int)$stmt->fetchColumn();

    // 2. Total Order Menunggu
    $stmt = $pdo->query("SELECT COUNT(*) FROM orders WHERE status = 'Menunggu'");
    $pendingOrders = (int)$stmt->fetchColumn();

    // 3. Total Order Diproses
    $stmt = $pdo->query("SELECT COUNT(*) FROM orders WHERE status = 'Diproses'");
    $processingOrders = (int)$stmt->fetchColumn();

    // 4. Total Order Selesai
    $stmt = $pdo->query("SELECT COUNT(*) FROM orders WHERE status = 'Selesai'");
    $completedOrders = (int)$stmt->fetchColumn();

    // 5. Total Pendapatan (Hanya pesanan yang selesai)
    $stmt = $pdo->query("SELECT SUM(total) FROM orders WHERE status = 'Selesai'");
    $totalIncome = (float)$stmt->fetchColumn();

    // 6. Daftar 5 Pesanan Masuk Terbaru
    $stmtRecent = $pdo->query("SELECT o.*, u.name AS customer_name, u.username AS customer_username 
                               FROM orders o 
                               JOIN users u ON o.user_id = u.id 
                               ORDER BY o.id DESC LIMIT 5");
    $recentOrders = $stmtRecent->fetchAll();

} catch (PDOException $e) {
    $totalOrders = 0;
    $pendingOrders = 0;
    $processingOrders = 0;
    $completedOrders = 0;
    $totalIncome = 0;
    $recentOrders = [];
}

$pageTitle = 'Dashboard Administrator';
require_once __DIR__ . '/../includes/header.php';
?>

<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <span class="badge bg-danger px-3 py-1 rounded-pill mb-1">Area Administrator</span>
        <h2 class="fw-bold mb-1">Dashboard Pengelolaan Cafe</h2>
        <p class="text-muted small mb-0">Ringkasan operasional dan transaksi pesanan cafe secara real-time</p>
    </div>
    <div class="d-flex flex-wrap gap-2">
        <a href="<?php echo base_url('admin/menus.php'); ?>" class="btn btn-warning rounded-pill px-4 py-2 fw-bold">
            <i class="bi bi-grid-fill me-1"></i> Kelola Menu
        </a>
        <a href="<?php echo base_url('admin/orders.php'); ?>" class="btn btn-dark rounded-pill px-4 py-2">
            <i class="bi bi-receipt me-1"></i> Semua Pesanan
        </a>
        <a href="<?php echo base_url('admin/reports.php'); ?>" class="btn btn-outline-dark rounded-pill px-3 py-2">
            <i class="bi bi-bar-chart me-1"></i> Laporan
        </a>
    </div>
</div>

<!-- Kartu Statistik (PRD Section 16 & Soal UKK) -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-lg-3">
        <div class="card stat-card shadow-sm border-0 p-3 bg-white">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon-box bg-dark bg-opacity-10 text-dark">
                    <i class="bi bi-receipt-cutoff"></i>
                </div>
                <div>
                    <h6 class="text-muted small mb-0">Total Pesanan</h6>
                    <h3 class="fw-bold mb-0"><?php echo $totalOrders; ?></h3>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-3">
        <div class="card stat-card shadow-sm border-0 p-3 bg-white">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon-box bg-warning bg-opacity-25 text-dark">
                    <i class="bi bi-hourglass-split"></i>
                </div>
                <div>
                    <h6 class="text-muted small mb-0">Perlu Diproses</h6>
                    <h3 class="fw-bold mb-0 text-warning"><?php echo $pendingOrders; ?></h3>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-3">
        <div class="card stat-card shadow-sm border-0 p-3 bg-white">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon-box bg-primary bg-opacity-10 text-primary">
                    <i class="bi bi-arrow-repeat"></i>
                </div>
                <div>
                    <h6 class="text-muted small mb-0">Sedang Dimasak</h6>
                    <h3 class="fw-bold mb-0 text-primary"><?php echo $processingOrders; ?></h3>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-3">
        <div class="card stat-card shadow-sm border-0 p-3 bg-white">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon-box bg-success bg-opacity-10 text-success">
                    <i class="bi bi-cash-stack"></i>
                </div>
                <div>
                    <h6 class="text-muted small mb-0">Pendapatan Selesai</h6>
                    <h5 class="fw-bold mb-0 text-success"><?php echo format_rupiah($totalIncome); ?></h5>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tabel Pesanan Terbaru -->
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
        <h5 class="fw-bold mb-0"><i class="bi bi-bell-fill text-warning me-2"></i>Pesanan Masuk Terbaru</h5>
        <a href="<?php echo base_url('admin/orders.php'); ?>" class="btn btn-sm btn-outline-dark rounded-pill px-3">
            Lihat Semua Pesanan <i class="bi bi-arrow-right ms-1"></i>
        </a>
    </div>
    <div class="card-body p-0">
        <?php if (empty($recentOrders)): ?>
            <div class="text-center py-5">
                <i class="bi bi-inbox fs-1 text-muted"></i>
                <p class="text-muted mt-2 mb-0">Belum ada data pesanan di sistem.</p>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Kode Order</th>
                            <th>Nama Customer</th>
                            <th>Waktu Order</th>
                            <th>Total Tagihan</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recentOrders as $order): ?>
                            <tr>
                                <td class="ps-4 fw-bold font-monospace text-primary">
                                    <?php echo htmlspecialchars($order['order_code']); ?>
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark"><?php echo htmlspecialchars($order['customer_name']); ?></div>
                                    <small class="text-muted">@<?php echo htmlspecialchars($order['customer_username']); ?></small>
                                </td>
                                <td class="text-muted small">
                                    <?php echo date('d/m/Y H:i', strtotime($order['created_at'])); ?> WIB
                                </td>
                                <td class="fw-bold">
                                    <?php echo format_rupiah($order['total']); ?>
                                </td>
                                <td>
                                    <?php echo render_status_badge($order['status']); ?>
                                </td>
                                <td class="text-end pe-4">
                                    <a href="<?php echo base_url('admin/order-detail.php?id=' . $order['id']); ?>" class="btn btn-sm btn-dark rounded-pill px-3">
                                        <i class="bi bi-pencil-square me-1"></i> Kelola
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
