var getUrlParameter = function getUrlParameter(sParam) {
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
        var value = $(this).val(), entry_id = $(this).data('entry_id'), column = $(this).data('column');
        alert(value,entry_id,column);
    })
}