const onReady = (callback) => {
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', callback, { once: true });

        return;
    }

    callback();
};

onReady(() => {
    const form = document.querySelector('[data-demo-prepare-form]');

    if (form) {
        const button = form.querySelector('[data-demo-prepare-button]');
        const idleLabel = form.querySelector('[data-demo-prepare-idle]');
        const loadingLabel = form.querySelector('[data-demo-prepare-loading]');
        const status = form.querySelector('[data-demo-prepare-status]');
        const turnstileRequired = form.dataset.turnstileRequired === '1';

        const resolveTurnstileToken = () => {
            const tokenField = form.querySelector('input[name="cf-turnstile-response"]');

            if (!tokenField) {
                return '';
            }

            return tokenField.value.trim();
        };

        const applyReadyState = () => {
            if (!button) {
                return;
            }

            if (!turnstileRequired) {
                button.removeAttribute('disabled');

                return;
            }

            const token = resolveTurnstileToken();

            if (token === '') {
                button.setAttribute('disabled', 'disabled');

                return;
            }

            button.removeAttribute('disabled');
        };

        if (turnstileRequired) {
            const tokenObserver = window.setInterval(() => {
                applyReadyState();
            }, 250);

            form.addEventListener('submit', () => {
                window.clearInterval(tokenObserver);
            });
        } else {
            applyReadyState();
        }

        form.addEventListener('submit', (event) => {
            if (form.dataset.submitting === '1') {
                event.preventDefault();

                return;
            }

            if (turnstileRequired && resolveTurnstileToken() === '') {
                event.preventDefault();

                if (status) {
                    status.textContent = status.dataset.turnstileMessage ?? 'Please complete the security verification first.';
                    status.classList.remove('hidden');
                }

                applyReadyState();

                return;
            }

            form.dataset.submitting = '1';

            if (button) {
                button.setAttribute('disabled', 'disabled');
            }

            if (idleLabel) {
                idleLabel.classList.add('hidden');
            }

            if (loadingLabel) {
                loadingLabel.classList.remove('hidden');
                loadingLabel.classList.add('inline-flex');
            }

            if (status) {
                status.textContent = status.dataset.loadingMessage ?? status.textContent;
                status.classList.remove('hidden');
            }
        });
    }

    const track = document.querySelector('[data-trend-track]');
    const previousTrendButton = document.querySelector('[data-trend-prev]');
    const nextTrendButton = document.querySelector('[data-trend-next]');

    if (track && previousTrendButton && nextTrendButton) {
        const scrollAmount = () => Math.max(240, Math.floor(track.clientWidth * 0.7));

        previousTrendButton.addEventListener('click', () => {
            track.scrollBy({ left: -scrollAmount(), behavior: 'smooth' });
        });

        nextTrendButton.addEventListener('click', () => {
            track.scrollBy({ left: scrollAmount(), behavior: 'smooth' });
        });
    }

    const slider = document.querySelector('[data-home-slider]');

    if (!slider) {
        return;
    }

    const slides = Array.from(slider.querySelectorAll('[data-home-slide]'));
    const visuals = Array.from(document.querySelectorAll('[data-home-slide-visual]'));
    const dots = Array.from(slider.querySelectorAll('[data-home-slide-dot]'));
    const previousButton = slider.querySelector('[data-home-slide-prev]');
    const nextButton = slider.querySelector('[data-home-slide-next]');

    if (slides.length <= 1) {
        return;
    }

    let activeIndex = 0;
    let intervalId = null;

    const activateSlide = (index) => {
        activeIndex = (index + slides.length) % slides.length;

        slides.forEach((slide, slideIndex) => {
            const isActive = slideIndex === activeIndex;

            slide.classList.toggle('hidden', !isActive);
            slide.setAttribute('aria-hidden', isActive ? 'false' : 'true');
        });

        visuals.forEach((visual, visualIndex) => {
            const isActive = visualIndex === activeIndex;

            visual.classList.toggle('hidden', !isActive);
            visual.setAttribute('aria-hidden', isActive ? 'false' : 'true');
        });

        dots.forEach((dot, dotIndex) => {
            const isActive = dotIndex === activeIndex;

            dot.classList.toggle('w-7', isActive);
            dot.classList.toggle('bg-white', isActive);
            dot.classList.toggle('w-2.5', !isActive);
            dot.classList.toggle('bg-white/40', !isActive);
        });
    };

    const stopAutoPlay = () => {
        if (intervalId !== null) {
            window.clearInterval(intervalId);
            intervalId = null;
        }
    };

    const startAutoPlay = () => {
        stopAutoPlay();
        intervalId = window.setInterval(() => activateSlide(activeIndex + 1), 6000);
    };

    previousButton?.addEventListener('click', () => {
        activateSlide(activeIndex - 1);
        startAutoPlay();
    });

    nextButton?.addEventListener('click', () => {
        activateSlide(activeIndex + 1);
        startAutoPlay();
    });

    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            activateSlide(index);
            startAutoPlay();
        });
    });

    slider.addEventListener('mouseenter', stopAutoPlay);
    slider.addEventListener('mouseleave', startAutoPlay);
    slider.addEventListener('focusin', stopAutoPlay);
    slider.addEventListener('focusout', startAutoPlay);

    activateSlide(0);
    startAutoPlay();
});
