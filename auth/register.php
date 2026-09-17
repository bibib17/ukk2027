<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/auth.php';

// Jika sudah login, alihkan
if (is_logged_in()) {
    header("Location: " . base_url('customer/dashboard.php'));
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name            = trim($_POST['name'] ?? '');
    $username        = trim($_POST['username'] ?? '');
    $password        = trim($_POST['password'] ?? '');
    $confirmPassword = trim($_POST['confirm_password'] ?? '');

    // Validasi Form
    if (empty($name) || empty($username) || empty($password) || empty($confirmPassword)) {
        $error = 'Seluruh kolom pendaftaran wajib diisi.';
    } elseif (strlen($username) < 3) {
        $error = 'Username minimal terdiri dari 3 karakter.';
    } elseif ($password !== $confirmPassword) {
        $error = 'Konfirmasi password tidak cocok dengan password.';
    } elseif (strlen($password) < 4) {
        $error = 'Password minimal terdiri dari 4 karakter demi keamanan.';
    } else {
        try {
            // Cek apakah username sudah dipakai
            $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ? LIMIT 1");
            $stmt->execute([$username]);
            if ($stmt->fetch()) {
                $error = "Username '{$username}' sudah digunakan. Silakan pilih username lain.";
            } else {
                // Simpan user baru sebagai customer
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $insertStmt = $pdo->prepare("INSERT INTO users (name, username, password, role, created_at) VALUES (?, ?, ?, 'customer', NOW())");
                $insertStmt->execute([$name, $username, $hashedPassword]);

                set_flash_message('success', 'Pendaftaran akun berhasil! Silakan login dengan akun baru Anda.');
                header("Location: " . base_url('auth/login.php'));
                exit;
            }
        } catch (PDOException $e) {
            $error = 'Terjadi kesalahan sistem saat mendaftarkan akun. Silakan coba lagi.';
        }
    }
}

$pageTitle = 'Registrasi Pelanggan Baru';
require_once __DIR__ . '/../includes/header.php';
?>

<div class="row justify-content-center py-4">
    <div class="col-md-6 col-lg-5">
        <div class="card border-0 shadow-sm p-4 p-md-5">
            <div class="text-center mb-4">
                <div class="brand-icon bg-warning text-dark d-inline-flex align-items-center justify-content-center rounded-circle p-3 shadow-sm mb-3" style="width: 60px; height: 60px;">
                    <i class="bi bi-person-plus-fill fs-2"></i>
                </div>
                <h3 class="fw-bold mb-1">Daftar Akun Baru</h3>
                <p class="text-muted small">Buat akun untuk memesan menu favorit Anda</p>
            </div>

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger alert-dismissible fade show small" role="alert">
                    <i class="bi bi-exclamation-octagon-fill me-1"></i> <?php echo htmlspecialchars($error); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <form action="<?php echo base_url('auth/register.php'); ?>" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">Nama Lengkap</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-person-badge"></i></span>
                        <input type="text" name="name" id="name" class="form-control border-start-0" placeholder="Contoh: Andi Pratama" required value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="username" class="form-label fw-semibold">Username</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-at"></i></span>
                        <input type="text" name="username" id="username" class="form-control border-start-0" placeholder="Username tanpa spasi" required value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold">Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-lock"></i></span>
                        <input type="password" name="password" id="password" class="form-control border-start-0" placeholder="Minimal 4 karakter" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="confirm_password" class="form-label fw-semibold">Konfirmasi Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-shield-check"></i></span>
                        <input type="password" name="confirm_password" id="confirm_password" class="form-control border-start-0" placeholder="Ulangi password" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-warning w-100 py-2 rounded-pill fw-bold mb-3 shadow-sm">
                    <i class="bi bi-check2-circle me-1"></i> Buat Akun Pelanggan
                </button>
            </form>

            <div class="text-center pt-3 border-top">
                <p class="text-muted small mb-0">
                    Sudah memiliki akun? 
                    <a href="<?php echo base_url('auth/login.php'); ?>" class="fw-bold text-decoration-none">Login di sini</a>
                </p>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
