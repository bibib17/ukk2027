<?php
$modulTitle = 'Langkah 03: Master Layout Modular & Landing Page Publik';
$modulNumber = 3;
require_once __DIR__ . '/../includes/header.php';
?>

<!-- Header Breadcrumb & Title -->
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <div>
        <span class="neu-badge neu-badge-primary mb-2">
            <i class="bi bi-layout-text-window-reverse me-1 text-neu-accent"></i> Tampilan Antarmuka - Tahap 3 dari 12
        </span>
        <h2 class="fw-extrabold mb-1 text-dark">Langkah 03: Membangun Master Layout Modular & Landing Page</h2>
        <p class="text-muted mb-0">Teknik memecah template menjadi header, navbar dinamis, hero banner promo, dan footer modular.</p>
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
                📁 <code>c:\xampp\htdocs\ukk2027\includes\header.php</code><br>
                📁 <code>c:\xampp\htdocs\ukk2027\includes\footer.php</code><br>
                📁 <code>c:\xampp\htdocs\ukk2027\index.php</code>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-2 neu-inset bg-white rounded-3 h-100">
                <strong>2. Tindakan Nyata Siswa:</strong><br>
                Pisahkan tag <code>&lt;head&gt;</code> & navbar ke <code>header.php</code>, tag penutup ke <code>footer.php</code>, lalu panggil keduanya di <code>index.php</code>.
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-2 neu-inset bg-white rounded-3 h-100">
                <strong>3. Cara Menguji di Browser:</strong><br>
                Buka <code>http://localhost/ukk2027/index.php</code>. Amati navbar, banner kafe, dan katalog menu tampil utuh dan rapi.
            </div>
        </div>
    </div>
</div>

<!-- 1. Konsep & Analogi Guru Besar (ELI5) -->
<div class="row g-4 mb-4">
    <div class="col-lg-7">
        <div class="neu-card p-4 h-100">
            <h5 class="fw-bold text-neu-primary mb-3">
                <i class="bi bi-mortarboard-fill me-2 text-neu-accent"></i> Penjelasan Guru Besar: Mengapa Harus Memecah Header & Footer?
            </h5>
            <p class="text-muted">
                Prinsip penting dalam pemrograman web adalah <strong>DRY (*Don't Repeat Yourself*)</strong>. Jika sebuah website memiliki 10 halaman, kita tidak boleh menulis ulang tag <code>&lt;head&gt;</code>, link Bootstrap, dan navbar 10 kali.
            </p>
            <ul class="text-muted small ps-3 mb-0">
                <li class="mb-2"><strong>`includes/header.php`</strong>: Memuat tag <code>&lt;html&gt;</code>, <code>&lt;head&gt;</code>, CSS, dan navigasi navbar. Cukup dipanggil dengan <code>require_once</code> di baris pertama setiap halaman.</li>
                <li class="mb-0"><strong>`includes/footer.php`</strong>: Memuat copyright, penutup tag <code>&lt;/body&gt;</code>, dan script JavaScript Bootstrap. Dipanggil di baris paling akhir.</li>
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
                    <strong>Header</strong> ibarat <strong>Atap & Pintu Depan Bangunan Kafe</strong>, sedangkan <strong>Footer</strong> adalah <strong>Pondasi & Lantai Bawah</strong>.
                </p>
                <p class="mb-0 small">
                    Isi ruangan di tengahnya (kamar tamu, dapur, kasir) bisa berganti-ganti, tetapi atap dan pondasinya selalu sama di setiap ruangan!
                </p>
            </div>
        </div>
    </div>
</div>

<!-- 2. Pojok Dosen Senior: Kamus & Bedah Istilah Sulit -->
<div class="neu-card p-4 mb-4">
    <h5 class="fw-bold text-neu-primary mb-3">
        <i class="bi bi-book-half text-neu-accent me-2"></i> Kamus Istilah Programmer Senior: Bedah Kata Sulit Templating
    </h5>
    
    <div class="row g-3">
        <div class="col-md-6">
            <div class="p-3 neu-inset bg-white rounded-3 h-100">
                <h6 class="fw-bold text-primary mb-1"><i class="bi bi-link-45deg me-1"></i> Apa itu `__DIR__` di PHP?</h6>
                <p class="small text-muted mb-0">
                    Konstanta sakti PHP yang otomatis mengembalikan path direktori absolut dari file saat ini (misal: <code>C:\xampp\htdocs\ukk2027\includes</code>). Menggunakan <code>__DIR__ . '/functions.php'</code> menjamin file akan selalu ditemukan tanpa peduli dari folder mana file tersebut dipanggil!
                </p>
            </div>
        </div>

        <div class="col-md-6">
            <div class="p-3 neu-inset bg-white rounded-3 h-100">
                <h6 class="fw-bold text-success mb-1"><i class="bi bi-globe me-1"></i> Mengapa Butuh Fungsi `base_url()`?</h6>
                <p class="small text-muted mb-0">
                    Ketika kamu berada di subfolder dalam (misal: <code>admin/menus.php</code>), link relatif seperti <code>assets/css/style.css</code> akan rusak (menjadi 404 Not Found). Fungsi <code>base_url('assets/css/style.css')</code> otomatis membuat URL absolut <code>http://localhost/ukk2027/assets/css/style.css</code> yang selalu valid di halaman manapun!
                </p>
            </div>
        </div>
    </div>
</div>

<!-- 3. Live Interactive Layout Preview -->
<div class="neu-card p-4 mb-4">
    <h5 class="fw-bold text-neu-primary mb-3">
        <i class="bi bi-eye-fill me-2 text-neu-accent"></i> Preview Visual: Struktur Landing Page Publik (`index.php`)
    </h5>

    <!-- Mini Mockup Landing Page -->
    <div class="p-3 neu-inset rounded-3">
        <!-- Mini Navbar -->
        <div class="d-flex justify-content-between align-items-center bg-dark text-white p-2 px-3 rounded-3 mb-3">
            <div class="fw-bold small"><i class="bi bi-cup-hot-fill text-warning me-1"></i> Taking Order <span class="text-warning">Cafe</span></div>
            <div class="d-flex gap-2">
                <span class="badge bg-secondary">Beranda</span>
                <span class="badge bg-secondary">Menu</span>
                <span class="badge bg-warning text-dark">Masuk</span>
            </div>
        </div>

        <!-- Mini Hero Banner -->
        <div class="p-4 text-white rounded-3 mb-3 text-center" style="background: linear-gradient(135deg, #2b1e16 0%, #4a3325 100%);">
            <span class="badge bg-warning text-dark mb-2">Selamat Datang di Cafe Kami</span>
            <h4 class="fw-bold mb-1">Sensasi Kopi Terbaik & Pastry Gurih</h4>
            <p class="small text-white-50 mb-3">Pesan langsung dari meja Anda dengan sistem pemesanan modern.</p>
            <button class="btn btn-warning btn-sm fw-bold"><i class="bi bi-bag-plus me-1"></i> Mulai Pesan Sekarang</button>
        </div>

        <!-- Mini Menu Showcase -->
        <div class="row g-2">
            <div class="col-4">
                <div class="bg-white p-2 rounded-3 text-center border">
                    <div class="small fw-bold">Espresso Single</div>
                    <div class="text-success small fw-bold">Rp 15.000</div>
                </div>
            </div>
            <div class="col-4">
                <div class="bg-white p-2 rounded-3 text-center border">
                    <div class="small fw-bold">Caffe Latte</div>
                    <div class="text-success small fw-bold">Rp 22.000</div>
                </div>
            </div>
            <div class="col-4">
                <div class="bg-white p-2 rounded-3 text-center border">
                    <div class="small fw-bold">Croissant</div>
                    <div class="text-success small fw-bold">Rp 18.000</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 4. Source Code Tabs -->
<div class="neu-card p-4 mb-4">
    <h5 class="fw-bold text-neu-primary mb-3">
        <i class="bi bi-code-square me-2 text-neu-accent"></i> Source Code Modular (`includes/header.php` & `index.php`)
    </h5>

    <div class="neu-tabs mb-3">
        <button class="neu-tab-btn active" data-tab="tab-header">1. `includes/header.php` (Navbar Dinamis)</button>
        <button class="neu-tab-btn" data-tab="tab-landing">2. `index.php` (Halaman Publik)</button>
        <button class="neu-tab-btn" data-tab="tab-footer">3. `includes/footer.php`</button>
    </div>

    <!-- Tab 1: Header.php -->
    <div class="neu-tab-content active" id="tab-header">
        <div class="code-container">
            <button type="button" class="btn-copy-code"><i class="bi bi-clipboard"></i> Salin Header</button>
            <pre><code>&lt;?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/auth.php';

$currentUser = current_user();
$role = $currentUser['role'] ?? 'guest';
?&gt;
&lt;!DOCTYPE html&gt;
&lt;html lang="id"&gt;
&lt;head&gt;
    &lt;meta charset="UTF-8"&gt;
    &lt;title&gt;&lt;?php echo $pageTitle ?? 'Taking Order Cafe'; ?&gt;&lt;/title&gt;
    &lt;link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"&gt;
    &lt;link rel="stylesheet" href="&lt;?php echo base_url('assets/css/style.css'); ?&gt;"&gt;
&lt;/head&gt;
&lt;body class="bg-light d-flex flex-column min-vh-100"&gt;
    &lt;!-- Navigasi Navbar --&gt;
    &lt;nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm"&gt;
        &lt;div class="container"&gt;
            &lt;a class="navbar-brand fw-bold" href="&lt;?php echo base_url('index.php'); ?&gt;"&gt;Taking Order &lt;span class="text-warning"&gt;Cafe&lt;/span&gt;&lt;/a&gt;
            &lt;div class="d-flex align-items-center gap-2"&gt;
                &lt;?php if ($role === 'guest'): ?&gt;
                    &lt;a href="&lt;?php echo base_url('auth/login.php'); ?&gt;" class="btn btn-warning btn-sm"&gt;Masuk / Login&lt;/a&gt;
                &lt;?php else: ?&gt;
                    &lt;span class="text-white small"&gt;Halo, &lt;strong&gt;&lt;?php echo htmlspecialchars($currentUser['name']); ?&gt;&lt;/strong&gt;&lt;/span&gt;
                    &lt;a href="&lt;?php echo base_url('auth/logout.php'); ?&gt;" class="btn btn-outline-danger btn-sm"&gt;Logout&lt;/a&gt;
                &lt;?php endif; ?&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/nav&gt;
    &lt;main class="container my-4 flex-grow-1"&gt;</code></pre>
        </div>
    </div>

    <!-- Tab 2: Landing Page index.php -->
    <div class="neu-tab-content" id="tab-landing">
        <div class="code-container">
            <button type="button" class="btn-copy-code"><i class="bi bi-clipboard"></i> Salin Landing Page</button>
            <pre><code>&lt;?php
$pageTitle = 'Beranda Utama';
require_once 'includes/header.php';

// Ambil menu yang berstatus 'available'
$stmt = $pdo->query("SELECT * FROM menus WHERE status = 'available' ORDER BY id ASC LIMIT 6");
$menus = $stmt->fetchAll();
?&gt;

&lt;!-- Hero Section --&gt;
&lt;div class="p-5 text-white rounded-4 mb-4 text-center hero-banner"&gt;
    &lt;h1 class="display-5 fw-bold"&gt;Selamat Datang di Taking Order Cafe&lt;/h1&gt;
    &lt;p class="lead"&gt;Nikmati sajian kopi berkualitas terbaik dan menu lezat kami.&lt;/p&gt;
    &lt;a href="customer/order.php" class="btn btn-warning btn-lg fw-bold"&gt;Pesan Sekarang&lt;/a&gt;
&lt;/div&gt;

&lt;!-- Katalog Menu Grid --&gt;
&lt;h3 class="fw-bold mb-3"&gt;Menu Favorit Pilihan&lt;/h3&gt;
&lt;div class="row g-4"&gt;
    &lt;?php foreach ($menus as $m): ?&gt;
    &lt;div class="col-md-4"&gt;
        &lt;div class="card card-menu h-100 shadow-sm border-0"&gt;
            &lt;div class="card-body"&gt;
                &lt;h5 class="card-title fw-bold"&gt;&lt;?php echo htmlspecialchars($m['name']); ?&gt;&lt;/h5&gt;
                &lt;p class="card-text text-muted small"&gt;&lt;?php echo htmlspecialchars($m['description']); ?&gt;&lt;/p&gt;
                &lt;div class="d-flex justify-content-between align-items-center"&gt;
                    &lt;span class="text-success fw-bold"&gt;&lt;?php echo format_rupiah($m['price']); ?&gt;&lt;/span&gt;
                    &lt;a href="customer/order.php" class="btn btn-outline-primary btn-sm"&gt;Pesan&lt;/a&gt;
                &lt;/div&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;
    &lt;?php endforeach; ?&gt;
&lt;/div&gt;

&lt;?php require_once 'includes/footer.php'; ?&gt;</code></pre>
        </div>
    </div>

    <!-- Tab 3: Footer.php -->
    <div class="neu-tab-content" id="tab-footer">
        <div class="code-container">
            <button type="button" class="btn-copy-code"><i class="bi bi-clipboard"></i> Salin Footer</button>
            <pre><code>    &lt;/main&gt;
    &lt;footer class="bg-white border-top py-3 mt-auto text-center text-muted small"&gt;
        &lt;div class="container"&gt;
            &copy; &lt;?php echo date('Y'); ?&gt; Taking Order Cafe. Hak Cipta Dilindungi.
        &lt;/div&gt;
    &lt;/footer&gt;
    &lt;script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"&gt;&lt;/script&gt;
&lt;/body&gt;
&lt;/html&gt;</code></pre>
        </div>
    </div>
</div>

<!-- 5. Jembatan Keledai & Rumus Hafalan -->
<div class="trick-box">
    <h5 class="fw-bold text-neu-primary mb-2">
        <i class="bi bi-bookmark-star-fill text-warning me-2"></i> Rumus Hafalan Struktur File PHP
    </h5>
    <p class="mb-1 small">
        Setiap kali membuat halaman baru, gunakan <strong>Struktur Roti Sandwich 3 Lapis</strong>:
    </p>
    <ul class="small mb-0 ps-3">
        <li><strong>Roti Atas:</strong> <code>require_once 'includes/header.php';</code></li>
        <li><strong>Daging & Sayur (Isi Utama):</strong> HTML konten form / tabel / kartu menu Anda.</li>
        <li><strong>Roti Bawah:</strong> <code>require_once 'includes/footer.php';</code></li>
    </ul>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
