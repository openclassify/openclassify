$(document).on('change', 'select[name="city"]', function () {
    Locations($(this).val(), 2, "district")
});
$(document).on('change', 'select[name="district"]', function () {
    Locations($(this).val(), 3, "neighborhood");
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

console.log(city);
$(() => {
    Locations(country, 1, "city");
    if (city !== "") {
        $('select[name="city"]').val(city);
        Locations(city, 2, "district");

        if (district !== "") {
            $('select[name="district"]').val(district);
            Locations(district, 3, "neighborhood");

            if (neighborhood !== "") {
                $('select[name="neighborhood"]').val(neighborhood);
            }
        }
    }
});


phoneMask("input[name='gsm_phone']");
phoneMask("input[name='land_phone']");
phoneMask("input[name='office_phone']");


function getCountries() {
    crudAjax('', '/ajax/getCountry', 'GET', function (callback) {
        $('select[name="country"]').html("<option>" + pick_option + "</option>");
        $.each(callback, function (index, value) {
            $('select[name="country"]').append("<option value='" + value.id + "'>" + value.name + "</option>");
        });
        $('select[name="country"]').val(country);
    })
}
