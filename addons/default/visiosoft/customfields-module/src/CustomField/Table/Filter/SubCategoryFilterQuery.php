<?php

namespace Visiosoft\CustomfieldsModule\CustomField\Table\Filter;

use Anomaly\Streams\Platform\Ui\Table\Component\Filter\Contract\FilterInterface;
use Illuminate\Database\Eloquent\Builder;

class SubCategoryFilterQuery
{
    public function handle(Builder $query, FilterInterface $filter)
    {
        $query->orWhere('customfields_parent.cat_id', $filter->getValue());
    }
}