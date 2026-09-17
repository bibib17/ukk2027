<?php
$modulTitle = 'Modul 03: Form Login & Autentikasi Sesi (Login & Session)';
$modulNumber = 3;
require_once __DIR__ . '/../includes/header.php';
?>

<div class="neu-card p-4 p-md-5 mb-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        <span class="neu-badge neu-badge-primary">
            <i class="bi bi-box-arrow-in-right"></i> Modul 03 - Autentikasi & Keamanan Sesi
        </span>
        <span class="text-muted small">Target: Menguasai Form Login, password_verify(), & Session Management</span>
    </div>

    <h2 class="fw-extrabold mb-3 text-dark">Form Login & Autentikasi Sesi (Login & PHP Session)</h2>
    <p class="lead text-muted mb-4">
        Login adalah proses memverifikasi identitas pengguna dan memberikan "tanda pengenal" digital berupa Session di browser.
    </p>

    <!-- 1. Konsep Inti 5 Detik -->
    <div class="neu-card-sm p-4 mb-4 bg-white">
        <h5 class="fw-bold mb-2 text-dark"><i class="bi bi-bullseye text-primary me-2"></i>Konsep 5 Detik:</h5>
        <p class="mb-0 text-muted">
            User mengetik username & password &rarr; PHP mencari user di database &rarr; PHP mencocokkan password menggunakan <code>password_verify()</code> &rarr; Jika cocok, data user disimpan di <code>$_SESSION['user']</code> &rarr; User dialihkan (redirect) ke Dashboard.
        </p>
    </div>

    <!-- 2. Analogi Dunia Nyata -->
    <div class="analogy-box mb-4">
        <h5 class="fw-bold text-primary mb-2"><i class="bi bi-lightbulb-fill me-2"></i>Analogi Dunia Nyata: "Satpam Konser Musik & Gelang VIP"</h5>
        <p class="mb-0">
            Saat ingin masuk ke gedung konser, Anda menunjukkan <strong>KTP dan Tiket (Username & Password)</strong> ke Satpam. Satpam memeriksa daftar tamu di buku induk (Database). Jika cocok, satpam memasangkan <strong>Gelang Kertas Khusus (Session)</strong> di tangan Anda. Selama gelang itu terpasang, Anda bebas lalu lalang di dalam gedung tanpa harus menunjukkan KTP lagi setiap detik.
        </p>
    </div>

    <!-- 3. Live Interactive Playground -->
    <h5 class="fw-bold mb-3 text-dark"><i class="bi bi-play-circle text-primary me-2"></i>Live Interactive Playground:</h5>
    <div class="demo-stage mb-4">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-5">
                <div class="neu-card p-4">
                    <h5 class="fw-bold text-center mb-3">Simulasi Form Login</h5>
                    <div class="mb-3">
                        <label class="small text-muted fw-semibold mb-1">Username:</label>
                        <input type="text" id="demoUser" class="neu-input" placeholder="Ketik 'admin' atau 'customer'">
                    </div>
                    <div class="mb-3">
                        <label class="small text-muted fw-semibold mb-1">Password:</label>
                        <input type="password" id="demoPass" class="neu-input" placeholder="Ketik 'password'">
                    </div>
                    <button type="button" class="neu-btn neu-btn-primary w-100 py-2 justify-content-center" onclick="simulateLogin()">
                        <i class="bi bi-box-arrow-in-right me-1"></i> Masuk Sekarang
                    </button>

                    <div id="loginFeedback" class="mt-3 p-2 text-center rounded small d-none"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- 4. Interactive Code Tabs -->
    <div class="neu-tabs-container">
        <div class="neu-tabs">
            <button type="button" class="neu-tab-btn active" data-tab="html">1. Form Login HTML</button>
            <button type="button" class="neu-tab-btn" data-tab="css">2. CSS Inset Neumorphism</button>
            <button type="button" class="neu-tab-btn" data-tab="php">3. PHP Auth & Sesi</button>
            <button type="button" class="neu-tab-btn" data-tab="explanation">4. Bedah Baris per Baris</button>
        </div>

        <!-- Tab 1: HTML -->
        <div class="neu-tab-content active" id="tab-html">
            <div class="code-container">
                <button type="button" class="btn-copy-code"><i class="bi bi-clipboard"></i> Salin</button>
                <pre><code>&lt;form action="login.php" method="POST" class="neu-card p-4"&gt;
    &lt;h4 class="fw-bold text-center mb-3"&gt;Masuk ke Akun&lt;/h4&gt;
    
    &lt;div class="mb-3"&gt;
        &lt;label for="username"&gt;Username&lt;/label&gt;
        &lt;input type="text" name="username" id="username" class="neu-input" required&gt;
    &lt;/div&gt;

    &lt;div class="mb-3"&gt;
        &lt;label for="password"&gt;Password&lt;/label&gt;
        &lt;input type="password" name="password" id="password" class="neu-input" required&gt;
    &lt;/div&gt;

    &lt;button type="submit" class="neu-btn neu-btn-primary w-100"&gt;Masuk&lt;/button&gt;
&lt;/form&gt;</code></pre>
            </div>
        </div>

        <!-- Tab 2: CSS -->
        <div class="neu-tab-content" id="tab-css">
            <div class="code-container">
                <button type="button" class="btn-copy-code"><i class="bi bi-clipboard"></i> Salin</button>
                <pre><code>/* Input Cekung ke Dalam (Inset Shadow - Warm Cafe) */
.neu-input {
    background: #f4eee5;
    color: #2b1e16;
    border-radius: 12px;
    padding: 12px 18px;
    border: 1px solid rgba(255, 255, 255, 0.6);
    box-shadow: inset 3px 3px 6px #d5cabe,
                inset -3px -3px 6px #ffffff;
    width: 100%;
}

.neu-input:focus {
    outline: none;
    box-shadow: inset 4px 4px 8px #d5cabe,
                inset -4px -4px 8px #ffffff,
                0 0 0 2px rgba(217, 119, 6, 0.4);
}</code></pre>
            </div>
        </div>

        <!-- Tab 3: PHP -->
        <div class="neu-tab-content" id="tab-php">
            <div class="code-container">
                <button type="button" class="btn-copy-code"><i class="bi bi-clipboard"></i> Salin</button>
                <pre><code>&lt;?php
session_start();
require_once 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // 1. Cari user di database berdasarkan username
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? LIMIT 1");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    // 2. Verifikasi kecocokan password menggunakan password_verify()
    if ($user && password_verify($password, $user['password'])) {
        // 3. Buat Session
        $_SESSION['user'] = [
            'id'       => $user['id'],
            'name'     => $user['name'],
            'username' => $user['username'],
            'role'     => $user['role']
        ];

        // 4. Redirect sesuai role
        if ($user['role'] === 'admin') {
            header("Location: admin/dashboard.php");
        } else {
            header("Location: customer/dashboard.php");
        }
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?&gt;</code></pre>
            </div>
        </div>

        <!-- Tab 4: Explanation -->
        <div class="neu-tab-content" id="tab-explanation">
            <div class="neu-card-sm p-4 bg-white">
                <h6 class="fw-bold mb-3">Penjelasan Anatomi Logika:</h6>
                <ul class="text-muted small mb-0">
                    <li class="mb-2"><code>session_start()</code>: Wajib diletakkan di baris paling awal sebelum output apapun agar PHP dapat membaca dan menulis variabel <code>$_SESSION</code>.</li>
                    <li class="mb-2"><code>SELECT * FROM users WHERE username = ?</code>: Mencari akun hanya berdasarkan username terlebih dahulu dengan Prepared Statement aman.</li>
                    <li class="mb-2"><code>password_verify($password, $user['password'])</code>: Fungsi bawaan PHP yang membandingkan password mentah input user dengan string hash terenkripsi di database. Mengembalikan <code>true</code> jika cocok.</li>
                    <li><code>header("Location: ...")</code>: Mengarahkan browser ke halaman tujuan setelah berhasil login, lalu disusul <code>exit</code> agar skrip di bawahnya berhenti.</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- 5. Trik Hafalan Cepat / Mnemonics -->
    <div class="trick-box my-4">
        <h5 class="fw-bold text-warning mb-2"><i class="bi bi-key-fill me-2"></i>Trik Hafalan Cepat: Rumus "T-S-V-S"</h5>
        <p class="mb-1">Hafalkan 4 langkah sakti login di PHP:</p>
        <ul class="mb-0 fw-semibold text-dark">
            <li><strong>T (Tangkap POST):</strong> Tangkap username & password dari <code>$_POST</code>.</li>
            <li><strong>S (Select User):</strong> Query <code>SELECT</code> mencari user di tabel database.</li>
            <li><strong>V (Verify Password):</strong> Uji hash dengan <code>password_verify()</code>.</li>
            <li><strong>S (Set Session):</strong> Simpan ke <code>$_SESSION['user']</code> dan redirect!</li>
        </ul>
    </div>

    <!-- 6. Jebakan Error Pemula & Solusi -->
    <div class="gotcha-box">
        <h5 class="fw-bold text-danger mb-2"><i class="bi bi-exclamation-triangle-fill me-2"></i>Jebakan Error Pemula:</h5>
        <p class="small mb-1">
            <strong>❌ Masalah:</strong> Muncul pesan error <i>"Warning: Cannot modify header information - headers already sent"</i>.<br>
            <strong>🔍 Penyebab:</strong> Terdapat baris kosong, spasi, atau tag HTML sebelum fungsi <code>header("Location: ...")</code> dipanggil.<br>
            <strong>✅ Solusi:</strong> Jalankan seluruh logika autentikasi dan redirect PHP di bagian paling atas file sebelum tag <code>&lt;!DOCTYPE html&gt;</code> dimulai.
        </p>
    </div>
</div>

<script>
function simulateLogin() {
    const user = document.getElementById('demoUser').value.trim();
    const pass = document.getElementById('demoPass').value.trim();
    const box = document.getElementById('loginFeedback');

    box.classList.remove('d-none', 'bg-success', 'bg-danger', 'text-white');

    if ((user === 'admin' || user === 'customer') && pass === 'password') {
        box.classList.add('bg-success', 'text-white');
        box.innerHTML = `<i class="bi bi-check-circle"></i> Berhasil! password_verify() cocok &rarr; Session diset sebagai <strong>${user.toUpperCase()}</strong>.`;
    } else {
        box.classList.add('bg-danger', 'text-white');
        box.innerHTML = `<i class="bi bi-x-circle"></i> Gagal! Username atau password tidak cocok.`;
    }
}
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
