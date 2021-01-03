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
        'cities',
        'districts',
        'neighborhoods',
        'village',
    ];
}
