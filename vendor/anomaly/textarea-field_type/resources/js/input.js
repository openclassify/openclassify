(function (window, document) {

    const fields = Array.prototype.slice.call(
        document.querySelectorAll('textarea[data-provides="anomaly.field_type.textarea"]')
    );

    fields.forEach(function (field) {

        let wrapper = field.parentElement;
        let max = field.getAttribute('data-max');

        /**
         * Automatically grow the textarea.
         */
        if (field.getAttribute('data-autogrow') == true) {
            autosize(field);
        }

        /**
         * Listen for keyup and update
         * the counter and contexts.
         */
        field.addEventListener('keyup', function () {

            let counter = wrapper.querySelector('.counter');
            let count = wrapper.querySelector('.count');

            if (count) {
                count.innerText = max
                    ? max - field.value.length
                    : field.value.length;
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
    
})(window, document);
