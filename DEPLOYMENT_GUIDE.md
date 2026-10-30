# PANDUAN DEPLOYMENT & RILIS PRODUKSI (PRODUCTION DEPLOYMENT GUIDE)
## Portofolio Profesional Gofran Muttaqi Likhan — Precision Telemetry & Architectural Monograph

Dokumen ini merupakan panduan resmi arsitektur deployment, konfigurasi environment, instalasi dependensi, migrasi basis data, verifikasi pasca-rilis (*smoke testing*), dan prosedur *rollback* untuk website portofolio profesional **Gofran Muttaqi Likhan**.

---

### 1. Ringkasan Arsitektur & Karakteristik Sistem

| Parameter | Spesifikasi Produksi |
| :--- | :--- |
| **Framework** | Laravel 12.x (Arsitektur Model-View-Controller & REA) |
| **PHP Runtime** | PHP 8.2 atau PHP 8.3 (64-bit direkomendasikan) |
| **Visual Direction** | Direction #01: *Precision Telemetry & Architectural Monograph* |
| **Dual-Theme Engine** | Dark Carbon (`#090B0E`) & Light Drafting Paper (`#F4EFE6`) |
| **Sistem Bahasa** | Bilingual ID / EN (Server-rendered default + Client-side state toggle) |
| **Aset & Bundling** | CSS, JavaScript murni, AVIF / WebP / SVG / PNG siap pakai (tidak memerlukan build step saat rilis) |
| **Basis Data** | Relational REA (*Resources, Events, Agents*) pada MySQL 8.0+ / MariaDB 10.4+ (atau SQLite 3.35+) |
| **PWA & Offline** | Web App Manifest, App Icons (192, 512, maskable), minimal Service Worker (`sw.js`) |
| **SEO & Open Graph** | Schema JSON-LD RFC 8259, Sitemap XML, Robots.txt, Open Graph 1200×630 |

---

### 2. Persyaratan Server (Server Requirements)

#### A. Versi PHP & Ekstensi Wajib
Pastikan PHP CLI dan PHP-FPM / Web Handler memenuhi persyaratan berikut:
- **PHP >= 8.2.0**
- Ekstensi PHP yang wajib aktif:
  - `pdo` & `pdo_mysql` (atau `pdo_sqlite` jika menggunakan SQLite)
  - `openssl` (enkripsi token & sesi)
  - `mbstring` (pemrosesan string multibyte/lokalisasi)
  - `tokenizer` (kompilasi Blade templates)
  - `xml` & `dom` (parsing XML sitemap & manifest)
  - `ctype` & `json` (serialisasi data JSON-LD & REST API)
  - `bcmath` (kalkulasi numerik presisi)
  - `fileinfo` (deteksi MIME type aset statis)
  - `curl` (komunikasi jaringan HTTP)

#### B. Konfigurasi `php.ini` yang Direkomendasikan
```ini
memory_limit = 256M
upload_max_filesize = 16M
post_max_size = 16M
max_execution_time = 60
date.timezone = Asia/Jakarta
expose_php = Off
```

#### C. Web Server yang Didukung
1. **Nginx** (Sangat direkomendasikan untuk performa tinggi & HTTP/2 / HTTP/3).
2. **Apache 2.4+** (dengan modul `mod_rewrite`, `mod_headers`, dan `mod_expires` aktif).
3. **Vercel Serverless** (menggunakan runtime `vercel-php@0.7.4` melalui `vercel.json`).

---

### 3. Konfigurasi Environment (`.env`)

Salin template konfigurasi dari `.env.example` ke `.env`:
```bash
cp .env.example .env
```

Sesuaikan parameter produksi berikut:

```env
APP_NAME="Gofran Muttaqi Likhan Portfolio"
APP_ENV=production
APP_KEY=base64:GENERATE_DENGAN_ARTISAN_KEY_GENERATE
APP_DEBUG=false
APP_URL=https://portofolio-gofran.vercel.app

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=error

# Konfigurasi Database (MySQL / MariaDB)
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database_produksi
DB_USERNAME=nama_pengguna_produksi
DB_PASSWORD=kata_sandi_rahasia_dan_kuat

# Driver Sesi & Cache
SESSION_DRIVER=cookie
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

CACHE_STORE=array
QUEUE_CONNECTION=sync

# Email & Kontak Form (Opsional jika form inquiry dikirimkan via log/db)
MAIL_MAILER=log
```

> [!CRITICAL]
> **Peringatan Keamanan `.env`**:
> - Pastikan `APP_DEBUG=false` di lingkungan publik untuk mencegah kebocoran *stack trace* dan konfigurasi internal.
> - Tetapkan hak akses file ketat pada file `.env` di server: `chmod 600 .env` atau `chmod 640 .env`.
> - Jangan pernah menambahkan file `.env` ke dalam *version control* publik (*git*).

---

### 4. Build & Instalasi Dependensi

Paket distribusi di repositori `laravel_portfolio_publish` telah menyertakan dependensi teroptimasi di direktori `vendor/`. Namun, jika Anda melakukan instalasi mandiri dari repositori mentah:

1. **Instalasi Composer (Produksi)**:
   ```bash
   composer install --no-dev --optimize-autoloader --no-interaction
   ```

2. **Generate Application Key** (jika belum ada):
   ```bash
   php artisan key:generate --force
   ```

3. **Optimasi Cache Laravel**:
   Jalankan perintah berikut untuk mempercepat *booting* aplikasi:
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   php artisan event:cache
   ```

4. **Izin Direktori (*Directory Permissions*)**:
   Pastikan web server user (`www-data` pada Ubuntu/Nginx, atau user cPanel) memiliki hak tulis:
   ```bash
   chmod -R 775 storage bootstrap/cache
   chown -R www-data:www-data storage bootstrap/cache
   ```

---

### 5. Database & Migration Requirements

Aplikasi menggunakan skema relasional REA (*Resources, Events, Agents*) serta tabel `inquiries` untuk formulir kontak.

#### Pilihan A: Menggunakan SQL Dump Resmi (Paling Cepat & Lengkap)
File `laravel_portfolio.sql` di root direktori telah terisi seluruh relasi data tervalidasi:
```bash
mysql -u nama_pengguna_produksi -p nama_database_produksi < laravel_portfolio.sql
```

#### Pilihan B: Menggunakan Laravel Artisan Migration & Seeder
Jika menggunakan alur migrasi otomatis:
```bash
php artisan migrate --force
php artisan db:seed --class=ReaPortfolioSeeder --force
```

Tabel yang wajib terisi:
- `rea_agents` (Identitas & profil)
- `rea_resources` (Proyek, keahlian, artefak, metrik)
- `rea_events` (Riwayat kerja, sertifikasi, pendidikan)
- `rea_resource_events` (Relasi tabel perantara)
- `inquiries` (Penyimpanan data kontak)

---

### 6. Panduan Deployment Langkah-demi-Langkah

#### Opsi A: Deployment ke Shared Hosting / cPanel

1. **Pemisahan File Demi Keamanan**:
   - Letakkan folder aplikasi Laravel (`app`, `bootstrap`, `config`, `database`, `resources`, `routes`, `vendor`, `.env`) di luar root web publik, misalnya di `/home/username/laravel_core`.
   - Salin seluruh isi folder `public/` ke dalam direktori publik cPanel (`/home/username/public_html` atau subdomain).
2. **Penyesuaian `public_html/index.php`**:
   Ubah path *autoload* dan *bootstrap* pada file `index.php` di dalam `public_html`:
   ```php
   require __DIR__.'/../laravel_core/vendor/autoload.php';
   $app = require_once __DIR__.'/../laravel_core/bootstrap/app.php';
   ```
3. **Konfigurasi Database cPanel**:
   - Buat database MySQL dan user baru di menu **MySQL Databases**.
   - Berikan hak akses penuh (*All Privileges*).
   - Masuk ke **phpMyAdmin**, pilih database tersebut, lalu klik tab **Import** dan unggah file `laravel_portfolio.sql`.
4. **Verifikasi `.htaccess`**:
   Pastikan file `.htaccess` bawaan Laravel aktif di `public_html` untuk menangani *URL rewriting*.

---

#### Opsi B: Deployment ke Linux VPS (Ubuntu 22.04 / 24.04 + Nginx + PHP-FPM)

1. **Kloning atau Unggah Berkas**:
   ```bash
   cd /var/www
   git clone <URL_REPO> portfolio
   cd portfolio
   cp .env.example .env
   # Edit .env dengan kredensial database
   nano .env
   ```

2. **Set Hak Akses**:
   ```bash
   sudo chown -R www-data:www-data /var/www/portfolio
   sudo find /var/www/portfolio -type f -exec chmod 644 {} \;
   sudo find /var/www/portfolio -type d -exec chmod 755 {} \;
   sudo chmod -R 775 /var/www/portfolio/storage /var/www/portfolio/bootstrap/cache
   ```

3. **Konfigurasi Nginx (`/etc/nginx/sites-available/portfolio`)**:
   ```nginx
   server {
       listen 80;
       server_name portofolio.example.com; # Ganti dengan domain Anda
       return 301 https://$host$request_uri;
   }

   server {
       listen 443 ssl http2;
       server_name portofolio.example.com; # Ganti dengan domain Anda

       root /var/www/portfolio/public;
       index index.php index.html;

       ssl_certificate /etc/letsencrypt/live/portofolio.example.com/fullchain.pem;
       ssl_certificate_key /etc/letsencrypt/live/portofolio.example.com/privkey.pem;

       # Security Headers
       add_header X-Frame-Options "SAMEORIGIN" always;
       add_header X-Content-Type-Options "nosniff" always;
       add_header X-XSS-Protection "1; mode=block" always;
       add_header Referrer-Policy "strict-origin-when-cross-origin" always;
       add_header Content-Security-Policy "default-src 'self' 'unsafe-inline' 'unsafe-eval' data: blob: https://fonts.googleapis.com https://fonts.gstatic.com;" always;

       charset utf-8;

       location / {
           try_files $uri $uri/ /index.php?$query_string;
       }

       # Cache Aset Statis Berperforma Tinggi
       location ~* \.(css|js|jpg|jpeg|png|gif|ico|svg|webp|avif|woff|woff2|ttf|otf|webmanifest)$ {
           expires 365d;
           add_header Cache-Control "public, no-transform, immutable";
           access_log off;
           try_files $uri =404;
       }

       # Service Worker & Manifest No-Cache Policy
       location ~* (sw\.js|manifest\.webmanifest|manifest\.json)$ {
           expires 0;
           add_header Cache-Control "no-cache, no-store, must-revalidate";
           try_files $uri =404;
       }

       location = /favicon.ico { access_log off; log_not_found off; }
       location = /robots.txt  { access_log off; log_not_found off; }

       error_page 404 /index.php;

       location ~ \.php$ {
           fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
           fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
           include fastcgi_params;
           fastcgi_hide_header X-Powered-By;
       }

       location ~ /\.(?!well-known).* {
           deny all;
       }
   }
   ```

4. **Aktifkan Virtual Host & Reload Nginx**:
   ```bash
   sudo ln -s /etc/nginx/sites-available/portfolio /etc/nginx/sites-enabled/
   sudo nginx -t
   sudo systemctl reload nginx
   ```

---

#### Opsi C: Deployment ke Serverless Platform (Vercel)

1. Paket ini telah dilengkapi konfigurasi khusus:
   - `vercel.json`: Mengatur routing berkas statis (`/public/$1`) dan meneruskan request dinamis ke `api/index.php`.
   - `api/index.php`: Entrypoint jembatan serverless menuju `public/index.php`.
2. Pada dashboard Vercel:
   - Hubungkan repositori GitHub/GitLab.
   - Atur **Environment Variables** di Settings -> Environment Variables:
     - `APP_ENV=production`
     - `APP_KEY=base64:...`
     - `APP_DEBUG=false`
     - `APP_URL=https://<domain-anda>.vercel.app`
     - `DB_CONNECTION=mysql`
     - `DB_HOST=<remote-db-host>`
     - `DB_DATABASE=<remote-db-name>`
     - `DB_USERNAME=<remote-db-user>`
     - `DB_PASSWORD=<remote-db-pass>`
3. Deploy otomatis akan berjalan saat *push* ke branch produksi.

---

### 7. Verifikasi Pasca-Deployment (*Smoke Test Checklist*)

Setelah deployment selesai, lakukan audit 15 poin berikut secara mandiri menggunakan browser dan cURL:

- [ ] **1. HTTP Status & Rendering**: Akses `GET /` mengembalikan HTTP `200 OK` dan konten utama dirender lengkap tanpa template error.
- [ ] **2. Canonical URL & Metadata**: Tag `<link rel="canonical" href="...">` sesuai domain produksi.
- [ ] **3. Open Graph Image**: Akses `GET /og-image.png` menghasilkan gambar beresolusi 1200×630 berdesain *Carbon Telemetry Deck*.
- [ ] **4. PWA Webmanifest**: Akses `GET /manifest.webmanifest` mengembalikan JSON valid bertipe `application/manifest+json`.
- [ ] **5. Service Worker**: Akses `GET /sw.js` mengembalikan berkas JavaScript aktif dan console browser mengonfirmasi registrasi sukses.
- [ ] **6. Sitemap XML**: Akses `GET /sitemap.xml` mengembalikan XML valid dengan header `Content-Type: application/xml`.
- [ ] **7. Robots TXT**: Akses `GET /robots.txt` melarang crawling pada `/api/` dan `/inquiry`, serta mengarah ke sitemap.
- [ ] **8. REST API REA**: Akses `GET /api/rea-graph` mengembalikan JSON valid berisi simpul agen, sumber daya, dan riwayat.
- [ ] **9. Form Inquiry**: Pengujian `POST /inquiry` dengan data dummy sukses tervalidasi dan mengembalikan status sukses (atau redirect flash).
- [ ] **10. Dual-Theme Toggle**: Pengalihan tema *Dark Carbon* <-> *Light Drafting Paper* berfungsi mulus dan status tersimpan di `localStorage`.
- [ ] **11. Bilingual Language Switcher**: Pengalihan bahasa *ID* <-> *EN* mengubah teks antarmuka seketika tanpa *layout broken*.
- [ ] **12. Telemetry Reticle Cursor**: Kursor custom telemetry aktif pada perangkat pointer mouse dan nonaktif pada layar sentuh.
- [ ] **13. Project Dossier Modal**: Klik thumbnail kartu proyek membuka lightbox modal pratinjau resolusi penuh dengan navigasi panah & keyboard ESC.
- [ ] **14. Zero Console Errors**: Tidak ada pesan error JavaScript atau warning pada Console Chrome DevTools.
- [ ] **15. Responsive Layout**: Tidak terjadi *horizontal overflow* (scroll samping) pada viewport 375px, 768px, 1280px, maupun 1440px.

---

### 8. Prosedur Rollback (*Incident Mitigation*)

Jika ditemukan kegagalan sistem kritis pasca-rilis:

1. **Aktifkan Maintenance Mode Segera**:
   ```bash
   php artisan down --secret="emergency-bypass-key"
   ```
   *(Tim internal dapat mengakses website via `https://domain.com/emergency-bypass-key`)*.

2. **Kembalikan Versi Rilis Sebelumnya (*Rollback Code*)**:
   - Jika menggunakan symlink (seperti Envoyer/Capistrano): Arahkan symlink `current` ke rilis sebelumnya.
   - Jika menggunakan Git langsung:
     ```bash
     git reset --hard HEAD~1
     ```

3. **Restorasi Basis Data (Jika Terjadi Kerusakan Data)**:
   ```bash
   mysql -u nama_pengguna_produksi -p nama_database_produksi < backup_sebelum_rilis.sql
   ```

4. **Bersihkan & Rebuild Cache**:
   ```bash
   php artisan optimize:clear
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

5. **Nonaktifkan Maintenance Mode**:
   ```bash
   php artisan up
   ```
