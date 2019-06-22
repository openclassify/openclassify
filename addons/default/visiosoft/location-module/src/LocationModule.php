<?php namespace Visiosoft\LocationModule;

use Anomaly\Streams\Platform\Addon\Module\Module;

class LocationModule extends Module
{

    /**
     * The navigation display flag.
     *
     * @var bool
     */
    protected $navigation = true;

    /**
     * The addon icon.
     *
     * @var string
     */
    protected $icon = 'fa fa-location-arrow';

    /**
     * The module sections.
     *
     * @var array
     */
    protected $sections = [
        'countries' => [
            'buttons' => [
                'new_country'=> [],
            ],
        ],
        'cities' => [],
        'districts' => [],
        'neighborhoods' => [],
        'village' => [],
    ];

}
