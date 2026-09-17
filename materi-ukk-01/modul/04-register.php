<?php
$modulTitle = 'Modul 04: Form Registrasi & Enkripsi Hash (Register & Hash)';
$modulNumber = 4;
require_once __DIR__ . '/../includes/header.php';
?>

<div class="neu-card p-4 p-md-5 mb-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        <span class="neu-badge neu-badge-primary">
            <i class="bi bi-person-plus"></i> Modul 04 - Keamanan Input & Enkripsi
        </span>
        <span class="text-muted small">Target: Menguasai Registrasi Akun, password_hash(), & SQL Insert</span>
    </div>

    <h2 class="fw-extrabold mb-3 text-dark">Form Registrasi & Enkripsi Hash (Register & Password Hash)</h2>
    <p class="lead text-muted mb-4">
        Registrasi adalah pintu bagi pengguna baru untuk mendaftar akun dengan jaminan keamanan kata sandi yang terenkripsi kuat.
    </p>

    <!-- 1. Konsep Inti 5 Detik -->
    <div class="neu-card-sm p-4 mb-4 bg-white">
        <h5 class="fw-bold mb-2 text-dark"><i class="bi bi-bullseye text-primary me-2"></i>Konsep 5 Detik:</h5>
        <p class="mb-0 text-muted">
            User memasukkan nama, username, password & konfirmasi &rarr; PHP memvalidasi bahwa password = konfirmasi password &rarr; PHP mengenkripsi password dengan <code>password_hash($pass, PASSWORD_DEFAULT)</code> &rarr; PHP menyimpan data ke database dengan query <code>INSERT INTO users</code>.
        </p>
    </div>

    <!-- 2. Analogi Dunia Nyata -->
    <div class="analogy-box mb-4">
        <h5 class="fw-bold text-primary mb-2"><i class="bi bi-lightbulb-fill me-2"></i>Analogi Dunia Nyata: "Mesin Penghancur Kertas & Kode Rahasia"</h5>
        <p class="mb-0">
            Bayangkan Anda mendaftar kartu ATM baru. Anda menulis PIN di kertas. Petugas bank tidak membaca PIN Anda, melainkan memasukkan kertas itu ke <strong>Mesin Pengacak Sandi (Hashing Machine)</strong> yang mengubah PIN Anda menjadi barisan 60 karakter acak yang tidak bisa ditebak siapapun. Bank hanya menyimpan hasil acakan tersebut.
        </p>
    </div>

    <!-- 3. Live Interactive Playground -->
    <h5 class="fw-bold mb-3 text-dark"><i class="bi bi-play-circle text-primary me-2"></i>Live Interactive Playground:</h5>
    <div class="demo-stage mb-4">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-6">
                <div class="neu-card p-4">
                    <h5 class="fw-bold text-center mb-3">Simulasi Pendaftaran & Real-time Hash Generator</h5>
                    <div class="mb-2">
                        <label class="small text-muted fw-semibold">Nama Lengkap:</label>
                        <input type="text" id="regName" class="neu-input" placeholder="Budi Santoso">
                    </div>
                    <div class="mb-2">
                        <label class="small text-muted fw-semibold">Password:</label>
                        <input type="password" id="regPass1" class="neu-input" placeholder="Ketik password" oninput="checkMatch()">
                    </div>
                    <div class="mb-3">
                        <label class="small text-muted fw-semibold">Ulangi Password:</label>
                        <input type="password" id="regPass2" class="neu-input" placeholder="Ketik ulang password" oninput="checkMatch()">
                    </div>
                    
                    <div id="matchIndicator" class="mb-3 small fw-bold text-muted">Ketik password untuk melihat validasi...</div>

                    <div class="neu-inset p-3 mb-3 small bg-light" style="word-break: break-all;">
                        <span class="text-muted d-block small mb-1">Contoh Hasil <code>password_hash()</code> di Database:</span>
                        <code id="hashPreview" class="text-primary font-monospace">$2y$10$eACCYoNOHEqgkPq2qjU4e.Y8v6N0q0N5oA3M87vMhU3E2xV2hO3sO</code>
                    </div>

                    <button type="button" class="neu-btn neu-btn-primary w-100 py-2 justify-content-center" onclick="simulateRegister()">
                        <i class="bi bi-check2-circle me-1"></i> Daftarkan Akun Baru
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- 4. Interactive Code Tabs -->
    <div class="neu-tabs-container">
        <div class="neu-tabs">
            <button type="button" class="neu-tab-btn active" data-tab="html">1. Form Register HTML</button>
            <button type="button" class="neu-tab-btn" data-tab="css">2. CSS Inset Styling</button>
            <button type="button" class="neu-tab-btn" data-tab="php">3. PHP Register & Hash</button>
            <button type="button" class="neu-tab-btn" data-tab="explanation">4. Bedah Baris per Baris</button>
        </div>

        <!-- Tab 1: HTML -->
        <div class="neu-tab-content active" id="tab-html">
            <div class="code-container">
                <button type="button" class="btn-copy-code"><i class="bi bi-clipboard"></i> Salin</button>
                <pre><code>&lt;form action="register.php" method="POST" class="neu-card p-4"&gt;
    &lt;h4 class="fw-bold text-center mb-3"&gt;Daftar Akun Pelanggan&lt;/h4&gt;
    
    &lt;div class="mb-3"&gt;
        &lt;label&gt;Nama Lengkap&lt;/label&gt;
        &lt;input type="text" name="name" class="neu-input" required&gt;
    &lt;/div&gt;

    &lt;div class="mb-3"&gt;
        &lt;label&gt;Username&lt;/label&gt;
        &lt;input type="text" name="username" class="neu-input" required&gt;
    &lt;/div&gt;

    &lt;div class="mb-3"&gt;
        &lt;label&gt;Password&lt;/label&gt;
        &lt;input type="password" name="password" class="neu-input" required&gt;
    &lt;/div&gt;

    &lt;div class="mb-3"&gt;
        &lt;label&gt;Konfirmasi Password&lt;/label&gt;
        &lt;input type="password" name="confirm_password" class="neu-input" required&gt;
    &lt;/div&gt;

    &lt;button type="submit" class="neu-btn neu-btn-primary w-100"&gt;Daftar Sekarang&lt;/button&gt;
&lt;/form&gt;</code></pre>
            </div>
        </div>

        <!-- Tab 2: CSS -->
        <div class="neu-tab-content" id="tab-css">
            <div class="code-container">
                <button type="button" class="btn-copy-code"><i class="bi bi-clipboard"></i> Salin</button>
                <pre><code>.neu-input {
    background: #f4eee5;
    color: #2b1e16;
    border-radius: 12px;
    padding: 12px 18px;
    border: 1px solid rgba(255, 255, 255, 0.6);
    box-shadow: inset 3px 3px 6px #d5cabe,
                inset -3px -3px 6px #ffffff;
    width: 100%;
    box-sizing: border-box;
}</code></pre>
            </div>
        </div>

        <!-- Tab 3: PHP -->
        <div class="neu-tab-content" id="tab-php">
            <div class="code-container">
                <button type="button" class="btn-copy-code"><i class="bi bi-clipboard"></i> Salin</button>
                <pre><code>&lt;?php
require_once 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = trim($_POST['name']);
    $username = trim($_POST['username']);
    $pass     = trim($_POST['password']);
    $confirm  = trim($_POST['confirm_password']);

    // 1. Validasi kecocokan password
    if ($pass !== $confirm) {
        die("Error: Konfirmasi password tidak cocok!");
    }

    // 2. Enkripsi password menggunakan BCRYPT
    $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

    // 3. Simpan ke database dengan role default 'customer'
    $stmt = $pdo->prepare("INSERT INTO users (name, username, password, role, created_at) VALUES (?, ?, ?, 'customer', NOW())");
    $stmt->execute([$name, $username, $hashedPassword]);

    // 4. Alihkan ke halaman login
    header("Location: login.php");
    exit;
}
?&gt;</code></pre>
            </div>
        </div>

        <!-- Tab 4: Explanation -->
        <div class="neu-tab-content" id="tab-explanation">
            <div class="neu-card-sm p-4 bg-white">
                <h6 class="fw-bold mb-3">Penjelasan Anatomi Logika:</h6>
                <ul class="text-muted small mb-0">
                    <li class="mb-2"><code>if ($pass !== $confirm)</code>: Menjaga agar user tidak salah ketik password saat mendaftar.</li>
                    <li class="mb-2"><code>password_hash($pass, PASSWORD_DEFAULT)</code>: Standar keamanan industri PHP yang mengacak password menjadi 60 karakter hash satu arah yang aman dari serangan peretas.</li>
                    <li class="mb-2"><code>INSERT INTO users (...) VALUES (?, ?, ?, 'customer', NOW())</code>: Memasukkan user baru secara aman menggunakan parameter binding <code>?</code> untuk mencegah SQL Injection.</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- 5. Trik Hafalan Cepat / Mnemonics -->
    <div class="trick-box my-4">
        <h5 class="fw-bold text-warning mb-2"><i class="bi bi-key-fill me-2"></i>Trik Hafalan Cepat: Rumus "C-H-I-R"</h5>
        <ul class="mb-0 fw-semibold text-dark">
            <li><strong>C (Check Match):</strong> Cocokkan <code>$password === $confirm_password</code>.</li>
            <li><strong>H (Hash Password):</strong> Acak dengan <code>password_hash(..., PASSWORD_DEFAULT)</code>.</li>
            <li><strong>I (Insert Database):</strong> Simpan ke tabel users via <code>INSERT</code>.</li>
            <li><strong>R (Redirect):</strong> Arahkan user ke halaman login untuk masuk!</li>
        </ul>
    </div>

    <!-- 6. Jebakan Error Pemula & Solusi -->
    <div class="gotcha-box">
        <h5 class="fw-bold text-danger mb-2"><i class="bi bi-exclamation-triangle-fill me-2"></i>Jebakan Error Pemula:</h5>
        <p class="small mb-1">
            <strong>❌ Masalah Fatal:</strong> Menyimpan password polos (plain text) seperti <code>INSERT INTO users (password) VALUES ('123456')</code>.<br>
            <strong>⚠️ Konsekuensi:</strong> Mendapatkan nilai <strong>TIDAK KOMPETEN</strong> saat uji sertifikasi UKK Asisten Pengembang Web!<br>
            <strong>✅ Solusi:</strong> Selalu gunakan <code>password_hash($password, PASSWORD_DEFAULT)</code> sebelum menyimpan password ke database.
        </p>
    </div>
</div>

<script>
function checkMatch() {
    const p1 = document.getElementById('regPass1').value;
    const p2 = document.getElementById('regPass2').value;
    const indicator = document.getElementById('matchIndicator');

    if (p1 === '' && p2 === '') {
        indicator.innerHTML = 'Ketik password untuk melihat validasi...';
        indicator.style.color = '#706359';
    } else if (p1 === p2) {
        indicator.innerHTML = '<i class="bi bi-check-circle-fill text-success"></i> Password Cocok!';
        indicator.style.color = '#10b981';
    } else {
        indicator.innerHTML = '<i class="bi bi-x-circle-fill text-danger"></i> Password Tidak Cocok!';
        indicator.style.color = '#ef4444';
    }
}

function simulateRegister() {
    const p1 = document.getElementById('regPass1').value;
    const p2 = document.getElementById('regPass2').value;
    if (p1.length < 4) {
        alert('Password minimal 4 karakter!');
        return;
    }
    if (p1 !== p2) {
        alert('Konfirmasi password tidak cocok!');
        return;
    }
    alert('Registrasi Berhasil! Password telah di-hash dan disimpan ke database.');
}
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
