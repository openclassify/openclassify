<?php namespace Anomaly\Streams\Platform\Ui\Tree\Component\Segment\Command;

use Anomaly\Streams\Platform\Ui\Tree\Component\Segment\Command\GetSegmentValue;
use Anomaly\Streams\Platform\Ui\Tree\Component\Segment\SegmentValue;

/**
 * Class GetSegmentValueHandler
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class GetSegmentValueHandler
{

    /**
     * The value utility.
     *
     * @var \Anomaly\Streams\Platform\Ui\Tree\Component\Segment\SegmentValue
     */
    protected $value;

    /**
     * Create a new GetSegmentValueHandler instance.
     *
     * @param SegmentValue $value
     */
    public function __construct(SegmentValue $value)
    {
        $this->value = $value;
    }

    /**
     * Handle the command.
     *
     * @param  GetSegmentValue $command
     * @return mixed
     */
    public function handle(GetSegmentValue $command)
    {
        $entry   = $command->getEntry();
        $tree    = $command->getTree();
        $segment = $command->getSegment();

        return $this->value->make($tree, $segment, $entry);
    }
}
