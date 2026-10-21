@extends('layouts.app')

@section('content')
    <!-- HERO SECTION -->
    <section class="hero" id="hero">
        <div class="hero-wave" aria-hidden="true">
            <svg viewBox="0 0 1200 500" preserveAspectRatio="none">
                <path id="wavePath1" d="M0,320 Q150,260 300,320 T600,320 T900,320 T1200,320" fill="none" stroke="#4FE3C1" stroke-width="1" opacity=".35" />
                <path id="wavePath2" d="M0,380 Q150,420 300,380 T600,380 T900,380 T1200,380" fill="none" stroke="#4FE3C1" stroke-width="1" opacity=".18" />
                <path id="wavePath3" d="M0,260 Q150,220 300,260 T600,260 T900,260 T1200,260" fill="none" stroke="#F0A860" stroke-width="1" opacity=".12" />
            </svg>
        </div>

        <div class="wrap hero-grid hero-in">
            <div>
                <div class="kicker stagger">
                    <span class="rule"></span>
                    <span>Portofolio — Palembang, Indonesia</span>
                </div>

                <h1 class="headline stagger">
                    Halo Semua, Saya<br>
                    <span class="accent">{{ $portfolio->owner->name }}</span>
                </h1>

                <p class="hero-sub stagger">
                    {{ $portfolio->owner->metadata['subheadline'] ?? 'Mahasiswa Informatika dengan latar belakang lintas bidang: administrasi, penjualan, layanan pelanggan, dan dukungan jaringan. Saat ini fokus membangun proyek berbasis IoT dan AI untuk menjawab masalah nyata di sekitar.' }}
                </p>

                <div class="hero-facts stagger">
                    <div class="fact-chip"><b>{{ $portfolio->owner->metadata['gpa'] ?? '3.95' }}</b> / {{ $portfolio->owner->metadata['max_gpa'] ?? '4.00' }} IPK</div>
                    <div class="fact-chip">Semester <b>{{ $portfolio->owner->metadata['semester'] ?? '5' }}</b> · {{ $portfolio->owner->metadata['major'] ?? 'Informatika' }}</div>
                    <div class="fact-chip">ITB PalComTech, Palembang</div>
                </div>

                <div class="hero-contact stagger">
                    <a class="contact-btn primary" href="https://wa.me/6285669548964?text=Halo%21%20saya%20ingin%20bekerja%20sama%20dengan%20anda" target="_blank" rel="noopener noreferrer" data-testid="link-hero-whatsapp">
                        <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2a9.9 9.9 0 0 0-8.56 14.87L2 22l5.3-1.39A10 10 0 1 0 12 2Zm0 18.2a8.2 8.2 0 0 1-4.18-1.14l-.3-.18-3.14.82.84-3.05-.2-.31A8.2 8.2 0 1 1 12 20.2Zm4.5-6.15c-.25-.13-1.47-.73-1.7-.81-.23-.08-.4-.13-.57.13-.17.25-.65.81-.8.98-.15.17-.29.19-.54.06-.25-.13-1.05-.39-2-1.24-.74-.66-1.24-1.47-1.39-1.72-.14-.25-.02-.39.11-.52.12-.12.25-.29.38-.44.13-.15.17-.25.25-.42.08-.17.04-.31-.02-.44-.06-.13-.57-1.37-.78-1.87-.2-.49-.41-.42-.57-.43h-.49c-.17 0-.44.06-.67.31-.23.25-.88.86-.88 2.1s.9 2.44 1.03 2.61c.13.17 1.77 2.7 4.3 3.79.6.26 1.07.42 1.43.54.6.19 1.14.16 1.57.1.48-.07 1.47-.6 1.68-1.18.21-.58.21-1.08.15-1.18-.06-.1-.23-.16-.48-.29Z" /></svg>
                        WhatsApp
                    </a>
                    <a class="contact-btn" href="mailto:{{ $portfolio->owner->email }}?subject=Peluang%20Bekerjasama%20%2F%20Kolaborasi&body=Halo%20Gofran%2C%0A%0ASaya%20ingin%20membahas%20peluang%20bekerjasama%20atau%20kolaborasi%20dengan%20Anda.%0A%0ATerima%20kasih." data-testid="link-hero-email">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true"><rect x="2.5" y="4.5" width="19" height="15" rx="2" /><path d="M3 6l9 7 9-7" /></svg>
                        Email
                    </a>
                    <a class="contact-btn" href="https://www.linkedin.com/in/gofran-ml" target="_blank" rel="noopener noreferrer" data-testid="link-hero-linkedin">
                        <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M4.98 3.5C4.98 4.88 3.9 6 2.5 6S0 4.88 0 3.5 1.12 1 2.5 1s2.48 1.12 2.48 2.5zM.5 8h4V23h-4V8zM8.5 8h3.8v2.05h.05c.53-1 1.83-2.05 3.77-2.05 4.03 0 4.78 2.65 4.78 6.1V23h-4v-6.9c0-1.65-.03-3.77-2.3-3.77-2.3 0-2.65 1.8-2.65 3.65V23h-4V8z" /></svg>
                        LinkedIn
                    </a>
                </div>
            </div>

            <div class="hero-photo">
                <div class="photo-frame">
                    <img src="{{ asset('gofran-profile.png') }}" alt="Foto Gofran Muttaqi Likhan" data-testid="img-profile">
                    <div class="photo-caption">
                        <span><span class="dot"></span>Tersedia untuk bekerjasama</span>
                        <span>Palembang, ID</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- HIGHLIGHT STRIP -->
    <div class="strip">
        <div class="wrap">
            <div class="strip-row">
                <div class="strip-item" data-testid="text-strip-technical-support">
                    <h4>Technical Support</h4>
                    <p>Network · Hardware · Software</p>
                </div>
                <div class="strip-item" data-testid="text-strip-networking">
                    <h4>Networking</h4>
                    <p>MikroTik · Cisco · Infrastruktur</p>
                </div>
                <div class="strip-item" data-testid="text-strip-administrasi">
                    <h4>Administrasi</h4>
                    <p>Excel · Data · Pelaporan</p>
                </div>
                <div class="strip-item" data-testid="text-strip-operasional">
                    <h4>Operasional</h4>
                    <p>Koordinasi · Maintenance</p>
                </div>
                <div class="strip-item" data-testid="text-strip-teknologi">
                    <h4>Teknologi</h4>
                    <p>IoT · AI · Python</p>
                </div>
            </div>
        </div>
    </div>

    <!-- 01 TENTANG SAYA -->
    <section id="tentang">
        <div class="wrap">
            <div class="sec-head reveal">
                <div>
                    <div class="sec-num">01 — Tentang</div>
                    <h2>Tentang saya</h2>
                </div>
            </div>

            <div class="about-grid reveal">
                <h3>Lintas bidang, satu cara berpikir: amati, catat, perbaiki.</h3>
                <div class="about-body">
                    <p>
                        Saya mahasiswa Informatika dengan pengalaman lintas bidang — administrasi, pengolahan data, operasional, penjualan, serta pelayanan pelanggan. Terbiasa bekerja secara individu maupun dalam tim, dan belakangan aktif mengeksplorasi teknologi AI dan IoT untuk menyelesaikan masalah yang saya temui langsung di lapangan, mulai dari kualitas udara di transportasi umum hingga proses penjualan kendaraan.
                    </p>
                    <div class="about-tags">
                        <span>Administrasi &amp; pelaporan</span>
                        <span>Penjualan &amp; layanan pelanggan</span>
                        <span>Jaringan komputer</span>
                        <span>IoT &amp; AI</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 02 PROYEK UNGGULAN -->
    <section id="proyek">
        <div class="wrap">
            <div class="sec-head reveal">
                <div>
                    <div class="sec-num">02 — Proyek</div>
                    <h2>Proyek unggulan</h2>
                    <p class="sec-lead">Dua proyek mahasiswa yang menggabungkan perangkat keras, data, dan kecerdasan buatan untuk menjawab persoalan nyata.</p>
                </div>
            </div>

            @foreach ($portfolio->projects as $project)
                <article class="proj reveal" data-testid="card-project-{{ Str::slug(Str::limit($project->title, 12, '')) }}">
                    <div class="proj-media {{ !empty($project->metadata['gallery']) ? 'has-gallery' : '' }}"
                         @if (!empty($project->metadata['gallery']))
                             data-open-gallery="{{ $project->slug }}" data-slide-index="0" role="button" tabindex="0" title="Klik untuk membuka preview hasil proyek"
                         @endif>
                        <img src="{{ asset($project->image_url ?? 'project-air-quality.png') }}" alt="{{ $project->title }}" loading="lazy">
                        @if (!empty($project->metadata['gallery']))
                            <div class="proj-media-overlay">
                                <span class="proj-media-badge">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0" />
                                        <circle cx="12" cy="12" r="3" />
                                    </svg>
                                    <span>Preview Hasil ({{ count($project->metadata['gallery']) }})</span>
                                </span>
                            </div>
                        @endif
                    </div>
                    <div class="proj-content">
                        <div class="proj-top">
                            <h3>{{ $project->title }}</h3>
                            <span class="proj-year">{{ $project->year }}</span>
                        </div>
                        <p class="proj-desc">{{ $project->description }}</p>

                        @if (!empty($project->points))
                            <ul class="proj-list">
                                @foreach ($project->points as $point)
                                    <li>{{ $point }}</li>
                                @endforeach
                            </ul>
                        @endif

                        @if (!empty($project->stack))
                            <div class="proj-stack">
                                @foreach ($project->stack as $tech)
                                    <span>{{ $tech }}</span>
                                @endforeach
                            </div>
                        @endif

                        @if (!empty($project->metadata['gallery']))
                            <div class="proj-gallery-cta">
                                <div class="proj-gallery-top">
                                    <button type="button" class="btn-gallery-open" data-open-gallery="{{ $project->slug }}" data-slide-index="0" data-testid="btn-preview-{{ $project->slug }}">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                            <path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0" />
                                            <circle cx="12" cy="12" r="3" />
                                        </svg>
                                        <span>Lihat Hasil Proyek ({{ count($project->metadata['gallery']) }} Layar)</span>
                                    </button>
                                    <span class="gallery-lead-hint">Tangkapan layar sistem langsung:</span>
                                </div>

                                <div class="proj-gallery-cards" role="group" aria-label="Tangkapan layar hasil proyek">
                                    @foreach ($project->metadata['gallery'] as $idx => $item)
                                        <button type="button" class="proj-thumb-card" data-open-gallery="{{ $project->slug }}" data-slide-index="{{ $idx }}" title="Buka {{ $item['title'] }}" data-testid="thumb-preview-{{ $idx }}">
                                            <div class="thumb-card-img">
                                                <img src="{{ asset(ltrim($item['image'], '/')) }}" alt="{{ $item['title'] }}" loading="lazy">
                                                <span class="thumb-zoom-badge">
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                                        <circle cx="11" cy="11" r="8" />
                                                        <line x1="21" y1="21" x2="16.65" y2="16.65" />
                                                        <line x1="11" y1="8" x2="11" y2="14" />
                                                        <line x1="8" y1="11" x2="14" y2="11" />
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="thumb-card-meta">
                                                <span class="thumb-index">0{{ $idx + 1 }}</span>
                                                <span class="thumb-title">{{ $item['short_title'] ?? $item['title'] }}</span>
                                            </div>
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    <!-- 03 PENGALAMAN KERJA -->
    <section id="pengalaman">
        <div class="wrap">
            <div class="sec-head reveal">
                <div>
                    <div class="sec-num">03 — Pengalaman</div>
                    <h2>Pengalaman kerja</h2>
                    <p class="sec-lead">Riwayat kontribusi profesional di berbagai perusahaan dan instansi.</p>
                </div>
            </div>

            <div class="timeline reveal">
                @foreach ($portfolio->experiences as $exp)
                    <article class="tl-item {{ $exp->is_current ? 'current' : '' }}">
                        <div class="tl-head">
                            <h3>{{ $exp->title }}</h3>
                            <span class="tl-date">{{ $exp->period }}</span>
                        </div>
                        <div class="tl-company">{{ $exp->organization }}</div>

                        @if (!empty($exp->details))
                            <ul class="tl-list">
                                @foreach ($exp->details as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                        @endif

                        @if ($exp->resources->isNotEmpty())
                            <div style="margin-top:12px; display:flex; flex-wrap:wrap; gap:6px;">
                                @foreach ($exp->resources as $res)
                                    <span style="font-size:11px; font-family:'JetBrains Mono',monospace; padding:3px 8px; background:rgba(79,227,193,0.08); border:1px solid rgba(79,227,193,0.25); border-radius:3px; color:var(--signal);">
                                        {{ $res->title }}
                                    </span>
                                @endforeach
                            </div>
                        @endif
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <!-- 04 KEAHLIAN & KEKUATAN -->
    <section id="keahlian">
        <div class="wrap">
            <div class="sec-head reveal">
                <div>
                    <div class="sec-num">04 — Keahlian</div>
                    <h2>Keahlian</h2>
                </div>
            </div>

            <div class="reveal">
                @foreach ($portfolio->skillGroups as $category => $skills)
                    <div class="skill-row">
                        <h4>{{ $category }}</h4>
                        <div class="skill-tags">
                            @foreach ($skills as $skill)
                                <span>{{ $skill->title }}</span>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="reveal" style="margin-top: 64px;">
                <div class="sec-num" style="margin-bottom: 24px;">Kekuatan yang relevan</div>
                <div class="strengths">
                    @foreach ($portfolio->strengths as $strength)
                        <div class="strength">
                            <h4>{{ $strength->title }}</h4>
                            <p>{{ $strength->description }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- 05 SERTIFIKASI & PENCAPAIAN -->
    <section id="sertifikasi">
        <div class="wrap">
            <div class="sec-head reveal">
                <div>
                    <div class="sec-num">05 — Sertifikasi</div>
                    <h2>Sertifikasi &amp; pencapaian</h2>
                </div>
            </div>

            <div class="cert-cols reveal">
                @foreach ($portfolio->certificationGroups as $groupTitle => $items)
                    <div class="cert-col">
                        <h4>{{ $groupTitle }}</h4>
                        @foreach ($items as $item)
                            <div class="cert-item">
                                <p>{{ $item['title'] }}</p>
                                <span>{{ $item['meta'] }}</span>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- 06 PENDIDIKAN -->
    <section id="pendidikan">
        <div class="wrap">
            <div class="sec-head reveal">
                <div>
                    <div class="sec-num">06 — Pendidikan</div>
                    <h2>Pendidikan</h2>
                </div>
            </div>

            <div class="edu-card reveal">
                <div class="gpa-block">
                    <div class="gpa-num">{{ $portfolio->education->metadata['gpa'] ?? '3.95' }}</div>
                    <div class="gpa-label">dari {{ $portfolio->education->metadata['max_gpa'] ?? '4.00' }} IPK</div>
                </div>

                <div class="edu-info">
                    <h3>{{ $portfolio->education->title ?? 'Bachelor of Informatika' }}</h3>
                    <div class="edu-sub">
    {{ $portfolio->education?->description ?? 'S1 Informatika — Institut Teknologi dan Bisnis PalComTech' }}
</div>
                    @if (!empty($portfolio->education->points))
                        <div class="edu-courses">
                            @foreach ($portfolio->education->points as $course)
                                <span>{{ $course }}</span>
                            @endforeach
                        </div>
                    @endif
                </div>

                <a class="campus-logo" href="https://palcomtech.ac.id/" target="_blank" rel="noopener noreferrer" aria-label="Kunjungi situs PalComTech" data-testid="link-palcomtech">
                    <img src="{{ asset('palcomtech-logo.png') }}" alt="Logo PalComTech">
                </a>
            </div>
        </div>
    </section>

    <!-- 07 KONTAK -->
    <section class="contact-sec" id="kontak">
        <div class="wrap">
            <div class="sec-head reveal">
                <div>
                    <div class="sec-num">07 — Kontak</div>
                    <h2>Tertarik membuka peluang bekerjasama atau berkolaborasi?</h2>
                </div>
            </div>

            <div class="contact-layout reveal">
                <div class="contact-info">
                    <p>
                        Saya terbuka untuk peluang bekerjasama maupun kolaborasi proyek di bidang teknologi, data, atau AI. Silakan hubungi saya melalui salah satu kanal langsung berikut:
                    </p>

                    <div class="contact-channels">
                        <a class="contact-btn primary" href="https://wa.me/6285669548964?text=Halo%21%20saya%20ingin%20bekerja%20sama%20dengan%20anda" target="_blank" rel="noopener noreferrer" data-testid="link-contact-whatsapp">
                            <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2a9.9 9.9 0 0 0-8.56 14.87L2 22l5.3-1.39A10 10 0 1 0 12 2Zm0 18.2a8.2 8.2 0 0 1-4.18-1.14l-.3-.18-3.14.82.84-3.05-.2-.31A8.2 8.2 0 1 1 12 20.2Zm4.5-6.15c-.25-.13-1.47-.73-1.7-.81-.23-.08-.4-.13-.57.13-.17.25-.65.81-.8.98-.15.17-.29.19-.54.06-.25-.13-1.05-.39-2-1.24-.74-.66-1.24-1.47-1.39-1.72-.14-.25-.02-.39.11-.52.12-.12.25-.29.38-.44.13-.15.17-.25.25-.42.08-.17.04-.31-.02-.44-.06-.13-.57-1.37-.78-1.87-.2-.49-.41-.42-.57-.43h-.49c-.17 0-.44.06-.67.31-.23.25-.88.86-.88 2.1s.9 2.44 1.03 2.61c.13.17 1.77 2.7 4.3 3.79.6.26 1.07.42 1.43.54.6.19 1.14.16 1.57.1.48-.07 1.47-.6 1.68-1.18.21-.58.21-1.08.15-1.18-.06-.1-.23-.16-.48-.29Z" /></svg>
                            WhatsApp Langsung
                        </a>
                        <a class="contact-btn" href="mailto:{{ $portfolio->owner->email }}?subject=Peluang%20Bekerjasama%20%2F%20Kolaborasi&body=Halo%20Gofran%2C%0A%0ASaya%20ingin%20membahas%20peluang%20bekerjasama%20atau%20kolaborasi%20dengan%20Anda.%0A%0ATerima%20kasih." data-testid="link-contact-email">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true"><rect x="2.5" y="4.5" width="19" height="15" rx="2" /><path d="M3 6l9 7 9-7" /></svg>
                            Kirim Email
                        </a>
                        <a class="contact-btn" href="https://www.linkedin.com/in/gofran-ml" target="_blank" rel="noopener noreferrer" data-testid="link-contact-linkedin">
                            <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M4.98 3.5C4.98 4.88 3.9 6 2.5 6S0 4.88 0 3.5 1.12 1 2.5 1s2.48 1.12 2.48 2.5zM.5 8h4V23h-4V8zM8.5 8h3.8v2.05h.05c.53-1 1.83-2.05 3.77-2.05 4.03 0 4.78 2.65 4.78 6.1V23h-4v-6.9c0-1.65-.03-3.77-2.3-3.77-2.3 0-2.65 1.8-2.65 3.65V23h-4V8z" /></svg>
                            Profil LinkedIn
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- PROJECT PREVIEW MODAL / LIGHTBOX -->
    @include('portfolio.partials.preview-modal')
@endsection
