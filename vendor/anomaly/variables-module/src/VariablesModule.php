<?php namespace Anomaly\VariablesModule;

use Anomaly\Streams\Platform\Addon\Module\Module;

/**
 * Class VariablesModule
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class VariablesModule extends Module
{

    /**
     * The addon code.
     *
     * @var string
     */
    protected $icon = 'code';

    /**
     * The addon sections.
     *
     * @var array
     */
    protected $sections = [
        'variables' => [
            'buttons' => [

            ],
        ],
        'groups'    => [
            'buttons'  => [
                'new_group',
            ],
            'sections' => [
                'assignments' => [
                    'hidden'  => true,
                    'href'    => 'admin/variables/groups/assignments/{request.route.parameters.stream}',
                    'buttons' => [
                        'assign_fields' => [
                            'data-toggle' => 'modal',
                            'data-target' => '#modal',
                            'href'        => 'admin/variables/groups/assignments/{request.route.parameters.stream}/choose',
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
                    'href'        => 'admin/variables/fields/choose',
                ],
            ],
        ],
    ];

}
