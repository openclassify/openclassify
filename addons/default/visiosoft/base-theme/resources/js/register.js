phoneMask("input[name='phone'],input[name='land_phone'],input[name='store_phone']");

// Phone register validation
//setup before functions
let typingTimer;
let doneTypingInterval = 650;
let phoneInput = $(".validate-phone input[name='phone']");

//on keyup, start the countdown
phoneInput.on('keyup', function () {
    clearTimeout(typingTimer);
    typingTimer = setTimeout(function () {
        doneTyping(phoneInput.val())
    }, doneTypingInterval)
});

//on keydown, clear the countdown
phoneInput.on('keydown', function () {
    clearTimeout(typingTimer);
});

function doneTyping(phoneNum) {
    if (!phoneNum.includes('_') && phoneNum !== "") {
        let countryCode = $(".iti__selected-flag").attr('title').split("+");
        countryCode = '+' + countryCode[countryCode.length - 1];

        $.ajax({
            type: 'GET',
            data: {'phoneNumber': countryCode + phoneNum.substr(1)},
            url: 'ajax/phone-validation',
            success: function (response) {
                if (response.userExists) {
                    phoneInput.addClass('rejected-phone');
                    phoneInput.removeClass('approved-phone');
                    $('.phone-validation-error').removeClass('d-none')
                } else {
                    phoneInput.addClass('approved-phone');
                    phoneInput.removeClass('rejected-phone');
                    $('.phone-validation-error').addClass('d-none')
                }
            },
        });
    } else {
        phoneInput.removeClass('approved-phone');
        phoneInput.removeClass('rejected-phone');
        $('.phone-validation-error').addClass('d-none')
    }
}