<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/auth.php';

// Jika sudah login, langsung alihkan ke dashboard masing-masing
if (is_logged_in()) {
    $role = $_SESSION['user']['role'] ?? '';
    header("Location: " . base_url($role === 'admin' ? 'admin/dashboard.php' : 'customer/dashboard.php'));
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($username) || empty($password)) {
        $error = 'Silakan masukkan username dan password.';
    } else {
        try {
            $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? LIMIT 1");
            $stmt->execute([$username]);
            $user = $stmt->fetch();

            if ($user && password_verify($password, $user['password'])) {
                // Set Data Sesi Pengguna
                $_SESSION['user'] = [
                    'id'       => $user['id'],
                    'name'     => $user['name'],
                    'username' => $user['username'],
                    'role'     => $user['role']
                ];

                set_flash_message('success', "Selamat datang kembali, <strong>" . htmlspecialchars($user['name']) . "</strong>!");

                if ($user['role'] === 'admin') {
                    header("Location: " . base_url('admin/dashboard.php'));
                } else {
                    header("Location: " . base_url('customer/dashboard.php'));
                }
                exit;
            } else {
                $error = 'Username atau password yang Anda masukkan salah.';
            }
        } catch (PDOException $e) {
            $error = 'Terjadi gangguan sistem database. Silakan coba lagi.';
        }
    }
}

$pageTitle = 'Login Pengguna';
require_once __DIR__ . '/../includes/header.php';
?>

<div class="row justify-content-center py-4">
    <div class="col-md-6 col-lg-5">
        <div class="card border-0 shadow-sm p-4 p-md-5">
            <div class="text-center mb-4">
                <div class="brand-icon bg-warning text-dark d-inline-flex align-items-center justify-content-center rounded-circle p-3 shadow-sm mb-3" style="width: 60px; height: 60px;">
                    <i class="bi bi-person-circle fs-2"></i>
                </div>
                <h3 class="fw-bold mb-1">Masuk ke Sistem</h3>
                <p class="text-muted small">Aplikasi Taking Order Cafe</p>
            </div>

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger alert-dismissible fade show small" role="alert">
                    <i class="bi bi-exclamation-octagon-fill me-1"></i> <?php echo htmlspecialchars($error); ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <form action="<?php echo base_url('auth/login.php'); ?>" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label fw-semibold">Username</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-person"></i></span>
                        <input type="text" name="username" id="username" class="form-control border-start-0" placeholder="Masukkan username" required autofocus value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
                    </div>
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label fw-semibold">Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-lock"></i></span>
                        <input type="password" name="password" id="password" class="form-control border-start-0" placeholder="Masukkan password" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-warning w-100 py-2 rounded-pill fw-bold mb-3 shadow-sm">
                    <i class="bi bi-box-arrow-in-right me-1"></i> Masuk Sekarang
                </button>
            </form>

            <div class="text-center pt-3 border-top">
                <p class="text-muted small mb-0">
                    Belum memiliki akun pelanggan? 
                    <a href="<?php echo base_url('auth/register.php'); ?>" class="fw-bold text-decoration-none">Daftar di sini</a>
                </p>
            </div>
        </div>

        <!-- Akun Demo Card untuk Uji Kompetensi -->
        <div class="card border-0 bg-white shadow-sm mt-3 p-3">
            <h6 class="fw-bold text-muted small mb-2"><i class="bi bi-info-circle me-1"></i> Akun Pengujian (Demo):</h6>
            <div class="row g-2 small text-muted">
                <div class="col-6">
                    <div class="p-2 bg-light rounded border">
                        <span class="badge bg-danger">Admin</span><br>
                        User: <code>admin</code><br>
                        Pass: <code>password</code>
                    </div>
                </div>
                <div class="col-6">
                    <div class="p-2 bg-light rounded border">
                        <span class="badge bg-warning text-dark">Pelanggan</span><br>
                        User: <code>customer</code><br>
                        Pass: <code>password</code>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
