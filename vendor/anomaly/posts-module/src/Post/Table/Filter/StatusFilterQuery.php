<?php namespace Anomaly\PostsModule\Post\Table\Filter;

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
        if ($filter->getValue() == 'live') {
            $query->where('enabled', true)->where('publish_at', '<', time());
        }

        if ($filter->getValue() == 'scheduled') {
            $query->where('enabled', true)->where('publish_at', '>', time());
        }

        if ($filter->getValue() == 'draft') {
            $query->where('enabled', false);
        }
    }
}
