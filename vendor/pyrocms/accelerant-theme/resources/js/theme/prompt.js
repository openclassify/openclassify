(function (window, document) {

    const toggles = Array.from(
        document.querySelectorAll('[data-toggle="prompt"]')
    );

    toggles.forEach(function (toggle) {

        let handler = function (event) {

            event.preventDefault();

            let match = toggle.dataset.match;

            let config = {
                text: toggle.dataset.message.replace(':match:', match),
                title: toggle.dataset.title || null,
                icon: toggle.dataset.icon || null,
                closeOnEsc: toggle.dataset.esc == undefined ? false : (toggle.dataset.esc == 'true'),
                closeOnClickOutside: toggle.dataset.outside == undefined ? false : (toggle.dataset.outside == 'true'),
                content: "input",
                buttons: {
                    cancel: {
                        visible: true,
                        text: toggle.dataset.cancel_text || 'Cancel'
                    },
                    confirm: {
                        closeModal: toggle.dataset.close == undefined ? false : (toggle.dataset.close == 'true'),
                        text: toggle.dataset.confirm_text || 'Yes'
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
                    toggle.dispatchEvent(click);
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
