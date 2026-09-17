<?php
$modulTitle = 'Modul 02: Card & Katalog Menu (Card & Grid)';
$modulNumber = 2;
require_once __DIR__ . '/../includes/header.php';
?>

<div class="neu-card p-4 p-md-5 mb-4">
    <!-- Header Modul -->
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        <span class="neu-badge neu-badge-primary">
            <i class="bi bi-card-image"></i> Modul 02 - Layout & Looping Data
        </span>
        <span class="text-muted small">Target: Menguasai Card Responsif, Grid System, & Perulangan Foreach PHP</span>
    </div>

    <h2 class="fw-extrabold mb-3 text-dark">Card Neumorphic & Katalog Menu (Card & PHP Loop)</h2>
    <p class="lead text-muted mb-4">
        Card adalah wadah modular untuk menampilkan entitas data produk (seperti menu cafe) yang memuat foto, nama, deskripsi, harga, dan tombol aksi.
    </p>

    <!-- 1. Konsep Inti 5 Detik -->
    <div class="neu-card-sm p-4 mb-4 bg-white">
        <h5 class="fw-bold mb-2 text-dark"><i class="bi bi-bullseye text-primary me-2"></i>Konsep 5 Detik:</h5>
        <p class="mb-0 text-muted">
            Kita membuat <strong>1 buah pola template Card HTML</strong>, lalu kita masukkan ke dalam perulangan <code>foreach ($menus as $m)</code> di PHP. Berapapun jumlah data di database, PHP akan secara otomatis menggandakan card tersebut sebanyak data yang ada.
        </p>
    </div>

    <!-- 2. Analogi Dunia Nyata (ELI5) -->
    <div class="analogy-box mb-4">
        <h5 class="fw-bold text-primary mb-2"><i class="bi bi-lightbulb-fill me-2"></i>Analogi Dunia Nyata: "Buku Menu Cafe di Meja"</h5>
        <p class="mb-0">
            Bayangkan sebuah <strong>Buku Menu Fisik</strong>. Setiap makanan memiliki kotak fotonya sendiri, nama masakan, harga, dan porsi. Sebagai koki, Anda tidak perlu menggambar buku menu baru setiap kali ada pesanan; Anda hanya memiliki 1 cetakan format kotak, lalu mengisinya dengan data hidangan yang berbeda-beda.
        </p>
    </div>

    <!-- 3. Live Interactive Playground -->
    <h5 class="fw-bold mb-3 text-dark"><i class="bi bi-play-circle text-primary me-2"></i>Live Interactive Playground:</h5>
    <div class="demo-stage mb-4">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <!-- Neumorphic Card Demo -->
                <div class="neu-card p-3 d-flex flex-column h-100" id="demoLiveCard">
                    <div class="neu-inset p-3 text-center mb-3" style="height: 140px; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-cup-hot-fill text-primary" style="font-size: 3.5rem;"></i>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="neu-badge neu-badge-primary small">Minuman</span>
                        <span class="fw-bold text-success fs-6" id="cardPriceDisplay">Rp 18.000</span>
                    </div>
                    <h5 class="fw-bold mb-1 text-dark" id="cardTitleDisplay">Kopi Susu Gula Aren</h5>
                    <p class="text-muted small flex-grow-1 mb-3" id="cardDescDisplay">
                        Espresso arabika dipadu susu segar creamy dan sirup aren alami.
                    </p>
                    <button type="button" class="neu-btn neu-btn-primary w-100 justify-content-center" onclick="alert('Menu berhasil dipilih!')">
                        <i class="bi bi-plus-lg me-1"></i> Pesan Menu
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- 4. Interactive Code Tabs -->
    <div class="neu-tabs-container">
        <div class="neu-tabs">
            <button type="button" class="neu-tab-btn active" data-tab="html">1. Template HTML Card</button>
            <button type="button" class="neu-tab-btn" data-tab="css">2. CSS Soft UI Card</button>
            <button type="button" class="neu-tab-btn" data-tab="php">3. PHP & MySQL Foreach Loop</button>
            <button type="button" class="neu-tab-btn" data-tab="explanation">4. Bedah Baris per Baris</button>
        </div>

        <!-- Tab 1: HTML -->
        <div class="neu-tab-content active" id="tab-html">
            <div class="code-container">
                <button type="button" class="btn-copy-code"><i class="bi bi-clipboard"></i> Salin</button>
                <pre><code>&lt;!-- Grid Container Bootstrap --&gt;
&lt;div class="row g-4"&gt;
    &lt;div class="col-md-6 col-lg-4"&gt;
        &lt;!-- Wadah Card Neumorphic --&gt;
        &lt;div class="neu-card p-3 h-100 d-flex flex-column"&gt;
            &lt;img src="assets/img/kopi.svg" alt="Menu" class="img-fluid mb-3 rounded"&gt;
            &lt;span class="neu-badge neu-badge-primary mb-2"&gt;Minuman&lt;/span&gt;
            &lt;h5 class="fw-bold text-dark"&gt;Kopi Susu Aren&lt;/h5&gt;
            &lt;p class="text-muted small flex-grow-1"&gt;Deskripsi menu...&lt;/p&gt;
            &lt;div class="d-flex justify-content-between align-items-center mt-3"&gt;
                &lt;span class="fw-bold text-success"&gt;Rp 18.000&lt;/span&gt;
                &lt;a href="order.php?select=1" class="neu-btn neu-btn-sm neu-btn-primary"&gt;Pesan&lt;/a&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;
&lt;/div&gt;</code></pre>
            </div>
        </div>

        <!-- Tab 2: CSS -->
        <div class="neu-tab-content" id="tab-css">
            <div class="code-container">
                <button type="button" class="btn-copy-code"><i class="bi bi-clipboard"></i> Salin</button>
                <pre><code>.neu-card {
    background: #f4eee5;
    border-radius: 16px;
    box-shadow: 8px 8px 18px #d5cabe,
               -8px -8px 18px #ffffff;
    border: 1px solid rgba(255, 255, 255, 0.7);
    transition: transform 0.25s ease, box-shadow 0.25s ease;
}

/* Efek Hover Naik Sedikit */
.neu-card:hover {
    transform: translateY(-4px);
    box-shadow: 10px 10px 22px #d5cabe,
               -10px -10px 22px #ffffff;
}</code></pre>
            </div>
        </div>

        <!-- Tab 3: PHP -->
        <div class="neu-tab-content" id="tab-php">
            <div class="code-container">
                <button type="button" class="btn-copy-code"><i class="bi bi-clipboard"></i> Salin</button>
                <pre><code>&lt;?php
// 1. Ambil seluruh data menu dari database MySQL
$stmt = $pdo->prepare("SELECT * FROM menus WHERE status = 'available' ORDER BY id ASC");
$stmt->execute();
$menus = $stmt->fetchAll();
?&gt;

&lt;!-- 2. Looping data array ke dalam Card HTML --&gt;
&lt;div class="row g-4"&gt;
    &lt;?php foreach ($menus as $m): ?&gt;
        &lt;div class="col-md-6 col-lg-4"&gt;
            &lt;div class="neu-card p-3 h-100 d-flex flex-column"&gt;
                &lt;h5 class="fw-bold text-dark"&gt;&lt;?= htmlspecialchars($m['name']) ?&gt;&lt;/h5&gt;
                &lt;span class="fw-bold text-success"&gt;&lt;?= format_rupiah($m['price']) ?&gt;&lt;/span&gt;
                &lt;a href="order.php?select=&lt;?= $m['id'] ?&gt;" class="neu-btn neu-btn-primary mt-3"&gt;Pesan&lt;/a&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;?php endforeach; ?&gt;
&lt;/div&gt;</code></pre>
            </div>
        </div>

        <!-- Tab 4: Explanation -->
        <div class="neu-tab-content" id="tab-explanation">
            <div class="neu-card-sm p-4 bg-white">
                <h6 class="fw-bold mb-3">Penjelasan Anatomi Logika:</h6>
                <ul class="text-muted small mb-0">
                    <li class="mb-2"><code>col-md-6 col-lg-4</code>: Bootstrap grid responsif. Menampilkan 1 kolom di HP, 2 kolom di tablet (md), dan 3 kolom di desktop (lg).</li>
                    <li class="mb-2"><code>$stmt->fetchAll()</code>: Mengambil semua baris data dari tabel <code>menus</code> menjadi kumpulan array di PHP.</li>
                    <li class="mb-2"><code>foreach ($menus as $m):</code>: Perulangan otomatis. Variabel <code>$m</code> mewakili 1 baris data menu saat ini.</li>
                    <li><code>htmlspecialchars($m['name'])</code>: Mengamankan output teks dari database agar terhindar dari script berbahaya (XSS).</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- 5. Trik Hafalan Cepat / Mnemonics -->
    <div class="trick-box my-4">
        <h5 class="fw-bold text-warning mb-2"><i class="bi bi-key-fill me-2"></i>Trik Hafalan Cepat: Rumus "W-I-P-P"</h5>
        <p class="mb-1">Susunan 4 elemen anatomi Card produk yang sempurna:</p>
        <ul class="mb-0 fw-semibold text-dark">
            <li><strong>W (Wrapper):</strong> Wadah <code>&lt;div class="neu-card"&gt;</code> dengan class <code>h-100 d-flex flex-column</code> agar tinggi card selalu rata.</li>
            <li><strong>I (Image/Icon):</strong> Gambar atau ilustrasi menu di bagian paling atas.</li>
            <li><strong>P (Price & Badge):</strong> Kategori dan label harga yang kontras dan jelas.</li>
            <li><strong>P (Pesan Button):</strong> Tombol aksi dengan link dinamis <code>order.php?select=&lt;?= $m['id'] ?&gt;</code>.</li>
        </ul>
    </div>

    <!-- 6. Jebakan Error Pemula & Solusi -->
    <div class="gotcha-box">
        <h5 class="fw-bold text-danger mb-2"><i class="bi bi-exclamation-triangle-fill me-2"></i>Jebakan Error Pemula:</h5>
        <p class="small mb-1">
            <strong>❌ Masalah:</strong> Tinggi kotak card naik-turun dan tidak sejajar rapi jika deskripsi produk beda panjang.<br>
            <strong>✅ Solusi:</strong> Tambahkan utility Bootstrap <code>h-100 d-flex flex-column</code> pada card, dan beri <code>flex-grow-1</code> pada paragraf deskripsi agar tombol pesan otomatis terdorong ke posisi paling bawah.
        </p>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
