new Promise(function (resolve, reject) {
    if (parseInt(default_country)) {
        getCities(parseInt(default_country));
        $('select[name="country"]').val(default_country);
        resolve(true);
    }
}).then(function (resolve) {
    if (resolve) {
        if (parseInt(default_city)) {
            getDistricts(parseInt(default_city));
            $('select[name="city"]').val(default_city);
            return true;
        }
    }
}).then(function (resolve) {
    if (resolve) {
        if (parseInt(default_district)) {
            getNeighborhoods(parseInt(default_district));
            $('select[name="district"]').val(default_district);
            return true;
        }
    }
});

function getCities(country) {
    crudAjax('id=' + country, '/ajax/getCities', 'POST', function (callback) {
        cities = callback;
        $('select[name="city"]').html("<option>" + pick_option + "</option>");
        $.each(cities, function (index, value) {
            $('select[name="city"]').append("<option value='" + value.id + "'>" + value.name + "</option>");
        });
    })
}

function getDistricts(city) {
    crudAjax('id=' + city, '/ajax/getDistricts', 'POST', function (callback) {
        cities = callback;
        $('select[name="district"]').html("<option>" + pick_option + "</option>");
        $.each(cities, function (index, value) {
            $('select[name="district"]').append("<option value='" + value.id + "'>" + value.name + "</option>");
        });
    })
}

$(document).on('change', 'select[name="country"]', function () {
    getCities($(this).val());
});

$(document).on('change', 'select[name="city"]', function () {
    getDistricts($(this).val())
});