<?php
$modulTitle = 'Modul 01: Tombol & Aksi Form (Button & Trigger)';
$modulNumber = 1;
require_once __DIR__ . '/../includes/header.php';
?>

<div class="neu-card p-4 p-md-5 mb-4">
    <!-- Header Modul -->
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        <span class="neu-badge neu-badge-primary">
            <i class="bi bi-hand-index-thumb"></i> Modul 01 - Dasar Interaksi & Event
        </span>
        <span class="text-muted small">Target: Menguasai Button, Event Klik, & Deteksi POST PHP</span>
    </div>

    <h2 class="fw-extrabold mb-3 text-dark">Tombol Interaktif & Aksi Form (Button & PHP Trigger)</h2>
    <p class="lead text-muted mb-4">
        Tombol adalah pintu gerbang utama yang menghubungkan tindakan pengguna di browser dengan eksekusi kode di server PHP.
    </p>

    <!-- 1. Konsep Inti 5 Detik -->
    <div class="neu-card-sm p-4 mb-4 bg-white">
        <h5 class="fw-bold mb-2 text-dark"><i class="bi bi-bullseye text-primary me-2"></i>Konsep 5 Detik:</h5>
        <p class="mb-0 text-muted">
            Di HTML, tombol (<code>&lt;button type="submit"&gt;</code>) bertugas <strong>mengirimkan seluruh data form</strong> ke server. Di PHP, server mendeteksi pengiriman tersebut menggunakan kondisi <code>if ($_SERVER['REQUEST_METHOD'] === 'POST')</code>.
        </p>
    </div>

    <!-- 2. Analogi Dunia Nyata (ELI5) -->
    <div class="analogy-box mb-4">
        <h5 class="fw-bold text-primary mb-2"><i class="bi bi-lightbulb-fill me-2"></i>Analogi Dunia Nyata: "Bel Pintu Rumah"</h5>
        <p class="mb-0">
            Bayangkan tombol web seperti <strong>Bel Pintu Rumah</strong>. Pengunjung di luar rumah (User di Browser) menekan tombol bel. Sinyal listrik langsung mengalir ke dalam rumah dan membunyikan alarm di dapur (Server PHP). Tuan rumah (PHP) mendengar bunyi bel, lalu segera membuka pintu dan memproses kedatangan tamu.
        </p>
    </div>

    <!-- 3. Live Interactive Playground (Neumorphism Demo) -->
    <h5 class="fw-bold mb-3 text-dark"><i class="bi bi-play-circle text-primary me-2"></i>Live Interactive Playground:</h5>
    <div class="demo-stage text-center mb-4">
        <p class="text-muted small mb-3">Klik tombol neumorphic di bawah ini untuk melihat efek cembung-cekung dan simulasi trigger aksi:</p>
        <div class="d-flex flex-wrap justify-content-center gap-3 align-items-center mb-3">
            <button type="button" class="neu-btn" id="demoBtnNormal" onclick="handleBtnClick('Tombol Biasa Cembung')">
                <i class="bi bi-cursor-fill me-1"></i> Tombol Biasa
            </button>
            <button type="button" class="neu-btn neu-btn-primary" id="demoBtnPrimary" onclick="handleBtnClick('Tombol Primer Submit')">
                <i class="bi bi-check-circle-fill me-1"></i> Tombol Submit Primer
            </button>
            <button type="button" class="neu-btn neu-btn-sm text-danger" id="demoBtnDanger" onclick="handleBtnClick('Tombol Aksi Batal')">
                <i class="bi bi-x-circle me-1"></i> Tombol Batal
            </button>
        </div>
        <div class="neu-inset p-3 d-inline-block text-muted small" style="min-width: 320px;" id="demoLogBox">
            Status: Menunggu tombol ditekan...
        </div>
    </div>

    <!-- 4. Interactive Code Tabs -->
    <div class="neu-tabs-container">
        <div class="neu-tabs">
            <button type="button" class="neu-tab-btn active" data-tab="html">1. HTML & Form</button>
            <button type="button" class="neu-tab-btn" data-tab="css">2. CSS Neumorphism</button>
            <button type="button" class="neu-tab-btn" data-tab="php">3. PHP Backend Handler</button>
            <button type="button" class="neu-tab-btn" data-tab="explanation">4. Bedah Baris per Baris</button>
        </div>

        <!-- Tab 1: HTML -->
        <div class="neu-tab-content active" id="tab-html">
            <div class="code-container">
                <button type="button" class="btn-copy-code"><i class="bi bi-clipboard"></i> Salin</button>
                <pre><code>&lt;!-- Form Pemesanan / Aksi --&gt;
&lt;form action="proses.php" method="POST"&gt;
    &lt;!-- Input data --&gt;
    &lt;input type="hidden" name="menu_id" value="1"&gt;
    
    &lt;!-- Tombol Kirim Form --&gt;
    &lt;button type="submit" name="btn_pesan" class="neu-btn neu-btn-primary"&gt;
        &lt;i class="bi bi-bag-plus-fill"&gt;&lt;/i&gt; Pesan Sekarang
    &lt;/button&gt;
&lt;/form&gt;</code></pre>
            </div>
        </div>

        <!-- Tab 2: CSS -->
        <div class="neu-tab-content" id="tab-css">
            <div class="code-container">
                <button type="button" class="btn-copy-code"><i class="bi bi-clipboard"></i> Salin</button>
                <pre><code>/* Efek Neumorphism Cembung Normal (Warm Cafe Theme) */
.neu-btn {
    background: #f4eee5;
    color: #2b1e16;
    border: 1px solid rgba(255, 255, 255, 0.8);
    border-radius: 30px;
    padding: 10px 24px;
    font-weight: 600;
    box-shadow: 6px 6px 12px #d5cabe,
               -6px -6px 12px #ffffff;
    cursor: pointer;
    transition: all 0.2s ease;
}

/* Efek Neumorphism Cekung Saat Ditekan */
.neu-btn:active {
    box-shadow: inset 3px 3px 6px #d5cabe,
                inset -3px -3px 6px #ffffff;
    transform: translateY(1px);
}</code></pre>
            </div>
        </div>

        <!-- Tab 3: PHP -->
        <div class="neu-tab-content" id="tab-php">
            <div class="code-container">
                <button type="button" class="btn-copy-code"><i class="bi bi-clipboard"></i> Salin</button>
                <pre><code>&lt;?php
// Mengecek apakah form dikirim melalui metode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Mengecek apakah tombol 'btn_pesan' diklik
    if (isset($_POST['btn_pesan'])) {
        $menuId = (int)$_POST['menu_id'];
        
        // Lakukan pemrosesan simpan ke database...
        echo "Pesanan untuk Menu ID #{$menuId} berhasil diproses!";
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
                    <li class="mb-2"><code>type="submit"</code>: Memberi tahu browser bahwa tombol ini berfungsi mengeksekusi pengiriman data form ke file yang tertulis di <code>action="..."</code>.</li>
                    <li class="mb-2"><code>method="POST"</code>: Mengirim data di belakang layar (aman dan tidak terlihat di URL browser seperti metode GET).</li>
                    <li class="mb-2"><code>$_SERVER['REQUEST_METHOD'] === 'POST'</code>: Kondisi penjaga di PHP untuk memastikan kode hanya dijalankan jika ada form yang disubmit, bukan saat halaman baru pertama kali dibuka.</li>
                    <li><code>isset($_POST['btn_pesan'])</code>: Memverifikasi secara spesifik tombol mana yang ditekan user jika dalam satu halaman terdapat lebih dari satu tombol.</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- 5. Trik Hafalan Cepat / Mnemonics -->
    <div class="trick-box my-4">
        <h5 class="fw-bold text-warning mb-2"><i class="bi bi-key-fill me-2"></i>Trik Hafalan Cepat: Rumus "T-A-P"</h5>
        <p class="mb-1">Ingat 3 langkah setiap kali membuat tombol form:</p>
        <ul class="mb-0 fw-semibold text-dark">
            <li><strong>T (Type):</strong> Pastikan <code>type="submit"</code> jika untuk mengirim data, atau <code>type="button"</code> jika hanya untuk JavaScript.</li>
            <li><strong>A (Action & Method):</strong> Pastikan tag <code>&lt;form&gt;</code> memiliki <code>action="tujuan.php"</code> dan <code>method="POST"</code>.</li>
            <li><strong>P (PHP Check):</strong> Di PHP selalu tangkap dengan <code>if ($_SERVER['REQUEST_METHOD'] === 'POST')</code>.</li>
        </ul>
    </div>

    <!-- 6. Jebakan Error Pemula & Solusi -->
    <div class="gotcha-box">
        <h5 class="fw-bold text-danger mb-2"><i class="bi bi-exclamation-triangle-fill me-2"></i>Jebakan Error Pemula (Gotchas):</h5>
        <p class="small mb-1">
            <strong>❌ Masalah:</strong> Tombol diklik tetapi halaman refresh dan data di PHP kosong / tidak tersimpan.<br>
            <strong>🔍 Penyebab:</strong> Lupa menyertakan atribut <code>name="..."</code> pada tombol atau input form, atau tombol berada di luar tag <code>&lt;form&gt;</code>.<br>
            <strong>✅ Solusi:</strong> Pastikan tombol dan input berada di antara <code>&lt;form&gt;</code> dan <code>&lt;/form&gt;</code> serta memiliki atribut <code>name</code>.
        </p>
    </div>
</div>

<script>
let clickCount = 0;
function handleBtnClick(btnName) {
    clickCount++;
    const logBox = document.getElementById('demoLogBox');
    logBox.innerHTML = `<strong>${btnName}</strong> ditekan! (Total Klik: ${clickCount}x) &rarr; Sinyal POST dikirim ke Server PHP.`;
    logBox.style.color = '#4f46e5';
}
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
