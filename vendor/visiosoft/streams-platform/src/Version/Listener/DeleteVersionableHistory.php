<?php namespace Anomaly\Streams\Platform\Version\Listener;

use Anomaly\Streams\Platform\Stream\Event\StreamIsDeleting;
use Anomaly\Streams\Platform\Version\Contract\VersionRepositoryInterface;

/**
 * Class DeleteVersionableHistory
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class DeleteVersionableHistory
{

    /**
     * The versions repository.
     *
     * @var VersionRepositoryInterface
     */
    protected $versions;

    /**
     * Create a new DeleteVersionableHistory instance.
     *
     * @param VersionRepositoryInterface $versions
     */
    public function __construct(VersionRepositoryInterface $versions)
    {
        $this->versions = $versions;
    }

    /**
     * Handle the event.
     *
     * @param StreamIsDeleting $event
     */
    public function handle(StreamIsDeleting $event)
    {
        $stream = $event->getStream();

        $this->versions->deleteVersionHistory($stream->getBoundEntryModelName());
    }
}
