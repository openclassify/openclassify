var onAlertLinkClick = function () {
    $('.alert a').click(function (e) {
        e.stopPropagation()
    })
};

$(document).ready(function () {
    onAlertLinkClick();
});