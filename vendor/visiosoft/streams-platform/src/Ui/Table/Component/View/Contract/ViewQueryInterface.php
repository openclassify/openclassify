<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\View\Contract;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;
use Illuminate\Database\Eloquent\Builder;

/**
 * Interface ViewQueryInterface
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
interface ViewQueryInterface
{

    /**
     * Handle the TableQueryEvent.
     *
     * @param TableBuilder $builder
     * @param Builder      $query
     */
    public function handle(TableBuilder $builder, Builder $query);
}
