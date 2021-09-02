<?php namespace Visiosoft\ClassifiedsModule\Classified\Table\Filter;

use Anomaly\Streams\Platform\Ui\Table\Component\Filter\Contract\FilterInterface;
use Illuminate\Database\Eloquent\Builder;

class UserFilterQuery
{

    public function handle(Builder $query, FilterInterface $filter)
    {
        $query->where('classifieds_classifieds.created_by_id', $filter->getValue());
    }
}
