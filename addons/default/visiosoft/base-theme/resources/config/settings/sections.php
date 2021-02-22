<?php

return [
    'monitoring' => [
        'stacked' => false,
        'tabs' => [
            'catalog_mode' => [
                'title' => 'visiosoft.theme.base::section.catalog_mode.name',
                'fields' => [
                    'home_page_sub_categories_limit', 'navigation_title', 'navigation_action', 'date_fields',
                    'price_fields', 'breadcrumbs', 'ad_details', 'ad_details_tab', 'latest_and_view_all_btn',
                    'register_page_instruction_logo', 'register_page_alert_link', 'default_country'
                ],
            ],
            'template' => [
                'title' => 'visiosoft.theme.base::section.template',
                'fields' => [
                    'style',
                ],
            ],
            'general_setting' => [
                'title' => 'visiosoft.theme.base::section.general_setting.name',
                'fields' => [
                    'show_navigation_switch_language', 'logo_web', 'logo_mobile', 'favicon', 'help_phone', 'header_primary_color',
                    'header_secondary_color','header_text_color', 'mobile_header_text_color', 'footer_primary_color', 'footer_secondary_color', 'contact_info_visible_to_login_user',
                ],
            ],
            'homePage' => [
                'title' => 'visiosoft.theme.base::section.home_page.name',
                'fields' => [
                    'show_banner', 'banner_web', 'banner_web_link', 'banner_mobile', 'banner_link_new_tab', 'banner_mobile_link',
                    'left_menu_side',
                    'home_ad_height',
                ],
            ],
            'footer' => [
                'title' => 'visiosoft.theme.base::section.footer.name',
                'fields' => [
                    'warning_message', 'facebook', 'twitter', 'linkedin', 'instagram',
                    'youtube', 'playstore', 'appstore'
                ],
            ],
            'detailPage' => [
                'title' => 'visiosoft.theme.base::section.detail_page.name',
                'fields' => [
                    'ad_detail_color_scheme', 'shareWhatsappMsg',
                    'show_country', 'default_owner', 'show_owner_details',
                    'show_security_tips', 'security_tips_msg'
                ],
            ],

            'adArea' => [
                'title' => 'visiosoft.theme.base::section.adArea.name',
                'fields' => [
                    'home_bottom_left_categories',
                    'home_bottom',
                    'home_top_latestAds',
                    'home_bottom_latestAds',
                    'detail_bottom',
                ],
            ],
            'mobileAdArea' => [
                'title' => 'visiosoft.theme.base::section.mobileAdArea.name',
                'fields' => [
                    'detail_bottom_mobile',
                    'home_bottom_mobile',
                    'show_subcategories_on_mobile_view',
                ],
            ],
        ],
    ],
];
