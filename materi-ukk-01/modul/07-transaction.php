<?php
$modulTitle = 'Modul 07: Transaksi Database Atomik (PDO Transaction)';
$modulNumber = 7;
require_once __DIR__ . '/../includes/header.php';
?>

<div class="neu-card p-4 p-md-5 mb-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        <span class="neu-badge neu-badge-primary">
            <i class="bi bi-arrow-left-right"></i> Modul 07 - Keutuhan Data Tingkat Lanjut
        </span>
        <span class="text-muted small">Target: Menguasai beginTransaction(), commit(), & rollBack() PDO</span>
    </div>

    <h2 class="fw-extrabold mb-3 text-dark">Transaksi Database Atomik (PDO Transaction)</h2>
    <p class="lead text-muted mb-4">
        Transaksi Database menjamin bahwa serangkaian query SQL yang saling berhubungan harus <strong>sukses semuanya</strong>, atau jika ada 1 saja yang gagal, <strong>seluruh data dibatalkan</strong> sehingga database tidak rusak.
    </p>

    <!-- 1. Konsep Inti 5 Detik -->
    <div class="neu-card-sm p-4 mb-4 bg-white">
        <h5 class="fw-bold mb-2 text-dark"><i class="bi bi-bullseye text-primary me-2"></i>Konsep 5 Detik:</h5>
        <p class="mb-0 text-muted">
            Menyimpan pesanan cafe butuh 2 langkah: (1) Simpan ke tabel <code>orders</code>, lalu (2) Simpan ke tabel <code>order_details</code>. Dengan Transaksi PDO, jika langkah ke-2 gagal (misal server mati), langkah ke-1 otomatis dibatalkan (Rollback). Tidak ada pesanan kosong tanpa rincian makanan!
        </p>
    </div>

    <!-- 2. Analogi Dunia Nyata -->
    <div class="analogy-box mb-4">
        <h5 class="fw-bold text-primary mb-2"><i class="bi bi-lightbulb-fill me-2"></i>Analogi Dunia Nyata: "Tarik Tunai di Mesin ATM"</h5>
        <p class="mb-0">
            Saat Anda mengambil uang Rp 100.000 di ATM, mesin melakukan 2 hal: (1) Mengeluarkan lembaran uang kertas, dan (2) Memotong saldo rekening Anda di komputer bank. Jika saat uang hendak keluar mesin macet, sistem ATM langsung membatalkan pemotongan saldo (<strong>Rollback</strong>). Saldo Anda tetap utuh dan tidak terpotong secara cuma-cuma.
        </p>
    </div>

    <!-- 3. Live Interactive Playground -->
    <h5 class="fw-bold mb-3 text-dark"><i class="bi bi-play-circle text-primary me-2"></i>Live Interactive Playground:</h5>
    <div class="demo-stage mb-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="neu-card p-4">
                    <h6 class="fw-bold mb-3 text-center">Simulasi Alur Transaksi Database</h6>
                    
                    <div class="form-check form-switch mb-3 p-2 neu-inset d-flex justify-content-between align-items-center">
                        <label class="form-check-label small fw-semibold text-dark ps-2" for="errorToggle">Simulasikan Terjadi Error di Tengah Proses:</label>
                        <input class="form-check-input ms-0 me-2" type="checkbox" id="errorToggle">
                    </div>

                    <button type="button" class="neu-btn neu-btn-primary w-100 mb-3" onclick="runTransactionSim()">
                        <i class="bi bi-play-fill me-1"></i> Jalankan Transaksi Simpan Pesanan
                    </button>

                    <div id="txSteps" class="neu-inset p-3 small text-muted font-monospace" style="min-height: 120px;">
                        Klik tombol di atas untuk memulai simulasi...
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 4. Interactive Code Tabs -->
    <div class="neu-tabs-container">
        <div class="neu-tabs">
            <button type="button" class="neu-tab-btn active" data-tab="php">1. Kode PHP PDO Transaction</button>
            <button type="button" class="neu-tab-btn" data-tab="sql">2. Skema Relasi Database</button>
            <button type="button" class="neu-tab-btn" data-tab="explanation">3. Bedah Baris per Baris</button>
        </div>

        <!-- Tab 1: PHP -->
        <div class="neu-tab-content active" id="tab-php">
            <div class="code-container">
                <button type="button" class="btn-copy-code"><i class="bi bi-clipboard"></i> Salin</button>
                <pre><code>&lt;?php
try {
    // 1. MULAI TRANSAKSI (Kunci Operasi)
    $pdo->beginTransaction();

    // 2. Query 1: Simpan Header Order
    $stmt1 = $pdo->prepare("INSERT INTO orders (order_code, user_id, total) VALUES (?, ?, ?)");
    $stmt1->execute([$orderCode, $userId, $grandTotal]);
    $orderId = $pdo->lastInsertId(); // Ambil ID pesanan yang baru dibuat

    // 3. Query 2: Simpan Rincian Menu ke order_details
    $stmt2 = $pdo->prepare("INSERT INTO order_details (order_id, menu_id, price, quantity, subtotal) VALUES (?, ?, ?, ?, ?)");
    foreach ($orderItems as $item) {
        $stmt2->execute([$orderId, $item['menu_id'], $item['price'], $item['quantity'], $item['subtotal']]);
    }

    // 4. JIKA SEMUA BERHASIL: COMMIT (Simpan Permanen)
    $pdo->commit();
    echo "Transaksi Berhasil!";

} catch (Exception $e) {
    // 5. JIKA TERJADI ERROR: ROLLBACK (Batalkan Seluruh Query di Atas)
    $pdo->rollBack();
    echo "Terjadi kesalahan: " . $e->getMessage();
}
?&gt;</code></pre>
            </div>
        </div>

        <!-- Tab 2: SQL -->
        <div class="neu-tab-content" id="tab-sql">
            <div class="code-container">
                <button type="button" class="btn-copy-code"><i class="bi bi-clipboard"></i> Salin</button>
                <pre><code>-- Pastikan menggunakan ENGINE=InnoDB agar mendukung Transaksi & Foreign Key
CREATE TABLE `orders` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `order_code` VARCHAR(50) UNIQUE,
    `total` DECIMAL(12,2)
) ENGINE=InnoDB;

CREATE TABLE `order_details` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `order_id` INT,
    `menu_id` INT,
    FOREIGN KEY (`order_id`) REFERENCES `orders`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB;</code></pre>
            </div>
        </div>

        <!-- Tab 3: Explanation -->
        <div class="neu-tab-content" id="tab-explanation">
            <div class="neu-card-sm p-4 bg-white">
                <h6 class="fw-bold mb-3">Penjelasan Anatomi Logika:</h6>
                <ul class="text-muted small mb-0">
                    <li class="mb-2"><code>$pdo->beginTransaction()</code>: Memberi tahu MySQL untuk menahan penulisan permanen ke hard disk sampai perintah <code>commit()</code> diberikan.</li>
                    <li class="mb-2"><code>$pdo->lastInsertId()</code>: Mengambil ID primary key auto_increment dari tabel <code>orders</code> untuk digunakan sebagai relasi foreign key pada <code>order_details</code>.</li>
                    <li class="mb-2"><code>$pdo->commit()</code>: Mengesahkan seluruh query yang dieksekusi secara permanen ke database.</li>
                    <li><code>$pdo->rollBack()</code>: Menghapus kembali semua perubahan sementara jika terjadi kesalahan saat proses berlangsung.</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- 5. Trik Hafalan Cepat / Mnemonics -->
    <div class="trick-box my-4">
        <h5 class="fw-bold text-warning mb-2"><i class="bi bi-key-fill me-2"></i>Trik Hafalan Cepat: Rumus "B-C-R"</h5>
        <ul class="mb-0 fw-semibold text-dark">
            <li><strong>B (Begin):</strong> <code>$pdo->beginTransaction()</code> di awal sebelum query.</li>
            <li><strong>C (Commit):</strong> <code>$pdo->commit()</code> di akhir blok try.</li>
            <li><strong>R (Rollback):</strong> <code>$pdo->rollBack()</code> di dalam blok catch error.</li>
        </ul>
    </div>

    <!-- 6. Jebakan Error Pemula & Solusi -->
    <div class="gotcha-box">
        <h5 class="fw-bold text-danger mb-2"><i class="bi bi-exclamation-triangle-fill me-2"></i>Jebakan Error Pemula:</h5>
        <p class="small mb-1">
            <strong>❌ Masalah:</strong> Fungsi <code>rollBack()</code> tidak bekerja dan data yang salah tetap tersimpan di tabel MySQL.<br>
            <strong>🔍 Penyebab:</strong> Tabel MySQL dibuat dengan tipe engine lama <code>MyISAM</code> yang tidak mendukung transaksi.<br>
            <strong>✅ Solusi:</strong> Selalu buat tabel dengan <code>ENGINE=InnoDB</code> pada saat mengeksekusi skrip DDL SQL.
        </p>
    </div>
</div>

<script>
function runTransactionSim() {
    const isError = document.getElementById('errorToggle').checked;
    const box = document.getElementById('txSteps');
    box.innerHTML = `[1/4] $pdo->beginTransaction() &rarr; Membuka transaksi database...<br>`;

    setTimeout(() => {
        box.innerHTML += `[2/4] INSERT INTO orders (Header) &rarr; Berhasil! (ID: #101)<br>`;
        setTimeout(() => {
            if (isError) {
                box.innerHTML += `<span class="text-danger">[3/4] ERROR: Gagal simpan order_details (Koneksi Terputus!)</span><br>`;
                box.innerHTML += `<strong class="text-danger">[4/4] $pdo->rollBack() &rarr; Membatalkan seluruh pesanan! Data tetap aman & bersih.</strong>`;
            } else {
                box.innerHTML += `[3/4] INSERT INTO order_details (3 Item) &rarr; Berhasil!<br>`;
                box.innerHTML += `<strong class="text-success">[4/4] $pdo->commit() &rarr; Transaksi Sempurna! Data tersimpan permanen.</strong>`;
            }
        }, 600);
    }, 500);
}
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
