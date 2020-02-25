// Personal Registration
var inputQueries = document.querySelectorAll("input[name=\"phone\"],input[name='land_phone']");
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

$("input[name='phone'],input[name='land_phone']").on('countrychange', function (e) {
    maskPhone($(this).attr('name'))
});

function maskPhone(name) {
    var currentMask = $("input[name='" + name + "']").attr('placeholder');
    $("input[name='" + name + "']").mask(currentMask.replace(/[0-9+]/ig, '9'), {
        autoclear: true,
        clearIncomplete: true
    });

}