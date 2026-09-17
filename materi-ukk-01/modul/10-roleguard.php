<?php
$modulTitle = 'Modul 10: Otorisasi & Role Guard (Middleware 403)';
$modulNumber = 10;
require_once __DIR__ . '/../includes/header.php';
?>

<div class="neu-card p-4 p-md-5 mb-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        <span class="neu-badge neu-badge-primary">
            <i class="bi bi-shield-lock"></i> Modul 10 - Hak Akses & Keamanan Sistem
        </span>
        <span class="text-muted small">Target: Menguasai Pemisahan Role (Admin/Customer) & HTTP 403 Forbidden Guard</span>
    </div>

    <h2 class="fw-extrabold mb-3 text-dark">Middleware Otorisasi & Role Guard (Middleware 403)</h2>
    <p class="lead text-muted mb-4">
        Otorisasi adalah mekanisme penjagaan untuk memastikan pengguna hanya dapat membuka halaman yang sesuai dengan hak akses (role) miliknya.
    </p>

    <!-- 1. Konsep Inti 5 Detik -->
    <div class="neu-card-sm p-4 mb-4 bg-white">
        <h5 class="fw-bold mb-2 text-dark"><i class="bi bi-bullseye text-primary me-2"></i>Konsep 5 Detik:</h5>
        <p class="mb-0 text-muted">
            Di setiap halaman sensitif (misal: <code>admin/orders.php</code>), kita memanggil fungsi <code>require_role('admin')</code>. Jika pengguna yang membuka belum login &rarr; alihkan ke login. Jika rolenya adalah 'customer' &rarr; tolak dengan status <strong>HTTP 403 Akses Ditolak</strong>.
        </p>
    </div>

    <!-- 2. Analogi Dunia Nyata -->
    <div class="analogy-box mb-4">
        <h5 class="fw-bold text-primary mb-2"><i class="bi bi-lightbulb-fill me-2"></i>Analogi Dunia Nyata: "Pintu Masuk Khusus Karyawan (Staff Only)"</h5>
        <p class="mb-0">
            Di cafe, ada pintu bertuliskan <strong>"KHUSUS STAFF / BARISTA"</strong> yang menuju ke brankas kasir. Pengunjung umum (Customer) tidak boleh masuk. Jika ada pengunjung yang nekat membuka pintu itu, alarm keamanan berbunyi (403 Forbidden) dan pengunjung diminta kembali ke area meja pelanggan.
        </p>
    </div>

    <!-- 3. Live Interactive Playground -->
    <h5 class="fw-bold mb-3 text-dark"><i class="bi bi-play-circle text-primary me-2"></i>Live Interactive Playground:</h5>
    <div class="demo-stage mb-4">
        <div class="neu-card p-4">
            <h6 class="fw-bold mb-3 text-center">Simulasi Uji Coba Pintu Akses Halaman Admin</h6>
            
            <div class="d-flex flex-wrap justify-content-center gap-3 mb-4">
                <button type="button" class="neu-btn" onclick="testAccess('guest')">
                    <i class="bi bi-person-x"></i> Login: Tamu (Belum Login)
                </button>
                <button type="button" class="neu-btn" onclick="testAccess('customer')">
                    <i class="bi bi-person"></i> Login: Customer (Pelanggan)
                </button>
                <button type="button" class="neu-btn neu-btn-primary" onclick="testAccess('admin')">
                    <i class="bi bi-shield-check"></i> Login: Admin (Pengelola)
                </button>
            </div>

            <div id="accessResult" class="neu-inset p-4 text-center rounded">
                <p class="text-muted mb-0">Pilih status login di atas untuk menguji apakah diizinkan membuka halaman <code>admin/dashboard.php</code>...</p>
            </div>
        </div>
    </div>

    <!-- 4. Interactive Code Tabs -->
    <div class="neu-tabs-container">
        <div class="neu-tabs">
            <button type="button" class="neu-tab-btn active" data-tab="php">1. Fungsi require_role()</button>
            <button type="button" class="neu-tab-btn" data-tab="usage">2. Cara Pakai di Halaman</button>
            <button type="button" class="neu-tab-btn" data-tab="html">3. Tampilan 403 Forbidden</button>
            <button type="button" class="neu-tab-btn" data-tab="explanation">4. Bedah Baris per Baris</button>
        </div>

        <!-- Tab 1: PHP -->
        <div class="neu-tab-content active" id="tab-php">
            <div class="code-container">
                <button type="button" class="btn-copy-code"><i class="bi bi-clipboard"></i> Salin</button>
                <pre><code>&lt;?php
function require_role($allowedRoles) {
    if (session_status() === PHP_SESSION_NONE) session_start();
    if (!is_array($allowedRoles)) $allowedRoles = [$allowedRoles];

    // 1. Cek apakah sudah login
    if (!isset($_SESSION['user']['id'])) {
        header("Location: ../auth/login.php");
        exit;
    }

    // 2. Cek apakah role user ada di daftar yang diizinkan
    $currentRole = $_SESSION['user']['role'];
    if (!in_array($currentRole, $allowedRoles, true)) {
        // Berikan status kode HTTP 403 Forbidden
        http_response_code(403);
        die("&lt;h2&gt;403 - Akses Ditolak!&lt;/h2&gt;&lt;p&gt;Halaman ini hanya untuk Admin.&lt;/p&gt;");
    }
}
?&gt;</code></pre>
            </div>
        </div>

        <!-- Tab 2: Usage -->
        <div class="neu-tab-content" id="tab-usage">
            <div class="code-container">
                <button type="button" class="btn-copy-code"><i class="bi bi-clipboard"></i> Salin</button>
                <pre><code>&lt;?php
// Pasang di baris paling atas setiap file admin!
require_once __DIR__ . '/../includes/auth.php';

// Kunci halaman ini hanya untuk Administrator
require_role('admin');

// Kode HTML Dashboard Admin di bawah ini...
?&gt;</code></pre>
            </div>
        </div>

        <!-- Tab 3: HTML -->
        <div class="neu-tab-content" id="tab-html">
            <div class="code-container">
                <button type="button" class="btn-copy-code"><i class="bi bi-clipboard"></i> Salin</button>
                <pre><code>&lt;!-- Template Tampilan 403 Forbidden --&gt;
&lt;div class="neu-card p-5 text-center mx-auto" style="max-width: 450px;"&gt;
    &lt;i class="bi bi-shield-lock-fill text-danger fs-1 mb-3"&gt;&lt;/i&gt;
    &lt;h3 class="fw-bold"&gt;Akses Ditolak (403)&lt;/h3&gt;
    &lt;p class="text-muted"&gt;Anda tidak memiliki izin untuk melihat data ini.&lt;/p&gt;
    &lt;a href="customer/dashboard.php" class="neu-btn neu-btn-primary"&gt;Kembali ke Dashboard&lt;/a&gt;
&lt;/div&gt;</code></pre>
            </div>
        </div>

        <!-- Tab 4: Explanation -->
        <div class="neu-tab-content" id="tab-explanation">
            <div class="neu-card-sm p-4 bg-white">
                <h6 class="fw-bold mb-3">Penjelasan Anatomi Logika:</h6>
                <ul class="text-muted small mb-0">
                    <li class="mb-2"><code>in_array($currentRole, $allowedRoles, true)</code>: Memeriksa apakah role pengguna yang sedang aktif (misal 'admin') terdaftar di dalam daftar role yang diperbolehkan membuka halaman tersebut.</li>
                    <li class="mb-2"><code>http_response_code(403)</code>: Memberi tahu browser dan mesin pencari bahwa permintaan ditolak karena pelanggaran hak akses.</li>
                    <li><code>exit / die()</code>: Menghentikan eksekusi kode PHP secara instan agar kode rahasia admin di bawahnya tidak bocor ke publik.</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- 5. Trik Hafalan Cepat / Mnemonics -->
    <div class="trick-box my-4">
        <h5 class="fw-bold text-warning mb-2"><i class="bi bi-key-fill me-2"></i>Trik Hafalan Cepat: Rumus "C-R-P"</h5>
        <ul class="mb-0 fw-semibold text-dark">
            <li><strong>C (Cek Sesi):</strong> Ada data <code>$_SESSION['user']</code>? Jika tidak ada &rarr; Tendang ke Login.</li>
            <li><strong>R (Role Check):</strong> Apakah <code>$role === 'admin'</code>?</li>
            <li><strong>P (Protect / 403):</strong> Jika bukan admin &rarr; Munculkan 403 Forbidden!</li>
        </ul>
    </div>

    <!-- 6. Jebakan Error Pemula & Solusi -->
    <div class="gotcha-box">
        <h5 class="fw-bold text-danger mb-2"><i class="bi bi-exclamation-triangle-fill me-2"></i>Jebakan Error Pemula:</h5>
        <p class="small mb-1">
            <strong>❌ Masalah Fatal UKK:</strong> Lupa memasang fungsi <code>require_role()</code> di file admin.<br>
            <strong>⚠️ Bahaya:</strong> Siapapun yang mengetik alamat URL <code>http://localhost/ukk2027/admin/reports.php</code> langsung bisa melihat laporan keuangan tanpa harus login!<br>
            <strong>✅ Solusi:</strong> Selalu letakkan <code>require_role('admin')</code> di baris pertama seluruh file dalam folder <code>admin/</code>.
        </p>
    </div>
</div>

<script>
function testAccess(role) {
    const res = document.getElementById('accessResult');
    if (role === 'guest') {
        res.innerHTML = `<span class="text-danger fw-bold"><i class="bi bi-exclamation-circle"></i> Belum Login!</span><br><small class="text-muted">Sistem mendeteksi session kosong &rarr; Otomatis dialihkan ke <code>auth/login.php</code>.</small>`;
    } else if (role === 'customer') {
        res.innerHTML = `<span class="text-danger fw-bold"><i class="bi bi-shield-x"></i> 403 FORBIDDEN - AKSES DITOLAK!</span><br><small class="text-muted">Role Anda adalah 'customer', Anda tidak memiliki hak membuka halaman Administrator!</small>`;
    } else if (role === 'admin') {
        res.innerHTML = `<span class="text-success fw-bold"><i class="bi bi-shield-check"></i> 200 OK - AKSES DITERIMA!</span><br><small class="text-muted">Selamat datang Administrator! Halaman <code>admin/dashboard.php</code> berhasil dimuat.</small>`;
    }
}
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
