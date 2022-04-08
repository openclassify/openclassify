<?php namespace Anomaly\Streams\Platform\Ui\Grid\Contract;

use Anomaly\Streams\Platform\Ui\Grid\GridBuilder;
use Illuminate\Support\Collection;

/**
 * Interface GridRepositoryInterface
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
interface GridRepositoryInterface
{

    /**
     * Get the grid entries.
     *
     * @param  GridBuilder $builder
     * @return Collection
     */
    public function get(GridBuilder $builder);

    /**
     * Save the grid.
     *
     * @param GridBuilder $builder
     * @param array       $items
     */
    public function save(GridBuilder $builder, array $items = []);
}
