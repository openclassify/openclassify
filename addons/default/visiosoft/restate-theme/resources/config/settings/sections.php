<?php

return [
    'monitoring' => [
        'stacked' => false,
        'tabs' => [
            'home_settings' => [
                'title' => 'visiosoft.theme.restate::setting.home_settings.name',
                'fields' => [
                    'logo', 'logo_white', 'mobile_intro_bg', 'btn_color', 'btn_color2',
                    'home_background_image','print_logo',  'popular_cities',
                    'ad_page_target', 'header_category1' , 'header_category2',
                    'search_cat1', 'search_cat2', 'search_cat3', 'search_cat4',
                    'homepage_cats_with_images','homepage_banner_section'
                ],
            ],
            'footer_settings' => [
                'title' => 'visiosoft.theme.restate::setting.footer_settings.name',
                'fields' => [
                    'footer_doping_color','facebook_address', 'instagram_address', 'twitter_address', 'linkedin_address', 'youtube_address',
                    'app_store', 'android_store', "footer_logo",'etbis_qr','etbis_link'
                ],
            ],
            'posts' => [
                'title' => 'visiosoft.theme.restate::setting.posts.name',
                'fields' => [
                    'list_cats',
                ],
            ],
            'contact' => [
                'title' => 'visiosoft.theme.restate::setting.contact.name',
                'fields' => [
                    'address' , 'phone' , 'mail', 'company_name' , 'company_desc', 'form_desc'
                ]
            ],
            'others' => [
                'title' => 'visiosoft.theme.restate::setting.others.name',
                'fields' => [
                    'contact_info_visible_to_login_user', 'default_owner', 'shareWhatsappMsg', 'list_top_customfield'
                ]
            ],
            'catalog_mode' => [
                'title' => 'visiosoft.theme.restate::section.catalog_mode.name',
                'fields' => [
                    'breadcrumbs','home_page_sub_categories_limit','domains_allowed_iframe_access'
                ],
            ],

        ],
    ],
];
