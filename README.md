# Sistem Informasi Perpustakaan

Sistem Informasi Perpustakaan berbasis **CodeIgniter 4** untuk pengelolaan data buku, anggota, transaksi peminjaman, pengembalian, dan administrasi perpustakaan.

## Teknologi yang Digunakan

- PHP 8.2+
- CodeIgniter 4
- MySQL / MariaDB
- Apache
- Bootstrap
- JavaScript
- Composer

---

## Instalasi

Clone repository:

```bash
git clone https://github.com/alhilalakbar/perpustakaan.git
cd perpustakaan
```

Install dependency:

```bash
composer install
```

Buat file environment:

```bash
cp env .env
```

Edit file `.env`:

```env
CI_ENVIRONMENT = development
app.indexPage = ''
app.baseURL = ''

database.default.hostname = localhost
database.default.database = perpus_db
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
database.default.port = 3306
```

Sesuaikan `app.baseURL` jika environment Anda memerlukannya.

---

## Setup Database

Buat database:

```sql
CREATE DATABASE perpus_db;
```

Import database:

### Linux / macOS

```bash
mysql -u root -p perpus_db < perpus_db.sql
```

### Windows (XAMPP / Laragon)

Gunakan **phpMyAdmin**:

1. Buka:

```text
http://localhost/phpmyadmin
```

2. Buat database:

```text
perpus_db
```

3. Klik tab **Import**
4. Pilih file:

```text
perpus_db.sql
```

5. Klik **Go**

---

## Menjalankan Project

### Opsi 1 — Development Server (Paling Cepat)

Pastikan `.env` sudah dikonfigurasi.

Jalankan:

```bash
php spark serve
```

Akses:

```text
http://localhost:8080
```

---

### Opsi 2 — Windows (XAMPP)

Copy project ke:

```text
C:\xampp\htdocs\perpustakaan
```

Start service:

- Apache
- MySQL

Jika diperlukan, edit `.env`:

```env
app.baseURL = 'http://localhost/perpustakaan/public/'
```

Akses:

```text
http://localhost/perpustakaan/public
```

#### Optional: Virtual Host (URL Lebih Bersih)

Edit file Apache:

```text
C:\xampp\apache\conf\extra\httpd-vhosts.conf
```

Tambahkan:

```apache
<VirtualHost *:80>
    ServerName perpustakaan.test
    DocumentRoot "C:/xampp/htdocs/perpustakaan/public"

    <Directory "C:/xampp/htdocs/perpustakaan/public">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

Edit hosts:

```text
C:\Windows\System32\drivers\etc\hosts
```

Tambahkan:

```text
127.0.0.1 perpustakaan.test
```

Edit `.env`:

```env
app.baseURL = 'http://perpustakaan.test/'
```

Restart Apache.

Akses:

```text
http://perpustakaan.test
```

---

### Opsi 3 — Linux Native (Apache)

Install dependency:

```bash
sudo apt update
sudo apt install apache2 mysql-server php php-mysql php-intl php-mbstring composer libapache2-mod-php unzip
```

Aktifkan rewrite:

```bash
sudo a2enmod rewrite
sudo systemctl restart apache2
```

Clone project:

```bash
cd /var/www
sudo git clone https://github.com/alhilalakbar/perpustakaan.git
```

Set permission:

```bash
sudo chown -R $USER:www-data /var/www/perpustakaan
cd /var/www/perpustakaan
sudo chmod -R 775 writable
```

Install dependency:

```bash
composer install
```

Buat file environment:

```bash
cp env .env
```

Edit `.env` jika diperlukan:

```env
app.baseURL = 'http://perpustakaan.test/'
```

Setup database:

```bash
mysql -u root -p
```

```sql
CREATE DATABASE perpus_db;
EXIT;
```

Import database:

```bash
mysql -u root -p perpus_db < perpus_db.sql
```

Buat virtual host:

```bash
sudo nano /etc/apache2/sites-available/perpustakaan.conf
```

Isi:

```apache
<VirtualHost *:80>
    ServerName perpustakaan.test
    DocumentRoot /var/www/perpustakaan/public

    <Directory /var/www/perpustakaan/public>
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

Enable site:

```bash
sudo a2ensite perpustakaan.conf
sudo systemctl restart apache2
```

Edit hosts:

```bash
sudo nano /etc/hosts
```

Tambahkan:

```text
127.0.0.1 perpustakaan.test
```

Akses:

```text
http://perpustakaan.test
```

---

## Struktur Project

```text
app/
public/
vendor/
writable/
perpus_db.sql
env
README.md
```

---

## Troubleshooting

### Error vendor not found

Jalankan:

```bash
composer install
```

---

### Error database connection

Pastikan konfigurasi database di `.env` sesuai:

```env
database.default.hostname = localhost
database.default.database = perpus_db
database.default.username = root
database.default.password =
```

---

### URL masih menampilkan index.php

Pastikan:

```env
app.indexPage = ''
```

dan Apache rewrite sudah aktif.

---

### Permission denied pada folder writable

Jalankan:

```bash
sudo chmod -R 775 writable
```

atau:

```bash
sudo chown -R www-data:www-data writable
```

---

## Catatan

Project ini menggunakan setup database manual melalui file:

```text
perpus_db.sql
```

dan **tidak menggunakan migration otomatis**.

Pastikan file `.env` tidak ikut di-push ke repository karena berisi konfigurasi environment lokal.
