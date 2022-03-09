<?php namespace Anomaly\BlocksModule\Block\Style;

use Anomaly\BlocksModule\Block\Traits\ProvidesStyle;
use Anomaly\IntegerFieldType\IntegerFieldType;
use Anomaly\TextFieldType\TextFieldType;

/**
 * Class BorderRadiusFieldType
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class BorderRadiusFieldType extends IntegerFieldType
{

    use ProvidesStyle;

    /**
     * The field config.
     *
     * @var array
     */
    protected $config = [
        'max'           => 50,
        'min'           => 0,
        'step'          => 1,
        'default_value' => 0,
    ];

    /**
     * The field type label.
     *
     * @var string
     */
    protected $label = 'anomaly.module.blocks::style.border_radius.label';

    /**
     * The input view.
     *
     * @var string
     */
    protected $inputView = 'anomaly.module.blocks::style/border_radius';

    /**
     * Return the sub-fields.
     *
     * @param string $prefix
     * @return array
     */
    public static function fields($prefix = '')
    {
        return [
            $prefix . 'border_radius'                      => BorderRadiusFieldType::class,

            /**
             * Desktop Field Set
             */
            $prefix . 'desktop_border_top_left_radius'     => [
                'type'  => TextFieldType::class,
                'label' => 'anomaly.module.blocks::style.top_left.label',
            ],
            $prefix . 'desktop_border_top_right_radius'    => [
                'type'  => TextFieldType::class,
                'label' => 'anomaly.module.blocks::style.top_right.label',
            ],
            $prefix . 'desktop_border_bottom_left_radius'  => [
                'type'  => TextFieldType::class,
                'label' => 'anomaly.module.blocks::style.bottom_left.label',
            ],
            $prefix . 'desktop_border_bottom_right_radius' => [
                'type'  => TextFieldType::class,
                'label' => 'anomaly.module.blocks::style.bottom_right.label',
            ],

            /**
             * Tablet Field Set
             */
            $prefix . 'tablet_border_top_left_radius'      => [
                'type'  => TextFieldType::class,
                'label' => 'anomaly.module.blocks::style.top_left.label',
            ],
            $prefix . 'tablet_border_top_right_radius'     => [
                'type'  => TextFieldType::class,
                'label' => 'anomaly.module.blocks::style.top_right.label',
            ],
            $prefix . 'tablet_border_bottom_left_radius'   => [
                'type'  => TextFieldType::class,
                'label' => 'anomaly.module.blocks::style.bottom_left.label',
            ],
            $prefix . 'tablet_border_bottom_right_radius'  => [
                'type'  => TextFieldType::class,
                'label' => 'anomaly.module.blocks::style.bottom_right.label',
            ],

            /**
             * Phone Field Set
             */
            $prefix . 'phone_border_top_left_radius'       => [
                'type'  => TextFieldType::class,
                'label' => 'anomaly.module.blocks::style.top_left.label',
            ],
            $prefix . 'phone_border_top_right_radius'      => [
                'type'  => TextFieldType::class,
                'label' => 'anomaly.module.blocks::style.top_right.label',
            ],
            $prefix . 'phone_border_bottom_left_radius'    => [
                'type'  => TextFieldType::class,
                'label' => 'anomaly.module.blocks::style.bottom_left.label',
            ],
            $prefix . 'phone_border_bottom_right_radius'   => [
                'type'  => TextFieldType::class,
                'label' => 'anomaly.module.blocks::style.bottom_right.label',
            ],
        ];
    }

}
