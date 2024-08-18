function phoneMask(fields) {

    var onlyCountriesOption = {};
    var initialCountry = 'auto';

    if (typeof (allowed_cities) != "undefined" && allowed_cities) {
        onlyCountriesOption = {onlyCountries: allowed_cities};
    }

    if (typeof (country_default) != "undefined") {
        initialCountry = country_default;
    }

    var country = document.getElementById('default-phone-country')
        ? document.getElementById('default-phone-country').innerText : null;
    var inputQueries = document.querySelectorAll(fields);
    inputQueries.forEach(function (inputQuery, key) {
        var iti = intlTelInput(inputQuery, {
            hiddenInput: inputQuery.getAttribute('name'),
            class: "form-control",
            formatOnDisplay: true,
            nationalMode: true,
            geoIpLookup: function (success, failure) {
                $.get("https://ipinfo.io", function () {
                }, "jsonp").always(function (resp) {
                    var countryCode = country ? country : (resp && resp.country) ? resp.country : "";
                    success(countryCode);
                })
            },
            ...onlyCountriesOption,
            initialCountry
        });

        $(inputQuery).on("countrychange", function (event) {
            iti.setNumber("");
            addMask(iti, inputQuery);
        });
    });

    function addMask(iti, inputQuery) {
        let selectedCountryData = iti.getSelectedCountryData();
        let newPlaceholder = intlTelInputUtils.getExampleNumber(selectedCountryData.iso2, true, intlTelInputUtils.numberFormat.INTERNATIONAL);
        $(inputQuery).inputmask({mask: newPlaceholder.replace(/[0-9+]/ig, '9'), keepStatic: false});
    }

    // var fields_arr = fields.split(',');
    // $.each(fields_arr, function (index, value) {
    //     maskPhone($(value).attr('name'))
    // });


    // $(fields).on('countrychange', function (e) {
    //     maskPhone($(this).attr('name'))
    // });

    // function maskPhone(name) {
    //     if ( $("input[name='" + name + "']").length ) {
    //         var currentMask = $("input[name='" + name + "']").attr('placeholder');
    //         if(currentMask) {
    //             $("input[name='" + name + "']").mask(currentMask.replace(/[0-9+]/ig, '9'), {
    //                 autoclear: true,
    //                 clearIncomplete: true
    //             });
    //         }
    //     }
    // }


}

function controlNumber(inputQuery) {
    var iti = intlTelInput(inputQuery, {
        hiddenInput: inputQuery.getAttribute('name'),
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

    return iti.isValidNumber();
}
