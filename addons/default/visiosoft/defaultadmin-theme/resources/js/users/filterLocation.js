new Promise(function (resolve, reject) {
    if (parseInt(default_country)) {
        getCities(parseInt(default_country));
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
}).then(function (resolve) {
    if (resolve) {
        if (parseInt(default_neighborhood)) {
            $('select[name="neighborhood"]').val(default_neighborhood)
        }
    }
});

function getCities(country) {
    crudAjax('id=' + country, '/ajax/getCities', 'POST', function (callback) {
        cities = callback;
        $('select[name="city"]').html("<option value=''>" + pick_option + "</option>");
        $.each(cities, function (index, value) {
            $('select[name="city"]').append("<option value='" + value.id + "'>" + value.name + "</option>");
        });
        $('select[name="district"]').html("<option value=''>" + pick_option + "</option>");
        $('select[name="neighborhood"]').html("<option value=''>" + pick_option + "</option>");
        $('select[name="village"]').html("<option value=''>" + pick_option + "</option>");
    })
}

function getDistricts(city) {
    crudAjax('id=' + city, '/ajax/getDistricts', 'POST', function (callback) {
        cities = callback;
        $('select[name="district"]').html("<option value=''>" + pick_option + "</option>");
        $.each(cities, function (index, value) {
            $('select[name="district"]').append("<option value='" + value.id + "'>" + value.name + "</option>");
        });
        $('select[name="neighborhood"]').html("<option value=''>" + pick_option + "</option>");
        $('select[name="village"]').html("<option value=''>" + pick_option + "</option>");
    })
}

function getNeighborhoods(district) {
    crudAjax('id=' + district, '/ajax/getNeighborhoods', 'POST', function (callback) {
        cities = callback;
        $('select[name="neighborhood"]').html("<option value=''>" + pick_option + "</option>");
        $.each(cities, function (index, value) {
            $('select[name="neighborhood"]').append("<option value='" + value.id + "'>" + value.name + "</option>");
        });
        $('select[name="village"]').html("<option value=''>" + pick_option + "</option>");
    })
}

$(document).on('change', 'select[name="country"]', function () {
    getCities($(this).val());
});

$(document).on('change', 'select[name="city"]', function () {
    getDistricts($(this).val())
});

$(document).on('change', 'select[name="district"]', function () {
    getNeighborhoods($(this).val())
});