new Promise(function (resolve, reject) {

    if (parseInt(default_country)) {
        getCities(parseInt(default_country))
        resolve(true);
    }
}).then(function (resolve) {
    if (resolve) {
        if (parseInt(default_city)) {
            getDistricts(parseInt(default_city))
            $('select[name="default_city"]').val(default_city)
            return true;
        }
    }
}).then(function (resolve) {
    if (resolve) {
        if (parseInt(default_district)) {
            getNeighborhoods(parseInt(default_district))
            $('select[name="default_district"]').val(default_district)
            return true;
        }
    }
}).then(function (resolve) {
    if (resolve) {
        if (parseInt(default_neighborhood)) {
            $('select[name="default_neighborhood"]').val(default_neighborhood)
        }
    }
});


function getCities(country) {
    crudAjax('id=' + country, '/ajax/getCities', 'POST', function (callback) {
        cities = callback;
        $('select[name="default_city"]').html("<option value=''>" + pick_option + "</option>");
        $.each(cities, function (index, value) {
            $('select[name="default_city"]').append("<option value='" + value.id + "'>" + value.name + "</option>");
        });
    })
}

function getDistricts(city) {
    crudAjax('id=' + city, '/ajax/getDistricts', 'POST', function (callback) {
        cities = callback;
        $('select[name="default_district"]').html("<option> value=''" + pick_option + "</option>");
        $.each(cities, function (index, value) {
            $('select[name="default_district"]').append("<option value='" + value.id + "'>" + value.name + "</option>");
        });
    })
}

function getNeighborhoods(district) {
    crudAjax('id=' + district, '/ajax/getNeighborhoods', 'POST', function (callback) {
        cities = callback;
        $('select[name="default_neighborhood"]').html("<option value=''>" + pick_option + "</option>");
        $.each(cities, function (index, value) {
            $('select[name="default_neighborhood"]').append("<option value='" + value.id + "'>" + value.name + "</option>");
        });
    })
}


$(document).on('change', 'select[name="default_country"]', function () {
    getCities($(this).val());
});

$(document).on('change', 'select[name="default_city"]', function () {
    getDistricts($(this).val())
});

$(document).on('change', 'select[name="default_district"]', function () {
    getNeighborhoods($(this).val())
});