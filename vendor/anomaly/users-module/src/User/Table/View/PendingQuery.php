<?php namespace Anomaly\UsersModule\User\Table\View;

use Illuminate\Database\Eloquent\Builder;

/**
 * Class PendingQuery
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class PendingQuery
{

    /**
     * Handle the query.
     *
     * @param Builder $query
     */
    public function handle(Builder $query)
    {
        $query->where('activated', false);
    }

}
