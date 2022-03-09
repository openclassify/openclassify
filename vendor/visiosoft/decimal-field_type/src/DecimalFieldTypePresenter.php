<?php namespace Visiosoft\DecimalFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\FieldTypePresenter;

/**
 * Class DecimalFieldTypePresenter
 *
 * @link          https://visiosoft.com.tr/
 * @author        Visiosoft, LTD. <support@visiosoft.com.tr>
 * @author        Vedat Akdoğan <vedat@visiosoft.com.tr>
 * @package       Visiosoft\DecialFieldType
 */
class DecimalFieldTypePresenter extends FieldTypePresenter
{

    /**
     * Return the formatted decimal.
     *
     * @return string
     */
    public function format()
    {
        $separator = $this->object->config('separator');
        $decimals = $this->object->config('decimals');
        $point = $this->object->config('point');

        $decimal_value = $this->getDecimalValue($this->object->getValue());

        if (setting_value('visiosoft.field_type.decimal::showDecimalMaxPrice') < intval($this->object->getValue()) and $decimal_value == 0) {
            if (!setting_value('visiosoft.field_type.decimal::showDecimal')) {
                $decimals = 0;
            }
        }

        return number_format($this->object->getValue(), $decimals, $point, str_replace('&#160;', ' ', $separator));
    }

    /**
     * Return the integer formatted as a currency.
     *
     * @param null $currency
     * @param string $field
     * @return string
     */
    public function currency($currency = null, $field = 'currency')
    {
        if (!$currency) {
            $currency = $this->object->getEntry()->{$field};
        }

        if (!$currency) {
            $currency = config('streams::currencies.default');
        }

        $direction = config('streams::currencies.supported.' . strtoupper($currency) . '.direction');
        $symbol = config('streams::currencies.supported.' . strtoupper($currency) . '.symbol');

        $prefix = null;
        $suffix = null;

        if (strtolower($direction) == 'ltr') {
            $prefix = $symbol;
        } else {
            $suffix = $symbol;
        }
        return $prefix . " " . $this->format() . " " . $suffix;
    }

    public function getDecimalValue($price)
    {
        $whole = (int)$price;
        $decimal = ($price - $whole) * 100;
        return (int)number_format($decimal);
    }
}
