<!-- PROJECT GALLERY MODAL / LIGHTBOX -->
<div id="projectGalleryModal" class="project-modal" role="dialog" aria-modal="true" aria-hidden="true" tabindex="-1">
    <div class="project-modal-backdrop" id="modalBackdrop"></div>
    <div class="project-modal-dialog">
        <!-- MODAL HEADER -->
        <header class="project-modal-header">
            <div class="modal-meta-block">
                <span class="modal-category-badge" id="modalProjectTag">IoT &amp; AI · PolluTrack</span>
                <h3 class="modal-project-title" id="modalProjectTitle">Hasil Proyek: Hyper-Local Air Quality Mapping</h3>
            </div>
            <div class="modal-header-actions">
                <div class="modal-counter-badge">
                    <span id="modalCurrentIndex">1</span> / <span id="modalTotalCount">3</span>
                </div>
                <a id="modalExternalLink" href="#" target="_blank" rel="noopener noreferrer" class="modal-action-btn" title="Buka gambar resolusi penuh di tab baru" aria-label="Buka gambar resolusi penuh di tab baru">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M15 3h6v6" />
                        <path d="M10 14 21 3" />
                        <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6" />
                    </svg>
                </a>
                <button type="button" class="modal-action-btn close-btn" id="modalCloseBtn" aria-label="Tutup pratinjau hasil proyek">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M18 6 6 18" />
                        <path d="m6 6 12 12" />
                    </svg>
                </button>
            </div>
        </header>

        <!-- NAVIGATION TABS -->
        <nav class="modal-tabs" id="modalTabs" aria-label="Pilih tampilan hasil proyek">
            <!-- Populated dynamically via JS -->
        </nav>

        <!-- MAIN VIEWER STAGE -->
        <div class="modal-viewer-stage">
            <button type="button" class="stage-nav-btn prev" id="modalPrevBtn" aria-label="Tangkapan layar sebelumnya">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="m15 18-6-6 6-6" />
                </svg>
            </button>

            <div class="stage-image-container" id="stageImageContainer">
                <div class="stage-loader" id="modalImageLoader" aria-hidden="true">
                    <div class="spinner"></div>
                </div>
                <img id="modalMainImage" src="" alt="Pratinjau Hasil Proyek" class="stage-img">
            </div>

            <button type="button" class="stage-nav-btn next" id="modalNextBtn" aria-label="Tangkapan layar selanjutnya">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="m9 18 6-6-6-6" />
                </svg>
            </button>
        </div>

        <!-- FOOTER / CAPTION & THUMBNAILS -->
        <footer class="modal-footer-panel">
            <div class="modal-caption-area">
                <div class="caption-header">
                    <span class="caption-tag" id="modalSlideTag">Command Center // Super Admin</span>
                    <h4 class="caption-title" id="modalSlideTitle">Dashboard Admin PolluTrack</h4>
                </div>
                <p class="caption-desc" id="modalSlideDesc">Deskripsi hasil proyek akan tampil di sini.</p>
            </div>

            <div class="modal-thumbnail-strip" id="modalThumbStrip" role="tablist" aria-label="Thumbnail tangkapan layar">
                <!-- Populated dynamically via JS -->
            </div>
        </footer>
    </div>
</div>

<!-- EMBEDDED PROJECT GALLERY DATA -->
<script type="application/json" id="portfolioGalleryData">
@php
    $galleries = [];
    foreach ($portfolio->projects as $p) {
        if (!empty($p->metadata['gallery'])) {
            $galleries[$p->slug] = [
                'projectTitle' => $p->title,
                'category' => $p->category,
                'gallery' => $p->metadata['gallery'],
            ];
        }
    }
@endphp
{!! json_encode($galleries, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>
