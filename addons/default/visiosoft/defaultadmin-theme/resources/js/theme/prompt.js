(function (window, document) {

    const toggles = Array.from(
        document.querySelectorAll('[data-toggle="prompt"]')
    );

    toggles.forEach(function (toggle) {

        let handler = function (event) {

            event.preventDefault();

            let match = event.target.dataset.match;

            let config = {
                text: event.target.dataset.message.replace(':match:', match),
                title: event.target.dataset.title || null,
                icon: event.target.dataset.icon || null,
                closeOnEsc: event.target.dataset.esc == undefined ? false : (event.target.dataset.esc == 'true'),
                closeOnClickOutside: event.target.dataset.outside == undefined ? false : (event.target.dataset.outside == 'true'),
                content: "input",
                buttons: {
                    cancel: {
                        visible: true,
                        text: event.target.dataset.cancel_text || 'Cancel'
                    },
                    confirm: {
                        closeModal: event.target.dataset.close == undefined ? false : (event.target.dataset.close == 'true'),
                        text: event.target.dataset.confirm_text || 'Yes'
                    },
                }
            };

            let callback = function (value) {

                if (value === null) {

                    swal.close();

                    return false;
                }

                if (value === match) {

                    document.querySelector('.swal-content__input').classList.add('swal-content__input-success');

                    toggle.removeEventListener('click', handler);

                    /**
                     * Simulate a native click and let
                     * the default/intended action happen.
                     */
                    const click = document.createEvent('MouseEvents');
                    click.initEvent('click', true, false);
                    event.target.dispatchEvent(click);
                } else {

                    swal(config).then(callback);

                    document.querySelector('.swal-content__input').classList.add('swal-content__input-error');
                }
            };

            swal(config).then(callback);
        };

        toggle.addEventListener('click', handler);
    });
})(window, document);
