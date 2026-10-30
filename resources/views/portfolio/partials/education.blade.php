<!-- 06 / PENDIDIKAN (ACADEMIC MONOGRAPH DOSSIER) -->
<section id="pendidikan" class="sec-education">
    <div class="wrap">
        <div class="sec-head reveal">
            <div>
                <div class="sec-num">
                    <span class="sec-index">06</span>
                    <span class="sec-sep" aria-hidden="true">/</span>
                    <span data-i18n="education.eyebrow">Fondasi Akademik</span>
                </div>
                <h2 data-i18n="education.heading">Pendidikan</h2>
            </div>
            <div class="sec-meta-readout" aria-hidden="true">
                <span>GPA // {{ $portfolio->education->metadata['gpa'] ?? '3.95' }}</span>
                <span>PALCOMTECH</span>
            </div>
        </div>

        @php
            $eduDesc = str_replace([' — ', '—'], [' · ', '·'], $portfolio->education?->description ?? 'S1 Informatika · Institut Teknologi dan Bisnis PalComTech');
        @endphp

        <div class="edu-card reveal">
            <div class="gpa-block">
                <span class="gpa-code">INDEX // CUMULATIVE</span>
                <div class="gpa-num">{{ $portfolio->education->metadata['gpa'] ?? '3.95' }}</div>
                <div class="gpa-label">
                    <span data-i18n="education.gpa_prefix">dari</span>
                    {{ $portfolio->education->metadata['max_gpa'] ?? '4.00' }}
                    <span data-i18n="education.gpa_suffix">IPK</span>
                </div>
                <div class="gpa-period-badge" data-i18n="education.period">2024 – Sekarang · Semester 5</div>
            </div>

            <div class="edu-info">
                <span class="edu-level-tag" data-i18n="education.level_tag">PENDIDIKAN TINGGI · S1</span>
                <h3 data-i18n="education.degree">{{ $portfolio->education->title ?? 'Bachelor of Informatika' }}</h3>
                <div class="edu-sub" data-i18n="education.institution">{{ $eduDesc }}</div>

                @if (!empty($portfolio->education->points))
                    <div class="edu-courses-label" data-i18n="education.courses_label">MATA KULIAH &amp; FOKUS RELEVAN</div>
                    <div class="edu-courses">
                        @foreach ($portfolio->education->points as $cIdx => $course)
                            <span data-i18n="education.course_{{ $cIdx }}">{{ $course }}</span>
                        @endforeach
                    </div>
                @endif
            </div>

            <a class="campus-logo" href="https://palcomtech.ac.id/" target="_blank" rel="noopener noreferrer" aria-label="Kunjungi situs PalComTech" data-testid="link-palcomtech">
                <picture>
                    <source type="image/avif" srcset="{{ asset('images/opt/palcomtech-logo-240.avif') }} 240w, {{ asset('images/opt/palcomtech-logo-480.avif') }} 480w" sizes="112px">
                    <source type="image/webp" srcset="{{ asset('images/opt/palcomtech-logo-240.webp') }} 240w, {{ asset('images/opt/palcomtech-logo-480.webp') }} 480w" sizes="112px">
                    <img src="{{ asset('palcomtech-logo.png') }}" alt="Logo PalComTech" loading="lazy" width="112" height="72">
                </picture>
            </a>
        </div>

        @if (!empty($portfolio->secondaryEducation))
            @php
                $secEduTitle = str_replace([' — ', '—'], [' · ', '·'], $portfolio->secondaryEducation->title);
                $secEduDesc = str_replace([' — ', '—'], [' · ', '·'], $portfolio->secondaryEducation->description);
                $secEduPeriod = str_replace([' — ', '—'], [' – ', '–'], $portfolio->secondaryEducation->period ?? '2020 – 2023');
            @endphp
            <div class="edu-secondary-bar reveal">
                <div class="edu-sec-left">
                    <span class="edu-sec-code">EDU // PREV</span>
                    <strong data-i18n="education.sec_title">{{ $secEduTitle }}</strong>
                </div>
                <div class="edu-sec-right">
                    <span data-i18n="education.sec_desc">{{ $secEduDesc }}</span>
                    <span class="edu-sec-period">{{ $secEduPeriod }}</span>
                </div>
            </div>
        @endif
    </div>
</section>
