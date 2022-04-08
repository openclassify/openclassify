<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\View\Command;

use Anomaly\Streams\Platform\Ui\Table\Component\View\ViewHandler;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;
use Illuminate\Contracts\Container\Container;
use Illuminate\Http\Request;

/**
 * Class SetActiveView
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class SetActiveView
{

    /**
     * The table builder.
     *
     * @var TableBuilder
     */
    protected $builder;

    /**
     * Create a new BuildTableFiltersCommand instance.
     *
     * @param TableBuilder $builder
     */
    public function __construct(TableBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command.
     *
     * @param Request $request
     * @param Container $container
     */
    public function handle(Request $request, ViewHandler $handler)
    {
        $table   = $this->builder->getTable();
        $options = $table->getOptions();
        $views   = $table->getViews();

        if ($views->active()) {
            return;
        }

        if ($view = $views->findBySlug($request->get($options->get('prefix') . 'view'))) {
            $view->setActive(true);
        }

        if (!$view && $view = $views->first()) {
            $view->setActive(true);
        }

        // Nothing to do.
        if (!$view) {
            return;
        }

        // Set filters from active view.
        if (($filters = $view->getFilters()) !== null) {
            $this->builder->setFilters($filters);
        }

        // Set columns from active view.
        if (($columns = $view->getColumns()) !== null) {
            $this->builder->setColumns($columns);
        }

        // Set buttons from active view.
        if (($buttons = $view->getButtons()) !== null) {
            $this->builder->setButtons($buttons);
        }

        // Set actions from active view.
        if (($actions = $view->getActions()) !== null) {
            $this->builder->setActions($actions);
        }

        // Set options from active view.
        if (($options = $view->getOptions()) !== null) {
            $this->builder->setOptions($options);
        }

        // Set entries from active view.
        if (($entries = $view->getEntries()) !== null) {
            $this->builder->setEntries($entries);
        }

        $handler->handle($this->builder, $view);
    }
}
