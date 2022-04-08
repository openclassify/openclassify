(function (window, document) {

    let fields = Array.prototype.slice.call(
        document.querySelectorAll('[data-provides="anomaly.field_type.slider"]')
    );

    // Initialize sliders
    fields.forEach(function (field) {

        field.addEventListener('input', function () {
            field.parentNode.querySelector('.value').innerText = this.value;
        });
    });
})(window, document);
