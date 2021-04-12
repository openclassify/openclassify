var countries;
var cities;
var districts;
var neighborhoods;
var village;

//Country
$('.filter-country-btn').on('click', function () {
    var selected__country_request = $('input[name="country[]"]').val();
    if (countries == undefined) {
        var promiseForCountries = new Promise(function (resolve, reject) {
            locationCrud('', '/ajax/getCountry', 'POST', beforeSend(), function (callback) {
                countries = callback;
                resetValue('country', true, false)
                $.each(countries, function (index, value) {
                    $('.filter-location-modal .countries').append(
                        item('country', value.id, value.name, value.abv ? value.abv.toLowerCase() : '')
                    );
                });
                if (countries == "")
                    $('.filter-location-modal .countries').html(null_msg);
                else if ($('input[name="country"]').val() != ""){
                    $.each(selected__country_request.split(','), function (index, value){
                        $(".filter-location-body .countries li[data-id='" + value.trim() + "'] input[type='checkbox']").prop('checked', true);
                    })
                }
                resolve();
            })
        });

        promiseForCountries.then(function () {
            SelectOnClick();
        })
    }
    $('.filter-location-modal .countries').show();
    $('.filter-location-modal').show();
    $('.filter-location-back').show();
    scroolToModal()
});
//City
$('.filter-city-btn').on('click', function () {
    var countries_value = $('input[name="country[]"]').val();
    countries_value += ',' + defaultCountry
    var selected__city_request = $('input[name="city[]"]').val();
    if (cities == undefined || $(this).attr('data-parent') != countries_value) {
        $(this).attr('data-parent', countries_value);
        var promiseForCities = new Promise(function (resolve, reject) {
            locationCrud('id=' + countries_value, '/ajax/getCities', 'POST', beforeSend(), function (callback) {
                cities = callback;
                resetValue('city', true, false)
                $.each(cities, function (index, value) {
                    $('.filter-location-modal .cities').append(item('city', value.id, value.name));
                });
                if (cities == "") {
                    $('.filter-location-modal .cities').html(null_msg);
                } else if (selected__city_request != "") {
                    $.each(selected__city_request.split(','), function (index, value) {
                        $(".filter-location-body .cities li[data-id='" + value.trim() + "'] input[type='checkbox']").prop('checked', true);
                    });
                }
                resolve();
            })
        });

        promiseForCities.then(function () {
            SelectOnClick();
        })
    }
    $('.filter-location-modal .cities').show();
    $('.filter-location-modal').show();
    $('.filter-location-back').show();
    scroolToModal()
});

//District
$('.filter-district-btn').on('click', function () {
    var city_value = $('input[name="city[]"]').val();
    var selected_district_request = $('input[name="district[]"]').val();
    if (districts == undefined || $(this).attr('data-parent') != city_value) {
        $(this).attr('data-parent', city_value)
        var promiseForDistricts = new Promise(function (resolve, reject) {
            locationCrud('id=' + city_value, '/ajax/getDistricts', 'POST', beforeSend(), function (callback) {
                districts = callback;
                resetValue('district', true, false)
                $.each(districts, function (index, value) {
                    $('.filter-location-modal .districts').append(item('district', value.id, value.name));
                });
                if (districts == "")
                    $('.filter-location-modal .districts').html(null_msg);
                else if (selected_district_request != "") {
                    $.each(selected_district_request.split(','), function (index, value) {
                        $(".filter-location-body .districts li[data-id='" + value + "'] input[type='checkbox']").prop('checked', true);
                    });
                }
                resolve();
            })
        });

        promiseForDistricts.then(function () {
            SelectOnClick();
        })
    }
    $('.filter-location-modal .districts').show();
    $('.filter-location-modal').show();
    $('.filter-location-back').show();
    scroolToModal()
});

//Neighborhood
$('.filter-neighborhood-btn').on('click', function () {
    var district_value = $('input[name="district[]"]').val();
    var selected_neighborhood_request = $('input[name="neighborhood[]"]').val();
    if (neighborhoods == undefined || $(this).attr('data-parent') != district_value) {
        $(this).attr('data-parent', district_value)
        var promiseForNeighborhoods = new Promise(function (resolve, reject) {
            locationCrud('id=' + district_value, '/ajax/getNeighborhoods', 'POST', beforeSend(), function (callback) {
                neighborhoods = callback;
                resetValue('neighborhood', true, false)
                $.each(neighborhoods, function (index, value) {
                    $('.filter-location-modal .neighborhoods').append(item('neighborhood', value.id, value.name));
                });
                if (neighborhoods == "")
                    $('.filter-location-modal .neighborhoods').html(null_msg);
                else if (selected_neighborhood_request != "") {
                    $.each(selected_neighborhood_request.split(','), function (index, value) {
                        $(".filter-location-body .neighborhoods li[data-id='" + value + "'] input[type='checkbox']").prop('checked', true);
                    });
                }
                resolve();
            })
        });

        promiseForNeighborhoods.then(function () {
            SelectOnClick();
        })
    }
    $('.filter-location-modal .neighborhoods').show();
    $('.filter-location-modal').show();
    $('.filter-location-back').show();
    scroolToModal()
});

//Village
$('.filter-village-btn').on('click', function () {
    var neighborhood_value = $('input[name="neighborhood[]"]').val();
    var selected_village_request = $('input[name="village[]"]').val();
    if (village == undefined || $(this).attr('data-parent') != neighborhood_value) {
        $(this).attr('data-parent', neighborhood_value)
        var promiseForVillage = new Promise(function (resolve, reject) {
            locationCrud('id=' + neighborhood_value, '/ajax/getVillage', 'POST', beforeSend(), function (callback) {
                village = callback;
                $('.filter-location-modal .village').html("");
                $.each(village, function (index, value) {
                    $('.filter-location-modal .village').append(item('village', value.id, value.name));
                });
                if (village == "")
                    $('.filter-location-modal .village').html(null_msg);
                else if (selected_village_request != "") {
                    $.each(selected_village_request.split(','), function (index, value) {
                        $(".filter-location-body .village li[data-id='" + value + "'] input[type='checkbox']").prop('checked', true);
                    });
                }
                resolve();
            })
        });

        promiseForVillage.then(function () {
            SelectOnClick();
        })
    }
    $('.filter-location-modal .village').show();
    $('.filter-location-modal').show();
    $('.filter-location-back').show();
    scroolToModal()
});


$('.filter-modal-close , .filter-location-back').on('click', function () {
    $('.filter-location-modal').hide();
    $('.filter-location-back').hide();
    $('.filter-location-modal .countries').hide();
    $('.filter-location-modal .cities').hide();
    $('.filter-location-modal .districts').hide();
    $('.filter-location-modal .neighborhoods').hide();
    $('.filter-location-modal .village').hide();
});


function SelectOnClick() {

    $(".filter-location-body input[type='checkbox']").unbind();
    searchLocationName()
    $('.loading').hide();

    return $(".filter-location-body input[type='checkbox']").on('change', function () {

        resetValue($(this).attr('data-field'), false, true)

        var input = $('input[name="' + $(this).attr('data-field') + '[]"]');
        var input_text = $(this).parent().find('small').html();
        var text_html = $('.selected-' + $(this).attr('data-field'));
        var text = "";
        var input_val = input.val();
        var id = $(this).attr('data-id');

        if ($(this).attr('data-field') == "country") {
            $('.selected-city small').html('');
            $('input[name="city[]"]').val('');
            // text_html.html(input_text)
            // $(".filter-location-body li[data-id='" + id + "'] input[type='checkbox']").prop('checked', true);

        }
        if (input_val != "") {
            input_val = input_val.split(',');
            text = text_html.html().split(',');
        } else {
            input_val = [];
            text = [];
        }
        if (this.checked) {
            input_val.push(id);
            text.push(input_text)
        } else {
            input_val.splice($.inArray(id, input_val), 1);
            text.splice($.inArray(input_text, text), 1);
        }
        input.val(input_val.join(','))
        text_html.html(text.join(', '))
    });
}


function locationCrud(params, url, type, beforeSend, callback) {
    $.ajax({
        type: type,
        data: params,
        url: url,
        beforeSend: function () {
            beforeSend
        },
        success: function (response) {
            callback(response);
        },
    });
}

function item(field_name, id, value, abv = '') {
    var selected = defaultCountry === id ? "checked" : "";
    if (field_name === 'country') {
        return `
            <li class="px-2" data-id="${id}">
                <label class="w-100 d-flex align-items-center">
                    <input type="checkbox" data-field="${field_name}" data-id="${id}" ${selected}>
                    <span class="flag ml-2 flag-${abv}"></span>
                    <small class="ml-2">${value}</small>
                </label>
            </li>
        `;
    } else {
        return `
            <li class="px-2" data-id="${id}">
                <label class="w-100 d-flex align-items-center">
                    <input type="checkbox" data-field="${field_name}" data-id="${id}">
                    <small class="ml-2">${value}</small>
                </label>
            </li>
        `;

    }
}

function resetValue(location_type, reset_this, reset_parent) {
    var list_class, inputs;
    var selected_type = false;

    //For City
    if (location_type == "country") {
        inputs = ['city', 'district', 'neighborhood', 'village']
        list_class = ['cities', 'districts', 'neighborhoods', 'village']
        selected_type = true

    }

    //For City
    if (location_type == "city") {
        if (reset_this || selected_type) {
            inputs = ['city', 'district', 'neighborhood', 'village']
            list_class = ['cities', 'districts', 'neighborhoods', 'village']
        } else {
            location_type = "district";
            selected_type = true
        }
    }

    //For District
    if (location_type == "district") {
        if (reset_this || selected_type) {
            inputs = ['district', 'neighborhood', 'village']
            list_class = ['districts', 'neighborhoods', 'village']
        } else {
            location_type = "neighborhood";
            selected_type = true
        }

    }

    //For Neighborhood
    if (location_type == "neighborhood") {
        if (reset_this || selected_type) {
            inputs = ['neighborhood', 'village']
            list_class = ['neighborhoods', 'village']
        } else {
            inputs = ['village']
            list_class = ['village']
        }
    }

    //Reset All List Class From list_class
    $.each(list_class, function (index, value) {
        $('.filter-location-modal .' + value).html("");
    });

    //Reset All Input Value From inputs
    $.each(inputs, function (index, value) {
        $('input[name="' + value + '"]').val("");
        if (reset_parent)
            $('.filter-' + value + '-btn').attr("data-parent", "");
    });
}

function scroolToModal() {
    //Scrool Screen
    $([document.documentElement, document.body]).animate({
        scrollTop: $('.filter-location-modal').offset().top - 250
    }, 1000);
}

function searchLocationName() {
    var searchField = $("#searchLocation");
    searchField.unbind();
    searchField.on("keyup", function () {
        var value = this.value.toLowerCase().trim();
        $('.filter-location-modal li').show().filter(function () {
            return $(this).text().toLowerCase().trim().indexOf(value) == -1;
        }).hide();
    });
}

function beforeSend() {
    $('.loading').show()
    $('.filter-location-modal li').show();
    $("#searchLocation").val('');
}