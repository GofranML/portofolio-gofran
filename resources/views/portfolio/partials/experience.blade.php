<!-- 03 / PENGALAMAN KERJA (CHRONOLOGICAL LEDGER MATRIX) -->
<section id="pengalaman" class="sec-experience">
    <div class="wrap">
        <div class="sec-head reveal">
            <div>
                <div class="sec-num">
                    <span class="sec-index">03</span>
                    <span class="sec-sep" aria-hidden="true">/</span>
                    <span data-i18n="experience.eyebrow">Rekam Jejak Operasional</span>
                </div>
                <h2 data-i18n="experience.heading">Pengalaman kerja</h2>
                <p class="sec-lead" data-i18n="experience.lead">Riwayat kontribusi profesional di berbagai perusahaan dan instansi.</p>
            </div>
            <div class="sec-meta-readout" aria-hidden="true">
                <span>LOG // 0{{ $portfolio->experiences->count() }} ROLES</span>
                <span>2021 · 2026</span>
            </div>
        </div>

        <div class="timeline-ledger reveal">
            @foreach ($portfolio->experiences as $eIdx => $exp)
                @php
                    $cleanExpTitle = str_replace([' — ', '—'], [' · ', '·'], $exp->title);
                    $cleanExpPeriod = str_replace([' — ', '—'], [' – ', '–'], $exp->period);
                    $cleanExpOrg = str_replace([' — ', '—'], [' · ', '·'], $exp->organization);
                @endphp
                <article class="tl-item {{ $exp->is_current ? 'current' : '' }}">
                    <div class="tl-meta-col">
                        <div class="tl-index-row">
                            <span class="tl-code">EXP // 0{{ $eIdx + 1 }}</span>
                            @if ($exp->is_current)
                                <span class="tl-status-badge" data-i18n="experience.status_active">AKTIF</span>
                            @endif
                        </div>
                        <span class="tl-date" data-i18n="experience.items.exp_{{ $eIdx }}.period">{{ $cleanExpPeriod }}</span>
                    </div>

                    <div class="tl-body-col">
                        <div class="tl-head">
                            <h3 data-i18n="experience.items.exp_{{ $eIdx }}.title">{{ $cleanExpTitle }}</h3>
                            <div class="tl-company" data-i18n="experience.items.exp_{{ $eIdx }}.org">{{ $cleanExpOrg }}</div>
                        </div>

                        @if (!empty($exp->details))
                            <ul class="tl-list">
                                @foreach ($exp->details as $dIdx => $item)
                                    <li data-i18n="experience.items.exp_{{ $eIdx }}.detail_{{ $dIdx }}">{{ str_replace([' — ', '—'], [' · ', '·'], $item) }}</li>
                                @endforeach
                            </ul>
                        @endif

                        @if ($exp->resources->isNotEmpty())
                            <div class="tl-resources">
                                @foreach ($exp->resources as $rIdx => $res)
                                    <span class="tl-resource-chip" data-i18n="experience.items.exp_{{ $eIdx }}.res_{{ $rIdx }}">
                                        {{ str_replace([' — ', '—'], [' · ', '·'], $res->title) }}
                                    </span>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
