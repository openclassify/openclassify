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




function priceFormat(num) {

    var arr = num.split(".");
    if (arr.length > 1) {
        return parseInt(arr[0]).toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,').slice(0,-2)+arr[1]
    } else {
        return parseInt(num).toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
    }

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

