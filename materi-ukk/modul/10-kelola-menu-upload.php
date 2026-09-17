<?php
$modulTitle = 'Langkah 10: Kelola Menu Admin & Upload Gambar';
$modulNumber = 10;
require_once __DIR__ . '/../includes/header.php';
?>

<!-- Header Breadcrumb & Title -->
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <div>
        <span class="neu-badge neu-badge-primary mb-2">
            <i class="bi bi-cloud-arrow-up-fill me-1 text-neu-accent"></i> Operasional Admin - Tahap 10 dari 12
        </span>
        <h2 class="fw-extrabold mb-1 text-dark">Langkah 10: Dashboard Admin, CRUD Menu & Upload Gambar Fisik</h2>
        <p class="text-muted mb-0">Membangun modul manajemen menu makanan & minuman dengan validasi upload file `$_FILES`, `move_uploaded_file()`, dan `unlink()`.</p>
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
                📁 <code>c:\xampp\htdocs\ukk2027\admin\menus.php</code><br>
                📁 <code>c:\xampp\htdocs\ukk2027\assets\img\</code> (Folder foto)
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-2 neu-inset bg-white rounded-3 h-100">
                <strong>2. Tindakan Nyata Siswa:</strong><br>
                Pastikan tag <code>&lt;form&gt;</code> memiliki <code>enctype="multipart/form-data"</code> dan folder <code>assets/img</code> sudah dibuat.
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-2 neu-inset bg-white rounded-3 h-100">
                <strong>3. Cara Menguji di Browser:</strong><br>
                Login sebagai <code>admin</code>, buka <code>http://localhost/ukk2027/admin/menus.php</code>, unggah menu dengan gambar, lalu periksa apakah file tersimpan di folder <code>assets/img/</code>.
            </div>
        </div>
    </div>
</div>

<!-- 1. Konsep & Analogi Guru Besar (ELI5) -->
<div class="row g-4 mb-4">
    <div class="col-lg-7">
        <div class="neu-card p-4 h-100">
            <h5 class="fw-bold text-neu-primary mb-3">
                <i class="bi bi-mortarboard-fill me-2 text-neu-accent"></i> Penjelasan Guru Besar: Aturan Upload File di PHP
            </h5>
            <p class="text-muted">
                Mengunggah file ke server memiliki risiko keamanan tinggi jika tidak divalidasi dengan ketat:
            </p>
            <ul class="text-muted small ps-3 mb-0">
                <li class="mb-2"><strong>Wajib Atribut `enctype="multipart/form-data"`:</strong> Tanpa atribut ini pada tag <code>&lt;form&gt;</code>, file gambar tidak akan dikirim ke server dan <code>$_FILES</code> akan kosong!</li>
                <li class="mb-2"><strong>Validasi Ekstensi & MIME Type:</strong> Hanya izinkan format gambar (<code>.jpg</code>, <code>.png</code>, <code>.webp</code>, <code>.svg</code>). Tolak ekstensi berbahaya seperti <code>.php</code> atau <code>.exe</code>.</li>
                <li class="mb-2"><strong>Rename File Unik:</strong> Selalu ganti nama file dengan <code>uniqid('menu_')</code> agar nama file tidak bertabrakan dengan menu lain.</li>
                <li class="mb-0"><strong>Pembersihan File Lama (`unlink`):</strong> Saat foto menu diganti atau menu dihapus, hapus file lama dari folder <code>assets/img/</code> agar disk server tidak penuh sampah.</li>
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
                    <strong>Upload Gambar</strong> ibarat <strong>Menempel Foto di Papan Menu Restoran</strong>:
                </p>
                <p class="mb-0 small">
                    Jika kamu mengganti foto menu lama dengan foto baru, foto lama dicabut dan dibuang ke tempat sampah (<code>unlink</code>), bukan ditumpuk terus-menerus sampai papan roboh!
                </p>
            </div>
        </div>
    </div>
</div>

<!-- 2. Pojok Dosen Senior: Kamus & Bedah Istilah Sulit -->
<div class="neu-card p-4 mb-4">
    <h5 class="fw-bold text-neu-primary mb-3">
        <i class="bi bi-book-half text-neu-accent me-2"></i> Kamus Istilah Programmer Senior: Bedah Kata Sulit File Handling
    </h5>
    
    <div class="row g-3">
        <div class="col-md-6">
            <div class="p-3 neu-inset bg-white rounded-3 h-100">
                <h6 class="fw-bold text-danger mb-1"><i class="bi bi-file-earmark-arrow-up-fill me-1"></i> Apa itu `$_FILES['image']['tmp_name']`?</h6>
                <p class="small text-muted mb-0">
                    Saat file diunggah, web server PHP pertama kali menyimpannya di folder karantina sementara (*temporary folder*) dengan nama acak seperti <code>C:\xampp\tmp\php7A2B.tmp</code>. Tugas kitalah memindahkannya secara permanen ke folder proyek kita menggunakan perintah <code>move_uploaded_file()</code>.
                </p>
            </div>
        </div>

        <div class="col-md-6">
            <div class="p-3 neu-inset bg-white rounded-3 h-100">
                <h6 class="fw-bold text-primary mb-1"><i class="bi bi-trash-fill me-1"></i> Apa itu `unlink($path)`?</h6>
                <p class="small text-muted mb-0">
                    Fungsi resmi PHP untuk menghapus berkas fisik dari harddisk komputer/server. Contoh: <code>if (file_exists($oldFile)) { unlink($oldFile); }</code>. Selalu gunakan pengecekan <code>file_exists()</code> terlebih dahulu agar tidak memicu error warning jika file aslinya memang belum ada.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- 3. Live Interactive Upload Simulator -->
<div class="neu-card p-4 mb-4">
    <h5 class="fw-bold text-neu-primary mb-3">
        <i class="bi bi-play-circle-fill me-2 text-neu-accent"></i> Interactive Sandbox: Simulasi Upload & Preview Gambar Menu Live
    </h5>

    <div class="row g-4 align-items-center">
        <!-- Form Upload Tester -->
        <div class="col-md-6">
            <div class="neu-card-sm p-3 bg-white">
                <h6 class="fw-bold text-neu-primary mb-3"><i class="bi bi-plus-circle me-1"></i> Form Tambah Menu</h6>
                <div class="mb-2">
                    <label class="form-label small fw-bold">Nama Menu</label>
                    <input type="text" id="simMenuName" class="neu-input" value="Caramel Macchiato" oninput="updateSimMenu()">
                </div>
                <div class="mb-2">
                    <label class="form-label small fw-bold">Harga (Rp)</label>
                    <input type="number" id="simMenuPrice" class="neu-input" value="26000" oninput="updateSimMenu()">
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-bold">Pilih Ikon / Gambar Menu</label>
                    <select id="simMenuIcon" class="neu-input" onchange="updateSimMenu()">
                        <option value="bi-cup-hot-fill">Ikon Kopi Hangat</option>
                        <option value="bi-cup-straw">Ikon Es Kopi Segar</option>
                        <option value="bi-egg-fried">Ikon Makanan / Snack</option>
                        <option value="bi-cake2-fill">Ikon Dessert / Kue</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Preview Kartu Menu Sisi Kanan -->
        <div class="col-md-6">
            <div class="neu-card-sm p-3 bg-white text-center">
                <h6 class="fw-bold text-neu-primary mb-2 text-start"><i class="bi bi-eye me-1"></i> Hasil Tampilan Card Menu:</h6>
                <div class="p-4 rounded-3 mb-2" style="background: #f4eee5;">
                    <i id="previewIcon" class="bi bi-cup-hot-fill text-neu-primary" style="font-size: 3.5rem;"></i>
                </div>
                <h5 class="fw-bold mb-1" id="previewTitle">Caramel Macchiato</h5>
                <span class="badge bg-success fw-bold fs-6 mb-2" id="previewPrice">Rp 26.000</span>
                <div class="small text-muted font-monospace">Nama File di Server: <span class="text-primary fw-bold" id="previewFilename">menu_66e8a1b2_caramel.png</span></div>
            </div>
        </div>
    </div>
</div>

<!-- 4. Source Code Tabs -->
<div class="neu-card p-4 mb-4">
    <h5 class="fw-bold text-neu-primary mb-3">
        <i class="bi bi-code-square me-2 text-neu-accent"></i> Source Code Lengkap CRUD Menu & File Upload (`admin/menus.php`)
    </h5>

    <div class="code-container">
        <button type="button" class="btn-copy-code"><i class="bi bi-clipboard"></i> Salin Skrip Upload</button>
        <pre><code>&lt;?php
require_once '../includes/header.php';
require_once '../includes/auth.php';

require_role('admin');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = sanitize($_POST['name'] ?? '');
    $category = sanitize($_POST['category'] ?? 'coffee');
    $price    = (float)($_POST['price'] ?? 0);
    $desc     = sanitize($_POST['description'] ?? '');
    $status   = sanitize($_POST['status'] ?? 'available');
    $imageName = null;

    // 1. Logika Pemrosesan Upload File Gambar
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $fileTmp   = $_FILES['image']['tmp_name'];
        $fileName  = $_FILES['image']['name'];
        $fileSize  = $_FILES['image']['size'];
        $fileExt   = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        $allowedExts = ['jpg', 'jpeg', 'png', 'webp', 'svg'];

        // Validasi ekstensi dan batas ukuran (maksimal 2MB)
        if (in_array($fileExt, $allowedExts) && $fileSize <= 2 * 1024 * 1024) {
            // Buat nama file unik: menu_66e8abc123.jpg
            $imageName = 'menu_' . uniqid() . '.' . $fileExt;
            $uploadPath = __DIR__ . '/../assets/img/' . $imageName;

            move_uploaded_file($fileTmp, $uploadPath);
        }
    }

    // 2. Query INSERT Menu Baru ke Database
    $stmt = $pdo->prepare("
        INSERT INTO menus (name, category, price, description, status, image) 
        VALUES (:n, :c, :p, :d, :s, :img)
    ");
    $stmt->execute([
        ':n'   => $name,
        ':c'   => $category,
        ':p'   => $price,
        ':d'   => $desc,
        ':s'   => $status,
        ':img' => $imageName
    ]);

    header('Location: menus.php?msg=menu_created');
    exit;
}
?&gt;

&lt;!-- Form HTML dengan ENCTYPE Wajib! --&gt;
&lt;form action="menus.php" method="POST" enctype="multipart/form-data"&gt;
    &lt;input type="text" name="name" class="form-control mb-2" placeholder="Nama Menu" required&gt;
    &lt;input type="number" name="price" class="form-control mb-2" placeholder="Harga" required&gt;
    &lt;input type="file" name="image" class="form-control mb-3" accept="image/*"&gt;
    &lt;button type="submit" class="btn btn-primary"&gt;Simpan Menu Baru&lt;/button&gt;
&lt;/form&gt;</code></pre>
    </div>
</div>

<!-- 5. Jembatan Keledai & Rumus Hafalan -->
<div class="trick-box">
    <h5 class="fw-bold text-neu-primary mb-2">
        <i class="bi bi-bookmark-star-fill text-warning me-2"></i> Rumus 3 Syarat Mutlak Upload File di PHP
    </h5>
    <ul class="small mb-0 ps-3">
        <li><strong>1. Method POST:</strong> File tidak bisa dikirim lewat GET.</li>
        <li><strong>2. Enctype:</strong> <code>enctype="multipart/form-data"</code> wajib ada di tag <code>&lt;form&gt;</code>.</li>
        <li><strong>3. Pemindahan Fisik:</strong> <code>move_uploaded_file($_FILES['image']['tmp_name'], $tujuan)</code>.</li>
    </ul>
</div>

<script>
function updateSimMenu() {
    const n = document.getElementById('simMenuName').value || 'Nama Menu';
    const p = parseFloat(document.getElementById('simMenuPrice').value) || 0;
    const ic = document.getElementById('simMenuIcon').value;

    document.getElementById('previewTitle').innerText = n;
    document.getElementById('previewPrice').innerText = 'Rp ' + p.toLocaleString('id-ID');
    document.getElementById('previewIcon').className = 'bi ' + ic + ' text-neu-primary';
    document.getElementById('previewFilename').innerText = 'menu_' + Math.random().toString(36).substring(2, 8) + '.png';
}
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
