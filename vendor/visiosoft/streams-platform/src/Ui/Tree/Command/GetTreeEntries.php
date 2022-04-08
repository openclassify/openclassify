<?php namespace Anomaly\Streams\Platform\Ui\Tree\Command;

use Anomaly\Streams\Platform\Ui\Tree\Contract\TreeRepositoryInterface;
use Anomaly\Streams\Platform\Ui\Tree\TreeBuilder;

/**
 * Class GetTreeEntries
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class GetTreeEntries
{

    /**
     * The tree builder.
     *
     * @var \Anomaly\Streams\Platform\Ui\Tree\TreeBuilder
     */
    protected $builder;

    /**
     * Create a new BuildTreeSegmentsCommand instance.
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
        $model = $this->builder->getModel();

        /*
         * If the builder has an entries handler
         * then call it through the container and
         * let it load the entries itself.
         */
        if ($handler = $this->builder->getTreeOption('entries')) {
            app()->call($handler, ['builder' => $this->builder]);

            return;
        }

        $entries = $this->builder->getTreeEntries();

        /*
         * If the entries have already been set on the
         * tree then return. Nothing to do here.
         *
         * If the model is not set then they need
         * to load the tree entries themselves.
         */
        if (!$entries->isEmpty() || !$model) {
            return;
        }

        /*
         * Resolve the model out of the container.
         */
        $repository = $this->builder->getTreeRepository();

        /*
         * If the repository is an instance of
         * TreeRepositoryInterface use it.
         */
        if ($repository instanceof TreeRepositoryInterface) {
            $this->builder->setTreeEntries($repository->get($this->builder));
        }
    }
}
