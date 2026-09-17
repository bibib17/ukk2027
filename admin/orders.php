<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/auth.php';

require_role('admin');

// Filter & Search
$statusFilter = sanitize($_GET['status'] ?? '');
$search       = sanitize($_GET['search'] ?? '');

$sql = "SELECT o.*, u.name AS customer_name, u.username AS customer_username 
        FROM orders o 
        JOIN users u ON o.user_id = u.id 
        WHERE 1=1";
$params = [];

if (!empty($statusFilter) && $statusFilter !== 'all') {
    $sql .= " AND o.status = ?";
    $params[] = $statusFilter;
}

if (!empty($search)) {
    $sql .= " AND (o.order_code LIKE ? OR u.name LIKE ? OR u.username LIKE ?)";
    $params[] = "%{$search}%";
    $params[] = "%{$search}%";
    $params[] = "%{$search}%";
}

$sql .= " ORDER BY o.id DESC";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $orders = $stmt->fetchAll();
} catch (PDOException $e) {
    $orders = [];
}

$pageTitle = 'Kelola Data Pesanan';
require_once __DIR__ . '/../includes/header.php';
?>

<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <h2 class="fw-bold mb-1"><i class="bi bi-receipt-cutoff me-2 text-warning"></i>Kelola Data Pesanan</h2>
        <p class="text-muted small mb-0">Daftar seluruh transaksi pesanan pelanggan cafe</p>
    </div>
    <div>
        <a href="<?php echo base_url('admin/reports.php'); ?>" class="btn btn-outline-dark rounded-pill px-3">
            <i class="bi bi-bar-chart-line me-1"></i> Buka Laporan Penjualan
        </a>
    </div>
</div>

<!-- Filter Box -->
<div class="card border-0 shadow-sm p-3 mb-4 bg-white">
    <form action="<?php echo base_url('admin/orders.php'); ?>" method="GET" class="row g-2 align-items-center">
        <!-- Status Tabs -->
        <div class="col-lg-7 d-flex flex-wrap gap-2">
            <a href="<?php echo base_url('admin/orders.php' . (!empty($search) ? '?search=' . urlencode($search) : '')); ?>" 
               class="btn btn-sm rounded-pill px-3 <?php echo (empty($statusFilter) || $statusFilter === 'all') ? 'btn-dark' : 'btn-outline-secondary'; ?>">
               Semua Status
            </a>
            <a href="<?php echo base_url('admin/orders.php?status=Menunggu' . (!empty($search) ? '&search=' . urlencode($search) : '')); ?>" 
               class="btn btn-sm rounded-pill px-3 <?php echo ($statusFilter === 'Menunggu') ? 'btn-warning text-dark fw-bold' : 'btn-outline-secondary'; ?>">
               Menunggu
            </a>
            <a href="<?php echo base_url('admin/orders.php?status=Diproses' . (!empty($search) ? '&search=' . urlencode($search) : '')); ?>" 
               class="btn btn-sm rounded-pill px-3 <?php echo ($statusFilter === 'Diproses') ? 'btn-primary fw-bold' : 'btn-outline-secondary'; ?>">
               Diproses
            </a>
            <a href="<?php echo base_url('admin/orders.php?status=Selesai' . (!empty($search) ? '&search=' . urlencode($search) : '')); ?>" 
               class="btn btn-sm rounded-pill px-3 <?php echo ($statusFilter === 'Selesai') ? 'btn-success fw-bold' : 'btn-outline-secondary'; ?>">
               Selesai
            </a>
            <a href="<?php echo base_url('admin/orders.php?status=Dibatalkan' . (!empty($search) ? '&search=' . urlencode($search) : '')); ?>" 
               class="btn btn-sm rounded-pill px-3 <?php echo ($statusFilter === 'Dibatalkan') ? 'btn-danger fw-bold' : 'btn-outline-secondary'; ?>">
               Dibatalkan
            </a>
        </div>

        <!-- Search input -->
        <div class="col-lg-5">
            <div class="input-group">
                <?php if (!empty($statusFilter)): ?>
                    <input type="hidden" name="status" value="<?php echo htmlspecialchars($statusFilter); ?>">
                <?php endif; ?>
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari kode order atau nama customer..." value="<?php echo htmlspecialchars($search); ?>">
                <button class="btn btn-sm btn-dark px-3" type="submit">
                    <i class="bi bi-search"></i>
                </button>
                <?php if (!empty($search) || (!empty($statusFilter) && $statusFilter !== 'all')): ?>
                    <a href="<?php echo base_url('admin/orders.php'); ?>" class="btn btn-sm btn-outline-secondary" title="Reset">
                        <i class="bi bi-x-lg"></i>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </form>
</div>

<!-- Tabel Daftar Pesanan -->
<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <?php if (empty($orders)): ?>
            <div class="text-center py-5">
                <i class="bi bi-inbox fs-1 text-muted"></i>
                <h5 class="fw-bold mt-3 mb-1">Tidak Ada Data Pesanan</h5>
                <p class="text-muted small">Tidak ditemukan data pesanan dengan kriteria pencarian saat ini.</p>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">No</th>
                            <th>Kode Order</th>
                            <th>Nama Customer</th>
                            <th>Waktu Masuk</th>
                            <th>Total Pembayaran</th>
                            <th>Status Pesanan</th>
                            <th class="text-end pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($orders as $order): ?>
                            <tr>
                                <td class="ps-4 text-muted small"><?php echo $no++; ?></td>
                                <td class="fw-bold font-monospace text-primary">
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
                                    <a href="<?php echo base_url('admin/order-detail.php?id=' . $order['id']); ?>" class="btn btn-sm btn-outline-dark rounded-pill px-3">
                                        <i class="bi bi-eye me-1"></i> Rincian & Status
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
