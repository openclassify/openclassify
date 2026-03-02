/* Location Data */
var boundsAction = false;

getCountries();

var getCountry = $('.country-data').data('content');
if (getCountry == "") {
    getCountry = default_country;
}
var getCity = $('.city-data').data('content');
if (getCity == "") {
    getCity = default_city;
}
var getDistrict = $('.district-data').data('content');
if (getDistrict == "") {
    getDistrict = default_district;
}
var getNeighborhood = $('.neighborhood-data').data('content');
if (getNeighborhood == "") {
    getNeighborhood = default_neighborhood;
}
var getVillage = $('.village-data').data('content');
if (getVillage == "") {
    getVillage = default_village;
}
var citySelectName = "city";
var districtSelectName = "district";
var neighborhoodSelectName = "neighborhood";
var villageSelectName = "village";
var countrySelectName = "country";
jQuery(document).ready(function ($) {

}).promise().done(function () {
    $('select[name="country"]').val(getCountry);
}).promise().done(function () {
    var cat = getCountry;
    var level = 1;
    var name = citySelectName;
    Locations(cat, level, name);
}).promise().done(function () {
    var cat = getCity;
    var level = 2;
    var name = districtSelectName;
    Locations(cat, level, name);
}).promise().done(function () {
    var cat = getDistrict;
    var level = 3;
    var name = neighborhoodSelectName;
    Locations(cat, level, name);
}).promise().done(function () {
    var cat = getNeighborhood;
    var level = 4;
    var name = villageSelectName;
    Locations(cat, level, name);
});

$(document).on('change', 'select[name="' + countrySelectName + '"]', function () {
    var cat = $(this).val();
    var level = 1;
    var name = citySelectName;
    boundsAction = true;
    Locations(cat, level, name);
});
$(document).on('change', 'select[name="' + citySelectName + '"]', function () {
    var cat = $(this).val();
    var level = 2;
    var name = districtSelectName;
    boundsAction = true;
    Locations(cat, level, name)
});
$(document).on('change', 'select[name="' + districtSelectName + '"]', function () {
    var cat = $(this).val();
    var level = 3;
    var name = neighborhoodSelectName;
    boundsAction = true;
    Locations(cat, level, name)
});
$(document).on('change', 'select[name="' + neighborhoodSelectName + '"]', function () {
    var cat = $(this).val();
    var level = 4;
    var name = villageSelectName;
    boundsAction = true;
    Locations(cat, level, name)
});

function Locations(cat, level, name) {
    $.ajax({
        type: "GET",
        data: "cat=" + cat + "&level=" + level,
        url: "/class/ajax",
        success: function (msg) {
            $('select[name="' + name + '"]').find('option').remove();
            $('select[name="' + name + '"]').append(`<option value="">${chooseOptionTrans}</option>`);
            $.each(msg, function (key, value) {
                $(`select[name="${name}"]`).append(`<option value="${value.id}">${capFirst(value.name)}</option>`);
            });
        }
    }).promise().done(function () {
        setLocation(level);
        haritaIslem(0);
    });
}

function capFirst(value) {
    if (!value) return ''
    return value.toLowerCase().replace(/(?:^|\s|["'([{])+\S/g, match => match.toUpperCase());
}

function setLocation(level) {
    if (level == 1) {
        $('select[name="' + citySelectName + '"]').val(getCity);
    } else if (level == 2) {
        $('select[name="' + districtSelectName + '"]').val(getDistrict);
    } else if (level == 3) {
        $('select[name="' + neighborhoodSelectName + '"]').val(getNeighborhood);
    } else if (level == 4) {
        $('select[name="' + villageSelectName + '"]').val(getVillage);
    }
}

var locationedit = $('input[name="map_Val"]').val();
if (locationedit) {
    var lat = locationedit.split(",")[0];
    var lng = locationedit.split(",")[1];
    var coordcenter = new google.maps.LatLng(lat, lng);
} else {
    var coordcenter = new google.maps.LatLng(defaultLat, defaultLong);
}

var mapOptions = {

    center: coordcenter,
    zoom: 6,
    mapTypeId: google.maps.MapTypeId.STREET
};
var secildi = 0;
var marker;
var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

function haritaIslem() {
    var str = '';
    if ($('select[name="' + countrySelectName + '"]').val()) {
        str += $('select[name="' + countrySelectName + '"] :selected').first().text() + ' ';
    }
    if ($('select[name="' + citySelectName + '"]').val()) {
        str += $('select[name="' + citySelectName + '"] :selected').first().text() + ' ';
    }
    if ($('select[name="' + districtSelectName + '"]').val()) {
        str += $('select[name="' + districtSelectName + '"] :selected').first().text() + ' ';
    }
    if ($('select[name="' + neighborhoodSelectName + '"]').val()) {
        str += $('select[name="' + neighborhoodSelectName + '"] :selected').first().text() + ' ';
    }

    if (!str) {
        return true;
    }
    str = str.replace(/\(.+\)/g, "").replace('  ', ' ');
    google.maps.event.addListener(map, 'click', function (event) {
        placeMarker(event.latLng);
    });
    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({'address': str}, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            var searchLoc = results[0].geometry.location;
            var lat = results[0].geometry.location.lat();
            var lng = results[0].geometry.location.lng();
            var latlng = new google.maps.LatLng(lat, lng);
            var bounds = results[0].geometry.bounds;
            if (boundsAction) {
                map.fitBounds(bounds);
            }
        }
        if ($('select[name="' + neighborhoodSelectName + '"]').val() != "" && $('select[name="' + neighborhoodSelectName + '"]').val() != 0 && secildi == 0) {
            secildi = 1;

        }
    });
}

function placeMarker(location) {
    var lat = location.lat();
    var lng = location.lng();
    $(".mapVal").val(lat + "," + lng);
    if (marker) {
        marker.setPosition(location);
        $("#map").data(lat + "," + lng);
    } else {
        marker = new google.maps.Marker({
            position: location,
            map: map

        });
    }
}

editMarket();

function editMarket() {
    var locationedit = $('input[name="map_Val"]').val();
    if (locationedit) {

        var lat = locationedit.split(",")[0];
        var lng = locationedit.split(",")[1];

        var locationMap = new google.maps.LatLng(lat, lng);
        $(".mapVal").val($('input[name="map_Val"]').val());
        if (marker) {
            marker.setPosition(locationMap);
            $("#map").data(lat + "," + lng);
        } else {
            marker = new google.maps.Marker({
                position: locationMap,
                map: map
            });
        }
    }
}

function getCountries() {
    crudAjax('', '/ajax/getCountry', 'GET', function (callback) {
        $.each(callback, function (index, value) {
            $('select[name="country"]').append("<option value='" + value.id + "'>" + value.name + "</option>");
        });
    })
}
