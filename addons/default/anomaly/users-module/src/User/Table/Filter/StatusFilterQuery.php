<?php namespace Anomaly\UsersModule\User\Table\Filter;

use Anomaly\Streams\Platform\Ui\Table\Component\Filter\Contract\FilterInterface;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class StatusFilterQuery
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class StatusFilterQuery
{

    /**
     * Handle the filter query.
     *
     * @param Builder $query
     * @param FilterInterface $filter
     */
    public function handle(Builder $query, FilterInterface $filter)
    {
        if ($filter->getValue() == 'active') {
            $query->where('enabled', true)->where('activated', true);
        }

        if ($filter->getValue() == 'inactive') {
            $query->where('enabled', true)->where('activated', false);
        }

        if ($filter->getValue() == 'disabled') {
            $query->where('enabled', false);
        }
    }
}
