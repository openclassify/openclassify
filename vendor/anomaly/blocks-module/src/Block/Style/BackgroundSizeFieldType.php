<?php namespace Anomaly\BlocksModule\Block\Style;

use Anomaly\BlocksModule\Block\Traits\ProvidesStyle;
use Anomaly\ColorpickerFieldType\ColorpickerFieldType;

/**
 * Class BackgroundSizeFieldType
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class BackgroundSizeFieldType extends ColorpickerFieldType
{

    use ProvidesStyle;

    /**
     * The required flag.
     *
     * @var bool
     */
    protected $required = true;

    /**
     * The field type label.
     *
     * @var string
     */
    protected $label = 'anomaly.module.blocks::style.background_size.label';

    /**
     * The field type options.
     *
     * @var array
     */
    protected $options = [
        'auto'    => 'anomaly.module.blocks::style.background_size.option.auto',
        'cover'   => 'anomaly.module.blocks::style.background_size.option.cover',
        'contain' => 'anomaly.module.blocks::style.background_size.option.contain',
    ];

    /**
     * Get the configuration.
     *
     * @return array
     */
    public function getConfig()
    {
        $config = parent::getConfig();

        $config['default_value'] = 'auto';

        return $config;
    }

}
