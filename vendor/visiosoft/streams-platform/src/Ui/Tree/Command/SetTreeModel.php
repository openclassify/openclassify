<?php namespace Anomaly\Streams\Platform\Ui\Tree\Command;

use Anomaly\Streams\Platform\Ui\Tree\TreeBuilder;

/**
 * Class SetTreeModel
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class SetTreeModel
{

    /**
     * The tree builder.
     *
     * @var TreeBuilder
     */
    protected $builder;

    /**
     * Create a new SetTreeModel instance.
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
        $tree  = $this->builder->getTree();
        $model = $this->builder->getModel();

        /*
         * If the model is already instantiated
         * then use it as is.
         */
        if (is_object($model)) {
            $tree->setModel($model);

            return;
        }

        /*
         * If no model is set, try guessing the
         * model based on best practices.
         */
        if (!$model) {
            $parts = explode('\\', str_replace('TreeBuilder', 'Model', get_class($this->builder)));

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
         * Set the model on the tree!
         */
        $tree->setModel(app($model));
    }
}
