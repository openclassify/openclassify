<?php namespace Anomaly\BlocksModule\Block\Style;

use Anomaly\BlocksModule\Block\Traits\ProvidesStyle;
use Anomaly\IntegerFieldType\IntegerFieldType;
use Anomaly\TextFieldType\TextFieldType;

/**
 * Class PaddingFieldType
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class PaddingFieldType extends IntegerFieldType
{

    use ProvidesStyle;

    /**
     * The field config.
     *
     * @var array
     */
    protected $config = [
        'step'      => 1,
        'separator' => '',
    ];

    /**
     * The field type label.
     *
     * @var string
     */
    protected $label = 'anomaly.module.blocks::style.padding.label';

    /**
     * The input view.
     *
     * @var string
     */
    protected $inputView = 'anomaly.module.blocks::style/padding';

    /**
     * Return the sub-fields.
     *
     * @param string $prefix
     * @return array
     */
    public static function fields($prefix = '')
    {
        return [
            $prefix . 'padding'                => PaddingFieldType::class,

            /**
             * Desktop Field Set
             */
            $prefix . 'desktop_padding_top'    => [
                'type'  => TextFieldType::class,
                'label' => 'anomaly.module.blocks::style.top.label',
            ],
            $prefix . 'desktop_padding_left'   => [
                'type'  => TextFieldType::class,
                'label' => 'anomaly.module.blocks::style.left.label',
            ],
            $prefix . 'desktop_padding_right'  => [
                'type'  => TextFieldType::class,
                'label' => 'anomaly.module.blocks::style.right.label',
            ],
            $prefix . 'desktop_padding_bottom' => [
                'type'  => TextFieldType::class,
                'label' => 'anomaly.module.blocks::style.bottom.label',
            ],

            /**
             * Tablet Field Set
             */
            $prefix . 'tablet_padding_top'     => [
                'type'  => TextFieldType::class,
                'label' => 'anomaly.module.blocks::style.top.label',
            ],
            $prefix . 'tablet_padding_left'    => [
                'type'  => TextFieldType::class,
                'label' => 'anomaly.module.blocks::style.left.label',
            ],
            $prefix . 'tablet_padding_right'   => [
                'type'  => TextFieldType::class,
                'label' => 'anomaly.module.blocks::style.right.label',
            ],
            $prefix . 'tablet_padding_bottom'  => [
                'type'  => TextFieldType::class,
                'label' => 'anomaly.module.blocks::style.bottom.label',
            ],

            /**
             * Phone Field Set
             */
            $prefix . 'phone_padding_top'      => [
                'type'  => TextFieldType::class,
                'label' => 'anomaly.module.blocks::style.top.label',
            ],
            $prefix . 'phone_padding_left'     => [
                'type'  => TextFieldType::class,
                'label' => 'anomaly.module.blocks::style.left.label',
            ],
            $prefix . 'phone_padding_right'    => [
                'type'  => TextFieldType::class,
                'label' => 'anomaly.module.blocks::style.right.label',
            ],
            $prefix . 'phone_padding_bottom'   => [
                'type'  => TextFieldType::class,
                'label' => 'anomaly.module.blocks::style.bottom.label',
            ],
        ];
    }

}
