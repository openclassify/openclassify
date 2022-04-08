<?php namespace Anomaly\Streams\Platform\Addon\FieldType;

use Anomaly\Streams\Platform\Addon\AddonPresenter;
use Robbo\Presenter\Decorator;

/**
 * Class FieldTypePresenter
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class FieldTypePresenter extends AddonPresenter
{

    /**
     * The resource object.
     * This is for IDE hinting.
     *
     * @var FieldType
     */
    protected $object;

    /**
     * Get the object.
     *
     * @return FieldType
     */
    public function getObject()
    {
        return parent::getObject();
    }

    /**
     * Alias for label. Bootstrap
     * changed label to tag.
     *
     * @param         $text
     * @param  string $context
     * @param  string $size
     * @return string
     */
    public function tag($text = null, $context = null, $size = null)
    {
        return $this->label($text, $context, $size);
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
            $text = trans((string)$this->object->getValue());
        }

        if (!$context) {
            $context = 'default';
        }

        if (!$size) {
            $size = 'sm';
        }

        return "<span class=\"tag tag-{$context} tag-{$size}\">{$text}</span>";
    }

    /**
     * If attempting to access a property first
     * check if the method exists and return it's
     * result before handling natively. This makes
     * a much sexier syntax for presenter methods off
     * of entry objects.
     *
     * @param  string $key
     * @return mixed
     */
    public function __get($key)
    {
        if (method_exists($this, $key)) {
            return call_user_func_array([$this, $key], []);
        }

        if ($key == 'object') {
            return $this->object;
        }

        return app()->make(Decorator::class)->decorate(parent::__get($key));
    }

    /**
     * By default return the value.
     * This can be dangerous if used in a loop!
     * There is a PHP bug that caches it's
     * output when used in a loop.
     * Take heed.
     *
     * @return string
     */
    public function __toString()
    {
        $value = $this->object->getValue();

        if (is_array($value) || is_object($value)) {
            return json_encode($value);
        }

        return (string)$this->object->getValue();
    }

    /**
     * Return the contextual value.
     * This is the most basic usable form
     * of the value for this field type.
     *
     * Often times this is used when passing
     * values to an .env value or config value
     * as it used in the Settings and Preferences.
     *
     * @return string
     */
    public function __value()
    {
        $object = $this->getObject();

        return $object->getValue();
    }

    /**
     * Return the contextual string value
     * for humans. This is the most basic
     * value for humans display purposes.
     *
     * This is useful when looping over fields
     * and outputting a field value inline.
     */
    public function __print()
    {
        return $this->__toString();
    }
}
