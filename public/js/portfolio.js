/**
 * Portfolio Client Script
 * Handles animations, intersection observer, and hero wave canvas.
 */
document.addEventListener('DOMContentLoaded', () => {
    // 1. Navigation Scroll & Active Section Spy
    const siteNav = document.getElementById('siteNav');
    const sections = ['tentang', 'proyek', 'pengalaman', 'keahlian', 'pendidikan', 'kontak'];
    const navLinks = document.querySelectorAll('nav.links a, .mobile-panel a');

    const onScroll = () => {
        if (!siteNav) return;
        if (window.scrollY > 40) {
            siteNav.classList.add('solid');
        } else {
            siteNav.classList.remove('solid');
        }

        const pos = window.scrollY + 140;
        let current = '';
        sections.forEach((id) => {
            const section = document.getElementById(id);
            if (section && section.offsetTop <= pos) {
                current = id;
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

    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();

    // 2. Intersection Observer for Scroll Reveals
    const revealNodes = Array.from(document.querySelectorAll('.reveal'));
    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('in');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12, rootMargin: '0px 0px -60px 0px' });

        revealNodes.forEach((node) => observer.observe(node));
    } else {
        revealNodes.forEach((node) => node.classList.add('in'));
    }

    // 3. Ambient Wave Animation in Hero
    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (!reduceMotion) {
        let frame = 0;
        let t = 0;
        const paths = [1, 2, 3].map((number) => document.getElementById(`wavePath${number}`));
        const bases = [320, 380, 260];

        const animate = () => {
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
        frame = requestAnimationFrame(animate);
    }

    // 4. Mobile Menu Toggle
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

    // 5. Project Preview Gallery Modal / Lightbox
    const galleryDataEl = document.getElementById('portfolioGalleryData');
    const modal = document.getElementById('projectGalleryModal');
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

    let currentProject = null;
    let currentSlideIndex = 0;
    let lastActiveElement = null;

    const setSlide = (index) => {
        if (!currentProject || !currentProject.gallery || currentProject.gallery.length === 0) return;

        const total = currentProject.gallery.length;
        if (index < 0) index = total - 1;
        if (index >= total) index = 0;

        currentSlideIndex = index;
        const slide = currentProject.gallery[index];

        if (modalCurrentIndex) modalCurrentIndex.textContent = String(index + 1);
        if (modalTotalCount) modalTotalCount.textContent = String(total);

        // Update active states on tabs & thumbnails
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

        // Animate Image change
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

    const openModal = (slug, initialIndex = 0) => {
        if (!modal) return;
        const projectData = galleryDatabase[slug];
        if (!projectData || !projectData.gallery || projectData.gallery.length === 0) return;

        currentProject = projectData;
        lastActiveElement = document.activeElement;

        if (modalProjectTag) modalProjectTag.textContent = projectData.category || 'Proyek Unggulan';
        if (modalProjectTitle) modalProjectTitle.textContent = projectData.projectTitle || 'Hasil Proyek';

        // Render Tabs
        if (modalTabs) {
            modalTabs.innerHTML = '';
            projectData.gallery.forEach((slide, idx) => {
                const tabBtn = document.createElement('button');
                tabBtn.type = 'button';
                tabBtn.className = `modal-tab-btn ${idx === initialIndex ? 'active' : ''}`;
                tabBtn.setAttribute('role', 'tab');
                tabBtn.setAttribute('aria-selected', String(idx === initialIndex));
                tabBtn.innerHTML = `<span class="modal-tab-num">0${idx + 1}</span> <span>${slide.short_title || slide.title}</span>`;
                tabBtn.addEventListener('click', () => setSlide(idx));
                modalTabs.appendChild(tabBtn);
            });
        }

        // Render Thumbnails
        if (modalThumbStrip) {
            modalThumbStrip.innerHTML = '';
            projectData.gallery.forEach((slide, idx) => {
                const thumbBtn = document.createElement('button');
                thumbBtn.type = 'button';
                thumbBtn.className = `strip-thumb-btn ${idx === initialIndex ? 'active' : ''}`;
                thumbBtn.title = slide.title;
                thumbBtn.setAttribute('role', 'tab');
                thumbBtn.setAttribute('aria-selected', String(idx === initialIndex));
                const thumbSrc = slide.image.startsWith('/') ? slide.image : `/${slide.image}`;
                thumbBtn.innerHTML = `<img src="${thumbSrc}" alt="${slide.title}" loading="lazy">`;
                thumbBtn.addEventListener('click', () => setSlide(idx));
                modalThumbStrip.appendChild(thumbBtn);
            });
        }

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

    // Attach click triggers to all preview buttons and thumb cards
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

    // Keyboard navigation
    window.addEventListener('keydown', (e) => {
        if (!modal || !modal.classList.contains('active')) return;

        if (e.key === 'Escape') {
            closeModal();
        } else if (e.key === 'ArrowLeft') {
            setSlide(currentSlideIndex - 1);
        } else if (e.key === 'ArrowRight') {
            setSlide(currentSlideIndex + 1);
        }
    });
});

