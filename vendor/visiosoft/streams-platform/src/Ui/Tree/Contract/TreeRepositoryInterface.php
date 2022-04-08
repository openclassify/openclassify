<?php namespace Anomaly\Streams\Platform\Ui\Tree\Contract;

use Anomaly\Streams\Platform\Ui\Tree\TreeBuilder;
use Illuminate\Support\Collection;

/**
 * Interface TreeRepositoryInterface
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
interface TreeRepositoryInterface
{

    /**
     * Get the tree entries.
     *
     * @param  TreeBuilder $builder
     * @return Collection
     */
    public function get(TreeBuilder $builder);

    /**
     * Save the tree.
     *
     * @param TreeBuilder $builder
     * @param array       $items
     * @param null        $parent
     */
    public function save(TreeBuilder $builder, array $items = [], $parent = null);
}
