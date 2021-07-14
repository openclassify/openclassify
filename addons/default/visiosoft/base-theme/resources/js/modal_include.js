$('.remote').on('show.bs.modal', function (e) {
    if (typeof e.relatedTarget !== "undefined") {
        $(this).find('.modal-content').load(e.relatedTarget.href, function () {
            const event = new Event('custom.modal.loaded');
            $(this).closest('.modal').get(0).dispatchEvent(event);
        });
    }
});
