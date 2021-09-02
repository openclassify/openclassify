function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
};


if (getUrlParameter('view') === "classifiedanced") {
    $('.fast-update').on('change', function () {
        var classifiedanced_value = $(this).val(), classifiedanced_entry_id = $(this).data('entry_id'),
            classifiedanced_column = $(this).data('column'), classifiedanced_type = $(this).attr('type');

        if (classifiedanced_type === "checkbox") {
            classifiedanced_value = ($(this).prop('checked')) ? 1 : 0;
        }

        crudAjax({
            'edit_column': classifiedanced_column,
            'edit_entry_id': classifiedanced_entry_id,
            'edit_value': classifiedanced_value
        }, classifiedanced_update_url, 'POST')
    })
}