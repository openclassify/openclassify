<?php namespace Anomaly\Streams\Platform\Ui\Grid\Command;

use Anomaly\Streams\Platform\Ui\Grid\Contract\GridRepositoryInterface;
use Anomaly\Streams\Platform\Ui\Grid\GridBuilder;

/**
 * Class GetGridEntries
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class GetGridEntries
{

    /**
     * The grid builder.
     *
     * @var \Anomaly\Streams\Platform\Ui\Grid\GridBuilder
     */
    protected $builder;

    /**
     * Create a new BuildGridColumnsCommand instance.
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
        $grid  = $this->builder->getGrid();
        $model = $this->builder->getModel();

        /*
         * If the builder has an entries handler
         * then call it through the container and
         * let it load the entries itself.
         */
        if ($handler = $grid->getOption('entries')) {
            app()->call($handler, ['builder' => $this->builder]);

            return;
        }

        $entries = $grid->getEntries();

        /*
         * If the entries have already been set on the
         * grid then return. Nothing to do here.
         *
         * If the model is not set then they need
         * to load the grid entries themselves.
         */
        if (!$entries->isEmpty() || !$model) {
            return;
        }

        /*
         * Resolve the model out of the container.
         */
        $repository = $grid->getRepository();

        /*
         * If the repository is an instance of
         * GridRepositoryInterface use it.
         */
        if ($repository instanceof GridRepositoryInterface) {
            $grid->setEntries($repository->get($this->builder));
        }
    }
}
