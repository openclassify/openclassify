<?php namespace Anomaly\BlocksModule\Block\Style;

use Anomaly\BlocksModule\Block\Traits\ProvidesStyle;
use Anomaly\SelectFieldType\SelectFieldType;

/**
 * Class BackgroundPositionFieldType
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class BackgroundPositionFieldType extends SelectFieldType
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
    protected $label = 'anomaly.module.blocks::style.background_position.label';

    /**
     * The field type options.
     *
     * @var array
     */
    protected $options = [
        'top_left'      => 'anomaly.module.blocks::style.background_position.option.top_left',
        'top_center'    => 'anomaly.module.blocks::style.background_position.option.top_center',
        'top_right'     => 'anomaly.module.blocks::style.background_position.option.top_right',
        'center_left'   => 'anomaly.module.blocks::style.background_position.option.center_left',
        'center'        => 'anomaly.module.blocks::style.background_position.option.center',
        'center_right'  => 'anomaly.module.blocks::style.background_position.option.center_right',
        'bottom_left'   => 'anomaly.module.blocks::style.background_position.option.bottom_left',
        'bottom_center' => 'anomaly.module.blocks::style.background_position.option.bottom_center',
        'bottom_right'  => 'anomaly.module.blocks::style.background_position.option.bottom_right',
    ];

    /**
     * Get the configuration.
     *
     * @return array
     */
    public function getConfig()
    {
        $config = parent::getConfig();

        $config['default_value'] = 'center';

        return $config;
    }

}
