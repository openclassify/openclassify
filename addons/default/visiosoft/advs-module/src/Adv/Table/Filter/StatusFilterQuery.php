<?php namespace Visiosoft\AdvsModule\Adv\Table\Filter;

use Anomaly\Streams\Platform\Ui\Table\Component\Filter\Contract\FilterInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

class StatusFilterQuery
{

    public function handle(Builder $query, FilterInterface $filter)
    {
        if ($filter->getValue() == 'expired') {
            $query->where('advs_advs.finish_at', '<=', Carbon::now());
        }

        if ($filter->getValue() == 'unpublished') {
            $query->where('advs_advs.status', '!=', 'approved');
        }
    }
}
