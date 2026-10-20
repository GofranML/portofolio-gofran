# Gofran Muttaqi Likhan — Portofolio Web (Laravel 12 + Model REA)

Aplikasi website portofolio profesional berbasis **Laravel 12** yang dibangun ulang dari analisis rekayasa balik (*Reverse Engineering*) menggunakan alat **MCP REA (Reverse Engineers Anything)** dan distrukturkan dengan ontologi bisnis **REA (Resources, Events, Agents)**, serta menerapkan standar mutu dan arsitektur dari **ECC (Everything Claude Code)**.

---

## 🌟 Ikhtisar Arsitektur

### 1. Model REA (Resources, Events, Agents)
Ontologi REA digunakan untuk memodelkan seluruh data dan interaksi portofolio ke dalam 3 pilar:

| Entitas REA | Tabel & Model | Representasi Domain |
| :--- | :--- | :--- |
| **Resources** | `resources` (`App\Models\Resource`) | Proyek unggulan (*Air Quality Mapping*, *Toyota AI Chatbot*), klaster keahlian teknis (*Networking*, *IT Support*, *Programming*, *Administrasi*, *Operasional*), kekuatan relevan, sertifikasi/pencapaian, dan aset pendidikan formal. |
| **Events** | `events` (`App\Models\Event`) | Peristiwa kerja/pengalaman profesional, capaian proyek, serta pencatatan formulir pesan & tawaran kolaborasi (*contact inquiry event*). |
| **Agents** | `agents` (`App\Models\Agent`) | **Internal Agent:** Gofran Muttaqi Likhan (Developer).<br>**External Agents:** Instansi/perusahaan mitra (*PT. Bangka Cakra Karya*, *Toyota TAG*, *Pemkot Palembang*, *ITB PalComTech*) serta pengunjung web/perekrut. |
| **Duality / Stockflow** | `event_resource` (Pivot) | Menghubungkan peristiwa ekonomi dengan sumber daya/keahlian yang digunakan (`relationship_type: uses`). |

### 2. Standar Panduan ECC (Everything Claude Code)
Arsitektur kode mematuhi aturan standar ECC yang tersimpan pada `.agents/rules`:
- **PSR-12 & Strict Typing:** Seluruh kelas PHP menggunakan `declare(strict_types=1);` dengan *type hints* skalar dan *return types* eksplisit.
- **Thin Controllers, Explicit Services:** `PortfolioController` hanya menangani transport HTTP, mendelegasikan logika bisnis ke `PortfolioService` dan `InquiryService` melalui interface `PortfolioServiceInterface` dan `InquiryServiceInterface`.
- **Immutability & DTO:** Pertukaran data antar-lapisan menggunakan Data Transfer Object yang *readonly* (`PortfolioDataDto`, `InquiryDto`).
- **PHP Security & Validasi:** Seluruh input form divalidasi ketat pada lapisan `StoreInquiryRequest` sebelum menyentuh domain, mass assignment terlindungi dengan `$fillable`, dan seluruh output Blade di-*escape* secara default.
- **Automated Testing:** Dilengkapi dengan *feature test* komprehensif (`ReaPortfolioTest`) yang memverifikasi HTTP response, struktur JSON API ontologi REA, dan persistensi database SQLite dengan `RefreshDatabase`.

---

## 🚀 Fitur Aplikasi

1. **Desain Visual & Tema Cyber-Navy:**
   - Tipografi modern (`Space Grotesk` & `IBM Plex Sans`).
   - Animasi gelombang vektor SVG real-time pada bagian Hero.
   - Efek transisi halus dan Intersection Observer scroll reveal.
   - Status indikator ketersediaan bekerjasama interaktif.

2. **Dua Proyek Unggulan Terintegrasi:**
   - *Hyper-Local Air Quality Mapping via Public Transport-Based Sensing* (IoT, ESP32, GPS, Firebase, Streamlit, Machine Learning KNN & Fuzzy Tsukamoto).
   - *Website Penjualan Toyota dengan AI Chatbot* (Virtual Salesman AI, simulasi kredit, visualisasi 3D interior/eksterior).

3. **Pengalaman Kerja & Riwayat Kontribusi:**
   - PT. Bangka Cakra Karya (Staf Umum)
   - Toyota Tunas Auto Graha (Sales Konsultan)
   - Kedai Kopi Umak (Barista & Kasir)
   - Honda Maju Motor Group (Sales Konsultan)
   - Sekretariat Daerah Kota Palembang (Staf Helper Jaringan Komputer)

4. **Formulir Interaktif & Perekam Event REA:**
   - Pengunjung dapat mengirim pesan langsung lewat formulir kontak.
   - Menggunakan AJAX asynchronous dengan proteksi CSRF.
   - Otomatis mencatat agen eksternal baru (`Agent`) dan peristiwa kontak (`Event`) di database.

5. **Modal Inspektor Ontologi REA & Live API:**
   - Tombol **"Ontologi REA"** pada navbar untuk melihat visualisasi konsep ontologi langsung di browser.
   - Endpoint JSON API: `GET /api/rea-graph` menyajikan relasi grafis REA.

---

## 🛠️ Panduan Instalasi & Menjalankan Proyek

### Prasyarat
- PHP >= 8.2 (dengan ekstensi `pdo_sqlite`, `sqlite3`, `mbstring`, `openssl`, `zip`)
- Composer

### Langkah Menjalankan
1. Masuk ke folder direktori proyek:
   ```bash
   cd "laravel portfolio"
   ```

2. Pastikan file konfigurasi `.env` telah disiapkan:
   ```bash
   # Sudah diset otomatis ke DB_CONNECTION=sqlite
   php artisan key:generate
   ```

3. Jalankan migrasi dan seeding database REA:
   ```bash
   php artisan migrate:fresh --seed
   ```

4. Jalankan pengujian otomatis (Unit & Feature Tests):
   ```bash
   php artisan test
   ```

5. Jalankan server lokal:
   ```bash
   php artisan serve
   ```
   Buka browser pada alamat: **`http://localhost:8000`**

---

## 📁 Struktur Berkas Utama

```
laravel portfolio/
├── app/
│   ├── DTOs/
│   │   ├── InquiryDto.php               # Data Transfer Object untuk permintaan kontak
│   │   └── PortfolioDataDto.php         # DTO agregat untuk data tampilan portofolio
│   ├── Http/
│   │   ├── Controllers/
│   │   │   └── PortfolioController.php  # Thin controller sesuai panduan ECC
│   │   └── Requests/
│   │       └── StoreInquiryRequest.php  # Validasi form request
│   ├── Models/
│   │   ├── Agent.php                    # Entitas REA: Agent
│   │   ├── Event.php                    # Entitas REA: Event
│   │   └── Resource.php                 # Entitas REA: Resource
│   ├── Providers/
│   │   └── AppServiceProvider.php       # Dependency injection bindings
│   └── Services/
│       ├── InquiryService.php           # Logika perekaman event REA
│       ├── InquiryServiceInterface.php
│       ├── PortfolioService.php         # Agregasi data ontologi REA & cache
│       └── PortfolioServiceInterface.php
├── database/
│   ├── migrations/
│   │   └── 2026_10_18_081331_create_rea_tables.php # Skema tabel REA
│   └── seeders/
│       ├── DatabaseSeeder.php
│       └── ReaPortfolioSeeder.php       # Seeding data hasil reverse engineering
├── public/
│   ├── css/portfolio.css                # Stylesheet lengkap tema gelap
│   ├── js/portfolio.js                  # Interaktivitas, animasi canvas, & REA modal
│   ├── gofran-profile.png               # Foto profil
│   ├── palcomtech-logo.png              # Logo universitas
│   ├── project-air-quality.png          # Gambar proyek 1
│   └── project-toyota.png               # Gambar proyek 2
├── resources/views/
│   ├── layouts/app.blade.php            # Layout utama & modal ontologi REA
│   └── portfolio/index.blade.php        # Tampilan lengkap portofolio
├── routes/
│   └── web.php                          # Rute portofolio dan REA API
└── tests/Feature/
    └── ReaPortfolioTest.php             # Pengujian otomatis skenario REA
```

---

Dibuat dengan dedikasi tinggi menerapkan prinsip arsitektur perangkat lunak modern, ontologi REA, dan kepatuhan panduan Everything Claude Code (ECC).
