<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/auth.php';

require_role('customer');

$user = current_user();
$userId = $user['id'];
$selectedMenuId = isset($_GET['select']) ? (int)$_GET['select'] : 0;
$error = '';

// Ambil semua menu yang aktif
try {
    $stmt = $pdo->prepare("SELECT * FROM menus WHERE status = 'available' ORDER BY category ASC, name ASC");
    $stmt->execute();
    $availableMenus = $stmt->fetchAll();
} catch (PDOException $e) {
    $availableMenus = [];
    $error = 'Gagal memuat daftar menu dari database.';
}

// Proses pembuatan pesanan saat form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $quantities = $_POST['quantity'] ?? [];
    $orderItems = [];
    $grandTotal = 0;

    // Hitung item yang dipilih
    foreach ($availableMenus as $m) {
        $mId = $m['id'];
        $qty = isset($quantities[$mId]) ? (int)$quantities[$mId] : 0;
        
        if ($qty > 0) {
            $subtotal = $m['price'] * $qty;
            $grandTotal += $subtotal;
            $orderItems[] = [
                'menu_id'  => $mId,
                'name'     => $m['name'],
                'price'    => $m['price'],
                'quantity' => $qty,
                'subtotal' => $subtotal
            ];
        }
    }

    if (empty($orderItems)) {
        $error = 'Silakan tentukan jumlah pesanan minimal 1 porsi menu sebelum mengirim order.';
    } else {
        try {
            // Memulai Transaksi Database (Atomic Operation)
            $pdo->beginTransaction();

            // 1. Generate Kode Order Unik
            $orderCode = generate_order_code($pdo);

            // 2. Simpan ke tabel orders
            $stmtOrder = $pdo->prepare("INSERT INTO orders (order_code, user_id, total, status, created_at) VALUES (?, ?, ?, 'Menunggu', NOW())");
            $stmtOrder->execute([$orderCode, $userId, $grandTotal]);
            $orderId = $pdo->lastInsertId();

            // 3. Simpan rincian ke tabel order_details
            $stmtDetail = $pdo->prepare("INSERT INTO order_details (order_id, menu_id, price, quantity, subtotal) VALUES (?, ?, ?, ?, ?)");
            foreach ($orderItems as $item) {
                $stmtDetail->execute([
                    $orderId,
                    $item['menu_id'],
                    $item['price'],
                    $item['quantity'],
                    $item['subtotal']
                ]);
            }

            // Commit Transaksi jika semua berhasil
            $pdo->commit();

            set_flash_message('success', "Pesanan Anda <strong>{$orderCode}</strong> berhasil dibuat! Mohon tunggu konfirmasi barista/admin.");
            header("Location: " . base_url('customer/orders.php'));
            exit;

        } catch (Exception $e) {
            $pdo->rollBack();
            $error = 'Terjadi kesalahan saat memproses pesanan: ' . $e->getMessage();
        }
    }
}

// Hitung nilai awal jika ada menu yang dipilih via URL query parameter
$initialTotal = 0;
$initialItemsCount = 0;
if ($selectedMenuId > 0) {
    foreach ($availableMenus as $menu) {
        if ((int)$menu['id'] === $selectedMenuId) {
            $initialTotal = (float)$menu['price'];
            $initialItemsCount = 1;
            break;
        }
    }
}

$pageTitle = 'Formulir Pemesanan (Taking Order)';
require_once __DIR__ . '/../includes/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1"><i class="bi bi-bag-plus-fill me-2 text-warning"></i>Formulir Pemesanan Cafe</h2>
        <p class="text-muted small mb-0">Tentukan jumlah porsi menu yang ingin Anda pesan di bawah ini</p>
    </div>
    <a href="<?php echo base_url('customer/menu.php'); ?>" class="btn btn-outline-dark rounded-pill px-3">
        <i class="bi bi-arrow-left me-1"></i> Kembali ke Menu
    </a>
</div>

<?php if (!empty($error)): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i> <?php echo htmlspecialchars($error); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<form action="<?php echo base_url('customer/order.php'); ?>" method="POST" id="orderForm">
    <div class="row g-4">
        <!-- Kolom Kiri: Tabel Pilihan Menu -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0">Daftar Menu Tersedia</h5>
                    <span class="badge bg-light text-secondary border"><?php echo count($availableMenus); ?> Menu</span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 70px;">Foto</th>
                                    <th>Nama Menu & Kategori</th>
                                    <th style="width: 130px;">Harga</th>
                                    <th style="width: 170px;" class="text-center">Jumlah (Qty)</th>
                                    <th style="width: 140px;" class="text-end pe-3">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($availableMenus)): ?>
                                    <tr>
                                        <td colspan="5" class="text-center py-4 text-muted">Tidak ada menu yang tersedia.</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($availableMenus as $menu): ?>
                                        <?php 
                                        $initialQty = ($selectedMenuId === (int)$menu['id']) ? 1 : 0; 
                                        ?>
                                        <tr class="order-item-row <?php echo ($initialQty > 0) ? 'table-light' : ''; ?>">
                                            <td>
                                                <img src="<?php echo get_menu_image_url($menu['image']); ?>" alt="" width="50" height="50" class="rounded object-fit-cover bg-light p-1">
                                            </td>
                                            <td>
                                                <div class="fw-bold text-dark"><?php echo htmlspecialchars($menu['name']); ?></div>
                                                <span class="badge bg-light text-dark border small"><?php echo htmlspecialchars($menu['category']); ?></span>
                                            </td>
                                            <td>
                                                <span class="fw-semibold"><?php echo format_rupiah($menu['price']); ?></span>
                                            </td>
                                            <td>
                                                <div class="input-group input-group-sm justify-content-center">
                                                    <button class="btn btn-outline-secondary btn-minus" type="button"><i class="bi bi-dash"></i></button>
                                                    <input type="number" 
                                                           name="quantity[<?php echo $menu['id']; ?>]" 
                                                           class="form-control text-center item-qty" 
                                                           style="max-width: 55px;" 
                                                           value="<?php echo $initialQty; ?>" 
                                                           min="0" 
                                                           max="99"
                                                           data-price="<?php echo $menu['price']; ?>">
                                                    <button class="btn btn-outline-secondary btn-plus" type="button"><i class="bi bi-plus"></i></button>
                                                </div>
                                            </td>
                                            <td class="text-end pe-3 fw-bold item-subtotal">
                                                <?php echo format_rupiah($menu['price'] * $initialQty); ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kolom Kanan: Ringkasan Pemesanan -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm sticky-top" style="top: 80px;">
                <div class="card-header bg-dark text-white py-3">
                    <h5 class="fw-bold mb-0"><i class="bi bi-receipt me-2 text-warning"></i>Ringkasan Pesanan</h5>
                </div>
                <div class="card-body p-4">
                    <div class="mb-3 pb-3 border-bottom">
                        <small class="text-muted d-block">Nama Pelanggan:</small>
                        <strong class="fs-6"><?php echo htmlspecialchars($user['name']); ?></strong>
                    </div>

                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Total Jumlah Item:</span>
                        <strong id="totalItemsDisplay"><?php echo $initialItemsCount; ?> item</strong>
                    </div>

                    <div class="d-flex justify-content-between align-items-center my-3 py-3 border-top border-bottom">
                        <span class="fs-5 fw-bold">Total Tagihan:</span>
                        <span class="fs-4 fw-extrabold text-success" id="grandTotalDisplay"><?php echo format_rupiah($initialTotal); ?></span>
                        <input type="hidden" id="grandTotalInput" value="<?php echo $initialTotal; ?>">
                    </div>

                    <div class="alert alert-light border small text-muted mb-4">
                        <i class="bi bi-info-circle me-1"></i> Pesanan Anda akan langsung tercatat di sistem dapur/barista cafe.
                    </div>

                    <button type="submit" class="btn btn-warning w-100 py-3 rounded-pill fw-bold shadow-sm" id="submitOrderBtn" <?php echo ($initialItemsCount === 0) ? 'disabled' : ''; ?>>
                        <i class="bi bi-check2-circle me-1"></i> Konfirmasi & Pesan Sekarang
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
