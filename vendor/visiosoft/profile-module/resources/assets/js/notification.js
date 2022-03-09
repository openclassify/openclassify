$('.notification').on('click', function () {
    var name = $(this).attr('data-name');
    var input = $('input[data-name='+name+']');
    var value = null;
    if (input.is(':checked')) {
        value = 1;
    }else {
        value = 0;
    }
    $.ajax({
        type: 'get',
        url: 'profile/notification',
        data: name+'='+ value,
        cache: false,
        dataType: 'json',
        contentType: 'application/json; charset=utf-8',
        success:function() {
            Notification(saved,'success')
        },
        error: function (err) { alert('Could not connect to the registration server. Please try again later.') },
    })
})