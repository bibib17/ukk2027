<?php
$host = 'localhost';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host={$host}", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    
    $sqlFile = __DIR__ . '/database.sql';
    if (!file_exists($sqlFile)) {
        die("File database.sql tidak ditemukan di {$sqlFile}\n");
    }
    
    $sql = file_get_contents($sqlFile);
    $pdo->exec($sql);
    echo "SUCCESS: Database `taking_order_cafe` berhasil dibuat dan diimpor lengkap dengan data awal!\n";
    
    // Verifikasi tabel
    $tables = $pdo->query("SHOW TABLES FROM `taking_order_cafe`")->fetchAll(PDO::FETCH_COLUMN);
    echo "Tabel yang terbentuk: " . implode(', ', $tables) . "\n";
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
