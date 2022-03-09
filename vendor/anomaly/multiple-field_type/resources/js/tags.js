(function (window, document) {

    let fields = Array.prototype.slice.call(
        document.querySelectorAll('select[data-provides="anomaly.field_type.multiple"]')
    );

    fields.forEach(function (field) {
        new Choices(field, {
            removeItemButton: true,
            searchResultLimit: 10,
        });
    });
})(window, document);
