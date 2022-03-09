<?php namespace Anomaly\CountryFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\FieldTypePresenter;

/**
 * Class CountryFieldTypePresenter
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class CountryFieldTypePresenter extends FieldTypePresenter
{

    /**
     * The decorated object.
     * This is for IDE support.
     *
     * @var CountryFieldType
     */
    protected $object;

    /**
     * Get the country code.
     *
     * @return null|string
     */
    public function code()
    {
        if (!$key = $this->object->getValue()) {
            return null;
        }

        return strtoupper($key);
    }

    /**
     * Return the translated country name.
     *
     * @param  null $locale
     * @return null|string
     */
    public function name($locale = null)
    {
        if (!$key = $this->object->getValue()) {
            return null;
        }

        return trans('streams::country.' . $key, [], $locale);
    }

    /**
     * Return the country's currency.
     *
     * @return null|array
     */
    public function currency()
    {
        if (!$key = $this->code()) {
            return null;
        }

        if (!$code = config('streams::countries.available.' . $key . '.currency')) {
            return null;
        }

        if (!$currency = config('streams::currencies.supported.' . $code)) {
            return null;
        }

        return array_merge($currency, compact('code'));
    }

    /**
     * Return the country's locale.
     *
     * @return null|array
     */
    public function locale()
    {
        if (!$key = $this->code()) {
            return null;
        }

        if (!$code = config('streams::countries.available.' . $key . '.currency')) {
            return null;
        }

        if (!$locale = config('streams::locales.supported.' . $code)) {
            return null;
        }

        return array_merge($locale, compact('code'));
    }

    /**
     * Return the country's calling code.
     *
     * @return null|array
     */
    public function callingCode()
    {
        if (!$key = $this->code()) {
            return null;
        }

        return config('streams::countries.available.' . $key . '.calling_code');
    }
}
