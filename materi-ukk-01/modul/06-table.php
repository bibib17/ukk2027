<?php
$modulTitle = 'Modul 06: Tabel Data & Status Badge (Table & Badges)';
$modulNumber = 6;
require_once __DIR__ . '/../includes/header.php';
?>

<div class="neu-card p-4 p-md-5 mb-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        <span class="neu-badge neu-badge-primary">
            <i class="bi bi-table"></i> Modul 06 - Penyajian Data Tabular
        </span>
        <span class="text-muted small">Target: Menguasai Tabel Responsif, Format Mata Uang, & Badge Status Dinamis</span>
    </div>

    <h2 class="fw-extrabold mb-3 text-dark">Tabel Data & Status Badge (Table & Badges)</h2>
    <p class="lead text-muted mb-4">
        Tabel adalah cara paling efektif dan terstruktur untuk menyajikan daftar transaksi, riwayat pesanan, dan laporan keuangan kepada pengguna.
    </p>

    <!-- 1. Konsep Inti 5 Detik -->
    <div class="neu-card-sm p-4 mb-4 bg-white">
        <h5 class="fw-bold mb-2 text-dark"><i class="bi bi-bullseye text-primary me-2"></i>Konsep 5 Detik:</h5>
        <p class="mb-0 text-muted">
            Data pesanan dari database di-loop ke dalam baris tabel (<code>&lt;tr&gt;&lt;td&gt;...&lt;/td&gt;&lt;/tr&gt;</code>). Nilai angka diformat ke mata uang Rupiah via <code>number_format()</code>, dan status teks diubah menjadi label visual berwarna menggunakan fungsi badge.
        </p>
    </div>

    <!-- 2. Analogi Dunia Nyata -->
    <div class="analogy-box mb-4">
        <h5 class="fw-bold text-primary mb-2"><i class="bi bi-lightbulb-fill me-2"></i>Analogi Dunia Nyata: "Papan Status Jadwal Bandara"</h5>
        <p class="mb-0">
            Di bandara, ada papan layar besar yang memuat baris nomor pesawat, tujuan, jam, dan status. Ketika pesawat sedang bersiap, statusnya <strong>KUNING (Boarding)</strong>. Saat terbang, statusnya <strong>BIRU (Departed)</strong>. Saat sudah mendarat, statusnya <strong>HIJAU (Landed)</strong>. Warna memudahkan penumpang membaca situasi dalam 1 detik.
        </p>
    </div>

    <!-- 3. Live Interactive Playground -->
    <h5 class="fw-bold mb-3 text-dark"><i class="bi bi-play-circle text-primary me-2"></i>Live Interactive Playground:</h5>
    <div class="demo-stage mb-4">
        <div class="neu-card p-3">
            <h6 class="fw-bold mb-3"><i class="bi bi-clock-history text-primary me-2"></i>Simulasi Tabel Riwayat Pesanan</h6>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr class="text-muted small">
                            <th>Kode Order</th>
                            <th>Customer</th>
                            <th>Total Tagihan</th>
                            <th>Status Pesanan</th>
                            <th class="text-end">Ubah Status Cepat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong class="text-primary font-monospace">ORD-20260917-0001</strong></td>
                            <td>Andi Pratama</td>
                            <td class="fw-bold text-success">Rp 44.000</td>
                            <td id="liveBadgeCell">
                                <span class="neu-badge neu-badge-warning" id="liveBadge"><i class="bi bi-hourglass-split"></i> Menunggu</span>
                            </td>
                            <td class="text-end">
                                <div class="btn-group btn-group-sm">
                                    <button class="neu-btn neu-btn-sm" onclick="setLiveStatus('Menunggu', 'warning', 'bi-hourglass-split')">⏳</button>
                                    <button class="neu-btn neu-btn-sm" onclick="setLiveStatus('Diproses', 'primary', 'bi-arrow-repeat')">🔥</button>
                                    <button class="neu-btn neu-btn-sm" onclick="setLiveStatus('Selesai', 'success', 'bi-check-circle-fill')">✅</button>
                                    <button class="neu-btn neu-btn-sm" onclick="setLiveStatus('Dibatalkan', 'danger', 'bi-x-circle-fill')">❌</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- 4. Interactive Code Tabs -->
    <div class="neu-tabs-container">
        <div class="neu-tabs">
            <button type="button" class="neu-tab-btn active" data-tab="html">1. Template Tabel HTML</button>
            <button type="button" class="neu-tab-btn" data-tab="css">2. CSS Soft UI Badge</button>
            <button type="button" class="neu-tab-btn" data-tab="php">3. Helper Format PHP</button>
            <button type="button" class="neu-tab-btn" data-tab="explanation">4. Bedah Baris per Baris</button>
        </div>

        <!-- Tab 1: HTML -->
        <div class="neu-tab-content active" id="tab-html">
            <div class="code-container">
                <button type="button" class="btn-copy-code"><i class="bi bi-clipboard"></i> Salin</button>
                <pre><code>&lt;div class="table-responsive"&gt;
    &lt;table class="table align-middle"&gt;
        &lt;thead&gt;
            &lt;tr&gt;
                &lt;th&gt;Kode Order&lt;/th&gt;
                &lt;th&gt;Pelanggan&lt;/th&gt;
                &lt;th&gt;Total&lt;/th&gt;
                &lt;th&gt;Status&lt;/th&gt;
            &lt;/tr&gt;
        &lt;/thead&gt;
        &lt;tbody&gt;
            &lt;?php foreach ($orders as $o): ?&gt;
                &lt;tr&gt;
                    &lt;td class="font-monospace fw-bold"&gt;&lt;?= htmlspecialchars($o['order_code']) ?&gt;&lt;/td&gt;
                    &lt;td&gt;&lt;?= htmlspecialchars($o['customer_name']) ?&gt;&lt;/td&gt;
                    &lt;td class="fw-bold"&gt;&lt;?= format_rupiah($o['total']) ?&gt;&lt;/td&gt;
                    &lt;td&gt;&lt;?= render_status_badge($o['status']) ?&gt;&lt;/td&gt;
                &lt;/tr&gt;
            &lt;?php endforeach; ?&gt;
        &lt;/tbody&gt;
    &lt;/table&gt;
&lt;/div&gt;</code></pre>
            </div>
        </div>

        <!-- Tab 2: CSS -->
        <div class="neu-tab-content" id="tab-css">
            <div class="code-container">
                <button type="button" class="btn-copy-code"><i class="bi bi-clipboard"></i> Salin</button>
                <pre><code>/* Badge Status Neumorphism (Warm Cafe) */
.neu-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 700;
    box-shadow: 3px 3px 6px #d5cabe,
               -3px -3px 6px #ffffff;
    background: #f4eee5;
    border: 1px solid rgba(255, 255, 255, 0.7);
}

.neu-badge-warning { color: #b45309; background: #fffbeb; }
.neu-badge-primary { color: #5c3d2e; background: #fbf8f4; }
.neu-badge-success { color: #15803d; background: #f0fdf4; }
.neu-badge-danger  { color: #b91c1c; background: #fef2f2; }</code></pre>
            </div>
        </div>

        <!-- Tab 3: PHP -->
        <div class="neu-tab-content" id="tab-php">
            <div class="code-container">
                <button type="button" class="btn-copy-code"><i class="bi bi-clipboard"></i> Salin</button>
                <pre><code>&lt;?php
// 1. Helper Format Rupiah Indonesia
function format_rupiah($angka) {
    return 'Rp ' . number_format((float)$angka, 0, ',', '.');
}

// 2. Helper Render Badge Berwarna Sesuai Status
function render_status_badge($status) {
    switch ($status) {
        case 'Menunggu':
            return '&lt;span class="badge bg-warning text-dark"&gt;⏳ Menunggu&lt;/span&gt;';
        case 'Diproses':
            return '&lt;span class="badge bg-primary text-white"&gt;🔥 Diproses&lt;/span&gt;';
        case 'Selesai':
            return '&lt;span class="badge bg-success text-white"&gt;✅ Selesai&lt;/span&gt;';
        case 'Dibatalkan':
            return '&lt;span class="badge bg-danger text-white"&gt;❌ Dibatalkan&lt;/span&gt;';
        default:
            return '&lt;span class="badge bg-secondary"&gt;' . htmlspecialchars($status) . '&lt;/span&gt;';
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
                    <li class="mb-2"><code>table-responsive</code>: Pembungkus Bootstrap wajib agar jika tabel dibuka di layar smartphone, tabel memiliki scroll horizontal dan tidak merusak layout halaman.</li>
                    <li class="mb-2"><code>number_format($angka, 0, ',', '.')</code>: Mengubah angka murni <code>44000</code> menjadi format standar Indonesia dengan pemisah ribuan titik <code>44.000</code>.</li>
                    <li class="mb-2"><code>switch ($status)</code>: Struktur kontrol percabangan yang bersih dan cepat untuk menentukan warna badge berdasarkan nilai string status.</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- 5. Trik Hafalan Cepat / Mnemonics -->
    <div class="trick-box my-4">
        <h5 class="fw-bold text-warning mb-2"><i class="bi bi-key-fill me-2"></i>Trik Hafalan 4 Warna Status:</h5>
        <ul class="mb-0 fw-semibold text-dark">
            <li><strong>🟡 Kuning (Warning):</strong> Menunggu antrean barista.</li>
            <li><strong>🔵 Biru (Primary):</strong> Sedang dimasak / diproses di dapur.</li>
            <li><strong>🟢 Hijau (Success):</strong> Pesanan selesai & siap disajikan.</li>
            <li><strong>🔴 Merah (Danger):</strong> Pesanan dibatalkan / gagal.</li>
        </ul>
    </div>

    <!-- 6. Jebakan Error Pemula & Solusi -->
    <div class="gotcha-box">
        <h5 class="fw-bold text-danger mb-2"><i class="bi bi-exclamation-triangle-fill me-2"></i>Jebakan Error Pemula:</h5>
        <p class="small mb-1">
            <strong>❌ Masalah:</strong> Tabel terpotong dan keluar dari layar saat diuji di smartphone asesor.<br>
            <strong>✅ Solusi:</strong> Selalu bungkus tag <code>&lt;table&gt;</code> di dalam elemen <code>&lt;div class="table-responsive"&gt;</code>.
        </p>
    </div>
</div>

<script>
function setLiveStatus(status, type, icon) {
    const badge = document.getElementById('liveBadge');
    badge.className = `neu-badge neu-badge-${type}`;
    badge.innerHTML = `<i class="bi ${icon}"></i> ${status}`;
}
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
