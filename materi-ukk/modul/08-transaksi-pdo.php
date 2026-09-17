<?php
$modulTitle = 'Langkah 08: Transaksi Atomik Multi-Item PDO';
$modulNumber = 8;
require_once __DIR__ . '/../includes/header.php';
?>

<!-- Header Breadcrumb & Title -->
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <div>
        <span class="neu-badge neu-badge-primary mb-2">
            <i class="bi bi-arrow-left-right me-1 text-neu-accent"></i> Pemrosesan Data Kritis - Tahap 8 dari 12
        </span>
        <h2 class="fw-extrabold mb-1 text-dark">Langkah 08: Pemrosesan Pesanan Multi-Item & Transaksi PDO Atomik</h2>
        <p class="text-muted mb-0">Teknik ACID Transaction (`beginTransaction`, `lastInsertId`, `commit`, `rollBack`) untuk menjamin data pesanan tidak pernah korup.</p>
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
                <strong>1. Lokasi Berkas (Root File):</strong><br>
                📁 <code>c:\xampp\htdocs\ukk2027\customer\order.php</code> (Blok PHP Atas)
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-2 neu-inset bg-white rounded-3 h-100">
                <strong>2. Tindakan Nyata Siswa:</strong><br>
                Tulis blok <code>if ($_SERVER['REQUEST_METHOD'] === 'POST')</code> yang membungkus <code>$pdo->beginTransaction()</code> dan perulangan simpan detail.
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-2 neu-inset bg-white rounded-3 h-100">
                <strong>3. Cara Menguji di Browser:</strong><br>
                Kirim pesanan dari form, lalu buka tabel <code>orders</code> dan <code>order_details</code> di phpMyAdmin. Pastikan kedua tabel terisi serentak!
            </div>
        </div>
    </div>
</div>

<!-- 1. Konsep & Analogi Guru Besar (ELI5) -->
<div class="row g-4 mb-4">
    <div class="col-lg-7">
        <div class="neu-card p-4 h-100">
            <h5 class="fw-bold text-neu-primary mb-3">
                <i class="bi bi-mortarboard-fill me-2 text-neu-accent"></i> Penjelasan Guru Besar: Mengapa Wajib Transaksi Atomik?
            </h5>
            <p class="text-muted">
                Penyimpanan pesanan melibatkan <strong>2 tabel berbeda</strong> yang saling bergantung: tabel header <code>orders</code> dan tabel detail <code>order_details</code>.
            </p>
            <ul class="text-muted small ps-3 mb-0">
                <li class="mb-2"><strong>Bahaya Tanpa Transaction:</strong> Jika server mendadak mati / error saat baru menyimpan header <code>orders</code> tetapi belum sempat menyimpan detail makanan di <code>order_details</code>, database akan berisi struk hantu (uang tercatat tapi tidak ada daftar makanannya!).</li>
                <li class="mb-2"><strong>`$pdo->beginTransaction()`:</strong> Membuka sesi transaksi aman (*stage sandbox*).</li>
                <li class="mb-2"><strong>`$pdo->commit()`:</strong> Mengunci dan menulis permanen seluruh data jika semua tahapan sukses 100%.</li>
                <li class="mb-0"><strong>`$pdo->rollBack()`:</strong> Membatalkan total seluruh perubahan jika ada 1 saja query yang gagal, sehingga database kembali bersih seperti semula.</li>
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
                    <strong>PDO Transaction</strong> ibarat <strong>Transfer Uang di Mesin ATM</strong>:
                </p>
                <p class="mb-0 small">
                    Proses transfer memiliki 2 langkah: (1) Saldo pengirim dipotong, (2) Saldo penerima ditambah. Jika saat langkah ke-2 listrik ATM mati, sistem otomatis melakukan <strong>Rollback</strong> (mengembalikan saldo pengirim) agar uang tidak hilang di antah berantah!
                </p>
            </div>
        </div>
    </div>
</div>

<!-- 2. Pojok Dosen Senior: Kamus & Bedah Istilah Sulit -->
<div class="neu-card p-4 mb-4">
    <h5 class="fw-bold text-neu-primary mb-3">
        <i class="bi bi-book-half text-neu-accent me-2"></i> Kamus Istilah Programmer Senior: Bedah Kata Sulit Transaksi ACID
    </h5>
    
    <div class="row g-3">
        <div class="col-md-6">
            <div class="p-3 neu-inset bg-white rounded-3 h-100">
                <h6 class="fw-bold text-danger mb-1"><i class="bi bi-key-fill me-1"></i> Apa itu `$pdo->lastInsertId()`?</h6>
                <p class="small text-muted mb-0">
                    Fungsi ajaib untuk mengambil angka ID Auto-Increment yang baru saja diciptakan oleh perintah <code>INSERT INTO orders</code> sebelumnya. Nilai ID inilah yang menjadi nomor jembatan (*Foreign Key*) untuk disimpan ke kolom <code>order_id</code> di tabel <code>order_details</code>.
                </p>
            </div>
        </div>

        <div class="col-md-6">
            <div class="p-3 neu-inset bg-white rounded-3 h-100">
                <h6 class="fw-bold text-primary mb-1"><i class="bi bi-arrow-counterclockwise me-1"></i> Apa itu `$pdo->inTransaction()`?</h6>
                <p class="small text-muted mb-0">
                    Mengecek apakah saat ini ada transaksi aktif yang sedang berjalan sebelum menjalankan <code>rollBack()</code> di blok <code>catch</code>. Ini mencegah timbulnya error <em>There is no active transaction</em> jika kegagalan terjadi sebelum <code>beginTransaction()</code> dieksekusi.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- 3. Live Interactive Simulator -->
<div class="neu-card p-4 mb-4">
    <h5 class="fw-bold text-neu-primary mb-3">
        <i class="bi bi-play-circle-fill me-2 text-neu-accent"></i> Interactive Sandbox: Simulasi Alur Transaksi Atomik (Sukses vs Rollback)
    </h5>

    <div class="row g-3 mb-3">
        <div class="col-md-6">
            <button type="button" class="neu-btn neu-btn-primary w-100 py-3" onclick="runSimTransaction(true)">
                <i class="bi bi-check-all me-1"></i> Uji Skenario 1: Transaksi Normal (Semua Query Sukses $\rightarrow$ Commit)
            </button>
        </div>
        <div class="col-md-6">
            <button type="button" class="neu-btn w-100 py-3 text-danger border-danger" onclick="runSimTransaction(false)">
                <i class="bi bi-lightning-charge-fill me-1"></i> Uji Skenario 2: Simulasi Kegagalan Server $\rightarrow$ Rollback
            </button>
        </div>
    </div>

    <!-- Terminal Log Output -->
    <div class="p-3 rounded-3 font-monospace small" style="background: #201611; color: #fdf8f4; min-height: 140px;" id="simTxLog">
        [Menunggu pengujian transaksi...] Klik salah satu tombol di atas untuk melihat proses log server.
    </div>
</div>

<!-- 4. Source Code Tabs -->
<div class="neu-card p-4 mb-4">
    <h5 class="fw-bold text-neu-primary mb-3">
        <i class="bi bi-code-square me-2 text-neu-accent"></i> Source Code Lengkap Pemrosesan Transaksi Order (`customer/order.php`)
    </h5>

    <div class="code-container">
        <button type="button" class="btn-copy-code"><i class="bi bi-clipboard"></i> Salin Backend Order</button>
        <pre><code>&lt;?php
require_once '../config/database.php';
require_once '../includes/functions.php';
require_once '../includes/auth.php';

require_role('customer');
$currentUser = current_user();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $items = $_POST['items'] ?? [];
    $orderCode = generate_order_code();
    $totalAmount = 0;
    $validItems = [];

    // 1. Validasi keranjang belanja & hitung total
    foreach ($items as $menuId => $itemData) {
        $qty = (int)($itemData['qty'] ?? 0);
        $price = (float)($itemData['price'] ?? 0);

        if ($qty > 0 && $price > 0) {
            $subtotal = $qty * $price;
            $totalAmount += $subtotal;
            $validItems[] = [
                'menu_id'  => (int)$menuId,
                'quantity' => $qty,
                'price'    => $price,
                'subtotal' => $subtotal
            ];
        }
    }

    if (empty($validItems)) {
        die('Error: Anda belum memilih menu apapun!');
    }

    // 2. Memulai Transaksi Database Atomik (ACID)
    try {
        $pdo->beginTransaction();

        // Langkah A: Simpan Header Pesanan ke tabel `orders`
        $stmtOrder = $pdo->prepare("
            INSERT INTO orders (order_code, user_id, total_amount, status) 
            VALUES (:code, :uid, :total, 'pending')
        ");
        $stmtOrder->execute([
            ':code'  => $orderCode,
            ':uid'   => $currentUser['id'],
            ':total' => $totalAmount
        ]);

        // Langkah B: Dapatkan ID auto increment dari order yang baru saja disimpan
        $orderId = $pdo->lastInsertId();

        // Langkah C: Simpan setiap baris detail item ke tabel `order_details`
        $stmtDetail = $pdo->prepare("
            INSERT INTO order_details (order_id, menu_id, quantity, price, subtotal) 
            VALUES (:oid, :mid, :qty, :price, :subtotal)
        ");

        foreach ($validItems as $item) {
            $stmtDetail->execute([
                ':oid'      => $orderId,
                ':mid'      => $item['menu_id'],
                ':qty'      => $item['quantity'],
                ':price'    => $item['price'],
                ':subtotal' => $item['subtotal']
            ]);
        }

        // Langkah D: Kunci dan Simpan Seluruh Data Secara Permanen
        $pdo->commit();

        // Arahkan ke halaman riwayat pesanan dengan pesan sukses
        header('Location: orders.php?msg=order_success');
        exit;

    } catch (Exception $e) {
        // Jika ada kesalahan sedikitpun, batalkan seluruh perubahan!
        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }
        die('Gagal memproses pesanan: ' . $e->getMessage());
    }
}
?&gt;</code></pre>
    </div>
</div>

<!-- 5. Jembatan Keledai & Rumus Hafalan -->
<div class="trick-box">
    <h5 class="fw-bold text-neu-primary mb-2">
        <i class="bi bi-bookmark-star-fill text-warning me-2"></i> Rumus 5 Langkah Transaksi Database PHP (B-H-I-D-C)
    </h5>
    <ul class="small mb-0 ps-3">
        <li><strong>B</strong>egin: <code>$pdo->beginTransaction();</code> (Buka gembok transaksi).</li>
        <li><strong>H</strong>eader: Simpan data ke tabel <code>orders</code>.</li>
        <li><strong>I</strong>D Ambil: <code>$orderId = $pdo->lastInsertId();</code>.</li>
        <li><strong>D</strong>etail: Loop <code>foreach</code> simpan ke <code>order_details</code>.</li>
        <li><strong>C</strong>ommit: <code>$pdo->commit();</code> (Kunci permanen jika sukses) / <code>$pdo->rollBack();</code> jika error!</li>
    </ul>
</div>

<script>
function runSimTransaction(isSuccess) {
    const log = document.getElementById('simTxLog');
    log.innerHTML = '>> [1/5] $pdo->beginTransaction() [MEMULAI TRANSAKSI...]<br>';

    setTimeout(() => {
        log.innerHTML += '>> [2/5] INSERT INTO orders (Header: ORD-20260917-AB12) &rarr; <span class="text-success">BERHASIL</span> (ID Pesanan: #101)<br>';
        
        setTimeout(() => {
            log.innerHTML += '>> [3/5] $orderId = $pdo->lastInsertId() &rarr; Mendapatkan ID #101<br>';
            
            setTimeout(() => {
                if (isSuccess) {
                    log.innerHTML += '>> [4/5] Loop INSERT INTO order_details (2 item menu) &rarr; <span class="text-success">SEMUA BERHASIL</span><br>';
                    setTimeout(() => {
                        log.innerHTML += '>> [5/5] <strong class="text-warning">$pdo->commit()</strong> &rarr; <span class="badge bg-success text-white">TRANSAKSI DIKUNCI PERMANEN!</span>';
                    }, 500);
                } else {
                    log.innerHTML += '>> [4/5] Loop INSERT INTO order_details &rarr; <strong class="text-danger">SIMULASI ERROR: Koneksi Putus di tengah jalan!</strong><br>';
                    setTimeout(() => {
                        log.innerHTML += '>> [5/5] <strong class="text-danger">$pdo->rollBack()</strong> &rarr; <span class="badge bg-danger text-white">SEMUA DATA DIBATALKAN & DATABASE KEMBALI BERSIH!</span>';
                    }, 500);
                }
            }, 600);
        }, 500);
    }, 500);
}
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
