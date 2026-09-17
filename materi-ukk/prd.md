# PRODUCT REQUIREMENTS DOCUMENT (PRD)
# KURIKULUM & PANDUAN PEMBANGUNAN SISTEM "TAKING ORDER CAFE" END-TO-END
### Panduan Praktikum & Modul Edukasi Lengkap (Langkah demi Langkah dari Nol sampai Jadi) untuk Asesi UKK Asisten Pengembang Web

---

## 1. INFORMASI PRODUK & KURIKULUM

| Atribut | Keterangan |
| :--- | :--- |
| **Nama Dokumen** | PRD Kurikulum Pembuatan Sistem Informasi Taking Order Cafe (End-to-End) |
| **Lokasi Modul** | `materi-ukk/` |
| **Target Pembaca** | Siswa SMK (Jurusan PPLG / RPL), Pemula Web Development, Peserta Uji Kompetensi Keahlian (UKK) |
| **Tingkat Kemudahan** | *Zero to Hero* — Disusun sangat sistematis sehingga orang awam bahkan pemula dapat mengikuti, memahami, dan menghafal di luar kepala |
| **Gaya Desain UI** | **Light Neumorphism (Soft UI) Warm Cafe Theme** (`#f4eee5`, `#5c3d2e`, `#d97706`, `#2b1e16`) |
| **Teknologi Backend** | PHP Native 8.x + PDO (MySQL) tanpa Framework Eksternal |
| **Teknologi Frontend** | HTML5 Semantik, CSS3 Soft UI Neumorphism, Bootstrap 5.3 (Grid/Layout), Vanilla JavaScript |
| **Pendekatan Edukasi** | *Explain Like I'm Five (ELI5)*, Analogi Kehidupan Nyata, Jembatan Keledai / Mnemonik Cepat, Live Interactive Simulator |

---

## 2. LATAR BELAKANG & TUJUAN

Tujuan utama dari modul ini adalah **membimbing siswa membuat aplikasi Taking Order Cafe dari baris kode pertama hingga sistem siap diuji dan dipresentasikan di hadapan Asesor UKK**.

Modul ini membedah proses secara kronologis:
1. **Perancangan Database Relasional**: Mengapa tabel dipisah menjadi 4 (`users`, `menus`, `orders`, `order_details`), fungsi Foreign Key, dan tipe data.
2. **Fondasi Backend**: Cara membangun koneksi PDO yang aman (`try-catch`), helper pembersih data (sanitasi XSS), format Rupiah, dan kode pesanan otomatis.
3. **Pembangunan Tampilan (Frontend)**: Pembuatan tata letak modular (`header.php` & `footer.php`), Landing Page publik, dan katalog menu responsif.
4. **Alur Autentikasi**: Registrasi akun pelanggan dengan `password_hash()`, login multi-role dengan `password_verify()`, dan sesi (`$_SESSION`).
5. **Alur Transaksi Pemesanan (Taking Order)**:
   - Frontend: Form pemesanan dengan selector kuantitas (+/-) dan kalkulasi otomatis JavaScript secara live.
   - Backend: Penyimpanan multi-item secara atomik menggunakan PDO Transaction (`beginTransaction`, `commit`, `rollBack`).
6. **Alur Operasional Admin & Kasir**:
   - Manajemen CRUD Menu dengan upload gambar fisik (`$_FILES`, `move_uploaded_file()`, `unlink()`).
   - Pemrosesan antrean pesanan kasir, pembaruan status lifecycle, dan cetak struk thermal kasir (@media print).
   - Laporan penjualan terfilter rentang tanggal dengan agregasi omset (`SUM`, `COUNT`).
7. **Standar Pengamanan & Kesiapan Ujian**: Proteksi SQL Injection, sanitasi XSS, Role-Based Access Control (RBAC), dan checklist asesmen UKK.

---

## 3. PANDUAN DESAIN NEUMORPHISM (SOFT UI - WARM CAFE THEME)

Semua halaman modul menggunakan tema **Light Neumorphism (Soft UI)** yang diselaraskan dengan palet warna hangat cafe:

```css
:root {
    --neu-bg: #f4eee5;             /* Latte Cream Background */
    --neu-surface: #f4eee5;        /* Soft Surface */
    --neu-light-shadow: #ffffff;   /* Pure White Light Highlight */
    --neu-dark-shadow: #d5cabe;    /* Warm Soft Shadow */
    --neu-primary: #5c3d2e;        /* Coffee Brown (Identik Utama) */
    --neu-primary-light: #734e3c;  /* Medium Coffee */
    --neu-primary-dark: #4a3325;   /* Dark Espresso */
    --neu-accent: #d97706;         /* Caramel Amber Highlight */
    --neu-accent-hover: #b45309;   /* Deep Amber */
    --neu-success: #15803d;        /* Emerald Green */
    --neu-warning: #b45309;        /* Warm Amber Warning */
    --neu-danger: #b91c1c;         /* Ruby Red */
    --neu-info: #0369a1;           /* Sky Blue */
    --neu-text: #2b1e16;           /* Deep Dark Roast Text */
    --neu-text-muted: #706359;     /* Warm Charcoal Muted */
    --neu-border-radius: 16px;
    --neu-font: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
}
```

---

## 4. PETA STRUKTUR 13 MODUL KRONOLOGIS END-TO-END

```
materi-ukk/
├── index.php                         # Portal Utama & Peta Kurikulum Belajar
├── prd.md                            # Dokumen Spesifikasi Kurikulum Ini
├── assets/
│   ├── css/neumorphism.css           # Framework Soft UI Warm Cafe Theme
│   └── js/app.js                     # Tab Switcher, Copy Code, dan Sandbox JS
├── includes/
│   ├── header.php                    # Top Bar & Dropdown Navigasi 13 Modul
│   └── footer.php                    # Footer & Progress Pembelajaran
└── modul/
    ├── 00-root-arsitektur.php        # Langkah 0: Peta Struktur Direktori (Root) & Arsitektur Sistem
    ├── 01-database.php               # Langkah 1: Desain & Struktur 4 Tabel Database Lengkap
    ├── 02-koneksi-helper.php         # Langkah 2: Koneksi Database PDO & Kumpulan Helper Global
    ├── 03-layout-landing.php         # Langkah 3: Master Layout Modular & Landing Page Publik
    ├── 04-register.php               # Langkah 4: Formulir Registrasi & Enkripsi Password Hash
    ├── 05-login-session.php          # Langkah 5: Login Multi-Role, Verifikasi Password & Sesi
    ├── 06-katalog-customer.php       # Langkah 6: Dashboard Pelanggan & Katalog Menu Interaktif
    ├── 07-taking-order-js.php        # Langkah 7: Form Pemesanan & Kalkulasi Real-Time JavaScript
    ├── 08-transaksi-pdo.php          # Langkah 8: Simpan Pesanan Multi-Item & Transaksi PDO Atomik
    ├── 09-riwayat-pesanan.php        # Langkah 9: Riwayat Pesanan Customer & Alur Status Lifecycle
    ├── 10-kelola-menu-upload.php     # Langkah 10: Dashboard Admin, CRUD Menu & Upload Gambar
    ├── 11-kelola-pesanan-cetak.php   # Langkah 11: Manajemen Kasir, Update Status & Cetak Struk
    └── 12-laporan-keamanan.php       # Langkah 12: Filter Laporan Tanggal, Keamanan & Ujian UKK
```

---

## 5. SPESIFIKASI DETAIL SETIAP MODUL (LANGKAH 1 - 12)

Setiap halaman modul wajib memuat struktur 6 bagian:
1. **Header Modul & Tujuan**: Apa yang akan dibuat dan urgensinya.
2. **Analogi Dunia Nyata (ELI5)**: Penjelasan logika dengan perumpamaan restoran / kehidupan sehari-hari.
3. **Live Interactive Simulator**: Demo visual interaktif yang bisa diklik / diuji langsung di browser.
4. **Source Code Tabs (HTML, CSS, PHP, JS, SQL)**: Potongan kode lengkap dengan penjelasan baris per baris.
5. **Jembatan Keledai / Trik Hafalan Cepat**: Rumus hafalan di luar kepala untuk menghadapi penguji/asesor UKK.
6. **Latihan / Tantangan Mandiri**: Pertanyaan pengujian logika untuk siswa.

---

## 6. DEFINITION OF DONE (KRITERIA KELULUSAN PRODUK)

1. Semua 12 modul dapat diakses langsung tanpa error (`php -l` lulus 100%).
2. Siswa yang membaca dari Modul 01 hingga 12 dapat membangun seluruh aplikasi cafe dari awal sampai selesai secara mandiri.
3. Warna dan desain seluruh modul selaras dengan tema Warm Cafe Soft UI Neumorphism (`#f4eee5` / `#5c3d2e` / `#d97706`).
4. Navigasi Previous / Next Step berfungsi lancar di seluruh modul.
