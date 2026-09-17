<?php
$modulTitle = 'Langkah 02: Koneksi PDO & Kumpulan Helper Global';
$modulNumber = 2;
require_once __DIR__ . '/../includes/header.php';
?>

<!-- Header Breadcrumb & Title -->
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <div>
        <span class="neu-badge neu-badge-primary mb-2">
            <i class="bi bi-plug-fill me-1 text-neu-accent"></i> Fondasi Backend - Tahap 2 dari 12
        </span>
        <h2 class="fw-extrabold mb-1 text-dark">Langkah 02: Membangun Koneksi Database PDO & File Helper Global</h2>
        <p class="text-muted mb-0">Membuat modul koneksi PDO anti SQL Injection (`config/database.php`) dan pustaka fungsi serbaguna (`includes/functions.php`).</p>
    </div>
    <span class="neu-badge neu-badge-warning">
        <i class="bi bi-clock me-1"></i> Estimasi Belajar: 25 Menit
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
                <strong>1. Buat Folder & File Berkas:</strong><br>
                📁 `config/database.php`<br>
                📁 `includes/functions.php`<br>
                📁 `includes/auth.php`
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-2 neu-inset bg-white rounded-3 h-100">
                <strong>2. Tindakan Nyata Siswa:</strong><br>
                Tulis fungsi koneksi PDO dan helper di dalam berkas masing-masing sesuai tab kode di bawah.
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-2 neu-inset bg-white rounded-3 h-100">
                <strong>3. Cara Menguji di Browser:</strong><br>
                Buka `http://localhost/ukk2027/config/database.php`. Jika layar putih bersih (tanpa error), koneksi sukses 100%!
            </div>
        </div>
    </div>
</div>

<!-- 1. Konsep & Analogi Guru Besar (ELI5) -->
<div class="row g-4 mb-4">
    <div class="col-lg-7">
        <div class="neu-card p-4 h-100">
            <h5 class="fw-bold text-neu-primary mb-3">
                <i class="bi bi-mortarboard-fill me-2 text-neu-accent"></i> Penjelasan Guru Besar: Mengapa Harus PDO?
            </h5>
            <p class="text-muted">
                <strong>PDO (PHP Data Objects)</strong> adalah standar industri modern untuk komunikasi PHP ke database. Keunggulan mutlaknya:
            </p>
            <ul class="text-muted small ps-3 mb-0">
                <li class="mb-2"><strong>Prepared Statements Murni:</strong> Memisahkan query SQL dari data input pengguna, sehingga 100% kebal terhadap serangan <em>SQL Injection</em>.</li>
                <li class="mb-2"><strong>Exception Handling:</strong> Jika koneksi putus, PHP tidak menampilkan error fatal ke layar pengunjung, melainkan ditangkap rapi oleh blok <code>try { ... } catch (PDOException $e)</code>.</li>
                <li class="mb-0"><strong>Universal:</strong> Bisa digunakan untuk MySQL, PostgreSQL, SQLite tanpa perlu mengubah logika kode PHP.</li>
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
                    <strong>Koneksi PDO</strong> ibarat <strong>Pipa Saluran Air Utama</strong> dari tandon (Database MySQL) menuju keran dapur (Aplikasi PHP).
                </p>
                <p class="mb-0 small">
                    Sedangkan <strong>File Helper (`functions.php`)</strong> adalah <strong>Kotak Perkakas</strong> serbaguna berisi obeng, tang, dan kunci pas yang bisa dipanggil kapan saja tanpa perlu membuat fungsi baru berulang-ulang.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- 2. Pojok Dosen Senior: Kamus & Bedah Istilah Sulit -->
<div class="neu-card p-4 mb-4">
    <h5 class="fw-bold text-neu-primary mb-3">
        <i class="bi bi-book-half text-neu-accent me-2"></i> Kamus Istilah Programmer Senior: Bedah Kata Sulit Backend
    </h5>
    
    <div class="row g-3">
        <!-- Istilah 1: PHP_SESSION_NONE -->
        <div class="col-md-6">
            <div class="p-3 neu-inset bg-white rounded-3 h-100">
                <h6 class="fw-bold text-danger mb-1"><i class="bi bi-exclamation-triangle-fill me-1"></i> Apa itu `PHP_SESSION_NONE` & `session_status()`?</h6>
                <p class="small text-muted mb-2">
                    <strong>Masalah:</strong> Jika kita memanggil <code>session_start()</code> pada halaman yang sesinya sudah aktif, PHP akan melempar <em>Notice Warning: A session had already been started</em>.
                </p>
                <p class="small text-muted mb-0">
                    <strong>Solusi Profesional:</strong> <code>if (session_status() === PHP_SESSION_NONE) { session_start(); }</code>.<br>
                    Artinya: <em>"Wahai PHP, cek dulu status sesi di server. Jika belum ada sesi yang aktif (PHP_SESSION_NONE), barulah mulai jalankan session_start()!"</em>. Ini mencegah error fatal saat file di-include berulang kali.
                </p>
            </div>
        </div>

        <!-- Istilah 2: render_status_badge -->
        <div class="col-md-6">
            <div class="p-3 neu-inset bg-white rounded-3 h-100">
                <h6 class="fw-bold text-primary mb-1"><i class="bi bi-palette-fill me-1"></i> Apa itu Fungsi `render_status_badge($status)`?</h6>
                <p class="small text-muted mb-2">
                    <strong>Konsep:</strong> Mengubah teks status mentah dari database (seperti <code>'pending'</code> atau <code>'completed'</code>) menjadi komponen visual badge HTML berwarna yang indah (Kuning, Biru, Hijau, Merah).
                </p>
                <p class="small text-muted mb-0">
                    <strong>Trik Senior:</strong> Alih-alih menggunakan <code>if-else if-else</code> yang panjang dan berantakan, kita menggunakan teknik <strong>Dictionary Lookup (Associative Array)</strong> yang jauh lebih cepat dieksekusi dan mudah ditambah status baru di masa depan!
                </p>
            </div>
        </div>

        <!-- Istilah 3: ATTR_ERRMODE & ERRMODE_EXCEPTION -->
        <div class="col-md-6">
            <div class="p-3 neu-inset bg-white rounded-3 h-100">
                <h6 class="fw-bold text-success mb-1"><i class="bi bi-shield-fill-check me-1"></i> Apa itu `PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION`?</h6>
                <p class="small text-muted mb-0">
                    Secara default, jika query SQL salah (misal salah ketik nama kolom), PDO hanya diam membisu (*silent failure*) dan mengembalikan nilai <code>false</code>. Dengan mengaktifkan opsi <code>ERRMODE_EXCEPTION</code>, PDO akan langsung melempar Exception terstruktur ke blok <code>catch</code> sehingga programmer bisa tahu persis letak kesalahannya saat proses debugging.
                </p>
            </div>
        </div>

        <!-- Istilah 4: htmlspecialchars ENT_QUOTES -->
        <div class="col-md-6">
            <div class="p-3 neu-inset bg-white rounded-3 h-100">
                <h6 class="fw-bold text-warning mb-1"><i class="bi bi-code-slash me-1"></i> Mengapa `htmlspecialchars(..., ENT_QUOTES, 'UTF-8')`?</h6>
                <p class="small text-muted mb-0">
                    Flag <code>ENT_QUOTES</code> memastikan karakter tanda kutip ganda (<code>"</code>) dan tanda kutip tunggal (<code>'</code>) diubah menjadi kode entitas HTML (<code>&amp;quot;</code> dan <code>&amp;#039;</code>). Ini adalah senjata ampuh paling ampuh untuk melumpuhkan serangan <strong>Cross-Site Scripting (XSS)</strong>.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- 3. Interactive Sandbox: Uji Helper Functions Secara Langsung -->
<div class="neu-card p-4 mb-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold text-neu-primary mb-0">
            <i class="bi bi-play-circle-fill me-2 text-neu-accent"></i> Interactive Sandbox: Uji Langsung Fungsi Helper
        </h5>
        <span class="neu-badge neu-badge-primary">Live JavaScript Simulation</span>
    </div>

    <div class="row g-3">
        <!-- Tester 1: Format Rupiah -->
        <div class="col-md-4">
            <div class="neu-card-sm p-3 bg-white h-100">
                <label class="form-label small fw-bold text-neu-primary">1. Uji `format_rupiah($angka)`</label>
                <input type="number" id="testRupiahInput" class="neu-input mb-2" value="25000" placeholder="Ketik angka...">
                <div class="p-2 neu-inset text-center fw-bold text-success" id="testRupiahOutput">Rp 25.000</div>
            </div>
        </div>

        <!-- Tester 2: Generate Order Code -->
        <div class="col-md-4">
            <div class="neu-card-sm p-3 bg-white h-100">
                <label class="form-label small fw-bold text-neu-primary">2. Uji `generate_order_code()`</label>
                <button type="button" class="neu-btn neu-btn-sm neu-btn-primary w-100 mb-2" onclick="testGenCode()">
                    <i class="bi bi-magic me-1"></i> Generate Kode Acak
                </button>
                <div class="p-2 neu-inset text-center fw-bold text-neu-primary font-monospace" id="testCodeOutput">
                    ORD-<?php echo date('Ymd'); ?>-<?php echo strtoupper(substr(uniqid(), -4)); ?>
                </div>
            </div>
        </div>

        <!-- Tester 3: Sanitasi XSS -->
        <div class="col-md-4">
            <div class="neu-card-sm p-3 bg-white h-100">
                <label class="form-label small fw-bold text-neu-primary">3. Uji `sanitize($data)` (Anti-XSS)</label>
                <input type="text" id="testXssInput" class="neu-input mb-2" value="<script>alert('hack')</script>Kopi">
                <div class="p-2 neu-inset small text-break" id="testXssOutput" style="font-size: 0.75rem;">
                    &amp;lt;script&amp;gt;alert('hack')&amp;lt;/script&amp;gt;Kopi
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 4. Source Code Tabs -->
<div class="neu-card p-4 mb-4">
    <h5 class="fw-bold text-neu-primary mb-3">
        <i class="bi bi-code-square me-2 text-neu-accent"></i> Source Code Lengkap Koneksi PDO & Helper
    </h5>

    <div class="neu-tabs mb-3">
        <button class="neu-tab-btn active" data-tab="tab-database">1. `config/database.php` (PDO)</button>
        <button class="neu-tab-btn" data-tab="tab-helper">2. `includes/functions.php` (Helper)</button>
        <button class="neu-tab-btn" data-tab="tab-authhelper">3. `includes/auth.php` (Session Middleware)</button>
    </div>

    <!-- Tab 1: Database.php -->
    <div class="neu-tab-content active" id="tab-database">
        <div class="code-container">
            <button type="button" class="btn-copy-code"><i class="bi bi-clipboard"></i> Salin Kode</button>
            <pre><code>&lt;?php
/**
 * Konfigurasi Database Menggunakan PDO
 * Mengamankan koneksi dengan UTF-8 dan Exception Error Mode
 */
$host     = 'localhost';
$port     = '3306';
$dbname   = 'taking_order_cafe';
$username = 'root';
$password = '';

try {
    $dsn = "mysql:host={$host};port={$port};dbname={$dbname};charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    // Tampilkan pesan bersahabat jika database belum dibuat
    die("&lt;h3 style='color:red;'&gt;Koneksi Database Gagal!&lt;/h3&gt;&lt;p&gt;Pastikan MySQL XAMPP aktif dan database '{$dbname}' sudah diimpor.&lt;/p&gt;");
}</code></pre>
        </div>
    </div>

    <!-- Tab 2: Functions.php -->
    <div class="neu-tab-content" id="tab-helper">
        <div class="code-container">
            <button type="button" class="btn-copy-code"><i class="bi bi-clipboard"></i> Salin Kode</button>
            <pre><code>&lt;?php
// 1. Pembuat Base URL Otomatis
function base_url($path = '') {
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
    $host = $_SERVER['HTTP_HOST'];
    $scriptDir = trim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
    $base = explode('/', $scriptDir)[0] ?? '';
    return $protocol . $host . '/' . $base . '/' . ltrim($path, '/');
}

// 2. Pembersih Data Input Form (Anti XSS)
function sanitize($data) {
    return htmlspecialchars(trim((string)$data), ENT_QUOTES, 'UTF-8');
}

// 3. Format Angka ke Rupiah Indonesia
function format_rupiah($angka) {
    return 'Rp ' . number_format((float)$angka, 0, ',', '.');
}

// 4. Generator Kode Pesanan Unik (Contoh: ORD-20260917-AB12)
function generate_order_code() {
    return 'ORD-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -4));
}

// 5. Render Badge Status Dinamis dengan Bootstrap
function render_status_badge($status) {
    $badges = [
        'pending'    => ['label' => 'Menunggu Konfirmasi', 'class' => 'bg-warning text-dark'],
        'processing' => ['label' => 'Sedang Diproses',     'class' => 'bg-info text-dark'],
        'completed'  => ['label' => 'Selesai',             'class' => 'bg-success text-white'],
        'cancelled'  => ['label' => 'Dibatalkan',           'class' => 'bg-danger text-white']
    ];
    $s = $badges[$status] ?? ['label' => ucfirst($status), 'class' => 'bg-secondary text-white'];
    return '&lt;span class="badge ' . $s['class'] . '"&gt;' . $s['label'] . '&lt;/span&gt;';
}</code></pre>
        </div>
    </div>

    <!-- Tab 3: Auth.php -->
    <div class="neu-tab-content" id="tab-authhelper">
        <div class="code-container">
            <button type="button" class="btn-copy-code"><i class="bi bi-clipboard"></i> Salin Kode</button>
            <pre><code>&lt;?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Cek apakah user sedang login
function is_logged_in() {
    return isset($_SESSION['user_id']);
}

// Dapatkan data user saat ini
function current_user() {
    if (!is_logged_in()) return null;
    return [
        'id'       => $_SESSION['user_id'],
        'username' => $_SESSION['username'],
        'name'     => $_SESSION['name'],
        'role'     => $_SESSION['role']
    ];
}

// Role Guard: Lindungi halaman jika role tidak sesuai (403 Forbidden)
function require_role($requiredRole) {
    if (!is_logged_in()) {
        header('Location: ' . base_url('auth/login.php'));
        exit;
    }
    if ($_SESSION['role'] !== $requiredRole) {
        http_response_code(403);
        die('&lt;h2&gt;403 Forbidden: Anda tidak memiliki hak akses ke halaman ini!&lt;/h2&gt;');
    }
}</code></pre>
        </div>
    </div>
</div>

<!-- 5. Jembatan Keledai & Rumus Hafalan -->
<div class="trick-box">
    <h5 class="fw-bold text-neu-primary mb-2">
        <i class="bi bi-bookmark-star-fill text-warning me-2"></i> Rumus Hafalan Di Luar Kepala: 4 Parameter PDO
    </h5>
    <p class="mb-2 small">
        Ingat rumus <strong>"D - H - D - U - P"</strong> (*Driver, Host, Database, User, Pass*):
    </p>
    <div class="p-2 neu-inset font-monospace small mb-2 bg-white">
        new PDO("<strong>mysql</strong>:host=<strong>localhost</strong>;dbname=<strong>taking_order_cafe</strong>;charset=<strong>utf8mb4</strong>", "<strong>root</strong>", "<strong></strong>");
    </div>
    <div class="small text-muted">
        <strong>Tips Ujian UKK:</strong> Jangan pernah menulis query langsung seperti <code>$pdo->query("SELECT * FROM users WHERE username = '$user'")</code>, selalu gunakan <code>$pdo->prepare()</code> lalu <code>$stmt->execute()</code> agar mendapatkan nilai maksimal dari asesor pada kriteria keamanan perangkat lunak.
    </div>
</div>

<script>
// Live Sandbox Logic
document.getElementById('testRupiahInput').addEventListener('input', function() {
    const val = parseFloat(this.value) || 0;
    document.getElementById('testRupiahOutput').innerText = 'Rp ' + val.toLocaleString('id-ID');
});

document.getElementById('testXssInput').addEventListener('input', function() {
    const txt = this.value;
    const safe = txt.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
    document.getElementById('testXssOutput').innerText = safe;
});

function testGenCode() {
    const d = new Date();
    const ymd = d.getFullYear() + String(d.getMonth() + 1).padStart(2, '0') + String(d.getDate()).padStart(2, '0');
    const rand = Math.random().toString(36).substring(2, 6).toUpperCase();
    document.getElementById('testCodeOutput').innerText = 'ORD-' + ymd + '-' + rand;
}
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
