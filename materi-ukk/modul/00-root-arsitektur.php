<?php
$modulTitle = 'Langkah 00: Peta Folder & Fondasi Root Aplikasi';
$modulNumber = 0;
require_once __DIR__ . '/../includes/header.php';
?>

<!-- Header Breadcrumb & Title -->
<div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
    <div>
        <span class="neu-badge neu-badge-primary mb-2">
            <i class="bi bi-folder-symlink-fill me-1 text-neu-accent"></i> Fondasi Awal - Pengenalan Root Proyek
        </span>
        <h2 class="fw-extrabold mb-1 text-dark">Langkah 00: Peta Struktur Direktori (Root) & Arsitektur Sistem</h2>
        <p class="text-muted mb-0">Memahami struktur folder proyek `c:\xampp\htdocs\ukk2027\`, siklus eksekusi web server Apache, dan peta navigasi seluruh sistem.</p>
    </div>
    <span class="neu-badge neu-badge-success">
        <i class="bi bi-compass-fill me-1"></i> Wajib Dipelajari Pertama
    </span>
</div>

<!-- Petunjuk Rute / Root Praktik Siswa -->
<div class="neu-card p-4 mb-4" style="border-left: 6px solid var(--neu-primary);">
    <h5 class="fw-bold text-neu-primary mb-2">
        <i class="bi bi-signpost-2-fill text-neu-accent me-2"></i> Jalur Persiapan Awal Siswa (Student Preparation Setup)
    </h5>
    <div class="row g-3 small">
        <div class="col-md-4">
            <div class="p-2 neu-inset bg-white rounded-3 h-100">
                <strong>1. Lokasi Folder Induk (Root Directory):</strong><br>
                📁 <code class="text-primary font-monospace">c:\xampp\htdocs\ukk2027\</code>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-2 neu-inset bg-white rounded-3 h-100">
                <strong>2. Langkah Persiapan Server:</strong><br>
                Buka <strong>XAMPP Control Panel</strong>, lalu klik tombol <strong>Start</strong> pada modul <em>Apache</em> dan <em>MySQL</em> (pastikan indikator berubah hijau).
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-2 neu-inset bg-white rounded-3 h-100">
                <strong>3. Alamat Akses di Browser:</strong><br>
                URL Utama: <code class="text-success font-monospace">http://localhost/ukk2027/</code><br>
                URL Modul: <code class="text-warning font-monospace">http://localhost/ukk2027/materi-ukk/</code>
            </div>
        </div>
    </div>
</div>

<!-- 1. Konsep & Analogi Guru Besar (ELI5) -->
<div class="row g-4 mb-4">
    <div class="col-lg-7">
        <div class="neu-card p-4 h-100">
            <h5 class="fw-bold text-neu-primary mb-3">
                <i class="bi bi-mortarboard-fill me-2 text-neu-accent"></i> Penjelasan Guru Besar: Mengapa Struktur Folder Sangat Penting?
            </h5>
            <p class="text-muted">
                Dalam dunia rekayasa perangkat lunak profesional, menyatukan puluhan file PHP dalam satu folder tanpa pengelompokan (*spaghetti structure*) adalah kebiasaan amatir yang mempersulit perawatan aplikasi.
            </p>
            <p class="text-muted small">
                Kita menerapkan prinsip <strong>Separation of Concerns (Pemisahan Tanggung Jawab)</strong>:
            </p>
            <ul class="text-muted small ps-3 mb-0">
                <li class="mb-2"><strong>`config/`</strong>: Tempat berkas konfigurasi rahasia (Koneksi database PDO).</li>
                <li class="mb-2"><strong>`includes/`</strong>: Tempat potongan kode modular bersama (Header, Footer, Helper, dan Role Guard).</li>
                <li class="mb-2"><strong>`assets/`</strong>: Tempat berkas statis (CSS, JavaScript, dan folder gambar `img/`).</li>
                <li class="mb-2"><strong>`auth/`</strong>: Tempat pintu gerbang autentikasi (Login, Register, Logout).</li>
                <li class="mb-2"><strong>`customer/`</strong>: Ruang antarmuka khusus pengguna umum/pelanggan cafe.</li>
                <li class="mb-0"><strong>`admin/`</strong>: Ruang kendali operasional khusus Administrator dan Kasir.</li>
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
                    <strong>Struktur Direktori Aplikasi</strong> ibarat <strong>Tata Ruang Bangunan Restoran Fisik</strong>:
                </p>
                <ul class="mb-0 small ps-3">
                    <li><strong>`index.php`</strong>: Pintu depan & etalase yang menyapa pengunjung di pinggir jalan.</li>
                    <li><strong>`customer/`</strong>: Area meja tamu dan tempat makan ber-AC.</li>
                    <li><strong>`admin/`</strong>: Ruang kasir dan meja manajer restoran.</li>
                    <li><strong>`config/` & `includes/`</strong>: Ruang genset listrik, tandon air, dan kotak perkakas teknisi di belakang gedung.</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- 2. Pojok Dosen Senior: Kamus & Bedah Istilah Sulit -->
<div class="neu-card p-4 mb-4">
    <h5 class="fw-bold text-neu-primary mb-3">
        <i class="bi bi-book-half text-neu-accent me-2"></i> Kamus Istilah Programmer Senior: Bedah Kata Sulit Root & Server
    </h5>
    
    <div class="row g-3">
        <div class="col-md-6">
            <div class="p-3 neu-inset bg-white rounded-3 h-100">
                <h6 class="fw-bold text-danger mb-1"><i class="bi bi-hdd-network-fill me-1"></i> Apa itu `Document Root` (`htdocs`)?</h6>
                <p class="small text-muted mb-0">
                    Folder khusus di komputer lokal yang dipantau oleh Web Server Apache. Apapun file yang kamu taruh di dalam folder <code>c:\xampp\htdocs\</code> akan diterjemahkan menjadi alamat web lokal <code>http://localhost/</code>. Jika folder proyekmu bernama <code>ukk2027</code>, maka alamatnya menjadi <code>http://localhost/ukk2027/</code>.
                </p>
            </div>
        </div>

        <div class="col-md-6">
            <div class="p-3 neu-inset bg-white rounded-3 h-100">
                <h6 class="fw-bold text-primary mb-1"><i class="bi bi-arrow-left-right me-1"></i> Apa Beda Path Relatif (`../`, `./`) vs URL Absolut?</h6>
                <p class="small text-muted mb-0">
                    <strong>`./`</strong>: Mencari berkas di folder yang sama saat ini.<br>
                    <strong>`../`</strong>: Naik 1 tingkat ke folder induk di atasnya.<br>
                    <strong>`../../`</strong>: Naik 2 tingkat ke atas.<br>
                    <strong>URL Absolut (`base_url()`):</strong> Alamat lengkap mulai dari domain protokol (<code>http://localhost/ukk2027/...</code>) yang kebal terhadap lokasi folder pemanggil.
                </p>
            </div>
        </div>

        <div class="col-md-6">
            <div class="p-3 neu-inset bg-white rounded-3 h-100">
                <h6 class="fw-bold text-success mb-1"><i class="bi bi-cpu-fill me-1"></i> Bagaimana Siklus Eksekusi PHP (Server-Side)?</h6>
                <p class="small text-muted mb-0">
                    Browser meminta halaman $\rightarrow$ Web Server Apache menerima $\rightarrow$ PHP Engine mengeksekusi kode (mengambil data MySQL) $\rightarrow$ PHP merender hasil menjadi teks HTML biasa $\rightarrow$ Hasil HTML dikirim balik ke browser. Browser pengunjung TIDAK PERNAH melihat kode PHP aslimu!
                </p>
            </div>
        </div>

        <div class="col-md-6">
            <div class="p-3 neu-inset bg-white rounded-3 h-100">
                <h6 class="fw-bold text-warning mb-1"><i class="bi bi-key-fill me-1"></i> Apa itu Role-Based Access Control (RBAC)?</h6>
                <p class="small text-muted mb-0">
                    Metode membagi hak akses pengguna ke dalam tingkatan wewenang (*Role*). Dalam sistem cafe kita ada 2 role: <code>customer</code> (hanya boleh pesan menu & lihat riwayatnya sendiri) dan <code>admin</code> (boleh kelola menu, ubah status order, dan lihat laporan keuangan).
                </p>
            </div>
        </div>
    </div>
</div>

<!-- 3. Interactive Project Root Tree Explorer -->
<div class="neu-card p-4 mb-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold text-neu-primary mb-0">
            <i class="bi bi-folder2-open me-2 text-neu-accent"></i> Interactive Explorer: Pohon Direktori Proyek Lengkap
        </h5>
        <span class="neu-badge neu-badge-primary">Klik Tiap Folder Untuk Melihat Penjelasan</span>
    </div>

    <div class="row g-3">
        <!-- File Tree Sisi Kiri -->
        <div class="col-md-6">
            <div class="p-3 rounded-3 font-monospace small" style="background: #201611; color: #fdf8f4; line-height: 1.9;">
                <div class="text-warning fw-bold"><i class="bi bi-folder-fill"></i> ukk2027/ (Root Directory)</div>
                <div class="ps-3"><a href="javascript:void(0)" class="text-info text-decoration-none" onclick="inspectFolder('config')">├── 📁 config/</a></div>
                <div class="ps-4 text-white-50">│   └── 📄 database.php</div>
                <div class="ps-3"><a href="javascript:void(0)" class="text-info text-decoration-none" onclick="inspectFolder('includes')">├── 📁 includes/</a></div>
                <div class="ps-4 text-white-50">│   ├── 📄 header.php</div>
                <div class="ps-4 text-white-50">│   ├── 📄 footer.php</div>
                <div class="ps-4 text-white-50">│   ├── 📄 functions.php</div>
                <div class="ps-4 text-white-50">│   └── 📄 auth.php</div>
                <div class="ps-3"><a href="javascript:void(0)" class="text-info text-decoration-none" onclick="inspectFolder('assets')">├── 📁 assets/</a></div>
                <div class="ps-4 text-white-50">│   ├── 📁 css/ (style.css)</div>
                <div class="ps-4 text-white-50">│   ├── 📁 js/ (script.js)</div>
                <div class="ps-4 text-white-50">│   └── 📁 img/ (Upload foto menu)</div>
                <div class="ps-3"><a href="javascript:void(0)" class="text-info text-decoration-none" onclick="inspectFolder('auth')">├── 📁 auth/</a></div>
                <div class="ps-4 text-white-50">│   ├── 📄 login.php</div>
                <div class="ps-4 text-white-50">│   ├── 📄 register.php</div>
                <div class="ps-4 text-white-50">│   └── 📄 logout.php</div>
                <div class="ps-3"><a href="javascript:void(0)" class="text-info text-decoration-none" onclick="inspectFolder('customer')">├── 📁 customer/</a></div>
                <div class="ps-4 text-white-50">│   ├── 📄 dashboard.php</div>
                <div class="ps-4 text-white-50">│   ├── 📄 menu.php</div>
                <div class="ps-4 text-white-50">│   ├── 📄 order.php (Taking Order)</div>
                <div class="ps-4 text-white-50">│   └── 📄 orders.php (Riwayat)</div>
                <div class="ps-3"><a href="javascript:void(0)" class="text-info text-decoration-none" onclick="inspectFolder('admin')">├── 📁 admin/</a></div>
                <div class="ps-4 text-white-50">│   ├── 📄 dashboard.php</div>
                <div class="ps-4 text-white-50">│   ├── 📄 menus.php (CRUD Menu)</div>
                <div class="ps-4 text-white-50">│   ├── 📄 orders.php (Kelola Order)</div>
                <div class="ps-4 text-white-50">│   ├── 📄 order-detail.php (Cetak Struk)</div>
                <div class="ps-4 text-white-50">│   └── 📄 reports.php (Laporan)</div>
                <div class="ps-3 text-success">├── 📄 index.php (Landing Page)</div>
                <div class="ps-3 text-warning">└── 📄 database.sql (Skema MySQL)</div>
            </div>
        </div>

        <!-- Detail Penjelasan Folder Sisi Kanan -->
        <div class="col-md-6">
            <div class="neu-card-sm p-4 bg-white h-100 d-flex flex-column justify-content-between">
                <div>
                    <h5 class="fw-bold text-neu-primary mb-2" id="folderTitle"><i class="bi bi-info-circle-fill text-neu-accent me-1"></i> Klik Salah Satu Folder</h5>
                    <p class="text-muted small" id="folderDesc">
                        Klik tautan folder warna biru di sebelah kiri untuk melihat peran arsitektural dan file-file yang ada di dalamnya secara terperinci.
                    </p>
                </div>
                <div class="p-3 neu-inset rounded-3 mt-3">
                    <small class="fw-bold text-muted d-block mb-1">RUTE STEP PRAKTIK:</small>
                    <span class="small font-monospace text-neu-primary" id="folderRoute">Mulai dari Langkah 01 (Database) &rarr; Langkah 12 (Laporan)</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 4. Peta Alur Aliran Data End-to-End -->
<div class="neu-card p-4 mb-4">
    <h5 class="fw-bold text-neu-primary mb-3">
        <i class="bi bi-diagram-2-fill me-2 text-neu-accent"></i> Peta Alur Kerja Data (*System Workflow*)
    </h5>
    
    <div class="row g-3">
        <!-- Alur Customer -->
        <div class="col-md-6">
            <div class="p-3 neu-inset bg-white rounded-3 h-100">
                <h6 class="fw-bold text-primary mb-2"><i class="bi bi-person-fill me-1"></i> Alur 1: Sisi Pelanggan (Customer Flow)</h6>
                <ol class="small text-muted ps-3 mb-0" style="line-height: 1.8;">
                    <li>Buka <code>index.php</code> (Lihat katalog menu publik).</li>
                    <li>Buka <code>auth/register.php</code> untuk membuat akun baru.</li>
                    <li>Masuk via <code>auth/login.php</code> $\rightarrow$ Sesi customer tercipta.</li>
                    <li>Masuk ke <code>customer/dashboard.php</code>.</li>
                    <li>Buka <code>customer/order.php</code>: Pilih menu, tentukan qty, kalkulasi harga real-time via JS.</li>
                    <li>Submit order $\rightarrow$ PHP mengeksekusi <strong>PDO Transaction</strong> $\rightarrow$ Masuk ke <code>customer/orders.php</code>.</li>
                </ol>
            </div>
        </div>

        <!-- Alur Admin -->
        <div class="col-md-6">
            <div class="p-3 neu-inset bg-white rounded-3 h-100">
                <h6 class="fw-bold text-warning mb-2"><i class="bi bi-shield-lock-fill me-1"></i> Alur 2: Sisi Kasir & Admin (Admin Flow)</h6>
                <ol class="small text-muted ps-3 mb-0" style="line-height: 1.8;">
                    <li>Masuk via <code>auth/login.php</code> sebagai <strong>admin</strong>.</li>
                    <li>Masuk ke <code>admin/dashboard.php</code> (Lihat rekap omset dan pesanan pending).</li>
                    <li>Buka <code>admin/menus.php</code>: Tambah menu baru + upload gambar fisik.</li>
                    <li>Buka <code>admin/orders.php</code>: Ubah status pesanan (Proses $\rightarrow$ Selesai).</li>
                    <li>Buka <code>admin/order-detail.php</code>: Cetak struk thermal kasir (<code>@media print</code>).</li>
                    <li>Buka <code>admin/reports.php</code>: Filter laporan omset berdasarkan tanggal.</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- 5. Tombol Lanjut ke Langkah 01 -->
<div class="text-center my-4">
    <a href="01-database.php" class="neu-btn neu-btn-lg neu-btn-primary">
        Lanjut ke Langkah 01: Desain Database & 4 Tabel Relasi <i class="bi bi-arrow-right ms-2"></i>
    </a>
</div>

<script>
function inspectFolder(folder) {
    const title = document.getElementById('folderTitle');
    const desc = document.getElementById('folderDesc');
    const route = document.getElementById('folderRoute');

    if (folder === 'config') {
        title.innerHTML = '<i class="bi bi-plug-fill text-neu-accent me-1"></i> Folder `config/`';
        desc.innerHTML = 'Berisi file <code>database.php</code>. Tempat mendefinisikan koneksi database PDO yang aman dengan penanganan exception error mode dan UTF-8 charset.';
        route.innerHTML = 'Dipelajari pada <strong>Langkah 02 (Koneksi PDO)</strong>';
    } else if (folder === 'includes') {
        title.innerHTML = '<i class="bi bi-layers-fill text-neu-accent me-1"></i> Folder `includes/`';
        desc.innerHTML = 'Berisi file modular bersama: <code>header.php</code>, <code>footer.php</code>, <code>functions.php</code> (kumpulan helper format rupiah & sanitasi XSS), serta <code>auth.php</code> (session guard).';
        route.innerHTML = 'Dipelajari pada <strong>Langkah 02 & Langkah 03</strong>';
    } else if (folder === 'assets') {
        title.innerHTML = '<i class="bi bi-palette-fill text-neu-accent me-1"></i> Folder `assets/`';
        desc.innerHTML = 'Berisi seluruh aset tampilan: CSS kustom cafe, JavaScript kalkulator order, dan subfolder <code>img/</code> yang menampung file upload gambar menu.';
        route.innerHTML = 'Dipelajari pada <strong>Langkah 03 & Langkah 10</strong>';
    } else if (folder === 'auth') {
        title.innerHTML = '<i class="bi bi-person-badge-fill text-neu-accent me-1"></i> Folder `auth/`';
        desc.innerHTML = 'Berisi modul keamanan autentikasi: <code>register.php</code> (pendaftaran akun dengan password_hash), <code>login.php</code> (verifikasi password_verify & sesi), dan <code>logout.php</code>.';
        route.innerHTML = 'Dipelajari pada <strong>Langkah 04 & Langkah 05</strong>';
    } else if (folder === 'customer') {
        title.innerHTML = '<i class="bi bi-cup-hot-fill text-neu-accent me-1"></i> Folder `customer/`';
        desc.innerHTML = 'Area khusus tamu cafe: <code>dashboard.php</code>, <code>order.php</code> (form pemesanan taking order interaktif + transaksi PDO atomik), dan <code>orders.php</code> (riwayat status pesanan).';
        route.innerHTML = 'Dipelajari pada <strong>Langkah 06, 07, 08, & 09</strong>';
    } else if (folder === 'admin') {
        title.innerHTML = '<i class="bi bi-speedometer2 text-neu-accent me-1"></i> Folder `admin/`';
        desc.innerHTML = 'Ruang kendali admin/kasir: <code>dashboard.php</code>, <code>menus.php</code> (CRUD menu & upload foto), <code>orders.php</code> (update status pesanan), <code>order-detail.php</code> (cetak struk POS), dan <code>reports.php</code> (laporan omset).';
        route.innerHTML = 'Dipelajari pada <strong>Langkah 10, 11, & 12</strong>';
    }
}
</script>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
