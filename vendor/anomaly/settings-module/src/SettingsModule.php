<?php namespace Anomaly\SettingsModule;

use Anomaly\Streams\Platform\Addon\Module\Module;

/**
 * Class SettingsModule
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class SettingsModule extends Module
{

    /**
     * The module icon.
     *
     * @var string
     */
    protected $icon = 'cogs';

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
