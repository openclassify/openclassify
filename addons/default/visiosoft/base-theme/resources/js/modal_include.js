$('.remote').on('show.bs.modal', function (e) {
    $(this).find('.modal-content').load(e.relatedTarget.href);
});