<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\View\Query;

use Anomaly\Streams\Platform\Ui\Table\Component\View\Contract\ViewQueryInterface;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class RecentlyModifiedQuery
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class RecentlyModifiedQuery implements ViewQueryInterface
{

    /**
     * Handle the query.
     *
     * @param TableBuilder $builder
     * @param Builder      $query
     */
    public function handle(TableBuilder $builder, Builder $query)
    {
        $query
            ->orderBy('updated_at', 'desc')
            ->orderBy('created_at', 'desc');
    }
}
