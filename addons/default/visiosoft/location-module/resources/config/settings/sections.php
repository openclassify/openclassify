<?php

return [
    'monitoring' => [
        'stacked' => false,
        'tabs' => [
            'general' => [
                'title' => 'visiosoft.module.location::section.general',
                'fields' => [
                    'home_page_location', 'list_page_location', 'detail_page_location', 'create_ad_page_location',
                ],
            ],
            'map' => [
                'title' => 'visiosoft.module.location::section.map',
                'fields' => [
                    'default_country', 'default_city', 'default_district', 'default_neighborhood'
                ],
            ],
            'setting' => [
                'title' => 'visiosoft.module.location::section.setting',
                'fields' => [
                    'google_map_key', 'map_coordinates_long', 'map_coordinates_lat'
                ],
            ],
            'html' => [
                'html' => '{% include "visiosoft.module.location::settings/field" %}',
            ],
        ],
    ],
];
