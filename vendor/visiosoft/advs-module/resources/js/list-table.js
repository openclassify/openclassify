$(".clickable-row").click(function () {
    window.location = $(this).data("href");
});

$('.hover-area').mouseover((e) => {
    var el = $(e);

    var img = $(`.${$(el[0].target).data('id')}`);

    img.siblings('img').hide();

    img.show();
});
