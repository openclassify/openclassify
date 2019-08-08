

$('#message').on('click', function () {
    if ($('#adv_id').data('content') == $('#message').data('content')) {
        alert("You can't send messages to your own ad.")
    } else {
        $('#messages_modal').modal('toggle');
    }
});

$('#message-button').on('click', function () {
    var id = $('#adv-id').val();
    var detail = $('#message-detail').val();
    var token = $('#message-token').val();
    $.post('/api/message/'+id+'/save',
        {
            detail: detail,
            _token: token,
        },
        function(data, status){
            if (status == "success") {
                $('#messages_modal').modal('toggle');
                $('#message-sent-modal').modal('toggle');
            } else {
                $('#messages_modal').modal('toggle');
                alert('Failed');
            }
        });
});



function openVideo(){
    $("#adv-video").modal("show");
}