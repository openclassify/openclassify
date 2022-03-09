<?php namespace Anomaly\IntegerFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\FieldTypePresenter;

/**
 * Class IntegerFieldTypePresenter
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
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
     * @param  null   $currency
     * @param  string $field
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

        $symbol = config('streams::currencies.supported.' . strtoupper($currency) . '.symbol');

        return $symbol . $this->format();
    }
}
