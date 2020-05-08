<?php namespace Visiosoft\AdvsModule\Currency;
use Anomaly\Streams\Platform\Support\Currency;

class CurrencyFormat
{
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

            $prefix = app(Currency::class)->symbol($currency);
        } else {
            $suffix = app(Currency::class)->symbol($currency);
        }
        return $prefix . number_format(($number * 100) / 100, $decimals, $point, $separator) . $suffix;
    }
}
