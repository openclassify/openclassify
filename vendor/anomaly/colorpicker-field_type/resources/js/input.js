(function (window, document) {

    let fields = Array.prototype.slice.call(
        document.querySelectorAll('input[data-provides="anomaly.field_type.colorpicker"]')
    );

    fields.forEach(function (field) {

        let swatch = document.getElementById(field.name + '__swatch');
        let color = swatch.querySelector('.swatch__color');

        let picker = new ColorPicker.Default(field, {
            customClass: field.dataset.format != 'rgba' ? 'colorpicker--disable-opacity' : '',
            format: field.dataset.format,
            color: field.value,
            history: {
                hidden: true,
            },
        });

        field.value = field.dataset.value;

        /**
         * Open a native colorpicker
         * when and if available.
         */
        // swatch.addEventListener('click', function (e) {
        //
        //     e.preventDefault();
        // });

        picker.on('change', function (value) {
            color.style.backgroundColor = value[field.dataset.format];
        });
    });
})(window, document);
