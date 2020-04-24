phoneMask("input[name='gsm_phone'],input[name='office_phone'],input[name='land_phone']")
$('.formEditInfo').on('submit', function (e) {
    e.preventDefault();
    var form = $(this);

    crud(form.serialize() + "&action=update", '/ajax/update-user-info', 'POST', function (callback) {
        if (callback.status == "success") {
            var profile = callback.data;
            $('.infoName').html(profile.first_name + " " + profile.last_name);
            $('.infoGsmPhone').html(profile.gsm_phone);
            $('.infoOfficePhone').html(profile.office_phone);
            $('.infoLandPhone').html(profile.land_phone);
            $('#editMyInfo').modal('hide');
        }
    })
})

$('.editInformationUser').on('click', function () {
    $('#editMyInfo').modal('show');
    crud({}, '/ajax/update-user-info', 'POST', function (callback) {
        if (callback.status == "success") {
            var profile = callback.data;
            $('input[name="first_name"]').val(profile.first_name)
            $('input[name="last_name"]').val(profile.last_name)
            intlTelInput(document.querySelector("input[name='gsm_phone']")).setNumber(profile.gsm_phone)
            intlTelInput(document.querySelector("input[name='office_phone']")).setNumber(profile.office_phone)
            intlTelInput(document.querySelector("input[name='land_phone']")).setNumber(profile.land_phone)
        }
    })
})