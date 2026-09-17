<?php
/**
 * Auth Middleware & Session Guard
 * Mengatur perlindungan hak akses (Role Authorization) untuk Admin dan Customer.
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Mengecek apakah pengguna sudah login
 */
function is_logged_in() {
    return isset($_SESSION['user']) && !empty($_SESSION['user']['id']);
}

/**
 * Mengembalikan data pengguna yang sedang login
 */
function current_user() {
    return is_logged_in() ? $_SESSION['user'] : null;
}

/**
 * Membatasi akses hanya untuk role tertentu.
 * Jika belum login -> diarahkan ke login.
 * Jika role tidak sesuai -> tampilkan peringatan forbidden.
 * 
 * @param array|string $allowedRoles 'admin', 'customer', atau ['admin', 'customer']
 */
function require_role($allowedRoles) {
    if (!is_array($allowedRoles)) {
        $allowedRoles = [$allowedRoles];
    }
    
    // Jika belum login
    if (!is_logged_in()) {
        if (function_exists('set_flash_message')) {
            set_flash_message('danger', 'Silakan login terlebih dahulu untuk mengakses halaman ini.');
        }
        $loginUrl = base_url('auth/login.php');
        header("Location: {$loginUrl}");
        exit;
    }
    
    $userRole = $_SESSION['user']['role'] ?? '';
    
    // Jika role tidak diizinkan
    if (!in_array($userRole, $allowedRoles, true)) {
        http_response_code(403);
        ?>
        <!DOCTYPE html>
        <html lang="id">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>403 - Akses Ditolak</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        </head>
        <body class="bg-light d-flex align-items-center min-vh-100">
            <div class="container text-center">
                <div class="card shadow-sm border-0 p-5 mx-auto" style="max-width: 500px; border-radius: 16px;">
                    <div class="mb-3 text-danger">
                        <i class="bi bi-shield-lock-fill" style="font-size: 4rem;"></i>
                    </div>
                    <h2 class="fw-bold mb-2">Akses Ditolak</h2>
                    <p class="text-muted mb-4">Anda tidak memiliki hak akses untuk membuka halaman ini.</p>
                    <div>
                        <a href="<?php echo base_url($userRole === 'admin' ? 'admin/dashboard.php' : 'customer/dashboard.php'); ?>" class="btn btn-primary px-4 py-2 rounded-pill">
                            <i class="bi bi-arrow-left me-1"></i> Kembali ke Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </body>
        </html>
        <?php
        exit;
    }
}
