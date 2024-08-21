$('.burger-header-area').on('click', () => {
    $(".burger").toggleClass("show");
    $(".burger-side").toggleClass("show");
    $(".burger-other").toggleClass("show");
})

$('.burger-other').on('click', () => {
    $(".burger").toggleClass("show");
    $(".burger-side").toggleClass("show");
    $(".burger-other").toggleClass("show");
})

$("body").tooltip({ selector: '[data-toggle=tooltip]', template: '<div class="tooltip" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'});

$('.sliderDefault').slick({
    dots: false,
    arrows: false,
    infinite: false,
    speed: 300,
    slidesToShow: 4,
    slidesToScroll: 4,
    responsive: [
        {
            breakpoint: 1400,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
                infinite: true,
                dots: true
            }
        },
        {
            breakpoint: 992,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2
            }
        },
        {
            breakpoint: 576,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }]
});

$('.sliderTwo').slick({
    dots: true,
    arrows: false,
    infinite: false,
    speed: 300,
    slidesToShow: 4,
    slidesToScroll: 3,
    adaptiveHeight: false,
    responsive: [
        {
            breakpoint: 1200,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
                infinite: true,
                dots: true
            }
        },
        {
            breakpoint: 992,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
                infinite: true,
                dots: true
            }
        },
        {
            breakpoint: 576,
            settings: {
                dots: false,
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }]
}).on('setPosition', function (event, slick) {
    slick.$slides.css('height', slick.$slideTrack.height() + 'px');
});

$('.sliderThree').slick({
    dots: true,
    arrows: false,
    infinite: false,
    speed: 300,
    slidesToShow: 3,
    slidesToScroll: 3,
    responsive: [
        {
            breakpoint: 992,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
                infinite: true,
                dots: true
            }
        },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }]
});

$('.sliderFour').slick({
    dots: false,
    infinite: true,
    speed: 300,
    slidesToShow: 3,
    slidesToScroll: 3,
    asNavFor: '.sliderFive',
    centerMode: false,
    focusOnSelect: true,
    fade: false,
    responsive: [
        {
            breakpoint: 1400,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2,
                infinite: true,
                dots: true
            }
        },
        {
            breakpoint: 1200,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }]
});

$('.sliderFive').slick({
    dots: false,
    fade: false,
    speed: 0,
    infinite: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    asNavFor: '.sliderFour',
});

$('.articles-slider').slick({
    dots: false,
    arrows: false,
    slidesToShow: 4,
    slidesToScroll: 4,
});

$('.post-slider').slick({
    dots: false,
    infinite: false,
    speed: 300,
    slidesToShow: 5,
    slidesToScroll: 5,
    responsive: [
        {
            breakpoint: 1400,
            settings: {
                slidesToShow: 5,
                slidesToScroll: 5,
                infinite: true,
                dots: true
            }
        },
        {
            breakpoint: 1200,
            settings: {
                slidesToShow: 4,
                slidesToScroll: 4
            }
        },
        {
            breakpoint: 992,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3
            }
        },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }]
});

$('.cities-block').slick({
    slidesToShow: 2,
    slidesToScroll: 1,
    dots: false,
    infinite: false,
})

$('.popular-search-block').slick({
    variableWidth: true,
})


$('.floating-group').find('.floating-control').each(function (index, ele) {
    var $ele = $(ele);
    if ($ele.val() != '' || $ele.is(':selected') === true) {
        $ele.parents('.floating-group').addClass('focused');
    }
})


$('.floating-control').on('focus', function (e) {
    $(this).parents('.floating-group').addClass('focused');
}).on('blur', function () {
    if ($(this).val().length > 0) {
        $(this).parents('.floating-group').addClass('focused');
    } else {
        $(this).parents('.floating-group').removeClass('focused');
    }
});
$('.floating-control').on('change', function (e) {
    if ($(this).is('select')) {
        if ($(this).val() === $("option:first", $(this)).val()) {
            $(this).parents('.floating-group').removeClass('focused');
        } else {
            $(this).parents('.floating-group').addClass('focused');
        }
    }
})

$(document).ready(function () {
    $('.customSelect').each(function () {
        var dropdownParents = $(this).parents('.select2Part')
        $(this).select2({
            dropdownParent: dropdownParents,
            minimumResultsForSearch: -1
        }).on("select2:open", function (e) {
            $(this).parents('.floating-group').addClass('focused');
        }).on("select2:close", function (e) {
            if ($(this).find(':selected').val() === '') {
                $(this).parents('.floating-group').removeClass('focused');
            }
        });
    });

    $('.customSelectMultiple').each(function () {
        var dropdownParents = $(this).parents('.select2Part');
        $(this).select2({
            dropdownParent: dropdownParents,
        }).on("select2:open", function (e) {
            $(this).parents('.floating-group').addClass('focused');
        }).on("select2:close", function (e) {
            if ($(this).val() != '') {
                $(this).parents('.floating-group').addClass('focused');
            } else {
                $(this).parents('.floating-group').removeClass('focused');
            }
        }).on("select2:select", function (e) {
            $(this).parents('.floating-group').addClass('focused');
        }).on("select2:unselect", function (e) {
            $(this).parents('.floating-group').addClass('focused');
        })
    });
});

$('.look-into').on('click', () => {
    $('body').toggleClass('overflow-hidden');
    $(".zoomImage").toggleClass("d-none");
    $(".zoomOut").toggleClass("dontShow");
    $('.nav-link').removeClass('active');
    $('.tab-pane').removeClass('active show');
})

$('.close-icon').on('click', () => {
    $(".zoomImage").toggleClass("d-none");
    $(".zoomOut").toggleClass("dontShow");
    $('body').toggleClass('overflow-hidden');

})

$(document).on('click', '.show-mega-area', function () {
    let type = $(this).data('type');

    if (type === 'photo') {
        $('.sliderFive').slick('refresh')
    }

    $('#' + type + '-tab').addClass('active');
    $('#' + type).addClass('active show');
})


$('.mobile-search-toggle-icon').on('click', function () {
    $('.mobile-search-icon, .mobile-search-area').toggleClass('d-none');
})

$('.delete-all-favs').on('click', function (){
    crudAjax({'all': true}, 'ajax/remove-favorite-ad', 'POST', function (callback) {
        if(callback.status){
            window.location.reload();
        } else {
            Swal.fire({
                icon: 'error',
                showConfirmButton: false,
                timer: 1500
            })
        }
    })
})

$('.change-register-type').on('click', function (){
    $('input[name="register_type"]').not(':checked').prop('checked', 'checked');
    changeRegisterType();
});

function printAd(){
    var divContents = document.getElementById('print').innerHTML;
    var styleContents = document.getElementById('printStyles').innerHTML;
    var printWindow = window.open('', '', 'height=850, width=1000');

    printWindow.document.write('<html><head><title></title>');
    printWindow.document.write(styleContents);
    printWindow.document.write('</head><body style="border: 25px solid #dc3545; width: 100% !important;" >');
    printWindow.document.write(divContents);
    printWindow.document.close();

    setTimeout(() => {
        printWindow.print();
    },500)
    printWindow.addEventListener('afterprint', function() {
        printWindow.close();
    });
    printWindow.focus();
}

if (typeof open_ad_tab != 'undefined' && open_ad_tab =='new') {
    $('.js-tab-event a').attr('target','_blank');
}
