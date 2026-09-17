<?php
$modulTitle = 'Langkah 05: Login Multi-Role & Manajemen Sesi';
$modulNumber = 5;
require_once __DIR__ . '/../includes/header.php';
?>

<!-- Header Breadcrumb & Title -->
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <div>
        <span class="neu-badge neu-badge-primary mb-2">
            <i class="bi bi-box-arrow-in-right me-1 text-neu-accent"></i> Autentikasi & Sesi - Tahap 5 dari 12
        </span>
        <h2 class="fw-extrabold mb-1 text-dark">Langkah 05: Form Login Multi-Role & Manajemen `$_SESSION`</h2>
        <p class="text-muted mb-0">Verifikasi kata sandi dengan `password_verify()`, penyimpanan data sesi, dan pengalihan hak akses (Admin vs Customer).</p>
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
                <strong>1. Lokasi Berkas (Root Files):</strong><br>
                📁 <code>c:\xampp\htdocs\ukk2027\auth\login.php</code><br>
                📁 <code>c:\xampp\htdocs\ukk2027\auth\logout.php</code>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-2 neu-inset bg-white rounded-3 h-100">
                <strong>2. Tindakan Nyata Siswa:</strong><br>
                Buat kedua file di folder <code>auth/</code>, tulis logika verifikasi hash dan penghancuran sesi saat logout.
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-2 neu-inset bg-white rounded-3 h-100">
                <strong>3. Cara Menguji di Browser:</strong><br>
                Buka <code>http://localhost/ukk2027/auth/login.php</code>. Uji login sebagai <strong>admin</strong> (pass: <code>password</code>) dan <strong>budi</strong> (pass: <code>password</code>).
            </div>
        </div>
    </div>
</div>

<!-- 1. Konsep & Analogi Guru Besar (ELI5) -->
<div class="row g-4 mb-4">
    <div class="col-lg-7">
        <div class="neu-card p-4 h-100">
            <h5 class="fw-bold text-neu-primary mb-3">
                <i class="bi bi-mortarboard-fill me-2 text-neu-accent"></i> Penjelasan Guru Besar: Bagaimana Login Multi-Role Bekerja?
            </h5>
            <p class="text-muted">
                Karena password di database tersimpan dalam bentuk hash Bcrypt yang diacak, kita tidak bisa membandingkannya dengan operator sama dengan biasa (<code>$pass == $row['password']</code>).
            </p>
            <ul class="text-muted small ps-3 mb-0">
                <li class="mb-2"><strong>`password_verify($inputPass, $dbHash)`</strong>: Mengambil kata sandi yang diketikkan di form, mengenkripsinya dengan <em>salt</em> yang sama di database, lalu mencocokkan pola hash-nya.</li>
                <li class="mb-2"><strong>`$_SESSION`</strong>: Variabel memori superglobal di server yang mengingat status login pengguna selama browser tetap terbuka.</li>
                <li class="mb-0"><strong>Role Redirection</strong>: Jika role = <code>admin</code> $\rightarrow$ diarahkan ke <code>admin/dashboard.php</code>. Jika role = <code>customer</code> $\rightarrow$ diarahkan ke <code>customer/dashboard.php</code>.</li>
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
                    <strong>Proses Login</strong> ibarat <strong>Pemeriksaan KTP di Pintu Masuk Konser</strong>:
                </p>
                <p class="mb-0 small">
                    Satpam (Server PHP) memeriksa keaslian KTP (Password). Jika valid, kamu diberi <strong>Gelang Tiket VIP (Session)</strong>. Selama gelang itu terpasang di tanganmu, kamu bebas keluar-masuk ruangan konser tanpa perlu diperiksa KTP lagi!
                </p>
            </div>
        </div>
    </div>
</div>

<!-- 2. Pojok Dosen Senior: Kamus & Bedah Istilah Sulit -->
<div class="neu-card p-4 mb-4">
    <h5 class="fw-bold text-neu-primary mb-3">
        <i class="bi bi-book-half text-neu-accent me-2"></i> Kamus Istilah Programmer Senior: Bedah Kata Sulit Autentikasi
    </h5>
    
    <div class="row g-3">
        <div class="col-md-6">
            <div class="p-3 neu-inset bg-white rounded-3 h-100">
                <h6 class="fw-bold text-danger mb-1"><i class="bi bi-door-closed-fill me-1"></i> Mengapa Wajib `exit` setelah `header('Location: ...')`?</h6>
                <p class="small text-muted mb-0">
                    Fungsi <code>header('Location: ...')</code> hanya mengirim instruksi redirect ke browser. Jika kamu tidak menulis <code>exit;</code> di bawahnya, script PHP di baris-baris bawahnya AKAN TETAP DIJALANKAN oleh server! Ini adalah celah keamanan fatal (*Execution After Redirect vulnerability*) yang sering dicari penguji asesmen.
                </p>
            </div>
        </div>

        <div class="col-md-6">
            <div class="p-3 neu-inset bg-white rounded-3 h-100">
                <h6 class="fw-bold text-primary mb-1"><i class="bi bi-shield-slash-fill me-1"></i> Apa Beda `session_unset()` vs `session_destroy()`?</h6>
                <p class="small text-muted mb-0">
                    <strong>`session_unset()`:</strong> Menghapus semua variabel isi data di dalam array <code>$_SESSION</code> (membersihkan isi koper).<br>
                    <strong>`session_destroy()`:</strong> Menghancurkan ID sesi fisik yang tersimpan di file penyimpanan server (membakar kopernya). Saat logout, gunakan keduanya agar 100% aman!
                </p>
            </div>
        </div>
    </div>
</div>

<!-- 3. Live Interactive Simulator -->
<div class="neu-card p-4 mb-4">
    <h5 class="fw-bold text-neu-primary mb-3">
        <i class="bi bi-play-circle-fill me-2 text-neu-accent"></i> Interactive Simulator: Uji Login Multi-Role & Perubahan Status Sesi
    </h5>

    <div class="row g-4">
        <!-- Form Login Tester -->
        <div class="col-md-5">
            <div class="neu-card-sm p-3 bg-white">
                <h6 class="fw-bold text-neu-primary mb-3"><i class="bi bi-person-lock me-1"></i> Form Login Simulator</h6>
                <div class="mb-2">
                    <label class="form-label small fw-bold">Username</label>
                    <select id="simLogUser" class="neu-input" onchange="autoFillPass()">
                        <option value="admin">admin (Administrator)</option>
                        <option value="budi">budi (Pelanggan / Customer)</option>
                        <option value="salah">user_palsu (Akun Salah)</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-bold">Password</label>
                    <input type="text" id="simLogPass" class="neu-input" value="password">
                </div>
                <button type="button" class="neu-btn neu-btn-sm neu-btn-primary w-100" onclick="simDoLogin()">
                    <i class="bi bi-box-arrow-in-right me-1"></i> Jalankan Verifikasi Login
                </button>
            </div>
        </div>

        <!-- Output Sesi & Redirection -->
        <div class="col-md-7">
            <div class="neu-card-sm p-3 bg-white">
                <h6 class="fw-bold text-neu-primary mb-2"><i class="bi bi-server me-1"></i> Data Memori `$_SESSION` di Server:</h6>
                <div class="p-3 rounded-3 font-monospace small mb-2" style="background: #201611; color: #fdf8f4;" id="sessionViewer">
                    $_SESSION = [<br>
                    &nbsp;&nbsp;'user_id'  => 1,<br>
                    &nbsp;&nbsp;'username' => 'admin',<br>
                    &nbsp;&nbsp;'name'     => 'Administrator Cafe',<br>
                    &nbsp;&nbsp;'role'     => 'admin'<br>
                    ];
                </div>
                <div id="simLogResult" class="alert alert-success py-2 small mb-0 fw-bold">
                    <i class="bi bi-check-circle-fill me-1"></i> Berhasil masuk! Role <strong>admin</strong> diarahkan ke <code>/admin/dashboard.php</code>.
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 4. Source Code Tabs -->
<div class="neu-card p-4 mb-4">
    <h5 class="fw-bold text-neu-primary mb-3">
        <i class="bi bi-code-square me-2 text-neu-accent"></i> Source Code Lengkap (`auth/login.php` & `auth/logout.php`)
    </h5>

    <div class="neu-tabs mb-3">
        <button class="neu-tab-btn active" data-tab="tab-login">1. `auth/login.php` (Verifikasi & Redirection)</button>
        <button class="neu-tab-btn" data-tab="tab-logout">2. `auth/logout.php` (Penghancuran Sesi)</button>
    </div>

    <!-- Tab 1: Login.php -->
    <div class="neu-tab-content active" id="tab-login">
        <div class="code-container">
            <button type="button" class="btn-copy-code"><i class="bi bi-clipboard"></i> Salin Login</button>
            <pre><code>&lt;?php
session_start();
require_once '../config/database.php';
require_once '../includes/functions.php';

// Jika sudah login sebelumnya, langsung arahkan ke dashboard masing-masing
if (isset($_SESSION['role'])) {
    header('Location: ' . ($_SESSION['role'] === 'admin' ? '../admin/dashboard.php' : '../customer/dashboard.php'));
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        $error = 'Username dan kata sandi tidak boleh kosong!';
    } else {
        // 1. Ambil data akun berdasarkan username
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :u LIMIT 1");
        $stmt->execute([':u' => $username]);
        $user = $stmt->fetch();

        // 2. Verifikasi kecocokan password hash dengan password_verify()
        if ($user && password_verify($password, $user['password'])) {
            // 3. Catat identitas ke variabel global $_SESSION
            $_SESSION['user_id']  = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['name']     = $user['name'];
            $_SESSION['role']     = $user['role'];

            // 4. Pengalihan halaman sesuai hak akses
            if ($user['role'] === 'admin') {
                header('Location: ../admin/dashboard.php');
            } else {
                header('Location: ../customer/dashboard.php');
            }
            exit;
        } else {
            $error = 'Kombinasi username atau password salah!';
        }
    }
}
?&gt;</code></pre>
        </div>
    </div>

    <!-- Tab 2: Logout.php -->
    <div class="neu-tab-content" id="tab-logout">
        <div class="code-container">
            <button type="button" class="btn-copy-code"><i class="bi bi-clipboard"></i> Salin Logout</button>
            <pre><code>&lt;?php
session_start();

// 1. Kosongkan semua variabel di $_SESSION
session_unset();

// 2. Hancurkan sesi di server
session_destroy();

// 3. Arahkan kembali ke halaman login utama dengan pesan sukses
header('Location: login.php?msg=logged_out');
exit;</code></pre>
        </div>
    </div>
</div>

<!-- 5. Jembatan Keledai & Rumus Hafalan -->
<div class="trick-box">
    <h5 class="fw-bold text-neu-primary mb-2">
        <i class="bi bi-bookmark-star-fill text-warning me-2"></i> Rumus Alur 4 Langkah Autentikasi Login PHP
    </h5>
    <p class="mb-2 small">
        Hafalkan rumus <strong>"Q - V - S - R"</strong>:
    </p>
    <ul class="small mb-0 ps-3">
        <li><strong>Q</strong>uery User: <code>SELECT * FROM users WHERE username = :u</code>.</li>
        <li><strong>V</strong>erify Password: <code>password_verify($password, $user['password'])</code>.</li>
        <li><strong>S</strong>ession Set: Isi <code>$_SESSION['user_id']</code>, <code>$_SESSION['role']</code>, dll.</li>
        <li><strong>R</strong>edirect: Arahkan URL berdasarkan isi role (Admin vs Customer).</li>
    </ul>
</div>

<script>
function autoFillPass() {
    const u = document.getElementById('simLogUser').value;
    if (u === 'admin') document.getElementById('simLogPass').value = 'password';
    else if (u === 'budi') document.getElementById('simLogPass').value = 'password';
    else document.getElementById('simLogPass').value = 'ngawur';
}

function simDoLogin() {
    const u = document.getElementById('simLogUser').value;
    const p = document.getElementById('simLogPass').value;
    const box = document.getElementById('sessionViewer');
    const res = document.getElementById('simLogResult');

    if (u === 'admin' && p === 'password') {
        box.innerHTML = "$_SESSION = [<br>&nbsp;&nbsp;'user_id'  => 1,<br>&nbsp;&nbsp;'username' => 'admin',<br>&nbsp;&nbsp;'name'     => 'Administrator Cafe',<br>&nbsp;&nbsp;'role'     => 'admin'<br>];";
        res.className = 'alert alert-success py-2 small mb-0 fw-bold';
        res.innerHTML = '<i class="bi bi-check-circle-fill me-1"></i> Login Berhasil! Role <strong>admin</strong> diarahkan ke <code>/admin/dashboard.php</code>.';
    } else if (u === 'budi' && p === 'password') {
        box.innerHTML = "$_SESSION = [<br>&nbsp;&nbsp;'user_id'  => 2,<br>&nbsp;&nbsp;'username' => 'budi',<br>&nbsp;&nbsp;'name'     => 'Budi Santoso',<br>&nbsp;&nbsp;'role'     => 'customer'<br>];";
        res.className = 'alert alert-success py-2 small mb-0 fw-bold';
        res.innerHTML = '<i class="bi bi-check-circle-fill me-1"></i> Login Berhasil! Role <strong>customer</strong> diarahkan ke <code>/customer/dashboard.php</code>.';
    } else {
        box.innerHTML = "$_SESSION = []; // Kosong (Gagal Autentikasi)";
        res.className = 'alert alert-danger py-2 small mb-0 fw-bold';
        res.innerHTML = '<i class="bi bi-x-circle-fill me-1"></i> Login Gagal! Username atau password tidak cocok di database.';
    }
}
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
