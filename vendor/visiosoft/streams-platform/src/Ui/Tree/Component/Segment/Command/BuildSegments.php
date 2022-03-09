<?php namespace Anomaly\Streams\Platform\Ui\Tree\Component\Segment\Command;

use Anomaly\Streams\Platform\Ui\Tree\TreeBuilder;

/**
 * Class BuildSegments
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class BuildSegments
{

    /**
     * The tree builder.
     *
     * @var TreeBuilder
     */
    protected $builder;

    /**
     * Create a new BuildSegments instance.
     *
     * @param TreeBuilder $builder
     */
    public function __construct(TreeBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Get the tree builder.
     *
     * @return TreeBuilder
     */
    public function getBuilder()
    {
        return $this->builder;
    }
}
