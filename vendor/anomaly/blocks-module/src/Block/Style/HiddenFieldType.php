<?php namespace Anomaly\BlocksModule\Block\Style;

use Anomaly\BlocksModule\Block\Traits\ProvidesStyle;
use Anomaly\CheckboxesFieldType\CheckboxesFieldType;

/**
 * Class HiddenFieldType
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class HiddenFieldType extends CheckboxesFieldType
{

    use ProvidesStyle;

    /**
     * The field type label.
     *
     * @var string
     */
    protected $label = 'anomaly.module.blocks::style.disabled.label';

    /**
     * The field type instructions.
     *
     * @var string
     */
    protected $instructions = 'anomaly.module.blocks::style.disabled.instructions';

    /**
     * The field type options.
     *
     * @var array
     */
    protected $options = [
        'phone'   => 'anomaly.module.blocks::style.disabled.option.phone',
        'tablet'  => 'anomaly.module.blocks::style.disabled.option.tablet',
        'desktop' => 'anomaly.module.blocks::style.disabled.option.desktop',
    ];

}
