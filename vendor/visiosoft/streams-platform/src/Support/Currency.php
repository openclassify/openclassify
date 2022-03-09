<?php namespace Anomaly\Streams\Platform\Support;

/**
 * Class Currency
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class Currency
{

    /**
     * Return a formatted currency string.
     *
     * @param      $number
     * @param null $currency
     * @param array $options
     * @return string
     */
    public function format($number, $currency = null, array $options = [])
    {
        $currency = strtoupper($currency ?: config('streams::currencies.default'));

        $direction = array_get(
            $options,
            'direction',
            config('streams::currencies.supported.' . $currency . '.direction', 'ltr')
        );
        $separator = array_get(
            $options,
            'separator',
            config('streams::currencies.supported.' . $currency . '.separator', ',')
        );
        $decimals  = array_get(
            $options,
            'decimals',
            config('streams::currencies.supported.' . $currency . '.decimals', 2)
        );
        $point     = array_get(
            $options,
            'point',
            config('streams::currencies.supported.' . $currency . '.point', '.')
        );

        $prefix = null;
        $suffix = null;

        if (strtolower($direction) == 'ltr') {
            $prefix = $this->symbol($currency);
        } else {
            $suffix = $this->symbol($currency);
        }

        return $prefix . number_format(floor(($number * 1000)) / 1000, $decimals, $point, $separator) . $suffix;
    }

    /**
     * Normalize the currency value.
     *
     * @param      $number
     * @param null $currency
     * @param array $options
     * @return float
     */
    public function normalize($number, $currency = null, array $options = [])
    {
        $currency = strtoupper($currency ?: config('streams::currencies.default'));

        $separator = array_get(
            $options,
            'separator',
            config('streams::currencies.supported.' . $currency . '.separator', ',')
        );
        $decimals  = array_get(
            $options,
            'decimals',
            config('streams::currencies.supported.' . $currency . '.decimals', 2)
        );
        $point     = array_get(
            $options,
            'point',
            config('streams::currencies.supported.' . $currency . '.point', '.')
        );

        return number_format(floor(($number * 1000)) / 1000, $decimals, $point, $separator);
    }

    /**
     * Return the currency symbol.
     *
     * @param null $currency
     * @return string
     */
    public function symbol($currency = null)
    {
        if (!$currency) {
            $currency = config('streams::currencies.default');
        }

        return config('streams::currencies.supported.' . strtoupper($currency) . '.symbol');
    }
}
