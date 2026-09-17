<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/auth.php';

require_role('admin');

// Parameter Filter Laporan
$startDate = sanitize($_GET['start_date'] ?? '');
$endDate   = sanitize($_GET['end_date'] ?? '');
$status    = sanitize($_GET['status'] ?? '');

$sql = "SELECT o.*, u.name AS customer_name, u.username AS customer_username 
        FROM orders o 
        JOIN users u ON o.user_id = u.id 
        WHERE 1=1";
$params = [];

if (!empty($startDate)) {
    $sql .= " AND DATE(o.created_at) >= ?";
    $params[] = $startDate;
}

if (!empty($endDate)) {
    $sql .= " AND DATE(o.created_at) <= ?";
    $params[] = $endDate;
}

if (!empty($status) && $status !== 'all') {
    $sql .= " AND o.status = ?";
    $params[] = $status;
}

$sql .= " ORDER BY o.id DESC";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $orders = $stmt->fetchAll();

    // Hitung Ringkasan / Rekapitulasi
    $totalOrders = count($orders);
    $totalRevenue = 0;
    $completedCount = 0;

    foreach ($orders as $ord) {
        if ($ord['status'] === 'Selesai') {
            $totalRevenue += (float)$ord['total'];
            $completedCount++;
        }
    }

} catch (PDOException $e) {
    $orders = [];
    $totalOrders = 0;
    $totalRevenue = 0;
    $completedCount = 0;
}

$pageTitle = 'Laporan Data Order & Penjualan';
require_once __DIR__ . '/../includes/header.php';
?>

<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4 no-print">
    <div>
        <h2 class="fw-bold mb-1"><i class="bi bi-bar-chart-line-fill me-2 text-warning"></i>Laporan Transaksi & Penjualan</h2>
        <p class="text-muted small mb-0">Rekapitulasi data order cafe berdasarkan periode tanggal dan status</p>
    </div>
    <div class="d-flex gap-2">
        <button onclick="window.print()" class="btn btn-dark rounded-pill px-4 py-2 shadow-sm">
            <i class="bi bi-printer-fill me-1"></i> Cetak Laporan (PDF / Print)
        </button>
    </div>
</div>

<!-- Header Laporan Saat Dicetak -->
<div class="print-only mb-4 text-center">
    <h2 class="fw-bold mb-0">LAPORAN TRANSAKSI TAKING ORDER CAFE</h2>
    <p class="mb-1 text-muted small">Periode: <?php echo !empty($startDate) ? date('d/m/Y', strtotime($startDate)) : 'Semua'; ?> s.d <?php echo !empty($endDate) ? date('d/m/Y', strtotime($endDate)) : 'Hari Ini'; ?></p>
    <p class="mb-0 text-muted small">Dicetak pada: <?php echo date('d/m/Y H:i:s'); ?> WIB</p>
    <hr class="my-3">
</div>

<!-- Form Filter Laporan -->
<div class="card border-0 shadow-sm p-4 mb-4 bg-white no-print">
    <h6 class="fw-bold mb-3"><i class="bi bi-funnel-fill text-warning me-2"></i>Filter Periode & Status</h6>
    <form action="<?php echo base_url('admin/reports.php'); ?>" method="GET" class="row g-3 align-items-end">
        <div class="col-md-3">
            <label for="startDate" class="form-label small fw-semibold">Tanggal Mulai</label>
            <input type="date" name="start_date" id="startDate" class="form-control" value="<?php echo htmlspecialchars($startDate); ?>">
        </div>
        <div class="col-md-3">
            <label for="endDate" class="form-label small fw-semibold">Tanggal Akhir</label>
            <input type="date" name="end_date" id="endDate" class="form-control" value="<?php echo htmlspecialchars($endDate); ?>">
        </div>
        <div class="col-md-3">
            <label for="statusFilter" class="form-label small fw-semibold">Status Pesanan</label>
            <select name="status" id="statusFilter" class="form-select">
                <option value="all" <?php echo ($status === 'all' || empty($status)) ? 'selected' : ''; ?>>Semua Status</option>
                <option value="Menunggu" <?php echo ($status === 'Menunggu') ? 'selected' : ''; ?>>Menunggu</option>
                <option value="Diproses" <?php echo ($status === 'Diproses') ? 'selected' : ''; ?>>Diproses</option>
                <option value="Selesai" <?php echo ($status === 'Selesai') ? 'selected' : ''; ?>>Selesai</option>
                <option value="Dibatalkan" <?php echo ($status === 'Dibatalkan') ? 'selected' : ''; ?>>Dibatalkan</option>
            </select>
        </div>
        <div class="col-md-3 d-flex gap-2">
            <button type="submit" class="btn btn-warning fw-bold w-100">
                <i class="bi bi-filter me-1"></i> Terapkan Filter
            </button>
            <?php if (!empty($startDate) || !empty($endDate) || (!empty($status) && $status !== 'all')): ?>
                <a href="<?php echo base_url('admin/reports.php'); ?>" class="btn btn-outline-secondary" title="Reset Filter">
                    <i class="bi bi-arrow-clockwise"></i>
                </a>
            <?php endif; ?>
        </div>
    </form>
</div>

<!-- Ringkasan Rekapitulasi -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card stat-card shadow-sm border-0 p-3 bg-white">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon-box bg-primary bg-opacity-10 text-primary">
                    <i class="bi bi-receipt"></i>
                </div>
                <div>
                    <h6 class="text-muted small mb-0">Total Transaksi Ditemukan</h6>
                    <h3 class="fw-bold mb-0"><?php echo $totalOrders; ?> <span class="fs-6 fw-normal text-muted">order</span></h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card stat-card shadow-sm border-0 p-3 bg-white">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon-box bg-success bg-opacity-10 text-success">
                    <i class="bi bi-check2-circle"></i>
                </div>
                <div>
                    <h6 class="text-muted small mb-0">Pesanan Selesai (Closed)</h6>
                    <h3 class="fw-bold mb-0 text-success"><?php echo $completedCount; ?> <span class="fs-6 fw-normal text-muted">order</span></h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card stat-card shadow-sm border-0 p-3 bg-white">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon-box bg-warning bg-opacity-25 text-dark">
                    <i class="bi bi-cash-coin"></i>
                </div>
                <div>
                    <h6 class="text-muted small mb-0">Total Omzet / Pendapatan Selesai</h6>
                    <h4 class="fw-extrabold mb-0 text-dark"><?php echo format_rupiah($totalRevenue); ?></h4>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tabel Laporan -->
<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <?php if (empty($orders)): ?>
            <div class="text-center py-5">
                <i class="bi bi-journal-x fs-1 text-muted"></i>
                <h5 class="fw-bold mt-3 mb-1">Tidak Ada Data Transaksi</h5>
                <p class="text-muted small">Tidak ditemukan catatan pesanan pada rentang tanggal atau status yang dipilih.</p>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4" style="width: 50px;">No</th>
                            <th>Kode Order</th>
                            <th>Nama Customer</th>
                            <th>Tanggal & Waktu</th>
                            <th>Total Belanja</th>
                            <th>Status</th>
                            <th class="text-end pe-4 no-print">Aksi</th>
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
                                <td class="text-end pe-4 no-print">
                                    <a href="<?php echo base_url('admin/order-detail.php?id=' . $order['id']); ?>" class="btn btn-sm btn-outline-dark rounded-pill px-3">
                                        <i class="bi bi-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot class="table-light">
                        <tr>
                            <td colspan="4" class="text-end fw-bold py-3 ps-4">Total Pendapatan Pesanan Selesai:</td>
                            <td colspan="3" class="fs-5 fw-extrabold text-success py-3 pe-4">
                                <?php echo format_rupiah($totalRevenue); ?>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Area Tanda Tangan Khusus Cetak -->
<div class="print-only mt-5 pt-4">
    <div class="row">
        <div class="col-6 text-center">
            <p class="mb-5">Mengetahui,<br><strong>Kepala Toko / Manager Cafe</strong></p>
            <p class="mb-0 fw-bold underline">( _________________________ )</p>
        </div>
        <div class="col-6 text-center">
            <p class="mb-5">Petugas / Barista,<br><strong>Admin Operasional</strong></p>
            <p class="mb-0 fw-bold underline">( <?php echo htmlspecialchars($currentUser['name'] ?? 'Admin'); ?> )</p>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
