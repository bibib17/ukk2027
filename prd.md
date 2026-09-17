# PRODUCT REQUIREMENTS DOCUMENT (PRD)

# TAKING ORDER CAFE

### Sistem Pemesanan Cafe Berbasis Web

### Versi Pembelajaran dan Siap Pakai untuk Siswa SMK

---

# 1. INFORMASI PRODUK

| Informasi       | Detail                                           |
| --------------- | ------------------------------------------------ |
| Nama Sistem     | Taking Order Cafe                                |
| Jenis           | Sistem Informasi Berbasis Web                    |
| Target Utama    | Siswa SMK                                        |
| Pengguna Sistem | Admin dan Pelanggan                              |
| Backend         | PHP Native                                       |
| Database        | MySQL                                            |
| Frontend        | HTML + Bootstrap                                 |
| CSS Custom      | Minimal                                          |
| JavaScript      | Minimal, hanya jika diperlukan                   |
| Web Server      | XAMPP / Laragon                                  |
| Browser         | Chrome / Edge / Firefox                          |
| Responsive      | Ya                                               |
| Fokus           | Mudah dibuat, mudah dipahami, mudah dikembangkan |
| Status Target   | Sistem siap digunakan                            |

---

# 2. LATAR BELAKANG

Cafe membutuhkan cara yang sederhana untuk menerima dan mengelola pesanan pelanggan.

Sistem Taking Order Cafe dibuat untuk membantu:

* pelanggan melihat daftar menu;
* pelanggan melakukan pemesanan;
* pelanggan mengetahui pesanan yang dibuat;
* admin melihat pesanan masuk;
* admin mengubah status pesanan;
* admin melihat laporan transaksi.

Sistem dirancang khusus agar dapat dikerjakan oleh **siswa SMK bidang PPLG/RPL** yang masih memiliki keterbatasan dalam pemrograman.

Oleh karena itu, sistem tidak menggunakan arsitektur atau teknologi yang terlalu kompleks.

Prinsip utama:

> **Sedikit teknologi, sedikit CSS, sedikit JavaScript, tetapi sistem benar-benar berjalan.**

---

# 3. TUJUAN PRODUK

Sistem harus mampu menghasilkan aplikasi cafe yang:

1. dapat digunakan pelanggan untuk melakukan order;
2. dapat digunakan admin untuk mengelola order;
3. memiliki database;
4. memiliki login;
5. memiliki pembagian hak akses;
6. memiliki tampilan responsive;
7. mudah dipahami oleh siswa;
8. mudah dijelaskan oleh siswa;
9. mudah diperbaiki ketika terjadi error;
10. dapat dikembangkan menjadi project yang lebih besar.

---

# 4. PRINSIP DESAIN SISTEM

## 4.1 Simple First

Sistem harus mengutamakan fungsi daripada kompleksitas.

Jangan membuat fitur hanya karena "bisa dibuat".

---

## 4.2 Bootstrap First

Sebagian besar tampilan menggunakan Bootstrap.

Contoh komponen:

* Navbar
* Container
* Row
* Col
* Card
* Button
* Form
* Table
* Badge
* Alert
* Modal

Custom CSS hanya digunakan jika Bootstrap tidak mencukupi.

---

## 4.3 Minimal Custom CSS

CSS custom tidak boleh menjadi bagian besar dari project.

Contoh:

```text
assets/css/style.css
```

cukup berisi penyesuaian kecil seperti:

* ukuran logo;
* gambar menu;
* spacing khusus;
* beberapa penyesuaian tampilan.

Tidak perlu membuat framework CSS sendiri.

---

## 4.4 Minimal JavaScript

JavaScript hanya digunakan jika memang dibutuhkan.

Contoh:

* konfirmasi hapus;
* modal;
* validasi sederhana;
* interaksi kecil.

Tidak perlu membuat SPA.

Tidak perlu AJAX untuk versi dasar.

Tidak perlu framework JavaScript.

---

## 4.5 PHP Native

Sistem menggunakan PHP Native agar siswa memahami:

```text
PHP
 ↓
Database
 ↓
HTML
```

Siswa dapat memahami hubungan antara:

```text
Form
 ↓
PHP
 ↓
SQL
 ↓
Database
 ↓
PHP
 ↓
HTML
```

---

# 5. TEKNOLOGI

## Wajib

```text
HTML5
CSS3
Bootstrap 5
PHP Native
MySQL
PDO
JavaScript dasar
```

## Tidak digunakan

```text
Laravel
CodeIgniter
React
Vue
Next.js
Node.js
Tailwind
jQuery
API kompleks
WebSocket
```

Tujuannya agar siswa fokus mempelajari fundamental web development.

---

# 6. TARGET USER

Sistem memiliki dua jenis pengguna:

```text
ADMIN
CUSTOMER
```

---

# 7. ADMIN

Admin merupakan pengguna yang mengelola operasional order.

Admin dapat:

* login;
* logout;
* melihat dashboard;
* melihat daftar order;
* melihat detail order;
* mengubah status order;
* melihat laporan.

---

# 8. CUSTOMER

Customer merupakan pelanggan cafe.

Customer dapat:

* registrasi;
* login;
* logout;
* melihat menu;
* melihat detail menu;
* membuat order;
* melihat order miliknya.

---

# 9. FITUR UTAMA

## 9.1 Authentication

### Login

Input:

```text
Username
Password
```

Sistem melakukan:

```text
Input
 ↓
Validasi
 ↓
Cari User
 ↓
Verifikasi Password
 ↓
Session
 ↓
Dashboard
```

---

### Logout

Menghapus session kemudian kembali ke halaman login.

---

### Registrasi

Customer dapat membuat akun.

Input:

```text
Nama
Username
Password
Konfirmasi Password
```

---

# 10. CUSTOMER MODULE

## 10.1 Dashboard Customer

Isi:

```text
Selamat datang, [Nama]

[ Lihat Menu ]

[ Pesanan Saya ]
```

Dashboard dibuat sederhana.

Tidak perlu grafik.

---

# 11. MENU CAFE

Halaman menu menampilkan makanan dan minuman.

Menggunakan Bootstrap Card.

Contoh:

```text
+-----------------------+
|       FOTO MENU       |
|                       |
| Nasi Goreng           |
| Makanan               |
| Rp 18.000             |
|                       |
| [Pesan]               |
+-----------------------+
```

Informasi:

* gambar;
* nama;
* kategori;
* harga;
* deskripsi;
* tombol pesan.

---

# 12. DETAIL MENU

Ketika pelanggan memilih menu:

```text
Foto
Nama Menu
Kategori
Harga
Deskripsi
Jumlah
[Pesan]
```

Tidak perlu halaman yang kompleks.

---

# 13. PEMBUATAN ORDER

Customer memilih:

```text
Menu
Jumlah
```

Kemudian sistem menghitung:

```text
Subtotal = Harga × Jumlah
```

Jika terdapat beberapa menu:

```text
Total = Subtotal 1 + Subtotal 2 + ...
```

---

# 14. KONFIRMASI ORDER

Sebelum order disimpan, tampilkan ringkasan:

```text
Pesanan Anda

Nasi Goreng
2 × Rp18.000
Rp36.000

Es Teh
2 × Rp5.000
Rp10.000

------------------
Total Rp46.000

[Konfirmasi Pesanan]
```

Setelah dikonfirmasi:

```text
Order berhasil dibuat.
Nomor Order: ORD-00001
Status: Menunggu
```

---

# 15. PESANAN SAYA

Customer dapat melihat pesanan miliknya.

Tabel:

| Order   | Tanggal    |    Total | Status   |
| ------- | ---------- | -------: | -------- |
| ORD-001 | 17/09/2026 | Rp46.000 | Menunggu |
| ORD-002 | 16/09/2026 | Rp30.000 | Selesai  |

Customer hanya dapat melihat order miliknya sendiri.

---

# 16. ADMIN MODULE

## 16.1 Dashboard Admin

Dashboard sederhana menggunakan Bootstrap Card.

Contoh:

```text
+-------------+
| Total Order |
|     25      |
+-------------+

+-------------+
| Menunggu    |
|      5      |
+-------------+

+-------------+
| Selesai     |
|     20      |
+-------------+
```

Tidak perlu chart.

---

# 17. DATA ORDER

Admin dapat melihat semua order.

Contoh:

| No | Kode    | Customer |    Total | Status   | Aksi   |
| -- | ------- | -------- | -------: | -------- | ------ |
| 1  | ORD-001 | Andi     | Rp46.000 | Menunggu | Detail |
| 2  | ORD-002 | Budi     | Rp30.000 | Selesai  | Detail |

---

# 18. DETAIL ORDER ADMIN

Menampilkan:

```text
Kode Order
Nama Customer
Tanggal
```

Daftar:

| Menu        |    Harga | Qty | Subtotal |
| ----------- | -------: | --: | -------: |
| Nasi Goreng | Rp18.000 |   2 | Rp36.000 |
| Es Teh      |  Rp5.000 |   2 | Rp10.000 |

Total:

```text
Rp46.000
```

---

# 19. UPDATE STATUS ORDER

Admin dapat mengubah status:

```text
Menunggu
    ↓
Diproses
    ↓
Selesai
```

Status tambahan:

```text
Dibatalkan
```

Menggunakan form sederhana:

```text
Status:
[ Menunggu ▼ ]

[ Simpan ]
```

Tidak perlu drag-and-drop.

---

# 20. LAPORAN

Admin dapat melihat laporan transaksi.

Isi:

```text
Total Order
Total Pendapatan
```

dan tabel:

| No | Kode | Customer | Tanggal | Total | Status |
| -- | ---- | -------- | ------- | ----: | ------ |

---

# 21. FILTER LAPORAN

Jika siswa mampu mengimplementasikannya, filter dapat ditambahkan.

Filter:

```text
Tanggal Awal
Tanggal Akhir
Status
[Filter]
```

Namun fitur ini merupakan **fitur tambahan**, bukan fondasi sistem.

---

# 22. DATABASE

Nama database:

```text
taking_order_cafe
```

Database dibuat sesederhana mungkin.

---

# 23. TABLE USERS

```text
users
```

Kolom:

| Field      | Tipe     | Keterangan     |
| ---------- | -------- | -------------- |
| id         | INT      | Primary Key    |
| name       | VARCHAR  | Nama           |
| username   | VARCHAR  | Username       |
| password   | VARCHAR  | Password hash  |
| role       | VARCHAR  | admin/customer |
| created_at | DATETIME | Waktu dibuat   |

---

# 24. TABLE MENUS

```text
menus
```

Kolom:

| Field       | Tipe     | Keterangan            |
| ----------- | -------- | --------------------- |
| id          | INT      | Primary Key           |
| name        | VARCHAR  | Nama menu             |
| category    | VARCHAR  | Kategori              |
| description | TEXT     | Deskripsi             |
| price       | DECIMAL  | Harga                 |
| image       | VARCHAR  | Nama gambar           |
| status      | VARCHAR  | available/unavailable |
| created_at  | DATETIME | Waktu dibuat          |

---

# 25. TABLE ORDERS

```text
orders
```

Kolom:

| Field      | Tipe     | Keterangan   |
| ---------- | -------- | ------------ |
| id         | INT      | Primary Key  |
| order_code | VARCHAR  | Kode order   |
| user_id    | INT      | Customer     |
| total      | DECIMAL  | Total        |
| status     | VARCHAR  | Status order |
| created_at | DATETIME | Waktu order  |

---

# 26. TABLE ORDER_DETAILS

```text
order_details
```

Kolom:

| Field    | Tipe    | Keterangan       |
| -------- | ------- | ---------------- |
| id       | INT     | Primary Key      |
| order_id | INT     | Order            |
| menu_id  | INT     | Menu             |
| price    | DECIMAL | Harga saat order |
| quantity | INT     | Jumlah           |
| subtotal | DECIMAL | Harga × jumlah   |

---

# 27. RELASI DATABASE

```text
users
   │
   │
   └──── orders
             │
             │
             └──── order_details
                         │
                         │
                         └──── menus
```

Dengan relasi:

```text
users.id
    ↓
orders.user_id
```

```text
orders.id
    ↓
order_details.order_id
```

```text
menus.id
    ↓
order_details.menu_id
```

---

# 28. STRUKTUR FOLDER

Struktur dibuat mudah dipahami siswa.

```text
taking-order-cafe/
│
├── admin/
│   ├── dashboard.php
│   ├── orders.php
│   ├── order-detail.php
│   └── reports.php
│
├── customer/
│   ├── dashboard.php
│   ├── menu.php
│   ├── order.php
│   └── orders.php
│
├── auth/
│   ├── login.php
│   ├── register.php
│   └── logout.php
│
├── config/
│   └── database.php
│
├── includes/
│   ├── header.php
│   ├── footer.php
│   ├── auth.php
│   └── functions.php
│
├── assets/
│   ├── css/
│   │   └── style.css
│   │
│   ├── js/
│   │   └── script.js
│   │
│   └── img/
│
├── index.php
│
├── database.sql
│
└── README.md
```

---

# 29. PENJELASAN STRUKTUR UNTUK SISWA

Siswa harus dapat memahami fungsi setiap folder.

```text
admin/
```

Tempat halaman administrator.

```text
customer/
```

Tempat halaman pelanggan.

```text
auth/
```

Tempat login, register, logout.

```text
config/
```

Tempat koneksi database.

```text
includes/
```

Tempat file yang digunakan bersama.

```text
assets/
```

Tempat CSS, JavaScript dan gambar.

```text
database.sql
```

File database.

---

# 30. FILE DATABASE

File:

```text
database.sql
```

harus dapat digunakan untuk membuat database secara cepat.

Urutan:

```text
Buat Database
      ↓
Buat Table
      ↓
Insert Data Awal
```

Data awal minimal:

### Admin

```text
username: admin
password: password
role: admin
```

### Customer

```text
username: customer
password: password
role: customer
```

### Menu

Minimal 5 menu.

Contoh:

```text
Nasi Goreng
Mie Goreng
Ayam Geprek
Kentang Goreng
Es Teh
Kopi Susu
```

---

# 31. KONEKSI DATABASE

Koneksi database dipusatkan pada:

```text
config/database.php
```

Gunakan PDO.

Contoh konsep:

```text
PHP
 ↓
database.php
 ↓
PDO
 ↓
MySQL
```

File lain cukup menggunakan koneksi yang sudah tersedia.

---

# 32. AUTHENTICATION

Gunakan PHP Session.

Flow:

```text
Login
 ↓
Cek username
 ↓
Cek password
 ↓
Set session
 ↓
Masuk dashboard
```

Session minimal menyimpan:

```text
user_id
name
role
```

---

# 33. AUTHORIZATION

Setiap halaman harus memeriksa role.

Contoh:

```text
/customer/*
```

hanya customer.

```text
/admin/*
```

hanya admin.

Jika tidak memiliki akses:

```text
Anda tidak memiliki akses ke halaman ini.
```

---

# 34. SECURITY DASAR

Siswa tidak perlu mempelajari keamanan tingkat lanjut.

Cukup menerapkan beberapa hal penting.

### Password

Gunakan:

```php
password_hash()
```

dan:

```php
password_verify()
```

### SQL

Gunakan:

```text
PDO + Prepared Statement
```

### Session

Gunakan session untuk login.

### Input

Validasi input dari form.

### Output

Gunakan escaping ketika menampilkan input user.

---

# 35. UI DESIGN

Tema:

> **Minimalist Cafe**

Karakteristik:

* putih;
* sederhana;
* bersih;
* banyak whitespace;
* card Bootstrap;
* tombol sederhana;
* typography Bootstrap;
* tidak banyak dekorasi.

Tidak diperlukan desain yang terlalu artistik.

---

# 36. BOOTSTRAP

Bootstrap menjadi dasar tampilan.

Contoh:

```html
container
row
col
card
btn
form-control
table
navbar
alert
badge
```

Siswa cukup memahami komponen Bootstrap yang digunakan.

---

# 37. CSS CUSTOM

CSS custom dibuat sesedikit mungkin.

Contoh:

```css
.menu-image {
    height: 200px;
    object-fit: cover;
}
```

Tidak perlu membuat:

```text
custom grid
custom button system
custom responsive framework
custom typography system
```

Bootstrap sudah menangani sebagian besar kebutuhan tersebut.

---

# 38. JAVASCRIPT

JavaScript hanya digunakan untuk interaksi sederhana.

Contoh:

```javascript
confirm("Apakah Anda yakin?");
```

Penggunaan JavaScript tidak boleh membuat project menjadi sulit dipahami.

---

# 39. KOMPONEN YANG DIGUNAKAN

Sistem menggunakan komponen Bootstrap berikut:

```text
Navbar
Container
Row
Column
Card
Button
Form
Input
Select
Table
Badge
Alert
Modal
Pagination
```

Tidak harus semua digunakan.

Gunakan hanya jika diperlukan.

---

# 40. RESPONSIVE DESIGN

Sistem harus dapat digunakan melalui:

```text
Desktop
Tablet
Smartphone
```

Bootstrap digunakan untuk responsive layout.

Contoh:

```text
col-12
col-md-6
col-lg-4
```

Dengan demikian siswa tidak perlu menulis media query yang kompleks.

---

# 41. FLOW CUSTOMER

```text
START
  ↓
Landing Page
  ↓
Login/Register
  ↓
Dashboard
  ↓
Lihat Menu
  ↓
Pilih Menu
  ↓
Tentukan Jumlah
  ↓
Konfirmasi
  ↓
Order Disimpan
  ↓
Lihat Pesanan
  ↓
END
```

---

# 42. FLOW ADMIN

```text
START
  ↓
Login
  ↓
Dashboard
  ↓
Lihat Order
  ↓
Pilih Order
  ↓
Lihat Detail
  ↓
Update Status
  ↓
Laporan
  ↓
Logout
  ↓
END
```

---

# 43. USER EXPERIENCE

Sistem harus memberikan feedback setelah tindakan.

Contoh:

### Berhasil login

```text
Login berhasil.
```

### Order berhasil

```text
Pesanan berhasil dibuat.
```

### Update berhasil

```text
Status order berhasil diperbarui.
```

### Error

```text
Terjadi kesalahan.
Silakan coba kembali.
```

Feedback menggunakan Bootstrap Alert.

---

# 44. VALIDASI FORM

Validasi minimal:

### Login

* username wajib;
* password wajib.

### Register

* nama wajib;
* username wajib;
* password wajib;
* konfirmasi password harus sama.

### Order

* menu harus tersedia;
* quantity minimal 1.

---

# 45. ERROR HANDLING

Sistem tidak boleh menampilkan error PHP mentah kepada pengguna.

Contoh yang tidak baik:

```text
Fatal error: Uncaught PDOException...
```

Untuk pengguna:

```text
Terjadi kesalahan pada sistem.
```

Namun saat development, siswa tetap diperbolehkan mengaktifkan error reporting untuk menemukan kesalahan.

---

# 46. KONSEP CRUD

Walaupun sistem tidak perlu memiliki CRUD kompleks, siswa tetap belajar konsep CRUD.

### Menu

Untuk versi dasar, data menu dapat dimasukkan melalui database/seed.

Jika ingin dikembangkan:

```text
Create Menu
Read Menu
Update Menu
Delete Menu
```

Fitur CRUD menu **bukan fitur wajib versi awal**.

---

# 47. LEVEL IMPLEMENTASI

Sistem dibuat bertahap.

## LEVEL 1 – Fundamental

Siswa membuat:

```text
Database
Koneksi
Login
Logout
Menu
Order
```

---

## LEVEL 2 – Sistem

Siswa menambahkan:

```text
Role
Admin
Status Order
Riwayat
Laporan
```

---

## LEVEL 3 – Penyempurnaan

Jika kemampuan siswa memungkinkan:

```text
Filter laporan
CRUD menu
Upload gambar
Pagination
Modal
Validasi tambahan
```

Dengan sistem bertahap, siswa dengan kemampuan berbeda tetap dapat menyelesaikan project.

---

# 48. PRIORITAS DEVELOPMENT

## P0 – WAJIB

```text
Database
Koneksi PHP
Login
Logout
Session
Role
Menu
Order
Order Detail
Admin Order
Update Status
```

## P1 – PENTING

```text
Dashboard
Riwayat Order
Laporan
Validation
Responsive
Error Handling
```

## P2 – TAMBAHAN

```text
CRUD Menu
Filter
Upload Gambar
Pagination
Modal
```

---

# 49. STRATEGI PEMBELAJARAN SISWA

Project sebaiknya dikerjakan secara bertahap.

### Tahap 1

Siswa membuat:

```text
index.php
database.php
```

Tujuan:

Memahami koneksi PHP → MySQL.

---

### Tahap 2

Membuat login.

Tujuan:

Memahami:

```text
Form
POST
SQL
Session
```

---

### Tahap 3

Membuat menu.

Tujuan:

Memahami:

```text
SELECT
Loop PHP
HTML
Bootstrap Card
```

---

### Tahap 4

Membuat order.

Tujuan:

Memahami:

```text
INSERT
Relasi
Perhitungan
```

---

### Tahap 5

Membuat admin.

Tujuan:

Memahami:

```text
Role
Authorization
UPDATE
```

---

### Tahap 6

Membuat laporan.

Tujuan:

Memahami:

```text
SELECT
JOIN
WHERE
SUM
COUNT
```

---

# 50. SQL YANG PERLU DIKUASAI SISWA

Sistem dirancang agar siswa berlatih SQL dasar:

```sql
SELECT
INSERT
UPDATE
DELETE
WHERE
ORDER BY
JOIN
COUNT()
SUM()
```

Tidak diperlukan:

```text
Stored Procedure
Trigger
View kompleks
Function database
Replication
```

---

# 51. PHP YANG PERLU DIKUASAI SISWA

Materi PHP yang digunakan:

```text
Variable
Array
IF/ELSE
Loop
Function
GET
POST
Session
Include
Require
PDO
Prepared Statement
```

---

# 52. HTML YANG PERLU DIKUASAI

```text
html
head
body
form
input
select
button
table
img
a
div
```

Tidak perlu menggunakan struktur HTML yang terlalu kompleks.

---

# 53. OUTPUT AKHIR

Setelah selesai, siswa menghasilkan:

```text
taking-order-cafe/
```

yang dapat dijalankan pada:

```text
XAMPP
atau
Laragon
```

Contoh:

```text
http://localhost/taking-order-cafe/
```

---

# 54. README

Project wajib memiliki:

```text
README.md
```

Isi:

```text
Nama Project
Deskripsi
Teknologi
Cara Instalasi
Cara Membuat Database
Cara Menjalankan
Akun Login
Daftar Fitur
```

---

# 55. TESTING

Sebelum dianggap selesai, siswa harus melakukan testing.

### Login

* [ ] Login admin berhasil.
* [ ] Login customer berhasil.
* [ ] Password salah ditolak.
* [ ] Logout berhasil.

### Customer

* [ ] Menu tampil.
* [ ] Detail menu tampil.
* [ ] Order berhasil.
* [ ] Total benar.
* [ ] Riwayat order tampil.

### Admin

* [ ] Dashboard tampil.
* [ ] Semua order tampil.
* [ ] Detail order tampil.
* [ ] Status dapat diubah.
* [ ] Laporan tampil.

### Security

* [ ] Customer tidak dapat membuka halaman admin.
* [ ] Admin tidak dapat menggunakan halaman customer sebagai customer.
* [ ] Halaman internal tidak dapat dibuka tanpa login.

### Responsive

* [ ] Desktop.
* [ ] Tablet.
* [ ] Smartphone.

---

# 56. DEFINITION OF DONE

Project dianggap selesai apabila:

```text
✓ Database berjalan
✓ Login berjalan
✓ Logout berjalan
✓ Role berjalan
✓ Customer dapat melihat menu
✓ Customer dapat melakukan order
✓ Order tersimpan
✓ Customer dapat melihat order
✓ Admin dapat melihat order
✓ Admin dapat mengubah status
✓ Admin dapat melihat laporan
✓ Responsive
✓ Tidak ada error pada alur utama
✓ Source code terorganisasi
✓ README tersedia
✓ Dapat dijalankan melalui local server
```

---

# 57. FITUR VERSI LANJUTAN

Setelah versi dasar selesai, project dapat dikembangkan.

Contoh:

```text
CRUD Menu
Upload Foto Menu
Kategori Menu
Pencarian Menu
Filter Order
Cetak Struk
Export PDF
Export Excel
QR Code Menu
Meja Cafe
Nomor Meja
Status Pembayaran
Dashboard Statistik
```

Tetapi fitur tersebut **tidak boleh dikerjakan sebelum sistem dasar selesai**.

---

# 58. ROADMAP PROJECT

```text
PHASE 1
Setup Project
      ↓
PHASE 2
Database
      ↓
PHASE 3
Koneksi PHP
      ↓
PHASE 4
Authentication
      ↓
PHASE 5
Customer Menu
      ↓
PHASE 6
Order
      ↓
PHASE 7
Admin
      ↓
PHASE 8
Laporan
      ↓
PHASE 9
Responsive UI
      ↓
PHASE 10
Testing
      ↓
PHASE 11
Deployment Local
      ↓
READY TO USE
```

---

# 59. KONSEP ARSITEKTUR SEDERHANA

```text
                USER
                 │
                 ▼
              BROWSER
                 │
                 ▼
             PHP NATIVE
                 │
          ┌──────┴──────┐
          │             │
       SESSION        PDO
          │             │
          │             ▼
          │           MYSQL
          │
          ▼
        HTML
          │
          ▼
       BOOTSTRAP
```

Tidak menggunakan arsitektur yang terlalu abstrak.

Tujuannya agar siswa dapat melihat hubungan setiap bagian sistem.

---

# 60. FILOSOFI PROJECT

Project ini menggunakan prinsip:

> **"Mudah dikerjakan, mudah dipahami, tetapi bukan sistem main-main."**

Siswa tidak diarahkan untuk membuat sistem dengan teknologi sebanyak mungkin.

Sebaliknya, siswa diarahkan untuk memahami fundamental:

```text
HTML
 ↓
Bootstrap
 ↓
PHP
 ↓
SQL
 ↓
MySQL
```

Kemudian memahami bagaimana semuanya bekerja sebagai satu sistem.

---

# 61. HASIL YANG DIHARAPKAN

Setelah menyelesaikan project, siswa diharapkan mampu memahami:

### Frontend

```text
Membuat halaman web
Menggunakan Bootstrap
Membuat form
Membuat tabel
Membuat card
Membuat responsive layout
```

### Backend

```text
Menerima input
Mengolah data
Menggunakan session
Membuat authentication
Membuat authorization
```

### Database

```text
Membuat database
Membuat tabel
Membuat relasi
INSERT
SELECT
UPDATE
JOIN
SUM
COUNT
```

### Programming

```text
Variable
Conditional
Loop
Function
Include
PDO
```

### Software Development

```text
Analisis
Design
Coding
Testing
Debugging
Deployment
```

---

# 62. KESIMPULAN

Taking Order Cafe merupakan sistem informasi berbasis web yang dirancang khusus agar **realistis dikerjakan oleh siswa SMK**, namun tetap menghasilkan aplikasi yang dapat digunakan.

Teknologi dibatasi pada:

```text
PHP Native
MySQL
HTML
Bootstrap
CSS sederhana
JavaScript sederhana
```

Sistem tidak mengejar kompleksitas teknologi.

Fokusnya adalah:

```text
MUDAH DIKERJAKAN
        +
MUDAH DIPAHAMI
        +
MUDAH DIKEMBANGKAN
        +
BENAR-BENAR BERFUNGSI
        =
SISTEM SIAP PAKAI
```

Versi pertama harus menyelesaikan kebutuhan utama cafe:

```text
Customer
   ↓
Login
   ↓
Lihat Menu
   ↓
Order
   ↓
Order Tersimpan
   ↓
Admin
   ↓
Kelola Order
   ↓
Laporan
```

Setelah sistem inti stabil, barulah fitur tambahan dikembangkan secara bertahap.

**Prinsip utama project:**

> Jangan membuat sistem yang terlihat canggih tetapi sulit dikerjakan siswa. Buat sistem yang sederhana, bersih, mudah dipahami, dan benar-benar dapat digunakan.
