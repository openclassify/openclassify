<?php

namespace Anomaly\DatetimeFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\FieldTypeQuery;
use Anomaly\Streams\Platform\Ui\Table\Component\Filter\Contract\FilterInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class DatetimeFieldTypeQuery
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class DatetimeFieldTypeQuery extends FieldTypeQuery
{

    /**
     * Filter a query by the value of a
     * field using this field type.
     *
     * @param Builder $query
     * @param FilterInterface $filter
     */
    public function filter(Builder $query, FilterInterface $filter)
    {

        /**
         * Make sure the filter value
         * is something we can use.
         */
        if (strpos($date = $filter->getValue(), ' to ') === false) {

            $from = Carbon::createFromFormat(config('streams::datetime.date_format'), $date)
                ->setTimezone(config('app.timezone'))
                ->setTime(0, 0, 0) // Start at the beginning of the day.
                ->setTimezone(config('streams::datetime.default_timezone'));

            $to = Carbon::createFromFormat(config('streams::datetime.date_format'), $date)
                ->setTimezone(config('app.timezone'))
                ->setTime(23, 59, 59) // Include up to the end of the day.
                ->setTimezone(config('streams::datetime.default_timezone'));

            $query->whereDate($query->getQuery()->from . '.' . $filter->getField(), '>=', $from->format('Y-m-d H:i:s'));
            $query->whereDate($query->getQuery()->from . '.' . $filter->getField(), '<=', $to->format('Y-m-d H:i:s'));

            return;
        }

        list($from, $to) = explode(' to ', $filter->getValue());

        $from = Carbon::createFromFormat(config('streams::datetime.date_format'), $from)
            ->setTimezone(config('app.timezone'))
            ->setTime(0, 0, 0) // Start at the beginning of the day.
            ->setTimezone(config('streams::datetime.default_timezone'));

        $to = Carbon::createFromFormat(config('streams::datetime.date_format'), $to)
            ->setTimezone(config('app.timezone'))
            ->setTime(23, 59, 59) // Include up to the end of the day.
            ->setTimezone(config('streams::datetime.default_timezone'));

        $query->whereDate($query->getQuery()->from . '.' . $filter->getField(), '>=', $from->format('Y-m-d H:i:s'));
        $query->whereDate($query->getQuery()->from . '.' . $filter->getField(), '<=', $to->format('Y-m-d H:i:s'));
    }
}
