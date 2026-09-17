<?php
require_once __DIR__ . '/../includes/functions.php';

// Hapus seluruh session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$_SESSION = [];
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}
session_destroy();

// Mulai sesi baru khusus untuk mengirim flash message logout
session_start();
set_flash_message('info', 'Anda telah berhasil logout dari sistem.');

header("Location: " . base_url('auth/login.php'));
exit;
