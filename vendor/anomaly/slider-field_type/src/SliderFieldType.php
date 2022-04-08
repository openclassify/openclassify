<?php namespace Anomaly\SliderFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;

/**
 * Class SliderFieldType
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class SliderFieldType extends FieldType
{

    /**
     * The input class.
     *
     * @var null|string
     */
    protected $class = null;

    /**
     * The input view.
     *
     * @var string
     */
    protected $inputView = 'anomaly.field_type.slider::input';

    /**
     * The field config.
     *
     * @var array
     */
    protected $config = [
        'max'  => 10,
        'min'  => 0,
        'step' => 1,
    ];

    /**
     * Return the default value.
     *
     * @return int
     */
    public function defaultValue()
    {
        $value = $this->config('default_value');

        if ($value === null) {
            return $this->config('min');
        }

        return $value;
    }

}
