<?php namespace Anomaly\Streams\Platform\Ui\Tree\Command;

use Anomaly\Streams\Platform\Ui\Tree\TreeBuilder;

/**
 * Class MakeTree
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class MakeTree
{

    /**
     * The tree builder.
     *
     * @var TreeBuilder
     */
    protected $builder;

    /**
     * Create a new MakeTree instance.
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
        $tree = $this->builder->getTree();

        $options = $tree->getOptions();
        $data    = $tree->getData();

        $content = view($options->get('tree_view', 'streams::tree/tree'), $data)->render();

        $tree->setContent($content);
        $tree->addData('content', $content);
    }
}
