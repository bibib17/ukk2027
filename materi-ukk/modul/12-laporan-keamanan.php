<?php
$modulTitle = 'Langkah 12: Laporan Penjualan & Keamanan Sistem';
$modulNumber = 12;
require_once __DIR__ . '/../includes/header.php';
?>

<!-- Header Breadcrumb & Title -->
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <div>
        <span class="neu-badge neu-badge-primary mb-2">
            <i class="bi bi-shield-check me-1 text-neu-accent"></i> Tahap Akhir - Tahap 12 dari 12
        </span>
        <h2 class="fw-extrabold mb-1 text-dark">Langkah 12: Laporan Penjualan, Keamanan Sistem & Kisi-Kisi UKK</h2>
        <p class="text-muted mb-0">Membuat modul laporan filter tanggal, query agregasi omset (`SUM` & `COUNT`), audit keamanan (Anti-SQLi & XSS), serta checklist ujian.</p>
    </div>
    <span class="neu-badge neu-badge-success">
        <i class="bi bi-trophy-fill me-1"></i> Modul Kelulusan UKK
    </span>
</div>

<!-- Petunjuk Rute / Root Praktik Siswa -->
<div class="neu-card p-4 mb-4" style="border-left: 6px solid var(--neu-primary);">
    <h5 class="fw-bold text-neu-primary mb-2">
        <i class="bi bi-signpost-2-fill text-neu-accent me-2"></i> Jalur Praktik Siswa (Student Action Roadmap)
    </h5>
    <div class="row g-3 small">
        <div class="col-md-4">
            <div class="p-2 neu-inset bg-white rounded-3 h-100">
                <strong>1. Lokasi Berkas (Root File):</strong><br>
                📁 <code>c:\xampp\htdocs\ukk2027\admin\reports.php</code>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-2 neu-inset bg-white rounded-3 h-100">
                <strong>2. Tindakan Nyata Siswa:</strong><br>
                Buat filter rentang tanggal (<code>$_GET['start_date']</code> & <code>$_GET['end_date']</code>) dan query agregasi omset.
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-2 neu-inset bg-white rounded-3 h-100">
                <strong>3. Cara Menguji di Browser:</strong><br>
                Buka <code>http://localhost/ukk2027/admin/reports.php</code>. Pilih tanggal awal dan akhir, klik Filter, lalu amati total pendapatan terhitung akurat.
            </div>
        </div>
    </div>
</div>

<!-- 1. Konsep & Analogi Guru Besar (ELI5) -->
<div class="row g-4 mb-4">
    <div class="col-lg-7">
        <div class="neu-card p-4 h-100">
            <h5 class="fw-bold text-neu-primary mb-3">
                <i class="bi bi-mortarboard-fill me-2 text-neu-accent"></i> Penjelasan Guru Besar: Mengapa Ada Modul Laporan di UKK?
            </h5>
            <p class="text-muted">
                Dalam lembar penilaian UKK Asisten Pengembang Web, modul laporan menguji kemampuan siswa dalam mengolah data agregat:
            </p>
            <ul class="text-muted small ps-3 mb-0">
                <li class="mb-2"><strong>Filter Rentang Tanggal:</strong> Menggunakan query <code>WHERE DATE(created_at) BETWEEN :start AND :end</code>.</li>
                <li class="mb-2"><strong>Agregasi SQL:</strong> <code>COUNT(id)</code> untuk total transaksi, <code>SUM(total_amount)</code> untuk total omset pendapatan.</li>
                <li class="mb-0"><strong>Kriteria Pesanan Valid:</strong> Hanya pesanan berstatus <code>completed</code> yang dihitung ke dalam omset resmi.</li>
            </ul>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="neu-card p-4 h-100">
            <h5 class="fw-bold text-neu-primary mb-3">
                <i class="bi bi-lightbulb-fill text-warning me-2"></i> Analogi Super Gampang (ELI5)
            </h5>
            <div class="analogy-box my-0 p-3">
                <p class="mb-2 small">
                    <strong>Laporan Penjualan</strong> ibarat <strong>Buku Rekap Tabungan Bulanan</strong>:
                </p>
                <p class="mb-0 small">
                    Pemilik cafe tidak membaca satu per satu ratusan lembar bon setiap hari, melainkan melihat tabel rekapitulasi ringkas: "Dari tanggal 1 s/d 30, ada 150 cangkir kopi terjual dengan total pemasukan Rp 3.500.000."
                </p>
            </div>
        </div>
    </div>
</div>

<!-- 2. Pojok Dosen Senior: Kamus & Bedah Istilah Sulit -->
<div class="neu-card p-4 mb-4">
    <h5 class="fw-bold text-neu-primary mb-3">
        <i class="bi bi-book-half text-neu-accent me-2"></i> Kamus Istilah Programmer Senior: Bedah Kata Sulit Laporan SQL
    </h5>
    
    <div class="row g-3">
        <div class="col-md-6">
            <div class="p-3 neu-inset bg-white rounded-3 h-100">
                <h6 class="fw-bold text-danger mb-1"><i class="bi bi-calculator me-1"></i> Apa itu `COALESCE(SUM(total_amount), 0)`?</h6>
                <p class="small text-muted mb-0">
                    Jika pada rentang tanggal yang difilter belum ada transaksi sama sekali, fungsi <code>SUM()</code> di MySQL akan mengembalikan nilai <code>NULL</code> (bukan angka 0). Fungsi <code>COALESCE(..., 0)</code> bertugas mengganti nilai <code>NULL</code> tersebut menjadi angka <code>0</code> agar program PHP tidak error saat menghitung uang!
                </p>
            </div>
        </div>

        <div class="col-md-6">
            <div class="p-3 neu-inset bg-white rounded-3 h-100">
                <h6 class="fw-bold text-primary mb-1"><i class="bi bi-calendar-range me-1"></i> Mengapa `DATE(created_at) BETWEEN :start AND :end`?</h6>
                <p class="small text-muted mb-0">
                    Kolom <code>created_at</code> bertipe <code>DATETIME</code> (menyimpan jam:menit:detik, misal <code>2026-09-17 14:30:22</code>). Fungsi <code>DATE()</code> memotong informasi jam sehingga hanya mencocokkan tanggalnya saja secara presisi.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- 3. Live Interactive Report Simulator -->
<div class="neu-card p-4 mb-4">
    <h5 class="fw-bold text-neu-primary mb-3">
        <i class="bi bi-play-circle-fill me-2 text-neu-accent"></i> Interactive Sandbox: Filter Laporan Penjualan & Agregat Omset
    </h5>

    <div class="row g-3 align-items-end mb-3">
        <div class="col-md-4">
            <label class="form-label small fw-bold">Tanggal Mulai</label>
            <input type="date" id="simStartDate" class="neu-input" value="2026-09-01">
        </div>
        <div class="col-md-4">
            <label class="form-label small fw-bold">Tanggal Selesai</label>
            <input type="date" id="simEndDate" class="neu-input" value="2026-09-30">
        </div>
        <div class="col-md-4">
            <button type="button" class="neu-btn neu-btn-primary w-100" onclick="simRunReport()">
                <i class="bi bi-filter me-1"></i> Jalankan Filter Laporan
            </button>
        </div>
    </div>

    <!-- Stat Cards Rekap Hasil -->
    <div class="row g-3">
        <div class="col-md-4">
            <div class="neu-card-sm p-3 bg-white text-center">
                <small class="text-muted fw-bold">TOTAL TRANSAKSI SUKSES</small>
                <h3 class="fw-bold text-primary mb-0" id="simRepCount">18 Transaksi</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="neu-card-sm p-3 bg-white text-center">
                <small class="text-muted fw-bold">TOTAL ITEM TERJUAL</small>
                <h3 class="fw-bold text-warning mb-0" id="simRepItems">42 Porsi</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="neu-card-sm p-3 bg-white text-center">
                <small class="text-muted fw-bold">TOTAL OMSET PENDAPATAN</small>
                <h3 class="fw-bold text-success mb-0" id="simRepRevenue">Rp 890.000</h3>
            </div>
        </div>
    </div>
</div>

<!-- 4. Source Code Tabs -->
<div class="neu-card p-4 mb-4">
    <h5 class="fw-bold text-neu-primary mb-3">
        <i class="bi bi-code-square me-2 text-neu-accent"></i> Source Code Lengkap Filter Laporan (`admin/reports.php`)
    </h5>

    <div class="code-container">
        <button type="button" class="btn-copy-code"><i class="bi bi-clipboard"></i> Salin Skrip Laporan</button>
        <pre><code>&lt;?php
require_once '../includes/header.php';
require_once '../includes/auth.php';

require_role('admin');

$startDate = $_GET['start_date'] ?? date('Y-m-01');
$endDate   = $_GET['end_date'] ?? date('Y-m-d');

// 1. Query Agregasi Total Omset dan Jumlah Transaksi
$stmtSummary = $pdo->prepare("
    SELECT 
        COUNT(id) as total_orders,
        COALESCE(SUM(total_amount), 0) as total_revenue
    FROM orders 
    WHERE status = 'completed'
      AND DATE(created_at) BETWEEN :start AND :end
");
$stmtSummary->execute([':start' => $startDate, ':end' => $endDate]);
$summary = $stmtSummary->fetch();

// 2. Query Daftar Transaksi Selesai
$stmtOrders = $pdo->prepare("
    SELECT o.*, u.name as customer_name 
    FROM orders o
    JOIN users u ON o.user_id = u.id
    WHERE o.status = 'completed'
      AND DATE(o.created_at) BETWEEN :start AND :end
    ORDER BY o.created_at DESC
");
$stmtOrders->execute([':start' => $startDate, ':end' => $endDate]);
$orders = $stmtOrders->fetchAll();
?&gt;</code></pre>
    </div>
</div>

<!-- 5. Checklist Penilaian Ujian UKK -->
<div class="neu-card p-4 mb-4">
    <h5 class="fw-bold text-neu-primary mb-3">
        <i class="bi bi-clipboard-check-fill me-2 text-success"></i> Checklist Kesiapan Asesmen UKK Asisten Pengembang Web
    </h5>

    <div class="row g-2">
        <div class="col-md-6">
            <div class="neu-card-sm p-3 bg-white">
                <div class="fw-bold text-success"><i class="bi bi-check-circle-fill me-1"></i> 1. Database & Relasi</div>
                <small class="text-muted">4 Tabel InnoDB, Foreign Key CASCADE/RESTRICT, Primary Key AUTO_INCREMENT.</small>
            </div>
        </div>
        <div class="col-md-6">
            <div class="neu-card-sm p-3 bg-white">
                <div class="fw-bold text-success"><i class="bi bi-check-circle-fill me-1"></i> 2. Keamanan Autentikasi</div>
                <small class="text-muted">Password di-hash dengan `password_hash()`, verifikasi `password_verify()`, Role Guard.</small>
            </div>
        </div>
        <div class="col-md-6">
            <div class="neu-card-sm p-3 bg-white">
                <div class="fw-bold text-success"><i class="bi bi-check-circle-fill me-1"></i> 3. Integritas Transaksi</div>
                <small class="text-muted">Pemrosesan pesanan multi-item dengan PDO Transaction (ACID).</small>
            </div>
        </div>
        <div class="col-md-6">
            <div class="neu-card-sm p-3 bg-white">
                <div class="fw-bold text-success"><i class="bi bi-check-circle-fill me-1"></i> 4. CRUD & Upload Gambar</div>
                <small class="text-muted">Validasi ukuran file, tipe ekstensi, nama unik `uniqid()`, dan `unlink()` file lama.</small>
            </div>
        </div>
    </div>
</div>

<!-- 6. Jembatan Keledai Jawaban Ujian Asesor -->
<div class="trick-box">
    <h5 class="fw-bold text-neu-primary mb-2">
        <i class="bi bi-stars text-warning me-2"></i> Kunci Jawaban Favorit Saat Ditanya Asesor UKK
    </h5>
    <div class="small">
        <strong>Tanya:</strong> <em>"Bagaimana aplikasi Anda mencegah serangan SQL Injection dan XSS?"</em><br>
        <strong>Jawab:</strong> <em>"Untuk SQL Injection, saya menggunakan <strong>PDO Prepared Statements</strong> yang memisahkan sintaks SQL dari nilai variabel data. Untuk serangan XSS, seluruh output data pengguna disaring menggunakan fungsi <strong>htmlspecialchars()</strong> dengan flag ENT_QUOTES!"</em>
    </div>
</div>

<script>
function simRunReport() {
    const s = document.getElementById('simStartDate').value;
    const e = document.getElementById('simEndDate').value;
    alert('Laporan berhasil direkapitulasi untuk rentang: ' + s + ' s/d ' + e + '. Omset resmi terhitung Rp 890.000!');
}
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
