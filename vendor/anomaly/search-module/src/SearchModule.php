<?php namespace Anomaly\SearchModule;

use Anomaly\Streams\Platform\Addon\Module\Module;

/**
 * Class SearchModule
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class SearchModule extends Module
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
    protected $icon = 'fa fa-puzzle-piece';

    /**
     * The module sections.
     *
     * @var array
     */
    protected $sections = [
        'items' => [
            'buttons' => [
                'new_item',
            ],
        ],
    ];

}
