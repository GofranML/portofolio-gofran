# PANDUAN DEPLOY & PUBLISH — PORTOFOLIO GOFRAN MUTTAQI LIKHAN

Paket ini sudah disiapkan dalam kondisi **siap publish (ready-to-deploy)** lengkap beserta database MySQL.

---

## 📁 Struktur Paket

- **`laravel_portfolio.sql`**: Dump database MySQL lengkap dengan skema tabel dan seluruh data (7 Agents, 48 Resources termasuk proyek Air Quality Mapping & Toyota AI, 5 Events riwayat kerja, dan relasi REA).
- **`app/`, `bootstrap/`, `config/`, `database/`, `public/`, `resources/`, `routes/`**: Source code inti aplikasi Laravel 12.
- **`public/images/pollutrack/`**: Aset screenshot hasil proyek PolluTrack (Dashboard Admin, Dashboard Publik, Login Admin).
- **`vendor/`**: Seluruh dependensi PHP (Composer) sudah disertakan sehingga dapat langsung dijalankan tanpa perlu koneksi internet untuk `composer install`.
- **`.env` & `.env.example`**: Konfigurasi environment siap pakai dengan `APP_KEY` yang sudah ter-generate.

---

## 🚀 Langkah Deploy & Menjalankan

### Opsi A: Menggunakan Local Server (XAMPP / Laragon / Native PHP & MySQL)

1. **Import Database ke MySQL**:
   - Buka **phpMyAdmin** (`http://localhost/phpmyadmin`) atau terminal MySQL.
   - Buat database baru bernama `laravel_portfolio`.
   - Pilih tab **Import**, lalu pilih file `laravel_portfolio.sql` yang ada di root folder ini.
   - Klik **Go / Kirim** hingga import selesai.

2. **Periksa Konfigurasi `.env`**:
   Buka file `.env` dan pastikan konfigurasi MySQL sesuai dengan server lokal Anda:
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
   Buka browser di: `http://localhost:8000` atau `http://127.0.0.1:8000`.

---

### Opsi B: Deploy ke Web Hosting (cPanel / Shared Hosting)

1. Upload seluruh file dari file zip ini ke folder hosting Anda (biasanya `public_html` atau folder domain).
2. Buat database MySQL baru melalui cPanel (**MySQL Databases**).
3. Buat user database dan hubungkan user tersebut ke database dengan hak akses penuh (*ALL PRIVILEGES*).
4. Buka **phpMyAdmin** di cPanel, pilih database yang baru dibuat, lalu import file `laravel_portfolio.sql`.
5. Sesuaikan file `.env` di hosting:
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
6. Pastikan *Document Root* web server mengarah ke subfolder `public` atau gunakan `.htaccess` redirect standar cPanel.

---

## 🌟 Fitur Unggulan yang Tersedia

1. **Pratinjau Proyek Hyper-Local Air Quality Mapping**:
   - Tombol **"Lihat Hasil Proyek (3 Layar)"** dan kartu mini thumbnail interaktif.
   - Modal Lightbox interaktif lengkap dengan navigasi:
     - *Dashboard Admin PolluTrack (Command Center // Super Admin)*
     - *Dashboard Publik PolluTrack (Public Live Portal)*
     - *Login Admin PolluTrack (Autentikasi & Kontrol Akses)*
   - Navigasi keyboard: panah kiri/kanan untuk berpindah slide, tombol `Escape` untuk menutup.
2. **Arsitektur REA (Resources, Events, Agents)**:
   - Terhubung dengan database relasional terstruktur dan REST API endpoint di `/api/rea-graph`.
3. **Desain Gelap Cyber-Neon**:
   - Responsif di desktop, tablet, dan smartphone dengan visualisasi data interaktif.
