<?php
$modulTitle = 'Modul 05: Taking Order & Kalkulasi Dinamis (Order & Calc)';
$modulNumber = 5;
require_once __DIR__ . '/../includes/header.php';
?>

<div class="neu-card p-4 p-md-5 mb-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        <span class="neu-badge neu-badge-primary">
            <i class="bi bi-calculator"></i> Modul 05 - Fitur Utama Taking Order
        </span>
        <span class="text-muted small">Target: Menguasai Input Quantity, Kalkulasi JavaScript, & Processing Array PHP</span>
    </div>

    <h2 class="fw-extrabold mb-3 text-dark">Formulir Taking Order & Kalkulasi Dinamis (Taking Order & JS Calc)</h2>
    <p class="lead text-muted mb-4">
        Taking Order adalah inti dari sistem cafe: pelanggan menentukan jumlah porsi hidangan, sistem menghitung harga secara langsung, dan mengirim rincian ke dapur.
    </p>

    <!-- 1. Konsep Inti 5 Detik -->
    <div class="neu-card-sm p-4 mb-4 bg-white">
        <h5 class="fw-bold mb-2 text-dark"><i class="bi bi-bullseye text-primary me-2"></i>Konsep 5 Detik:</h5>
        <p class="mb-0 text-muted">
            Di browser (JavaScript), setiap perubahan angka kuantitas memicu rumus <code>Subtotal = Harga &times; Qty</code> dan <code>Grand Total = &sum; Subtotal</code>. Di server (PHP), PHP mengambil array <code>$_POST['quantity']</code> dan menghitung ulang dari database demi keamanan.
        </p>
    </div>

    <!-- 2. Analogi Dunia Nyata -->
    <div class="analogy-box mb-4">
        <h5 class="fw-bold text-primary mb-2"><i class="bi bi-lightbulb-fill me-2"></i>Analogi Dunia Nyata: "Pelayan Menulis Kertas Nota Pesanan"</h5>
        <p class="mb-0">
            Saat Anda memesan di cafe, pelayan mencatat di <strong>Kertas Nota / Bon</strong>: <i>2 piring Nasi Goreng (2 &times; Rp 22.000 = Rp 44.000)</i> dan <i>1 gelas Es Teh (1 &times; Rp 6.000 = Rp 6.000)</i>. Di bagian bawah nota, pelayan menarik garis dan menjumlahkan totalnya menjadi <strong>Rp 50.000</strong> sebelum menyerahkannya ke kasir.
        </p>
    </div>

    <!-- 3. Live Interactive Playground -->
    <h5 class="fw-bold mb-3 text-dark"><i class="bi bi-play-circle text-primary me-2"></i>Live Interactive Playground:</h5>
    <div class="demo-stage mb-4">
        <div class="row g-4">
            <!-- Tabel Item Order -->
            <div class="col-lg-8">
                <div class="neu-card p-3">
                    <h6 class="fw-bold mb-3"><i class="bi bi-basket-fill text-primary me-2"></i>Pilihan Menu Cafe</h6>
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead>
                                <tr class="text-muted small">
                                    <th>Menu</th>
                                    <th>Harga</th>
                                    <th class="text-center" style="width: 140px;">Jumlah</th>
                                    <th class="text-end" style="width: 120px;">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Item 1 -->
                                <tr>
                                    <td><strong>Nasi Goreng</strong></td>
                                    <td>Rp 22.000</td>
                                    <td class="text-center">
                                        <div class="d-flex align-items-center justify-content-center gap-1">
                                            <button class="neu-btn neu-btn-sm p-1" style="width:28px; height:28px;" onclick="changeQty(1, -1)">-</button>
                                            <input type="text" id="qty1" class="neu-input text-center p-1" style="width:40px; height:28px;" value="1" readonly>
                                            <button class="neu-btn neu-btn-sm p-1" style="width:28px; height:28px;" onclick="changeQty(1, 1)">+</button>
                                        </div>
                                    </td>
                                    <td class="text-end fw-bold" id="subtotal1">Rp 22.000</td>
                                </tr>
                                <!-- Item 2 -->
                                <tr>
                                    <td><strong>Es Kopi Susu</strong></td>
                                    <td>Rp 18.000</td>
                                    <td class="text-center">
                                        <div class="d-flex align-items-center justify-content-center gap-1">
                                            <button class="neu-btn neu-btn-sm p-1" style="width:28px; height:28px;" onclick="changeQty(2, -1)">-</button>
                                            <input type="text" id="qty2" class="neu-input text-center p-1" style="width:40px; height:28px;" value="0" readonly>
                                            <button class="neu-btn neu-btn-sm p-1" style="width:28px; height:28px;" onclick="changeQty(2, 1)">+</button>
                                        </div>
                                    </td>
                                    <td class="text-end fw-bold" id="subtotal2">Rp 0</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Ringkasan Order -->
            <div class="col-lg-4">
                <div class="neu-card p-3">
                    <h6 class="fw-bold mb-3"><i class="bi bi-receipt text-primary me-2"></i>Ringkasan Tagihan</h6>
                    <div class="d-flex justify-content-between mb-2 small text-muted">
                        <span>Total Porsi:</span>
                        <strong id="totalQtyDisplay">1 Porsi</strong>
                    </div>
                    <div class="d-flex justify-content-between align-items-center py-2 my-2 border-top border-bottom">
                        <span class="fw-bold">Total Bayar:</span>
                        <span class="fs-5 fw-extrabold text-success" id="grandTotalDisplay">Rp 22.000</span>
                    </div>
                    <button type="button" class="neu-btn neu-btn-primary w-100 mt-2" onclick="alert('Pesanan terkonfirmasi! Data siap diproses transaksi PDO.')">
                        <i class="bi bi-check2"></i> Konfirmasi Pesanan
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- 4. Interactive Code Tabs -->
    <div class="neu-tabs-container">
        <div class="neu-tabs">
            <button type="button" class="neu-tab-btn active" data-tab="html">1. Form Input Quantity</button>
            <button type="button" class="neu-tab-btn" data-tab="js">2. JavaScript Real-time Calc</button>
            <button type="button" class="neu-tab-btn" data-tab="php">3. PHP Processing Loop</button>
            <button type="button" class="neu-tab-btn" data-tab="explanation">4. Bedah Baris per Baris</button>
        </div>

        <!-- Tab 1: HTML -->
        <div class="neu-tab-content active" id="tab-html">
            <div class="code-container">
                <button type="button" class="btn-copy-code"><i class="bi bi-clipboard"></i> Salin</button>
                <pre><code>&lt;form action="order.php" method="POST"&gt;
    &lt;!-- Input quantity menggunakan format array: quantity[ID_MENU] --&gt;
    &lt;tr&gt;
        &lt;td&gt;Nasi Goreng&lt;/td&gt;
        &lt;td&gt;Rp 22.000&lt;/td&gt;
        &lt;td&gt;
            &lt;input type="number" name="quantity[1]" class="item-qty" value="0" min="0" data-price="22000"&gt;
        &lt;/td&gt;
        &lt;td class="item-subtotal"&gt;Rp 0&lt;/td&gt;
    &lt;/tr&gt;

    &lt;div class="grand-total" id="grandTotalDisplay"&gt;Rp 0&lt;/div&gt;
    &lt;button type="submit" class="neu-btn neu-btn-primary"&gt;Kirim Pesanan&lt;/button&gt;
&lt;/form&gt;</code></pre>
            </div>
        </div>

        <!-- Tab 2: JS -->
        <div class="neu-tab-content" id="tab-js">
            <div class="code-container">
                <button type="button" class="btn-copy-code"><i class="bi bi-clipboard"></i> Salin</button>
                <pre><code>// Fungsi JavaScript Menghitung Total Belanja Real-Time
function calculateOrder() {
    let grandTotal = 0;
    const itemRows = document.querySelectorAll('.order-item-row');

    itemRows.forEach(row => {
        const qtyInput = row.querySelector('.item-qty');
        const price = parseFloat(qtyInput.getAttribute('data-price')) || 0;
        const qty = parseInt(qtyInput.value) || 0;
        const subtotal = price * qty;

        // Tampilkan subtotal per item
        row.querySelector('.item-subtotal').textContent = 'Rp ' + subtotal.toLocaleString('id-ID');
        grandTotal += subtotal;
    });

    // Tampilkan total keseluruhan
    document.getElementById('grandTotalDisplay').textContent = 'Rp ' + grandTotal.toLocaleString('id-ID');
}</code></pre>
            </div>
        </div>

        <!-- Tab 3: PHP -->
        <div class="neu-tab-content" id="tab-php">
            <div class="code-container">
                <button type="button" class="btn-copy-code"><i class="bi bi-clipboard"></i> Salin</button>
                <pre><code>&lt;?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $quantities = $_POST['quantity'] ?? [];
    $orderItems = [];
    $grandTotal = 0;

    // Loop semua menu dari database untuk menghitung total resmi
    foreach ($availableMenus as $m) {
        $mId = $m['id'];
        $qty = isset($quantities[$mId]) ? (int)$quantities[$mId] : 0;

        if ($qty > 0) {
            $subtotal = $m['price'] * $qty;
            $grandTotal += $subtotal;
            $orderItems[] = [
                'menu_id'  => $mId,
                'price'    => $m['price'],
                'quantity' => $qty,
                'subtotal' => $subtotal
            ];
        }
    }

    if (!empty($orderItems)) {
        // Lanjutkan simpan pesanan dengan Transaksi PDO...
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
                    <li class="mb-2"><code>name="quantity[ID_MENU]"</code>: Trik cerdas PHP agar seluruh input porsi terkumpul menjadi 1 array asosiatif rapi dengan ID menu sebagai kuncinya (*key*).</li>
                    <li class="mb-2"><code>data-price="22000"</code>: Atribut data HTML5 untuk menyimpan harga satuan agar mudah dibaca oleh JavaScript tanpa perlu query ulang.</li>
                    <li class="mb-2"><code>$qty > 0</code>: Menyaring hanya menu yang benar-benar dipesan oleh pelanggan (kuantitas di atas nol).</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- 5. Trik Hafalan Cepat / Mnemonics -->
    <div class="trick-box my-4">
        <h5 class="fw-bold text-warning mb-2"><i class="bi bi-key-fill me-2"></i>Trik Hafalan Cepat: Rumus "Q-H-S-G"</h5>
        <ul class="mb-0 fw-semibold text-dark">
            <li><strong>Q (Quantity):</strong> Ambil jumlah porsi yang dipilih.</li>
            <li><strong>H (Harga Satuan):</strong> Ambil harga dari database.</li>
            <li><strong>S (Subtotal):</strong> Kalikan <code>$subtotal = $qty * $harga</code>.</li>
            <li><strong>G (Grand Total):</strong> Jumlahkan seluruh subtotal <code>$grandTotal += $subtotal</code>.</li>
        </ul>
    </div>

    <!-- 6. Jebakan Error Pemula & Solusi -->
    <div class="gotcha-box">
        <h5 class="fw-bold text-danger mb-2"><i class="bi bi-exclamation-triangle-fill me-2"></i>Jebakan Error Pemula:</h5>
        <p class="small mb-1">
            <strong>❌ Masalah:</strong> Mempercayai total harga yang dikirim dari browser via <code>$_POST['total']</code>.<br>
            <strong>⚠️ Bahaya:</strong> Pengguna nakal bisa mengubah nilai tagihan menjadi Rp 0 lewat inspect element browser!<br>
            <strong>✅ Solusi:</strong> Selalu hitung ulang subtotal dan grand total di sisi server PHP menggunakan harga resmi dari tabel database.
        </p>
    </div>
</div>

<script>
let p1 = 22000, q1 = 1;
let p2 = 18000, q2 = 0;

function changeQty(item, delta) {
    if (item === 1) {
        q1 = Math.max(0, q1 + delta);
        document.getElementById('qty1').value = q1;
        document.getElementById('subtotal1').textContent = 'Rp ' + (q1 * p1).toLocaleString('id-ID');
    } else {
        q2 = Math.max(0, q2 + delta);
        document.getElementById('qty2').value = q2;
        document.getElementById('subtotal2').textContent = 'Rp ' + (q2 * p2).toLocaleString('id-ID');
    }
    const total = (q1 * p1) + (q2 * p2);
    document.getElementById('totalQtyDisplay').textContent = (q1 + q2) + ' Porsi';
    document.getElementById('grandTotalDisplay').textContent = 'Rp ' + total.toLocaleString('id-ID');
}
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
