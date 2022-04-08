<?php namespace Anomaly\ColorpickerFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\FieldTypePresenter;

/**
 * Class ColorpickerFieldTypePresenter
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class ColorpickerFieldTypePresenter extends FieldTypePresenter
{

    /**
     * The colorpicker field type.
     *
     * @var ColorpickerFieldType
     */
    protected $object;

    /**
     * Return the configured output.
     *
     * @return string
     */
    public function output()
    {
        $format = $this->object->config('format', 'hex');

        return $this->{$format}();
    }

    /**
     * Return the hex code only.
     *
     * @return string
     */
    public function code()
    {
        $value = $this->object->getValue();

        if ($this->object->config('format') != 'hex') {
            $value = $this->hex();
        }

        return ltrim($value, '#');
    }

    /**
     * Return the color as a hexadecimal value.
     *
     * @return string
     */
    public function hex()
    {
        $value = $this->object->getValue();

        if ($this->object->config('format') == 'hex') {
            return $value;
        }

        $levels = $this->levels();

        $hex = "#";
        $hex .= str_pad(dechex($levels['red']), 2, "0", STR_PAD_LEFT);
        $hex .= str_pad(dechex($levels['green']), 2, "0", STR_PAD_LEFT);
        $hex .= str_pad(dechex($levels['blue']), 2, "0", STR_PAD_LEFT);

        return $hex;
    }

    /**
     * Return the color as an RGB value.
     *
     * @return string
     */
    public function rgb()
    {
        $levels = $this->levels();

        return 'rgb(' . $levels['red'] . ', ' . $levels['green'] . ', ' . $levels['blue'] . ')';
    }

    /**
     * Return the color as an RGBA value.
     *
     * @return string
     */
    public function rgba()
    {
        $levels = $this->levels();

        return 'rgba(' . $levels['red'] . ', ' . $levels['green'] . ', ' . $levels['blue'] . ', ' . $levels['alpha'] . ')';
    }

    /**
     * Return the channel levels of the color.
     *
     * @return array
     */
    public function levels()
    {
        if (!$value = $this->object->getValue()) {
            return ['red' => 0, 'green' => 0, 'blue' => 0, 'alpha' => 0];
        }

        if (starts_with($value, '#')) {
            return $this->levelsFromHex($value);
        }

        if (starts_with($value, 'rgb(')) {
            return $this->levelsFromRgb($value);
        }

        if (starts_with($value, 'rgba(')) {
            return $this->levelsFromRgba($value);
        }

        return $this->levelsFromHex($value);
    }

    /**
     * Return the red level in the color.
     *
     * @return string
     */
    public function red()
    {
        return $this->levels()['red'];
    }

    /**
     * Return the red level in the color.
     *
     * @return string
     */
    public function green()
    {
        return $this->levels()['green'];
    }

    /**
     * Return the red level in the color.
     *
     * @return string
     */
    public function blue()
    {
        return $this->levels()['blue'];
    }

    /**
     * Return the alpha value in the color.
     *
     * @return string
     */
    public function alpha()
    {
        return $this->levels()['alpha'];
    }

    /**
     * Return levels from HEX value.
     *
     * @param $hex
     * @return array
     */
    protected function levelsFromHex($hex)
    {
        $hex = str_replace("#", "", $hex);

        if (strlen($hex) == 3) {
            $red   = hexdec($hex[0] . $hex[0]);
            $green = hexdec($hex[1] . $hex[1]);
            $blue  = hexdec($hex[2] . $hex[2]);
        } else {
            $red   = hexdec($hex[0] . $hex[1]);
            $green = hexdec($hex[2] . $hex[3]);
            $blue  = hexdec($hex[4] . $hex[5]);
        }

        $alpha = 1;

        return compact('red', 'green', 'blue', 'alpha');
    }

    /**
     * Return levels from RGB value.
     *
     * @param $rgb
     * @return array
     */
    protected function levelsFromRgb($rgb)
    {
        $levels = explode(',', str_replace([' ', 'rgba(', ')'], '', $rgb));

        $red   = $levels[0];
        $green = $levels[1];
        $blue  = $levels[2];
        $alpha = 1;

        return compact('red', 'green', 'blue', 'alpha');
    }

    /**
     * Return levels from an RGBA value.
     *
     * @param $rgba
     * @return array
     */
    protected function levelsFromRgba($rgba)
    {
        $levels = explode(',', str_replace([' ', 'rgba(', ')'], '', $rgba));

        $red   = $levels[0];
        $green = $levels[1];
        $blue  = $levels[2];
        $alpha = $levels[3];

        return compact('red', 'green', 'blue', 'alpha');
    }
}
