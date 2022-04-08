(function (window, document) {

    /**
     * Initialize the fields
     */
    let initialize = function () {

        let fields = Array.prototype.slice.call(
            document.querySelectorAll('input[data-provides="anomaly.field_type.text"]')
        );

        fields.forEach(function (field) {
            const wrapper = field.parentElement;
            const max = field.dataset.max;

            /**
             * Check for an input mask alias, regex, or pattern.
             */
            if (field.dataset.alias != undefined && field.dataset.regex.alias > 1) {
                Inputmask(field.dataset.alias).mask(field);
            } else if (field.dataset.regex != undefined && field.dataset.regex.length > 1) {
                Inputmask({
                    regex: field.dataset.regex
                }).mask(field);
            } else if (field.dataset.mask != undefined && field.dataset.mask.length > 1) {
                Inputmask(field.dataset.mask).mask(field);
            }

            /**
             * Listen for keyup and update
             * the counter and contexts.
             */
            field.addEventListener('keyup', function () {

                const counter = wrapper.querySelector('.counter');
                const count = wrapper.querySelector('.count');

                if (count) {
                    count.innerText = max ? max - field.value.length : field.value.length;
                }

                if (counter) {
                    if (max && field.value.length > max) {
                        counter.classList.add('text-danger');
                    } else {
                        counter.classList.remove('text-danger');
                    }
                }
            });

            /**
             * Fire the count event initially
             * to cause an initial count.
             */
            field.dispatchEvent(new Event('keyup'));
        });
    }

    /**
     * Wait for InutMask to
     * load before initializing.
     *
     * @param callback
     * @returns {*}
     */
    function load(callback) {

        if (typeof Inputmask !== 'undefined') {
            return callback();
        }

        setTimeout(function () {
            load(callback);
        }, 250);
    }

    load(initialize);

})(window, document);
