<?php
$modulTitle = 'Langkah 11: Kelola Pesanan Kasir & Cetak Struk';
$modulNumber = 11;
require_once __DIR__ . '/../includes/header.php';
?>

<!-- Header Breadcrumb & Title -->
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <div>
        <span class="neu-badge neu-badge-primary mb-2">
            <i class="bi bi-printer-fill me-1 text-neu-accent"></i> Manajemen Kasir & Print - Tahap 11 dari 12
        </span>
        <h2 class="fw-extrabold mb-1 text-dark">Langkah 11: Manajemen Pesanan Kasir & Cetak Struk Thermal</h2>
        <p class="text-muted mb-0">Memproses pembaruan status pesanan (Konfirmasi/Selesai) dan mencetak nota kasir dengan CSS `@media print` murni.</p>
    </div>
    <span class="neu-badge neu-badge-warning">
        <i class="bi bi-clock me-1"></i> Estimasi Belajar: 20 Menit
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
                <strong>1. Lokasi Berkas (Root Files):</strong><br>
                📁 <code>c:\xampp\htdocs\ukk2027\admin\orders.php</code><br>
                📁 <code>c:\xampp\htdocs\ukk2027\admin\order-detail.php</code>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-2 neu-inset bg-white rounded-3 h-100">
                <strong>2. Tindakan Nyata Siswa:</strong><br>
                Buat tabel antrean pesanan admin dan buat tombol cetak yang memanggil <code>window.print()</code> dengan CSS <code>@media print</code>.
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-2 neu-inset bg-white rounded-3 h-100">
                <strong>3. Cara Menguji di Browser:</strong><br>
                Buka <code>http://localhost/ukk2027/admin/order-detail.php?id=1</code>, lalu klik tombol <strong>"Cetak Struk"</strong>. Perhatikan dialog print muncul bersih!
            </div>
        </div>
    </div>
</div>

<!-- 1. Konsep & Analogi Guru Besar (ELI5) -->
<div class="row g-4 mb-4">
    <div class="col-lg-7">
        <div class="neu-card p-4 h-100">
            <h5 class="fw-bold text-neu-primary mb-3">
                <i class="bi bi-mortarboard-fill me-2 text-neu-accent"></i> Penjelasan Guru Besar: Bagaimana Cetak Struk Kasir Bekerja?
            </h5>
            <p class="text-muted">
                Dalam aplikasi kasir cafe, mencetak struk belanja tidak memerlukan plugin rumit, melainkan cukup memanfaatkan fitur native browser:
            </p>
            <ul class="text-muted small ps-3 mb-0">
                <li class="mb-2"><strong>`window.print()` (JavaScript):</strong> Membuka dialog printer bawaan sistem operasi.</li>
                <li class="mb-2"><strong>CSS `@media print`:</strong> Menginstruksikan browser untuk menyembunyikan elemen navbar, footer, tombol, dan background gelap saat dokumen dicetak ke kertas.</li>
                <li class="mb-0"><strong>Layout Kertas Thermal (80mm / 58mm):</strong> Lebar struk diatur fixed (maksimal 300px - 400px) dengan font monospace agar menyerupai struk kasir supermarket/kafe sesungguhnya.</li>
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
                    <strong>CSS `@media print`</strong> ibarat <strong>Kostum Ganti yang Dipakai Khusus Saat Sesi Foto</strong>:
                </p>
                <p class="mb-0 small">
                    Saat tampil di layar monitor, website memakai pakaian warna-warni neumorphic lengkap dengan navbar. Namun saat masuk ke bilik mesin cetak, ia mencopot semua aksesorisnya dan hanya menyisakan kertas putih bersih berisi teks bon kasir.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- 2. Pojok Dosen Senior: Kamus & Bedah Istilah Sulit -->
<div class="neu-card p-4 mb-4">
    <h5 class="fw-bold text-neu-primary mb-3">
        <i class="bi bi-book-half text-neu-accent me-2"></i> Kamus Istilah Programmer Senior: Bedah Kata Sulit Kasir & Print
    </h5>
    
    <div class="row g-3">
        <div class="col-md-6">
            <div class="p-3 neu-inset bg-white rounded-3 h-100">
                <h6 class="fw-bold text-danger mb-1"><i class="bi bi-printer-fill me-1"></i> Apa itu `@media print`?</h6>
                <p class="small text-muted mb-0">
                    Fitur CSS Media Queries yang aktif <strong>HANYA</strong> saat dokumen hendak dicetak ke kertas fisik atau disimpan sebagai PDF (<code>Ctrl + P</code>). CSS di dalam blok ini tidak akan mempengaruhi tampilan website di layar monitor biasa.
                </p>
            </div>
        </div>

        <div class="col-md-6">
            <div class="p-3 neu-inset bg-white rounded-3 h-100">
                <h6 class="fw-bold text-primary mb-1"><i class="bi bi-eye-slash-fill me-1"></i> Mengapa `display: none !important`?</h6>
                <p class="small text-muted mb-0">
                    Flag <code>!important</code> memaksa browser untuk menyembunyikan elemen navbar, footer, dan tombol aksi tanpa bisa ditimpa oleh styling Bootstrap lainnya, sehingga kertas hasil cetakan struk kasir benar-benar bersih dan hemat tinta!
                </p>
            </div>
        </div>
    </div>
</div>

<!-- 3. Live Interactive Thermal Receipt Simulator -->
<div class="neu-card p-4 mb-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold text-neu-primary mb-0">
            <i class="bi bi-play-circle-fill me-2 text-neu-accent"></i> Interactive Sandbox: Preview Format Struk Thermal Kasir
        </h5>
        <button type="button" class="neu-btn neu-btn-sm neu-btn-primary" onclick="alert('Dialog Cetak window.print() siap dipanggil!')">
            <i class="bi bi-printer-fill me-1"></i> Uji Coba window.print()
        </button>
    </div>

    <div class="d-flex justify-content-center">
        <!-- Mockup Struk Kasir Thermal -->
        <div class="p-4 bg-white shadow-sm border rounded-3 font-monospace text-dark" style="max-width: 340px; width: 100%; border: 1px dashed #999 !important; font-size: 0.85rem;">
            <div class="text-center mb-3 border-bottom border-dark pb-2">
                <h6 class="fw-bold mb-0">TAKING ORDER CAFE</h6>
                <small class="text-muted d-block">Jl. Pendidikan No. 27, UKK 2027</small>
                <small class="text-muted">Telp: 0812-3456-7890</small>
            </div>

            <div class="mb-2 small">
                <div>No. Order: <strong>ORD-20260917-0091</strong></div>
                <div>Kasir: Admin Cafe</div>
                <div>Pelanggan: Budi Santoso</div>
                <div>Waktu: <?php echo date('d/m/Y H:i'); ?></div>
            </div>

            <div class="border-top border-bottom border-dark py-2 mb-2">
                <div class="d-flex justify-content-between">
                    <span>2x Caffe Latte</span>
                    <span>Rp 44.000</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>1x Croissant</span>
                    <span>Rp 18.000</span>
                </div>
            </div>

            <div class="d-flex justify-content-between fw-bold mb-3">
                <span>TOTAL AKHIR:</span>
                <span class="text-success">Rp 62.000</span>
            </div>

            <div class="text-center small border-top border-dark pt-2">
                <div>*** LUNAS ***</div>
                <div>Terima Kasih Atas Kunjungan Anda!</div>
                <small class="text-muted">Simpan struk ini sebagai bukti pembayaran sah.</small>
            </div>
        </div>
    </div>
</div>

<!-- 4. Source Code Tabs -->
<div class="neu-card p-4 mb-4">
    <h5 class="fw-bold text-neu-primary mb-3">
        <i class="bi bi-code-square me-2 text-neu-accent"></i> Source Code Lengkap Update Status & Cetak Struk
    </h5>

    <div class="neu-tabs mb-3">
        <button class="neu-tab-btn active" data-tab="tab-updatestatus">1. Update Status Pesanan (PHP)</button>
        <button class="neu-tab-btn" data-tab="tab-printcss">2. CSS Khusus Cetak (@media print)</button>
    </div>

    <!-- Tab 1: PHP Update Status -->
    <div class="neu-tab-content active" id="tab-updatestatus">
        <div class="code-container">
            <button type="button" class="btn-copy-code"><i class="bi bi-clipboard"></i> Salin Skrip Status</button>
            <pre><code>&lt;?php
require_once '../includes/header.php';
require_once '../includes/auth.php';

require_role('admin');

// Logika Ubah Status Pesanan Kasir
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_status') {
    $orderId = (int)$_POST['order_id'];
    $newStatus = $_POST['status'];

    $allowedStatus = ['pending', 'processing', 'completed', 'cancelled'];

    if (in_array($newStatus, $allowedStatus)) {
        $stmt = $pdo->prepare("UPDATE orders SET status = :st WHERE id = :id");
        $stmt->execute([':st' => $newStatus, ':id' => $orderId]);
        
        header('Location: orders.php?msg=status_updated');
        exit;
    }
}
?&gt;</code></pre>
        </div>
    </div>

    <!-- Tab 2: CSS Print -->
    <div class="neu-tab-content" id="tab-printcss">
        <div class="code-container">
            <button type="button" class="btn-copy-code"><i class="bi bi-clipboard"></i> Salin CSS Print</button>
            <pre><code>/* =========================================
   CSS KHUSUS CETAK STRUK THERMAL KASIR
   ========================================= */
@media print {
    /* Sembunyikan elemen yang tidak perlu dicetak */
    nav, footer, .btn, .no-print, .alert {
        display: none !important;
    }

    body {
        background: #ffffff !important;
        color: #000000 !important;
        font-family: 'Courier New', Courier, monospace !important;
        font-size: 11pt;
    }

    .card {
        border: none !important;
        box-shadow: none !important;
    }

    /* Format kertas nota kasir */
    .receipt-container {
        max-width: 320px !important;
        margin: 0 auto !important;
        padding: 0 !important;
    }
}</code></pre>
        </div>
    </div>
</div>

<!-- 5. Jembatan Keledai & Rumus Hafalan -->
<div class="trick-box">
    <h5 class="fw-bold text-neu-primary mb-2">
        <i class="bi bi-bookmark-star-fill text-warning me-2"></i> Rumus Sederhana Tombol Cetak Struk
    </h5>
    <p class="mb-1 small">
        Untuk membuat tombol cetak struk kasir, kamu hanya butuh 1 baris HTML + JavaScript sederhana:
    </p>
    <div class="p-2 neu-inset font-monospace small bg-white">
        &lt;button onclick="<strong>window.print()</strong>" class="btn btn-primary"&gt;Cetak Struk&lt;/button&gt;
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
