function crudAjax(params, url, type, callback, async = false) {
    return $.ajax({
        type: type,
        data: params,
        async: async,
        url: url,
        success: function (response) {
            callback(response);
        },
    });
}