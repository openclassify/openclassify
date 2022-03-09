<?php namespace Pyrocms\StarterTheme;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;

/**
 * Class StarterThemeServiceProvider
 *
 * @link          http://anomaly.is/streams-platform
 * @author        AnomalyLabs, Inc. <hello@anomaly.is>
 * @author        Ryan Thompson <ryan@anomaly.is>
 */
class StarterThemeServiceProvider extends AddonServiceProvider
{

    /**
     * The view overrides.
     *
     * @var array
     */
    protected $overrides = [
        'streams::errors/404' => 'theme::errors/404',
        'streams::errors/500' => 'theme::errors/500',
    ];

}
