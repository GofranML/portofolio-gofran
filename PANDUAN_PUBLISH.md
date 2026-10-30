# PANDUAN DEPLOY & PUBLISH — PORTOFOLIO GOFRAN MUTTAQI LIKHAN
## Precision Telemetry & Architectural Monograph (Production Release)

Paket ini telah disiapkan dalam kondisi **siap publish (ready-to-deploy)** lengkap dengan basis data MySQL, seluruh dependensi, aset visual teroptimasi, metadata SEO, PWA readiness, dan skema data terstruktur JSON-LD.

Untuk panduan teknis mendalam mengenai arsitektur web server, Nginx, cPanel, Vercel, dan prosedur *smoke test*, silakan baca juga:
👉 **[DEPLOYMENT_GUIDE.md](./DEPLOYMENT_GUIDE.md)**

---

## 📁 Struktur Paket Rilis

- **`laravel_portfolio.sql`**: Dump basis data MySQL lengkap dengan skema tabel dan seluruh data tervalidasi (Agents, Resources, Events riwayat kerja & sertifikasi, serta relasi REA).
- **`app/`, `bootstrap/`, `config/`, `database/`, `resources/`, `routes/`**: Source code inti aplikasi Laravel 12.
- **`public/`**:
  - `css/` & `js/`: Asset bundle mandiri (termasuk *telemetry reticle cursor*, *audio feedback*, *dual-theme engine*, dan *bilingual switcher*).
  - `images/`: Aset gambar multi-format (AVIF modern, WebP fallback, SVG crisp) yang sudah teroptimasi tanpa layout shift.
  - `og-image.png` & `og-image.webp`: Banner Open Graph 1200×630 beridentitas *Carbon Telemetry Deck*.
  - `manifest.webmanifest` & `sw.js`: Berkas Progressive Web App (PWA) dan Service Worker aman.
  - `sitemap.xml` & `robots.txt`: Konfigurasi SEO dan pengindeksan mesin pencari.
- **`vendor/`**: Seluruh dependensi PHP (Composer) sudah disertakan dan teroptimasi (`--optimize-autoloader`).
- **`.env` & `.env.example`**: Konfigurasi environment siap pakai.
- **`vercel.json` & `api/index.php`**: Konfigurasi deployment serverless jika ingin dirilis melalui Vercel.

---

## 🚀 Langkah Cepat Menjalankan & Deploy

### Opsi 1: Menjalankan di Komputer Lokal (XAMPP / Laragon / PHP Built-in)

1. **Import Database ke MySQL**:
   - Buka **phpMyAdmin** (`http://localhost/phpmyadmin`) atau terminal MySQL.
   - Buat database baru bernama `laravel_portfolio`.
   - Pilih tab **Import**, pilih berkas `laravel_portfolio.sql`, lalu klik **Import / Go**.

2. **Periksa Konfigurasi `.env`**:
   Pastikan baris berikut sesuai dengan konfigurasi server MySQL lokal Anda:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=laravel_portfolio
   DB_USERNAME=root
   DB_PASSWORD=
   ```

3. **Jalankan Aplikasi**:
   Buka terminal di folder proyek ini, lalu jalankan:
   ```bash
   php artisan serve
   ```
   Buka peramban di: `http://localhost:8000` atau `http://127.0.0.1:8000`.

---

### Opsi 2: Deploy ke Web Hosting (cPanel / Shared Hosting)

1. Unggah seluruh file ke hosting Anda. Demi keamanan, tempatkan folder inti di luar folder `public_html` (misal di folder `laravel_core`), lalu pindahkan isi folder `public/` ke dalam `public_html`.
2. Buat basis data MySQL dan user baru di cPanel (**MySQL Databases**), lalu tautkan user dengan hak akses penuh (*ALL PRIVILEGES*).
3. Buka **phpMyAdmin** di cPanel, pilih basis data baru, lalu import berkas `laravel_portfolio.sql`.
4. Sesuaikan konfigurasi file `.env`:
   ```env
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://domain-anda.com

   DB_CONNECTION=mysql
   DB_HOST=localhost
   DB_PORT=3306
   DB_DATABASE=nama_database_cpanel
   DB_USERNAME=nama_user_cpanel
   DB_PASSWORD=password_user_cpanel
   ```
5. Sesuaikan path pada `public_html/index.php` agar mengarah ke `laravel_core/vendor/autoload.php` dan `laravel_core/bootstrap/app.php`.

---

### Opsi 3: Deploy ke VPS Linux (Nginx) atau Cloud Serverless (Vercel)

Silakan merujuk ke panduan komprehensif pada **[DEPLOYMENT_GUIDE.md](./DEPLOYMENT_GUIDE.md)** untuk:
- Konfigurasi blok `server` Nginx dengan HTTP/2, SSL Let's Encrypt, dan Security Headers.
- Konfigurasi Vercel Serverless melalui `vercel.json`.
- 15 poin *Post-Deployment Smoke Test Checklist*.
- Prosedur mitigasi insiden dan *Rollback*.

---

## 🌟 Fitur Utama Portofolio (Visual Direction #01)

1. **Precision Telemetry & Architectural Monograph**:
   - Tipografi terstruktur (*Space Grotesk*, *Newsreader*, *JetBrains Mono*).
   - Skema warna presisi: *Dark Carbon* (`#090B0E`) dan *Light Drafting Paper* (`#F4EFE6`).
2. **Dual-Theme & Bilingual System**:
   - Dukungan Bahasa Indonesia (ID) dan Bahasa Inggris (EN) secara *real-time*.
   - Sinkronisasi instan terhadap atribut aksesibilitas, label, dan metadata Open Graph.
3. **Advanced Micro-Interactions**:
   - *Custom Telemetry Reticle Cursor* khusus perangkat desktop dengan *spring physics* halus.
   - *Project Dossier Modal Lightbox* untuk pratinjau multi-layar proyek PolluTrack dengan kontrol keyboard (panah & ESC).
   - Audio feedback telemetry terkurasi (default bisu/mute dan wajib diaktifkan eksplisit).
4. **Optimasi Aset & Core Web Vitals**:
   - Format modern AVIF dengan WebP dan PNG fallback.
   - Hero portrait prioritas tinggi (`fetchpriority="high"`) dan zero layout shift.
5. **SEO & Data Terstruktur Kelas Produksi**:
   - Metadata Open Graph 1200×630 kustom.
   - Skema JSON-LD RFC 8259 mencakup `Person`, `WebSite`, dan `ProfilePage`.
   - Web App Manifest (PWA) dan Service Worker aman.
