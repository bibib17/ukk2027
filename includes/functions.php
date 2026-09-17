<?php
/**
 * Helper Functions Aplikasi Taking Order Cafe
 * Berisi kumpulan fungsi utilitas yang digunakan di seluruh sistem.
 */

// Memulai session jika belum aktif
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Mengembalikan Base URL aplikasi agar path asset & link selalu konsisten
 */
function base_url($path = '') {
    static $base = null;
    if ($base === null) {
        $docRoot = isset($_SERVER['DOCUMENT_ROOT']) ? str_replace('\\', '/', realpath($_SERVER['DOCUMENT_ROOT'])) : '';
        $appRoot = str_replace('\\', '/', realpath(__DIR__ . '/..'));
        
        if (!empty($docRoot) && strpos($appRoot, $docRoot) === 0) {
            $base = substr($appRoot, strlen($docRoot));
        } else {
            // Fallback jika dijalankan via PHP CLI Server atau path khusus
            $scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));
            $parts = explode('/', trim($scriptDir, '/'));
            $base = isset($parts[0]) && $parts[0] !== '' ? '/' . $parts[0] : '';
        }
        $base = '/' . trim($base, '/');
        if ($base === '/') {
            $base = '';
        }
    }
    return $base . '/' . ltrim($path, '/');
}

/**
 * Membersihkan input untuk mencegah serangan XSS (Cross-Site Scripting)
 */
function sanitize($data) {
    if (is_array($data)) {
        return array_map('sanitize', $data);
    }
    return htmlspecialchars(trim((string)$data), ENT_QUOTES, 'UTF-8');
}

/**
 * Format angka menjadi format mata uang Rupiah (contoh: Rp 22.000)
 */
function format_rupiah($number) {
    return 'Rp ' . number_format((float)$number, 0, ',', '.');
}

/**
 * Menghasilkan kode pesanan unik berformat ORD-YYYYMMDD-XXXX
 */
function generate_order_code($pdo) {
    $datePrefix = 'ORD-' . date('Ymd') . '-';
    
    // Cari urutan terakhir pada hari ini
    $stmt = $pdo->prepare("SELECT order_code FROM orders WHERE order_code LIKE ? ORDER BY id DESC LIMIT 1");
    $stmt->execute([$datePrefix . '%']);
    $lastOrder = $stmt->fetch();
    
    if ($lastOrder) {
        $lastNumber = (int)substr($lastOrder['order_code'], -4);
        $nextNumber = $lastNumber + 1;
    } else {
        $nextNumber = 1;
    }
    
    return $datePrefix . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
}

/**
 * Menghasilkan badge HTML Bootstrap sesuai status pesanan
 */
function render_status_badge($status) {
    $badgeClass = 'bg-secondary';
    $icon = 'bi-clock';
    
    switch ($status) {
        case 'Menunggu':
            $badgeClass = 'bg-warning text-dark';
            $icon = 'bi-hourglass-split';
            break;
        case 'Diproses':
            $badgeClass = 'bg-primary text-white';
            $icon = 'bi-arrow-repeat';
            break;
        case 'Selesai':
            $badgeClass = 'bg-success text-white';
            $icon = 'bi-check-circle-fill';
            break;
        case 'Dibatalkan':
            $badgeClass = 'bg-danger text-white';
            $icon = 'bi-x-circle-fill';
            break;
    }
    
    return '<span class="badge ' . $badgeClass . ' px-3 py-2 rounded-pill"><i class="bi ' . $icon . ' me-1"></i> ' . htmlspecialchars($status) . '</span>';
}

/**
 * Mengembalikan URL gambar menu, otomatis mencari file gambar yang diupload atau default SVG
 */
function get_menu_image_url($imageName) {
    if (empty($imageName)) {
        return base_url('assets/img/default-menu.svg');
    }
    
    $imgPath = __DIR__ . '/../assets/img/' . $imageName;
    if (file_exists($imgPath)) {
        return base_url('assets/img/' . $imageName);
    }
    
    $baseName = pathinfo($imageName, PATHINFO_FILENAME);
    $svgPath = __DIR__ . '/../assets/img/' . $baseName . '.svg';
    if (file_exists($svgPath)) {
        return base_url('assets/img/' . $baseName . '.svg');
    }
    
    $pngPath = __DIR__ . '/../assets/img/' . $baseName . '.png';
    if (file_exists($pngPath)) {
        return base_url('assets/img/' . $baseName . '.png');
    }
    
    return base_url('assets/img/default-menu.svg');
}

/**
 * Set flash message untuk feedback notifikasi (success, danger, warning, info)
 */
function set_flash_message($type, $message) {
    $_SESSION['flash_message'] = [
        'type'    => $type,
        'message' => $message
    ];
}

/**
 * Menampilkan dan membersihkan flash message jika ada
 */
function render_flash_message() {
    if (isset($_SESSION['flash_message'])) {
        $flash = $_SESSION['flash_message'];
        $type = htmlspecialchars($flash['type']);
        // Izinkan tag pemformatan aman (strong, b, em, code, i) agar elemen HTML dirender dengan benar
        $msg = strip_tags($flash['message'], '<strong><b><em><code><i><small><span>');
        
        $icon = 'bi-info-circle';
        if ($type === 'success') {
            $icon = 'bi-check-circle-fill';
        } elseif ($type === 'danger') {
            $icon = 'bi-exclamation-octagon-fill';
        } elseif ($type === 'warning') {
            $icon = 'bi-exclamation-triangle-fill';
        }
        
        echo '<div class="alert alert-' . $type . ' alert-dismissible fade show my-3 shadow-sm d-flex align-items-center" role="alert">';
        echo '<i class="bi ' . $icon . ' fs-5 me-2"></i>';
        echo '<div>' . $msg . '</div>';
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
        
        unset($_SESSION['flash_message']);
    }
}
