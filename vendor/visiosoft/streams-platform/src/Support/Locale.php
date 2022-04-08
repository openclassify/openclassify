<?php namespace Anomaly\Streams\Platform\Support;

/**
 * Class Locale
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class Locale
{

    protected $locale;

    /**
     * Create a new Locale instance.
     *
     * @param $locale
     */
    public function __construct($locale = null)
    {
        $this->locale = $locale ?: config('app.locale');
    }

    /**
     * Return if the locale is RTL.
     *
     * @param null $locale
     * @return bool
     */
    public function isRtl($locale = null)
    {
        $locale = $locale ?: $this->locale;

        return config('streams::locales.supported.' . $locale . '.direction') == 'rtl';
    }

    /**
     * Return the locale name.
     *
     * @param null $locale
     * @return bool
     */
    public function name($locale = null)
    {
        $locale = $locale ?: $this->locale;

        return 'streams::locale.' . $locale . '.name';
    }

    /**
     * Return the full name of the locale.
     *
     * @param $locale
     * @return string
     */
    public function full($locale = null)
    {
        $locale = $locale ?: $this->locale;

        return env(
            'LOCALE_' . strtoupper($locale),
            config(
                'streams::locales.' . $locale . '.locale',
                $locale . '_' . strtoupper($locale)
            )
        );
    }

    /**
     * Return the locale.
     *
     * @return string
     */
    function __toString()
    {
        return (string)$this->locale;
    }
}
