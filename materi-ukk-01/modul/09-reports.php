<?php
$modulTitle = 'Modul 09: Filter Laporan & Cetak Laporan (Reports & Print)';
$modulNumber = 9;
require_once __DIR__ . '/../includes/header.php';
?>

<div class="neu-card p-4 p-md-5 mb-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        <span class="neu-badge neu-badge-primary">
            <i class="bi bi-printer"></i> Modul 09 - Pelaporan & Format Cetak
        </span>
        <span class="text-muted small">Target: Menguasai Filter Tanggal SQL, Rekapitulasi Data, & CSS @media print</span>
    </div>

    <h2 class="fw-extrabold mb-3 text-dark">Filter Laporan Penjualan & Cetak (Reports & Print)</h2>
    <p class="lead text-muted mb-4">
        Manajer cafe membutuhkan laporan penjualan yang bisa difilter berdasarkan tanggal tertentu serta dapat langsung dicetak ke printer fisik atau diekspor ke PDF dengan format rapi.
    </p>

    <!-- 1. Konsep Inti 5 Detik -->
    <div class="neu-card-sm p-4 mb-4 bg-white">
        <h5 class="fw-bold mb-2 text-dark"><i class="bi bi-bullseye text-primary me-2"></i>Konsep 5 Detik:</h5>
        <p class="mb-0 text-muted">
            User memilih tanggal mulai & tanggal selesai &rarr; PHP menangkap parameter <code>$_GET</code> &rarr; Menjalankan query <code>WHERE DATE(created_at) &gt;= ? AND DATE(created_at) &lt;= ?</code> &rarr; Saat tombol cetak diklik (<code>window.print()</code>), CSS <code>@media print</code> otomatis menyembunyikan navbar dan tombol aksi sehingga hanya tabel laporan yang tercetak.
        </p>
    </div>

    <!-- 2. Analogi Dunia Nyata -->
    <div class="analogy-box mb-4">
        <h5 class="fw-bold text-primary mb-2"><i class="bi bi-lightbulb-fill me-2"></i>Analogi Dunia Nyata: "Rekening Koran Bank"</h5>
        <p class="mb-0">
            Saat Anda datang ke bank dan meminta <strong>Cetak Rekening Koran Bulan Lalu</strong>, petugas teller menyaring riwayat transaksi Anda dari tanggal 1 hingga 31, lalu mencetaknya di kertas resmi lengkap dengan kolom tanda tangan pimpinan di bagian bawah.
        </p>
    </div>

    <!-- 3. Live Interactive Playground -->
    <h5 class="fw-bold mb-3 text-dark"><i class="bi bi-play-circle text-primary me-2"></i>Live Interactive Playground:</h5>
    <div class="demo-stage mb-4">
        <div class="neu-card p-4">
            <h6 class="fw-bold mb-3"><i class="bi bi-funnel text-primary me-2"></i>Simulasi Filter Periode Laporan</h6>
            <div class="row g-3 align-items-end mb-3">
                <div class="col-md-4">
                    <label class="small text-muted fw-semibold">Tanggal Mulai:</label>
                    <input type="date" class="neu-input" value="2026-09-01" id="demoStart">
                </div>
                <div class="col-md-4">
                    <label class="small text-muted fw-semibold">Tanggal Selesai:</label>
                    <input type="date" class="neu-input" value="2026-09-17" id="demoEnd">
                </div>
                <div class="col-md-4 d-flex gap-2">
                    <button type="button" class="neu-btn neu-btn-primary w-100" onclick="filterSim()">
                        <i class="bi bi-filter"></i> Terapkan Filter
                    </button>
                </div>
            </div>

            <div class="neu-inset p-3" id="demoReportTable">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="small text-muted">Hasil: <strong>3 Transaksi Ditemukan</strong> (Periode 01/09 s.d 17/09)</span>
                    <strong class="text-success">Total Omzet: Rp 104.000</strong>
                </div>
            </div>

            <div class="text-end mt-3">
                <button type="button" class="neu-btn neu-btn-sm" onclick="alert('Memicu dialog cetak printer (window.print())!')">
                    <i class="bi bi-printer-fill me-1"></i> Cetak Laporan (Print / PDF)
                </button>
            </div>
        </div>
    </div>

    <!-- 4. Interactive Code Tabs -->
    <div class="neu-tabs-container">
        <div class="neu-tabs">
            <button type="button" class="neu-tab-btn active" data-tab="php">1. PHP Filter & Query SQL</button>
            <button type="button" class="neu-tab-btn" data-tab="css">2. CSS @media print</button>
            <button type="button" class="neu-tab-btn" data-tab="html">3. Form Filter & Tabel</button>
            <button type="button" class="neu-tab-btn" data-tab="explanation">4. Bedah Baris per Baris</button>
        </div>

        <!-- Tab 1: PHP -->
        <div class="neu-tab-content active" id="tab-php">
            <div class="code-container">
                <button type="button" class="btn-copy-code"><i class="bi bi-clipboard"></i> Salin</button>
                <pre><code>&lt;?php
$startDate = $_GET['start_date'] ?? '';
$endDate   = $_GET['end_date'] ?? '';

$sql = "SELECT * FROM orders WHERE 1=1";
$params = [];

if (!empty($startDate)) {
    $sql .= " AND DATE(created_at) >= ?";
    $params[] = $startDate;
}

if (!empty($endDate)) {
    $sql .= " AND DATE(created_at) <= ?";
    $params[] = $endDate;
}

$sql .= " ORDER BY id DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$orders = $stmt->fetchAll();
?&gt;</code></pre>
            </div>
        </div>

        <!-- Tab 2: CSS -->
        <div class="neu-tab-content" id="tab-css">
            <div class="code-container">
                <button type="button" class="btn-copy-code"><i class="bi bi-clipboard"></i> Salin</button>
                <pre><code>/* Styling Khusus Kertas Print */
@media print {
    /* Sembunyikan elemen navigasi dan tombol interaktif */
    nav, footer, .no-print, .btn, .neu-btn {
        display: none !important;
    }

    body {
        background: #ffffff !important;
        font-size: 12pt;
    }

    /* Tampilkan judul kop surat & tanda tangan resmi */
    .print-only {
        display: block !important;
    }
}

.print-only {
    display: none;
}</code></pre>
            </div>
        </div>

        <!-- Tab 3: HTML -->
        <div class="neu-tab-content" id="tab-html">
            <div class="code-container">
                <button type="button" class="btn-copy-code"><i class="bi bi-clipboard"></i> Salin</button>
                <pre><code>&lt;!-- Form Filter (Hilang saat diprint dengan class .no-print) --&gt;
&lt;form action="reports.php" method="GET" class="no-print"&gt;
    &lt;input type="date" name="start_date"&gt;
    &lt;input type="date" name="end_date"&gt;
    &lt;button type="submit"&gt;Filter&lt;/button&gt;
    &lt;button type="button" onclick="window.print()"&gt;Cetak&lt;/button&gt;
&lt;/form&gt;

&lt;!-- Kop Surat Khusus Cetak --&gt;
&lt;div class="print-only text-center"&gt;
    &lt;h3&gt;LAPORAN PENJUALAN TAKING ORDER CAFE&lt;/h3&gt;
    &lt;hr&gt;
&lt;/div&gt;</code></pre>
            </div>
        </div>

        <!-- Tab 4: Explanation -->
        <div class="neu-tab-content" id="tab-explanation">
            <div class="neu-card-sm p-4 bg-white">
                <h6 class="fw-bold mb-3">Penjelasan Anatomi Logika:</h6>
                <ul class="text-muted small mb-0">
                    <li class="mb-2"><code>method="GET"</code>: Form pencarian dan filter wajib menggunakan metode GET agar parameter tanggal menempel di URL dan mudah dibagikan / di-bookmark.</li>
                    <li class="mb-2"><code>DATE(created_at)</code>: Fungsi MySQL untuk mengekstrak hanya bagian tanggal <code>YYYY-MM-DD</code> dari kolom datetime.</li>
                    <li class="mb-2"><code>window.print()</code>: Fungsi JavaScript bawaan browser untuk memicu jendela cetak printer atau ekspor Save as PDF.</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- 5. Trik Hafalan Cepat / Mnemonics -->
    <div class="trick-box my-4">
        <h5 class="fw-bold text-warning mb-2"><i class="bi bi-key-fill me-2"></i>Trik Hafalan Cepat: Rumus "F-W-S-P"</h5>
        <ul class="mb-0 fw-semibold text-dark">
            <li><strong>F (Form GET):</strong> Form filter menggunakan method GET.</li>
            <li><strong>W (WHERE Date):</strong> Query dinamis dengan kondisi <code>WHERE DATE(created_at)</code>.</li>
            <li><strong>S (Sum Revenue):</strong> Hitung total omzet periode bersangkutan.</li>
            <li><strong>P (Print Media):</strong> Sembunyikan navbar dengan <code>@media print</code>.</li>
        </ul>
    </div>

    <!-- 6. Jebakan Error Pemula & Solusi -->
    <div class="gotcha-box">
        <h5 class="fw-bold text-danger mb-2"><i class="bi bi-exclamation-triangle-fill me-2"></i>Jebakan Error Pemula:</h5>
        <p class="small mb-1">
            <strong>❌ Masalah:</strong> Saat menekan tombol Print, navbar, footer, dan tombol filter ikut tercetak di kertas.<br>
            <strong>✅ Solusi:</strong> Beri class <code>.no-print</code> pada elemen yang tidak ingin dicetak dan sembunyikan dengan <code>@media print { .no-print { display: none !important; } }</code>.
        </p>
    </div>
</div>

<script>
function filterSim() {
    const s = document.getElementById('demoStart').value;
    const e = document.getElementById('demoEnd').value;
    const table = document.getElementById('demoReportTable');
    table.innerHTML = `<div class="d-flex justify-content-between align-items-center">
        <span class="small text-primary"><i class="bi bi-check2"></i> Filter Aktif: <strong>${s}</strong> s.d <strong>${e}</strong></span>
        <strong class="text-success">Total Omzet: Rp 280.000</strong>
    </div>`;
}
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
