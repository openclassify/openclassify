// Reference https://developer.mozilla.org/en-US/docs/Web/API/Web_Storage_API/Using_the_Web_Storage_API
let storageAvailable = function (type) {

    try {
        let
            storage = window[type],
            x = '__storage_test__';

        storage.setItem(x, x);
        storage.removeItem(x);

        return true;
    }
    catch (e) {

        return e instanceof DOMException && (
                // everything except Firefox
            e.code === 22 ||
            // Firefox
            e.code === 1014 ||
            // test name field too, because code might not be present
            // everything except Firefox
            e.name === 'QuotaExceededError' ||
            // Firefox
            e.name === 'NS_ERROR_DOM_QUOTA_REACHED') &&
            // acknowledge QuotaExceededError only if there's something already stored
            storage.length !== 0;
    }
};

// Construction below, is the shorthand of $(document).ready() already.
(function (window, document) {

    let forms = Array.prototype.slice.call(
        document.querySelectorAll('form.form')
    );

    forms.forEach(function (form) {

        /**
         * Grab ALL the actual language
         * toggle's in our current form.
         */
        let toggles = Array.prototype.slice.call(
            form.querySelectorAll('[data-toggle="lang"]')
        );

        /**
         * Handle clicking a locale toggle
         * in the locales dropdown menus.
         */
        document.addEventListener('click', function (event) {

            /**
             * If this is not a lang toggle
             * then skip it all together.
             */
            if (!event.target.hasAttribute('data-toggle') || event.target.getAttribute('data-toggle') !== 'lang') {
                return;
            }

            event.preventDefault();

            /**
             * Grab ALL language menus
             * within our current form.
             */
            let menus = Array.prototype.slice.call(
                form.querySelectorAll('[data-dropdown="locales"]')
            );

            // This is the target locale.
            let locale = event.target.getAttribute('lang');

            // Replace menu text with selected locale.
            menus.map(menu => menu.innerHTML = event.target.innerHTML);

            // Remove active classes from all toggles.
            toggles.map(toggle => toggle.classList.remove('active'));

            // Mark only target locale toggles active.
            toggles.filter(function (toggle) {
                return toggle.getAttribute('lang') == locale;
            }).map(toggle => toggle.classList.add('active'));

            /**
             * Grab ALL form field groups
             * within our current form.
             */
            let groups = Array.prototype.slice.call(
                form.querySelectorAll('.form-group[lang]')
            );

            // Hide all input form groups.
            groups.map(group => group.classList.add('hidden'));

            // Display only the target locale form groups.
            groups.filter(function (group) {
                return group.getAttribute('lang') == locale;
            }).map(group => group.classList.remove('hidden'));

            if (storageAvailable('localStorage')) {
                localStorage.setItem('formTranslations', locale);
            }
        }, false);

        /**
         * Pre-select the locale
         * from local storage
         */
        if (storageAvailable('localStorage') && !!localStorage.getItem('formTranslations')) {

            let lang = localStorage.getItem('formTranslations');

            // Pre target locale toggles from storage.
            toggles.filter(function (toggle) {
                return toggle.getAttribute('lang') == lang;
            }).some(function (toggle) {
                toggle.dispatchEvent(new Event('click'));
                return true;
            });
        }
    });
})(window, document);
