<?php
/**
 * Konfigurasi Koneksi Database Menggunakan PDO
 * Mengutamakan kejelasan, keamanan (Prepared Statements), dan penanganan error.
 */

$host     = 'localhost';
$dbname   = 'taking_order_cafe';
$username = 'root';
$password = ''; // Default XAMPP adalah string kosong

try {
    $dsn = "mysql:host={$host};dbname={$dbname};charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    // Jika koneksi gagal, hentikan proses dan tampilkan pesan yang mudah dipahami
    die("<h3>Koneksi Database Gagal:</h3> " . htmlspecialchars($e->getMessage()) . "<br><small>Pastikan MySQL di XAMPP sudah berjalan dan database `taking_order_cafe` sudah diimpor.</small>");
}
