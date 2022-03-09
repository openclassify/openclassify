<?php namespace Anomaly\Streams\Platform\Field\Table\View;

use Illuminate\Database\Eloquent\Builder;

/**
 * Class UnassignedQuery
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class UnassignedQuery
{

    /**
     * Handle the query.
     *
     * @param Builder $query
     */
    public function handle(Builder $query)
    {
        $query
            ->leftJoin(
                'streams_assignments',
                'streams_assignments.field_id',
                '=',
                'streams_fields.id'
            )
            ->whereNull('streams_assignments.id');
    }
}
