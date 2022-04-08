<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\Action\Command;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class SetActiveAction
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class SetActiveAction
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
     * Set the active action.
     *
     * @param SetActiveAction $command
     */
    public function handle()
    {
        $prefix  = $this->builder->getTableOption('prefix');
        $actions = $this->builder->getTableActions();

        if ($action = $actions->findBySlug(app('request')->get($prefix . 'action'))) {
            $action->setActive(true);
        }
    }
}
