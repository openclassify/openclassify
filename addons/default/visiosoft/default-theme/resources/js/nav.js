$(document).ready(function () {
    const is = {};

    is.Active = (slug) => {
        $.ajax({
            type: 'get',
            url: '/isactive/' + slug,
            success: function (response) {
                if (response.isActive === 1) {
                    $(".profile-dropdown-list #" + slug + "").show();
                }
            },
            error: function (err) {
                reject(Error("It broke"));
            }
        });
    };

    $.ajax({
        type: 'get',
        url: '/authcheck',
        success: function (response) {
            if (response != "false") {
                if (response.first_name == "" || response.first_name == null) {
                    if (response.username.length > 10) {
                        $('.login-username').html(response.username.substr(0, 9) + "...");
                    } else {
                        $('.login-username').html(response.username);
                    }
                } else {
                    if (response.first_name.length > 10) {
                        $('.login-username').html(response.first_name.substr(0, 9) + "...");
                    } else {
                        $('.login-username').html(response.first_name);
                    }
                }
                // add extra parameters here by using is.Active method. div name must be same as slug
                is.Active('messages');
            } else {
                $('.login-user-dropdown-menu').hide();
                $('.profile-navigation-mobile-field , .profile-navigation-field').on('click', function () {
                    window.location.href = $('.login-button-field').attr('href');
                })
                $('.login-username-field').hide();
                $('.login-button-field').attr("style", "display: block !important");
            }
        },
        error: function (err) {
            reject(Error("It broke"));
        }
    });

    $('.navigation-category-select-item').on('click', function () {
        console.log($(this).attr('data-id'));
        $('.selected-category-item').html($(this).html());
    })

});
