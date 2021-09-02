<?php namespace Visiosoft\ClassifiedsModule\Classified\Table\Filter;

use Anomaly\Streams\Platform\Ui\Table\Component\Filter\Contract\FilterInterface;
use Illuminate\Database\Eloquent\Builder;

class StatusFilterQuery
{

    public function handle(Builder $query, FilterInterface $filter)
    {
        if ($filter->getValue() == 'approved') {
            $query
                ->where('classifieds_classifieds.status', 'approved')
                ->where('classifieds_classifieds.finish_at', '>', date('Y-m-d H:i:s'));
        }

        if ($filter->getValue() == 'expired') {
            $query
                ->where('classifieds_classifieds.finish_at', '<', date('Y-m-d H:i:s'))
                ->WhereNotNull('classifieds_classifieds.finish_at');
        }

        if ($filter->getValue() == 'unpublished') {
            $query
                ->where('classifieds_classifieds.status', 'passive');
        }

        if ($filter->getValue() == 'pending_admin') {
            $query
                ->where('classifieds_classifieds.status', 'pending_admin')
                ->where('classifieds_classifieds.finish_at', '>', date('Y-m-d H:i:s'))
                ->orWhereNull('classifieds_classifieds.finish_at');
        }

        if ($filter->getValue() == 'pending_user') {
            $query
                ->where('classifieds_classifieds.status', 'pending_user')
                ->where('classifieds_classifieds.finish_at', '>', date('Y-m-d H:i:s'))
                ->orWhereNull('classifieds_classifieds.finish_at');
        }
    }
}
