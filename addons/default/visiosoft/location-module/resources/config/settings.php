<?php


use Anomaly\Streams\Platform\Model\Location\LocationCitiesEntryModel;
use Anomaly\Streams\Platform\Model\Location\LocationDistrictsEntryModel;
use Visiosoft\LocationModule\Country\CountryModel;

return [
    'home_page_location' => [
        'type'   => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => true,
        ],
    ],
    'list_page_location' => [
        'type'   => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => true,
        ],
    ],
    'detail_page_location' => [
        'type'   => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => true,
        ],
    ],
];
