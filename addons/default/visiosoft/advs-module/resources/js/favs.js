const fav = {};

fav.checkFav = (id, type, divId, iconId) => {
    $.ajax({
        type: 'get',
        url: '/favs/check_favorites/'+ id+"/" +type,
        success: function (response) {
            if(response.length == 0) {
                $(divId).attr("href", "/favs/add_fav/" + id+ "/"+type);
                $(iconId).attr("class", "far fa-heart");
            } else {
                $(divId).attr("href", "/favs/delete_fav/" + id + "/" + "adv");
                $(iconId).attr("class", "fas fa-heart");
            }
        },
        error:function (err) {
            // reject(Error("It broke"));
        }
    });
};

var id = $('#adv_id').val();
var owner = $('#owner').data('content');

fav.checkFav(id,'adv', '.favorites', '#heart-icon-adv');
fav.checkFav(owner,'seller', '#owner-fav', '#heart-icon-seller');