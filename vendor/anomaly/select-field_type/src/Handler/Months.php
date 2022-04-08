<?php namespace Anomaly\SelectFieldType\Handler;

use Anomaly\SelectFieldType\SelectFieldType;

/**
 * Class Months
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class Months
{

    /**
     * Handle the options.
     *
     * @param SelectFieldType $fieldType
     */
    public function handle(SelectFieldType $fieldType)
    {
        $fieldType->setOptions(
            [
                'january'   => 'anomaly.field_type.select::month.january',
                'february'  => 'anomaly.field_type.select::month.february',
                'march'     => 'anomaly.field_type.select::month.march',
                'april'     => 'anomaly.field_type.select::month.april',
                'may'       => 'anomaly.field_type.select::month.may',
                'june'      => 'anomaly.field_type.select::month.june',
                'july'      => 'anomaly.field_type.select::month.july',
                'august'    => 'anomaly.field_type.select::month.august',
                'september' => 'anomaly.field_type.select::month.september',
                'october'   => 'anomaly.field_type.select::month.october',
                'november'  => 'anomaly.field_type.select::month.november',
                'december'  => 'anomaly.field_type.select::month.december',
            ]
        );
    }
}
