# Sistem Informasi Perpustakaan

Aplikasi Sistem Informasi Perpustakaan berbasis **CodeIgniter 4** untuk pengelolaan data perpustakaan.

## Teknologi yang Digunakan

- PHP 8.2+
- CodeIgniter 4
- MySQL / MariaDB
- Apache
- Bootstrap
- JavaScript
- Composer

---

# Instalasi

Clone repository:

```bash
git clone git@github.com:alhilalakbar/perpustakaan.git
cd perpustakaan
```

Install dependency:

```bash
composer install
```

Buat file environment:

```bash
cp .env.exampe .env
```

Edit `.env`:

```env
CI_ENVIRONMENT = development
app.indexPage = ''

database.default.hostname = localhost
database.default.database = perpus_db
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
database.default.port = 3306
```

---

# Setup Database

Project ini menggunakan file SQL manual.

Buat database:

```sql
CREATE DATABASE perpus_db;
```

Import database:

Linux:

```bash
mysql -u root -p perpus_db < perpus_db.sql
```

Windows (XAMPP):

Import melalui **phpMyAdmin**:

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

# Menjalankan Project

## Opsi 1 — Windows (XAMPP)

Copy project ke:

```text
C:\xampp\htdocs\perpustakaan
```

Start:

- Apache
- MySQL

Edit `.env`:

```env
app.baseURL = 'http://localhost/perpustakaan/public/'
```

Akses:

```text
http://localhost/perpustakaan/public
```

### Optional: Virtual Host (URL lebih bersih)

Apache `httpd-vhosts.conf`:

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

## Opsi 2 — Linux Native (Apache + systemctl)

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
sudo git clone git@github.com:alhilalakbar/perpustakaan.git
```

Set permission:

```bash
sudo chown -R $USER:$USER /var/www/perpustakaan
cd /var/www/perpustakaan
chmod -R 775 writable
```

Install dependency:

```bash
composer install
```

Buat `.env`:

```bash
cp env .env
```

Edit `.env`:

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

Import:

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

## Opsi 3 — Development Server

Untuk testing cepat:

```bash
php spark serve
```

Akses:

```text
http://localhost:8080
```

---

# Struktur Project

```text
app/
public/
vendor/
writable/
perpus_db.sql
```

---

# Troubleshooting

## Error vendor not found

```bash
composer install
```

---

## Error database connection

Pastikan `.env`:

```env
database.default.database = perpus_db
database.default.username = root
database.default.password =
```

---

## URL masih ada index.php

Pastikan:

```env
app.indexPage = ''
```

dan Apache rewrite aktif.

---

# Catatan

Project ini menggunakan import database manual melalui file:

```text
perpus_db.sql
```

bukan migration otomatis.
