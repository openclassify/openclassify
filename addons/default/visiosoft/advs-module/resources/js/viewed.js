function viewed_ad() {
    var id = $('#adv-id').val();
    $.ajax({
        type: 'get',
        url: '/ajax/viewed/' + id,
    });
}

viewed_ad();