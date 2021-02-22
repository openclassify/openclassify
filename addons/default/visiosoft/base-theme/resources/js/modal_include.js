$('a[data-toggle="modal"]').on('click',function(e) {
    $(this).parent().find('.modal-content').load(e.target.href);
});