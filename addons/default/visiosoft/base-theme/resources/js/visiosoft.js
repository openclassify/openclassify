function crudAjax(params, url, type = 'GET', callback = () => {}, async = true, options = {}) {
    return $.ajax({
        ...{
            type: type,
            data: params,
            async: async,
            url: url,
            success: function (response) {
                callback(response);
            },
        },
        ...options
    });
}
