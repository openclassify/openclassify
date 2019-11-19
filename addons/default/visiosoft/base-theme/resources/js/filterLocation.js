let searchParams = new URLSearchParams(window.location.search);

//Set Select2 Type for Location Fields
$('#cities, #countries, #districts, #neighborhoods, #village').select2({
    placeholder: select_trans
});


FindLocations = (id, table, typeDb, divId, paramName = null) => {
    $.ajax({
        type: 'get',
        url: '/getlocations',
        data: {
            id: id,
            table: table,
            typeDb: typeDb,
        },
        success: function (response) {
            setLocations(response, id, table, typeDb, divId, paramName);
            return response;
        },
        error: function (err) {
            reject(Error("It broke"));
        }
    });
};

// Set selected country in the select menu
if (useDefault) {
    $('#cities').empty();
    var table = "cities";
    var typeDb = 'parent_country_id';
    var id = searchedCountry;
    var divId = "#cities";
    FindLocations(id, table, typeDb, divId);
}

setLocations = (response, id, table, typeDb, divId, paramName) => {

    //Add Options
    if(divId != "#cities")
    {
        $(divId).append("<option value></option>")
    }
    response.forEach(function (options) {
        $(divId).append("<option value=" + options.id + ">" + options.name + "</option>")
    });

    //Set Selected Option
    if (paramName != null) {
        if (divId == "#cities") {
            $('#countries').val(searchedCountry);
            $('#countries').select2();
            $('#cities').val(findParam("city[]"));
        } else {
            $(divId).val(searchParams.get(paramName));
        }
        $(divId).select2();
    }

};

//Category Change
$('#countries').on('change', function () {
    $('#cities').empty();
    var table = "cities";
    var typeDb = 'parent_country_id';
    var id = $('#countries').val();
    var divId = "#cities";

    FindLocations(id, table, typeDb, divId);
});

//City Change
$('#cities, .select2-selection__choice__remove').on('change', function () {
    $('#districts').empty();
    var table = "districts";
    var typeDb = 'parent_city_id';
    var id = $('#cities').val();
    var divId = "#districts";

    FindLocations(id, table, typeDb, divId);
});

//Districts Change
$('#districts').on('change', function () {
    var table = "neighborhoods";
    var typeDb = 'parent_district_id';
    var id = $('#districts').val();
    var divId = "#neighborhoods";

    FindLocations(id, table, typeDb, divId);
});

//Neighborhoods Change
$('#neighborhoods').on('change', function () {
    var table = "village";
    var typeDb = 'parent_neighborhood_id';
    var id = $('#neighborhoods').val();
    var divId = "#village";

    FindLocations(id, table, typeDb, divId);
});


jQuery(document).ready(function ($) {

}).promise().done(function () {

    //Get City && Set Country
    if (searchParams.get('country') != '') {
        $('#cities').empty();
        var table = "cities";
        var typeDb = 'parent_country_id';
        var id = searchParams.get('country');
        var divId = "#cities";
        var paramName = 'city';

        FindLocations(id, table, typeDb, divId, paramName);
    }

}).promise().done(function () {

    //get District  && set city
    if (findParam('city[]').length) {
        $('#districts').empty();
        var table = "districts";
        var typeDb = 'parent_city_id';
        var id = findParam('city[]');
        var divId = "#districts";
        var paramName = 'district';

        FindLocations(id, table, typeDb, divId, paramName);
    }

}).promise().done(function () {

    //get neighborhood  && set districts
    if (searchParams.get('district') != '') {
        $('#neighborhoods').empty();
        var table = "neighborhoods";
        var typeDb = 'parent_district_id';
        var id = searchParams.get('district');
        var divId = "#neighborhoods";
        var paramName = 'neighborhood';

        FindLocations(id, table, typeDb, divId, paramName);
    }

}).promise().done(function () {

    //get village  && set neighborhoods
    if (searchParams.get('neighborhood') != '') {
        $('#village').empty();
        var table = "village";
        var typeDb = 'parent_neighborhood_id';
        var id = searchParams.get('neighborhood');
        var divId = "#village";
        var paramName = 'village';

        FindLocations(id, table, typeDb, divId, paramName);
    }

});
