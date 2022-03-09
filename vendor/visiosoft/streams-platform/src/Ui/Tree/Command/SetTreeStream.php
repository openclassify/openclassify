<?php namespace Anomaly\Streams\Platform\Ui\Tree\Command;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Ui\Tree\TreeBuilder;

/**
 * Class SetTreeStream
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class SetTreeStream
{

    /**
     * The tree builder.
     *
     * @var TreeBuilder
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
        $tree  = $this->builder->getTree();
        $model = $this->builder->getModel();

        if (is_string($model) && !class_exists($model)) {
            return;
        }

        if (is_string($model)) {
            $model = app($model);
        }

        if ($model instanceof EntryInterface) {
            $tree->setStream($model->getStream());
        }
    }
}
