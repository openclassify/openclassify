function crud(params, url, type, callback) {
    $.ajax({
        type: type,
        data: params,
        url: url,
        success: function (response) {
            callback(response);
        },
    });
}

function getMyAds(type) {
    crud({'type': type}, '/ajax/getAds', 'GET', function (callback) {
        $('#nav-' + type).html("");
        $.each(callback.content, function (index, adv) {
            $('#nav-' + type).append(addAdsRow(adv.id, adv.detail_url, adv.cover_photo, adv.name,
                adv.price + " " + adv.currency,
                adv.city_name, adv.country_name, adv.cat1_name, adv.cat2_name, adv.status));
        });
    })
}

$('.profile-ads-tab a').on('click', function () {
    getMyAds($(this).attr('data-type'))
});

getMyAds('approved');


function addAdsRow(id, href, image, name, price, city, country, cat1, cat2, status) {
    return "<div class='col-md-12 mb-2 profile-ads border-bottom border-white'>\n" +
        "<div class='row bg-light'>\n" +
        "<div class='col-md-2 justify-content-center align-self-center border-right border-white'>\n" +
        "<img class='img-thumbnail' src='" + image + "' alt='" + name + "'>\n" +
        "</div>\n" +
        "<div class='col-md-7 justify-content-center align-self-center border-right border-white'>\n" +
        "<div class='row'>\n" +
        "<div class='col-md-10'>\n" +
        "<a href='" + href + "' class='text-dark'>\n" +
        "<p>" + name + "</p>\n</a>" +
        "</div>\n" +
        "<div class='col-md-2 text-right'>\n" +
        dropdownRow(id, status) +
        "</div>\n" +
        "<div class='col-md-12 text-truncate'>\n" +
        "<small class='text-muted'>" + cat1 + ", " + cat2 + "</small>\n" +
        "</div>\n" +
        "</div>\n" +
        "</div>\n" +
        "<div class='col-md-3 text-left justify-content-center align-self-center'>\n" +
        "<div class='row'>\n" +
        "<div class='col-md-12'>\n" +
        "<b>" + price + "</b>\n" +
        "</div>\n" +
        "<div class='col-md-12 justify-content-center align-self-center text-truncate'>\n" +
        "<small>" + city + " " + country + "</small>\n" +
        "</div>\n</div>\n</div>\n</div>\n\n</div>";
}

function dropdownRow(id, type) {
    var dropdown = "<div class='dropdown'>\n" +
        "  <button class='dropdown-toggle btn btn-outline-dark' type='button' id='dropdownMenuButton' data-toggle='dropdown'>\n" +
        "<i class=\"fas fa-ellipsis-v\"></i>" +
        "  </button>\n" +
        "  <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>\n";
    if (type == "passive") {
        dropdown += "<a class='dropdown-item text-success' href='/advs/status/" + id + ",approved'>" +
            "<i class='fas fa-eye'></i> " +
            approve +
            "</a>\n";
    } else {
        dropdown += "<a class='dropdown-item text-secondary' href='/advs/status/" + id + ",passive'>" +
            "<i class='fas fa-eye-slash'></i> " +
            passive +
            "</a>\n";
    }

    dropdown += "<a class='dropdown-item text-primary' href='/advs/edit_advs/" + id + "'>" +
        "<i class='fas fa-pencil-alt'></i> " +
        edit_ad +
        "</a>\n";

    dropdown += "<a class='dropdown-item text-danger' href='/advs/delete/" + id + "'>" +
        "<i class='fas fa-trash'></i> " +
        delete_ad +
        "</a>\n";

    dropdown += "<a class='dropdown-item text-info' href='/advs/extend/" + id + "'>" +
        "<i class='fas fa-calendar'></i> " +
        extend_ad +
        "</a>\n";

    dropdown += "</div></div>";
    return dropdown;

}



