<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\Filter\Query;

use Anomaly\DatetimeFieldType\DatetimeFieldType;
use Anomaly\Streams\Platform\Addon\FieldType\FieldTypeCollection;
use Anomaly\Streams\Platform\Ui\Table\Component\Filter\Contract\FilterInterface;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class DatetimeFilterQuery
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class DatetimeFilterQuery
{

    /**
     * Handle the query.
     *
     * @param Builder         $query
     * @param FilterInterface $filter
     */
    public function handle(Builder $query, FilterInterface $filter)
    {
        /* @var FieldTypeCollection $fieldTypes */
        $fieldTypes = app(FieldTypeCollection::class);

        /* @var DatetimeFieldType $datetime */
        if (!$datetime = $fieldTypes->get('anomaly.field_type.datetime')) {
            return;
        }

        $datetime
            ->setLocale(null)
            ->setField($filter->getSlug())
            ->setValue($filter->getValue())
            ->setPrefix($filter->getPrefix() . 'filter_')
            ->getQuery()
            ->filter($query, $filter);
    }
}
