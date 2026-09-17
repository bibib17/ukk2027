<?php
$modulTitle = 'Langkah 09: Riwayat Pesanan Customer & Status Order';
$modulNumber = 9;
require_once __DIR__ . '/../includes/header.php';
?>

<!-- Header Breadcrumb & Title -->
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <div>
        <span class="neu-badge neu-badge-primary mb-2">
            <i class="bi bi-clock-history me-1 text-neu-accent"></i> Pelacakan & SQL JOIN - Tahap 9 dari 12
        </span>
        <h2 class="fw-extrabold mb-1 text-dark">Langkah 09: Riwayat Pesanan Pelanggan & Siklus Status</h2>
        <p class="text-muted mb-0">Menampilkan tabel riwayat pesanan dengan SQL JOIN, rincian menu yang dibeli, dan logika pembatalan pesanan.</p>
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
                <strong>1. Lokasi Berkas (Root File):</strong><br>
                📁 <code>c:\xampp\htdocs\ukk2027\customer\orders.php</code>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-2 neu-inset bg-white rounded-3 h-100">
                <strong>2. Tindakan Nyata Siswa:</strong><br>
                Buat tabel riwayat pesanan, panggil fungsi <code>render_status_badge()</code>, dan buat link aksi pembatalan jika pesanan masih <code>pending</code>.
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-2 neu-inset bg-white rounded-3 h-100">
                <strong>3. Cara Menguji di Browser:</strong><br>
                Login sebagai <code>budi</code>, buka <code>http://localhost/ukk2027/customer/orders.php</code>.
            </div>
        </div>
    </div>
</div>

<!-- 1. Konsep & Analogi Guru Besar (ELI5) -->
<div class="row g-4 mb-4">
    <div class="col-lg-7">
        <div class="neu-card p-4 h-100">
            <h5 class="fw-bold text-neu-primary mb-3">
                <i class="bi bi-mortarboard-fill me-2 text-neu-accent"></i> Penjelasan Guru Besar: Siklus Hidup Status Pesanan
            </h5>
            <p class="text-muted">
                Dalam sistem cafe, setiap pesanan melalui tahapan status yang terdefinisi dengan jelas:
            </p>
            <ul class="text-muted small ps-3 mb-0">
                <li class="mb-2"><strong>`pending` (Kuning):</strong> Pesanan baru masuk dari pelanggan, menunggu dicek oleh kasir/barista. Pelanggan masih boleh membatalkan pesanan.</li>
                <li class="mb-2"><strong>`processing` (Biru):</strong> Pesanan sudah dikonfirmasi kasir dan sedang dimasak di dapur. Pesanan tidak boleh dibatalkan lagi.</li>
                <li class="mb-2"><strong>`completed` (Hijau):</strong> Makanan telah disajikan dan pembayaran telah lunas.</li>
                <li class="mb-0"><strong>`cancelled` (Merah):</strong> Pesanan dibatalkan oleh pelanggan atau ditolak admin karena stok habis.</li>
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
                    <strong>Halaman Riwayat Pesanan</strong> ibarat <strong>Layar Monitor Pelacak Pesanan di Restoran Cepat Saji</strong>:
                </p>
                <p class="mb-0 small">
                    Nomor antreanmu bergerak dari kolom <em>"Sedang Disiapkan"</em> menuju kolom <em>"Siap Diambil"</em> sehingga tamu tidak perlu bolak-balik bertanya ke kasir.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- 2. Pojok Dosen Senior: Kamus & Bedah Istilah Sulit -->
<div class="neu-card p-4 mb-4">
    <h5 class="fw-bold text-neu-primary mb-3">
        <i class="bi bi-book-half text-neu-accent me-2"></i> Kamus Istilah Programmer Senior: Bedah Kata Sulit SQL & Waktu
    </h5>
    
    <div class="row g-3">
        <div class="col-md-6">
            <div class="p-3 neu-inset bg-white rounded-3 h-100">
                <h6 class="fw-bold text-primary mb-1"><i class="bi bi-calendar-event me-1"></i> Apa itu `strtotime()` & Format Tanggal?</h6>
                <p class="small text-muted mb-0">
                    MySQL menyimpan format waktu internasional standar ISO (<code>2026-09-17 09:30:00</code>). Fungsi <code>strtotime()</code> mengubah string tersebut menjadi angka detik timestamp komputer, lalu fungsi <code>date('d/m/Y H:i', ...)</code> menyusunnya menjadi format tanggal Indonesia yang rapi dan mudah dibaca manusia (<code>17/09/2026 09:30</code>).
                </p>
            </div>
        </div>

        <div class="col-md-6">
            <div class="p-3 neu-inset bg-white rounded-3 h-100">
                <h6 class="fw-bold text-success mb-1"><i class="bi bi-link-45deg me-1"></i> Apa itu SQL `INNER JOIN`?</h6>
                <p class="small text-muted mb-0">
                    Perintah SQL untuk menggabungkan dua lembar tabel menjadi satu kesatuan laporan utuh berdasarkan kolom kunci yang sama. Misal menggabungkan <code>orders.user_id = users.id</code> agar kita bisa menampilkan nama pelanggan asli ("Budi Santoso") bukan sekadar angka ID 2!
                </p>
            </div>
        </div>
    </div>
</div>

<!-- 3. Live Interactive Status Stepper -->
<div class="neu-card p-4 mb-4">
    <h5 class="fw-bold text-neu-primary mb-3">
        <i class="bi bi-play-circle-fill me-2 text-neu-accent"></i> Interactive Sandbox: Simulasi Alur Perubahan Status Pesanan
    </h5>

    <div class="d-flex flex-wrap gap-2 mb-3">
        <button class="neu-btn neu-btn-sm neu-btn-primary" onclick="changeStatusDemo('pending')">1. Pending (Menunggu)</button>
        <button class="neu-btn neu-btn-sm" onclick="changeStatusDemo('processing')">2. Processing (Diproses)</button>
        <button class="neu-btn neu-btn-sm" onclick="changeStatusDemo('completed')">3. Completed (Selesai)</button>
        <button class="neu-btn neu-btn-sm text-danger" onclick="changeStatusDemo('cancelled')">4. Cancelled (Batal)</button>
    </div>

    <!-- Card Pesanan Mockup -->
    <div class="p-3 neu-inset rounded-3 bg-white">
        <div class="d-flex justify-content-between align-items-center mb-2 border-bottom pb-2">
            <div>
                <strong class="text-neu-primary">Kode: ORD-20260917-8891</strong>
                <div class="small text-muted">17 Sep 2026, 09:30 WIB</div>
            </div>
            <div id="statusBadgeDemo">
                <span class="badge bg-warning text-dark px-3 py-2 fs-6">Menunggu Konfirmasi</span>
            </div>
        </div>
        <div class="small text-muted mb-2">
            <strong>Daftar Item:</strong> 2x Caffe Latte (Rp 44.000), 1x Croissant Butter (Rp 18.000)
        </div>
        <div class="d-flex justify-content-between align-items-center">
            <span class="fw-bold text-success fs-5">Total: Rp 62.000</span>
            <button class="btn btn-outline-danger btn-sm" id="btnCancelDemo" onclick="alert('Pesanan berhasil dibatalkan!')">
                <i class="bi bi-x-circle me-1"></i> Batalkan Pesanan
            </button>
        </div>
    </div>
</div>

<!-- 4. Source Code Tabs -->
<div class="neu-card p-4 mb-4">
    <h5 class="fw-bold text-neu-primary mb-3">
        <i class="bi bi-code-square me-2 text-neu-accent"></i> Source Code Lengkap Riwayat Pesanan (`customer/orders.php`)
    </h5>

    <div class="code-container">
        <button type="button" class="btn-copy-code"><i class="bi bi-clipboard"></i> Salin Riwayat</button>
        <pre><code>&lt;?php
$pageTitle = 'Riwayat Pesanan Saya';
require_once '../includes/header.php';
require_once '../includes/auth.php';

require_role('customer');
$currentUser = current_user();

// 1. Ambil seluruh pesanan milik user yang sedang login
$stmt = $pdo->prepare("
    SELECT * FROM orders 
    WHERE user_id = :uid 
    ORDER BY created_at DESC
");
$stmt->execute([':uid' => $currentUser['id']]);
$orders = $stmt->fetchAll();
?&gt;

&lt;h3 class="fw-bold mb-4"&gt;Riwayat Pesanan Saya&lt;/h3&gt;

&lt;?php if (empty($orders)): ?&gt;
    &lt;div class="alert alert-info"&gt;Anda belum pernah membuat pesanan. &lt;a href="order.php"&gt;Pesan sekarang!&lt;/a&gt;&lt;/div&gt;
&lt;?php else: ?&gt;
    &lt;div class="table-responsive bg-white rounded-3 shadow-sm"&gt;
        &lt;table class="table table-hover align-middle mb-0"&gt;
            &lt;thead class="table-dark"&gt;
                &lt;tr&gt;
                    &lt;th&gt;Kode Pesanan&lt;/th&gt;
                    &lt;th&gt;Waktu Pesan&lt;/th&gt;
                    &lt;th&gt;Total Pembayaran&lt;/th&gt;
                    &lt;th&gt;Status&lt;/th&gt;
                    &lt;th&gt;Aksi&lt;/th&gt;
                &lt;/tr&gt;
            &lt;/thead&gt;
            &lt;tbody&gt;
                &lt;?php foreach ($orders as $o): ?&gt;
                &lt;tr&gt;
                    &lt;td class="fw-bold font-monospace"&gt;&lt;?php echo htmlspecialchars($o['order_code']); ?&gt;&lt;/td&gt;
                    &lt;td&gt;&lt;?php echo date('d/m/Y H:i', strtotime($o['created_at'])); ?&gt;&lt;/td&gt;
                    &lt;td class="fw-bold text-success"&gt;&lt;?php echo format_rupiah($o['total_amount']); ?&gt;&lt;/td&gt;
                    &lt;td&gt;&lt;?php echo render_status_badge($o['status']); ?&gt;&lt;/td&gt;
                    &lt;td&gt;
                        &lt;?php if ($o['status'] === 'pending'): ?&gt;
                            &lt;a href="cancel-order.php?id=&lt;?php echo $o['id']; ?&gt;" class="btn btn-outline-danger btn-sm" onclick="return confirm('Yakin ingin membatalkan pesanan ini?')"&gt;Batalkan&lt;/a&gt;
                        &lt;?php else: ?&gt;
                            &lt;span class="text-muted small"&gt;Terkunci&lt;/span&gt;
                        &lt;?php endif; ?&gt;
                    &lt;/td&gt;
                &lt;/tr&gt;
                &lt;?php endforeach; ?&gt;
            &lt;/tbody&gt;
        &lt;/table&gt;
    &lt;/div&gt;
&lt;?php endif; ?&gt;

&lt;?php require_once '../includes/footer.php'; ?&gt;</code></pre>
    </div>
</div>

<!-- 5. Jembatan Keledai & Rumus Hafalan -->
<div class="trick-box">
    <h5 class="fw-bold text-neu-primary mb-2">
        <i class="bi bi-bookmark-star-fill text-warning me-2"></i> Rumus Proteksi SQL Filter User ID
    </h5>
    <p class="mb-1 small">
        Jangan pernah lupa menyertakan <code>WHERE user_id = :uid</code> saat mengambil data pesanan pelanggan:
    </p>
    <div class="p-2 neu-inset font-monospace small bg-white">
        SELECT * FROM orders WHERE user_id = :uid ORDER BY created_at DESC;
    </div>
    <div class="small text-muted mt-1">
        Jika kamu lupa klausul <code>WHERE user_id</code>, pelanggan Budi akan bisa melihat seluruh data pesanan milik pelanggan lain!
    </div>
</div>

<script>
function changeStatusDemo(st) {
    const badge = document.getElementById('statusBadgeDemo');
    const btn = document.getElementById('btnCancelDemo');

    if (st === 'pending') {
        badge.innerHTML = '<span class="badge bg-warning text-dark px-3 py-2 fs-6">Menunggu Konfirmasi</span>';
        btn.style.display = 'inline-block';
    } else if (st === 'processing') {
        badge.innerHTML = '<span class="badge bg-info text-dark px-3 py-2 fs-6">Sedang Diproses Dapur</span>';
        btn.style.display = 'none';
    } else if (st === 'completed') {
        badge.innerHTML = '<span class="badge bg-success text-white px-3 py-2 fs-6">Pesanan Selesai</span>';
        btn.style.display = 'none';
    } else if (st === 'cancelled') {
        badge.innerHTML = '<span class="badge bg-danger text-white px-3 py-2 fs-6">Pesanan Dibatalkan</span>';
        btn.style.display = 'none';
    }
}
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
