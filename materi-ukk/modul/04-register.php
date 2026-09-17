<?php
$modulTitle = 'Langkah 04: Sistem Registrasi & Password Hash';
$modulNumber = 4;
require_once __DIR__ . '/../includes/header.php';
?>

<!-- Header Breadcrumb & Title -->
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <div>
        <span class="neu-badge neu-badge-primary mb-2">
            <i class="bi bi-person-plus-fill me-1 text-neu-accent"></i> Autentikasi & Keamanan - Tahap 4 dari 12
        </span>
        <h2 class="fw-extrabold mb-1 text-dark">Langkah 04: Formulir Registrasi & Enkripsi `password_hash()`</h2>
        <p class="text-muted mb-0">Membangun alur pendaftaran pelanggan, validasi kecocokan password, dan teknik pengacakan hash satu arah.</p>
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
                📁 <code>c:\xampp\htdocs\ukk2027\auth\register.php</code>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-2 neu-inset bg-white rounded-3 h-100">
                <strong>2. Tindakan Nyata Siswa:</strong><br>
                Buat folder <code>auth</code>, buat file <code>register.php</code>, lalu salin kode lengkap di tab source code.
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-2 neu-inset bg-white rounded-3 h-100">
                <strong>3. Cara Menguji di Browser:</strong><br>
                Akses <code>http://localhost/ukk2027/auth/register.php</code>, daftar akun baru, lalu cek tabel <code>users</code> di phpMyAdmin.
            </div>
        </div>
    </div>
</div>

<!-- 1. Konsep & Analogi Guru Besar (ELI5) -->
<div class="row g-4 mb-4">
    <div class="col-lg-7">
        <div class="neu-card p-4 h-100">
            <h5 class="fw-bold text-neu-primary mb-3">
                <i class="bi bi-mortarboard-fill me-2 text-neu-accent"></i> Penjelasan Guru Besar: Mengapa Password Wajib Di-Hash?
            </h5>
            <p class="text-muted">
                Dalam standar pengujian UKK dan industri IT modern, <strong>menyimpan password polos (*plain text*) di database adalah kesalahan fatal</strong> yang menyebabkan ketidaklulusan keamanan.
            </p>
            <ul class="text-muted small ps-3 mb-0">
                <li class="mb-2"><strong>`password_hash($password, PASSWORD_DEFAULT)`</strong>: Menghasilkan string acak sepanjang 60 karakter menggunakan algoritma <em>Bcrypt</em> dengan <em>salt</em> otomatis.</li>
                <li class="mb-2"><strong>One-Way Function (Satu Arah):</strong> String hash tidak bisa didekripsi kembali menjadi teks asli bahkan oleh administrator server sekalipun.</li>
                <li class="mb-0"><strong>Role Default:</strong> Pelanggan yang mendaftar secara mandiri otomatis diberi role <code>customer</code> (bukan admin).</li>
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
                    <strong>`password_hash()`</strong> ibarat <strong>Mesin Penggiling Daging</strong>:
                </p>
                <p class="mb-0 small">
                    Sangat mudah menggiling sepotong daging sapi (password asli) menjadi sosis cincang (hash Bcrypt). Tetapi tidak ada teknologi di dunia yang bisa mengubah sosis cincang tersebut kembali menjadi potongan sapi utuh!
                </p>
            </div>
        </div>
    </div>
</div>

<!-- 2. Pojok Dosen Senior: Kamus & Bedah Istilah Sulit -->
<div class="neu-card p-4 mb-4">
    <h5 class="fw-bold text-neu-primary mb-3">
        <i class="bi bi-book-half text-neu-accent me-2"></i> Kamus Istilah Programmer Senior: Bedah Kata Sulit Registrasi
    </h5>
    
    <div class="row g-3">
        <div class="col-md-6">
            <div class="p-3 neu-inset bg-white rounded-3 h-100">
                <h6 class="fw-bold text-danger mb-1"><i class="bi bi-shield-lock-fill me-1"></i> Apa itu `PASSWORD_DEFAULT` & Salt?</h6>
                <p class="small text-muted mb-0">
                    Konstanta <code>PASSWORD_DEFAULT</code> memberitahu PHP untuk menggunakan algoritma hashing standar terkuat saat ini (Bcrypt). Di balik layar, PHP otomatis membuat <strong>Salt</strong> (bumbu acak) yang membuat kata sandi yang sama persis (misal: "rahasia") menghasilkan string hash yang selalu berbeda jika didaftarkan oleh 2 user yang berbeda.
                </p>
            </div>
        </div>

        <div class="col-md-6">
            <div class="p-3 neu-inset bg-white rounded-3 h-100">
                <h6 class="fw-bold text-primary mb-1"><i class="bi bi-search me-1"></i> Mengapa `SELECT id FROM users WHERE username = :u LIMIT 1`?</h6>
                <p class="small text-muted mb-0">
                    Klausul <code>LIMIT 1</code> adalah optimasi performa penting. Begitu MySQL menemukan 1 baris username yang cocok, pencarian langsung dihentikan tanpa perlu memindai jutaan baris lainnya di database.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- 3. Live Interactive Simulator -->
<div class="neu-card p-4 mb-4">
    <h5 class="fw-bold text-neu-primary mb-3">
        <i class="bi bi-play-circle-fill me-2 text-neu-accent"></i> Interactive Simulator: Uji Form Registrasi & Simulasi Bcrypt Hash
    </h5>

    <div class="row g-4 align-items-center">
        <!-- Form Sisi Kiri -->
        <div class="col-md-6">
            <div class="neu-card-sm p-3 bg-white">
                <h6 class="fw-bold text-neu-primary mb-3"><i class="bi bi-person-badge me-1"></i> Form Pendaftaran Pelanggan</h6>
                <div class="mb-2">
                    <label class="form-label small fw-bold">Nama Lengkap</label>
                    <input type="text" id="simName" class="neu-input" value="Budi Santoso">
                </div>
                <div class="mb-2">
                    <label class="form-label small fw-bold">Username</label>
                    <input type="text" id="simUsername" class="neu-input" value="budi">
                </div>
                <div class="mb-2">
                    <label class="form-label small fw-bold">Password</label>
                    <input type="password" id="simPass1" class="neu-input" value="rahasia123" oninput="simCheckHash()">
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-bold">Konfirmasi Password</label>
                    <input type="password" id="simPass2" class="neu-input" value="rahasia123" oninput="simCheckHash()">
                    <div id="simMatchStatus" class="small mt-1 text-success fw-bold"><i class="bi bi-check-circle-fill"></i> Password Cocok</div>
                </div>
            </div>
        </div>

        <!-- Output Database Sisi Kanan -->
        <div class="col-md-6">
            <div class="neu-card-sm p-3 bg-white">
                <h6 class="fw-bold text-neu-primary mb-2"><i class="bi bi-database-check me-1"></i> Hasil Record yang Tersimpan di Database:</h6>
                <div class="small font-monospace p-3 rounded-3" style="background: #201611; color: #fdf8f4; line-height: 1.8;">
                    <div><strong>id:</strong> 101 (AUTO_INCREMENT)</div>
                    <div><strong>name:</strong> <span id="outName" class="text-warning">Budi Santoso</span></div>
                    <div><strong>username:</strong> <span id="outUser" class="text-info">budi</span></div>
                    <div><strong>role:</strong> <span class="text-success">customer</span></div>
                    <div><strong>password (Hash):</strong></div>
                    <div id="outHash" class="text-break text-warning fw-bold" style="font-size: 0.75rem;">$2y$10$eE0o9gK0Z2wH7jL1hK0u2.v9vF3j4hP1p0Xz9/j4oR9A1f4g7T2y</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 4. Source Code Tabs -->
<div class="neu-card p-4 mb-4">
    <h5 class="fw-bold text-neu-primary mb-3">
        <i class="bi bi-code-square me-2 text-neu-accent"></i> Source Code Lengkap Halaman Registrasi (`auth/register.php`)
    </h5>

    <div class="code-container">
        <button type="button" class="btn-copy-code"><i class="bi bi-clipboard"></i> Salin Kode</button>
        <pre><code>&lt;?php
require_once '../config/database.php';
require_once '../includes/functions.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = sanitize($_POST['name'] ?? '');
    $username = sanitize($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm  = $_POST['confirm_password'] ?? '';

    // 1. Validasi Input Form
    if (empty($name) || empty($username) || empty($password)) {
        $error = 'Semua kolom formulir wajib diisi!';
    } elseif ($password !== $confirm) {
        $error = 'Konfirmasi password tidak cocok dengan password yang diketik!';
    } elseif (strlen($password) < 4) {
        $error = 'Password minimal terdiri dari 4 karakter!';
    } else {
        // 2. Cek apakah username sudah dipakai orang lain
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = :username LIMIT 1");
        $stmt->execute([':username' => $username]);

        if ($stmt->fetch()) {
            $error = "Username '{$username}' sudah terdaftar. Silakan gunakan username lain.";
        } else {
            // 3. Enkripsi Password dengan Bcrypt Hash
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // 4. Masukkan Akun Customer Baru ke Database
            $insert = $pdo->prepare("INSERT INTO users (username, password, name, role) VALUES (:u, :p, :n, 'customer')");
            $insert->execute([
                ':u' => $username,
                ':p' => $hashedPassword,
                ':n' => $name
            ]);

            $success = 'Registrasi berhasil! Silakan masuk melalui halaman login.';
        }
    }
}
?&gt;
&lt;!-- Form HTML Register --&gt;
&lt;form action="" method="POST"&gt;
    &lt;?php if ($error): ?&gt; &lt;div class="alert alert-danger"&gt;&lt;?php echo $error; ?&gt;&lt;/div&gt; &lt;?php endif; ?&gt;
    &lt;?php if ($success): ?&gt; &lt;div class="alert alert-success"&gt;&lt;?php echo $success; ?&gt;&lt;/div&gt; &lt;?php endif; ?&gt;
    &lt;input type="text" name="name" class="form-control mb-3" placeholder="Nama Lengkap" required&gt;
    &lt;input type="text" name="username" class="form-control mb-3" placeholder="Username" required&gt;
    &lt;input type="password" name="password" class="form-control mb-3" placeholder="Kata Sandi" required&gt;
    &lt;input type="password" name="confirm_password" class="form-control mb-3" placeholder="Ulangi Kata Sandi" required&gt;
    &lt;button type="submit" class="btn btn-primary w-100"&gt;Daftar Akun Sekarang&lt;/button&gt;
&lt;/form&gt;</code></pre>
    </div>
</div>

<!-- 5. Jembatan Keledai & Rumus Hafalan -->
<div class="trick-box">
    <h5 class="fw-bold text-neu-primary mb-2">
        <i class="bi bi-bookmark-star-fill text-warning me-2"></i> Rumus Alur 4 Langkah Registrasi PHP
    </h5>
    <p class="mb-2 small">
        Ingat rumus <strong>"V - C - H - I"</strong>:
    </p>
    <ul class="small mb-0 ps-3">
        <li><strong>V</strong>alidasi: Cek kolom kosong & kecocokan konfirmasi password.</li>
        <li><strong>C</strong>ek Duplikasi: <code>SELECT id FROM users WHERE username = :u</code>.</li>
        <li><strong>H</strong>ash: <code>password_hash($pass, PASSWORD_DEFAULT)</code>.</li>
        <li><strong>I</strong>nsert: <code>INSERT INTO users (username, password, name, role) VALUES (...)</code>.</li>
    </ul>
</div>

<script>
function simCheckHash() {
    const n = document.getElementById('simName').value || 'Nama';
    const u = document.getElementById('simUsername').value || 'user';
    const p1 = document.getElementById('simPass1').value;
    const p2 = document.getElementById('simPass2').value;
    const st = document.getElementById('simMatchStatus');

    document.getElementById('outName').innerText = n;
    document.getElementById('outUser').innerText = u;

    if (p1 === p2 && p1.length > 0) {
        st.className = 'small mt-1 text-success fw-bold';
        st.innerHTML = '<i class="bi bi-check-circle-fill"></i> Password Cocok';
        document.getElementById('outHash').innerText = '$2y$10$' + btoa(p1).substring(0, 10) + 'wH7jL1hK0u2.v9vF3j4hP1p0Xz9';
    } else {
        st.className = 'small mt-1 text-danger fw-bold';
        st.innerHTML = '<i class="bi bi-x-circle-fill"></i> Konfirmasi password belum sama!';
    }
}
document.getElementById('simName').addEventListener('input', simCheckHash);
document.getElementById('simUsername').addEventListener('input', simCheckHash);
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
