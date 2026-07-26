const onReady = (callback) => {
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', callback, { once: true });

        return;
    }

    callback();
};

onReady(() => {
    const form = document.querySelector('[data-demo-prepare-form]');

    if (!form) {
        return;
    }

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
});
