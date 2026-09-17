# PRODUCT REQUIREMENTS DOCUMENT (PRD)
# MODUL PEMBELAJARAN INTERAKTIF "MATERI UKK KOMPONEN & LOGIKA PHP"
### Sistem Dokumentasi & Pembelajaran Web Interaktif Bertema Light Neumorphism untuk Siswa SMK / Pemula

---

## 1. INFORMASI PRODUK

| Atribut | Detail |
| :--- | :--- |
| **Nama Produk** | Materi UKK Interaktif (Learning Component & PHP Engine) |
| **Direktori Modul** | `materi-ukk/` |
| **Target Pengguna** | Siswa SMK (RPL/PPLG), Pemula Web Development, Asesi UKK Asisten Pengembang Web |
| **Filosofi Edukasi** | *Explain Like I'm Five (ELI5)*, Analogi Kehidupan Nyata, Mnemonik/Trik Hafalan Cepat |
| **Gaya Desain (UI/UX)** | **Light Neumorphism (Soft UI)** — Bersih, Minimalis, Elegan, Modern |
| **Palet Warna Neumorphic** | Background: `#f4eee5` (Warm Cream), Shadow Terang: `#ffffff`, Shadow Gelap: `#d5cabe`, Primary: `#5c3d2e` (Coffee Brown), Accent: `#d97706` (Caramel Amber) |
| **Teknologi Frontend** | HTML5, CSS3 (Neumorphism Pure Cafe Palette), Bootstrap 5 (Grid & Utilities), Vanilla JavaScript |
| **Teknologi Backend** | PHP Native 8.x + PDO (MySQL) |
| **Format Materi** | Halaman Interaktif (*Live Component Preview*, *Source Code Tabs*, *Step-by-Step PHP Logic*, *Analogy Box*, *Memory Tricks*) |

---

## 2. LATAR BELAKANG & TUJUAN

Banyak siswa SMK mengalami kesulitan dalam memahami hubungan antara **Elemen Tampilan (HTML/CSS/Bootstrap)** dengan **Pemrosesan Data di Server (PHP)** dan **Penyimpanan di Database (MySQL)**. Seringkali siswa menghafal kode secara buta tanpa mengerti konsep intinya.

### Tujuan Utama Produk Ini:
1. **Membedah Komponen Web Satuan per Satuan:** Menjelaskan fungsi, anatomi kode, styling neumorphism, dan logika pemrosesan PHP-nya.
2. **Menyajikan Analogi Ramah Pemula:** Menggunakan perumpamaan konkret dari kehidupan sehari-hari (seperti restoran, gembok brankas, nota belanja, kartu identitas).
3. **Menyediakan Trik & Jembatan Keledai (Mnemonics):** Rumus cepat untuk mengingat sintaks penting (misal: urutan koneksi PDO, siklus POST $\rightarrow$ Sanitasi $\rightarrow$ SQL $\rightarrow$ Session).
4. **Memberikan Pengalaman Belajar Visual Menarik:** Antarmuka neumorphism terang dengan palet warna cafe hangat yang memanjakan mata, selaras dengan aplikasi utama.

---

## 3. PANDUAN DESAIN NEUMORPHISM (SOFT UI) - WARM CAFE THEME

Tema yang digunakan adalah **Light Neumorphism (Soft UI) Warm Cafe Theme** murni yang selaras dengan palet aplikasi Taking Order Cafe (`#5c3d2e`, `#2b1e16`, `#d97706`, `#f4eee5`). Menggunakan prinsip bayangan ganda (*dual drop-shadow*) untuk menciptakan ilusi elemen yang menonjol (*extruded*) atau cekung (*inset*) dari permukaan latar belakang.

### 3.1 Token Warna & CSS Neumorphic
```css
:root {
    --neu-bg: #f4eee5;
    --neu-surface: #f4eee5;
    --neu-light-shadow: #ffffff;
    --neu-dark-shadow: #d5cabe;
    --neu-primary: #5c3d2e;
    --neu-primary-light: #734e3c;
    --neu-primary-dark: #4a3325;
    --neu-accent: #d97706;
    --neu-accent-hover: #b45309;
    --neu-text: #2b1e16;
    --neu-text-muted: #706359;
}

/* 1. Flat Extruded (Elemen Menonjol Lembut) */
.neu-box {
    background: var(--neu-bg);
    border-radius: 16px;
    box-shadow: 8px 8px 16px var(--neu-dark-shadow),
               -8px -8px 16px var(--neu-light-shadow);
}

/* 2. Inset / Pressed (Elemen Cekung / Input Aktif) */
.neu-inset {
    background: var(--neu-bg);
    border-radius: 12px;
    box-shadow: inset 4px 4px 8px var(--neu-dark-shadow),
                inset -4px -4px 8px var(--neu-light-shadow);
}

/* 3. Button Hover / Active State */
.neu-btn:active {
    box-shadow: inset 3px 3px 6px var(--neu-dark-shadow),
                inset -3px -3px 6px var(--neu-light-shadow);
}
```

---

## 4. DAFTAR KOMPONEN & MATERI YANG DIBEDAH

Modul pembelajaran ini membedah **11 Komponen Fundamental Web & Logika PHP**:

```text
materi-ukk/
├── 01-tombol-dan-aksi (Button, State, Event, dan Form Trigger)
├── 02-card-dan-katalog (Card, Image, Badge Kategori, Grid Responsive)
├── 03-form-login-dan-autentikasi (Input Inset, password_verify, $_SESSION)
├── 04-form-registrasi-dan-hash (Validasi Kecocokan, password_hash, Insert SQL)
├── 05-form-order-dan-kalkulasi (Quantity Plus-Minus, JS Calc, Subtotal)
├── 06-tabel-dan-loop-data (Table Responsive, Foreach PHP, Status Badge, Safe Flash Message)
├── 07-transaksi-database-pdo (PDO Transaction: beginTransaction, commit, rollback)
├── 08-stat-card-dan-query-agregat (COUNT, SUM, AVG, Dashboard Operasional)
├── 09-filter-laporan-dan-cetak (Form Filter GET, WHERE Date, window.print())
├── 10-middleware-role-guard (Cek Sesi, Pemisahan Hak Akses 403 Forbidden)
└── 11-upload-dan-crud-menu (Upload File $_FILES, move_uploaded_file, Validasi Gambar & CRUD)
```

---

## 5. SPESIFIKASI DETAIL SETIAP MATERI KOMPONEN

Setiap modul materi wajib memiliki 6 pilar penjelasan terstruktur:

1. **🎯 Definisi Sederhana (Konsep 5 Detik):** Penjelasan yang bisa dipahami bahkan tanpa latar belakang IT.
2. **🍕 Analogi Dunia Nyata:** Perumpamaan nyata yang melekat di ingatan.
3. **🎨 Desain & Anatomi HTML/CSS (Neumorphic):** Struktur tag HTML dan gaya visual Neumorphism.
4. **⚙️ Pemrosesan PHP & SQL:** Alur logika backend baris per baris.
5. **🧠 Trik Hafalan / Jembatan Keledai:** Cara mengingat sintaks penting tanpa membuka catatan.
6. **⚠️ Jebakan Error Pemula & Solusinya:** Masalah umum (*gotchas*) dan cara mengatasinya.

---

### Modul 1: Tombol Interaktif & Aksi Form (`Button & Trigger`)
* **Analogi:** Tombol adalah *Bel Pintu*. Begitu ditekan, bel membunyikan sinyal ke dalam rumah (server).
* **HTML/CSS:** Tombol Neumorphic cembung yang menjadi cekung saat diklik (*active state*).
* **PHP:** `$_SERVER['REQUEST_METHOD'] === 'POST'` atau `isset($_POST['submit'])`.
* **Trik Hafalan:** Rumus **T-A-P** (*Type button/submit*, *Action link/form*, *PHP Handler*).

### Modul 2: Kartu Menu / Katalog (`Card & Responsive Grid`)
* **Analogi:** Kartu menu adalah *Buku Menu Restoran di Atas Meja* yang memuat foto, nama hidangan, harga, dan tombol pesan.
* **HTML/CSS:** Box Neumorphism dengan gambar ber-radius halus dan badge kategori timbul.
* **PHP:** Perulangan data database menggunakan `foreach ($menus as $m): ... endforeach;`.
* **Trik Hafalan:** Rumus **W-I-P-P** (*Wrapper card*, *Image top*, *Price badge*, *Pesan button*).

### Modul 3: Form Login & Autentikasi (`Login & Password Verify`)
* **Analogi:** Login seperti *Menunjukkan KTP dan Kata Sandi ke Satpam*. Jika satpam memeriksa dan cocok, Anda diberi *Gelang Akses VIP (Session)*.
* **HTML/CSS:** Form Card Neumorphic dengan input tipe *inset* yang cekung ke dalam.
* **PHP:** Alur **T-S-V-S** (*Tangkap POST* $\rightarrow$ *SELECT SQL* $\rightarrow$ *Verify password_verify()* $\rightarrow$ *Set $_SESSION*).
* **Trik Hafalan:** *Satpam minta KTP $\rightarrow$ Cocokkan Sandi $\rightarrow$ Beri Gelang Session $\rightarrow$ Masuk Dashboard!*

### Modul 4: Form Registrasi & Enkripsi Hash (`Register & Password Hash`)
* **Analogi:** Registrasi seperti *Mendaftar Paspor Baru*. Petugas tidak menyimpan tulisan password asli Anda di arsip umum, melainkan mengacaknya menjadi *Kode Rahasia (Hash)*.
* **HTML/CSS:** Form input berlapis Neumorphic dengan validasi kecocokan password.
* **PHP:** `password_hash($password, PASSWORD_DEFAULT)` sebelum `INSERT INTO users`.
* **Trik Hafalan:** *Jangan Pernah Simpan Password Polos! Hash dulu, Baru Masuk Database!*

### Modul 5: Formulir Taking Order & Kalkulasi Dinamis (`Taking Order Form`)
* **Analogi:** Seperti *Pelayan Menulis Nota Pesanan*. Setiap kali Anda menambah 1 piring nasi goreng, pelayan langsung mengalikan dengan harga dan menghitung total di bagian bawah nota.
* **HTML/CSS:** Baris tabel dengan tombol minus/plus Neumorphic dan display total timbul.
* **JavaScript:** Event listener `input` / `click` yang menghitung `subtotal = price * qty` dan `grand_total = sum(subtotal)`.
* **Trik Hafalan:** *Qty $\times$ Harga = Subtotal. Jumlahkan Semua Subtotal = Total Tagihan!*

### Modul 6: Tabel Riwayat & Status Badge (`Table & Badges`)
* **Analogi:** Seperti *Papan Pengumuman Antrean Bandara*. Menunjukkan nomor penerbangan, tujuan, jam, dan status (*Menunggu, Masuk Pesawat, Berangkat*).
* **HTML/CSS:** Tabel bersih Neumorphism dengan status badge bulat timbul.
* **PHP:** Format Rupiah `format_rupiah()` dan fungsi render status switch-case.
* **Trik Hafalan:** *4 Warna Status: Kuning (Menunggu), Biru (Diproses), Hijau (Selesai), Merah (Dibatalkan).*

### Modul 7: Transaksi Database Atomik (`PDO Transaction`)
* **Analogi:** Seperti *Transfer Uang di ATM*. Saldo pengirim dipotong DAN saldo penerima bertambah. Jika listrik mati di tengah-tengah, transfer dibatalkan semua (*Rollback*), uang tidak hilang.
* **PHP:**
  ```php
  $pdo->beginTransaction();
  // 1. Simpan Header Order
  // 2. Simpan Item Detail
  $pdo->commit(); // Berhasil semua
  // Catch: $pdo->rollBack(); // Batal semua
  ```
* **Trik Hafalan:** **B-C-R** (*Begin $\rightarrow$ Commit $\rightarrow$ Rollback*).

### Modul 8: Kartu Statistik & Query Agregat (`Dashboard Analytics`)
* **Analogi:** Seperti *Spedometer di Dashboard Mobil*. Sekilas melihat langsung tahu kecepatan, sisa bensin, dan jarak tempuh.
* **SQL:**
  - `COUNT(*)` = Menghitung jumlah lembar transaksi.
  - `SUM(total)` = Menjumlahkan seluruh uang masuk.
* **Trik Hafalan:** *Hitung lembar pakai COUNT, Hitung uang pakai SUM!*

### Modul 9: Filter Laporan Penjualan & Cetak (`Reports & Print`)
* **Analogi:** Seperti *Memilih Rentang Waktu di Rekening Koran Bank*, lalu meminta petugas mencetaknya di kertas resmi.
* **HTML/CSS:** `@media print` yang menyembunyikan navbar, tombol, dan hanya mencetak isi laporan bersih dengan kolom tanda tangan.
* **PHP/SQL:** `WHERE DATE(created_at) BETWEEN ? AND ?`.
* **Trik Hafalan:** *Di layar ada tombol, di kertas print tombol menghilang!*

### Modul 10: Otorisasi & Role Guard (`Middleware 403`)
* **Analogi:** Seperti *Pintu Khusus Karyawan (Staff Only)*. Tamu tidak boleh masuk ke ruang staf. Jika nekat menerobos, alarm 403 berbunyi.
* **PHP:** Pengecekan `$_SESSION['user']['role'] === 'admin'`. Jika tidak sesuai $\rightarrow$ `http_response_code(403)` dan tampilkan peringatan larangan.
* **Trik Hafalan:** *Cek Sesi Dulu, Cek Role Kemudian. Salah Role = Usir Keluar!*

### Modul 11: Upload Gambar & CRUD Menu (`File Upload & Management`)
* **Analogi:** Seperti *Menempel Foto Menu Baru di Etalase Cafe*. Anda membawa cetakan foto dari rumah (upload), menamai hidangannya di papan daftar (INSERT/UPDATE), dan jika makanan sudah habis, Anda menempel stiker *Sold Out / Unavailable* agar riwayat pembukuan tidak rusak.
* **HTML/CSS:** Form input file dengan `enctype="multipart/form-data"` dan preview gambar Neumorphic.
* **PHP:**
  - Menangkap file melalui array global `$_FILES['image']`.
  - Validasi ekstensi aman (`jpg, jpeg, png, webp, svg`) dan ukuran maksimal (2MB).
  - Membuat nama unik `menu_timestamp_random.ext` agar tidak saling menimpa.
  - Memindahkan file fisik via `move_uploaded_file()`.
  - Simpan nama file ke kolom `image` pada tabel `menus`.
  - Keamanan hapus (*Smart Delete*): Jika menu pernah dipesan di `order_details`, ubah status menjadi `unavailable`, bukan menghapus fisik database.
* **Trik Hafalan:** Rumus **E-V-N-M** (*Enctype multipart* $\rightarrow$ *Validate extension/size* $\rightarrow$ *Name unique* $\rightarrow$ *Move uploaded file*).

---

## 6. STRUKTUR HALAMAN & FITUR APLIKASI MATERI UKK

Aplikasi materi ini akan dibuat sebagai sebuah halaman web interaktif yang mandiri di dalam folder `materi-ukk/`:

```text
materi-ukk/
├── index.php             # Portal Utama Materi Interaktif (Navigasi Modul)
├── prd.md                # Dokumen Spesifikasi Produk (Dokumen ini)
├── assets/
│   ├── css/
│   │   └── neumorphism.css # Framework CSS Light Neumorphism Mandiri
│   └── js/
│       └── app.js        # Script Tab Interaktif, Copy Code, & Live Demo
└── modul/
    ├── 01-button.php
    ├── 02-card.php
    ├── 03-login.php
    ├── 04-register.php
    ├── 05-order.php
    ├── 06-table.php
    ├── 07-transaction.php
    ├── 08-statcard.php
    ├── 09-reports.php
    └── 10-roleguard.php
```

### Fitur Interaktif pada Antarmuka Materi:
1. **Live Interactive Playground:** Siswa dapat mencoba komponen secara langsung di browser dengan tema Neumorphic.
2. **Interactive Code Tabs:** Tab terpisah untuk `HTML`, `CSS Neumorphic`, `PHP Backend Logic`, dan `SQL Database Query`.
3. **Copy Code 1-Klik:** Tombol salin kode cepat dengan feedback tooltip.
4. **Analogy Card Box:** Kartu berlatar lembut dengan ikon visual perumpamaan kehidupan sehari-hari.
5. **Mnemonics / Memory Trick Highlight:** Kotak tips hafalan berwarna pastel untuk memudahkan mengingat sintaks saat ujian UKK.

---

## 7. DEFINITION OF DONE (KRITERIA SELESAI)

1. [x] Dokumen PRD `materi-ukk/prd.md` selesai disusun secara komprehensif.
2. [ ] Framework styling CSS Light Neumorphism `materi-ukk/assets/css/neumorphism.css` dibangun dengan efek *extruded* dan *inset* yang halus dan estetik.
3. [ ] Halaman portal utama `materi-ukk/index.php` menampilkan navigasi 10 modul pembelajaran lengkap.
4. [ ] Seluruh modul memuat live demo, kode HTML/CSS, alur PHP, query SQL, analogi sederhana, dan trik hafalan.
5. [ ] Responsif di semua ukuran layar (Desktop, Laptop, Tablet, Smartphone).
