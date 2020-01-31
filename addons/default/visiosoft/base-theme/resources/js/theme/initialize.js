(function (window, document) {

    // Go!
    
})(window, document);


var inputQuery = document.querySelector("input[name=\"phone\"]");
var iti = intlTelInput(inputQuery, {
    hiddenInput: "full_phone",
    class:"form-control",
    initialCountry: "auto",
    geoIpLookup: function (success, failure) {
        $.get("https://ipinfo.io", function () {
        }, "jsonp").always(function (resp) {
            var countryCode = (resp && resp.country) ? resp.country : "";
            success(countryCode);
        });
    }
});
