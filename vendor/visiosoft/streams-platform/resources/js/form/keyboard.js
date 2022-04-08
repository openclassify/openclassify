(function (window, document) {

    let forms = Array.prototype.slice.call(
        document.querySelectorAll('form.form')
    );

    forms.forEach(function (form) {

        let actions = Array.prototype.slice.call(
            form.querySelectorAll('.form__actions button')
        );

        /**
         * When a key is pressed listen
         * for some common form actions.
         */
        Mousetrap.prototype.stopCallback = function () {
            return false;
        };

        Mousetrap.bind(['ctrl+s', 'command+s'], function (event) {

            event.preventDefault();

            actions[0].click();
        });

        Mousetrap.bind(['ctrl+shift+s', 'command+shift+s'], function (event) {

            event.preventDefault();

            actions[1].click();
        });
    });
})(window, document);
