<?php namespace Anomaly\MultipleFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\FieldTypeQuery;
use Anomaly\Streams\Platform\Ui\Table\Component\Filter\Contract\FilterInterface;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class MultipleFieldTypeQuery
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class MultipleFieldTypeQuery extends FieldTypeQuery
{

    /**
     * Handle the filter query.
     *
     * @param Builder         $query
     * @param FilterInterface $filter
     */
    public function filter(Builder $query, FilterInterface $filter)
    {
        $stream = $filter->getStream();

        $query->leftJoin(
            $stream->getEntryTableName() . '_' . $filter->getField() . ' AS filter_' . $filter->getField(),
            $stream->getEntryTableName() . '.id',
            '=',
            'filter_' . $filter->getField() . '.entry_id'
        )->where('filter_' . $filter->getField() . '.related_id', $filter->getValue());
    }
}
