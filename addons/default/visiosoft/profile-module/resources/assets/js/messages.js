function crud(params, url, type, callback) {
    $.ajax({
        type: type,
        data: params,
        url: url,
        success: function (response) {
            console.log(response)
            callback(response);
        },
    });
}

function getMyMessages(type) {
    crud({'type': type}, '/api/messages', 'GET', function (response) {
        $('#nav-' + type).html("");
        $.each(response, function (index, message) {
            $('#nav-' + type).append(
                addMessagesRow(
                    message.id,
                    message.sender_name,
                    message.receiver_name,
                    message.sent_at
                )
            );
        });
    })
}

$('.profile-ads-tab a').on('click', function () {
    getMyMessages($(this).attr('data-type'))
});

getMyMessages('inbox');

function addMessagesRow(id, senderName, receiverName, sentAt) {
    return `
        <a href="/message/${id}/detail">
            <div class="alert alert-success">
                <h5 class="alert-heading">${from}:<small class="pl-1">${senderName}</small></h5>
                <h5 class="alert-heading">${to}:<small class="pl-1">${receiverName}</small></h5>
                <small class="mb-0">${sentAt}</small>
            </div>
        </a>
    `
}
