<!-- 05 / SERTIFIKASI & PENCAPAIAN (VERIFIED CREDENTIAL VAULT) -->
<section id="sertifikasi" class="sec-certifications">
    <div class="wrap">
        <div class="sec-head reveal">
            <div>
                <div class="sec-num">
                    <span class="sec-index">05</span>
                    <span class="sec-sep" aria-hidden="true">/</span>
                    <span data-i18n="certs.eyebrow">Lisensi, Pelatihan, &amp; Rekognisi</span>
                </div>
                <h2 data-i18n="certs.heading">Sertifikasi &amp; pencapaian</h2>
            </div>
            <div class="sec-meta-readout" aria-hidden="true">
                <span>VAULT // 09 RECORDS</span>
                <span>AWS · IBM · GOV</span>
            </div>
        </div>

        <div class="cert-cols reveal">
            @php $gIdx = 0; @endphp
            @foreach ($portfolio->certificationGroups as $groupTitle => $items)
                <div class="cert-col">
                    <div class="cert-col-header">
                        <span class="cert-col-code">GRP // 0{{ $gIdx + 1 }}</span>
                        <h3 class="cert-col-title" data-i18n="certs.group_{{ $gIdx }}.title">{{ $groupTitle }}</h3>
                    </div>

                    <div class="cert-list">
                        @foreach ($items as $cIdx => $item)
                            <div class="cert-item">
                                <span class="cert-item-num">0{{ $cIdx + 1 }}</span>
                                <div class="cert-item-body">
                                    <p data-i18n="certs.group_{{ $gIdx }}.item_{{ $cIdx }}.title">{{ str_replace([' — ', '—'], [' · ', '·'], $item['title']) }}</p>
                                    <span data-i18n="certs.group_{{ $gIdx }}.item_{{ $cIdx }}.meta">{{ str_replace([' — ', '—'], [' · ', '·'], $item['meta']) }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @php $gIdx++; @endphp
            @endforeach
        </div>
    </div>
</section>
