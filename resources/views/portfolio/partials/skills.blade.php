<!-- 04 / KEAHLIAN & KEKUATAN (TECHNICAL CAPABILITY MATRIX) -->
<section id="keahlian" class="sec-skills">
    <div class="wrap">
        <div class="sec-head reveal">
            <div>
                <div class="sec-num">
                    <span class="sec-index">04</span>
                    <span class="sec-sep" aria-hidden="true">/</span>
                    <span data-i18n="skills.eyebrow">Kompetensi Lintas-Disiplin</span>
                </div>
                <h2 data-i18n="skills.heading">Keahlian</h2>
            </div>
            <div class="sec-meta-readout" aria-hidden="true">
                <span>MATRIX // 05 DOMAINS</span>
                <span>30 CAPABILITIES</span>
            </div>
        </div>

        <div class="skill-matrix reveal">
            @php $catIndex = 0; @endphp
            @foreach ($portfolio->skillGroups as $category => $skills)
                <div class="skill-row">
                    <div class="skill-domain-head">
                        <span class="skill-domain-code">DOM // 0{{ $catIndex + 1 }}</span>
                        <h3 class="skill-domain-title" data-i18n="skills.cat_{{ $catIndex }}">{{ $category }}</h3>
                        <span class="skill-domain-count">{{ str_pad((string) count($skills), 2, '0', STR_PAD_LEFT) }} <em data-i18n="skills.unit_items">ITEM</em></span>
                    </div>
                    <div class="skill-tags">
                        @foreach ($skills as $sIdx => $skill)
                            <span data-i18n="skills.item_{{ $catIndex }}_{{ $sIdx }}">{{ str_replace([' — ', '—'], [' · ', '·'], $skill->title) }}</span>
                        @endforeach
                    </div>
                </div>
                @php $catIndex++; @endphp
            @endforeach
        </div>

        <!-- 6 Core Strengths Ledger -->
        <div class="strengths-block reveal">
            <div class="strengths-subhead">
                <div class="sec-num">
                    <span class="sec-index">04.B</span>
                    <span class="sec-sep" aria-hidden="true">/</span>
                    <span data-i18n="strengths.eyebrow">Karakteristik &amp; Kapabilitas Inti</span>
                </div>
                <h3 class="strengths-heading" data-i18n="strengths.heading">Kekuatan yang relevan</h3>
            </div>

            <div class="strengths">
                @foreach ($portfolio->strengths as $stIdx => $strength)
                    <div class="strength">
                        <div class="strength-top">
                            <span class="strength-code">STR // 0{{ $stIdx + 1 }}</span>
                            <h4 data-i18n="strengths.items.str_{{ $stIdx }}.title">{{ $strength->title }}</h4>
                        </div>
                        <p data-i18n="strengths.items.str_{{ $stIdx }}.desc">{{ str_replace([' — ', '—'], [' · ', '·'], $strength->description) }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
