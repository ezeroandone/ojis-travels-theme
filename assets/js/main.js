/**
/**
 * OJIS Travels & Advisory — Main JavaScript
 *
 * Covers:
 *  1. Header scroll behaviour (glassmorphism on scroll) + dual logo swap
 *  2. Mobile navigation toggle
 *  3. Scroll-reveal via Intersection Observer
 *  4. Impact counter animation
 *  5. Newsletter form (AJAX)
 *  6. Contact / Advisory inquiry form (AJAX)
 *  7. Active nav link detection
 *  8. Smooth anchor scroll with header offset
 *  9. Hero scroll indicator — clickable, scrolls to next section
 * 10. Micro-animations — icon interactions, stagger reveals
 *
 * ES6+ — no dependencies.
 */

'use strict';

/* ══════════════════════════════════════════════════════════════
   UTILITIES
══════════════════════════════════════════════════════════════ */

/**
 * Debounce — limits how often a function fires.
 * @param {Function} fn
 * @param {number}   delay ms
 * @returns {Function}
 */
function debounce(fn, delay = 100) {
    let timer;
    return (...args) => {
        clearTimeout(timer);
        timer = setTimeout(() => fn.apply(this, args), delay);
    };
}

/**
 * Safely query a single element; returns null instead of throwing.
 * @param {string}   selector
 * @param {Element}  [ctx=document]
 * @returns {Element|null}
 */
function qs(selector, ctx = document) {
    return ctx.querySelector(selector);
}

/**
 * Query all matching elements as a real array.
 * @param {string}  selector
 * @param {Element} [ctx=document]
 * @returns {Element[]}
 */
function qsa(selector, ctx = document) {
    return Array.from(ctx.querySelectorAll(selector));
}

/* ══════════════════════════════════════════════════════════════
   1. HEADER — SCROLL GLASSMORPHISM + LOGO SRC SWAP
══════════════════════════════════════════════════════════════ */
function initHeader() {
    const header = qs('#site-header');
    if (!header) return;

    const logoImg = qs('#site-logo-img');
    const SCROLL_THRESHOLD = 40;

    function swapLogo(isScrolled) {
        if (!logoImg) return;
        const srcTransparent = logoImg.getAttribute('data-src-transparent');
        const srcScrolled    = logoImg.getAttribute('data-src-scrolled');
        const targetSrc      = isScrolled ? srcScrolled : srcTransparent;
        if (!targetSrc) return;

        // Compare current src — normalise by stripping protocol+host for safety
        const currentPath = logoImg.src.replace(/^https?:\/\/[^/]+/, '');
        const targetPath  = targetSrc.replace(/^https?:\/\/[^/]+/, '');
        if (currentPath === targetPath) return; // already showing correct logo

        logoImg.classList.add('logo-swapping');
        logoImg.src = targetSrc;
        logoImg.addEventListener('load',  () => logoImg.classList.remove('logo-swapping'), { once: true });
        logoImg.addEventListener('error', () => logoImg.classList.remove('logo-swapping'), { once: true });
    }

    function updateHeader() {
        const isScrolled = window.scrollY > SCROLL_THRESHOLD;
        header.classList.toggle('scrolled', isScrolled);
        swapLogo(isScrolled);
    }

    // Set transparent logo immediately on load — don't wait for scroll event
    if (logoImg) {
        const srcTransparent = logoImg.getAttribute('data-src-transparent');
        if (srcTransparent) {
            logoImg.src = srcTransparent;
        }
    }

    updateHeader();
    window.addEventListener('scroll', debounce(updateHeader, 10), { passive: true });
}

/* ══════════════════════════════════════════════════════════════
   2. MOBILE NAVIGATION TOGGLE
══════════════════════════════════════════════════════════════ */
function initMobileNav() {
    const toggle  = qs('#mobile-menu-toggle');
    const menu    = qs('#mobile-menu');
    const menuIcon  = qs('.menu-icon',  toggle);
    const closeIcon = qs('.close-icon', toggle);

    if (!toggle || !menu) return;

    let isOpen = false;

    function openMenu() {
        isOpen = true;
        menu.classList.remove('hidden');
        // Small rAF delay ensures the transition runs after display:block
        requestAnimationFrame(() => {
            requestAnimationFrame(() => {
                menu.classList.add('is-open');
            });
        });
        toggle.setAttribute('aria-expanded', 'true');
        toggle.setAttribute('aria-label', 'Close navigation menu');
        menuIcon?.classList.add('hidden');
        closeIcon?.classList.remove('hidden');
        document.body.style.overflow = 'hidden'; // prevent background scroll
    }

    function closeMenu() {
        isOpen = false;
        menu.classList.remove('is-open');
        toggle.setAttribute('aria-expanded', 'false');
        toggle.setAttribute('aria-label', 'Open navigation menu');
        menuIcon?.classList.remove('hidden');
        closeIcon?.classList.add('hidden');
        document.body.style.overflow = '';

        // Wait for transition to finish before hiding
        menu.addEventListener('transitionend', () => {
            if (!isOpen) menu.classList.add('hidden');
        }, { once: true });
    }

    toggle.addEventListener('click', () => {
        isOpen ? closeMenu() : openMenu();
    });

    // Close on nav link click
    qsa('a', menu).forEach(link => {
        link.addEventListener('click', closeMenu);
    });

    // Close on Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && isOpen) closeMenu();
    });

    // Close on outside click
    document.addEventListener('click', (e) => {
        if (isOpen && !menu.contains(e.target) && !toggle.contains(e.target)) {
            closeMenu();
        }
    });

    // Close on resize to desktop breakpoint
    window.addEventListener('resize', debounce(() => {
        if (window.innerWidth >= 1024 && isOpen) closeMenu();
    }, 200));
}

/* ══════════════════════════════════════════════════════════════
   3. SCROLL REVEAL — INTERSECTION OBSERVER
══════════════════════════════════════════════════════════════ */
function initScrollReveal() {
    // Skip if user prefers reduced motion
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        // Make all reveal elements immediately visible
        qsa('.reveal-element, .reveal-left, .reveal-right, .reveal-scale').forEach(el => {
            el.classList.add('is-visible');
        });
        return;
    }

    const revealSelectors = ['.reveal-element', '.reveal-left', '.reveal-right', '.reveal-scale'];
    const elements = qsa(revealSelectors.join(', '));

    if (!elements.length) return;

    const observerOptions = {
        root:       null,         // viewport
        rootMargin: '0px 0px -60px 0px', // trigger 60px before bottom edge
        threshold:  0.08,
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target); // animate once only
            }
        });
    }, observerOptions);

    elements.forEach(el => observer.observe(el));
}

/* ══════════════════════════════════════════════════════════════
   4. IMPACT COUNTER ANIMATION
══════════════════════════════════════════════════════════════ */
function initCounters() {
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        // Just display final values immediately
        qsa('.impact-counter').forEach(el => {
            const end    = parseFloat(el.dataset.end ?? '0');
            const suffix = el.dataset.suffix ?? '';
            el.textContent = end + suffix;
        });
        return;
    }

    const counters = qsa('.impact-counter');
    if (!counters.length) return;

    const DURATION = 1800; // ms

    function animateCounter(el) {
        const end    = parseFloat(el.dataset.end ?? '0');
        const suffix = el.dataset.suffix ?? '';
        const start  = 0;
        let startTime = null;

        // Ease out cubic
        function easeOutCubic(t) {
            return 1 - Math.pow(1 - t, 3);
        }

        function step(timestamp) {
            if (!startTime) startTime = timestamp;
            const elapsed  = timestamp - startTime;
            const progress = Math.min(elapsed / DURATION, 1);
            const current  = Math.round(easeOutCubic(progress) * (end - start) + start);

            el.textContent = current.toLocaleString() + suffix;

            if (progress < 1) {
                requestAnimationFrame(step);
            } else {
                el.textContent = end.toLocaleString() + suffix;
            }
        }

        requestAnimationFrame(step);
    }

    const counterObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateCounter(entry.target);
                counterObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.3 });

    counters.forEach(counter => counterObserver.observe(counter));
}

/* ══════════════════════════════════════════════════════════════
   5. NEWSLETTER FORM — AJAX SUBMISSION
══════════════════════════════════════════════════════════════ */
function initNewsletterForms() {
    const formSelectors = [
        '#footer-newsletter-form',
        '#homepage-newsletter-form',
        '#insights-newsletter-form',
    ];

    formSelectors.forEach(selector => {
        const form = qs(selector);
        if (!form) return;

        const statusEl = form.querySelector('[role="status"]');

        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            const emailInput = form.querySelector('input[type="email"]');
            const email = emailInput?.value?.trim() ?? '';

            if (!email || !isValidEmail(email)) {
                showFormStatus(statusEl, 'Please enter a valid email address.', 'error');
                emailInput?.focus();
                return;
            }

            const submitBtn = form.querySelector('button[type="submit"]');
            setButtonLoading(submitBtn, true);

            try {
                const data = new FormData();
                data.append('action', 'ojis_newsletter');
                data.append('email',  email);

                // Use nonce from WordPress localized data if available
                if (typeof ojisData !== 'undefined' && ojisData.nonce) {
                    data.append('nonce', ojisData.nonce);
                }

                const ajaxUrl = (typeof ojisData !== 'undefined' && ojisData.ajaxUrl)
                    ? ojisData.ajaxUrl
                    : '/wp-admin/admin-ajax.php';

                const response = await fetch(ajaxUrl, {
                    method: 'POST',
                    body:   data,
                });

                const json = await response.json();

                if (json.success) {
                    showFormStatus(statusEl, json.data?.message ?? 'Thank you for subscribing!', 'success');
                    form.reset();
                } else {
                    showFormStatus(statusEl, json.data?.message ?? 'Something went wrong. Please try again.', 'error');
                }
            } catch {
                showFormStatus(statusEl, 'Network error. Please check your connection and try again.', 'error');
            } finally {
                setButtonLoading(submitBtn, false);
            }
        });
    });
}

/* ══════════════════════════════════════════════════════════════
   6. ADVISORY CONTACT FORM — AJAX SUBMISSION
══════════════════════════════════════════════════════════════ */
function initContactForm() {
    const form = qs('#advisory-contact-form');
    if (!form) return;

    const feedback  = qs('#contact-form-feedback');
    const submitBtn = qs('#contact-submit-btn');

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        // Browser-level validation first
        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }

        // Consent checkbox
        const consent = form.querySelector('#contact-consent');
        if (consent && !consent.checked) {
            showFeedback(feedback, 'Please confirm your consent to proceed.', 'error');
            consent.focus();
            return;
        }

        setButtonLoading(submitBtn, true);
        hideFeedback(feedback);

        try {
            const formData = new FormData(form);
            formData.append('action', 'ojis_contact');

            // WordPress nonce from localized data
            if (typeof ojisData !== 'undefined' && ojisData.nonce) {
                formData.set('nonce', ojisData.nonce);
            }

            const ajaxUrl = (typeof ojisData !== 'undefined' && ojisData.ajaxUrl)
                ? ojisData.ajaxUrl
                : '/wp-admin/admin-ajax.php';

            const response = await fetch(ajaxUrl, {
                method: 'POST',
                body:   formData,
            });

            const json = await response.json();

            if (json.success) {
                showFeedback(feedback, json.data?.message ?? 'Your message has been sent. We will be in touch shortly.', 'success');
                form.reset();
                // Scroll feedback into view
                feedback.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            } else {
                showFeedback(feedback, json.data?.message ?? 'Something went wrong. Please try again.', 'error');
            }
        } catch {
            showFeedback(feedback, 'Network error. Please check your connection and try again.', 'error');
        } finally {
            setButtonLoading(submitBtn, false);
        }
    });
}

/* ══════════════════════════════════════════════════════════════
   7. ACTIVE NAV LINK DETECTION
══════════════════════════════════════════════════════════════ */
function initActiveNavLinks() {
    const currentPath = window.location.pathname.replace(/\/$/, '');

    qsa('#desktop-nav a, #mobile-menu a').forEach(link => {
        const linkPath = new URL(link.href, window.location.origin).pathname.replace(/\/$/, '');
        if (linkPath === currentPath || (currentPath === '' && linkPath === '')) {
            link.setAttribute('aria-current', 'page');
            link.classList.add('text-forest', 'font-semibold');
        }
    });
}

/* ══════════════════════════════════════════════════════════════
   8. SMOOTH SCROLL WITH HEADER OFFSET
══════════════════════════════════════════════════════════════ */
function initSmoothScroll() {
    const headerHeight = parseInt(
        getComputedStyle(document.documentElement).getPropertyValue('--header-height') || '80',
        10
    );

    document.addEventListener('click', (e) => {
        const link = e.target.closest('a[href^="#"]');
        if (!link) return;

        const targetId = link.getAttribute('href').slice(1);
        if (!targetId) return;

        const target = document.getElementById(targetId);
        if (!target) return;

        e.preventDefault();
        const top = target.getBoundingClientRect().top + window.scrollY - headerHeight - 16;
        window.scrollTo({ top, behavior: 'smooth' });

        // Update URL without triggering scroll
        history.pushState(null, '', `#${targetId}`);

        // Move focus to target for accessibility
        target.setAttribute('tabindex', '-1');
        target.focus({ preventScroll: true });
        target.addEventListener('blur', () => target.removeAttribute('tabindex'), { once: true });
    });
}

/* ══════════════════════════════════════════════════════════════
   HELPER FUNCTIONS
══════════════════════════════════════════════════════════════ */

/**
 * Basic email format validation.
 * @param {string} email
 * @returns {boolean}
 */
function isValidEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}

/**
 * Toggle button loading state.
 * @param {HTMLButtonElement|null} btn
 * @param {boolean}                loading
 */
function setButtonLoading(btn, loading) {
    if (!btn) return;
    const submitText  = btn.querySelector('.submit-text');
    const loadingText = btn.querySelector('.loading-text');

    btn.disabled = loading;

    if (submitText && loadingText) {
        submitText.classList.toggle('hidden', loading);
        loadingText.classList.toggle('hidden', !loading);
        loadingText.classList.toggle('flex', loading);
    }

    btn.setAttribute('aria-busy', loading ? 'true' : 'false');
}

/**
 * Show inline form status (newsletter forms).
 * @param {Element|null} el
 * @param {string}       message
 * @param {'success'|'error'} type
 */
function showFormStatus(el, message, type = 'success') {
    if (!el) return;
    el.textContent = message;
    el.classList.remove('hidden', 'text-eco', 'text-red-400');
    el.classList.add(type === 'success' ? 'text-eco' : 'text-red-400');
}

/**
 * Show feedback block (contact form).
 * @param {Element|null} el
 * @param {string}       message
 * @param {'success'|'error'} type
 */
function showFeedback(el, message, type = 'success') {
    if (!el) return;
    el.textContent = message;
    el.classList.remove(
        'hidden',
        'bg-eco/10',    'text-forest',    'border', 'border-eco/30',
        'bg-red-50',    'text-red-700',   'border-red-200'
    );

    if (type === 'success') {
        el.classList.add('bg-eco/10', 'text-forest', 'border', 'border-eco/30');
    } else {
        el.classList.add('bg-red-50', 'text-red-700', 'border', 'border-red-200');
    }
}

/**
 * Hide feedback block.
 * @param {Element|null} el
 */
function hideFeedback(el) {
    if (!el) return;
    el.classList.add('hidden');
    el.textContent = '';
}

/* ══════════════════════════════════════════════════════════════
   9. HERO SCROLL INDICATOR — click to scroll to next section
══════════════════════════════════════════════════════════════ */
function initHeroScrollButton() {
    const btn        = qs('#hero-scroll-btn');
    const heroSection = qs('.hero-section');
    if (!btn) return;

    btn.addEventListener('click', () => {
        // Find the first sibling section after the hero
        const nextSection = heroSection
            ? heroSection.nextElementSibling
            : qs('main > section:nth-child(2)');

        if (nextSection) {
            const headerHeight = parseInt(
                getComputedStyle(document.documentElement)
                    .getPropertyValue('--header-height') || '80',
                10
            );
            const top = nextSection.getBoundingClientRect().top
                      + window.scrollY
                      - headerHeight;

            window.scrollTo({ top, behavior: 'smooth' });
        }
    });

    // Hide the indicator after the user scrolls past the hero
    if (heroSection) {
        const hideObserver = new IntersectionObserver(
            ([entry]) => {
                btn.style.opacity         = entry.isIntersecting ? '' : '0';
                btn.style.pointerEvents   = entry.isIntersecting ? '' : 'none';
            },
            { threshold: 0.1 }
        );
        hideObserver.observe(heroSection);
    }
}

/* ══════════════════════════════════════════════════════════════
   10. MICRO-ANIMATIONS — icon interactions, tilt, stagger
══════════════════════════════════════════════════════════════ */
function initMicroAnimations() {
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

    // ── 10a. Magnetic icon lift on interactive elements ───────────
    // Service/pillar icon circles get a subtle lift on parent hover
    qsa('.pillar-card, .contact-info-card, .ojis-stat-card').forEach(card => {
        const icon = qs('.material-symbols-outlined', card);
        if (!icon) return;

        card.addEventListener('mouseenter', () => {
            icon.style.transition = 'transform 0.35s cubic-bezier(0.34,1.56,0.64,1)';
            icon.style.transform  = 'translateY(-4px) scale(1.15)';
        });
        card.addEventListener('mouseleave', () => {
            icon.style.transform  = 'translateY(0) scale(1)';
        });
    });

    // ── 10b. Service feature items — icon nudge on row hover ──────
    qsa('.flex.items-start.gap-4, .flex.items-start.gap-3').forEach(row => {
        const icon = qs('.material-symbols-outlined', row);
        if (!icon) return;

        row.addEventListener('mouseenter', () => {
            icon.style.transition = 'transform 0.25s cubic-bezier(0.22,1,0.36,1), color 0.2s ease';
            icon.style.transform  = 'scale(1.2) rotate(-6deg)';
        });
        row.addEventListener('mouseleave', () => {
            icon.style.transform  = 'scale(1) rotate(0deg)';
        });
    });

    // ── 10c. Founder stat cards in hero — icon sparkle ────────────
    qsa('.hero-stats .bg-white\\/10').forEach(card => {
        const icon = qs('.material-symbols-outlined', card);
        if (!icon) return;

        card.addEventListener('mouseenter', () => {
            icon.style.transition = 'transform 0.3s cubic-bezier(0.34,1.56,0.64,1), color 0.2s ease';
            icon.style.transform  = 'scale(1.25) rotate(8deg)';
            icon.style.color      = '#ffffff';
        });
        card.addEventListener('mouseleave', () => {
            icon.style.transform  = 'scale(1) rotate(0deg)';
            icon.style.color      = '';
        });
    });

    // ── 10d. Impact counter section icons ─────────────────────────
    qsa('.impact-counter').forEach(counter => {
        const parent = counter.closest('[class*="reveal-element"]') || counter.parentElement;
        const icon   = parent ? qs('.material-symbols-outlined', parent) : null;
        if (!icon) return;

        parent.addEventListener('mouseenter', () => {
            icon.style.transition = 'transform 0.35s cubic-bezier(0.34,1.56,0.64,1)';
            icon.style.transform  = 'translateY(-5px) scale(1.2)';
        });
        parent.addEventListener('mouseleave', () => {
            icon.style.transform  = 'translateY(0) scale(1)';
        });
    });

    // ── 10e. Footer social links — staggered entrance on scroll ───
    const socialLinks = qsa('.footer-social-link');
    if (socialLinks.length) {
        const socialObserver = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (!entry.isIntersecting) return;
                const links = qsa('.footer-social-link', entry.target);
                links.forEach((link, i) => {
                    setTimeout(() => {
                        link.style.transition = 'opacity 0.4s ease, transform 0.4s cubic-bezier(0.22,1,0.36,1)';
                        link.style.opacity    = '1';
                        link.style.transform  = 'translateY(0)';
                    }, i * 60);
                });
                socialObserver.unobserve(entry.target);
            });
        }, { threshold: 0.3 });

        // Set initial hidden state
        socialLinks.forEach(link => {
            link.style.opacity   = '0';
            link.style.transform = 'translateY(10px)';
        });

        const socialContainer = qs('.footer-brand');
        if (socialContainer) socialObserver.observe(socialContainer);
    }

    // ── 10f. Insights post cards — staggered image reveal ─────────
    qsa('article .aspect-video').forEach((thumb, i) => {
        thumb.style.overflow   = 'hidden';
        const img = qs('img', thumb);
        if (img) {
            img.style.transition = `transform 0.5s cubic-bezier(0.22,1,0.36,1) ${i * 40}ms`;
        }
    });

    // ── 10g. Section headings — word shimmer on view ───────────────
    // Adds a very subtle left-border accent that slides in when heading enters view
    const headingObserver = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('heading-visible');
                headingObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });

    qsa('.section-heading').forEach(h => {
        h.style.transition = 'opacity 0.5s ease, transform 0.5s cubic-bezier(0.22,1,0.36,1)';
        headingObserver.observe(h);
    });

    // ── 10h. CTA buttons — ripple effect on click ─────────────────
    qsa('.btn-primary, .btn-eco').forEach(btn => {
        btn.addEventListener('click', function(e) {
            const rect    = this.getBoundingClientRect();
            const x       = e.clientX - rect.left;
            const y       = e.clientY - rect.top;
            const ripple  = document.createElement('span');

            ripple.style.cssText = `
                position: absolute;
                width: 0; height: 0;
                left: ${x}px; top: ${y}px;
                background: rgba(255,255,255,0.25);
                border-radius: 50%;
                transform: translate(-50%,-50%);
                animation: rippleOut 0.55s ease-out forwards;
                pointer-events: none;
            `;

            // Ensure button has position:relative for the ripple
            this.style.position = 'relative';
            this.style.overflow = 'hidden';
            this.appendChild(ripple);
            setTimeout(() => ripple.remove(), 600);
        });
    });
}

/* ── Ripple keyframe — injected into document head ───────────── */
function injectRippleKeyframe() {
    if (document.getElementById('ojis-ripple-style')) return;
    const style = document.createElement('style');
    style.id = 'ojis-ripple-style';
    style.textContent = `
        @keyframes rippleOut {
            to { width: 300px; height: 300px; opacity: 0; }
        }
    `;
    document.head.appendChild(style);
}

/* ══════════════════════════════════════════════════════════════
   BOOT — RUN EVERYTHING ON DOM READY
══════════════════════════════════════════════════════════════ */
function boot() {
    injectRippleKeyframe();
    initHeader();
    initMobileNav();
    initScrollReveal();
    initCounters();
    initNewsletterForms();
    initContactForm();
    initActiveNavLinks();
    initSmoothScroll();
    initHeroScrollButton();
    initMicroAnimations();
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', boot);
} else {
    // DOM already parsed (deferred script or inline after body)
    boot();
}
