(function (window, document) {

    let fields = Array.prototype.slice.call(
        document.querySelectorAll('textarea[data-provides="anomaly.field_type.markdown"]:not(.initialized)')
    );

    let triggers = Array.prototype.slice.call(
        document.querySelectorAll('a[data-toggle="tab"], a[data-toggle="lang"]')
    );

    fields.forEach(function (field) {

        /**
         * The plugin requires this or
         * it doubles up erroneously.
         */
        field.classList.add('initialized');

        let markdown = new SimpleMDE({element: field});

        triggers.forEach(function (trigger) {
            trigger.addEventListener('click', function () {
                setTimeout(function () {
                    markdown.codemirror.refresh();
                }, 100);
            });
        });
    });

})(window, document);
