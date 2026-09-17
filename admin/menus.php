<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/auth.php';

require_role('admin');

$action = sanitize($_GET['action'] ?? '');
$uploadDir = __DIR__ . '/../assets/img/';

// Helper function untuk memproses upload gambar
function handle_image_upload($file, $uploadDir) {
    if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
        return null; // Tidak ada file yang diunggah
    }

    $allowedExts = ['jpg', 'jpeg', 'png', 'webp', 'svg'];
    $allowedMimes = ['image/jpeg', 'image/png', 'image/webp', 'image/svg+xml'];

    $fileName = $file['name'];
    $fileTmp  = $file['tmp_name'];
    $fileSize = $file['size'];
    $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Validasi ekstensi
    if (!in_array($ext, $allowedExts, true)) {
        throw new Exception('Format file gambar tidak diizinkan. Gunakan JPG, PNG, WEBP, atau SVG.');
    }

    // Validasi ukuran (maksimal 2MB)
    if ($fileSize > 2 * 1024 * 1024) {
        throw new Exception('Ukuran file gambar maksimal 2MB.');
    }

    // Buat nama file unik
    $newFileName = 'menu_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
    $targetPath = $uploadDir . $newFileName;

    if (!move_uploaded_file($fileTmp, $targetPath)) {
        throw new Exception('Gagal memindahkan file gambar yang diunggah.');
    }

    return $newFileName;
}

// -------------------------------------------------------------
// PROSES: TAMBAH MENU BARU
// -------------------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action_add'])) {
    $name        = sanitize($_POST['name'] ?? '');
    $category    = sanitize($_POST['category'] ?? 'Makanan');
    $description = sanitize($_POST['description'] ?? '');
    $price       = (float)($_POST['price'] ?? 0);
    $status      = sanitize($_POST['status'] ?? 'available');

    if (empty($name) || $price <= 0) {
        set_flash_message('danger', 'Nama menu dan harga valid wajib diisi.');
    } else {
        try {
            $imageName = 'default-menu.svg';
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $uploaded = handle_image_upload($_FILES['image'], $uploadDir);
                if ($uploaded) {
                    $imageName = $uploaded;
                }
            }

            $stmt = $pdo->prepare("INSERT INTO menus (name, category, description, price, image, status, created_at) VALUES (?, ?, ?, ?, ?, ?, NOW())");
            $stmt->execute([$name, $category, $description, $price, $imageName, $status]);

            set_flash_message('success', "Menu <strong>{$name}</strong> berhasil ditambahkan beserta gambar!");
            header("Location: " . base_url('admin/menus.php'));
            exit;
        } catch (Exception $e) {
            set_flash_message('danger', 'Gagal menambahkan menu: ' . $e->getMessage());
        }
    }
}

// -------------------------------------------------------------
// PROSES: EDIT / UPDATE MENU
// -------------------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action_edit'])) {
    $id          = (int)($_POST['id'] ?? 0);
    $name        = sanitize($_POST['name'] ?? '');
    $category    = sanitize($_POST['category'] ?? 'Makanan');
    $description = sanitize($_POST['description'] ?? '');
    $price       = (float)($_POST['price'] ?? 0);
    $status      = sanitize($_POST['status'] ?? 'available');

    if ($id <= 0 || empty($name) || $price <= 0) {
        set_flash_message('danger', 'Data menu tidak valid.');
    } else {
        try {
            // Ambil gambar lama
            $stmtOld = $pdo->prepare("SELECT image FROM menus WHERE id = ?");
            $stmtOld->execute([$id]);
            $oldImage = $stmtOld->fetchColumn();

            $imageName = $oldImage;
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $uploaded = handle_image_upload($_FILES['image'], $uploadDir);
                if ($uploaded) {
                    $imageName = $uploaded;
                }
            }

            $stmt = $pdo->prepare("UPDATE menus SET name = ?, category = ?, description = ?, price = ?, image = ?, status = ? WHERE id = ?");
            $stmt->execute([$name, $category, $description, $price, $imageName, $status, $id]);

            set_flash_message('success', "Menu <strong>{$name}</strong> berhasil diperbarui!");
            header("Location: " . base_url('admin/menus.php'));
            exit;
        } catch (Exception $e) {
            set_flash_message('danger', 'Gagal memperbarui menu: ' . $e->getMessage());
        }
    }
}

// -------------------------------------------------------------
// PROSES: HAPUS MENU
// -------------------------------------------------------------
if ($action === 'delete' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    try {
        // Cek apakah menu pernah dipesan
        $stmtCheck = $pdo->prepare("SELECT COUNT(*) FROM order_details WHERE menu_id = ?");
        $stmtCheck->execute([$id]);
        $usedCount = (int)$stmtCheck->fetchColumn();

        if ($usedCount > 0) {
            // Jika pernah dipesan, jangan hapus fisik database demi histori laporan, ubah status menjadi unavailable
            $stmtOff = $pdo->prepare("UPDATE menus SET status = 'unavailable' WHERE id = ?");
            $stmtOff->execute([$id]);
            set_flash_message('warning', "Menu tidak dapat dihapus permanen karena terdapat dalam riwayat transaksi. Status menu telah diubah menjadi <strong>Tidak Tersedia (Unavailable)</strong>.");
        } else {
            $stmtDel = $pdo->prepare("DELETE FROM menus WHERE id = ?");
            $stmtDel->execute([$id]);
            set_flash_message('success', "Menu berhasil dihapus dari sistem.");
        }
    } catch (PDOException $e) {
        set_flash_message('danger', 'Gagal menghapus menu: ' . $e->getMessage());
    }
    header("Location: " . base_url('admin/menus.php'));
    exit;
}

// Ambil seluruh daftar menu
$search = sanitize($_GET['search'] ?? '');
$filterCat = sanitize($_GET['category'] ?? '');

$sql = "SELECT * FROM menus WHERE 1=1";
$params = [];

if (!empty($filterCat) && $filterCat !== 'all') {
    $sql .= " AND category = ?";
    $params[] = $filterCat;
}

if (!empty($search)) {
    $sql .= " AND (name LIKE ? OR description LIKE ?)";
    $params[] = "%{$search}%";
    $params[] = "%{$search}%";
}

$sql .= " ORDER BY category ASC, id DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$menus = $stmt->fetchAll();

$pageTitle = 'Kelola Menu Cafe';
require_once __DIR__ . '/../includes/header.php';
?>

<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <h2 class="fw-bold mb-1"><i class="bi bi-grid-fill text-warning me-2"></i>Kelola Daftar Menu Cafe</h2>
        <p class="text-muted small mb-0">Tambah, ubah foto/deskripsi/harga, dan atur ketersediaan menu cafe</p>
    </div>
    <div>
        <button type="button" class="btn btn-warning rounded-pill px-4 py-2 fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#modalAddMenu">
            <i class="bi bi-plus-circle-fill me-1"></i> Tambah Menu Baru
        </button>
    </div>
</div>

<!-- Filter Box -->
<div class="card border-0 shadow-sm p-3 mb-4 bg-white">
    <form action="<?php echo base_url('admin/menus.php'); ?>" method="GET" class="row g-2 align-items-center">
        <div class="col-lg-7 d-flex flex-wrap gap-2">
            <a href="<?php echo base_url('admin/menus.php'); ?>" class="btn btn-sm rounded-pill px-3 <?php echo (empty($filterCat) || $filterCat === 'all') ? 'btn-dark' : 'btn-outline-secondary'; ?>">
                Semua Kategori
            </a>
            <a href="<?php echo base_url('admin/menus.php?category=Makanan'); ?>" class="btn btn-sm rounded-pill px-3 <?php echo ($filterCat === 'Makanan') ? 'btn-dark' : 'btn-outline-secondary'; ?>">
                Makanan
            </a>
            <a href="<?php echo base_url('admin/menus.php?category=Minuman'); ?>" class="btn btn-sm rounded-pill px-3 <?php echo ($filterCat === 'Minuman') ? 'btn-dark' : 'btn-outline-secondary'; ?>">
                Minuman
            </a>
            <a href="<?php echo base_url('admin/menus.php?category=Snack'); ?>" class="btn btn-sm rounded-pill px-3 <?php echo ($filterCat === 'Snack') ? 'btn-dark' : 'btn-outline-secondary'; ?>">
                Snack
            </a>
        </div>
        <div class="col-lg-5">
            <div class="input-group">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Cari nama menu..." value="<?php echo htmlspecialchars($search); ?>">
                <button class="btn btn-sm btn-dark px-3" type="submit"><i class="bi bi-search"></i></button>
            </div>
        </div>
    </form>
</div>

<!-- Tabel Daftar Menu -->
<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <?php if (empty($menus)): ?>
            <div class="text-center py-5">
                <i class="bi bi-inbox fs-1 text-muted"></i>
                <h5 class="fw-bold mt-3 mb-1">Belum Ada Menu</h5>
                <p class="text-muted small">Klik tombol "Tambah Menu Baru" untuk menambahkan menu pertama Anda.</p>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4" style="width: 80px;">Foto</th>
                            <th>Nama Menu</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($menus as $m): ?>
                            <tr>
                                <td class="ps-4">
                                    <img src="<?php echo get_menu_image_url($m['image']); ?>" alt="" width="56" height="56" class="rounded object-fit-cover bg-light p-1 border">
                                </td>
                                <td>
                                    <div class="fw-bold text-dark"><?php echo htmlspecialchars($m['name']); ?></div>
                                    <small class="text-muted text-truncate d-inline-block" style="max-width: 320px;">
                                        <?php echo htmlspecialchars($m['description']); ?>
                                    </small>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border"><?php echo htmlspecialchars($m['category']); ?></span>
                                </td>
                                <td class="fw-bold text-success">
                                    <?php echo format_rupiah($m['price']); ?>
                                </td>
                                <td>
                                    <?php if ($m['status'] === 'available'): ?>
                                        <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-2 py-1 rounded-pill">
                                            <i class="bi bi-check-circle me-1"></i> Tersedia
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary border px-2 py-1 rounded-pill">
                                            <i class="bi bi-dash-circle me-1"></i> Habis (Off)
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end pe-4">
                                    <button type="button" class="btn btn-sm btn-outline-dark rounded-pill px-3 me-1" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#modalEditMenu<?php echo $m['id']; ?>">
                                        <i class="bi bi-pencil-square me-1"></i> Edit
                                    </button>
                                    <a href="<?php echo base_url('admin/menus.php?action=delete&id=' . $m['id']); ?>" 
                                       class="btn btn-sm btn-outline-danger rounded-pill px-3" 
                                       onclick="return confirm('Apakah Anda yakin ingin menghapus menu \'<?php echo addslashes($m['name']); ?>\'?');">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>

                            <!-- MODAL EDIT MENU -->
                            <div class="modal fade" id="modalEditMenu<?php echo $m['id']; ?>" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0 shadow">
                                        <div class="modal-header bg-dark text-white">
                                            <h5 class="modal-title fw-bold"><i class="bi bi-pencil-square me-2 text-warning"></i>Edit Menu Cafe</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="<?php echo base_url('admin/menus.php'); ?>" method="POST" enctype="multipart/form-data">
                                            <input type="hidden" name="action_edit" value="1">
                                            <input type="hidden" name="id" value="<?php echo $m['id']; ?>">

                                            <div class="modal-body p-4">
                                                <div class="mb-3">
                                                    <label class="form-label fw-semibold">Nama Menu</label>
                                                    <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($m['name']); ?>" required>
                                                </div>
                                                <div class="row g-3 mb-3">
                                                    <div class="col-md-6">
                                                        <label class="form-label fw-semibold">Kategori</label>
                                                        <select name="category" class="form-select" required>
                                                            <option value="Makanan" <?php echo ($m['category'] === 'Makanan') ? 'selected' : ''; ?>>Makanan</option>
                                                            <option value="Minuman" <?php echo ($m['category'] === 'Minuman') ? 'selected' : ''; ?>>Minuman</option>
                                                            <option value="Snack" <?php echo ($m['category'] === 'Snack') ? 'selected' : ''; ?>>Snack / Camilan</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label fw-semibold">Harga (Rp)</label>
                                                        <input type="number" name="price" class="form-control" value="<?php echo (int)$m['price']; ?>" min="500" step="500" required>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-semibold">Deskripsi Menu</label>
                                                    <textarea name="description" class="form-control" rows="2"><?php echo htmlspecialchars($m['description']); ?></textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-semibold">Status Ketersediaan</label>
                                                    <select name="status" class="form-select">
                                                        <option value="available" <?php echo ($m['status'] === 'available') ? 'selected' : ''; ?>>Tersedia (Aktif di Menu)</option>
                                                        <option value="unavailable" <?php echo ($m['status'] === 'unavailable') ? 'selected' : ''; ?>>Habis / Tidak Tersedia</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-semibold">Ganti Gambar Menu (Opsional)</label>
                                                    <input type="file" name="image" class="form-control" accept="image/*">
                                                    <small class="text-muted d-block mt-1">Format: JPG, PNG, WEBP, SVG (Maks. 2MB). Biarkan kosong jika tidak ingin mengganti gambar.</small>
                                                </div>
                                            </div>
                                            <div class="modal-footer bg-light">
                                                <button type="button" class="btn btn-outline-secondary rounded-pill px-3" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-warning rounded-pill px-4 fw-bold">Simpan Perubahan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- MODAL TAMBAH MENU BARU -->
<div class="modal fade" id="modalAddMenu" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title fw-bold"><i class="bi bi-plus-circle-fill me-2 text-warning"></i>Tambah Menu Baru</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?php echo base_url('admin/menus.php'); ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="action_add" value="1">

                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Menu</label>
                        <input type="text" name="name" class="form-control" placeholder="Contoh: Spaghetti Bolognese" required>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Kategori</label>
                            <select name="category" class="form-select" required>
                                <option value="Makanan" selected>Makanan</option>
                                <option value="Minuman">Minuman</option>
                                <option value="Snack">Snack / Camilan</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Harga (Rp)</label>
                            <input type="number" name="price" class="form-control" placeholder="25000" min="500" step="500" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Deskripsi Menu</label>
                        <textarea name="description" class="form-control" rows="2" placeholder="Jelaskan bahan utama dan kelezatan menu..."></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Status Ketersediaan</label>
                        <select name="status" class="form-select">
                            <option value="available" selected>Tersedia (Aktif di Menu)</option>
                            <option value="unavailable">Habis / Tidak Tersedia</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Upload Gambar Menu</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                        <small class="text-muted d-block mt-1">Format: JPG, PNG, WEBP, SVG (Maks. 2MB). Jika dikosongkan, gambar default akan digunakan.</small>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-outline-secondary rounded-pill px-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning rounded-pill px-4 fw-bold">Tambahkan Menu</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
