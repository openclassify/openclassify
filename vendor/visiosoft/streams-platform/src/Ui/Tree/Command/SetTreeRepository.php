<?php namespace Anomaly\Streams\Platform\Ui\Tree\Command;

use Anomaly\Streams\Platform\Ui\Tree\TreeBuilder;

/**
 * Class SetTreeRepository
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class SetTreeRepository
{

    /**
     * The tree builder.
     *
     * @var TreeBuilder
     */
    protected $builder;

    /**
     * Create a new SetTreeRepository instance.
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
        $model = $tree->getModel();

        /*
         * If a repository is set
         * then we don't have
         * anything to do.
         */
        if ($this->builder->getTreeRepository()) {
            return;
        }

        $repository = $tree->getOption('repository');

        /*
         * If there is no repository
         * then skip this step.
         */
        if (!$repository) {
            return;
        }

        /*
         * Set the repository on the form!
         */
        $tree->setRepository(app()->make($repository, compact('model', 'tree')));
    }
}
