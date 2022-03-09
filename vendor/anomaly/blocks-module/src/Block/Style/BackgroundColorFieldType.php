<?php namespace Anomaly\BlocksModule\Block\Style;

use Anomaly\BlocksModule\Block\Traits\ProvidesStyle;
use Anomaly\ColorpickerFieldType\ColorpickerFieldType;

/**
 * Class BackgroundColorFieldType
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class BackgroundColorFieldType extends ColorpickerFieldType
{

    use ProvidesStyle;

    /**
     * The required flag.
     *
     * @var bool
     */
    protected $required = false;

    /**
     * The field type label.
     *
     * @var string
     */
    protected $label = 'anomaly.module.blocks::style.background_color.label';

    /**
     * Get the config.
     *
     * @return array
     */
    public function getConfig()
    {
        $config = parent::getConfig();

        $config['format'] = 'rgba';

        return $config;
    }

}
