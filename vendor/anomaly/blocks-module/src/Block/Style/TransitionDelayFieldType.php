<?php namespace Anomaly\BlocksModule\Block\Style;

use Anomaly\BlocksModule\Block\Traits\ProvidesStyle;
use Anomaly\SliderFieldType\SliderFieldType;

/**
 * Class TransitionDelayFieldType
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class TransitionDelayFieldType extends SliderFieldType
{

    use ProvidesStyle;

    /**
     * The field config.
     *
     * @var array
     */
    protected $config = [
        'max'           => 300,
        'min'           => 10,
        'step'          => 10,
        'default_value' => 0,
        'unit'          => 'ms',
    ];

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
    protected $label = 'anomaly.module.blocks::style.transition_delay.label';

}
