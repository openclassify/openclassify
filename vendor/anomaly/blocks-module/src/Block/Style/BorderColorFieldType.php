<?php namespace Anomaly\BlocksModule\Block\Style;

use Anomaly\BlocksModule\Block\Traits\ProvidesStyle;
use Anomaly\ColorpickerFieldType\ColorpickerFieldType;

/**
 * Class BorderColorFieldType
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class BorderColorFieldType extends ColorpickerFieldType
{

    use ProvidesStyle;

    /**
     * The field type label.
     *
     * @var string
     */
    protected $label = 'anomaly.module.blocks::style.border_color.label';

    /**
     * The input view.
     *
     * @var string
     */
    protected $inputView = 'anomaly.module.blocks::style/border_color';

    /**
     * Return the sub-fields.
     *
     * @param string $prefix
     * @return array
     */
    public static function fields($prefix = '')
    {
        return [
            $prefix . 'border_color'         => BorderColorFieldType::class,
            $prefix . 'default_border_color' => [
                'type'   => ColorpickerFieldType::class,
                'label'  => 'anomaly.module.blocks::style.border_color.label',
                'config' => [
                    'format' => 'rgba',
                ],
            ],
            $prefix . 'hover_border_color'   => [
                'type'   => ColorpickerFieldType::class,
                'label'  => 'anomaly.module.blocks::style.border_color.label',
                'config' => [
                    'format' => 'rgba',
                ],
            ],
        ];
    }

}
