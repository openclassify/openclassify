<?php namespace Anomaly\NavigationModule;

use Anomaly\Streams\Platform\Addon\Module\Module;

/**
 * Class NavigationModule
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class NavigationModule extends Module
{

    /**
     * The module icon.
     *
     * @var string
     */
    protected $icon = 'link';

    /**
     * The module sections.
     *
     * @var array
     */
    protected $sections = [
        'menus' => [
            'buttons' => [
                'new_menu',
            ],
        ],
        'links' => [
            'slug'        => 'links',
            'data-toggle' => 'modal',
            'data-target' => '#modal',
            'data-href'   => 'admin/navigation/links/{request.route.parameters.menu}',
            'href'        => 'admin/navigation/choose',

            'buttons' => [
                'new_link' => [
                    'data-toggle' => 'modal',
                    'data-target' => '#modal',
                    'href'        => 'admin/navigation/links/choose/{request.route.parameters.menu}',
                ],
            ],
        ],
    ];

}
