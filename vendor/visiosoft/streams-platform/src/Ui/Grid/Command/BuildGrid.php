<?php namespace Anomaly\Streams\Platform\Ui\Grid\Command;

use Anomaly\Streams\Platform\Ui\Grid\Component\Item\Command\BuildItems;
use Anomaly\Streams\Platform\Ui\Grid\GridBuilder;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class BuildGrid
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class BuildGrid
{
    use DispatchesJobs;

    /**
     * The grid builder.
     *
     * @var GridBuilder
     */
    protected $builder;

    /**
     * Create a new BuildGrid instance.
     *
     * @param GridBuilder $builder
     */
    public function __construct(GridBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command.
     */
    public function handle()
    {
        /*
         * Resolve and set the grid model and stream.
         */
        $this->dispatchNow(new SetGridModel($this->builder));
        $this->dispatchNow(new SetGridStream($this->builder));
        $this->dispatchNow(new SetGridOptions($this->builder));
        $this->dispatchNow(new SetDefaultOptions($this->builder));
        $this->dispatchNow(new SetGridRepository($this->builder));
        $this->dispatchNow(new SetDefaultParameters($this->builder));

        /*
         * Before we go any further, authorize the request.
         */
        $this->dispatchNow(new AuthorizeGrid($this->builder));

        /*
         * Get grid entries.
         */
        $this->dispatchNow(new GetGridEntries($this->builder));

        /*
         * Lastly grid items.
         */
        $this->dispatchNow(new BuildItems($this->builder));
    }
}
