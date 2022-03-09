grecaptcha.ready(function() {
    grecaptcha.execute(reCAPTCHASiteKey)
        .then(function(token) {
            $('.recaptcha-token').val(token)
        });
});
