<?php namespace Visiosoft\AdvsModule\Support\Command;

class Currency
{

    public function format($number, $currency = null, array $options = [])
    {
        $currency = strtoupper($currency ?: setting_value('streams::currency'));

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
        $decimals = array_get(
            $options,
            'decimals',
            config('streams::currencies.supported.' . $currency . '.decimals', 2)
        );
        $point = array_get(
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

        if (is_object($number)) {
            $number = $number->getValue();
        }

        $decimal_value = $this->getDecimalValue($number);

        if (setting_value('visiosoft.field_type.decimal::showDecimalMaxPrice') < intval($number) and $decimal_value == 0) {
            if (!setting_value('visiosoft.field_type.decimal::showDecimal')) {
                $decimals = 0;
            }
        }
        if (setting_value('visiosoft.module.advs::show_price_to_members_only') && !auth()->check()){
            return null;
        }
        return $prefix . number_format($number, $decimals, $point, str_replace('&#160;', ' ', $separator)) . $suffix;
    }

    public function normalize($number, $currency = null, array $options = [])
    {
        $currency = strtoupper($currency ?: config('streams::currencies.default'));

        $separator = array_get(
            $options,
            'separator',
            config('streams::currencies.supported.' . $currency . '.separator', ',')
        );
        $decimals = array_get(
            $options,
            'decimals',
            config('streams::currencies.supported.' . $currency . '.decimals', 2)
        );
        $point = array_get(
            $options,
            'point',
            config('streams::currencies.supported.' . $currency . '.point', '.')
        );

        return number_format(floor(($number * 100)) / 100, $decimals, $point, $separator);
    }


    public function symbol($currency = null)
    {
        if (!$currency) {
            $currency = config('streams::currencies.default');
        }

        return config('streams::currencies.supported.' . strtoupper($currency) . '.symbol');
    }

    public function getDecimalValue($price)
    {
        $whole = (int)$price;
        $decimal = ($price - $whole) * 100;
        return (int)number_format($decimal);
    }
}
