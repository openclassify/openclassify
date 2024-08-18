$(function () {
    $('form.commentformajax').on('submit', function (e) {
        e.preventDefault();
        $.post($(this).attr('action'), $(this).serializeArray(), function (data) {

            if (!data.status) {
                $('.comment-messages')
                    .addClass('alert-danger')
                    .removeClass('hidden')
                    .find('.error')
                    .removeClass('hidden');
            } else {
                $('.comment-messages')
                    .addClass('alert-success')
                    .removeClass('hidden')
                    .find('.success')
                    .removeClass('hidden');
            }
            $('.commentformajax').trigger("reset");
        });
    });
})