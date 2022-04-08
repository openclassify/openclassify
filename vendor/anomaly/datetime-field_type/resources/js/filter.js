(function (window, document) {

    let fields = Array.prototype.slice.call(
        document.querySelectorAll('input[data-provides="anomaly.field_type.datetime"]')
    );

    // Initialize inputs
    fields.forEach(function (field) {

        let options = {
            mode: 'range',
            altInput: true,
            allowInput: true,
            minuteIncrement: field.getAttribute('data-step') || 1,
            dateFormat: field.getAttribute('data-datetime-format')
        };

        field.flatpickr(options);
    });
})(window, document);
