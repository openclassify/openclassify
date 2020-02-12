// Personal Registration
var inputQueries = document.querySelectorAll("input[name=\"phone\"]");
inputQueries.forEach(function (inputQuery, key) {
    var iti = intlTelInput(inputQuery, {
        hiddenInput: "full_phone",
        class:"form-control",
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