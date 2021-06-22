(function (window, document) {
    /* Offline */
    window.addEventListener('offline', () => {
        $('body > *').hide();
        $('#offline').show();
    });

    $('#offline button').click(function () {
        $('.spinner-border', this).css('display', 'inline-block')

        setTimeout(() => {
            if (window.navigator.onLine) {
                window.location.reload();
            } else {
                $('.spinner-border', this).hide()
            }
        }, 250)
    })
    /* End Offline */
})(window, document);
