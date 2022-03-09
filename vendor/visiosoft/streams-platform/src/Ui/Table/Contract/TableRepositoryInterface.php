<?php namespace Anomaly\Streams\Platform\Ui\Table\Contract;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;
use Illuminate\Support\Collection;

/**
 * Interface TableRepositoryInterface
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
interface TableRepositoryInterface
{

    /**
     * Get the table entries.
     *
     * @param  TableBuilder $builder
     * @return Collection
     */
    public function get(TableBuilder $builder);
}
