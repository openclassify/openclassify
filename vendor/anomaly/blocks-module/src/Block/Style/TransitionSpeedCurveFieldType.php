<?php namespace Anomaly\BlocksModule\Block\Style;

use Anomaly\BlocksModule\Block\Traits\ProvidesStyle;
use Anomaly\SelectFieldType\SelectFieldType;

/**
 * Class TransitionSpeedCurveFieldType
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class TransitionSpeedCurveFieldType extends SelectFieldType
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
    protected $label = 'anomaly.module.blocks::style.transition_speed_curve.label';

    /**
     * The field type options.
     *
     * @var array
     */
    protected $options = [
        'linear'      => 'anomaly.module.blocks::style.transition_speed_curve.option.linear',
        'ease'        => 'anomaly.module.blocks::style.transition_speed_curve.option.ease',
        'ease-in'     => 'anomaly.module.blocks::style.transition_speed_curve.option.ease-in',
        'ease-out'    => 'anomaly.module.blocks::style.transition_speed_curve.option.ease-out',
        'ease-in-out' => 'anomaly.module.blocks::style.transition_speed_curve.option.ease-in-out',
    ];

}
