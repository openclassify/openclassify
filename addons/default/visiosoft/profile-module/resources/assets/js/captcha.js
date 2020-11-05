grecaptcha.ready(function() {
    grecaptcha.execute(reCAPTCHASiteKey)
        .then(function(token) {
            document.getElementById("recaptcha_token").value = token;
        });
});
