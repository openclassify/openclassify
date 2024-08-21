$('.search-type').on('click', function () {
    $('.search-type').removeClass('active');
    $(this).toggleClass('active');
    $('.banner-search-input').val('');
    $('.banner-search-form').attr('action', $(this).data('url'));
    $('.search-submit-button').attr('href', $(this).data('url'));
});

$('.js-category-buttons').on('click', function () {
    $('.js-category-buttons').removeClass('active');
    $('.category-ads-content').removeClass('active');
    $(this).toggleClass('active');
    $($(this).attr('href')).toggleClass('active');
});

$('.banner-search-form').on('submit',function(e){
    if($('.banner-search-input').val().length == 0 ){
        e.preventDefault();
        window.location.replace($(this).attr('action'))
    }
})

if ($('.alert').length > 0) {
    var alerts = $('.alert')

    $.each(alerts, function (){

        var text = $(this).find('.alert_body > p').text()
        var errorType = $(this)[0].classList;

        Swal.fire({
            icon: errorType[1],
            title: text,
            toast: true,
            position: 'top-end',
            timerProgressBar: true,
            showConfirmButton: false,
            timer: 3000,
            customClass:{
                container:'custom-swal-container'
            }
        })
    })
}

var cf_buttons = $(".cf_button");
cf_buttons.on("click", function() {
    var selectedValue = $(this).attr("data-value");
    var options = $('#listFilterForm #cf_' + cfButtonsId);
    var optionToSelect = options.find('option[value=' + selectedValue + ']');
    optionToSelect.prop('selected', true);
    $('#listFilterForm').submit();
});