<?php namespace Anomaly\Streams\Platform\Stream\Command;

use Anomaly\Streams\Platform\Assignment\Contract\AssignmentRepositoryInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;

/**
 * Class DeleteStreamAssignments
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class DeleteStreamAssignments
{

    /**
     * The stream instance.
     *
     * @var StreamInterface
     */
    protected $stream;

    /**
     * Create a new DeleteStreamAssignments instance.
     *
     * @param StreamInterface $stream
     */
    public function __construct(StreamInterface $stream)
    {
        $this->stream = $stream;
    }

    /**
     * Handle the command.
     *
     * @param AssignmentRepositoryInterface $assignments
     */
    public function handle(AssignmentRepositoryInterface $assignments)
    {
        foreach ($this->stream->getAssignments() as $assignment) {
            $assignments->delete($assignment);
        }
    }
}
