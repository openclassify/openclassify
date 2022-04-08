$(function () {

    // Focus on the first input.
    $('form.ajax').on('submit', function (e) {

        e.preventDefault();

        $.post($(this).attr('action'), $(this).serializeArray(), function (data) {

            if (!data.success) {

                messages = [];

                $.each(data.errors, function (field, errors) {
                    messages.push(errors.join('\n'));
                });

                alert(messages.join('\n'));

                return false;
            }
            
            if (!data.redirect) {
                return;
            }

            window.location = data.redirect;
        });
    });
});
