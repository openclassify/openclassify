(function (window, document) {

    let fields = Array.prototype.slice.call(
        document.querySelectorAll('select[data-provides="anomaly.field_type.addon"][data-search]')
    );

    fields.forEach(function (field) {
        new Choices(field);
    });
})(window, document);
