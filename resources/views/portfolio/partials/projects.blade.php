<!-- 02 / PROYEK UNGGULAN (ARCHITECTURAL CASE STUDIES) -->
<section id="proyek" class="sec-projects">
    <div class="wrap">
        <div class="sec-head reveal">
            <div>
                <div class="sec-num">
                    <span class="sec-index">02</span>
                    <span class="sec-sep" aria-hidden="true">/</span>
                    <span data-i18n="projects.eyebrow">Studi Kasus &amp; Sistem</span>
                </div>
                <h2 data-i18n="projects.heading">Proyek unggulan</h2>
                <p class="sec-lead" data-i18n="projects.lead">Dua proyek mahasiswa yang menggabungkan perangkat keras, data, dan kecerdasan buatan untuk menjawab persoalan nyata.</p>
            </div>
            <div class="sec-meta-readout" aria-hidden="true">
                <span>TOTAL // 0{{ $portfolio->projects->count() }} SYSTEMS</span>
                <span>2026 BUILD</span>
            </div>
        </div>

        @foreach ($portfolio->projects as $pIdx => $project)
            @php
                $projectKey = $project->slug ?: 'project_' . $pIdx;
                $cleanDescription = str_replace([' — ', '—'], [' · ', '·'], $project->description);
                $cleanYear = str_replace([' — ', '—'], [' · ', '·'], $project->year);
                $cleanCategory = str_replace([' — ', '—'], [' · ', '·'], $project->category ?? 'System Engineering');
            @endphp
            <article class="proj reveal" data-tilt-card data-testid="card-project-{{ Str::slug(Str::limit($project->title, 12, '')) }}">
                <!-- Case Study Top Telemetry Bar -->
                <header class="proj-telemetry-bar">
                    <div class="proj-bar-left">
                        <span class="proj-cs-code">CS // 0{{ $pIdx + 1 }}</span>
                        <span class="proj-cs-cat" data-i18n="projects.items.{{ $projectKey }}.category">{{ $cleanCategory }}</span>
                    </div>
                    <span class="proj-year" data-i18n="projects.items.{{ $projectKey }}.year">{{ $cleanYear }}</span>
                </header>

                <div class="proj-body-grid">
                    <!-- Left Column: Visual Media & Interactive Trigger -->
                    <div class="proj-media {{ !empty($project->metadata['gallery']) ? 'has-gallery' : '' }}"
                         @if (!empty($project->metadata['gallery']))
                             data-open-gallery="{{ $project->slug }}" data-slide-index="0" role="button" tabindex="0"
                             title="Klik untuk membuka preview hasil proyek" data-i18n-title="projects.open_gallery_title"
                         @endif>
                        @php
                            $imgRaw = ltrim($project->image_url ?? 'project-air-quality.png', '/');
                            $imgBase = pathinfo($imgRaw, PATHINFO_FILENAME);
                            $isToyota = str_contains($imgBase, 'toyota');
                            $optW1 = $isToyota ? 800 : 480;
                            $optW2 = $isToyota ? 1400 : 836;
                            $avifSrcset = asset("images/opt/{$imgBase}-{$optW1}.avif") . " {$optW1}w, " . asset("images/opt/{$imgBase}-{$optW2}.avif") . " {$optW2}w";
                            $webpSrcset = asset("images/opt/{$imgBase}-{$optW1}.webp") . " {$optW1}w, " . asset("images/opt/{$imgBase}-{$optW2}.webp") . " {$optW2}w";
                        @endphp
                        <picture>
                            @if (file_exists(public_path("images/opt/{$imgBase}-{$optW1}.avif")))
                                <source type="image/avif" srcset="{{ $avifSrcset }}" sizes="(max-width: 960px) 100vw, 640px">
                            @endif
                            @if (file_exists(public_path("images/opt/{$imgBase}-{$optW1}.webp")))
                                <source type="image/webp" srcset="{{ $webpSrcset }}" sizes="(max-width: 960px) 100vw, 640px">
                            @endif
                            <img src="{{ asset($project->image_url ?? 'project-air-quality.png') }}" alt="{{ $project->title }}" loading="lazy" width="640" height="480">
                        </picture>

                        @if (!empty($project->metadata['gallery']))
                            <div class="proj-media-overlay">
                                <span class="proj-media-badge">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                        <path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0" />
                                        <circle cx="12" cy="12" r="3" />
                                    </svg>
                                    <span data-i18n="projects.items.{{ $projectKey }}.badge_preview">Preview Hasil ({{ count($project->metadata['gallery']) }})</span>
                                </span>
                            </div>
                        @else
                            <div class="proj-media-overlay">
                                <span class="proj-media-badge static-badge">
                                    <span class="badge-dot" aria-hidden="true"></span>
                                    <span data-i18n="projects.items.{{ $projectKey }}.badge_arch">Arsitektur Web &amp; AI Terintegrasi</span>
                                </span>
                            </div>
                        @endif
                    </div>

                    <!-- Right Column: Specification & Interactive Gallery Deck -->
                    <div class="proj-content">
                        <div class="proj-top">
                            <h3 data-i18n="projects.items.{{ $projectKey }}.title">{{ $project->title }}</h3>
                        </div>

                        <p class="proj-desc" data-i18n="projects.items.{{ $projectKey }}.desc">{{ $cleanDescription }}</p>

                        @if (!empty($project->points))
                            <div class="proj-spec-section">
                                <div class="proj-spec-heading" data-i18n="projects.spec_heading">Spesifikasi &amp; Kapabilitas Sistem</div>
                                <ul class="proj-list">
                                    @foreach ($project->points as $ptIdx => $point)
                                        <li data-i18n="projects.items.{{ $projectKey }}.point_{{ $ptIdx }}">{{ str_replace([' — ', '—'], [' · ', '·'], $point) }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (!empty($project->stack))
                            <div class="proj-stack-wrap">
                                <span class="proj-stack-label" data-i18n="projects.stack_label">KOMPONEN &amp; TEKNOLOGI</span>
                                <div class="proj-stack">
                                    @foreach ($project->stack as $tech)
                                        <span>{{ $tech }}</span>
                                    @endforeach
                                </div>
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
                                        <span data-i18n="projects.items.{{ $projectKey }}.cta_gallery">Lihat Hasil Proyek ({{ count($project->metadata['gallery']) }} Layar)</span>
                                    </button>
                                    <span class="gallery-lead-hint" data-i18n="projects.gallery_hint">Tangkapan layar sistem langsung:</span>
                                </div>

                                <div class="proj-gallery-cards" role="group" aria-label="Tangkapan layar hasil proyek">
                                    @foreach ($project->metadata['gallery'] as $idx => $item)
                                        <button type="button" class="proj-thumb-card" data-open-gallery="{{ $project->slug }}" data-slide-index="{{ $idx }}" title="Buka {{ $item['title'] }}" data-testid="thumb-preview-{{ $idx }}">
                                            <div class="thumb-card-img">
                                                @php
                                                    $thumbRaw = ltrim($item['image'], '/');
                                                    $thumbBase = pathinfo($thumbRaw, PATHINFO_FILENAME);
                                                    $thumbOptAvif = "images/opt/{$thumbBase}-480.avif";
                                                    $thumbOptWebp = "images/opt/{$thumbBase}-480.webp";
                                                @endphp
                                                <picture>
                                                    @if (file_exists(public_path($thumbOptAvif)))
                                                        <source type="image/avif" srcset="{{ asset($thumbOptAvif) }}">
                                                    @endif
                                                    @if (file_exists(public_path($thumbOptWebp)))
                                                        <source type="image/webp" srcset="{{ asset($thumbOptWebp) }}">
                                                    @endif
                                                    <img src="{{ asset(ltrim($item['image'], '/')) }}" alt="{{ $item['title'] }}" loading="lazy" width="320" height="190">
                                                </picture>
                                                <span class="thumb-zoom-badge" aria-hidden="true">
                                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <circle cx="11" cy="11" r="8" />
                                                        <line x1="21" y1="21" x2="16.65" y2="16.65" />
                                                        <line x1="11" y1="8" x2="11" y2="14" />
                                                        <line x1="8" y1="11" x2="14" y2="11" />
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="thumb-card-meta">
                                                <span class="thumb-index">0{{ $idx + 1 }}</span>
                                                <span class="thumb-title" data-i18n="projects.items.{{ $projectKey }}.thumb_{{ $idx }}">{{ $item['short_title'] ?? $item['title'] }}</span>
                                            </div>
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </article>
        @endforeach
    </div>
</section>
