var getCity = $('.city-data').data('content');
var getDistrict = $('.district-data').data('content');
var getNeighborhood = $('.neighborhood-data').data('content');
var getVillage = $('.village-data').data('content');
var FormName = $('.form').data('name');
var citySelectName = "city";
var districtSelectName = "district";
var neighborhoodSelectName = "neighborhood";
var villageSelectName = "village";
var countrySelectName = "country";
if(FormName == "profile")
{
    countrySelectName = "country_id";
}
var getCountry;
jQuery( document ).ready(function( $ ) {
}).promise().done(function() {
    getCountry = $('select[name="'+countrySelectName+'"]').data('content');

}).promise().done(function() {
    $('select[name="'+countrySelectName+'"]').val(getCountry);
}).promise().done(function() {
    var cat = getCountry;
    var level = 1;
    var name = citySelectName;
    Locations(cat, level, name);
}).promise().done(function() {
    var cat = getCity;
    var level = 2;
    var name = districtSelectName;
    Locations(cat, level, name);
}).promise().done(function() {
    var cat = getDistrict;
    var level = 3;
    var name = neighborhoodSelectName;
    Locations(cat, level, name);
}).promise().done(function() {
    var cat = getNeighborhood;
    var level = 4;
    var name = villageSelectName;
    var x = Locations(cat, level, name);
});

$(document).on('change', 'select[name="'+countrySelectName+'"]', function(){
    var cat = $(this).val();
    var level = 1;
    var name = citySelectName;
    Locations(cat, level, name);
});
$(document).on('change', 'select[name="'+citySelectName+'"]', function(){
    var cat = $(this).val();
    var level = 2;
    var name = districtSelectName;
    Locations(cat, level, name)
});
$(document).on('change', 'select[name="'+districtSelectName+'"]', function(){
    var cat = $(this).val();
    var level = 3;
    var name = neighborhoodSelectName;
    Locations(cat, level, name)
});
$(document).on('change', 'select[name="'+neighborhoodSelectName+'"]', function(){
    var cat = $(this).val();
    var level = 4;
    var name = villageSelectName;
    Locations(cat, level, name)
});
function Locations(cat, level, name){
    $.ajax({
        type: "GET",
        async: false,
        data: "cat=" + cat	+ "&level=" + level,
        url: "/class/ajax",
        success: function(msg){
            $('select[name="'+name+'"]').find('option').remove();
            $('select[name="'+name+'"]').append('<option value="">' + chooseOptionTrans + '...</option>');
            $.each(msg, function(key, value){
                $('select[name="'+name+'"]').append('<option value="'+value.id+'">'+value.name+'</option>');
            });
        }
    }).promise().done(function() {
        setLocation(level)
    });
}

function setLocation(level){
    if(level == 1){
        $('select[name="'+citySelectName+'"]').val(getCity);
    }else if(level == 2){
        $('select[name="'+districtSelectName+'"]').val(getDistrict);
    }else if(level == 3){
        $('select[name="'+neighborhoodSelectName+'"]').val(getNeighborhood);
    }else if(level == 4){
        $('select[name="'+villageSelectName+'"]').val(getVillage);
    }
}