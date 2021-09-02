<?php namespace Visiosoft\ClassifiedsModule\Classified\Table\Filter;

use Anomaly\Streams\Platform\Ui\Table\Component\Filter\Contract\FilterInterface;
use Illuminate\Database\Eloquent\Builder;

class CategoryFilterQuery
{

    public function handle(Builder $query, FilterInterface $filter)
    {
        $query->where('classifieds_classifieds.cat1', $filter->getValue());
    }
}
