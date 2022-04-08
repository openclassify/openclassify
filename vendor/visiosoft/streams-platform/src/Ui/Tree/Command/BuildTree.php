<?php namespace Anomaly\Streams\Platform\Ui\Tree\Command;

use Anomaly\Streams\Platform\Ui\Tree\Component\Item\Command\BuildItems;
use Anomaly\Streams\Platform\Ui\Tree\TreeBuilder;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class BuildTree
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class BuildTree
{
    use DispatchesJobs;

    /**
     * The tree builder.
     *
     * @var TreeBuilder
     */
    protected $builder;

    /**
     * Create a new BuildTree instance.
     *
     * @param TreeBuilder $builder
     */
    public function __construct(TreeBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command.
     */
    public function handle()
    {
        /*
         * Resolve and set the tree model and stream.
         */
        $this->dispatchNow(new SetTreeModel($this->builder));
        $this->dispatchNow(new SetTreeStream($this->builder));
        $this->dispatchNow(new SetTreeOptions($this->builder));
        $this->dispatchNow(new SetDefaultOptions($this->builder));
        $this->dispatchNow(new SetTreeRepository($this->builder));
        $this->dispatchNow(new SetDefaultParameters($this->builder));

        /*
         * Before we go any further, authorize the request.
         */
        $this->dispatchNow(new AuthorizeTree($this->builder));

        /*
         * Get tree entries.
         */
        $this->dispatchNow(new GetTreeEntries($this->builder));

        /*
         * Lastly tree items.
         */
        $this->dispatchNow(new BuildItems($this->builder));
    }
}
