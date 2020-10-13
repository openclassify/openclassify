function phoneMask(fields) {
    var country = document.getElementById('country').innerText;
    var inputQueries = document.querySelectorAll(fields);
    inputQueries.forEach(function (inputQuery, key) {
        var iti = intlTelInput(inputQuery, {
            hiddenInput: inputQuery.getAttribute('name'),
            class: "form-control",
            initialCountry: "auto",
            geoIpLookup: function (success, failure) {
                $.get("https://ipinfo.io", function () {
                }, "jsonp").always(function (resp) {
                    var countryCode = country ? country : (resp && resp.country) ? resp.country : "";
                    success(countryCode);
                })
            }
        })
    });

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
