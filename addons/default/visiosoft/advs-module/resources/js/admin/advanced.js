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


if (getUrlParameter('view') === "advanced") {
    $('.fast-update').on('change', function () {
        var advanced_value = $(this).val(), advanced_entry_id = $(this).data('entry_id'),
            advanced_column = $(this).data('column'), advanced_type = $(this).attr('type');

        if (advanced_type === "checkbox") {
            advanced_value = ($(this).prop('checked')) ? 1 : 0;
        }

        crudAjax({
            'edit_column': advanced_column,
            'edit_entry_id': advanced_entry_id,
            'edit_value': advanced_value
        }, advanced_update_url, 'POST')
    })
}