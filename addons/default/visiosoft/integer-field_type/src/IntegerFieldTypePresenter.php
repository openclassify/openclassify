<?php namespace Visiosoft\IntegerFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\FieldTypePresenter;

/**
 * Class IntegerFieldTypePresenter
 *
 * @link          https://visiosoft.com.tr/
 * @author        Visiosoft, LTD. <support@visiosoft.com.tr>
 * @author        Vedat Akdoğan <vedat@visiosoft.com.tr>
 */
class IntegerFieldTypePresenter extends FieldTypePresenter
{

    /**
     * Return a formatted integer.
     *
     * @return string
     */
    public function format()
    {
        $separator = $this->object->config('separator');

        return number_format($this->object->getValue(), 0, null, str_replace('&#160;', ' ', $separator));
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
}
