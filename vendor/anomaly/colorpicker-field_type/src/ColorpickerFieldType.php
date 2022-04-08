<?php namespace Anomaly\ColorpickerFieldType;

use Anomaly\ColorpickerFieldType\Command\BuildColors;
use Anomaly\ColorpickerFieldType\Handler\DefaultHandler;
use Anomaly\Streams\Platform\Addon\FieldType\FieldType;

/**
 * Class ColorpickerFieldType
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class ColorpickerFieldType extends FieldType
{

    /**
     * The input view.
     *
     * @var string
     */
    protected $inputView = 'anomaly.field_type.colorpicker::input';

    /**
     * The config.
     *
     * @var array
     */
    protected $config = [
        'format'  => 'hex',
        'handler' => DefaultHandler::class,
    ];

    /**
     * The predefined colors.
     *
     * @var null|array
     */
    protected $colors = null;

    /**
     * Get the colors.
     *
     * @return array|null
     */
    public function getColors()
    {
        if ($this->colors === null) {
            $this->dispatch(new BuildColors($this));
        }

        return $this->colors;
    }

    /**
     * Set the colors.
     *
     * @param  array $colors
     * @return $this
     */
    public function setColors(array $colors)
    {
        $this->colors = $colors;

        return $this;
    }

}
