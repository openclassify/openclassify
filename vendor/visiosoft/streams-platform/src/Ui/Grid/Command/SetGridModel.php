<?php namespace Anomaly\Streams\Platform\Ui\Grid\Command;

use Anomaly\Streams\Platform\Ui\Grid\GridBuilder;

/**
 * Class SetGridModel
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class SetGridModel
{

    /**
     * The grid builder.
     *
     * @var GridBuilder
     */
    protected $builder;

    /**
     * Create a new SetGridModel instance.
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
         * If the model is already instantiated
         * then use it as is.
         */
        if (is_object($model)) {
            $grid->setModel($model);

            return;
        }

        /*
         * If no model is set, try guessing the
         * model based on best practices.
         */
        if (!$model) {
            $parts = explode('\\', str_replace('GridBuilder', 'Model', get_class($this->builder)));

            unset($parts[count($parts) - 2]);

            $model = implode('\\', $parts);

            $this->builder->setModel($model);
        }

        /*
         * If the model is not set then skip it.
         */
        if (!class_exists($model)) {
            return;
        }

        /*
         * Set the model on the grid!
         */
        $grid->setModel(app($model));
    }
}
