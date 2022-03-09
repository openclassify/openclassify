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
class DividerArrangementFieldType extends SelectFieldType
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
    protected $label = 'anomaly.module.blocks::style.divider_arrangement.label';

    /**
     * The field type options.
     *
     * @var array
     */
    protected $options = [
        'top'    => 'anomaly.module.blocks::style.divider_arrangement.option.top',
        'bottom' => 'anomaly.module.blocks::style.divider_arrangement.option.bottom',
    ];

    /**
     * Get the configuration.
     *
     * @return array
     */
    public function getConfig()
    {
        $config = parent::getConfig();

        $config['default_value'] = 'bottom';

        return $config;
    }

}
