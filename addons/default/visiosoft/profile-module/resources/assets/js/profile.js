function goBack() {
    window.history.back();
}

var defaultCSS = document.getElementById('bootstrap-css');

function changeCSS(css) {
    if (css) $('head > link').filter(':first').replaceWith('<link rel="stylesheet" href="' + css + '" type="text/css" />');
    else $('head > link').filter(':first').replaceWith(defaultCSS);
}

var ajaxVal = [];
var ControllerType;


var hash = window.location.hash;
if (hash != "") {
    $(".user-menu").find('.active').removeClass('active');
    $(".tab-content").find('.active').removeClass('active');
    $("." + hash.substr(1)).addClass('active');
    $("#" + hash.substr(1)).addClass('active');
    if (hash.substr(1) == "myads") {
        advs('advs');//ilan çağırma fonksiyonunu çalıştır
    }
    if (hash.substr(1) == "archived_ads") {
        advs('archived');
    }
    if (hash.substr(1) == "pending_ads") {
        advs('pending');
    }
}
$('a[data-panel="my_adv"]').add('li[data-panel="my_adv"]').on('click', function () {
    advs('advs');
});


$('.tab-btn').on('click', function () {
    if ($(this).attr('aria-controls') == "my_ads") {
        advs('advs');
    }
    if ($(this).attr('aria-controls') == "archived_ads") {
        advs('archived');
    }
    if ($(this).attr('aria-controls') == "pending_ads") {
        advs('pending');
    }
});

function advs(type) {
    var url = '/profile/getAdv';
    var includeTab;
    if (type == 'advs') {
        var add_url = 'advs';
        includeTab = 'myAdvsList';
    }
    if (type == 'archived') {
        var add_url = 'archived';
        includeTab = 'archivedAdvsList';
    }
    else if (type == 'pending') {
        var add_url = 'pending';
        includeTab = 'pendingAdvsList';
    }
    $.ajax({
        type: 'get',
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        url: url + "?type=" + add_url,
        success: function (response) {
            hideLoader()
            $('.' + includeTab).html("");
            var ads = response.content;
            $.each(ads, function (index, advs) {
                var top = "";
                var resim = resimNone;
                if (response.files[index] != "") {
                    resim = "/files/" + response.files[index][0].path;
                }
                priceFormat(advs.price.toString())
                top += "<div class='oc-item row adv" + advs.id + "'>" +
                    "<div class='item-image-box col-sm-4'>" +
                    "<div class='item-image'><a href='/advs/adv/" + advs.id + "'>" +
                    "<img src='" + resim + "' alt='Image' class='img-respon sive'></a>" +
                    "</div></div><div class='item-info col-sm-8'><div class='ad-info'>" +
                    "<h3 class='item-price'>" + priceFormat(advs.price.toString()) + " " + advs.currency + "</h3>" +
                    "<h4 class='item-title'><a href='/advs/adv/" + advs.id + "'>" + advs.name.slice(0, 38) + "...</a></h4>" +
                    "<div class='item-cat'>" +
                    "<span><a href='#'>" + advs.cat1_name + "</a></span> / " +
                    "<span><a href='#'>" + advs.cat2_name + "</a></span>" +
                    "</div>" +
                    "<div class=\"item-cat\">"+status_name+":" +
                    "<span class='status" + advs.id + "' style='color:#f7941d'>";

                if (advs.status == "pending_user" || advs.status == "passive") {
                    var date = advs.created_at.split(' ');
                    top += status_passive+"</span></div>" +
                        "</div>" +
                        "<div class='ad-meta'><div class='meta-content'>" +
                        "<span class='dated'>Posted On: <a href='#'>" + date[0] + "</a></span>" +
                        "<a class='btn btn-sm btn-success approve status-btn" + advs.id + "'" +
                        "style='margin: 0'" +
                        "data-id='" + advs.id + "' data-content='pending_admin'  data-toggle='tooltip' data-placement='top'" +
                        "title='' data-original-title='Approve this ad'>Approved</a>";
                }
                else if (advs.status == "pending_admin") {
                    top += status_pending+"</span></div>" +
                        "</div>" +
                        "<div class='ad-meta'><div class='meta-content'>" +
                        "<span class='dated'>Posted On: <a href='#'>" + advs.created_at + "</a></span>" +
                        "<a class='btn btn-sm btn-success approve status-btn" + advs.id + "'" +
                        "style='margin: 0'" +
                        "data-id='" + advs.id + "' data-content='passive'  data-toggle='tooltip' data-placement='top'" +
                        "title='' data-original-title='Approve this ad'>Passive</a>";
                } else {
                    top += status_approved+"</span></div>" +
                        "</div>" +
                        "<div class='ad-meta'><div class='meta-content'>" +
                        "<span class='dated'>"+posted_on+": <a href='#'>" + advs.created_at + "</a></span>";
                }

                top += "</div><div class='user-option pull-right'>";

                if (type == 'advs') {
                    top +=
                        "<a class='extendTime' href='#' data-content='extendTime' data-toggle='tooltip'" +
                        "data-id='" + advs.id + "' data-placement='top'" +
                        "title='' data-original-title='Extend time'><i class='fa fa-clock-o'></i></a>" +
                        "<a class='approve' href='#' data-content='passive' data-hide='true' data-toggle='tooltip'" +
                        "data-id='" + advs.id + "' data-placement='top'" +
                        "title='' data-original-title='Passive'><i class='fa fa-eye-slash'></i></a>";
                }
                if (type == "archived") {
                    top +=
                        "<a class='extendTime' href='#' data-content='extendTime' data-hide='true' data-toggle='tooltip'" +
                        "data-id='" + advs.id + "' data-placement='top'" +
                        "title='' data-original-title='Extend time'><i class='fa fa-clock-o'></i></a>";
                }
                top +=
                    "<a class='edit-item' href='/doping/" + advs.id + "' data-toggle='tooltip' data-placement='top'" +
                    "title='' data-original-title='Add Doping'><i class='fa fa-star'></i></a>" +
                    "<a class='edit-item' href='/advs/edit_advs/" + advs.id + "' data-toggle='tooltip' data-placement='top'" +
                    "title='' data-original-title='Edit this ad'><i class='fa fa-pencil'></i></a>" +
                    "<a class='delete-item' href='advs/delete/" + advs.id + "' data-toggle='tooltip' data-placement='top'" +
                    "title='' data-original-title='Delete this ad'><i class='fa fa-times'></i></a>" +
                    "</div></div></div></div>";

                $('.' + includeTab).append(top);

            });
        },
        beforeSend: function () {
            showLoader()
        }
    }).promise().done(function () {
        $('.approve').on('click', function () {
            ControllerType = "status";
            ajaxVal['id'] = $(this).data('id');
            ajaxVal['type'] = $(this).data('content');
            advsController(ajaxVal, ControllerType);
        });

        $('.extendTime').on('click', function () {
            ControllerType = "extendTime";
            ajaxVal['id'] = $(this).data('id');
            ajaxVal['type'] = "pending_admin";
            advsController(ajaxVal, ControllerType);
        });
    });
}

function priceFormat(num) {

    var arr = num.split(".");
    if (arr.length > 1) {
        return parseInt(arr[0]).toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,').slice(0,-2)+arr[1]
    } else {
        return parseInt(num).toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    }

}

function advsController(ajaxVal, ControllerType) {
    var id = ajaxVal['id'];
    var type = ajaxVal['type'];
    var menu = $(".ads-menu").find('.active').find(".tab-btn").attr('aria-controls');
    $.ajax({
        type: 'get',
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        url: '/profile/class/' + ControllerType + '/' + id + "," + type,
        success: function (response) {
            hideLoader()
            if (response.success == false) {
                alert(response.msg);
            }
            console.log(menu)
            if (menu == "my_ads") {
                advs('advs');
            }
            if (menu == "archived_ads") {
                advs('archived');
            }
            if (menu == "pending_ads") {
                advs('pending');
            }
        },
        beforeSend: function () {
            showLoader()
        }
    });
}

if(window.location.pathname == "/profile")
{
    $('input[name="gsm_phone"]').intlTelInput();
}

// $('a[data-target="#file-modal"]').on('click', function () {
//     setInterval(addSubmitFileModal, 1000);
//
// });


// function addSubmitFileModal() {
//     $('a[data-file]').on('click', function () {
//         setInterval(submitForm, 1000);
//     });
// }
//
// function submitForm() {
//     $('form[data-name="profile"]').submit();
// }

