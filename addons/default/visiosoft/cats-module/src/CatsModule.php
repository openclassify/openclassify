<?php namespace Visiosoft\CatsModule;

use Anomaly\Streams\Platform\Addon\Module\Module;

class CatsModule extends Module
{

    /**
     * The navigation display flag.
     *
     * @var bool
     */
    protected $navigation = false;

    /**
     * The addon icon.
     *
     * @var string
     */
    protected $icon = 'fa fa-indent';

    /**
     * The module sections.
     *
     * @var array
     */
    protected $sections = [
        'category' => [
            'buttons' => [
                'new_category',
            ]
        ]
    ];

    protected $parent = 'visiosoft.module.advs';
}
