<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\View\Query;

use Anomaly\Streams\Platform\Ui\Table\Component\View\Contract\ViewQueryInterface;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class TrashQuery
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class TrashQuery implements ViewQueryInterface
{

    /**
     * Handle the query.
     *
     * @param TableBuilder $builder
     * @param Builder      $query
     */
    public function handle(TableBuilder $builder, Builder $query)
    {
        $query->onlyTrashed();
    }
}
