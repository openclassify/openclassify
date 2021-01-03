$('.remote').on('show.bs.modal', function (e) {
    if (typeof e.relatedTarget !== "undefined") {
        $(this).find('.modal-content').load(e.relatedTarget.href);
    }
});