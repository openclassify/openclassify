let tag_fields = [];

(function (window, document) {

    let fields = Array.prototype.slice.call(
        document.querySelectorAll('input[data-provides="anomaly.field_type.tags"]')
    );

    fields.forEach(function (field) {
        if (!field.hasAttribute('readonly') && !field.hasAttribute('disabled')) {

            let config = {
                enforceWhitelist: (field.dataset.enforce_options == 'true'),
                dropdown: {
                    enabled: 0
                }
            };

            if (field.dataset.options != '[]') {
                config.whitelist = JSON.parse(field.dataset.options);
            }
            
             if (field.dataset.max != 'false') {
                config.maxTags = field.dataset.max;
            }

            let tag = new Tagify(field, config);

            tag.DOM.input.addEventListener('paste', function (event) {

                event.preventDefault();

                document.execCommand('insertHTML', false, event.clipboardData.getData('text/plain'));
            });
            
            tag_fields.push(tag);
        }
    });

})(window, document);
