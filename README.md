# Sistem Informasi Perpustakaan

Aplikasi web berbasis **CodeIgniter 4** yang digunakan untuk membantu pengelolaan operasional perpustakaan, mulai dari pengelolaan data buku, anggota, transaksi peminjaman, transaksi pengembalian, hingga pengelolaan koleksi digital berupa e-book.

Proyek ini dikembangkan sebagai implementasi digitalisasi proses administrasi perpustakaan yang sebelumnya masih dilakukan secara manual.

---

# 📚 Daftar Isi

* [Fitur Utama](#-fitur-utama)
* [Teknologi yang Digunakan](#-teknologi-yang-digunakan)
* [Prasyarat](#-prasyarat)
* [Required PHP Extensions](#required-php-extensions)
* [Install Git](#-install-git)
* [Konfigurasi Git](#-konfigurasi-git-recommended)
* [Clone Repository](#-clone-repository)
* [Penempatan Project Directory](#-penempatan-project-directory)
* [Install Dependency](#-install-dependency)
* [Setup Environment (.env)](#-setup-environment-env)
* [Setup Database](#-setup-database)
* [Membuat Administrator Pertama](#-membuat-administrator-pertama)
* [Menjalankan Aplikasi](#-menjalankan-aplikasi)
* [Struktur Project](#-struktur-project)
* [Penyimpanan File](#-penyimpanan-file)
* [Alur Bisnis Sistem](#-alur-bisnis-sistem)
* [Troubleshooting](#-troubleshooting)
* [Catatan](#-catatan)

---

# 🌟 Fitur Utama

Aplikasi ini menyediakan fitur-fitur berikut:

### Dashboard

* Dashboard informasi perpustakaan
* Statistik jumlah buku
* Statistik jumlah anggota
* Statistik peminjaman
* Statistik pengembalian

### Master Data

* Manajemen Administrator
* Manajemen Buku
* Manajemen Kategori Buku
* Manajemen Rak Buku
* Manajemen Anggota

### Transaksi

* Peminjaman Buku
* Pengembalian Buku
* Riwayat Peminjaman
* Riwayat Pengembalian

### Digital Library

* Upload Cover Buku
* Upload E-Book PDF
* Generate QR Code Buku

### Sistem

* Login Administrator
* Session Management
* Validasi Form
* Upload File
* Soft Delete Data

---

# 🛠️ Teknologi yang Digunakan

Stack teknologi yang digunakan dalam proyek ini:

* PHP >= 8.2
* CodeIgniter 4
* MySQL / MariaDB
* Composer
* Bootstrap
* JavaScript
* jQuery
* DataTables

---

# 📋 Prasyarat

Sebelum menjalankan proyek ini, pastikan environment development Anda sudah memiliki:

* Git
* Composer
* PHP >= 8.2
* MySQL / MariaDB
* Apache (Opsional)
* Laragon (Windows)
* XAMPP (Windows)

---

# Required PHP Extensions

Pastikan extension PHP berikut sudah aktif:

* `intl`
* `mbstring`
* `mysqli`
* `json`
* `openssl`
* `xml`
* `curl`
* `fileinfo`
* `gd`
* `zip`

### Cek Versi PHP

```bash
php -v
```

### Cek Versi Composer

```bash
composer --version
```

### Cek Versi MySQL

```bash
mysql --version
```

---

# 🚀 Install Git

Jika Git belum terinstall, install terlebih dahulu sesuai sistem operasi Anda.

---

## Cek Apakah Git Sudah Terinstall

```bash
git --version
```

Jika command di atas tidak dikenali, lanjutkan instalasi Git sesuai sistem operasi Anda.

---

## Windows

Download installer Git:

```text
https://git-scm.com/download/win
```

Jalankan installer.

Recommended setup:

* Use Git from the Windows Command Prompt
* Checkout Windows-style, commit Unix-style line endings
* Use OpenSSL Library
* Use Bundled OpenSSH

Verifikasi:

```cmd
git --version
```

---

## Ubuntu / Debian

```bash
sudo apt update
sudo apt install git -y
```

Verifikasi:

```bash
git --version
```

---

## Fedora

```bash
sudo dnf install git -y
```

Verifikasi:

```bash
git --version
```

---

## Arch Linux

```bash
sudo pacman -S git
```

Verifikasi:

```bash
git --version
```

---

## macOS

### Menggunakan Homebrew

```bash
brew install git
```

Verifikasi:

```bash
git --version
```

---

### Menggunakan Xcode Command Line Tools

```bash
xcode-select --install
```

Verifikasi:

```bash
git --version
```

---

# 🔧 Konfigurasi Git (Recommended)

Gunakan identitas GitHub Anda.

Contoh:

```bash
git config --global user.name "NamaAnda"
git config --global user.email "emailanda@example.com"
```

Verifikasi:

```bash
git config --list
```

---

# 📥 Clone Repository

## HTTPS

```bash
git clone https://github.com/alhilalakbar/perpustakaan.git
cd perpustakaan
```

## SSH

```bash
git clone git@github.com:alhilalakbar/perpustakaan.git
cd perpustakaan
```

---

# 📂 Penempatan Project Directory

Lokasi penyimpanan project tergantung environment development yang Anda gunakan.

---

## Windows — XAMPP

Direktori yang direkomendasikan:

```text
C:\xampp\htdocs\
```

Contoh:

```text
C:\xampp\htdocs\perpustakaan
```

Clone repository:

```bash
cd C:\xampp\htdocs
git clone https://github.com/alhilalakbar/perpustakaan.git
```

---

## Windows — Laragon

Direktori yang direkomendasikan:

```text
C:\laragon\www\
```

Contoh:

```text
C:\laragon\www\perpustakaan
```

Clone repository:

```bash
cd C:\laragon\www
git clone https://github.com/alhilalakbar/perpustakaan.git
```

Pastikan fitur:

```text
Auto Virtual Hosts
```

aktif.

---

## Linux

Direktori yang direkomendasikan:

```text
~/projects/
```

Contoh:

```text
/home/<username>/projects/perpustakaan
```

Clone repository:

```bash
mkdir -p ~/projects
cd ~/projects
git clone https://github.com/alhilalakbar/perpustakaan.git
```

---

## macOS

Direktori yang direkomendasikan:

```text
~/Projects/
```

Contoh:

```text
/Users/<username>/Projects/perpustakaan
```

Clone repository:

```bash
mkdir -p ~/Projects
cd ~/Projects
git clone https://github.com/alhilalakbar/perpustakaan.git
```

---

# 📦 Install Dependency

Install seluruh dependency project menggunakan Composer.

```bash
composer install
```

Tunggu hingga seluruh package berhasil diinstall.

Jika muncul error:

```text
composer command not found
```

pastikan Composer sudah terinstall dan masuk ke PATH sistem operasi Anda.

---

# ⚙️ Setup Environment (.env)

File `.env` tidak disertakan dalam repository.

CodeIgniter 4 membutuhkan file `.env`.

---

## Jika File env Tersedia

### Linux/macOS

```bash
cp env .env
```

### Windows CMD

```cmd
copy env .env
```

### Windows PowerShell

```powershell
Copy-Item env .env
```

---

## Jika File env Tidak Tersedia

### Linux/macOS

```bash
cp vendor/codeigniter4/framework/env .env
```

### Windows CMD

```cmd
copy vendor\codeigniter4\framework\env .env
```

### Windows PowerShell

```powershell
Copy-Item vendor\codeigniter4\framework\env .env
```

---

## Konfigurasi File .env

Edit file:

```text
.env
```

Cari bagian database lalu sesuaikan:

```env
CI_ENVIRONMENT = development

app.indexPage = ''
app.baseURL = 'http://localhost:8080/'

database.default.hostname = localhost
database.default.database = perpus_db
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
database.default.port = 3306
```

---

### Jika Menggunakan Laragon

```env
app.baseURL = 'http://perpustakaan.test/'
```

---

### Jika Menggunakan XAMPP

```env
app.baseURL = 'http://localhost/perpustakaan/public/'
```

---

# 🗄️ Setup Database

Pilih salah satu metode berikut:

* Opsi A: Migration
* Opsi B: SQL Backup

> Jangan jalankan kedua metode pada database yang sama.

---

## Membuat Database

Masuk ke MySQL:

```bash
mysql -u root -p
```

Buat database:

```sql
CREATE DATABASE perpus_db;
EXIT;
```

---

## Opsi A — Migration (Recommended)

Jalankan migration:

```bash
php spark migrate
```

Jika berhasil, seluruh tabel akan dibuat secara otomatis.

---

## Opsi B — Import SQL Backup

Jika ingin menggunakan backup SQL:

### Linux/macOS

```bash
mysql -u root -p perpus_db < perpus_db.sql
```

### Windows

Buka:

```text
http://localhost/phpmyadmin
```

Langkah:

1. Buat database:

```text
perpus_db
```

2. Klik tab Import
3. Pilih file:

```text
perpus_db.sql
```

4. Klik Go

---

# 👤 Membuat Administrator Pertama

Setelah migration atau import database selesai dilakukan, aplikasi belum memiliki akun administrator.

Anda harus membuat akun administrator secara manual.

---

## Generate Password Hash

Jalankan:

```bash
php -r "echo password_hash('admin123', PASSWORD_DEFAULT) . PHP_EOL;"
```

Contoh output:

```text
$2y$10$XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
```

Salin hasil hash tersebut.

---

## Masuk ke Database

```bash
mysql -u root -p
```

Pilih database:

```sql
USE perpus_db;
```

---

## Tambahkan Administrator

Ganti:

```text
PASTE_HASH_DI_SINI
```

dengan hash yang dihasilkan sebelumnya.

```sql
INSERT INTO tbl_admin (
    id_admin,
    nama_admin,
    username_admin,
    password_admin,
    akses_level,
    is_delete_admin,
    created_at,
    updated_at
)
VALUES (
    'ADM001',
    'Administrator',
    'admin',
    'PASTE_HASH_DI_SINI',
    '1',
    '0',
    NOW(),
    NOW()
);
```

---

## Login

Gunakan:

```text
Username : admin
Password : admin123
```

Disarankan mengganti password setelah login pertama.

---

# 🖥️ Menjalankan Aplikasi

Berikut beberapa opsi menjalankan aplikasi.

---

## Opsi 1 — CodeIgniter Development Server (Recommended)

Jalankan:

```bash
php spark serve
```

Jika berhasil:

```text
CodeIgniter development server started on http://localhost:8080
```

Akses:

```text
http://localhost:8080
```

---

## Opsi 2 — XAMPP

Pastikan:

* Apache aktif
* MySQL aktif

Jika project berada di:

```text
C:\xampp\htdocs\perpustakaan
```

akses:

```text
http://localhost/perpustakaan/public
```

---

## Opsi 3 — Laragon

Pastikan:

* Apache aktif
* MySQL aktif
* Auto Virtual Hosts aktif

Jika project berada di:

```text
C:\laragon\www\perpustakaan
```

akses:

```text
http://perpustakaan.test
```

---

# 📁 Struktur Project

```text
app/
├── Config/
├── Controllers/
├── Database/
│   ├── Migrations/
│   └── Seeds/
├── Models/
│   ├── M_Admin.php
│   ├── M_Anggota.php
│   ├── M_Buku.php
│   ├── M_Dashboard.php
│   ├── M_Kategori.php
│   ├── M_Peminjaman.php
│   ├── M_Pengembalian.php
│   └── M_Rak.php
└── Views/

public/
├── Assets/
│   ├── CoverBuku/
│   ├── E-Book/
│   └── qr_code/

vendor/
writable/

composer.json
spark
README.md
```

---

# 📂 Penyimpanan File

## Cover Buku

Disimpan pada:

```text
public/Assets/CoverBuku/
```

---

## E-Book

Disimpan pada:

```text
public/Assets/E-Book/
```

---

## QR Code

Disimpan pada:

```text
public/Assets/qr_code/
```

---

# 🔄 Alur Bisnis Sistem

## Peminjaman Buku

1. Administrator memilih anggota.
2. Administrator memilih buku.
3. Sistem memeriksa stok buku.
4. Sistem menyimpan transaksi peminjaman.
5. Stok buku berkurang.
6. Riwayat transaksi diperbarui.

---

## Pengembalian Buku

1. Administrator memilih transaksi peminjaman.
2. Sistem memverifikasi transaksi.
3. Sistem menyelesaikan transaksi pengembalian.
4. Stok buku bertambah.
5. Riwayat transaksi diperbarui.

---

# 🔧 Troubleshooting

## Composer Error

Jalankan:

```bash
composer install
```

---

## Vendor Not Found

Jalankan:

```bash
composer install
```

---

## Database Connection Error

Periksa konfigurasi:

```env
database.default.database = perpus_db
database.default.username = root
database.default.password =
```

Pastikan:

* Database sudah dibuat
* MySQL berjalan
* Username benar
* Password benar

---

## Migration Gagal

Pastikan:

```bash
php -v
mysql --version
```

berjalan normal.

---

## Command PHP Tidak Dikenali

Windows:

```cmd
C:\xampp\php\php.exe spark serve
```

atau tambahkan PHP ke Environment Variable PATH.

---

## Folder Writable Tidak Bisa Ditulis

Linux/macOS:

```bash
chmod -R 775 writable
```

atau:

```bash
sudo chown -R $USER:www-data writable
```

---

## Base URL Invalid

Contoh benar:

```env
app.baseURL = 'http://localhost:8080/'
```

Contoh salah:

```env
app.baseURL = 'http//localhost:8080/'
```

---

## Cache Bermasalah

Clear cache:

```bash
php spark cache:clear
```

Linux/macOS:

```bash
rm -rf writable/cache/*
```

Windows:

```cmd
del /q writable\cache\*
```

---

## Error 500

Pastikan:

```env
CI_ENVIRONMENT = development
```

Kemudian refresh halaman dan baca pesan error yang muncul.

---

# 📝 Catatan

* Project menggunakan CodeIgniter 4
* File `.env` tidak disertakan dalam repository
* Jangan commit `.env` ke repository publik
* Jangan membagikan credential database
* Backup database secara berkala
* Sistem tidak menyediakan seeder administrator
* Administrator pertama harus dibuat secara manual melalui database
* Migration dan SQL backup dapat digunakan sebagai alternatif setup database

---

# 📄 Lisensi

Proyek ini dikembangkan untuk kebutuhan pembelajaran, penelitian, dan implementasi sistem informasi perpustakaan.
