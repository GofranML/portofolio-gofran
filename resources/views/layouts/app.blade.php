<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Gofran Muttaqi Likhan — Portofolio</title>
    <meta name="description" content="Portofolio Gofran Muttaqi Likhan — Mahasiswa Informatika ITB PalComTech berfokus pada IoT, AI, Networking, dan Administrasi.">

    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/portfolio.css') }}">
    @stack('styles')
</head>
<body>
    <!-- Navigation Header -->
    <header class="nav" id="siteNav">
        <div class="nav-inner">
            <a href="#top" class="brand" data-testid="link-brand">
                <span class="mark"></span>
                <span>Gofran Muttaqi Likhan</span>
            </a>

            <div class="nav-right">
                <nav class="links" aria-label="Navigasi utama">
                    <a href="#tentang" data-testid="link-nav-tentang">Tentang</a>
                    <a href="#proyek" data-testid="link-nav-proyek">Proyek</a>
                    <a href="#pengalaman" data-testid="link-nav-pengalaman">Pengalaman</a>
                    <a href="#keahlian" data-testid="link-nav-keahlian">Keahlian</a>
                    <a href="#pendidikan" data-testid="link-nav-pendidikan">Pendidikan</a>
                    <a href="#kontak" class="nav-cta" data-testid="link-nav-kontak">Hubungi Saya</a>
                </nav>

                <button class="nav-toggle" id="navToggle" type="button" aria-label="Buka menu navigasi" aria-expanded="false" data-testid="button-menu">
                    <span></span><span></span><span></span>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation Panel -->
        <nav class="mobile-panel" id="mobilePanel" aria-label="Navigasi mobile">
            <a href="#tentang" data-testid="link-mobile-tentang">Tentang</a>
            <a href="#proyek" data-testid="link-mobile-proyek">Proyek</a>
            <a href="#pengalaman" data-testid="link-mobile-pengalaman">Pengalaman</a>
            <a href="#keahlian" data-testid="link-mobile-keahlian">Keahlian</a>
            <a href="#pendidikan" data-testid="link-mobile-pendidikan">Pendidikan</a>
            <a href="#kontak" data-testid="link-mobile-kontak">Hubungi Saya</a>
        </nav>
    </header>

    <!-- Main Content Slot -->
    <main id="top">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <div class="wrap footer-row">
            <p>© {{ date('Y') }} Gofran Muttaqi Likhan. Palembang, Indonesia.</p>
            <p>
                Dibangun dengan <strong>Laravel {{ app()->version() }}</strong>
            </p>
        </div>
    </footer>

    <!-- Client Scripts -->
    <script src="{{ asset('js/portfolio.js') }}"></script>
    @stack('scripts')
</body>
</html>
