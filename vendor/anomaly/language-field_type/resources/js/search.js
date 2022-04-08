(function (window, document) {

    let fields = Array.from(
        document.querySelectorAll('select[data-provides="anomaly.field_type.language"].search')
    );

    fields.forEach(function (field) {
        new Choices(field, {
            shouldSort: false,
        });
    });
})(window, document);
