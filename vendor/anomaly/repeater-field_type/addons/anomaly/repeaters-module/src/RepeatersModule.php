<?php namespace Anomaly\RepeatersModule;

use Anomaly\Streams\Platform\Addon\Module\Module;

/**
 * Class RepeatersModule
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class RepeatersModule extends Module
{

    /**
     * The module icon.
     *
     * @var string
     */
    protected $icon = 'fa fa-th-list';

    /**
     * The addon sections.
     *
     * @var array
     */
    protected $sections = [
        'repeaters' => [
            'buttons'  => [
                'new_repeater',
            ],
            'sections' => [
                'assignments' => [
                    'hidden'  => true,
                    'href'    => 'admin/repeaters/assignments/{request.route.parameters.stream}',
                    'buttons' => [
                        'assign_fields' => [
                            'data-toggle' => 'modal',
                            'data-target' => '#modal',
                            'enabled'     => 'admin/repeaters/assignments/*',
                            'href'        => 'admin/repeaters/assignments/{request.route.parameters.stream}/choose',
                        ],
                    ],
                ],
            ],
        ],
        'fields'    => [
            'buttons' => [
                'new_field' => [
                    'data-toggle' => 'modal',
                    'data-target' => '#modal',
                    'href'        => 'admin/repeaters/fields/choose',
                ],
            ],
        ],
    ];
}
