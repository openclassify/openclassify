<?php


use Anomaly\Streams\Platform\Model\Location\LocationCitiesEntryModel;
use Anomaly\Streams\Platform\Model\Location\LocationDistrictsEntryModel;
use Visiosoft\LocationModule\Country\CountryModel;

return [
    'latest-limit' => [
        'type' => 'anomaly.field_type.integer',
        'config' => [
            'min' => 1,
            'default_value' => 5,
        ],
    ],


    "favicon" => [
        "type" => "anomaly.field_type.file",
        "config" => [
            "folders" => ['favicon'],
            "mode" => "upload",
        ]
    ],
    'auto_approve' => [
        'type' => 'anomaly.field_type.boolean',
        'bind' => 'adv.auto_approve',
        'env' => 'ADV_AUTO_APPROVE',
        'config' => [
            'default_value' => true,
        ],
    ],
    'default_published_time' => [
        'type' => 'anomaly.field_type.integer',
        'bind' => 'adv.default_published_time',
        'env' => 'ADV_PUBLISH_TIME',
        'required' => true,
        'config' => [
            'default_value' => 10,
        ],
    ],
    'default_adv_limit' => [
        'type' => 'anomaly.field_type.integer',
        'bind' => 'adv.default_adv_limit',
        'env' => 'ADV_LIMIT',
        'required' => true,
        'config' => [
            'default_value' => 15,
        ],
    ],
    'address' => [
        'type' => 'anomaly.field_type.text',
        'bind' => 'adv.address',
        'env' => 'ADV_ADDRESS',
        'config' => [
            'default_value' => 'Basaksehir Istanbul',
        ],
    ],
    'phone' => [
        'type' => 'anomaly.field_type.text',
        'bind' => 'adv.phone',
        'env' => 'ADV_PHONE',
        'config' => [
            'default_value' => '212 555 55 55',
        ],
    ],

    'iban_numbers' => [
        'type' => 'anomaly.field_type.wysiwyg',
        'bind' => 'adv.iban',
        'env' => 'ADV_IBAN',
        'config' => [
            'default_value' => '<h3>TR00 0000 0000 0000 0000 0000 00</h3>',
        ],
    ],

    'default_country' => [
        'type' => 'anomaly.field_type.relationship',
        'bind' => 'adv.default_country',
        'env' => 'ADV_COUNTRY',
        'config' => [
            'related' => CountryModel::class,
            "default_value" => 212,
        ]
    ],
    'default_city' => [
        'type' => 'anomaly.field_type.relationship',
        'bind' => 'adv.default_city',
        'env' => 'ADV_CITY',
        'config' => [
            'related' => LocationCitiesEntryModel::class,
            "default_value" => 34,
        ]
    ],
    'default_district' => [
        'type' => 'anomaly.field_type.relationship',
        'bind' => 'adv.default_district',
        'env' => 'ADV_DISTRICT',
        'config' => [
            'related' => LocationDistrictsEntryModel::class,
            "default_value" => 1091,
        ]
    ],
    'google_map_key' => [
        'type' => 'anomaly.field_type.text',
        'bind' => 'adv.google_map_key',
        'env' => 'ADV_MAP_KEY',
        'config' => [
            'default_value' => 'AIzaSyCAGc0z8kg9rKGVy2FizFKoz0FoWWWzoGQ',
        ],
    ],
    'google_statistic_code' => [
        'type' => 'anomaly.field_type.text',
        'bind' => 'adv.google_statistic_code',
        'env' => 'ADV_GOOGLE_STATISTIC_CODE',
        'config' => [
            'default_value' => '',
        ],
    ],
    'map_coordinates_long' => [
        'type' => 'anomaly.field_type.text',
        'bind' => 'adv.map_coordinates_long',
        'env' => 'ADV_MAP_LONG',
        'config' => [
            'default_value' => '28.74558607285155',
        ],
    ],
    'map_coordinates_lat' => [
        'type' => 'anomaly.field_type.text',
        'bind' => 'adv.map_coordinates_lat',
        'env' => 'ADV_MAP_LAT',
        'config' => [
            'default_value' => '40.97817786299617',
        ],
    ],
    'logo' => [
        'type' => 'anomaly.field_type.file',
        'bind' => 'adv.logo',
        'env' => 'ADV_LOGO',
        'config' => [
            'folders' => ["images"],
            'mode' => 'upload',
        ]
    ],
    'ogImage' => [
        'type' => 'anomaly.field_type.file',
        'bind' => 'adv.ogImage',
        'env' => 'ADV_OG_IMAGE',
        'config' => [
            'folders' => ["images"],
            'mode' => 'upload',
        ]
    ],
    'currencies' => [
        "type" => "anomaly.field_type.checkboxes",
        'bind' => 'adv.currencies',
        'env' => 'ADV_CURRENCIES',
        'config' => [
            "default_value" => 'a:1:{i:0;s:1:"0";}',
            'options' => Config::get('streams::currencies.enabled')
        ]
    ],
    'free_currencyconverterapi_key' => [
        "type" => "anomaly.field_type.text",
        'bind' => 'adv.free_currencyconverterapi_key',
        'env' => 'ADV_CURRENCY_CONVERT_API_KEY',
        'config' => [
            "default_value" => "1eea72940f3868c77420"
        ]
    ],
    'default_GET' => [
        'type' => 'anomaly.field_type.boolean',
        'bind' => 'adv.default_GET',
        'env' => 'ADV_GET',
        'config' => [
            'default_value' => 0,
        ],
    ],
    'twitter' => [
        'type' => 'anomaly.field_type.text',
        'bind' => 'adv.twitter',
        'env' => 'ADV_TWITTER',
        'config' => [
            'default_value' => '/twitter.com/visiosoft'
        ]
    ],
    'facebook' => [
        'type' => 'anomaly.field_type.text',
        'bind' => 'adv.facebook',
        'env' => 'ADV_FACEBOOK',
        'config' => [
            'default_value' => '/facebook.com/visiosoft'
        ]
    ],
    'youtube' => [
        'type' => 'anomaly.field_type.text',
        'bind' => 'adv.youtube',
        'env' => 'ADV_YOUTUBE',
        'config' => [
            'default_value' => '/youtube.com/visiosoft'
        ]
    ],
    'google' => [
        'type' => 'anomaly.field_type.text',
        'bind' => 'adv.google',
        'env' => 'ADV_GOOGLE',
        'config' => [
            'default_value' => '/plus.google.com/visiosoft'
        ]
    ],
    'watermark_type' => [
        'type' => 'anomaly.field_type.select',
        'bind' => 'adv.watermark_type',
        'env' => 'ADV_WATERMARK_TYPE',
        'required' => true,
        'config' => [
            'options' => ['image' => 'Image', 'text' => 'Text'],
            'default_value' => 'text',
        ]
    ],
    'watermark_text' => [
        'type' => 'anomaly.field_type.text',
        'bind' => 'adv.watermark_text',
        'env' => 'ADV_WATERMARK_TEXT',
    ],
    'watermark_image' => [
        'type' => 'anomaly.field_type.file',
        'bind' => 'adv.watermark_image',
        'env' => 'ADV_WATERMARK_IMAGE',
        'config' => [
            'default_value' => '',
        ],
    ],
    'watermark_position' => [
        'type' => 'anomaly.field_type.select',
        'bind' => 'adv.watermark_position',
        'env' => 'ADV_WATERMARK_POSITION',
        'required' => true,
        'config' => [
            'options' => ['top-right' => 'Top Right', 'top-left' => 'Top Left', 'bottom-right' => 'Bottom Right', 'bottom-left' => 'Bottom Left', 'center' => 'Middle'],
            'default_value' => 'top-right',
        ]
    ],
    'watermark_opacity' => [
        'type' => 'anomaly.field_type.text',
        'bind' => 'adv.watermark_opacity',
        'env' => 'ADV_WATERMARK_OPACITY',
        'config' => [
            'default_value' => '80',
        ],
    ],

    'listing_page_image' => [
        'type' => 'anomaly.field_type.file',
        'bind' => 'adv.listing_page_image',
        'env' => 'ADV_LISTING_PAGE_IMAGE',
        'config' => [
            'folders' => ["adv_listing_page"],
            'mode' => 'upload',
        ]
    ],

    'enabled_currencies' => [
        'bind' => 'streams::currencies.enabled',
        'env' => 'ADV_ENABLED_CURRENCIES',
        'type' => 'anomaly.field_type.checkboxes',
        'required' => true,
        'config' => [
            'default_value' => function () {
                return [config('streams::currencies.default')];
            },
            'options' => function () {
                $array = config('streams::currencies.supported');
                $cur = array();
                foreach ($array as $key => $value) {
                    $cur[$key] = $value['name'];
                }
                return $cur;
            },
        ],
    ],
];
