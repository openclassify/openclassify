<?php namespace Anomaly\DatetimeFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\FieldTypePresenter;
use Carbon\Carbon;

/**
 * Class DatetimeFieldTypePresenter
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class DatetimeFieldTypePresenter extends FieldTypePresenter
{

    /**
     * The datetime field type.
     * This is for IDE hinting.
     *
     * @var DatetimeFieldType
     */
    protected $object;

    /**
     * Format the value.
     *
     * @param  null        $format
     * @return null|string
     */
    public function format($format = null)
    {
        $value = $this->object->getValue();

        if (!$format) {
            $format = $this->object->getOutputFormat();
        }

        if ($value instanceof Carbon) {
            return $value->year > 0 ? $value->format($format) : null;
        }

        try {
            (new Carbon())->createFromFormat($format, $value);
        } catch (\Exception $e) {
            return null;
        }

        return $value;
    }

    /**
     * Format the date.
     *
     * @param  null        $format
     * @return null|string
     */
    public function date($format = null)
    {
        if (!$format) {
            $format = $this->object->getOutputFormat('date');
        }

        return $this->format($format);
    }

    /**
     * Format the time.
     *
     * @param  null        $format
     * @return null|string
     */
    public function time($format = null)
    {
        if (!$format) {
            $format = $this->object->getOutputFormat('time');
        }

        return $this->format($format);
    }

    /**
     * Format the value in user format.
     *
     * @param  null        $format
     * @return null|string
     */
    public function local($format = null)
    {
        $value = $this->object->getValue();

        if (!$format) {
            $format = $this->object->getOutputFormat();
        }

        if ($value instanceof Carbon) {
            return $value->setTimezone(config('app.timezone'))->format($format);
        }

        return null;
    }

    /**
     * Return the "time ago" formatted string.
     *
     * @return null|string
     */
    public function timeAgo()
    {
        $value = $this->object->getValue();

        if ($value instanceof Carbon) {
            return $value->diffForHumans();
        }

        return null;
    }

    /**
     * Return the ISO formatted datetime.
     *
     * @return null|string
     */
    public function iso()
    {
        return $this->format('c');
    }

    /**
     * Return the RFC formatted datetime.
     *
     * @return null|string
     */
    public function rfc()
    {
        return $this->format('r');
    }

    /**
     * Try mapping missing methods to Carbon.
     *
     * @param  string $method
     * @param  array  $arguments
     * @return mixed
     */
    public function __call($method, $arguments)
    {    
        // Check if carbon has the method.
        if (is_string($value = $this->object->getValue()) && method_exists($value, $method)) {
            return call_user_func_array([$value, $method], $arguments);
        }

        return parent::__call($method, $arguments);
    }
}
