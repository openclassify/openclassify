function sendCount() {
    var id = $('.show-number').attr('data-id');
    if (id != "") {
        $.ajax({
            type: 'POST',
            url: '/ajax/countPhone',
            data: 'id=' + id,
            success: function (data) {
                hideLoader()
                $('.show-number').removeAttr('data-function');
            },
            beforeSend: function () {
                showLoader()
            }
        });
    }

}

// -------------------------------------------------------------
//   Show Mobile Number
// -------------------------------------------------------------

(function () {
    $('.show-number').on('click', function () {
        this.addEventListener('click', sendCount());
        $('.hide-text').fadeIn(500, function () {
            $(this).addClass('hide');
        });
        $('.hide-number').fadeIn(500, function () {
            $(this).addClass('show');
        });
    });
}());


// script end