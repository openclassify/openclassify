function viewed_classified() {
    var id = $('#classified-id').val();
    $.ajax({
        type: 'get',
        url: '/ajax/viewed/' + id,
    });
}

viewed_classified();