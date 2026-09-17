<?php
$modulTitle = 'Langkah 06: Dashboard Pelanggan & Katalog Menu';
$modulNumber = 6;
require_once __DIR__ . '/../includes/header.php';
?>

<!-- Header Breadcrumb & Title -->
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <div>
        <span class="neu-badge neu-badge-primary mb-2">
            <i class="bi bi-grid-fill me-1 text-neu-accent"></i> Antarmuka Pelanggan - Tahap 6 dari 12
        </span>
        <h2 class="fw-extrabold mb-1 text-dark">Langkah 06: Dashboard Pelanggan & Katalog Menu Interaktif</h2>
        <p class="text-muted mb-0">Merancang antarmuka khusus pelanggan (`customer/dashboard.php`), ringkasan pesanan aktif, dan galeri menu makanan & minuman.</p>
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
                📁 <code>c:\xampp\htdocs\ukk2027\customer\dashboard.php</code>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-2 neu-inset bg-white rounded-3 h-100">
                <strong>2. Tindakan Nyata Siswa:</strong><br>
                Buat file <code>dashboard.php</code> di folder <code>customer/</code>, kunci dengan <code>require_role('customer')</code>, lalu render kartu menu.
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-2 neu-inset bg-white rounded-3 h-100">
                <strong>3. Cara Menguji di Browser:</strong><br>
                Login sebagai <code>budi</code>, buka <code>http://localhost/ukk2027/customer/dashboard.php</code>.
            </div>
        </div>
    </div>
</div>

<!-- 1. Konsep & Analogi Guru Besar (ELI5) -->
<div class="row g-4 mb-4">
    <div class="col-lg-7">
        <div class="neu-card p-4 h-100">
            <h5 class="fw-bold text-neu-primary mb-3">
                <i class="bi bi-mortarboard-fill me-2 text-neu-accent"></i> Penjelasan Guru Besar: Apa Saja di Dashboard Pelanggan?
            </h5>
            <p class="text-muted">
                Ketika pelanggan berhasil login, sistem menyajikan ruang khusus dengan fitur:
            </p>
            <ul class="text-muted small ps-3 mb-0">
                <li class="mb-2"><strong>Role Guard (`require_role('customer')`):</strong> Menjamin hanya pengguna dengan role <code>customer</code> yang bisa membuka halaman ini. Admin dilarang masuk ke sini.</li>
                <li class="mb-2"><strong>Ringkasan Pesanan Aktif:</strong> Query cepat untuk menghitung berapa banyak pesanan yang sedang diproses oleh dapur.</li>
                <li class="mb-0"><strong>Katalog Menu Interaktif:</strong> Menampilkan daftar menu dengan gambar, deskripsi bahan, harga Rupiah, dan tombol cepat menuju formulir pemesanan.</li>
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
                    <strong>Dashboard Pelanggan</strong> ibarat <strong>Meja Nomor Tamu di Cafe</strong>:
                </p>
                <p class="mb-0 small">
                    Di atas meja sudah disiapkan <strong>Buku Menu Fisik Bergambar</strong> dan ada pelayan yang siap mencatat pesanan kapan saja kamu memanggilnya.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- 2. Pojok Dosen Senior: Kamus & Bedah Istilah Sulit -->
<div class="neu-card p-4 mb-4">
    <h5 class="fw-bold text-neu-primary mb-3">
        <i class="bi bi-book-half text-neu-accent me-2"></i> Kamus Istilah Programmer Senior: Bedah Kata Sulit Otorisasi
    </h5>
    
    <div class="row g-3">
        <div class="col-md-6">
            <div class="p-3 neu-inset bg-white rounded-3 h-100">
                <h6 class="fw-bold text-danger mb-1"><i class="bi bi-shield-x me-1"></i> Apa itu `http_response_code(403)`?</h6>
                <p class="small text-muted mb-0">
                    Standar kode status HTTP internasional untuk <strong>403 Forbidden</strong>. Kode ini memberitahu browser dan robot crawler bahwa server mengetahui siapa kamu, tetapi kamu <strong>TIDAK MEMILIKI IZIN</strong> untuk menyentuh halaman tersebut (misal: customer mencoba membuka halaman admin).
                </p>
            </div>
        </div>

        <div class="col-md-6">
            <div class="p-3 neu-inset bg-white rounded-3 h-100">
                <h6 class="fw-bold text-primary mb-1"><i class="bi bi-123 me-1"></i> Mengapa `$stmt->fetchColumn()` untuk COUNT(*)?</h6>
                <p class="small text-muted mb-0">
                    Jika query kamu hanya meminta 1 angka tunggal (seperti <code>SELECT COUNT(*) FROM ...</code>), fungsi <code>fetchColumn()</code> langsung mengembalikan angka tersebut tanpa perlu membuat array asosiatif <code>$row['COUNT(*)']</code> yang boros memori!
                </p>
            </div>
        </div>
    </div>
</div>

<!-- 3. Live Interactive Filter Simulator -->
<div class="neu-card p-4 mb-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold text-neu-primary mb-0">
            <i class="bi bi-funnel-fill me-2 text-neu-accent"></i> Interactive Sandbox: Filter Kategori Menu Responsif
        </h5>
        <span class="neu-badge neu-badge-primary">Dynamic Grid</span>
    </div>

    <!-- Tombol Kategori Filter -->
    <div class="d-flex flex-wrap gap-2 mb-3">
        <button class="neu-btn neu-btn-sm neu-btn-primary" onclick="filterMenu('all', this)">Semua Menu (4)</button>
        <button class="neu-btn neu-btn-sm" onclick="filterMenu('coffee', this)">Kopi (2)</button>
        <button class="neu-btn neu-btn-sm" onclick="filterMenu('snack', this)">Snack (1)</button>
        <button class="neu-btn neu-btn-sm" onclick="filterMenu('heavy-meal', this)">Makanan Berat (1)</button>
    </div>

    <!-- Grid Menu Item -->
    <div class="row g-3" id="menuGridContainer">
        <div class="col-md-3 menu-item-box" data-cat="coffee">
            <div class="neu-card-sm p-3 bg-white h-100 text-center">
                <div class="p-3 mb-2 rounded-3" style="background: #f4eee5;">
                    <i class="bi bi-cup-hot-fill fs-1 text-neu-primary"></i>
                </div>
                <h6 class="fw-bold mb-1">Espresso Single</h6>
                <span class="badge bg-secondary mb-2">Coffee</span>
                <div class="fw-bold text-success mb-2">Rp 15.000</div>
                <a href="07-taking-order-js.php" class="neu-btn neu-btn-sm neu-btn-primary w-100">Pesan Sekarang</a>
            </div>
        </div>

        <div class="col-md-3 menu-item-box" data-cat="coffee">
            <div class="neu-card-sm p-3 bg-white h-100 text-center">
                <div class="p-3 mb-2 rounded-3" style="background: #f4eee5;">
                    <i class="bi bi-cup-straw fs-1 text-neu-primary"></i>
                </div>
                <h6 class="fw-bold mb-1">Caffe Latte</h6>
                <span class="badge bg-secondary mb-2">Coffee</span>
                <div class="fw-bold text-success mb-2">Rp 22.000</div>
                <a href="07-taking-order-js.php" class="neu-btn neu-btn-sm neu-btn-primary w-100">Pesan Sekarang</a>
            </div>
        </div>

        <div class="col-md-3 menu-item-box" data-cat="snack">
            <div class="neu-card-sm p-3 bg-white h-100 text-center">
                <div class="p-3 mb-2 rounded-3" style="background: #f4eee5;">
                    <i class="bi bi-egg-fried fs-1 text-warning"></i>
                </div>
                <h6 class="fw-bold mb-1">Croissant Butter</h6>
                <span class="badge bg-secondary mb-2">Snack</span>
                <div class="fw-bold text-success mb-2">Rp 18.000</div>
                <a href="07-taking-order-js.php" class="neu-btn neu-btn-sm neu-btn-primary w-100">Pesan Sekarang</a>
            </div>
        </div>

        <div class="col-md-3 menu-item-box" data-cat="heavy-meal">
            <div class="neu-card-sm p-3 bg-white h-100 text-center">
                <div class="p-3 mb-2 rounded-3" style="background: #f4eee5;">
                    <i class="bi bi-fire fs-1 text-danger"></i>
                </div>
                <h6 class="fw-bold mb-1">Nasi Goreng Spesial</h6>
                <span class="badge bg-secondary mb-2">Heavy Meal</span>
                <div class="fw-bold text-success mb-2">Rp 28.000</div>
                <a href="07-taking-order-js.php" class="neu-btn neu-btn-sm neu-btn-primary w-100">Pesan Sekarang</a>
            </div>
        </div>
    </div>
</div>

<!-- 4. Source Code Tabs -->
<div class="neu-card p-4 mb-4">
    <h5 class="fw-bold text-neu-primary mb-3">
        <i class="bi bi-code-square me-2 text-neu-accent"></i> Source Code Lengkap (`customer/dashboard.php`)
    </h5>

    <div class="code-container">
        <button type="button" class="btn-copy-code"><i class="bi bi-clipboard"></i> Salin Dashboard</button>
        <pre><code>&lt;?php
$pageTitle = 'Dashboard Pelanggan';
require_once '../includes/header.php';
require_once '../includes/auth.php';

// 1. Kunci Halaman: Hanya boleh dibuka oleh Customer
require_role('customer');
$user = current_user();

// 2. Query Hitung Pesanan Aktif Pelanggan Ini
$stmtCount = $pdo->prepare("SELECT COUNT(*) FROM orders WHERE user_id = :uid AND status IN ('pending', 'processing')");
$stmtCount->execute([':uid' => $user['id']]);
$activeOrders = $stmtCount->fetchColumn();

// 3. Ambil Seluruh Menu yang Tersedia
$stmtMenu = $pdo->query("SELECT * FROM menus WHERE status = 'available' ORDER BY category ASC, name ASC");
$menus = $stmtMenu->fetchAll();
?&gt;

&lt;div class="row g-4 mb-4"&gt;
    &lt;div class="col-md-8"&gt;
        &lt;div class="p-4 bg-primary text-white rounded-4 shadow-sm"&gt;
            &lt;h3 class="fw-bold"&gt;Halo, &lt;?php echo htmlspecialchars($user['name']); ?&gt;! 👋&lt;/h3&gt;
            &lt;p class="mb-0"&gt;Mau menikmati kopi atau makanan apa hari ini? Silakan buat pesanan Anda.&lt;/p&gt;
        &lt;/div&gt;
    &lt;/div&gt;
    &lt;div class="col-md-4"&gt;
        &lt;div class="p-4 bg-white rounded-4 shadow-sm border text-center"&gt;
            &lt;h6 class="text-muted small fw-bold"&gt;PESANAN AKTIF ANDA&lt;/h6&gt;
            &lt;h2 class="fw-bold text-warning mb-0"&gt;&lt;?php echo $activeOrders; ?&gt;&lt;/h2&gt;
        &lt;/div&gt;
    &lt;/div&gt;
&lt;/div&gt;

&lt;!-- Katalog Menu Grid --&gt;
&lt;h4 class="fw-bold mb-3"&gt;Katalog Menu Cafe&lt;/h4&gt;
&lt;div class="row g-3"&gt;
    &lt;?php foreach ($menus as $m): ?&gt;
    &lt;div class="col-md-4"&gt;
        &lt;div class="card h-100 shadow-sm border-0"&gt;
            &lt;div class="card-body"&gt;
                &lt;h5 class="card-title fw-bold"&gt;&lt;?php echo htmlspecialchars($m['name']); ?&gt;&lt;/h5&gt;
                &lt;p class="card-text text-muted small"&gt;&lt;?php echo htmlspecialchars($m['description']); ?&gt;&lt;/p&gt;
                &lt;div class="d-flex justify-content-between align-items-center"&gt;
                    &lt;span class="text-success fw-bold"&gt;&lt;?php echo format_rupiah($m['price']); ?&gt;&lt;/span&gt;
                    &lt;a href="order.php" class="btn btn-warning btn-sm"&gt;Pesan&lt;/a&gt;
                &lt;/div&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;
    &lt;?php endforeach; ?&gt;
&lt;/div&gt;

&lt;?php require_once '../includes/footer.php'; ?&gt;</code></pre>
    </div>
</div>

<!-- 5. Jembatan Keledai & Rumus Hafalan -->
<div class="trick-box">
    <h5 class="fw-bold text-neu-primary mb-2">
        <i class="bi bi-bookmark-star-fill text-warning me-2"></i> Rumus Penguncian Halaman (Role Middleware)
    </h5>
    <p class="mb-1 small">
        Di setiap baris ke-4 halaman dalam folder `customer/`, selalu pasang gembok pengaman:
    </p>
    <div class="p-2 neu-inset font-monospace small bg-white">
        require_role('customer'); // Menendang penyusup atau admin yang salah masuk!
    </div>
</div>

<script>
function filterMenu(cat, btn) {
    document.querySelectorAll('.neu-btn-sm').forEach(b => b.classList.remove('neu-btn-primary'));
    btn.classList.add('neu-btn-primary');

    const items = document.querySelectorAll('.menu-item-box');
    items.forEach(el => {
        if (cat === 'all' || el.getAttribute('data-cat') === cat) {
            el.style.display = 'block';
        } else {
            el.style.display = 'none';
        }
    });
}
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
