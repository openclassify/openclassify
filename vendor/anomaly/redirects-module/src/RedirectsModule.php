<?php namespace Anomaly\RedirectsModule;

use Anomaly\Streams\Platform\Addon\Module\Module;

/**
 * Class RedirectsModule
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class RedirectsModule extends Module
{

    /**
     * The module icon.
     *
     * @var string
     */
    protected $icon = 'redo';

    /**
     * The module's sections.
     *
     * @var array
     */
    protected $sections = [
        'redirects' => [
            'buttons' => [
                'new_redirect',
            ],
        ],
        'domains' => [
            'buttons' => [
                'new_domain',
            ],
        ],
    ];

}
