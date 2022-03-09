let initModal = function () {

    let modal = $('.modal.remote:not([data-initialized])');

    let loading = '<div class="modal-loading"><div class="active loader large"></div></div>';

    // Loading state
    modal.on('loading', function() {
        $(this).find('.modal-content').append(loading);
    });

    // Clear remote modals when closed.
    modal.on('hidden.bs.modal', function () {

        $(this).removeData('bs.modal');

        $(this).find('.modal-content').html(loading);
    });

    // Show loader for remote modals.
    modal.on('show.bs.modal', function () {
        $(this).find('.modal-content').html(loading);
    });

    // Handle ajax links in modals.
    modal.on('click', 'a.ajax, .pagination a', function (e) {

        e.preventDefault();

        let wrapper = $(this).closest('.modal-content');

        wrapper.append(loading);

        $.get($(this).attr('href'), function (html) {
            wrapper.html(html);
        });
    });

    // Handle ajax forms in modals.
    modal.on('submit', 'form.ajax', function (e) {

        e.preventDefault();

        let wrapper = $(this).closest('.modal-content');

        wrapper.append(loading);

        if ($(this).attr('method') == 'GET') {
            $.get($(this).attr('action'), $(this).serializeArray(), function (html) {
                wrapper.html(html);
            });
        } else {
            $.post($(this).attr('action'), $(this).serializeArray(), function (html) {
                wrapper.html(html);
            });
        }
    });

    // Handle load indicators in modals.
    modal.on('click', '[data-toggle="loader"]', function () {

        let wrapper = $(this).closest('.modal-content');

        wrapper.append(loading);
    });

    // Mark as initialized.
    modal.attr('data-initialized', '');
};

$(document).ready(function () {
    initModal();
});

$(document).ajaxComplete(function () {
    initModal();
});

$(document).on('show.bs.modal', '.modal', function () {
    let zIndex = 1040 + (10 * $('.modal:visible').length);
    $(this).css('z-index', zIndex);
    setTimeout(function() {
        $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
    }, 0);
});
