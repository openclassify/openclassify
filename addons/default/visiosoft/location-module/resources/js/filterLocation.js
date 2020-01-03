// let searchParams = new URLSearchParams(window.location.search);
//
// //Set Select2 Type for Location Fields
// $('.cities, .countries, .districts, .neighborhoods, .village').select2({
//     placeholder: select_trans
// });
//
//
// FindLocations = (id, table, typeDb, divId, paramName = null) => {
//     $.ajax({
//         type: 'get',
//         url: '/getlocations',
//         data: {
//             id: id,
//             table: table,
//             typeDb: typeDb,
//         },
//         success: function (response) {
//             setLocations(response, id, table, typeDb, divId, paramName);
//             return response;
//         },
//         error: function (err) {
//             reject(Error("It broke"));
//         }
//     });
// };
//
//
// setLocations = (response, id, table, typeDb, divId, paramName) => {
//
//     //Add Options
//     if(divId != ".cities")
//     {
//         $(divId).append("<option value></option>")
//     }
//     response.forEach(function (options) {
//         $(divId).append("<option value=" + options.id + ">" + options.name + "</option>")
//     });
//
//     //Set Selected Option
//     if (paramName != null) {
//         if (divId == ".cities") {
//             $('.countries').val(searchParams.get('country'));
//             $('.countries').select2();
//             $('.cities').val(findParam("city[]"));
//         } else {
//             $(divId).val(searchParams.get(paramName));
//         }
//         $(divId).select2();
//     }
//
// };
//
// //Category Change
// $('.countries').on('change', function () {
//     $('.cities').empty();
//     var table = "cities";
//     var typeDb = 'parent_country_id';
//     var id = $(this).val();
//     var divId = ".cities";
//
//     FindLocations(id, table, typeDb, divId);
// });
//
// //City Change
// $('.cities, .select2-selection__choice__remove').on('change', function () {
//     $('.districts').empty();
//     var table = "districts";
//     var typeDb = 'parent_city_id';
//     var id = $(this).val();
//     var divId = ".districts";
//
//     FindLocations(id, table, typeDb, divId);
// });
//
// //Districts Change
// $('.districts').on('change', function () {
//     var table = "neighborhoods";
//     var typeDb = 'parent_district_id';
//     var id = $(this).val();
//     var divId = ".neighborhoods";
//
//     FindLocations(id, table, typeDb, divId);
// });
//
// //Neighborhoods Change
// $('.neighborhoods').on('change', function () {
//     var table = "village";
//     var typeDb = 'parent_neighborhood_id';
//     var id = $(this).val();
//     var divId = ".village";
//
//     FindLocations(id, table, typeDb, divId);
// });
//
//
// jQuery(document).ready(function ($) {
//
// }).promise().done(function () {
//
//     //Get City && Set Country
//     if (searchParams.get('country') != '') {
//         $('.cities').empty();
//         var table = "cities";
//         var typeDb = 'parent_country_id';
//         var id = searchParams.get('country');
//         var divId = ".cities";
//         var paramName = 'city';
//
//         FindLocations(id, table, typeDb, divId, paramName);
//     }
//
// }).promise().done(function () {
//
//     //get District  && set city
//     if (findParam('city[]').length) {
//         $('.districts').empty();
//         var table = "districts";
//         var typeDb = 'parent_city_id';
//         var id = findParam('city[]');
//         var divId = ".districts";
//         var paramName = 'district';
//
//         FindLocations(id, table, typeDb, divId, paramName);
//     }
//
// }).promise().done(function () {
//
//     //get neighborhood  && set districts
//     if (searchParams.get('district') != '') {
//         $('.neighborhoods').empty();
//         var table = "neighborhoods";
//         var typeDb = 'parent_district_id';
//         var id = searchParams.get('district');
//         var divId = ".neighborhoods";
//         var paramName = 'neighborhood';
//
//         FindLocations(id, table, typeDb, divId, paramName);
//     }
//
// }).promise().done(function () {
//
//     //get village  && set neighborhoods
//     if (searchParams.get('neighborhood') != '') {
//         $('.village').empty();
//         var table = "village";
//         var typeDb = 'parent_neighborhood_id';
//         var id = searchParams.get('neighborhood');
//         var divId = ".village";
//         var paramName = 'village';
//
//         FindLocations(id, table, typeDb, divId, paramName);
//     }
//
// });


var countries;
var cities;
var districts;
var neighborhoods;
var village;

//Country
$('.filter-country-btn').on('click', function () {
    if (countries == undefined) {
        var promiseForCountries = new Promise(function (resolve, reject) {
            crud('', '/ajax/getCountry', 'POST', beforeSend(), function (callback) {
                countries = callback;
                resetValue('country', true, false)
                $.each(countries, function (index, value) {
                    $('.filter-location-modal .countries').append(item('country', value.id, value.name));
                });
                if (countries == "")
                    $('.filter-location-modal .countries').html(null_msg);
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
    var countries_value = $('input[name="country"]').val();
    if (cities == undefined || $(this).attr('data-parent') != countries_value) {
        $(this).attr('data-parent', countries_value)
        var promiseForCities = new Promise(function (resolve, reject) {
            crud('id=' + countries_value, '/ajax/getCities', 'POST', beforeSend(), function (callback) {
                cities = callback;
                resetValue('city', true, false)
                $.each(cities, function (index, value) {
                    $('.filter-location-modal .cities').append(item('city', value.id, value.name));
                });
                if (cities == "")
                    $('.filter-location-modal .cities').html(null_msg);
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
    var city_value = $('input[name="city"]').val();
    if (districts == undefined || $(this).attr('data-parent') != city_value) {
        $(this).attr('data-parent', city_value)
        var promiseForDistricts = new Promise(function (resolve, reject) {
            crud('id=' + city_value, '/ajax/getDistricts', 'POST', beforeSend(), function (callback) {
                districts = callback;
                resetValue('district', true, false)
                $.each(districts, function (index, value) {
                    $('.filter-location-modal .districts').append(item('district', value.id, value.name));
                });
                if (districts == "")
                    $('.filter-location-modal .districts').html(null_msg);
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
    var district_value = $('input[name="district"]').val();
    if (neighborhoods == undefined || $(this).attr('data-parent') != district_value) {
        $(this).attr('data-parent', district_value)
        var promiseForNeighborhoods = new Promise(function (resolve, reject) {
            crud('id=' + district_value, '/ajax/getNeighborhoods', 'POST', beforeSend(), function (callback) {
                neighborhoods = callback;
                resetValue('neighborhood', true, false)
                $.each(neighborhoods, function (index, value) {
                    $('.filter-location-modal .neighborhoods').append(item('neighborhood', value.id, value.name));
                });
                if (neighborhoods == "")
                    $('.filter-location-modal .neighborhoods').html(null_msg);
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
    var neighborhood_value = $('input[name="neighborhood"]').val();
    if (village == undefined || $(this).attr('data-parent') != neighborhood_value) {
        $(this).attr('data-parent', neighborhood_value)
        var promiseForVillage = new Promise(function (resolve, reject) {
            crud('id=' + neighborhood_value, '/ajax/getVillage', 'POST', beforeSend(), function (callback) {
                village = callback;
                $('.filter-location-modal .village').html("");
                $.each(village, function (index, value) {
                    $('.filter-location-modal .village').append(item('village', value.id, value.name));
                });
                if (village == "")
                    $('.filter-location-modal .village').html(null_msg);
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

    return $(".filter-location-body input[type='checkbox']").change(function () {
        resetValue($(this).attr('data-field'), false, true)
        var input = $('input[name="' + $(this).attr('data-field') + '"]');
        var input_val = input.val()
        var input_name = $('.selected-'+$(this).attr('data-field')+' small').html("")
        var id = $(this).attr('data-id');
        var name = $(this).attr('data-id');
        if (input_val != "") {
            input_val = input_val.split(',');
        } else {
            input_val = [];
        }
        if (this.checked) {
            input_val.push(id);
        } else {
            input_val.splice($.inArray(id, input_val), 1);
        }
        input.val(input_val.join(','))
        $('.selected-'+$(this).attr('data-field')+' small').html("")
    });
}


function crud(params, url, type, beforeSend, callback) {
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

function item(field_name, id, value) {
    return '<li class="px-2" data-id="' + id + '">\n' +
        '                    <label class="w-100">\n' +
        '                        <input type="checkbox" data-field="' + field_name + '" data-id="' + id + '">\n' +
        '                        <small>' + value + '</small>\n' +
        '                    </label>\n' +
        '                </li>';
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
    $("#searchLocation").unbind();
    $("#searchLocation").on("keyup", function () {
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