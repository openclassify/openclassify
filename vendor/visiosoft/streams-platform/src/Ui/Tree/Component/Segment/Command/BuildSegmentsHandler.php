<?php namespace Anomaly\Streams\Platform\Ui\Tree\Component\Segment\Command;

use Anomaly\Streams\Platform\Ui\Tree\Component\Segment\Command\BuildSegments;
use Anomaly\Streams\Platform\Ui\Tree\Component\Segment\SegmentBuilder;

/**
 * Class BuildSegmentsHandler
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class BuildSegmentsHandler
{

    /**
     * The segment builder.
     *
     * @var \Anomaly\Streams\Platform\Ui\Tree\Component\Segment\SegmentBuilder
     */
    protected $builder;

    /**
     * Create a new BuildSegmentsHandler instance.
     *
     * @param SegmentBuilder $builder
     */
    public function __construct(SegmentBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Build segments and load them to the tree.
     *
     * @param BuildSegments $command
     */
    public function handle(BuildSegments $command)
    {
        $this->builder->build($command->getBuilder());
    }
}
