/**
 * Portfolio Client Script · Phase 2 Complete Visual Redesign
 * Handles dual-theme controller (Dark/Light), bilingual localization (ID/EN),
 * navigation scroll spy & progress telemetry, intersection observer reveals,
 * lightweight CSS 3D perspective tilt, and accessible gallery modal with focus trap.
 */
document.addEventListener('DOMContentLoaded', () => {
    const rootEl = document.documentElement;
    const reduceMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const canHoverFine = window.matchMedia && window.matchMedia('(hover: hover) and (pointer: fine)').matches;

    // Parse I18n Dictionary (English translations & modal gallery translations)
    const i18nDataEl = document.getElementById('portfolioI18nData');
    let enDict = {};
    let modalGalleryEn = {};
    if (i18nDataEl) {
        try {
            const parsed = JSON.parse(i18nDataEl.textContent.trim());
            enDict = parsed.en || {};
            modalGalleryEn = parsed.modalGalleryEn || {};
        } catch (err) {
            console.error('Failed to parse portfolio i18n data:', err);
        }
    }

    // Helper to strip em-dashes from any dynamic text string
    const sanitizeEmDash = (str) => (typeof str === 'string' ? str.replace(/\u2014/g, '·') : str);

    // Capture canonical Indonesian (ID) texts from server-rendered DOM
    const i18nTextNodes = Array.from(document.querySelectorAll('[data-i18n]'));
    const i18nTitleNodes = Array.from(document.querySelectorAll('[data-i18n-title]'));
    const i18nAriaNodes = Array.from(document.querySelectorAll('[data-i18n-aria]'));
    const metaDescEl = document.getElementById('metaDescription');
    const initialDocTitle = sanitizeEmDash(document.title);
    const initialMetaDesc = metaDescEl ? sanitizeEmDash(metaDescEl.getAttribute('content') || '') : '';

    i18nTextNodes.forEach((el) => {
        el.__idText = sanitizeEmDash(el.textContent);
    });
    i18nTitleNodes.forEach((el) => {
        el.__idTitle = sanitizeEmDash(el.getAttribute('title') || '');
    });
    i18nAriaNodes.forEach((el) => {
        el.__idAria = sanitizeEmDash(el.getAttribute('aria-label') || '');
    });

    // =========================================================================
    // 0. Dual-Theme Controller (Dark: Carbon Telemetry Deck / Light: Architectural Drafting Paper)
    // =========================================================================
    const THEME_STORAGE_KEY = 'gml_theme';
    const LANG_STORAGE_KEY = 'gml_lang';
    const metaThemeColor = document.getElementById('metaThemeColor');
    const themeToggleButtons = Array.from(document.querySelectorAll('[data-theme-toggle]'));
    const themeLabels = Array.from(document.querySelectorAll('[data-theme-label]'));
    const themeMobileLabels = Array.from(document.querySelectorAll('[data-theme-label-mobile]'));

    const getCurrentLang = () => {
        const attr = rootEl.getAttribute('data-lang') || rootEl.getAttribute('lang');
        return attr === 'en' ? 'en' : 'id';
    };

    const getStoredTheme = () => {
        try {
            const val = localStorage.getItem(THEME_STORAGE_KEY);
            return val === 'light' || val === 'dark' ? val : null;
        } catch (err) {
            return null;
        }
    };

    const getCurrentTheme = () => {
        const attr = rootEl.getAttribute('data-theme');
        return attr === 'light' ? 'light' : 'dark';
    };

    const syncThemeUI = (theme) => {
        const isLight = theme === 'light';
        const isEn = getCurrentLang() === 'en';
        const themeWord = isLight ? 'LIGHT' : 'DARK';
        const nextActionLabel = isEn
            ? `Theme: ${themeWord} · Switch to ${isLight ? 'dark' : 'light'} mode`
            : `Mode: ${themeWord} · Aktifkan mode ${isLight ? 'gelap' : 'terang'}`;

        rootEl.setAttribute('data-theme', theme);
        rootEl.style.colorScheme = theme;

        if (metaThemeColor) {
            metaThemeColor.setAttribute('content', isLight ? '#F5F2EB' : '#090B0E');
        }

        themeToggleButtons.forEach((btn) => {
            btn.setAttribute('aria-pressed', String(isLight));
            btn.setAttribute('aria-label', nextActionLabel);
            btn.setAttribute('title', `${nextActionLabel}`);
        });

        themeLabels.forEach((el) => {
            el.textContent = themeWord;
        });

        themeMobileLabels.forEach((el) => {
            el.textContent = isLight ? 'Drafting Light' : 'Carbon Dark';
        });
    };

    const applyTheme = (theme, persist = false) => {
        const normalized = theme === 'light' ? 'light' : 'dark';
        if (persist) {
            rootEl.classList.add('theme-transition');
            window.setTimeout(() => {
                rootEl.classList.remove('theme-transition');
            }, 320);

            themeToggleButtons.forEach((btn) => {
                btn.classList.add('btn-switched');
                window.setTimeout(() => btn.classList.remove('btn-switched'), 350);
            });
        }
        syncThemeUI(normalized);

        if (persist) {
            try {
                localStorage.setItem(THEME_STORAGE_KEY, normalized);
            } catch (err) {
                // Storage unavailable
            }
        }
    };

    syncThemeUI(getCurrentTheme());

    themeToggleButtons.forEach((btn) => {
        btn.addEventListener('click', () => {
            const nextTheme = getCurrentTheme() === 'dark' ? 'light' : 'dark';
            applyTheme(nextTheme, true);
        });
    });

    if (window.matchMedia) {
        const lightQuery = window.matchMedia('(prefers-color-scheme: light)');
        const handleSystemThemeChange = (e) => {
            if (!getStoredTheme()) {
                applyTheme(e.matches ? 'light' : 'dark', false);
            }
        };

        if (typeof lightQuery.addEventListener === 'function') {
            lightQuery.addEventListener('change', handleSystemThemeChange);
        }
    }

    // =========================================================================
    // 1. Bilingual Localization Controller (ID / EN)
    // =========================================================================
    const langToggleButtons = Array.from(document.querySelectorAll('[data-lang-toggle]'));
    const langOptSpans = Array.from(document.querySelectorAll('[data-lang-opt]'));
    const langMobileLabels = Array.from(document.querySelectorAll('[data-lang-label-mobile]'));

    // Forward reference for modal refresh when open
    let refreshOpenModalLanguage = () => {};

    const syncLanguageUI = (lang) => {
        const normalized = lang === 'en' ? 'en' : 'id';
        const isEn = normalized === 'en';

        rootEl.setAttribute('lang', normalized);
        rootEl.setAttribute('data-lang', normalized);

        const ogTitleEl = document.getElementById('ogTitle');
        const ogDescEl = document.getElementById('ogDescription');
        const twitterTitleEl = document.getElementById('twitterTitle');
        const twitterDescEl = document.getElementById('twitterDescription');

        // Update document title & meta description (including Open Graph and Twitter)
        if (isEn) {
            if (enDict['meta.title']) {
                const enTitle = sanitizeEmDash(enDict['meta.title']);
                document.title = enTitle;
                if (ogTitleEl) ogTitleEl.setAttribute('content', enTitle);
                if (twitterTitleEl) twitterTitleEl.setAttribute('content', enTitle);
            }
            if (metaDescEl && enDict['meta.description']) {
                const enDesc = sanitizeEmDash(enDict['meta.description']);
                metaDescEl.setAttribute('content', enDesc);
                if (ogDescEl) ogDescEl.setAttribute('content', enDesc);
                if (twitterDescEl) twitterDescEl.setAttribute('content', enDesc);
            }
        } else {
            document.title = initialDocTitle;
            if (ogTitleEl) ogTitleEl.setAttribute('content', initialDocTitle);
            if (twitterTitleEl) twitterTitleEl.setAttribute('content', initialDocTitle);
            if (metaDescEl) {
                metaDescEl.setAttribute('content', initialMetaDesc);
                if (ogDescEl) ogDescEl.setAttribute('content', initialMetaDesc);
                if (twitterDescEl) twitterDescEl.setAttribute('content', initialMetaDesc);
            }
        }

        // Update all [data-i18n] text nodes
        i18nTextNodes.forEach((el) => {
            const key = el.getAttribute('data-i18n');
            if (isEn && key && Object.prototype.hasOwnProperty.call(enDict, key)) {
                el.textContent = sanitizeEmDash(enDict[key]);
            } else if (typeof el.__idText === 'string') {
                el.textContent = el.__idText;
            }
        });

        // Update all [data-i18n-title] attributes
        i18nTitleNodes.forEach((el) => {
            const key = el.getAttribute('data-i18n-title');
            if (isEn && key && Object.prototype.hasOwnProperty.call(enDict, key)) {
                el.setAttribute('title', sanitizeEmDash(enDict[key]));
            } else if (typeof el.__idTitle === 'string') {
                el.setAttribute('title', el.__idTitle);
            }
        });

        // Update all [data-i18n-aria] attributes
        i18nAriaNodes.forEach((el) => {
            const key = el.getAttribute('data-i18n-aria');
            if (isEn && key && Object.prototype.hasOwnProperty.call(enDict, key)) {
                el.setAttribute('aria-label', sanitizeEmDash(enDict[key]));
            } else if (typeof el.__idAria === 'string') {
                el.setAttribute('aria-label', el.__idAria);
            }
        });

        // Update language toggle buttons & indicators
        const toggleAria = isEn
            ? 'ID / EN · Switch language to Bahasa Indonesia'
            : 'ID / EN · Ganti bahasa tampilan';

        langToggleButtons.forEach((btn) => {
            btn.setAttribute('aria-label', toggleAria);
            btn.setAttribute('title', toggleAria);
            btn.setAttribute('data-active-lang', normalized);
        });

        langOptSpans.forEach((opt) => {
            const optLang = opt.getAttribute('data-lang-opt');
            opt.classList.toggle('active', optLang === normalized);
        });

        langMobileLabels.forEach((lbl) => {
            lbl.textContent = isEn ? 'English (EN)' : 'Indonesia (ID)';
        });

        // Keep theme toggle labels synchronized with active language
        syncThemeUI(getCurrentTheme());

        // Refresh modal content if currently open
        refreshOpenModalLanguage();
    };

    const applyLanguage = (lang, persist = false) => {
        const normalized = lang === 'en' ? 'en' : 'id';
        if (persist) {
            langToggleButtons.forEach((btn) => {
                btn.classList.add('btn-switched');
                window.setTimeout(() => btn.classList.remove('btn-switched'), 350);
            });
        }
        syncLanguageUI(normalized);

        if (persist) {
            try {
                localStorage.setItem(LANG_STORAGE_KEY, normalized);
            } catch (err) {
                // Storage unavailable
            }
        }
    };

    // Initialize language from <html data-lang> set by <head> script
    syncLanguageUI(getCurrentLang());

    langToggleButtons.forEach((btn) => {
        btn.addEventListener('click', () => {
            const nextLang = getCurrentLang() === 'id' ? 'en' : 'id';
            applyLanguage(nextLang, true);
        });
    });

    // =========================================================================
    // 2. Navigation Scroll, Progress Telemetry & Active Section Spy
    // =========================================================================
    const siteNav = document.getElementById('siteNav');
    const navProgressBar = document.getElementById('navProgressBar');
    const sections = ['tentang', 'proyek', 'pengalaman', 'keahlian', 'sertifikasi', 'pendidikan', 'kontak'];
    const navLinks = document.querySelectorAll('nav.links a, .mobile-panel a');

    let sectionCache = [];
    const updateSectionCache = () => {
        sectionCache = sections.map((id) => {
            const el = document.getElementById(id);
            return { id, top: el ? el.offsetTop : 0 };
        });
    };
    updateSectionCache();
    window.addEventListener('resize', updateSectionCache, { passive: true });

    let scrollTicking = false;
    const performScrollUpdate = () => {
        const scrollY = window.scrollY;

        if (siteNav) {
            if (scrollY > 36) {
                siteNav.classList.add('solid');
            } else {
                siteNav.classList.remove('solid');
            }
        }

        if (navProgressBar) {
            const docHeight = document.documentElement.scrollHeight - window.innerHeight;
            const progress = docHeight > 0 ? Math.min(1, Math.max(0, scrollY / docHeight)) : 0;
            navProgressBar.style.transform = `scaleX(${progress.toFixed(4)})`;
        }

        const pos = scrollY + 150;
        let current = '';
        sectionCache.forEach((item) => {
            if (item.top <= pos) {
                current = item.id;
            }
        });

        navLinks.forEach((link) => {
            const href = link.getAttribute('href');
            if (href === `#${current}`) {
                link.classList.add('active');
            } else if (href && href.startsWith('#')) {
                link.classList.remove('active');
            }
        });
    };

    const onScroll = () => {
        if (!scrollTicking) {
            window.requestAnimationFrame(() => {
                performScrollUpdate();
                scrollTicking = false;
            });
            scrollTicking = true;
        }
    };

    window.addEventListener('scroll', onScroll, { passive: true });
    performScrollUpdate();

    // =========================================================================
    // 3. Intersection Observer for Scroll Reveals
    // =========================================================================
    const revealNodes = Array.from(document.querySelectorAll('.reveal'));
    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('in');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -48px 0px' });

        revealNodes.forEach((node) => observer.observe(node));
    } else {
        revealNodes.forEach((node) => node.classList.add('in'));
    }

    // =========================================================================
    // 4. Ambient Wave Animation in Hero (Viewport-Guarded, Non-Perpetual Offscreen)
    // =========================================================================
    const heroSection = document.getElementById('hero');
    if (!reduceMotion && heroSection) {
        let frame = 0;
        let t = 0;
        let isRunning = false;
        const paths = [1, 2, 3].map((number) => document.getElementById(`wavePath${number}`));
        const bases = [320, 380, 260];

        const animate = () => {
            if (!isRunning) return;
            t += 0.012;
            paths.forEach((path, index) => {
                if (!path) return;
                const amplitude = 26 - index * 4;
                const offset = Math.sin(t + index) * amplitude;
                const y = bases[index];
                path.setAttribute(
                    'd',
                    `M${-100 + Math.sin(t * 0.5) * 40},${y + offset} Q150,${y - offset} 300,${y + offset} T600,${y + offset} T900,${y + offset} T1200,${y + offset} T1500,${y + offset}`
                );
            });
            frame = requestAnimationFrame(animate);
        };

        const startWave = () => {
            if (!isRunning) {
                isRunning = true;
                frame = requestAnimationFrame(animate);
            }
        };

        const stopWave = () => {
            isRunning = false;
            if (frame) {
                cancelAnimationFrame(frame);
                frame = 0;
            }
        };

        if ('IntersectionObserver' in window) {
            const heroObserver = new IntersectionObserver((entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        startWave();
                    } else {
                        stopWave();
                    }
                });
            }, { threshold: 0.05 });
            heroObserver.observe(heroSection);
        } else {
            startWave();
        }
    }

    // =========================================================================
    // 5. Lightweight CSS 3D Perspective Tilt on Dossier & Case Cards
    // =========================================================================
    if (!reduceMotion && canHoverFine) {
        const tiltCards = Array.from(document.querySelectorAll('[data-tilt-card]'));
        tiltCards.forEach((card) => {
            card.addEventListener('pointermove', (e) => {
                const rect = card.getBoundingClientRect();
                if (!rect.width || !rect.height) return;
                const x = (e.clientX - rect.left) / rect.width - 0.5;
                const y = (e.clientY - rect.top) / rect.height - 0.5;
                const maxDeg = card.classList.contains('project-case-card') ? 2.2 : 4.5;
                card.style.setProperty('--rx', `${(-y * maxDeg).toFixed(2)}deg`);
                card.style.setProperty('--ry', `${(x * maxDeg * 1.15).toFixed(2)}deg`);
            });

            card.addEventListener('pointerleave', () => {
                card.style.setProperty('--rx', '0deg');
                card.style.setProperty('--ry', '0deg');
            });
        });
    }

    // =========================================================================
    // 6. Dynamic Grid Line Highlight on Specifications
    // =========================================================================
    if (canHoverFine) {
        const highlightElements = document.querySelectorAll('.strip-item, .spec-row');
        highlightElements.forEach((el) => {
            el.addEventListener('pointermove', (e) => {
                const rect = el.getBoundingClientRect();
                const x = e.clientX - rect.left;
                el.style.setProperty('--spec-x', `${x.toFixed(1)}px`);
            }, { passive: true });
        });
    }

    // =========================================================================
    // 7. Precision Telemetry Reticle Cursor (Desktop pointer:fine only)
    // =========================================================================
    const reticleEl = document.getElementById('cursorReticle');
    const reticleTag = document.getElementById('reticleTag');

    if (!reduceMotion && canHoverFine && reticleEl) {
        rootEl.classList.add('has-custom-cursor');

        let targetX = -100;
        let targetY = -100;
        let currentX = -100;
        let currentY = -100;
        let isTicking = false;
        let isPointerInWindow = false;

        const updateCursorPosition = () => {
            const dx = targetX - currentX;
            const dy = targetY - currentY;

            if (Math.abs(dx) > 0.1 || Math.abs(dy) > 0.1) {
                currentX += dx * 0.32;
                currentY += dy * 0.32;
                reticleEl.style.transform = `translate3d(${currentX.toFixed(2)}px, ${currentY.toFixed(2)}px, 0)`;
                isTicking = true;
                window.requestAnimationFrame(updateCursorPosition);
            } else {
                currentX = targetX;
                currentY = targetY;
                reticleEl.style.transform = `translate3d(${currentX.toFixed(2)}px, ${currentY.toFixed(2)}px, 0)`;
                isTicking = false;
            }
        };

        const onPointerMove = (e) => {
            targetX = e.clientX;
            targetY = e.clientY;

            if (!isPointerInWindow) {
                isPointerInWindow = true;
                rootEl.classList.add('cursor-active');
                rootEl.classList.remove('cursor-hidden');
            }

            if (!isTicking) {
                isTicking = true;
                window.requestAnimationFrame(updateCursorPosition);
            }

            // Contextual Telemetry Hit Test
            const target = e.target;
            if (!(target instanceof Element)) return;

            let mode = '';
            let tagText = 'SYS';

            if (target.closest('.contact-btn, button, .btn-gallery-open, [role="button"], input[type="submit"]')) {
                mode = 'is-action';
                tagText = 'ACT';
            } else if (target.closest('a[href]')) {
                mode = 'is-link';
                tagText = 'LINK';
            } else if (target.closest('.proj, .photo-frame, .campus-logo, .proj-thumb-card')) {
                mode = 'is-card';
                tagText = 'VIEW';
            } else if (target.closest('.strip-item, .spec-row, .skill-tags span, .fact-chip')) {
                mode = 'is-spec';
                tagText = 'SPEC';
            } else if (target.closest('input, textarea, p, h1, h2, h3, h4')) {
                mode = 'is-text';
                tagText = '';
            }

            reticleEl.className = `cursor-reticle ${mode}`.trim();
            if (reticleTag && tagText) {
                reticleTag.textContent = tagText;
            }
        };

        window.addEventListener('pointermove', onPointerMove, { passive: true });

        window.addEventListener('pointerdown', () => {
            reticleEl.classList.add('is-down');
        }, { passive: true });

        window.addEventListener('pointerup', () => {
            reticleEl.classList.remove('is-down');
        }, { passive: true });

        document.addEventListener('mouseleave', () => {
            isPointerInWindow = false;
            rootEl.classList.remove('cursor-active');
            rootEl.classList.add('cursor-hidden');
        });

        window.addEventListener('blur', () => {
            isPointerInWindow = false;
            rootEl.classList.remove('cursor-active');
            rootEl.classList.add('cursor-hidden');
        });
    }

    // =========================================================================
    // 8. Mobile Menu Toggle
    // =========================================================================
    const navToggle = document.getElementById('navToggle');
    const mobilePanel = document.getElementById('mobilePanel');

    if (navToggle && mobilePanel) {
        navToggle.addEventListener('click', () => {
            const isOpen = mobilePanel.classList.toggle('open');
            navToggle.setAttribute('aria-expanded', String(isOpen));
        });

        mobilePanel.querySelectorAll('a').forEach((link) => {
            link.addEventListener('click', () => {
                mobilePanel.classList.remove('open');
                navToggle.setAttribute('aria-expanded', 'false');
            });
        });
    }

    // =========================================================================
    // 9. Project Preview Gallery Modal / Lightbox + Focus Trap + Bilingual Support
    // =========================================================================
    const galleryDataEl = document.getElementById('portfolioGalleryData');
    const modal = document.getElementById('projectGalleryModal');
    const modalDialog = modal ? modal.querySelector('.project-modal-dialog') : null;
    const backdrop = document.getElementById('modalBackdrop');
    const closeBtn = document.getElementById('modalCloseBtn');
    const prevBtn = document.getElementById('modalPrevBtn');
    const nextBtn = document.getElementById('modalNextBtn');
    const modalProjectTag = document.getElementById('modalProjectTag');
    const modalProjectTitle = document.getElementById('modalProjectTitle');
    const modalCurrentIndex = document.getElementById('modalCurrentIndex');
    const modalTotalCount = document.getElementById('modalTotalCount');
    const modalExternalLink = document.getElementById('modalExternalLink');
    const modalTabs = document.getElementById('modalTabs');
    const modalMainImage = document.getElementById('modalMainImage');
    const modalImageLoader = document.getElementById('modalImageLoader');
    const modalSlideTag = document.getElementById('modalSlideTag');
    const modalSlideTitle = document.getElementById('modalSlideTitle');
    const modalSlideDesc = document.getElementById('modalSlideDesc');
    const modalThumbStrip = document.getElementById('modalThumbStrip');

    let galleryDatabase = {};
    if (galleryDataEl) {
        try {
            galleryDatabase = JSON.parse(galleryDataEl.textContent.trim());
        } catch (err) {
            console.error('Failed to parse portfolio gallery data:', err);
        }
    }

    let currentProjectSlug = null;
    let currentProject = null;
    let currentSlideIndex = 0;
    let lastActiveElement = null;

    const getLocalizedProjectData = (slug) => {
        const base = galleryDatabase[slug];
        if (!base) return null;
        const isEn = getCurrentLang() === 'en';
        const enOverride = isEn ? modalGalleryEn[slug] : null;
        const enSlides = enOverride?.gallery || enOverride?.slides || [];

        return {
            category: sanitizeEmDash(enOverride?.category || base.category || ''),
            projectTitle: sanitizeEmDash(enOverride?.projectTitle || base.projectTitle || ''),
            gallery: (base.gallery || []).map((slide, idx) => {
                const enSlide = enSlides[idx];
                return {
                    image: slide.image,
                    tag: sanitizeEmDash(enSlide?.tag || slide.tag || ''),
                    title: sanitizeEmDash(enSlide?.title || slide.title || ''),
                    short_title: sanitizeEmDash(enSlide?.short_title || slide.short_title || slide.title || ''),
                    description: sanitizeEmDash(enSlide?.description || slide.description || ''),
                };
            }),
        };
    };

    const setSlide = (index) => {
        if (!currentProject || !currentProject.gallery || currentProject.gallery.length === 0) return;

        const total = currentProject.gallery.length;
        if (index < 0) index = total - 1;
        if (index >= total) index = 0;

        currentSlideIndex = index;
        const slide = currentProject.gallery[index];

        if (modalCurrentIndex) modalCurrentIndex.textContent = String(index + 1);
        if (modalTotalCount) modalTotalCount.textContent = String(total);

        if (modalTabs) {
            modalTabs.querySelectorAll('.modal-tab-btn').forEach((btn, idx) => {
                const isActive = idx === index;
                btn.classList.toggle('active', isActive);
                btn.setAttribute('aria-selected', String(isActive));
            });
        }

        if (modalThumbStrip) {
            modalThumbStrip.querySelectorAll('.strip-thumb-btn').forEach((btn, idx) => {
                const isActive = idx === index;
                btn.classList.toggle('active', isActive);
                btn.setAttribute('aria-selected', String(isActive));
            });
        }

        if (modalMainImage) {
            modalMainImage.classList.add('fade-out');
            if (modalImageLoader) modalImageLoader.classList.add('active');

            const imageSrc = slide.image.startsWith('/') ? slide.image : `/${slide.image}`;
            const tempImg = new Image();
            tempImg.src = imageSrc;
            tempImg.onload = () => {
                modalMainImage.src = imageSrc;
                modalMainImage.alt = slide.title || 'Screenshot Project';
                if (modalImageLoader) modalImageLoader.classList.remove('active');
                modalMainImage.classList.remove('fade-out');
            };
            tempImg.onerror = () => {
                modalMainImage.src = imageSrc;
                if (modalImageLoader) modalImageLoader.classList.remove('active');
                modalMainImage.classList.remove('fade-out');
            };
        }

        if (modalExternalLink) {
            const externalHref = slide.image.startsWith('/') ? slide.image : `/${slide.image}`;
            modalExternalLink.setAttribute('href', externalHref);
        }

        if (modalSlideTag) modalSlideTag.textContent = slide.tag || '';
        if (modalSlideTitle) modalSlideTitle.textContent = slide.title || '';
        if (modalSlideDesc) modalSlideDesc.textContent = slide.description || '';
    };

    const renderModalProjectStructure = (projectData, activeIndex) => {
        if (modalProjectTag) modalProjectTag.textContent = projectData.category || 'Proyek Unggulan';
        if (modalProjectTitle) modalProjectTitle.textContent = projectData.projectTitle || 'Hasil Proyek';

        if (modalTabs) {
            modalTabs.innerHTML = '';
            projectData.gallery.forEach((slide, idx) => {
                const tabBtn = document.createElement('button');
                tabBtn.type = 'button';
                tabBtn.className = `modal-tab-btn ${idx === activeIndex ? 'active' : ''}`;
                tabBtn.setAttribute('role', 'tab');
                tabBtn.setAttribute('aria-selected', String(idx === activeIndex));
                tabBtn.innerHTML = `<span class="modal-tab-num">0${idx + 1}</span> <span>${slide.short_title || slide.title}</span>`;
                tabBtn.addEventListener('click', () => setSlide(idx));
                modalTabs.appendChild(tabBtn);
            });
        }

        if (modalThumbStrip) {
            modalThumbStrip.innerHTML = '';
            projectData.gallery.forEach((slide, idx) => {
                const thumbBtn = document.createElement('button');
                thumbBtn.type = 'button';
                thumbBtn.className = `strip-thumb-btn ${idx === activeIndex ? 'active' : ''}`;
                thumbBtn.title = slide.title;
                thumbBtn.setAttribute('role', 'tab');
                thumbBtn.setAttribute('aria-selected', String(idx === activeIndex));
                const thumbSrc = slide.image.startsWith('/') ? slide.image : `/${slide.image}`;
                thumbBtn.innerHTML = `<img src="${thumbSrc}" alt="${slide.title}" loading="lazy">`;
                thumbBtn.addEventListener('click', () => setSlide(idx));
                modalThumbStrip.appendChild(thumbBtn);
            });
        }
    };

    refreshOpenModalLanguage = () => {
        if (!modal || !modal.classList.contains('active') || !currentProjectSlug) return;
        const localized = getLocalizedProjectData(currentProjectSlug);
        if (!localized) return;
        currentProject = localized;
        renderModalProjectStructure(localized, currentSlideIndex);
        setSlide(currentSlideIndex);
    };

    const openModal = (slug, initialIndex = 0) => {
        if (!modal) return;
        const projectData = getLocalizedProjectData(slug);
        if (!projectData || !projectData.gallery || projectData.gallery.length === 0) return;

        currentProjectSlug = slug;
        currentProject = projectData;
        lastActiveElement = document.activeElement;

        renderModalProjectStructure(projectData, initialIndex);
        setSlide(initialIndex);

        modal.classList.add('active');
        modal.setAttribute('aria-hidden', 'false');
        document.body.classList.add('modal-open');

        if (closeBtn) closeBtn.focus();
    };

    const closeModal = () => {
        if (!modal) return;
        modal.classList.remove('active');
        modal.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('modal-open');
        if (lastActiveElement && typeof lastActiveElement.focus === 'function') {
            lastActiveElement.focus();
        }
    };

    document.querySelectorAll('[data-open-gallery]').forEach((trigger) => {
        const handleTrigger = (e) => {
            e.preventDefault();
            const slug = trigger.getAttribute('data-open-gallery');
            const slideIdx = parseInt(trigger.getAttribute('data-slide-index') || '0', 10);
            openModal(slug, slideIdx);
        };

        trigger.addEventListener('click', handleTrigger);
        trigger.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' || e.key === ' ') {
                handleTrigger(e);
            }
        });
    });

    if (closeBtn) closeBtn.addEventListener('click', closeModal);
    if (backdrop) backdrop.addEventListener('click', closeModal);
    if (prevBtn) prevBtn.addEventListener('click', () => setSlide(currentSlideIndex - 1));
    if (nextBtn) nextBtn.addEventListener('click', () => setSlide(currentSlideIndex + 1));

    // Keyboard navigation + Accessible Focus Trap inside Modal Dialog
    window.addEventListener('keydown', (e) => {
        if (!modal || !modal.classList.contains('active')) return;

        if (e.key === 'Escape') {
            e.preventDefault();
            closeModal();
            return;
        }

        if (e.key === 'ArrowLeft') {
            e.preventDefault();
            setSlide(currentSlideIndex - 1);
            return;
        }

        if (e.key === 'ArrowRight') {
            e.preventDefault();
            setSlide(currentSlideIndex + 1);
            return;
        }

        if (e.key === 'Tab' && modalDialog) {
            const focusableSelectors = [
                'button:not([disabled])',
                'a[href]',
                'input:not([disabled])',
                'select:not([disabled])',
                'textarea:not([disabled])',
                '[tabindex]:not([tabindex="-1"])',
            ].join(', ');

            const focusableNodes = Array.from(modalDialog.querySelectorAll(focusableSelectors)).filter(
                (el) => el.offsetParent !== null || el === document.activeElement
            );

            if (focusableNodes.length === 0) return;

            const firstEl = focusableNodes[0];
            const lastEl = focusableNodes[focusableNodes.length - 1];

            if (e.shiftKey) {
                if (document.activeElement === firstEl || !modalDialog.contains(document.activeElement)) {
                    e.preventDefault();
                    lastEl.focus();
                }
            } else if (document.activeElement === lastEl || !modalDialog.contains(document.activeElement)) {
                e.preventDefault();
                firstEl.focus();
            }
        }
    });

    // =========================================================================
    // 10. Service Worker Registration (PWA & Safe Offline Cache)
    // =========================================================================
    if ('serviceWorker' in navigator && (window.location.protocol === 'https:' || window.location.hostname === '127.0.0.1' || window.location.hostname === 'localhost')) {
        window.addEventListener('load', () => {
            navigator.serviceWorker.register('/sw.js').catch(() => {
                // Service worker registration skipped or blocked gracefully
            });
        });
    }
});
