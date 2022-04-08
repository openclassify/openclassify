<?php namespace Anomaly\BlocksModule\Block\Style;

use Anomaly\BlocksModule\Block\Traits\ProvidesStyle;
use Anomaly\SelectFieldType\SelectFieldType;

/**
 * Class BorderStyleFieldType
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class BorderStyleFieldType extends SelectFieldType
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
    protected $label = 'anomaly.module.blocks::style.border_style.label';

    /**
     * The field type options.
     *
     * @var array
     */
    protected $options = [
        'none'   => 'anomaly.module.blocks::style.border_style.option.none',
        'hidden' => 'anomaly.module.blocks::style.border_style.option.hidden',
        'dotted' => 'anomaly.module.blocks::style.border_style.option.dotted',
        'dashed' => 'anomaly.module.blocks::style.border_style.option.dashed',
        'solid'  => 'anomaly.module.blocks::style.border_style.option.solid',
        'double' => 'anomaly.module.blocks::style.border_style.option.double',
        'groove' => 'anomaly.module.blocks::style.border_style.option.groove',
        'ridge'  => 'anomaly.module.blocks::style.border_style.option.ridge',
        'inset'  => 'anomaly.module.blocks::style.border_style.option.inset',
        'outset' => 'anomaly.module.blocks::style.border_style.option.outset',
    ];

    /**
     * Get the configuration.
     *
     * @return array
     */
    public function getConfig()
    {
        $config = parent::getConfig();

        $config['default_value'] = 'none';

        return $config;
    }

}
