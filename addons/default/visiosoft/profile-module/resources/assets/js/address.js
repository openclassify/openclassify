// Personal Registration
var inputQueries = document.querySelectorAll("input[name='adress_gsm_phone']");
inputQueries.forEach(function (inputQuery, key) {
    var iti = intlTelInput(inputQuery, {
        hiddenInput: "full_phone_"+inputQuery.getAttribute('name'),
        class: "form-control",
        initialCountry: "auto",
        geoIpLookup: function (success, failure) {
            $.get("https://ipinfo.io", function () {
            }, "jsonp").always(function (resp) {
                var countryCode = (resp && resp.country) ? resp.country : "";
                success(countryCode);
            })
        }
    })
});

maskPhone()

$("input[name='adress_gsm_phone']").on('countrychange', function (e) {
    maskPhone()
});

function maskPhone(name) {
    var currentMask = $("input[name='adress_gsm_phone']").attr('placeholder');
    $("input[name='adress_gsm_phone']").mask(currentMask.replace(/[0-9+]/ig, '9'), {
        autoclear: true,
        clearIncomplete: true
    });

}