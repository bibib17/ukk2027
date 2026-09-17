<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/auth.php';

require_role('admin');

$orderId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($orderId <= 0) {
    set_flash_message('danger', 'ID pesanan tidak valid.');
    header("Location: " . base_url('admin/orders.php'));
    exit;
}

// Proses Update Status Order
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
    $newStatus = sanitize($_POST['status'] ?? '');
    $validStatuses = ['Menunggu', 'Diproses', 'Selesai', 'Dibatalkan'];

    if (in_array($newStatus, $validStatuses, true)) {
        try {
            $stmtUpdate = $pdo->prepare("UPDATE orders SET status = ? WHERE id = ?");
            $stmtUpdate->execute([$newStatus, $orderId]);
            set_flash_message('success', "Status pesanan berhasil diperbarui menjadi <strong>{$newStatus}</strong>.");
        } catch (PDOException $e) {
            set_flash_message('danger', 'Gagal memperbarui status: ' . $e->getMessage());
        }
    } else {
        set_flash_message('danger', 'Status yang dipilih tidak valid.');
    }
    header("Location: " . base_url('admin/order-detail.php?id=' . $orderId));
    exit;
}

// Ambil Data Order & Customer
try {
    $stmt = $pdo->prepare("SELECT o.*, u.name AS customer_name, u.username AS customer_username 
                           FROM orders o 
                           JOIN users u ON o.user_id = u.id 
                           WHERE o.id = ? LIMIT 1");
    $stmt->execute([$orderId]);
    $order = $stmt->fetch();

    if (!$order) {
        set_flash_message('danger', 'Data pesanan tidak ditemukan.');
        header("Location: " . base_url('admin/orders.php'));
        exit;
    }

    // Ambil Item Order Details
    $stmtItems = $pdo->prepare("SELECT od.*, m.name AS menu_name, m.category AS menu_category 
                                FROM order_details od 
                                JOIN menus m ON od.menu_id = m.id 
                                WHERE od.order_id = ?");
    $stmtItems->execute([$orderId]);
    $items = $stmtItems->fetchAll();

} catch (PDOException $e) {
    die("Error database: " . $e->getMessage());
}

$pageTitle = 'Rincian Pesanan ' . $order['order_code'];
require_once __DIR__ . '/../includes/header.php';
?>

<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4 no-print">
    <div>
        <div class="d-flex align-items-center gap-2 mb-1">
            <a href="<?php echo base_url('admin/orders.php'); ?>" class="btn btn-sm btn-outline-secondary rounded-pill">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
            <h2 class="fw-bold mb-0 font-monospace text-dark"><?php echo htmlspecialchars($order['order_code']); ?></h2>
        </div>
        <p class="text-muted small mb-0">Rincian lengkap dan status pemrosesan pesanan</p>
    </div>
    <div class="d-flex gap-2">
        <button onclick="window.print()" class="btn btn-outline-dark rounded-pill px-3">
            <i class="bi bi-printer me-1"></i> Cetak Struk
        </button>
    </div>
</div>

<!-- Tampilan Header Struk Khusus Cetak -->
<div class="print-only text-center mb-4">
    <h3 class="fw-bold mb-0">TAKING ORDER CAFE</h3>
    <p class="small mb-1">Jl. Pendidikan No. 45, Kota Pelajar</p>
    <p class="small mb-0">========================================</p>
    <div class="d-flex justify-content-between small my-2">
        <span>No: <?php echo htmlspecialchars($order['order_code']); ?></span>
        <span><?php echo date('d/m/Y H:i', strtotime($order['created_at'])); ?></span>
    </div>
    <div class="text-start small mb-2">
        <span>Pelanggan: <?php echo htmlspecialchars($order['customer_name']); ?></span>
    </div>
    <p class="small mb-0">========================================</p>
</div>

<div class="row g-4">
    <!-- Kolom Kiri: Rincian Item Pesanan -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                <h5 class="fw-bold mb-0"><i class="bi bi-basket-fill me-2 text-warning"></i>Daftar Item Menu</h5>
                <span class="badge bg-light text-dark border"><?php echo count($items); ?> Item</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Menu</th>
                                <th class="text-center">Kategori</th>
                                <th class="text-center">Harga Satuan</th>
                                <th class="text-center">Jumlah</th>
                                <th class="text-end pe-4">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($items as $item): ?>
                                <tr>
                                    <td class="ps-4 fw-semibold text-dark">
                                        <?php echo htmlspecialchars($item['menu_name']); ?>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-light text-secondary border small"><?php echo htmlspecialchars($item['menu_category']); ?></span>
                                    </td>
                                    <td class="text-center text-muted"><?php echo format_rupiah($item['price']); ?></td>
                                    <td class="text-center fw-bold"><?php echo (int)$item['quantity']; ?>x</td>
                                    <td class="text-end pe-4 fw-bold"><?php echo format_rupiah($item['subtotal']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <td colspan="4" class="text-end fw-bold py-3">Total Tagihan:</td>
                                <td class="text-end pe-4 fs-5 fw-extrabold text-success py-3">
                                    <?php echo format_rupiah($order['total']); ?>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Kolom Kanan: Info Pelanggan & Form Status -->
    <div class="col-lg-4 no-print">
        <!-- Card Status Update -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-dark text-white py-3">
                <h5 class="fw-bold mb-0"><i class="bi bi-gear-fill me-2 text-warning"></i>Pembaruan Status</h5>
            </div>
            <div class="card-body p-4">
                <div class="mb-3">
                    <label class="form-label text-muted small mb-1">Status Saat Ini:</label>
                    <div><?php echo render_status_badge($order['status']); ?></div>
                </div>

                <form action="<?php echo base_url('admin/order-detail.php?id=' . $orderId); ?>" method="POST">
                    <input type="hidden" name="update_status" value="1">
                    <div class="mb-3">
                        <label for="statusSelect" class="form-label fw-semibold">Ubah Status Menjadi:</label>
                        <select name="status" id="statusSelect" class="form-select">
                            <option value="Menunggu" <?php echo ($order['status'] === 'Menunggu') ? 'selected' : ''; ?>>⏳ Menunggu</option>
                            <option value="Diproses" <?php echo ($order['status'] === 'Diproses') ? 'selected' : ''; ?>>🔥 Diproses (Sedang Dimasak)</option>
                            <option value="Selesai" <?php echo ($order['status'] === 'Selesai') ? 'selected' : ''; ?>>✅ Selesai</option>
                            <option value="Dibatalkan" <?php echo ($order['status'] === 'Dibatalkan') ? 'selected' : ''; ?>>❌ Dibatalkan</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-warning w-100 py-2 rounded-pill fw-bold shadow-sm" onclick="return confirm('Perbarui status pesanan ini?');">
                        <i class="bi bi-check-circle me-1"></i> Simpan Pembaruan
                    </button>
                </form>
            </div>
        </div>

        <!-- Card Informasi Pelanggan -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3 border-bottom">
                <h6 class="fw-bold mb-0"><i class="bi bi-person-lines-fill me-2 text-warning"></i>Informasi Pelanggan</h6>
            </div>
            <div class="card-body p-3 small">
                <div class="mb-2">
                    <span class="text-muted d-block">Nama Lengkap:</span>
                    <strong><?php echo htmlspecialchars($order['customer_name']); ?></strong>
                </div>
                <div class="mb-2">
                    <span class="text-muted d-block">Username Akun:</span>
                    <code>@<?php echo htmlspecialchars($order['customer_username']); ?></code>
                </div>
                <div class="mb-0">
                    <span class="text-muted d-block">Waktu Order:</span>
                    <span><?php echo date('d F Y, H:i:s', strtotime($order['created_at'])); ?> WIB</span>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
