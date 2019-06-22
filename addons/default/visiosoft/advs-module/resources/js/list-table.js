$(".clickable-row").click(function () {
    window.location = $(this).data("href");
});