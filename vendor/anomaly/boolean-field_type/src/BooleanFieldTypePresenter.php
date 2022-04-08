<?php namespace Anomaly\BooleanFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\FieldTypePresenter;

/**
 * Class BooleanFieldTypePresenter
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class BooleanFieldTypePresenter extends FieldTypePresenter
{

    /**
     * The decorated object.
     *
     * @var BooleanFieldType
     */
    protected $object;

    /**
     * Return whether the value is true.
     *
     * @return bool
     */
    public function isTrue()
    {
        return $this->is(true);
    }

    /**
     * Return if the value is true / false.
     *
     * @param $test
     * @return bool
     */
    public function is($test)
    {
        return $this->object->getValue() === filter_var($test, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Return whether the value is false.
     *
     * @return bool
     */
    public function isFalse()
    {
        return $this->is(false);
    }

    /**
     * Return icon representation of the value.
     *
     * @param  string $size
     * @return string
     */
    public function icon($size = 'lg')
    {
        if ($this->object->getValue()) {
            return '<i class="text-' . $this->color() . ' fa fa-check fa-' . $size . '"></i>';
        } else {
            return '<i class="text-' . $this->color() . ' fa fa-close fa-' . $size . '"></i>';
        }
    }

    /**
     * Return the configured color the value represents.
     *
     * @return string
     */
    public function color()
    {
        return $this->object->config($this->object->getValue() ? 'on_color' : 'off_color');
    }

    /**
     * Return a label.
     *
     * @param         $text
     * @param  string $context
     * @param  string $size
     * @return string
     */
    public function label($text = null, $context = null, $size = null)
    {
        if (!$text) {
            $text = $this->text();
        }

        if (!$context) {
            $context = $this->color();
        }

        return parent::label($text, $context, $size);
    }

    /**
     * Return the text value.
     *
     * @param  null $on
     * @param  null $off
     * @return string
     */
    public function text($on = null, $off = null)
    {
        $value = $this->object->getValue();

        if ($on && $value) {
            return $on;
        }

        if ($off && !$value) {
            return $off;
        }

        return trans(
            $this->object->config(
                $value ? 'on_text' : 'off_text'
            ) ?: 'anomaly.field_type.boolean::choice.' . ($value ? 'yes' : 'no')
        );
    }

    /**
     * Return the input for AJAX use.
     *
     * @return string
     */
    public function toggle()
    {
        return $this->object->getAjaxInput();
    }
}
