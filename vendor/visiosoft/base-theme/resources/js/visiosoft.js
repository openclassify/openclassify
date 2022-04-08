function crudAjax(params, url, type = 'GET', callback = () => {}, async = false, options = {}) {
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

function getUserNavMenu(html, element) {
    crudAjax({}, '/ajax/get-user-info', 'GET', function (callback) {
        if (callback['userName']){
            element.html(html);
            $(element).find('.addBlock').html(callback['addBlockHtml']);
            $(element).find('.username').html(callback['userName']);
            $(element).find('.profile-img').attr('src',  `${callback['profileImg']}`);
        }
    })
}
