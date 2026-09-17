<?php
$modulTitle = 'Langkah 07: Taking Order & Kalkulasi Live JavaScript';
$modulNumber = 7;
require_once __DIR__ . '/../includes/header.php';
?>

<!-- Header Breadcrumb & Title -->
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <div>
        <span class="neu-badge neu-badge-primary mb-2">
            <i class="bi bi-calculator-fill me-1 text-neu-accent"></i> Interaktivitas Pemesanan - Tahap 7 dari 12
        </span>
        <h2 class="fw-extrabold mb-1 text-dark">Langkah 07: Form Taking Order & Kalkulasi Real-Time JavaScript</h2>
        <p class="text-muted mb-0">Membuat formulir pemesanan multi-menu, tombol kuantitas (+/-), dan perhitungan Subtotal serta Total secara instan tanpa reload.</p>
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
                📁 <code>c:\xampp\htdocs\ukk2027\customer\order.php</code>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-2 neu-inset bg-white rounded-3 h-100">
                <strong>2. Tindakan Nyata Siswa:</strong><br>
                Buka folder <code>customer/</code>, buat file <code>order.php</code>, lalu padukan tag HTML Form dan script JavaScript di bagian bawah file.
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-2 neu-inset bg-white rounded-3 h-100">
                <strong>3. Cara Menguji di Browser:</strong><br>
                Login sebagai <code>budi</code>, lalu buka <code>http://localhost/ukk2027/customer/order.php</code>. Tekan tombol (+) dan perhatikan total nominal langsung berubah otomatis.
            </div>
        </div>
    </div>
</div>

<!-- 1. Konsep & Analogi Guru Besar (ELI5) -->
<div class="row g-4 mb-4">
    <div class="col-lg-7">
        <div class="neu-card p-4 h-100">
            <h5 class="fw-bold text-neu-primary mb-3">
                <i class="bi bi-mortarboard-fill me-2 text-neu-accent"></i> Penjelasan Guru Besar: Bagaimana JS Menghitung Tanpa Reload?
            </h5>
            <p class="text-muted">
                Untuk memberikan pengalaman pengguna yang responsif (*instant feedback*), perhitungan total harga dilakukan langsung di peramban (browser) oleh **JavaScript**:
            </p>
            <ul class="text-muted small ps-3 mb-0">
                <li class="mb-2"><strong>Atribut Data HTML5:</strong> Setiap input kuantitas menyimpan harga satuan di atribut <code>data-price="22000"</code>.</li>
                <li class="mb-2"><strong>Event Listener (`input` & `change`):</strong> Setiap kali tombol plus (+) atau minus (-) diklik, JavaScript mengalikan <code>Qty &times; Harga Satuan</code> untuk mendapatkan <strong>Subtotal</strong>.</li>
                <li class="mb-0"><strong>Validasi Sebelum Submit:</strong> Mencegah tombol "Kirim Pesanan" diklik jika pelanggan belum memilih item sama sekali (Total Qty = 0).</li>
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
                    <strong>Formulir Taking Order</strong> ibarat <strong>Kalkulator Kasir Portabel di Tangan Pelayan</strong>:
                </p>
                <p class="mb-0 small">
                    Saat tamu menyebutkan "2 Kopi dan 1 Roti", pelayan langsung menekan tombol di kalkulatornya dan nominal totalnya langsung muncul seketika di layar sebelum bon dicetak ke dapur.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- 2. Pojok Dosen Senior: Kamus & Bedah Istilah Sulit -->
<div class="neu-card p-4 mb-4">
    <h5 class="fw-bold text-neu-primary mb-3">
        <i class="bi bi-book-half text-neu-accent me-2"></i> Kamus Istilah Programmer Senior: Bedah Kata Sulit Interaktif
    </h5>
    
    <div class="row g-3">
        <div class="col-md-6">
            <div class="p-3 neu-inset bg-white rounded-3 h-100">
                <h6 class="fw-bold text-primary mb-1"><i class="bi bi-tag-fill me-1"></i> Apa itu `dataset.price` / `data-price`?</h6>
                <p class="small text-muted mb-0">
                    Atribut <code>data-*</code> adalah fitur resmi HTML5 untuk menempelkan data khusus ke dalam elemen HTML tanpa merusak tampilan. JavaScript dapat membacanya dengan sangat mudah melalui <code>element.getAttribute('data-price')</code> atau <code>element.dataset.price</code>.
                </p>
            </div>
        </div>

        <div class="col-md-6">
            <div class="p-3 neu-inset bg-white rounded-3 h-100">
                <h6 class="fw-bold text-success mb-1"><i class="bi bi-cash-stack me-1"></i> Apa itu `toLocaleString('id-ID')`?</h6>
                <p class="small text-muted mb-0">
                    Fungsi bawaan JavaScript untuk memformat angka desimal ke standar pemisah ribuan lokal Indonesia (titik sebagai pemisah ribuan, misal <code>50000</code> menjadi <code>50.000</code>) tanpa butuh plugin pihak ketiga!
                </p>
            </div>
        </div>
    </div>
</div>

<!-- 3. Live Interactive Simulator -->
<div class="neu-card p-4 mb-4">
    <h5 class="fw-bold text-neu-primary mb-3">
        <i class="bi bi-play-circle-fill me-2 text-neu-accent"></i> Interactive Sandbox: Simulator Pemesanan Taking Order Real-Time
    </h5>

    <div class="row g-4">
        <!-- List Menu & Selector Qty Sisi Kiri -->
        <div class="col-md-7">
            <div class="neu-card-sm p-3 bg-white">
                <h6 class="fw-bold text-neu-primary mb-3"><i class="bi bi-list-stars me-1"></i> Pilih Jumlah Menu</h6>
                
                <!-- Item 1 -->
                <div class="d-flex justify-content-between align-items-center p-2 border-bottom">
                    <div>
                        <div class="fw-bold">Espresso Single</div>
                        <div class="text-muted small">Rp 15.000 / porsi</div>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <button type="button" class="neu-btn neu-btn-sm p-1 px-2" onclick="changeQty(1, -1)">-</button>
                        <input type="number" id="qty_1" class="neu-input text-center fw-bold order-qty-input" data-price="15000" value="0" min="0" style="width: 55px; padding: 6px;" onchange="recalculate()">
                        <button type="button" class="neu-btn neu-btn-sm p-1 px-2" onclick="changeQty(1, 1)">+</button>
                    </div>
                </div>

                <!-- Item 2 -->
                <div class="d-flex justify-content-between align-items-center p-2 border-bottom">
                    <div>
                        <div class="fw-bold">Caffe Latte</div>
                        <div class="text-muted small">Rp 22.000 / porsi</div>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <button type="button" class="neu-btn neu-btn-sm p-1 px-2" onclick="changeQty(2, -1)">-</button>
                        <input type="number" id="qty_2" class="neu-input text-center fw-bold order-qty-input" data-price="22000" value="0" min="0" style="width: 55px; padding: 6px;" onchange="recalculate()">
                        <button type="button" class="neu-btn neu-btn-sm p-1 px-2" onclick="changeQty(2, 1)">+</button>
                    </div>
                </div>

                <!-- Item 3 -->
                <div class="d-flex justify-content-between align-items-center p-2">
                    <div>
                        <div class="fw-bold">Croissant Butter</div>
                        <div class="text-muted small">Rp 18.000 / porsi</div>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <button type="button" class="neu-btn neu-btn-sm p-1 px-2" onclick="changeQty(3, -1)">-</button>
                        <input type="number" id="qty_3" class="neu-input text-center fw-bold order-qty-input" data-price="18000" value="0" min="0" style="width: 55px; padding: 6px;" onchange="recalculate()">
                        <button type="button" class="neu-btn neu-btn-sm p-1 px-2" onclick="changeQty(3, 1)">+</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ringkasan Bon Sisi Kanan -->
        <div class="col-md-5">
            <div class="neu-card-sm p-3 bg-white h-100 d-flex flex-column justify-content-between">
                <div>
                    <h6 class="fw-bold text-neu-primary mb-3"><i class="bi bi-receipt me-1"></i> Ringkasan Total Bon</h6>
                    <div class="d-flex justify-content-between small text-muted mb-2">
                        <span>Total Jumlah Item:</span>
                        <strong id="totalQtyDisplay" class="text-dark">0 Item</strong>
                    </div>
                    <div class="d-flex justify-content-between small text-muted mb-3 pb-2 border-bottom">
                        <span>Status Pemesanan:</span>
                        <span class="badge bg-warning text-dark">Draft</span>
                    </div>
                    <div class="p-3 neu-inset rounded-3 text-center mb-3">
                        <small class="text-muted d-block">TOTAL PEMBAYARAN</small>
                        <h3 class="fw-extrabold text-success mb-0" id="grandTotalDisplay">Rp 0</h3>
                    </div>
                </div>
                <button type="button" class="neu-btn neu-btn-primary w-100" id="btnSubmitSim" onclick="simSubmitOrder()" disabled>
                    <i class="bi bi-bag-check-fill me-1"></i> Simpan Pesanan (POST ke PHP)
                </button>
            </div>
        </div>
    </div>
</div>

<!-- 4. Source Code Tabs -->
<div class="neu-card p-4 mb-4">
    <h5 class="fw-bold text-neu-primary mb-3">
        <i class="bi bi-code-square me-2 text-neu-accent"></i> Source Code Lengkap Form & Script JavaScript (`customer/order.php`)
    </h5>

    <div class="neu-tabs mb-3">
        <button class="neu-tab-btn active" data-tab="tab-orderform">1. Formulir HTML Multi-Item</button>
        <button class="neu-tab-btn" data-tab="tab-orderjs">2. Script JavaScript Kalkulasi Live</button>
    </div>

    <!-- Tab 1: Form HTML -->
    <div class="neu-tab-content active" id="tab-orderform">
        <div class="code-container">
            <button type="button" class="btn-copy-code"><i class="bi bi-clipboard"></i> Salin HTML Form</button>
            <pre><code>&lt;!-- Formulir Pemesanan Multi-Item --&gt;
&lt;form action="order.php" method="POST" id="orderForm"&gt;
    &lt;div class="row g-3"&gt;
        &lt;?php foreach ($menus as $m): ?&gt;
        &lt;div class="col-md-6"&gt;
            &lt;div class="card p-3 shadow-sm border-0 d-flex flex-row justify-content-between align-items-center"&gt;
                &lt;div&gt;
                    &lt;h6 class="fw-bold mb-0"&gt;&lt;?php echo htmlspecialchars($m['name']); ?&gt;&lt;/h6&gt;
                    &lt;span class="text-success small fw-bold"&gt;&lt;?php echo format_rupiah($m['price']); ?&gt;&lt;/span&gt;
                &lt;/div&gt;
                &lt;div class="d-flex align-items-center gap-1"&gt;
                    &lt;!-- Input Tersembunyi Harga Menu --&gt;
                    &lt;input type="hidden" name="items[&lt;?php echo $m['id']; ?&gt;][price]" value="&lt;?php echo $m['price']; ?&gt;"&gt;
                    
                    &lt;!-- Input Kuantitas --&gt;
                    &lt;button type="button" class="btn btn-outline-secondary btn-sm btn-minus"&gt;-&lt;/button&gt;
                    &lt;input type="number" name="items[&lt;?php echo $m['id']; ?&gt;][qty]" class="form-control text-center item-qty" 
                           data-price="&lt;?php echo $m['price']; ?&gt;" value="0" min="0" style="width: 60px;"&gt;
                    &lt;button type="button" class="btn btn-outline-secondary btn-sm btn-plus"&gt;+&lt;/button&gt;
                &lt;/div&gt;
            &lt;/div&gt;
        &lt;/div&gt;
        &lt;?php endforeach; ?&gt;
    &lt;/div&gt;
    
    &lt;!-- Kotak Total & Tombol Submit --&gt;
    &lt;div class="mt-4 p-3 bg-white rounded-3 shadow-sm d-flex justify-content-between align-items-center"&gt;
        &lt;div&gt;Total Pembayaran: &lt;strong class="text-success fs-4" id="totalPrice"&gt;Rp 0&lt;/strong&gt;&lt;/div&gt;
        &lt;button type="submit" class="btn btn-warning fw-bold px-4" id="submitBtn" disabled&gt;Kirim Pesanan&lt;/button&gt;
    &lt;/div&gt;
&lt;/form&gt;</code></pre>
        </div>
    </div>

    <!-- Tab 2: JavaScript -->
    <div class="neu-tab-content" id="tab-orderjs">
        <div class="code-container">
            <button type="button" class="btn-copy-code"><i class="bi bi-clipboard"></i> Salin JavaScript</button>
            <pre><code>document.addEventListener('DOMContentLoaded', function() {
    const qtyInputs = document.querySelectorAll('.item-qty');
    const totalDisplay = document.getElementById('totalPrice');
    const submitBtn = document.getElementById('submitBtn');

    function calculateGrandTotal() {
        let total = 0;
        let totalItems = 0;

        qtyInputs.forEach(input => {
            const qty = parseInt(input.value) || 0;
            const price = parseFloat(input.getAttribute('data-price')) || 0;
            if (qty > 0) {
                total += (qty * price);
                totalItems += qty;
            }
        });

        // Format angka ke Rupiah
        totalDisplay.innerText = 'Rp ' + total.toLocaleString('id-ID');
        
        // Aktifkan / Nonaktifkan tombol kirim
        submitBtn.disabled = (totalItems === 0);
    }

    // Pasang Event Listener ke setiap input
    qtyInputs.forEach(input => {
        input.addEventListener('input', calculateGrandTotal);
    });

    // Handler Tombol Plus (+) & Minus (-)
    document.querySelectorAll('.btn-plus').forEach(btn => {
        btn.addEventListener('click', function() {
            const input = this.parentElement.querySelector('.item-qty');
            input.value = (parseInt(input.value) || 0) + 1;
            calculateGrandTotal();
        });
    });

    document.querySelectorAll('.btn-minus').forEach(btn => {
        btn.addEventListener('click', function() {
            const input = this.parentElement.querySelector('.item-qty');
            const current = parseInt(input.value) || 0;
            if (current > 0) {
                input.value = current - 1;
                calculateGrandTotal();
            }
        });
    });
});</code></pre>
        </div>
    </div>
</div>

<!-- 5. Jembatan Keledai & Rumus Hafalan -->
<div class="trick-box">
    <h5 class="fw-bold text-neu-primary mb-2">
        <i class="bi bi-bookmark-star-fill text-warning me-2"></i> Rumus Format Name Input Multi-Dimensi di PHP
    </h5>
    <p class="mb-1 small">
        Agar PHP dapat menerima array multi-item secara rapi di <code>$_POST['items']</code>, gunakan format:
    </p>
    <div class="p-2 neu-inset font-monospace small bg-white">
        name="items[<strong>ID_MENU</strong>][qty]" dan name="items[<strong>ID_MENU</strong>][price]"
    </div>
    <div class="small text-muted mt-1">
        Dengan format ini, di PHP kamu bisa langsung melakukan perulangan: <code>foreach ($_POST['items'] as $menuId => $item)</code>!
    </div>
</div>

<script>
function changeQty(id, delta) {
    const el = document.getElementById('qty_' + id);
    let val = (parseInt(el.value) || 0) + delta;
    if (val < 0) val = 0;
    el.value = val;
    recalculate();
}

function recalculate() {
    const inputs = document.querySelectorAll('.order-qty-input');
    let total = 0;
    let count = 0;

    inputs.forEach(inp => {
        const q = parseInt(inp.value) || 0;
        const p = parseFloat(inp.getAttribute('data-price')) || 0;
        if (q > 0) {
            total += (q * p);
            count += q;
        }
    });

    document.getElementById('totalQtyDisplay').innerText = count + ' Item';
    document.getElementById('grandTotalDisplay').innerText = 'Rp ' + total.toLocaleString('id-ID');
    document.getElementById('btnSubmitSim').disabled = (count === 0);
}

function simSubmitOrder() {
    alert('Simulasi Sukses! Data keranjang siap dikirim ke backend PHP untuk dieksekusi dalam PDO Transaction.');
}
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
