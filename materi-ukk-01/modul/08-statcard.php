<?php
$modulTitle = 'Modul 08: Kartu Statistik & Query Agregat (Stat Card & SQL)';
$modulNumber = 8;
require_once __DIR__ . '/../includes/header.php';
?>

<div class="neu-card p-4 p-md-5 mb-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        <span class="neu-badge neu-badge-primary">
            <i class="bi bi-speedometer2"></i> Modul 08 - Dashboard & Analitik Data
        </span>
        <span class="text-muted small">Target: Menguasai Query Agregat SQL COUNT & SUM untuk Dashboard Admin</span>
    </div>

    <h2 class="fw-extrabold mb-3 text-dark">Kartu Statistik Dashboard & Query Agregat (Stat Card & SQL)</h2>
    <p class="lead text-muted mb-4">
        Dashboard administrator membutuhkan ringkasan performa bisnis secara cepat: berapa total pesanan hari ini dan berapa total omzet uang yang berhasil didapatkan.
    </p>

    <!-- 1. Konsep Inti 5 Detik -->
    <div class="neu-card-sm p-4 mb-4 bg-white">
        <h5 class="fw-bold mb-2 text-dark"><i class="bi bi-bullseye text-primary me-2"></i>Konsep 5 Detik:</h5>
        <p class="mb-0 text-muted">
            Gunakan fungsi agregat SQL: <code>SELECT COUNT(*) FROM orders</code> untuk <strong>menghitung berapa banyak lembar pesanan</strong>, dan <code>SELECT SUM(total) FROM orders WHERE status = 'Selesai'</code> untuk <strong>menjumlahkan seluruh total uang masuk</strong>.
        </p>
    </div>

    <!-- 2. Analogi Dunia Nyata -->
    <div class="analogy-box mb-4">
        <h5 class="fw-bold text-primary mb-2"><i class="bi bi-lightbulb-fill me-2"></i>Analogi Dunia Nyata: "Panel Spedometer Mobil"</h5>
        <p class="mb-0">
            Saat mengemudi mobil, Anda tidak perlu turun dan mengukur putaran roda satu per satu; Anda cukup melihat <strong>Spedometer di Dashboard</strong> untuk mengetahui kecepatan saat ini dan jarum bensin untuk mengetahui sisa bahan bakar. Begitu juga Admin Cafe yang cukup melihat Kartu Statistik di dashboard untuk memantau omzet harian.
        </p>
    </div>

    <!-- 3. Live Interactive Playground -->
    <h5 class="fw-bold mb-3 text-dark"><i class="bi bi-play-circle text-primary me-2"></i>Live Interactive Playground:</h5>
    <div class="demo-stage mb-4">
        <div class="row g-3">
            <div class="col-sm-6 col-lg-3">
                <div class="neu-card p-3">
                    <span class="text-muted small d-block">Total Pesanan:</span>
                    <h3 class="fw-bold mb-0 text-dark" id="statOrders">25 <span class="fs-6 fw-normal text-muted">order</span></h3>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="neu-card p-3">
                    <span class="text-muted small d-block">Menunggu Diproses:</span>
                    <h3 class="fw-bold mb-0 text-warning" id="statPending">5 <span class="fs-6 fw-normal text-muted">order</span></h3>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="neu-card p-3">
                    <span class="text-muted small d-block">Sedang Dimasak:</span>
                    <h3 class="fw-bold mb-0 text-primary" id="statCooking">3 <span class="fs-6 fw-normal text-muted">order</span></h3>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="neu-card p-3">
                    <span class="text-muted small d-block">Total Omzet Selesai:</span>
                    <h4 class="fw-extrabold mb-0 text-success" id="statRevenue">Rp 450.000</h4>
                </div>
            </div>
        </div>
        <div class="text-center mt-3">
            <button type="button" class="neu-btn neu-btn-sm" onclick="randomizeStats()">
                <i class="bi bi-arrow-clockwise me-1"></i> Simulasi Data Baru Masuk
            </button>
        </div>
    </div>

    <!-- 4. Interactive Code Tabs -->
    <div class="neu-tabs-container">
        <div class="neu-tabs">
            <button type="button" class="neu-tab-btn active" data-tab="sql">1. Query SQL Agregat</button>
            <button type="button" class="neu-tab-btn" data-tab="php">2. Eksekusi PHP PDO</button>
            <button type="button" class="neu-tab-btn" data-tab="html">3. Card UI HTML</button>
            <button type="button" class="neu-tab-btn" data-tab="explanation">4. Bedah Baris per Baris</button>
        </div>

        <!-- Tab 1: SQL -->
        <div class="neu-tab-content active" id="tab-sql">
            <div class="code-container">
                <button type="button" class="btn-copy-code"><i class="bi bi-clipboard"></i> Salin</button>
                <pre><code>-- 1. Hitung seluruh pesanan
SELECT COUNT(*) FROM orders;

-- 2. Hitung pesanan yang statusnya 'Menunggu'
SELECT COUNT(*) FROM orders WHERE status = 'Menunggu';

-- 3. Hitung pesanan yang statusnya 'Diproses'
SELECT COUNT(*) FROM orders WHERE status = 'Diproses';

-- 4. Hitung total uang pendapatan hanya dari pesanan yang 'Selesai'
SELECT SUM(total) FROM orders WHERE status = 'Selesai';</code></pre>
            </div>
        </div>

        <!-- Tab 2: PHP -->
        <div class="neu-tab-content" id="tab-php">
            <div class="code-container">
                <button type="button" class="btn-copy-code"><i class="bi bi-clipboard"></i> Salin</button>
                <pre><code>&lt;?php
// 1. Ambil jumlah baris pesanan menggunakan fetchColumn()
$stmt = $pdo->query("SELECT COUNT(*) FROM orders");
$totalOrders = (int)$stmt->fetchColumn();

$stmt = $pdo->query("SELECT COUNT(*) FROM orders WHERE status = 'Menunggu'");
$pendingOrders = (int)$stmt->fetchColumn();

// 2. Ambil total pendapatan (SUM)
$stmt = $pdo->query("SELECT SUM(total) FROM orders WHERE status = 'Selesai'");
$totalRevenue = (float)$stmt->fetchColumn(); // Jika kosong otomatis 0
?&gt;</code></pre>
            </div>
        </div>

        <!-- Tab 3: HTML -->
        <div class="neu-tab-content" id="tab-html">
            <div class="code-container">
                <button type="button" class="btn-copy-code"><i class="bi bi-clipboard"></i> Salin</button>
                <pre><code>&lt;div class="row g-3"&gt;
    &lt;div class="col-md-6 col-lg-3"&gt;
        &lt;div class="neu-card p-3"&gt;
            &lt;small class="text-muted"&gt;Total Pesanan&lt;/small&gt;
            &lt;h3 class="fw-bold"&gt;&lt;?= $totalOrders ?&gt;&lt;/h3&gt;
        &lt;/div&gt;
    &lt;/div&gt;
    &lt;div class="col-md-6 col-lg-3"&gt;
        &lt;div class="neu-card p-3"&gt;
            &lt;small class="text-muted"&gt;Pendapatan Selesai&lt;/small&gt;
            &lt;h4 class="fw-bold text-success"&gt;&lt;?= format_rupiah($totalRevenue) ?&gt;&lt;/h4&gt;
        &lt;/div&gt;
    &lt;/div&gt;
&lt;/div&gt;</code></pre>
            </div>
        </div>

        <!-- Tab 4: Explanation -->
        <div class="neu-tab-content" id="tab-explanation">
            <div class="neu-card-sm p-4 bg-white">
                <h6 class="fw-bold mb-3">Penjelasan Anatomi Logika:</h6>
                <ul class="text-muted small mb-0">
                    <li class="mb-2"><code>COUNT(*)</code>: Menghitung banyaknya baris rekaman dalam tabel secara instan tanpa perlu meload seluruh data ke memori PHP.</li>
                    <li class="mb-2"><code>SUM(kolom)</code>: Menjumlahkan seluruh nilai angka dalam kolom yang ditargetkan.</li>
                    <li class="mb-2"><code>$stmt->fetchColumn()</code>: Metode PDO tercepat untuk mengambil 1 nilai tunggal hasil dari query agregat (seperti angka total atau hasil sum).</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- 5. Trik Hafalan Cepat / Mnemonics -->
    <div class="trick-box my-4">
        <h5 class="fw-bold text-warning mb-2"><i class="bi bi-key-fill me-2"></i>Trik Hafalan Cepat: "COUNT untuk Lembar, SUM untuk Uang"</h5>
        <ul class="mb-0 fw-semibold text-dark">
            <li><strong>Hitung Jumlah Pesanan / Lembar Bon:</strong> Gunakan <code>COUNT(*)</code>.</li>
            <li><strong>Hitung Total Uang / Omzet:</strong> Gunakan <code>SUM(total)</code>.</li>
        </ul>
    </div>

    <!-- 6. Jebakan Error Pemula & Solusi -->
    <div class="gotcha-box">
        <h5 class="fw-bold text-danger mb-2"><i class="bi bi-exclamation-triangle-fill me-2"></i>Jebakan Error Pemula:</h5>
        <p class="small mb-1">
            <strong>❌ Masalah:</strong> Menjumlahkan pendapatan termasuk pesanan yang statusnya <i>Dibatalkan</i>.<br>
            <strong>⚠️ Dampak:</strong> Laporan keuangan cafe menjadi tidak valid karena pesanan batal tetap dihitung sebagai uang masuk.<br>
            <strong>✅ Solusi:</strong> Selalu sertakan kondisi <code>WHERE status = 'Selesai'</code> pada query penghitungan pendapatan (SUM).
        </p>
    </div>
</div>

<script>
function randomizeStats() {
    const orders = Math.floor(Math.random() * 50) + 10;
    const pending = Math.floor(Math.random() * 8);
    const cooking = Math.floor(Math.random() * 5);
    const rev = (orders - pending - cooking) * 25000;

    document.getElementById('statOrders').innerHTML = `${orders} <span class="fs-6 fw-normal text-muted">order</span>`;
    document.getElementById('statPending').innerHTML = `${pending} <span class="fs-6 fw-normal text-muted">order</span>`;
    document.getElementById('statCooking').innerHTML = `${cooking} <span class="fs-6 fw-normal text-muted">order</span>`;
    document.getElementById('statRevenue').textContent = 'Rp ' + rev.toLocaleString('id-ID');
}
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
