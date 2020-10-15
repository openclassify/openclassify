function viewed_ad() {
    $.ajax({
        type: 'get',
        url: '/ajax/viewed/' + advID,
    });
}

viewed_ad();