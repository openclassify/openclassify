// Change search mode script
$('.search-type').on('change', function () {
    $('.home-page-search-form').attr('action', this.value)
});

//Hidden Categories For Home
$('.show-all a').on('click', function () {
    if ($(this).hasClass('active-all-categories')) {
        var icon = "<i class='fas fa-arrow-circle-down'></i>"
        $(this).html(show_all_text + " " + icon);
        $(this).removeClass('active-all-categories');
        $(this).parent('li').parent('ul').find('.hidden-category').addClass('hidden')
    } else {
        var icon = "<i class='fas fa-arrow-circle-up'></i>"
        $(this).html(close_text + " " + icon);
        $(this).addClass('active-all-categories');
        $(this).parent('li').parent('ul').find('li').removeClass('hidden')
    }
})


$('.currency-filtering-label').on('click', function () {
    $('input[name="currency"]').val($(this).data('value'));
    $('.price-input').attr("placeholder", $('.price-input').data('placeholder') + " " + $(this).data('value'));
})

// Restricts input for the given textbox to the given inputFilter function.
function setInputFilter(textbox, inputFilter) {
    if (textbox) {
        ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function (event) {
            textbox.addEventListener(event, function () {
                if (inputFilter(this.value)) {
                    this.oldValue = this.value;
                    this.oldSelectionStart = this.selectionStart;
                    this.oldSelectionEnd = this.selectionEnd;
                } else if (this.hasOwnProperty("oldValue")) {
                    this.value = this.oldValue;
                    this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                } else {
                    this.value = "";
                }
            });
        });
    }
}

setInputFilter(document.getElementById("min-filter"), function (value) {
    return /^\d*\.?\d*$/.test(value); // Allow digits and '.' only, using a RegExp
});

setInputFilter(document.getElementById("max-filter"), function (value) {
    return /^\d*\.?\d*$/.test(value); // Allow digits and '.' only, using a RegExp
});

$('.price-input').focus(function () {
    $('.price-filter-btn').removeClass('hidden')
})

$('.price-input').focusout(function () {
    var min = $('#min-filter').val()
    var max = $('#max-filter').val()
    if (max == "" && min == "")
        $('.price-filter-btn').addClass('hidden')
})

$('.search-nav-btn').on('click',function () {
    $('.navigation-first').addClass('d-none');
    $('.navigation-search').removeClass('d-none');
})

$('.close-search-nav').on('click',function () {
    $('.navigation-first').removeClass('d-none');
    $('.navigation-search').addClass('d-none');
})

if (/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent)) {
    $('.description-info.classified-description .nav-tabs .nav-item.active').removeClass('active');
    $('.description-info.classified-description .nav-tabs .nav-item:first-child').addClass('active');
    $('.description-info.classified-description .tab-content .tab-pane.active').removeClass('active');
    $('.description-info.classified-description .tab-content .tab-pane:first-child').addClass(['show', 'active']);
}