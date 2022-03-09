(function (window, document) {

    let fields = Array.prototype.slice.call(
        document.querySelectorAll('input[data-provides="anomaly.field_type.encrypted"]')
    );

    fields.forEach(function (field) {

        field.parentElement.querySelector('[data-toggle="text"]').addEventListener('click', function (event) {

            event.preventDefault();

            let indicator = event.target.querySelector('i');
            
            indicator.classList.toggle('fa-toggle-on');
            indicator.classList.toggle('fa-toggle-off');

            if (field.getAttribute('type') === 'password') {
                field.setAttribute('type', 'text');
            } else {
                field.setAttribute('type', 'password');
            }

            field.focus();

            return false;
        });
    });
})(window, document);
