<?php namespace Visiosoft\LocationModule;

use Anomaly\Streams\Platform\Addon\Module\Module;

class LocationModule extends Module
{
    protected $navigation = true;

    protected $icon = 'fa fa-location-arrow';

    protected $sections = [
        'countries' => [
            'buttons' => [
                'new_country',
            ],
        ],
        'cities' => [
            'buttons' => [
                'new_city' => [
                    'data-toggle' => 'modal',
                    'data-target' => '#modal',
                    'href'        => 'admin/location/cities/choose',
                ],
            ],
        ],
        'districts',
        'neighborhoods',
        'village',
    ];
}
