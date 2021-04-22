phoneMask("input[name='gsm_phone'],input[name='office_phone'],input[name='land_phone']")
$('.formEditInfo').on('submit', function (e) {
    e.preventDefault();

    const oldBtnHtml = $(this).find('.btn-success').html();
    $(this).find('.btn-success').attr('disabled', true).html(`
        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
    `);

    var form = $(this);

    $.ajax({
        type: 'POST',
        data: {
            action: 'update',
            first_name: $('input[name=first_name]', form).val(),
            last_name: $('input[name=last_name]', form).val(),
            gsm_phone: $('#gsm_phone', form).val(),
            office_phone: $('#office_phone', form).val(),
            land_phone: $('#land_phone', form).val(),
        },
        url: '/ajax/update-user-info',
        success: function (response) {
            if (response.status == "success") {
                var profile = response.data;
                $('.infoName').val(profile.first_name + " " + profile.last_name);
                $('.infoGsmPhone').val(profile.gsm_phone);
                $('.infoOfficePhone').val(profile.office_phone);
                $('.infoLandPhone').html(profile.land_phone);
                $('#editMyInfo').modal('hide');

                $('.formEditInfo .btn-success').attr('disabled', false).html(oldBtnHtml);
            }
        }
    });
});

$('.editInformationUser').on('click', function () {
    $('#editMyInfo').modal('show');

    $.ajax({
        type: 'POST',
        url: '/ajax/update-user-info',
        success: function (response) {
            if (response.status == "success") {
                var profile = response.data;
                $('input[name="first_name"]').val(profile.first_name)
                $('input[name="last_name"]').val(profile.last_name)
                intlTelInput(document.querySelector("input[name='gsm_phone']")).setNumber(profile.gsm_phone)
                intlTelInput(document.querySelector("input[name='office_phone']")).setNumber(profile.office_phone)
                intlTelInput(document.querySelector("input[name='land_phone']")).setNumber(profile.land_phone)
            }
        }
    });
})