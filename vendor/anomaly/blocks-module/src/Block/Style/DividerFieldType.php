<?php namespace Anomaly\BlocksModule\Block\Style;

use Anomaly\BlocksModule\Block\Traits\ProvidesStyle;
use Anomaly\SelectFieldType\SelectFieldType;

/**
 * Class DividerFieldType
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class DividerFieldType extends SelectFieldType
{

    use ProvidesStyle;

    /**
     * The field type label.
     *
     * @var string
     */
    protected $label = 'anomaly.module.blocks::style.divider.label';

    /**
     * The field type placeholder.
     *
     * @var string
     */
    protected $placeholder = 'anomaly.module.blocks::style.divider.placeholder';

    /**
     * The field type options.
     *
     * @var array
     */
    protected $options = [
        'anomaly.module.blocks::img/dividers/arrow.svg'       => 'anomaly.module.blocks::style.divider.option.arrow',
        'anomaly.module.blocks::img/dividers/arrow2.svg'      => 'anomaly.module.blocks::style.divider.option.arrow2',
        'anomaly.module.blocks::img/dividers/arrow3.svg'      => 'anomaly.module.blocks::style.divider.option.arrow3',
        'anomaly.module.blocks::img/dividers/asymmetric.svg'  => 'anomaly.module.blocks::style.divider.option.asymmetric',
        'anomaly.module.blocks::img/dividers/asymmetric2.svg' => 'anomaly.module.blocks::style.divider.option.asymmetric2',
        'anomaly.module.blocks::img/dividers/asymmetric3.svg' => 'anomaly.module.blocks::style.divider.option.asymmetric3',
        'anomaly.module.blocks::img/dividers/asymmetric4.svg' => 'anomaly.module.blocks::style.divider.option.asymmetric4',
        'anomaly.module.blocks::img/dividers/clouds.svg'      => 'anomaly.module.blocks::style.divider.option.clouds',
        'anomaly.module.blocks::img/dividers/clouds2.svg'     => 'anomaly.module.blocks::style.divider.option.clouds2',
        'anomaly.module.blocks::img/dividers/curve.svg'       => 'anomaly.module.blocks::style.divider.option.curve',
        'anomaly.module.blocks::img/dividers/curve2.svg'      => 'anomaly.module.blocks::style.divider.option.curve2',
        'anomaly.module.blocks::img/dividers/graph.svg'       => 'anomaly.module.blocks::style.divider.option.graph',
        'anomaly.module.blocks::img/dividers/graph2.svg'      => 'anomaly.module.blocks::style.divider.option.graph2',
        'anomaly.module.blocks::img/dividers/graph3.svg'      => 'anomaly.module.blocks::style.divider.option.graph3',
        'anomaly.module.blocks::img/dividers/graph4.svg'      => 'anomaly.module.blocks::style.divider.option.graph4',
        'anomaly.module.blocks::img/dividers/mountains.svg'   => 'anomaly.module.blocks::style.divider.option.mountains',
        'anomaly.module.blocks::img/dividers/mountains2.svg'  => 'anomaly.module.blocks::style.divider.option.mountains2',
        'anomaly.module.blocks::img/dividers/ramp.svg'        => 'anomaly.module.blocks::style.divider.option.ramp',
        'anomaly.module.blocks::img/dividers/ramp2.svg'       => 'anomaly.module.blocks::style.divider.option.ramp2',
        'anomaly.module.blocks::img/dividers/slant.svg'       => 'anomaly.module.blocks::style.divider.option.slant',
        'anomaly.module.blocks::img/dividers/slant2.svg'      => 'anomaly.module.blocks::style.divider.option.slant2',
        'anomaly.module.blocks::img/dividers/triangle.svg'    => 'anomaly.module.blocks::style.divider.option.triangle',
        'anomaly.module.blocks::img/dividers/wave.svg'        => 'anomaly.module.blocks::style.divider.option.wave',
        'anomaly.module.blocks::img/dividers/wave2.svg'       => 'anomaly.module.blocks::style.divider.option.wave2',
        'anomaly.module.blocks::img/dividers/waves.svg'       => 'anomaly.module.blocks::style.divider.option.waves',
        'anomaly.module.blocks::img/dividers/waves2.svg'      => 'anomaly.module.blocks::style.divider.option.waves2',
    ];

}
