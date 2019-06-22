$(function () {

    /**
     * Handle double-tap Command || Control
     * for toggling the sidebar collapse.
     */
    var delta = 250;
    var last = 0;

    $(document).keydown(function (e) {

        /**
         * Prevent Oddballs
         */
        if (e.which == 0) {
            return;
        }

        if (e.which == 17 || e.which == 91) {

            var time = new Date();

            if (time - last <= delta) {

                $('#sidebar').toggleClass('open');

                time = 0;
            }

            last = time;
        }
    });

    /**
     * Bind (Control || Command) + Shift + #
     * for following module sections.
     */
    $(document).keydown(function (e) {

        /**
         * Prevent Oddballs
         */
        if (e.which == 0) {
            return;
        }

        // If not pressed CTRL||META - we do not calculate anything,
        if (!(e.ctrlKey || e.metaKey)) {
            return;
        }

        // Make sure that shift is also being held.
        if (!e.shiftKey) {
            return;
        }

        // Caching pressed for not calculating it in future
        var pressed = String.fromCharCode(e.which);
        var target;

        // If we press digit but not 0 script start work
        if ($.isNumeric(pressed) && pressed !== '0') {

            target = $('#menu').find('a').eq(pressed - 1);

            if (target.length) {

                e.preventDefault();

                if (target.is('[data-toggle="modal"]')) {

                    target.click();

                    return;
                }

                window.location = target.attr('href');
            }
        }
    });

    /**
     * Bind (Control || Command) + # for
     * following section buttons.
     */
    $(document).keydown(function (e) {

        /**
         * Prevent Oddballs
         */
        if (e.which == 0) {
            return;
        }

        // If not pressed CTRL||META - we do not calculate anything,
        if (!(e.ctrlKey || e.metaKey)) {
            return;
        }

        // Make sure that shift is NOT being held.
        if (e.shiftKey) {
            return;
        }

        // Caching pressed for not calculating it in future
        var pressed = String.fromCharCode(e.which);
        var target;

        // If we press digit but not 0 script start work
        if ($.isNumeric(pressed) && pressed !== '0') {

            target = $('#buttons').find('.btn').eq(pressed - 1);

            if (target.length) {

                e.preventDefault();

                if (target.is('[data-toggle="modal"]')) {

                    target.click();

                    return;
                }

                window.location = target.attr('href');
            }
        }
    });

    /**
     * Bind (Control || Command) + Space for
     * jumping to the global search input.
     */
    $(document).keydown(function (e) {

        /**
         * Prevent Oddballs
         */
        if (e.which == 0) {
            return;
        }

        var space = e.which == 0 || e.which == 32; // 0 works in Mozilla and 320 in others

        if ((e.ctrlKey || e.metaKey) && space) {

            e.preventDefault();

            $('input.search-bar').focus();
        }
    });
});
