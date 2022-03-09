<?php namespace Anomaly\Streams\Platform\Ui\Tree\Component\Item\Command;

use Anomaly\Streams\Platform\Ui\Tree\Component\Item\ItemBuilder;
use Anomaly\Streams\Platform\Ui\Tree\TreeBuilder;

/**
 * Class BuildItems
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class BuildItems
{

    /**
     * The tree builder.
     *
     * @var TreeBuilder
     */
    protected $builder;

    /**
     * Create a new BuildItems instance.
     *
     * @param TreeBuilder $builder
     */
    public function __construct(TreeBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command.
     *
     * @param ItemBuilder $builder
     */
    public function handle(ItemBuilder $builder)
    {
        $builder->build($this->builder);
    }
}
