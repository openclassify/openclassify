;(function($){
    'use strict';
    let $document                                   = $(document),
        $body                                       = $('body'),
        $window                                     = $(window),
        $biolife_slide                              = $('.biolife-carousel'),
        $scroll_items                               = $('.biolife-cart-info .minicart-block ul.products'),
        $vertical_menu                              = $('#header .vertical-category-block:not(.always)'),
        $menu_mobile                                = $('.clone-main-menu'),
        $sticky_object                              = $('.biolife-sticky-object'),
        $shop_filter                                = $('#top-functions-area'),
        $biolife_select                             = $('select:not(.hidden)'),
        $rating_form                                = $('.comment-form-rating'),
        $accodition                                 = $('.biolife-accodition'),
        $block_tab                                  = $('.biolife-tab-contain'),
        $biolife_countdown                          = $('.biolife-countdown:not(.on_testing_mode)'),
        $biolife_popup                              = $('.biolife-popup'),
        $pre_loader                                 = $('#biof-loading'),
        $btn_scroll_top                             = $('.btn-scroll-top'),
        $biolife_stretch_the_right_background       = $('.biolife-stretch-the-right-background');

    /*Create Mobile Menu*/
    if( $menu_mobile.length ) {
        $menu_mobile.biolife_menu_mobile();
    }

    /*Register Quickview Box*/
    if($('#biolife-quickview-block').length){
        $document.on('click','.btn_call_quickview', function (e){
            e.preventDefault();
            $('body').trigger( 'open-overlay',['open-quickview-block']);
            quickView($(this).data('id'))
        })
    }

    /*Minicart Scroll handle*/
    if( $scroll_items.length){
        $scroll_items.niceScroll();
    }

    /*Carousel Handle*/
    if( $biolife_slide.length){
        $biolife_slide.biolife_init_carousel();
    }

    /*Vertical Menu Handle*/
    if( $vertical_menu.length){
        $vertical_menu.biolife_vertical_menu();
    }

    /*Toggle shop filter on mobile*/
    if( $shop_filter.length){
        $shop_filter.on('click', 'a.icon-for-mobile', function (e) {
            e.preventDefault();
            $body.trigger( 'open-overlay', ['top-refine-opened']);
        });
    }

    /*Header Sticky*/
    if( $sticky_object.length){
        $sticky_object.biolife_sticky_header();
    }

    /*Tab button*/
    if( $block_tab.length){
        $block_tab.biolife_tab();
    }

    /*Rating on single product*/
    if( $rating_form.length){
        $rating_form.biolife_rating_form_handle();
    }

    /*Accodition menu*/
    if( $accodition.length){
        $accodition.biolife_accodition_handle();
    }

    /*Countdown*/
    if( $biolife_countdown.length){
        $biolife_countdown.biolife_countdown();
    }

    /*stretch right background*/
    if( $biolife_stretch_the_right_background.length){
        $biolife_stretch_the_right_background.biolife_stretch_the_right_background();
        window.onresize = function(event) {
            event.preventDefault();
            $biolife_stretch_the_right_background.biolife_stretch_the_right_background();
        };
    }

    /*Popup*/
    if( $biolife_popup.length){
        $biolife_popup.modal('show');
    }

    /*Scroll to top*/
    if( $btn_scroll_top.length){
        $window.on('scroll', function () {
            if ($window.scrollTop() >= 800) {
                $btn_scroll_top.addClass('showUp');
            } else {
                $btn_scroll_top.removeClass('showUp');
            }
        });
        $btn_scroll_top.on('click', function () {
            $('html, body').animate({
                scrollTop: 0
            }, 1500);
        });
    }

    /*Events On Document*/
    $document.on('click','.minicart-item .action .edit',function (e){
        e.preventDefault();
        let $this       = $(this),
            cart_item   = $this.closest('.minicart-item'),
            input_field = cart_item.find('.input-qty'),
            curent_val  = input_field.val();
        if( !cart_item.hasClass('editing')){
            cart_item.addClass('editing');
            input_field.removeAttr('disabled').val('');
            input_field.val(curent_val).focus();
        }else{
            cart_item.removeClass('editing');
            input_field.attr('disabled', 'disabled');
        }
    });

    $document.on('click','.minicart-item .action .remove',function (e){
        e.preventDefault();
        let _this           = $(this),
            minicart_item   = _this.closest('li'),
            block_minicart  = _this.closest('.cart-inner');
        minicart_item.remove();
        $('body').trigger( 'update-minicart',[ block_minicart ]);
    });

    $document.on('click','#overlay',function (e){
        e.preventDefault();
        let _this           = $(this),
            current_class   = _this.attr('data-object'),
            class_list      = 'open-overlay';
        if( typeof current_class !== "undefined" && current_class !== ''){
            class_list +=' ' + current_class;
            _this.attr('data-object','');
        }
        $('body').removeClass(class_list);
    });

    $document.on('click','.mobile-search .btn-close',function (e){
        e.preventDefault();
        $('body').removeClass('open-overlay open-mobile-search');
    });

    $document.on('click','.mobile-search .open-searchbox, .dsktp-open-searchbox',function (e){
        e.preventDefault();
        $body.trigger( 'open-overlay',['open-mobile-search']);
    });

    $document.on('click','.mobile-footer .btn-toggle, .mobile-menu-toggle .btn-toggle',function (e){
        e.preventDefault();
        let class_name = $(this).attr('data-object');
        if(typeof class_name !=="undefined"){
            $body.trigger( 'open-overlay',[class_name]);
        }
    });

    $document.on('click','.biolife-mobile-panels .biolife-close-btn, .biolife-panels-actions-wrap .biolife-close-btn, .btn-close-quickview', function (e){
        e.preventDefault();
        let class_name = $(this).attr('data-object');
        if(typeof class_name !== 'undefined'){
            $body.trigger('close-overlay', [class_name]);
        }
    });

    $document.on('click','.biolife-filter .check-list .check-link', function (e){
        e.preventDefault();
        let this_item   = $(this),
            father      = this_item.parent(),
            contain     = this_item.closest('ul.check-list');
        if( !contain.hasClass('multiple')){
            father.siblings().removeClass('selected');
        }
        father.toggleClass('selected');
    });

    $document.on('click','.biolife-filter .color-list .c-link', function (e){
        e.preventDefault();
        let father = $(this).parent();
        father.siblings().removeClass('selected');
        father.toggleClass('selected');
    });

    $document.on('click','.qty-input .qty-btn', function (e){
        e.preventDefault();
        let btn     = $(this),
            input   = btn.siblings("input[name^='qty']");
        if(input.length){
            let current_val = parseInt(input.val(),10),
                max_val     = parseInt(input.data('max_value'),10),
                step        = parseInt(input.data('step'),10);
            if( btn.hasClass('btn-up')){
                current_val += step;
                if ( current_val <= max_val ){
                    input.val(current_val);
                }
            }else{
                current_val -= step;
                if ( current_val > 0 ){
                    input.val(current_val);
                }
            }
        }
    });

    /*Events On Body Target*/
    $body.on('update-minicart', function ( el, block_minicart) {
        if( block_minicart.find('ul.products li').length === 0 ){
            block_minicart.html('<p class="minicart-empty">No product in your cart</p>');
        }
    });

    $body.on('open-overlay', function ( e, classes) {
        let addition_classes = 'open-overlay';
        if( classes !== ''){
            addition_classes +=' '+ classes;
            $('#overlay').attr('data-object', classes);
        }
        $body.addClass(addition_classes);
    });

    $body.on('close-overlay', function ( e, object) {
        let classes = 'open-overlay';
        if( object !== ''){
            classes +=' '+ object;
            $('#overlay').attr('data-object','');
        }
        $body.removeClass(classes);
    });

    /*Create overlay Element*/
    $body.append('<div id="overlay"></div>');

    $.fn.biolife_best_equal_products();

    /*preload handle*/
    $window.on('load', function() {
        if( $pre_loader.length){
            $pre_loader.fadeOut(800);
            setTimeout(function(){
                $pre_loader.remove();
            },3000);
        }
    });
})(jQuery);
