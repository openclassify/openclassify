$(document).on('change', 'select[name="country"]', function () {
    Locations($(this).val(), 1, "city");
});
$(document).on('change', 'select[name="city"]', function () {
    Locations($(this).val(), 2, "district")
});

getCountries();

function Locations(cat, level, name) {
    $.ajax({
        type: "GET",
        async: false,
        data: "cat=" + cat + "&level=" + level,
        url: "/class/ajax",
        success: function (msg) {
            $('select[name="' + name + '"]').find('option').remove();
            $('select[name="' + name + '"]').append('<option value="">...</option>');
            $.each(msg, function (key, value) {
                $('select[name="' + name + '"]').append('<option value="' + value.id + '">' + value.name + '</option>');
            });
        }
    });
}

if (country != "") {
    //For Request
    Locations(country, 1, "city");

    if (city != "") {
        $('select[name="city"]').val(city);
        Locations(city, 2, "district");

        if (district != "") {
            $('select[name="district"]').val(district);
        }
    }
} else {
    //Set Default
    $('select[name="country"]').val(default_country);
    Locations(default_country, 1, "city");

    if (default_city != "") {
        $('select[name="city"]').val(default_city);
        Locations(default_city, 2, "district");

        if (default_district != "") {
            $('select[name="district"]').val(default_district);
        }
    }
}

phoneMask("input[name='adress_gsm_phone']");


function getCountries() {
    crudAjax('', '/ajax/getCountry', 'GET', function (callback) {
        $('select[name="country"]').html("<option>" + pick_option + "</option>");
        $.each(callback, function (index, value) {
            $('select[name="country"]').append("<option value='" + value.id + "'>" + value.name + "</option>");
        });
        $('select[name="country"]').val(country);
    })
}