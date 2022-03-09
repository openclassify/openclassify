<?php namespace Anomaly\Streams\Platform\Ui\Tree\Component\Segment\Command;

use Anomaly\Streams\Platform\Ui\Tree\Component\Segment\Contract\SegmentInterface;
use Anomaly\Streams\Platform\Ui\Tree\Tree;

/**
 * Class GetSegmentValue
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class GetSegmentValue
{

    /**
     * The tree object.
     *
     * @var \Anomaly\Streams\Platform\Ui\Tree\Tree
     */
    protected $tree;

    /**
     * The segment object.
     *
     * @var \Anomaly\Streams\Platform\Ui\Tree\Component\Segment\Contract\SegmentInterface
     */
    protected $segment;

    /**
     * The entry object.
     *
     * @var mixed
     */
    protected $entry;

    /**
     * Create a new GetSegmentValue instance.
     *
     * @param Tree             $tree
     * @param SegmentInterface $segment
     * @param                  $entry
     */
    public function __construct(Tree $tree, SegmentInterface $segment, $entry)
    {
        $this->entry   = $entry;
        $this->tree    = $tree;
        $this->segment = $segment;
    }

    /**
     * Get the segment object.
     *
     * @return SegmentInterface
     */
    public function getSegment()
    {
        return $this->segment;
    }

    /**
     * Get the tree object.
     *
     * @return Tree
     */
    public function getTree()
    {
        return $this->tree;
    }

    /**
     * Get the entry object.
     *
     * @return mixed
     */
    public function getEntry()
    {
        return $this->entry;
    }
}
