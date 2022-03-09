(function (window, document) {

    let fields = Array.prototype.slice.call(
        document.querySelectorAll('[data-toggle="anomaly.field_type.boolean"]')
    );

    fields.forEach(function (field) {

        field.addEventListener('click', function (event) {

            let request = new XMLHttpRequest();

            request.open('POST', REQUEST_ROOT_PATH + '/admin/boolean-field_type/toggle', true);
            request.setRequestHeader('Content-Type', 'application/json');

            request.send(JSON.stringify({
                _token: CSRF_TOKEN,
                checked: event.target.checked,
                entry: event.target.dataset.entry,
                field: event.target.dataset.field,
                stream: event.target.dataset.stream,
                namespace: event.target.dataset.namespace
            }));

        });
    });
})(window, document);
