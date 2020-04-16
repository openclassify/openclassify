(function (window, document) {

    // Go!
    
})(window, document);

function crud(params, url, type, callback) {
    $.ajax({
        type: type,
        async: false,
        data: params,
        url: url,
        success: function (response) {
            callback(response);
        },
    });
}