<?php namespace Anomaly\Streams\Platform\Assignment\Event;

use Anomaly\Streams\Platform\Assignment\Contract\AssignmentInterface;

/**
 * Class AssignmentWasSaved
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class AssignmentWasSaved
{

    /**
     * The assignment interface.
     *
     * @var AssignmentInterface
     */
    protected $assignment;

    /**
     * Create a new AssignmentWasSaved instance.
     *
     * @param AssignmentInterface $assignment
     */
    public function __construct(AssignmentInterface $assignment)
    {
        $this->assignment = $assignment;
    }

    /**
     * Get the assignment interface.
     *
     * @return \Anomaly\Streams\Platform\Assignment\Contract\AssignmentInterface
     */
    public function getAssignment()
    {
        return $this->assignment;
    }
}
