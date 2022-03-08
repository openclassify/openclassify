<?php

return [
    'system' => [
        'fields' => [
            'admin_notifications',
        ],
    ],
    'monitoring' => [
        'stacked' => true,
        'tabs' => [
            'general_sms_settings' => [
                'icon' => 'fa fa-angle-double-right',
                'title' => 'visiosoft.module.notifications::tab.general_sms_settings.title',
                'fields' => [
                    'sms_extension',
                ],
            ],
            'new_ad_sms' => [
                'icon' => 'fa fa-angle-double-right',
                'title' => 'visiosoft.module.notifications::tab.new_ad_sms.title',
                'fields' => [
                    'new_ad_user_sms',
                ],
            ],
            'payment_sms' => [
                'icon' => 'fa fa-angle-double-right',
                'title' => 'visiosoft.module.notifications::tab.payment_sms.title',
                'fields' => [
                    'payment_user_sms',
                ],
            ],
            'status_ad_sms' => [
                'icon' => 'fa fa-angle-double-right',
                'title' => 'visiosoft.module.notifications::tab.status_ad_sms.title',
                'fields' => [
                    'status_ad_user_sms',
                ],
            ],
            'unpublish_ad_sms' => [
                'icon' => 'fa fa-angle-double-right',
                'title' => 'visiosoft.module.notifications::tab.unpublish_ad_sms.title',
                'fields' => [
                    'unpublish_ad_user_sms',
                ],
            ],
            'update_ad_sms' => [
                'icon' => 'fa fa-angle-double-right',
                'title' => 'visiosoft.module.notifications::tab.update_ad_sms.title',
                'fields' => [
                    'update_ad_user_sms',
                ],
            ],
            'email_templates' => [
                'icon' => 'fa fa-angle-double-right',
                'title' => 'visiosoft.module.notifications::tab.email_template',
                'fields' => [
                    'mail_header', 'mail_footer',
                ]
            ],
        ],
    ],
];
