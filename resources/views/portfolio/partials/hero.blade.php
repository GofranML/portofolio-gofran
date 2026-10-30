<!-- HERO SECTION & TELEMETRY DOSSIER -->
<section class="hero" id="hero">
    <div class="hero-wave" aria-hidden="true">
        <svg viewBox="0 0 1200 500" preserveAspectRatio="none">
            <path id="wavePath1" d="M0,320 Q150,260 300,320 T600,320 T900,320 T1200,320" fill="none" stroke="var(--accent-primary)" stroke-width="1" opacity=".28" />
            <path id="wavePath2" d="M0,380 Q150,420 300,380 T600,380 T900,380 T1200,380" fill="none" stroke="var(--accent-primary)" stroke-width="1" opacity=".14" />
            <path id="wavePath3" d="M0,260 Q150,220 300,260 T600,260 T900,260 T1200,260" fill="none" stroke="var(--accent-secondary)" stroke-width="1" opacity=".12" />
        </svg>
    </div>

    <div class="wrap hero-grid hero-in">
        <div class="hero-lead-col">
            <div class="kicker stagger">
                <span class="kicker-code">SYS.00 // PLG</span>
                <span class="rule" aria-hidden="true"></span>
                <span data-i18n="hero.kicker">Portofolio · Palembang, Indonesia</span>
            </div>

            <h1 class="headline stagger">
                <span class="headline-intro" data-i18n="hero.greeting">Halo Semua, Saya</span>
                <span class="accent">{{ $portfolio->owner->name }}</span>
            </h1>

            <div class="hero-role-banner stagger">
                <span class="role-pill" data-i18n="hero.role_primary">Mahasiswa S1 Informatika</span>
                <span class="role-sep" aria-hidden="true">/</span>
                <span class="role-pill" data-i18n="hero.role_secondary">IoT &amp; AI Systems</span>
                <span class="role-sep" aria-hidden="true">/</span>
                <span class="role-pill" data-i18n="hero.role_tertiary">Network &amp; Operations</span>
            </div>

            <p class="hero-sub stagger" data-i18n="hero.subheadline">
                {{ str_replace([' — ', '—'], [' · ', '·'], $portfolio->owner->metadata['subheadline'] ?? 'Mahasiswa Informatika dengan latar belakang lintas bidang: administrasi, penjualan, layanan pelanggan, dan dukungan jaringan. Saat ini fokus membangun proyek berbasis IoT dan AI untuk menjawab masalah nyata di sekitar.') }}
            </p>

            <!-- Precision Telemetry Readout Ledger -->
            <div class="hero-facts stagger" role="list" aria-label="Ringkasan profil akademik" data-i18n-aria="hero.facts_aria">
                <div class="fact-chip" role="listitem">
                    <span class="fact-label" data-i18n="hero.fact_gpa_label">INDEKS PRESTASI</span>
                    <span class="fact-val"><b>{{ $portfolio->owner->metadata['gpa'] ?? '3.95' }}</b> / {{ $portfolio->owner->metadata['max_gpa'] ?? '4.00' }} <span data-i18n="hero.fact_gpa_unit">IPK</span></span>
                </div>
                <div class="fact-chip" role="listitem">
                    <span class="fact-label" data-i18n="hero.fact_sem_label">STATUS STUDI</span>
                    <span class="fact-val"><span data-i18n="hero.fact_sem_prefix">Semester</span> <b>{{ $portfolio->owner->metadata['semester'] ?? '5' }}</b> · <span data-i18n="hero.fact_major">{{ $portfolio->owner->metadata['major'] ?? 'Informatika' }}</span></span>
                </div>
                <div class="fact-chip" role="listitem">
                    <span class="fact-label" data-i18n="hero.fact_inst_label">INSTITUSI</span>
                    <span class="fact-val">ITB PalComTech, Palembang</span>
                </div>
            </div>

            <div class="hero-contact stagger">
                <a class="contact-btn primary" href="https://wa.me/6285669548964?text=Halo%21%20saya%20ingin%20bekerja%20sama%20dengan%20anda" target="_blank" rel="noopener noreferrer" data-testid="link-hero-whatsapp">
                    <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2a9.9 9.9 0 0 0-8.56 14.87L2 22l5.3-1.39A10 10 0 1 0 12 2Zm0 18.2a8.2 8.2 0 0 1-4.18-1.14l-.3-.18-3.14.82.84-3.05-.2-.31A8.2 8.2 0 1 1 12 20.2Zm4.5-6.15c-.25-.13-1.47-.73-1.7-.81-.23-.08-.4-.13-.57.13-.17.25-.65.81-.8.98-.15.17-.29.19-.54.06-.25-.13-1.05-.39-2-1.24-.74-.66-1.24-1.47-1.39-1.72-.14-.25-.02-.39.11-.52.12-.12.25-.29.38-.44.13-.15.17-.25.25-.42.08-.17.04-.31-.02-.44-.06-.13-.57-1.37-.78-1.87-.2-.49-.41-.42-.57-.43h-.49c-.17 0-.44.06-.67.31-.23.25-.88.86-.88 2.1s.9 2.44 1.03 2.61c.13.17 1.77 2.7 4.3 3.79.6.26 1.07.42 1.43.54.6.19 1.14.16 1.57.1.48-.07 1.47-.6 1.68-1.18.21-.58.21-1.08.15-1.18-.06-.1-.23-.16-.48-.29Z" /></svg>
                    <span>WhatsApp</span>
                </a>
                <a class="contact-btn" href="mailto:{{ $portfolio->owner->email }}?subject=Peluang%20Bekerjasama%20%2F%20Kolaborasi&body=Halo%20Gofran%2C%0A%0ASaya%20ingin%20membahas%20peluang%20bekerjasama%20atau%20kolaborasi%20dengan%20Anda.%0A%0ATerima%20kasih." data-testid="link-hero-email">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true"><rect x="2.5" y="4.5" width="19" height="15" rx="2" /><path d="M3 6l9 7 9-7" /></svg>
                    <span>Email</span>
                </a>
                <a class="contact-btn" href="https://www.linkedin.com/in/gofran-ml" target="_blank" rel="noopener noreferrer" data-testid="link-hero-linkedin">
                    <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M4.98 3.5C4.98 4.88 3.9 6 2.5 6S0 4.88 0 3.5 1.12 1 2.5 1s2.48 1.12 2.48 2.5zM.5 8h4V23h-4V8zM8.5 8h3.8v2.05h.05c.53-1 1.83-2.05 3.77-2.05 4.03 0 4.78 2.65 4.78 6.1V23h-4v-6.9c0-1.65-.03-3.77-2.3-3.77-2.3 0-2.65 1.8-2.65 3.65V23h-4V8z" /></svg>
                    <span>LinkedIn</span>
                </a>
            </div>
        </div>

        <!-- 3D Perspective Identity Dossier -->
        <div class="hero-photo" data-tilt-stage>
            <div class="photo-frame" data-tilt-card>
                <div class="dossier-topbar" aria-hidden="true">
                    <span class="dossier-id">ID // GML-2026</span>
                    <span class="dossier-coord">02°59′27″S · 104°45′24″E</span>
                </div>

                <div class="photo-viewport">
                    <picture>
                        <source type="image/avif" srcset="{{ asset('images/opt/gofran-profile-400.avif') }} 400w, {{ asset('images/opt/gofran-profile-720.avif') }} 720w" sizes="(max-width: 960px) 400px, 440px">
                        <source type="image/webp" srcset="{{ asset('images/opt/gofran-profile-400.webp') }} 400w, {{ asset('images/opt/gofran-profile-720.webp') }} 720w" sizes="(max-width: 960px) 400px, 440px">
                        <img src="{{ asset('gofran-profile.png') }}" alt="Foto Gofran Muttaqi Likhan" data-testid="img-profile" width="440" height="550" fetchpriority="high">
                    </picture>
                    <div class="dossier-float-badge" aria-hidden="true">
                        <span class="badge-tag" data-i18n="hero.badge_tag">FOKUS SISTEM</span>
                        <strong data-i18n="hero.badge_val">IoT · AI · Jaringan</strong>
                    </div>
                </div>

                <div class="photo-caption">
                    <span class="status-live">
                        <span class="dot" aria-hidden="true"></span>
                        <span data-i18n="hero.availability">Tersedia untuk bekerjasama</span>
                    </span>
                    <span class="caption-loc">Palembang, ID</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ARCHITECTURAL SPECIFICATION STRIP -->
<div class="strip" role="region" aria-label="Bidang kompetensi utama" data-i18n-aria="strip.aria">
    <div class="wrap">
        <div class="strip-row">
            <div class="strip-item" data-testid="text-strip-technical-support">
                <span class="strip-idx" aria-hidden="true">01 // SUP</span>
                <h2 class="strip-title" data-i18n="strip.item1_title">Technical Support</h2>
                <p data-i18n="strip.item1_desc">Network · Hardware · Software</p>
            </div>
            <div class="strip-item" data-testid="text-strip-networking">
                <span class="strip-idx" aria-hidden="true">02 // NET</span>
                <h2 class="strip-title" data-i18n="strip.item2_title">Networking</h2>
                <p data-i18n="strip.item2_desc">MikroTik · Cisco · Infrastruktur</p>
            </div>
            <div class="strip-item" data-testid="text-strip-administrasi">
                <span class="strip-idx" aria-hidden="true">03 // ADM</span>
                <h2 class="strip-title" data-i18n="strip.item3_title">Administrasi</h2>
                <p data-i18n="strip.item3_desc">Excel · Data · Pelaporan</p>
            </div>
            <div class="strip-item" data-testid="text-strip-operasional">
                <span class="strip-idx" aria-hidden="true">04 // OPS</span>
                <h2 class="strip-title" data-i18n="strip.item4_title">Operasional</h2>
                <p data-i18n="strip.item4_desc">Koordinasi · Maintenance</p>
            </div>
            <div class="strip-item" data-testid="text-strip-teknologi">
                <span class="strip-idx" aria-hidden="true">05 // LAB</span>
                <h2 class="strip-title" data-i18n="strip.item5_title">Teknologi</h2>
                <p data-i18n="strip.item5_desc">IoT · AI · Python</p>
            </div>
        </div>
    </div>
</div>
