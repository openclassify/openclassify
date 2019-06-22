var catId;
$('.add_custom_field').on('click', function () {
    catId = $(this).attr('data-content');
});

function custom_field (attr) {
    var link = attr + "&id=" + catId;
    window.location.href = link;
}

