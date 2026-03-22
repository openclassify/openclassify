import './bootstrap';
import '../../Modules/Conversation/resources/assets/js/conversation';
import '../css/modules/panel-quick-create.css';
import './modules/listing-filters';
import './modules/site-home';
import { animate, createTimeline, stagger } from 'animejs';

const prefersReducedMotion = () => window.matchMedia('(prefers-reduced-motion: reduce)').matches;

const onReady = (callback) => {
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', callback, { once: true });
        return;
    }

    callback();
};

const animateHeader = () => {
    const nav = document.querySelector('[data-anim-nav]');
    const categoryRow = document.querySelector('[data-anim-header-row]');

    if (nav) {
        animate(nav, {
            opacity: [0, 1],
            translateY: [-18, 0],
            duration: 700,
            ease: 'outExpo',
        });
    }

    if (categoryRow) {
        animate(categoryRow.querySelectorAll('.oc-category-pill, .oc-category-link'), {
            opacity: [0, 1],
            translateY: [-10, 0],
            delay: stagger(45, { start: 140 }),
            duration: 520,
            ease: 'outQuad',
        });
    }
};

const animateHomeHero = () => {
    const hero = document.querySelector('[data-home-hero]');

    if (!hero) {
        return;
    }

    const copy = hero.querySelector('[data-home-hero-copy]');
    const visual = hero.querySelector('[data-home-hero-visual]');
    const timeline = createTimeline({
        defaults: {
            duration: 720,
            ease: 'outExpo',
        },
    });

    if (copy) {
        timeline.add(copy.querySelectorAll('[data-home-slide] > *'), {
            opacity: [0, 1],
            translateY: [28, 0],
            delay: stagger(80),
        });
    }

    if (visual) {
        timeline.add(visual, {
            opacity: [0, 1],
            translateX: [36, 0],
            scale: [0.96, 1],
        }, '<+=120');

        animate(visual, {
            translateY: [
                { to: -8, duration: 2800, ease: 'inOutSine' },
                { to: 0, duration: 2800, ease: 'inOutSine' },
            ],
            loop: true,
            alternate: true,
        });
    }
};

const animateOnView = (selector, itemSelector, options = {}) => {
    const sections = document.querySelectorAll(selector);

    if (!sections.length) {
        return;
    }

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (!entry.isIntersecting) {
                return;
            }

            const section = entry.target;
            const items = itemSelector ? section.querySelectorAll(itemSelector) : [section];

            animate(items, {
                opacity: [0, 1],
                translateY: [24, 0],
                delay: stagger(options.stagger ?? 70),
                duration: options.duration ?? 650,
                ease: options.ease ?? 'outExpo',
            });

            observer.unobserve(section);
        });
    }, {
        threshold: 0.18,
        rootMargin: '0px 0px -8% 0px',
    });

    sections.forEach((section) => observer.observe(section));
};

const bindHoverLift = (selector, distance = 6) => {
    document.querySelectorAll(selector).forEach((element) => {
        element.addEventListener('mouseenter', () => {
            animate(element, {
                translateY: -distance,
                scale: 1.015,
                duration: 260,
                ease: 'outQuad',
            });
        });

        element.addEventListener('mouseleave', () => {
            animate(element, {
                translateY: 0,
                scale: 1,
                duration: 320,
                ease: 'outExpo',
            });
        });
    });
};

const animateFooter = () => {
    const footer = document.querySelector('[data-anim-footer]');

    if (!footer) {
        return;
    }

    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (!entry.isIntersecting) {
                return;
            }

            animate(footer.querySelectorAll('[data-anim-footer-item]'), {
                opacity: [0, 1],
                translateY: [26, 0],
                delay: stagger(90),
                duration: 620,
                ease: 'outExpo',
            });

            observer.disconnect();
        });
    }, { threshold: 0.2 });

    observer.observe(footer);
};

onReady(() => {
    if (prefersReducedMotion()) {
        return;
    }

    animateHeader();
    animateHomeHero();
    animateOnView('[data-home-section]', '[data-home-category-card], [data-home-listing-card], h2, a, article, section > div');
    animateFooter();
    bindHoverLift('[data-home-category-card]', 5);
    bindHoverLift('[data-home-listing-card]', 4);
});
