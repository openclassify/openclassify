<?php namespace Anomaly\BlocksModule\Block\Style;

use Anomaly\BlocksModule\Block\Traits\ProvidesStyle;
use Anomaly\TextFieldType\TextFieldType;

/**
 * Class BorderWidthFieldType
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class BorderWidthFieldType extends TextFieldType
{

    use ProvidesStyle;

    /**
     * The field type label.
     *
     * @var string
     */
    protected $label = 'anomaly.module.blocks::style.border_width.label';

    /**
     * The input view.
     *
     * @var string
     */
    protected $inputView = 'anomaly.module.blocks::style/border_width';

    /**
     * Return the sub-fields.
     *
     * @param string $prefix
     * @return array
     */
    public static function fields($prefix = '')
    {
        return [
            $prefix . 'border_width'                => BorderWidthFieldType::class,

            /**
             * Default Field Set
             */
            $prefix . 'default_border_top_width'    => [
                'type'  => TextFieldType::class,
                'label' => 'anomaly.module.blocks::style.top.label',
            ],
            $prefix . 'default_border_left_width'   => [
                'type'  => TextFieldType::class,
                'label' => 'anomaly.module.blocks::style.left.label',
            ],
            $prefix . 'default_border_right_width'  => [
                'type'  => TextFieldType::class,
                'label' => 'anomaly.module.blocks::style.right.label',
            ],
            $prefix . 'default_border_bottom_width' => [
                'type'  => TextFieldType::class,
                'label' => 'anomaly.module.blocks::style.bottom.label',
            ],

            /**
             * Hover Field Set
             */
            $prefix . 'hover_border_top_width'      => [
                'type'  => TextFieldType::class,
                'label' => 'anomaly.module.blocks::style.top.label',
            ],
            $prefix . 'hover_border_left_width'     => [
                'type'  => TextFieldType::class,
                'label' => 'anomaly.module.blocks::style.left.label',
            ],
            $prefix . 'hover_border_right_width'    => [
                'type'  => TextFieldType::class,
                'label' => 'anomaly.module.blocks::style.right.label',
            ],
            $prefix . 'hover_border_bottom_width'   => [
                'type'  => TextFieldType::class,
                'label' => 'anomaly.module.blocks::style.bottom.label',
            ],
        ];
    }

}
