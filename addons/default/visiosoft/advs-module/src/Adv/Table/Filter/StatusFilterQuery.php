<?php namespace Visiosoft\AdvsModule\Adv\Table\Filter;

use Anomaly\Streams\Platform\Ui\Table\Component\Filter\Contract\FilterInterface;
use Illuminate\Database\Eloquent\Builder;

class StatusFilterQuery
{

    public function handle(Builder $query, FilterInterface $filter)
    {
        if ($filter->getValue() == 'approved') {
            $query
                ->where('advs_advs.status', 'approved')
                ->where('advs_advs.finish_at', '>', date('Y-m-d H:i:s'));
        }

        if ($filter->getValue() == 'expired') {
            $query
                ->where('advs_advs.finish_at', '<', date('Y-m-d H:i:s'))
                ->WhereNotNull('advs_advs.finish_at');
        }

        if ($filter->getValue() == 'unpublished') {
            $query
                ->where('advs_advs.status', 'passive');
        }

        if ($filter->getValue() == 'pending_admin') {
            $query
                ->where('advs_advs.status', 'pending_admin')
                ->where('advs_advs.finish_at', '>', date('Y-m-d H:i:s'))
                ->orWhereNull('advs_advs.finish_at');
        }

        if ($filter->getValue() == 'pending_user') {
            $query
                ->where('advs_advs.status', 'pending_user')
                ->where('advs_advs.finish_at', '>', date('Y-m-d H:i:s'))
                ->orWhereNull('advs_advs.finish_at');
        }
    }
}
