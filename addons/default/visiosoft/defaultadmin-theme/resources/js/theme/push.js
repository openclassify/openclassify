$(function () {

    /**
     * Toggle the push menu.
     */
    $('[data-toggle="push-menu"]').click(function (e) {

        e.preventDefault();

        $('body').toggleClass('pushing');

        window.scrollTo(0, 0);
    });

    /**
     * Close the push menu.
     */
    $('[data-dismiss="push-menu"]').click(function (e) {

        e.preventDefault();

        $('body').removeClass('pushing');
    });

    /**
     * CTRL+A: Toggle the push menu.
     */
    $(document).keydown('ctrl+a', function () {
        $('[data-toggle="push-menu"]').trigger('click');
    });

    /**
     * ESC: Close the push menu.
     */
    $(document).keydown('esc', function () {
        $('[data-dismiss="push-menu"]').trigger('click');
    });

    /**
     * CTRL+SPACE: Open the push menu and search.
     */
    $(document).keydown('ctrl+space', function () {

        if (!$('body').hasClass('pushing')) {
            $('[data-toggle="push-menu"]').trigger('click');
        }

        $('#push').find('input').first().focus();
    });

});
