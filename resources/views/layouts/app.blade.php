<!DOCTYPE html>
<html lang="id" data-theme="dark" data-lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" id="metaThemeColor" content="#090B0E">
    <title>Gofran Muttaqi Likhan · Portofolio</title>
    <meta name="description" id="metaDescription" content="Portofolio Gofran Muttaqi Likhan, Mahasiswa Informatika ITB PalComTech berfokus pada IoT, AI, Networking, dan Administrasi.">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="googlebot" content="index, follow">
    @php
        $appUrl = config('app.url');
        $canonicalBase = ($appUrl && !str_contains($appUrl, 'localhost') && !str_contains($appUrl, '127.0.0.1') && !str_contains($appUrl, 'gofranmuttaqi'))
            ? rtrim($appUrl, '/')
            : 'https://portofolio-gofran.vercel.app';
        $canonicalUrl = $canonicalBase . '/';
    @endphp
    <link rel="canonical" href="{{ $canonicalUrl }}">
    <link rel="alternate" hreflang="id" href="{{ $canonicalUrl }}">
    <link rel="alternate" hreflang="en" href="{{ $canonicalUrl }}">
    <link rel="alternate" hreflang="x-default" href="{{ $canonicalUrl }}">

    <!-- Open Graph Metadata (Facebook, LinkedIn, Discord, Slack) -->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Gofran Muttaqi Likhan Portfolio">
    <meta property="og:title" id="ogTitle" content="Gofran Muttaqi Likhan · Portofolio">
    <meta property="og:description" id="ogDescription" content="Portofolio Gofran Muttaqi Likhan, Mahasiswa Informatika ITB PalComTech berfokus pada IoT, AI, Networking, dan Administrasi.">
    <meta property="og:url" id="ogUrl" content="{{ $canonicalUrl }}">
    <meta property="og:image" content="{{ $canonicalBase }}/og-image.png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="Gofran Muttaqi Likhan · Precision Telemetry Portfolio">
    <meta property="og:locale" content="id_ID">
    <meta property="og:locale:alternate" content="en_US">

    <!-- Twitter Card Metadata -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" id="twitterTitle" content="Gofran Muttaqi Likhan · Portofolio">
    <meta name="twitter:description" id="twitterDescription" content="Portofolio Gofran Muttaqi Likhan, Mahasiswa Informatika ITB PalComTech berfokus pada IoT, AI, Networking, dan Administrasi.">
    <meta name="twitter:image" content="{{ $canonicalBase }}/og-image.png">
    <meta name="twitter:image:alt" content="Gofran Muttaqi Likhan · Precision Telemetry Portfolio">

    <!-- PWA Manifest & App Icons -->
    <link rel="manifest" href="{{ asset('manifest.webmanifest') }}">
    <link rel="apple-touch-icon" sizes="192x192" href="{{ asset('images/icons/icon-192.png') }}">

    <!-- Anti-FOUC Theme & Language Initialization (Runs synchronously before stylesheet) -->
    <script>
        (function () {
            var theme = 'dark';
            var lang = 'id';
            try {
                var storedTheme = localStorage.getItem('gml_theme');
                if (storedTheme === 'light' || storedTheme === 'dark') {
                    theme = storedTheme;
                } else if (window.matchMedia && window.matchMedia('(prefers-color-scheme: light)').matches) {
                    theme = 'light';
                } else if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                    theme = 'dark';
                }

                var storedLang = localStorage.getItem('gml_lang');
                if (storedLang === 'en' || storedLang === 'id') {
                    lang = storedLang;
                }
            } catch (e) {}
            document.documentElement.setAttribute('data-theme', theme);
            document.documentElement.style.colorScheme = theme;
            document.documentElement.setAttribute('lang', lang);
            document.documentElement.setAttribute('data-lang', lang);
            var metaTheme = document.getElementById('metaThemeColor');
            if (metaTheme) {
                metaTheme.setAttribute('content', theme === 'light' ? '#F5F2EB' : '#090B0E');
            }
        })();
    </script>

    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" as="image" href="{{ asset('images/opt/gofran-profile-720.avif') }}" type="image/avif" fetchpriority="high">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=JetBrains+Mono:wght@400;500&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/portfolio.css') }}">
    @stack('styles')

    <!-- JSON-LD Structured Data (Person, WebSite, ProfilePage) -->
    @if(isset($portfolio))
        @include('portfolio.partials.seo-schema')
    @endif
</head>
<body>
    <!-- Precision Telemetry Reticle Cursor (Active on Desktop pointer:fine) -->
    <div class="cursor-reticle" id="cursorReticle" aria-hidden="true">
        <div class="reticle-dot"></div>
        <div class="reticle-bracket tl"></div>
        <div class="reticle-bracket tr"></div>
        <div class="reticle-bracket br"></div>
        <div class="reticle-bracket bl"></div>
        <span class="reticle-tag" id="reticleTag">SYS</span>
    </div>

    <a href="#top" class="skip-link" data-i18n="nav.skip">Lewati ke konten utama</a>

    <!-- Navigation Header -->
    <header class="nav" id="siteNav">
        <div class="nav-progress-track" aria-hidden="true">
            <div class="nav-progress-bar" id="navProgressBar"></div>
        </div>

        <div class="nav-inner">
            <a href="#top" class="brand" data-testid="link-brand">
                <span class="mark" aria-hidden="true"></span>
                <span class="brand-stack">
                    <span class="brand-text">Gofran Muttaqi Likhan</span>
                    <span class="brand-coord" aria-hidden="true">GML // SYS.NODE-01</span>
                </span>
            </a>

            <div class="nav-right">
                <nav class="links" aria-label="Navigasi utama" data-i18n-aria="nav.aria_main">
                    <a href="#tentang" data-testid="link-nav-tentang">
                        <span class="nav-idx" aria-hidden="true">01</span>
                        <span data-i18n="nav.about">Tentang</span>
                    </a>
                    <a href="#proyek" data-testid="link-nav-proyek">
                        <span class="nav-idx" aria-hidden="true">02</span>
                        <span data-i18n="nav.projects">Proyek</span>
                    </a>
                    <a href="#pengalaman" data-testid="link-nav-pengalaman">
                        <span class="nav-idx" aria-hidden="true">03</span>
                        <span data-i18n="nav.experience">Pengalaman</span>
                    </a>
                    <a href="#keahlian" data-testid="link-nav-keahlian">
                        <span class="nav-idx" aria-hidden="true">04</span>
                        <span data-i18n="nav.skills">Keahlian</span>
                    </a>
                    <a href="#sertifikasi" data-testid="link-nav-sertifikasi">
                        <span class="nav-idx" aria-hidden="true">05</span>
                        <span data-i18n="nav.certifications">Sertifikasi</span>
                    </a>
                    <a href="#pendidikan" data-testid="link-nav-pendidikan">
                        <span class="nav-idx" aria-hidden="true">06</span>
                        <span data-i18n="nav.education">Pendidikan</span>
                    </a>
                    <a href="#kontak" class="nav-cta" data-testid="link-nav-kontak" data-i18n="nav.contact">Hubungi Saya</a>
                </nav>

                <div class="nav-actions">
                    <!-- Language Toggle (ID / EN) -->
                    <button
                        class="lang-toggle"
                        id="langToggle"
                        type="button"
                        data-lang-toggle
                        data-testid="button-lang-toggle"
                        aria-label="ID / EN · Ganti bahasa tampilan"
                        title="Ganti bahasa tampilan (ID / EN)"
                    >
                        <span class="lang-opt active" data-lang-opt="id">ID</span>
                        <span class="lang-sep" aria-hidden="true">/</span>
                        <span class="lang-opt" data-lang-opt="en">EN</span>
                    </button>

                    <!-- Theme Toggle (Dark / Light) -->
                    <button
                        class="theme-toggle"
                        id="themeToggle"
                        type="button"
                        data-theme-toggle
                        data-testid="button-theme-toggle"
                        aria-label="Mode: DARK · Aktifkan mode terang"
                        aria-pressed="false"
                        title="Ganti tema tampilan (Dark / Light)"
                    >
                        <span class="theme-toggle-glyph" aria-hidden="true">
                            <svg class="icon-sun" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="square" stroke-linejoin="miter">
                                <circle cx="12" cy="12" r="4.25" />
                                <path d="M12 2.5v2.5M12 19v2.5M4.93 4.93l1.77 1.77M17.3 17.3l1.77 1.77M2.5 12H5M19 12h2.5M4.93 19.07l1.77-1.77M17.3 6.7l1.77-1.77" />
                            </svg>
                            <svg class="icon-moon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="square" stroke-linejoin="miter">
                                <path d="M20.354 15.354A9 9 0 0 1 8.646 3.646 9.003 9.003 0 0 0 12 21a9.003 9.003 0 0 0 8.354-5.646Z" />
                            </svg>
                        </span>
                        <span class="theme-toggle-readout" data-theme-label>DARK</span>
                    </button>

                    <!-- Mobile Drawer Trigger -->
                    <button class="nav-toggle" id="navToggle" type="button" aria-label="Buka menu navigasi" aria-expanded="false" data-testid="button-menu">
                        <span></span><span></span><span></span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation Panel -->
        <nav class="mobile-panel" id="mobilePanel" aria-label="Navigasi mobile" data-i18n-aria="nav.aria_mobile">
            <a href="#tentang" data-testid="link-mobile-tentang">
                <span class="mobile-link-idx">01</span>
                <span data-i18n="nav.about">Tentang</span>
            </a>
            <a href="#proyek" data-testid="link-mobile-proyek">
                <span class="mobile-link-idx">02</span>
                <span data-i18n="nav.projects">Proyek</span>
            </a>
            <a href="#pengalaman" data-testid="link-mobile-pengalaman">
                <span class="mobile-link-idx">03</span>
                <span data-i18n="nav.experience">Pengalaman</span>
            </a>
            <a href="#keahlian" data-testid="link-mobile-keahlian">
                <span class="mobile-link-idx">04</span>
                <span data-i18n="nav.skills">Keahlian</span>
            </a>
            <a href="#sertifikasi" data-testid="link-mobile-sertifikasi">
                <span class="mobile-link-idx">05</span>
                <span data-i18n="nav.certifications">Sertifikasi</span>
            </a>
            <a href="#pendidikan" data-testid="link-mobile-pendidikan">
                <span class="mobile-link-idx">06</span>
                <span data-i18n="nav.education">Pendidikan</span>
            </a>
            <a href="#kontak" data-testid="link-mobile-kontak">
                <span class="mobile-link-idx">07</span>
                <span data-i18n="nav.contact">Hubungi Saya</span>
            </a>

            <div class="mobile-controls-grid">
                <div class="mobile-theme-row">
                    <span class="mobile-theme-caption" data-i18n="nav.lang_label">Bahasa</span>
                    <button
                        class="mobile-theme-btn"
                        type="button"
                        data-lang-toggle
                        data-testid="button-lang-toggle-mobile"
                        aria-label="Ganti bahasa tampilan (ID / EN)"
                    >
                        <span class="theme-dot" aria-hidden="true"></span>
                        <span data-lang-label-mobile>Indonesia (ID)</span>
                    </button>
                </div>

                <div class="mobile-theme-row">
                    <span class="mobile-theme-caption" data-i18n="nav.theme_label">Mode Tampilan</span>
                    <button
                        class="mobile-theme-btn"
                        type="button"
                        data-theme-toggle
                        data-testid="button-theme-toggle-mobile"
                        aria-label="Aktifkan mode terang"
                        aria-pressed="false"
                    >
                        <span class="theme-dot" aria-hidden="true"></span>
                        <span data-theme-label-mobile>Carbon Dark</span>
                    </button>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content Slot -->
    <main id="top">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="site-footer">
        <div class="wrap footer-row">
            <div class="footer-brand-meta">
                <span class="footer-code">SYS // GML.{{ date('Y') }}</span>
                <p data-i18n="footer.copy">© {{ date('Y') }} Gofran Muttaqi Likhan · Palembang, Sumatera Selatan, Indonesia.</p>
            </div>
            <p class="footer-tech">
                <span data-i18n="footer.built_with">Dirancang dengan presisi menggunakan</span>
                <strong>Laravel {{ app()->version() }}</strong>
            </p>
        </div>
    </footer>

    <!-- Client Scripts -->
    <script src="{{ asset('js/portfolio.js') }}"></script>
    @stack('scripts')
</body>
</html>
