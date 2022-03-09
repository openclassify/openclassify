<?php namespace Anomaly\Streams\Platform\Support\Config;

use Anomaly\SelectFieldType\SelectFieldType;
use Anomaly\Streams\Platform\Addon\Theme\ThemeCollection;

/**
 * Class AdminThemeHandler
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AdminThemeHandler
{

    /**
     * Handle the options.
     *
     * @param SelectFieldType $fieldType
     * @param ThemeCollection $themes
     */
    public function handle(SelectFieldType $fieldType, ThemeCollection $themes)
    {
        $fieldType->setOptions($themes->admin()->pluck('title', 'namespace')->all());
    }
}
