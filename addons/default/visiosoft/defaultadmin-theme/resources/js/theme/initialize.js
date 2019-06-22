$(document).on('ready', function () {

    // Add CSRF ajax requests.
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': CSRF_TOKEN
        }
    });

    // Initialize Bootstrap tooltips.
    $('[data-toggle="tooltip"]').tooltip();

    // Initialize Bootstrap popovers.
    $('[data-toggle="popover"]').popover();

    // Initialize scrollbars.
    $('.scrollbar').perfectScrollbar();

    // Flush the footer to the bottom.
    $('#main').css('min-height', $(window).height() - $('#brand').outerHeight() - $('#footer').outerHeight() - 24);

    var $window = $(window);
    var $table = $('table.table:not(.no-affix)');
    var $responsiveTable = $table.closest('.table-responsive');

    if ($table.length === 1) {
        var $topBar = $('#topbar');
        var $thead = $table.find('thead');
        var topBarHeight = $topBar.height();
        var tableTop = $table.offset().top;

        /**
         * Gets the table cols sizes.
         *
         * @param $tbody
         * @returns {Array}
         */
        var getTableColsSizes = function ($tbody) {
            var columns = [];

            $tbody.find('tr:first-child td').each(function (index, el) {
                columns.push($(el).width());
            });

            return columns;
        };

        /**
         * Manually size all of the heads / columns.
         */
        var setTableColsSizes = function () {
            var $tbody = $('table.table').children('tbody');
            var tableColsSizes = getTableColsSizes($tbody);

            $thead.find('th').each(function (index, el) {
                $(el).width(tableColsSizes[index] + 'px');
            });

            $tbody.find('tr').first().find('td').each(function (index, el) {
                $(el).width(tableColsSizes[index] + 'px');
            });

            checkTableFixed();

            $thead.css({width: $table.width() + 'px'});
        };

        /**
         * Determines if at top.
         *
         * @return     {boolean}  True if at top, False otherwise.
         */
        var isAtTop = function () {
            return $('body').scrollTop() <= tableTop - topBarHeight;
        };

        /**
         * Fix if we're scrolled past.
         */
        var checkTableFixed = function () {
            if ($responsiveTable.outerWidth() < $table.outerWidth() || window.innerWidth < 992 || isAtTop()) {
                $thead.css({position: 'relative', top: '0px'});
                $thead.css({zIndex: '1010'});
                $table.css({marginTop: '0'});
            } else {
                $thead.css({position: 'fixed', top: topBarHeight + 'px'});
                $table.css({marginTop: $thead.height() + 'px'});
                $thead.css({zIndex: '1010'});
            }
        };

        /**
         * Make sure the table head is visible as an overlay.
         */
        $thead.css({backgroundColor: '#fff', width: $table.width() + 'px'});

        setTableColsSizes();

        $window.on('scroll', checkTableFixed);
        $window.on('resize', setTableColsSizes);
    }

    var $form = $('form.form:not(.no-affix)');

    if ($form.length === 1) {

        var $controls = $form.find('> .controls').first();
        var controlsHeight = $controls.height();

        var affixControls = function ($el) {
            $el.addClass('affix');
            $el.css({width: $form.width() + 'px'});
            $form.css({paddingBottom: 'calc(' + controlsHeight + 'px + 1.5rem)'});
        };

        var releaseControls = function ($el) {
            $el.removeClass('affix');
            $el.css({width: 'inherit'});
            $form.removeAttr('style');
        };

        var isAtBottom = function () {
            var scrollTop = $('body').scrollTop() || $('html').scrollTop();
            var windowHeight = window.innerHeight;
            var documentHeight = document.body.scrollHeight;
            
            return scrollTop + windowHeight - documentHeight + controlsHeight + 30 > 0;
        };

        var checkControlsFixed = function () {
            if (window.innerWidth < 992 || isAtBottom()) {
                releaseControls($controls);
            } else {
                affixControls($controls);
            }
        };

        $window.on('resize', checkControlsFixed);
        $window.on('scroll', checkControlsFixed);

        $('a[data-toggle="tab"]').on('shown.bs.tab', function () {
            checkControlsFixed();
        });

        setTimeout(function () {
            $window.trigger('resize');
        }, 50);
    }
});
