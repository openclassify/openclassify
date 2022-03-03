(function (window, document) {

    const toggles = Array.from(
        document.querySelectorAll('[data-toggle="confirm"]')
    );

    toggles.forEach(function (toggle) {

        let handler = function (event) {

            event.preventDefault();

            swal({
                text: event.target.dataset.message || null,
                title: event.target.dataset.title || null,
                icon: event.target.dataset.icon || null,
                closeOnEsc: event.target.dataset.esc == undefined ? false : (event.target.dataset.esc == 'true'),
                closeOnClickOutside: event.target.dataset.outside == undefined ? false : (event.target.dataset.outside == 'true'),
                buttons: {
                    cancel: {
                        visible: true,
                        text: event.target.dataset.cancel_text || 'Cancel'
                    },
                    confirm: {
                        closeModal: event.target.dataset.close == undefined ? false : (event.target.dataset.close == 'true'),
                        text: event.target.dataset.confirm_text || 'OK'
                    },
                }
            }).then((value) => {
                if (value === true) {

                    toggle.removeEventListener('click', handler);

                    /**
                     * Simulate a native click and let
                     * the default/intended action happen.
                     */
                    const click = document.createEvent('MouseEvents');
                    click.initEvent('click', true, false);
                    event.target.dispatchEvent(click);
                }
            });
        };

        toggle.addEventListener('click', handler);
    });
})(window, document);
