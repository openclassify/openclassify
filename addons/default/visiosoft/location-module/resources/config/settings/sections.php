<?php

return [
    'monitoring' => [
        'stacked' => false,
        'tabs' => [
            'general' => [
                'title' => 'visiosoft.module.location::section.general',
                'fields' => [
                    'sorting_column','sorting_type',
                    'home_page_location', 'list_page_location',
                    'detail_page_location', 'create_ad_page_location',
                    'country_for_phone_field', 'show_map_when_creating_ad',
                    'store_registration_page_location'
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
            'filter' => [
                'title' => 'visiosoft.module.location::section.filter',
                'fields' => [
                    'hide_location_filter'
                ],
            ],
            'html' => [
                'html' => '{% include "visiosoft.module.location::settings/field" %}',
            ],
        ],
    ],
];
