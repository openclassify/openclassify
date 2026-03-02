<?php namespace Visiosoft\AdvsModule\Adv\Table\Filter;

use Anomaly\Streams\Platform\Ui\Table\Component\Filter\Contract\FilterInterface;
use Illuminate\Database\Eloquent\Builder;

class CityFilterQuery
{

    public function handle(Builder $query, FilterInterface $filter)
    {
        $query->where('advs_advs.city', $filter->getValue());
    }
}
