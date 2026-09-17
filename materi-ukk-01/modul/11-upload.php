<?php
$modulTitle = 'Modul 11: Upload Gambar & CRUD Menu Cafe (File Upload & CRUD)';
$modulNumber = 11;
require_once __DIR__ . '/../includes/header.php';
?>

<div class="neu-card p-4 p-md-5 mb-4">
    <!-- Header Modul -->
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        <span class="neu-badge neu-badge-primary">
            <i class="bi bi-cloud-arrow-up"></i> Modul 11 - Upload File & Pengelolaan Menu
        </span>
        <span class="text-muted small">Target: Menguasai $_FILES, move_uploaded_file(), Validasi Gambar, & Smart Delete</span>
    </div>

    <h2 class="fw-extrabold mb-3 text-dark">Upload Gambar & CRUD Menu Cafe (File Upload & Management)</h2>
    <p class="lead text-muted mb-4">
        Admin cafe membutuhkan kemampuan untuk menambahkan menu baru lengkap dengan foto visual yang menggugah selera, mengubah harga/deskripsi, dan mengatur ketersediaan menu.
    </p>

    <!-- 1. Konsep Inti 5 Detik -->
    <div class="neu-card-sm p-4 mb-4 bg-white">
        <h5 class="fw-bold mb-2 text-dark"><i class="bi bi-bullseye text-primary me-2"></i>Konsep 5 Detik:</h5>
        <p class="mb-0 text-muted">
            Untuk mengunggah gambar, form HTML wajib memiliki atribut <code>enctype="multipart/form-data"</code>. Di PHP, data file ditangkap melalui array <code>$_FILES['image']</code>, divalidasi format ekstensinya, diberi nama acak unik, lalu dipindahkan ke folder penyimpanan menggunakan <code>move_uploaded_file()</code>.
        </p>
    </div>

    <!-- 2. Analogi Dunia Nyata (ELI5) -->
    <div class="analogy-box mb-4">
        <h5 class="fw-bold text-primary mb-2"><i class="bi bi-lightbulb-fill me-2"></i>Analogi Dunia Nyata: "Menempel Foto Menu Baru di Etalase Cafe"</h5>
        <p class="mb-0">
            Bayangkan Anda seorang barista yang menciptakan minuman baru. Anda memotret minuman tersebut, mencetak fotonya, lalu menempelkannya di <strong>Papan Etalase Kasir</strong> lengkap dengan nama dan harga. Jika suatu saat bahan minuman habis, Anda tidak merobek papan etalase, melainkan hanya menempel stiker <strong>"Habis / Sold Out"</strong> agar buku riwayat pembukuan bulan lalu tidak rusak.
        </p>
    </div>

    <!-- 3. Live Interactive Playground -->
    <h5 class="fw-bold mb-3 text-dark"><i class="bi bi-play-circle text-primary me-2"></i>Live Interactive Playground:</h5>
    <div class="demo-stage mb-4">
        <div class="row g-4 justify-content-center">
            <!-- Form Upload Demo -->
            <div class="col-md-6">
                <div class="neu-card p-4">
                    <h6 class="fw-bold mb-3"><i class="bi bi-plus-circle text-primary me-2"></i>Simulasi Tambah Menu</h6>
                    <div class="mb-2">
                        <label class="small text-muted fw-semibold">Nama Menu:</label>
                        <input type="text" id="simMenuName" class="neu-input" value="Caramel Macchiato">
                    </div>
                    <div class="mb-2">
                        <label class="small text-muted fw-semibold">Harga (Rp):</label>
                        <input type="number" id="simMenuPrice" class="neu-input" value="28000">
                    </div>
                    <div class="mb-3">
                        <label class="small text-muted fw-semibold">Pilih File Foto:</label>
                        <input type="file" id="simMenuFile" class="form-control form-control-sm" accept="image/*" onchange="previewSimImage(event)">
                    </div>
                    <button type="button" class="neu-btn neu-btn-primary w-100" onclick="applySimMenu()">
                        <i class="bi bi-cloud-arrow-up-fill me-1"></i> Simulasikan Upload & Tambah
                    </button>
                </div>
            </div>

            <!-- Preview Card Hasil Upload -->
            <div class="col-md-5">
                <div class="neu-card p-3 h-100 d-flex flex-column text-center">
                    <span class="small text-muted mb-2">Live Preview Hasil di Katalog:</span>
                    <div class="neu-inset p-3 mb-3 d-flex align-items-center justify-content-center" style="height: 140px; border-radius: 12px; overflow: hidden;">
                        <img id="simPreviewImg" src="../assets/img/kopi-susu.svg" alt="Preview" style="max-height: 110px;" class="img-fluid">
                    </div>
                    <h5 class="fw-bold text-dark mb-1" id="simCardName">Caramel Macchiato</h5>
                    <span class="fw-bold text-success fs-6 mb-3" id="simCardPrice">Rp 28.000</span>
                    <span class="neu-badge neu-badge-success mx-auto small" id="simCardStatus">
                        <i class="bi bi-check-circle"></i> Status: Tersedia
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- 4. Interactive Code Tabs -->
    <div class="neu-tabs-container">
        <div class="neu-tabs">
            <button type="button" class="neu-tab-btn active" data-tab="html">1. Form HTML Enctype</button>
            <button type="button" class="neu-tab-btn" data-tab="php">2. PHP Upload & Validasi</button>
            <button type="button" class="neu-tab-btn" data-tab="crud">3. Smart Delete Logic</button>
            <button type="button" class="neu-tab-btn" data-tab="explanation">4. Bedah Baris per Baris</button>
        </div>

        <!-- Tab 1: HTML -->
        <div class="neu-tab-content active" id="tab-html">
            <div class="code-container">
                <button type="button" class="btn-copy-code"><i class="bi bi-clipboard"></i> Salin</button>
                <pre><code>&lt;!-- Wajib enctype="multipart/form-data" jika ada input file! --&gt;
&lt;form action="menus.php" method="POST" enctype="multipart/form-data" class="neu-card p-4"&gt;
    &lt;div class="mb-3"&gt;
        &lt;label&gt;Nama Menu&lt;/label&gt;
        &lt;input type="text" name="name" class="neu-input" required&gt;
    &lt;/div&gt;

    &lt;div class="mb-3"&gt;
        &lt;label&gt;Harga (Rp)&lt;/label&gt;
        &lt;input type="number" name="price" class="neu-input" required&gt;
    &lt;/div&gt;

    &lt;div class="mb-3"&gt;
        &lt;label&gt;Foto Menu&lt;/label&gt;
        &lt;input type="file" name="image" class="form-control" accept="image/*"&gt;
    &lt;/div&gt;

    &lt;button type="submit" name="action_add" class="neu-btn neu-btn-primary"&gt;Tambahkan Menu&lt;/button&gt;
&lt;/form&gt;</code></pre>
            </div>
        </div>

        <!-- Tab 2: PHP -->
        <div class="neu-tab-content" id="tab-php">
            <div class="code-container">
                <button type="button" class="btn-copy-code"><i class="bi bi-clipboard"></i> Salin</button>
                <pre><code>&lt;?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name  = trim($_POST['name']);
    $price = (float)$_POST['price'];
    $imageName = 'default-menu.svg'; // Nilai default jika tidak ada gambar

    // 1. Cek apakah ada file yang diunggah tanpa error
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $file     = $_FILES['image'];
        $ext      = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $allowed  = ['jpg', 'jpeg', 'png', 'webp', 'svg'];

        // 2. Validasi Ekstensi Gambar
        if (!in_array($ext, $allowed, true)) {
            die("Error: Format file tidak didukung!");
        }

        // 3. Buat nama file acak unik agar tidak menimpa file lain
        $imageName = 'menu_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
        $target    = __DIR__ . '/../assets/img/' . $imageName;

        // 4. Pindahkan dari temporary folder ke assets/img/
        move_uploaded_file($file['tmp_name'], $target);
    }

    // 5. Simpan nama file gambar ke database MySQL
    $stmt = $pdo->prepare("INSERT INTO menus (name, price, image, status) VALUES (?, ?, ?, 'available')");
    $stmt->execute([$name, $price, $imageName]);
    echo "Menu dan Gambar Berhasil Disimpan!";
}
?&gt;</code></pre>
            </div>
        </div>

        <!-- Tab 3: CRUD Smart Delete -->
        <div class="neu-tab-content" id="tab-crud">
            <div class="code-container">
                <button type="button" class="btn-copy-code"><i class="bi bi-clipboard"></i> Salin</button>
                <pre><code>&lt;?php
// Logika Hapus Menu yang Aman (Smart Delete)
$id = (int)$_GET['id'];

// 1. Periksa apakah menu ini pernah ada di tabel pesanan (order_details)
$stmt = $pdo->prepare("SELECT COUNT(*) FROM order_details WHERE menu_id = ?");
$stmt->execute([$id]);
$isUsed = (int)$stmt->fetchColumn() > 0;

if ($isUsed) {
    // 2. Jika pernah dipesan, ubah status menjadi 'unavailable' (Soft Delete)
    // agar laporan omzet dan riwayat transaksi lama tidak rusak/hilang
    $stmt = $pdo->prepare("UPDATE menus SET status = 'unavailable' WHERE id = ?");
    $stmt->execute([$id]);
} else {
    // 3. Jika benar-benar belum pernah dipesan, boleh hapus permanen
    $stmt = $pdo->prepare("DELETE FROM menus WHERE id = ?");
    $stmt->execute([$id]);
}
?&gt;</code></pre>
            </div>
        </div>

        <!-- Tab 4: Explanation -->
        <div class="neu-tab-content" id="tab-explanation">
            <div class="neu-card-sm p-4 bg-white">
                <h6 class="fw-bold mb-3">Penjelasan Anatomi Logika:</h6>
                <ul class="text-muted small mb-0">
                    <li class="mb-2"><code>enctype="multipart/form-data"</code>: Memberitahu browser agar mengirim file biner (foto) dalam potongan (*parts*) multipart, bukan sebagai teks biasa. Tanpa atribut ini, <code>$_FILES</code> akan selalu kosong!</li>
                    <li class="mb-2"><code>$_FILES['image']['tmp_name']</code>: Lokasi penyimpanan sementara file di server saat pertama kali diterima dari browser.</li>
                    <li class="mb-2"><code>bin2hex(random_bytes(4))</code>: Menghasilkan string acak unik sehingga dua user yang mengunggah foto dengan nama sama (misal: <code>foto.jpg</code>) tidak akan saling menimpa (*overwrite*).</li>
                    <li><code>Smart Delete</code>: Menjaga integritas relasi tabel database (*Foreign Key Integrity*) agar tidak terjadi error SQL saat melihat laporan masa lalu.</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- 5. Trik Hafalan Cepat / Mnemonics -->
    <div class="trick-box my-4">
        <h5 class="fw-bold text-warning mb-2"><i class="bi bi-key-fill me-2"></i>Trik Hafalan Cepat: Rumus "E-V-N-M"</h5>
        <ul class="mb-0 fw-semibold text-dark">
            <li><strong>E (Enctype):</strong> Pasang <code>enctype="multipart/form-data"</code> di form HTML.</li>
            <li><strong>V (Validate):</strong> Validasi ekstensi & ukuran di <code>$_FILES</code>.</li>
            <li><strong>N (Name Unique):</strong> Buat nama acak <code>menu_time_random.ext</code>.</li>
            <li><strong>M (Move):</strong> Pindahkan file dengan <code>move_uploaded_file()</code>.</li>
        </ul>
    </div>

    <!-- 6. Jebakan Error Pemula & Solusi -->
    <div class="gotcha-box">
        <h5 class="fw-bold text-danger mb-2"><i class="bi bi-exclamation-triangle-fill me-2"></i>Jebakan Error Pemula:</h5>
        <p class="small mb-1">
            <strong>❌ Masalah Fatal:</strong> Lupa menulis <code>enctype="multipart/form-data"</code> pada tag <code>&lt;form&gt;</code>.<br>
            <strong>🔍 Gejala:</strong> <code>$_FILES['image']</code> selalu bernilai <code>NULL</code> atau error, dan gambar tidak pernah tersimpan di folder <code>assets/img/</code>.<br>
            <strong>✅ Solusi:</strong> Selalu cek tag pembuka form Anda setiap kali membuat fitur upload file!
        </p>
    </div>
</div>

<script>
function previewSimImage(event) {
    const input = event.target;
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('simPreviewImg').src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function applySimMenu() {
    const name = document.getElementById('simMenuName').value;
    const price = parseInt(document.getElementById('simMenuPrice').value) || 0;
    
    document.getElementById('simCardName').textContent = name;
    document.getElementById('simCardPrice').textContent = 'Rp ' + price.toLocaleString('id-ID');
    alert(`Sukses! Menu "${name}" berhasil ditambahkan dengan gambar baru!`);
}
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
