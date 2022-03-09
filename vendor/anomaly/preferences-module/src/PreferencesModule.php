<?php namespace Anomaly\PreferencesModule;

use Anomaly\Streams\Platform\Addon\Module\Module;

/**
 * Class PreferencesModule
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class PreferencesModule extends Module
{

    /**
     * The module icon.
     *
     * @var string
     */
    protected $icon = 'adjust';

    /**
     * The module sections.
     *
     * @var array
     */
    protected $sections = [
        'system',
        'modules',
        'themes',
        'extensions',
        'field_types',
        'plugins',
    ];

}
