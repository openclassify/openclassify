<?php namespace Anomaly\PostsModule;

use Anomaly\Streams\Platform\Addon\Module\Module;

/**
 * Class PostsModule
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class PostsModule extends Module
{

    /**
     * The module's icon.
     *
     * @var string
     */
    protected $icon = 'newspaper';

    /**
     * The module sections.
     *
     * @var array
     */
    protected $sections = [
        'posts'      => [
            'buttons' => [
                'new_post' => [
                    'data-toggle' => 'modal',
                    'data-target' => '#modal',
                    'href'        => 'admin/posts/choose',
                ],
            ],
        ],
        'categories' => [
            'buttons' => [
                'new_category',
                'assignments',
            ],
        ],
        'types'      => [
            'buttons' => [
                'new_type',
            ],
        ],
        'fields'     => [
            'buttons'  => [
                'new_field' => [
                    'data-toggle' => 'modal',
                    'data-target' => '#modal',
                    'href'        => 'admin/posts/fields/choose',
                ],
            ],
            'sections' => [
                'assignments' => [
                    'hidden'  => true,
                    'href'    => 'admin/posts/assignments/{request.route.parameters.stream}',
                    'buttons' => [
                        'assign_fields' => [
                            'data-toggle' => 'modal',
                            'data-target' => '#modal',
                            'href'        => 'admin/posts/assignments/{request.route.parameters.stream}/choose',
                        ],
                    ],
                ],
            ],
        ],
    ];

}
