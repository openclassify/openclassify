<?php

return [
    'monitoring' => [
        'stacked' => false,
        'tabs' => [
            'general_setting' => [
                'title' => 'visiosoft.theme.sahibinden::section.general_setting.name',
                'fields' => [
                    'logo_web', 'logo_mobile', 'favicon', 'help_phone','work_hours',
                    'header_primary_color', 'header_secondary_color','header_text_color', 'mobile_header_text_color',
                    'footer_primary_color', 'footer_secondary_color', 'contact_info_visible_to_login_user',
                    'show_cart', 'contact_email', 'open_links_in_new_tab', 'company_directory_img',
                    'popular_ads_img', 'last_48_hours_img', 'get_ads_img', 'fire_icon', 'price_icon'
                ],
            ],
            'homePage' => [
                'title' => 'visiosoft.theme.sahibinden::section.home_page.name',
                'fields' => [
                    'show_banner', 'show_search_banner', 'banner_web', 'banner_web_link', 'search_banner_web',
                    'search_banner_color', 'banner_mobile', 'banner_link_new_tab', 'banner_mobile_link',
                    'home_page_sub_categories_limit', 'left_menu_side',
                    'home_ad_height','show_price_and_location_main_page'
                ],
            ],
            'footer' => [
                'title' => 'visiosoft.theme.sahibinden::section.footer.name',
                'fields' => [
                    'facebook', 'twitter', 'linkedin', 'instagram',
                    'youtube', 'playstore', 'appstore', 'mobile_payment_band','enable_footer_tabs'
                ],
            ],
            'detailPage' => [
                'title' => 'visiosoft.theme.sahibinden::section.detail_page.name',
                'fields' => [
                    'ad_detail_color_scheme', 'show_view_count', 'shareWhatsappMsg',
                    'show_country', 'default_owner', 'show_owner_details',
                    'show_security_tips', 'security_tips_msg','share_after_new_ad'
                ],
            ],

            'adArea' => [
                'title' => 'visiosoft.theme.sahibinden::section.adArea.name',
                'fields' => [
                    'home_bottom_left_categories',
                    'home_top_latestAds',
                    'home_bottom_latestAds',
                    'home_bottom',
                    'home_bottom_col_1',
                    'home_bottom_col_2'

                ],
            ],
            'mobileAdArea' => [
                'title' => 'visiosoft.theme.sahibinden::section.mobileAdArea.name',
                'fields' => [
                    'home_bottom_mobile',
	                'show_subcategories_on_mobile_view',
	                'description_active'
                ],
            ],
            'catalog_mode' => [
                'title' => 'visiosoft.theme.sahibinden::section.catalog_mode.name',
                'fields' => [
                    'domains_allowed_iframe_access','home_page_sub_categories_limit', 'navigation_title', 'navigation_action', 'date_fields',
                    'price_fields', 'breadcrumbs', 'ad_details', 'ad_details_tab', 'latest_and_view_all_btn',
                    'register_page_instruction_logo', 'register_page_alert_link', 'default_country'
                ],
            ],
            'template' => [
                'title' => 'visiosoft.theme.sahibinden::section.template',
                'fields' => [
                    'gallery_box_height','style',
                ],
            ],
        ],
    ],
];
