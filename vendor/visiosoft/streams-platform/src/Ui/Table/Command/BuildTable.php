<?php namespace Anomaly\Streams\Platform\Ui\Table\Command;

use Anomaly\Streams\Platform\Ui\Table\Component\Action\Command\BuildActions;
use Anomaly\Streams\Platform\Ui\Table\Component\Action\Command\SetActiveAction;
use Anomaly\Streams\Platform\Ui\Table\Component\Filter\Command\BuildFilters;
use Anomaly\Streams\Platform\Ui\Table\Component\Filter\Command\SetActiveFilters;
use Anomaly\Streams\Platform\Ui\Table\Component\Header\Command\BuildHeaders;
use Anomaly\Streams\Platform\Ui\Table\Component\Row\Command\BuildRows;
use Anomaly\Streams\Platform\Ui\Table\Component\View\Command\BuildViews;
use Anomaly\Streams\Platform\Ui\Table\Component\View\Command\SetActiveView;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class BuildTable
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class BuildTable
{

    use DispatchesJobs;

    /**
     * The table builder.
     *
     * @var TableBuilder
     */
    protected $builder;

    /**
     * Create a new BuildTableColumnsCommand instance.
     *
     * @param TableBuilder $builder
     */
    public function __construct(TableBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command.
     */
    public function handle()
    {
        /*
         * Resolve and set the table model and stream.
         */
        $this->dispatchNow(new SetTableModel($this->builder));
        $this->dispatchNow(new SetTableStream($this->builder));
        $this->dispatchNow(new SetDefaultParameters($this->builder));
        $this->dispatchNow(new SetRepository($this->builder));

        /*
         * Build table views and mark active.
         */
        $this->dispatchNow(new BuildViews($this->builder));
        $this->dispatchNow(new SetActiveView($this->builder));

        /**
         * Set the table options going forward.
         */
        $this->dispatchNow(new SetTableOptions($this->builder));
        $this->dispatchNow(new SetDefaultOptions($this->builder));
        $this->dispatchNow(new SaveTableState($this->builder));

        /*
         * Before we go any further, authorize the request.
         */
        $this->dispatchNow(new AuthorizeTable($this->builder));

        /*
         * Build table filters and flag active.
         */
        $this->dispatchNow(new BuildFilters($this->builder));
        $this->dispatchNow(new SetActiveFilters($this->builder));

        /*
         * Build table actions and flag active.
         */
        $this->dispatchNow(new BuildActions($this->builder));
        $this->dispatchNow(new SetActiveAction($this->builder));

        /*
         * Build table headers.
         */
        $this->dispatchNow(new BuildHeaders($this->builder));
        $this->dispatchNow(new EagerLoadRelations($this->builder));

        /*
         * Get table entries.
         */
        $this->dispatchNow(new GetTableEntries($this->builder));

        /*
         * Lastly table rows.
         */
        $this->dispatchNow(new BuildRows($this->builder));
    }
}
