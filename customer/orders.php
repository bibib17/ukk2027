<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/auth.php';

require_role('customer');

$user = current_user();
$userId = $user['id'];

// Ambil semua riwayat pesanan milik customer bersangkutan
try {
    $stmt = $pdo->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY id DESC");
    $stmt->execute([$userId]);
    $orders = $stmt->fetchAll();

    // Ambil semua rincian item untuk pesanan-pesanan tersebut
    $orderDetailsMap = [];
    if (!empty($orders)) {
        $orderIds = array_column($orders, 'id');
        $placeholders = str_repeat('?,', count($orderIds) - 1) . '?';
        
        $sqlDetails = "SELECT od.*, m.name AS menu_name, m.category AS menu_category 
                       FROM order_details od 
                       JOIN menus m ON od.menu_id = m.id 
                       WHERE od.order_id IN ($placeholders)";
        $stmtDetails = $pdo->prepare($sqlDetails);
        $stmtDetails->execute($orderIds);
        $allDetails = $stmtDetails->fetchAll();

        foreach ($allDetails as $detail) {
            $orderDetailsMap[$detail['order_id']][] = $detail;
        }
    }
} catch (PDOException $e) {
    $orders = [];
    $orderDetailsMap = [];
}

$pageTitle = 'Riwayat Pesanan Saya';
require_once __DIR__ . '/../includes/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1"><i class="bi bi-clock-history me-2 text-warning"></i>Riwayat Pesanan Saya</h2>
        <p class="text-muted small mb-0">Pantau status pesanan dan rincian transaksi cafe Anda</p>
    </div>
    <a href="<?php echo base_url('customer/order.php'); ?>" class="btn btn-warning rounded-pill px-4 py-2 fw-bold shadow-sm">
        <i class="bi bi-bag-plus-fill me-1"></i> Buat Pesanan Baru
    </a>
</div>

<?php if (empty($orders)): ?>
    <div class="card border-0 shadow-sm text-center py-5">
        <div class="card-body">
            <i class="bi bi-receipt fs-1 text-muted"></i>
            <h4 class="fw-bold mt-3 mb-1">Belum Ada Riwayat Pesanan</h4>
            <p class="text-muted small mb-4">Anda belum pernah melakukan pemesanan di Taking Order Cafe.</p>
            <a href="<?php echo base_url('customer/order.php'); ?>" class="btn btn-warning rounded-pill px-4 py-2 fw-bold">
                Pesan Menu Sekarang
            </a>
        </div>
    </div>
<?php else: ?>
    <div class="row g-4">
        <?php foreach ($orders as $order): ?>
            <?php 
            $items = $orderDetailsMap[$order['id']] ?? []; 
            ?>
            <div class="col-12" id="order-<?php echo $order['id']; ?>">
                <div class="card border-0 shadow-sm overflow-hidden">
                    <div class="card-header bg-white py-3 d-flex flex-wrap justify-content-between align-items-center gap-2 border-bottom">
                        <div class="d-flex align-items-center gap-3">
                            <span class="fs-5 fw-bold font-monospace text-dark"><?php echo htmlspecialchars($order['order_code']); ?></span>
                            <span class="text-muted small">
                                <i class="bi bi-calendar-event me-1"></i> <?php echo date('d M Y, H:i', strtotime($order['created_at'])); ?> WIB
                            </span>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <?php echo render_status_badge($order['status']); ?>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-sm table-borderless align-middle mb-0">
                                <thead class="table-light border-bottom text-muted small">
                                    <tr>
                                        <th class="ps-4">Item Menu</th>
                                        <th class="text-center" style="width: 120px;">Harga Satuan</th>
                                        <th class="text-center" style="width: 100px;">Jumlah</th>
                                        <th class="text-end pe-4" style="width: 150px;">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($items as $item): ?>
                                        <tr class="border-bottom">
                                            <td class="ps-4">
                                                <span class="fw-semibold text-dark"><?php echo htmlspecialchars($item['menu_name']); ?></span>
                                                <span class="badge bg-light text-secondary border ms-1 small"><?php echo htmlspecialchars($item['menu_category']); ?></span>
                                            </td>
                                            <td class="text-center text-muted"><?php echo format_rupiah($item['price']); ?></td>
                                            <td class="text-center fw-bold"><?php echo (int)$item['quantity']; ?>x</td>
                                            <td class="text-end pe-4 fw-semibold"><?php echo format_rupiah($item['subtotal']); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card-footer bg-light py-3 px-4 d-flex justify-content-between align-items-center">
                        <div>
                            <?php if ($order['status'] === 'Menunggu'): ?>
                                <small class="text-muted"><i class="bi bi-hourglass me-1"></i> Pesanan sedang menunggu antrean barista.</small>
                            <?php elseif ($order['status'] === 'Diproses'): ?>
                                <small class="text-primary fw-semibold"><i class="bi bi-fire me-1"></i> Pesanan sedang dimasak/disiapkan!</small>
                            <?php elseif ($order['status'] === 'Selesai'): ?>
                                <small class="text-success fw-semibold"><i class="bi bi-check-all me-1"></i> Pesanan telah selesai disajikan. Selamat menikmati!</small>
                            <?php else: ?>
                                <small class="text-danger"><i class="bi bi-x-circle me-1"></i> Pesanan dibatalkan.</small>
                            <?php endif; ?>
                        </div>
                        <div class="text-end">
                            <span class="text-muted small me-2">Total Tagihan:</span>
                            <span class="fs-5 fw-extrabold text-dark"><?php echo format_rupiah($order['total']); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
