(function (window, document) {

    let fields = Array.prototype.slice.call(
        document.querySelectorAll('input[data-provides="anomaly.field_type.datetime"]')
    );

    // Initialize inputs
    fields.forEach(function (field) {

        $(field).datetimeEntry({
            spinnerImage: '',
            timeSteps: [1, field.getAttribute('data-step')],
            datetimeFormat: field.getAttribute('data-datetime-format')
        });
    });
})(window, document);
