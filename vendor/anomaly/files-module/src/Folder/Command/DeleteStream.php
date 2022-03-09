<?php namespace Anomaly\FilesModule\Folder\Command;

use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamRepositoryInterface;


/**
 * Class DeleteStream
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class DeleteStream
{

    /**
     * The file folder instance.
     *
     * @var FolderInterface
     */
    protected $folder;

    /**
     * Create a new DeleteStream instance.
     *
     * @param FolderInterface $folder
     */
    public function __construct(FolderInterface $folder)
    {
        $this->folder = $folder;
    }

    /**
     * Handle the command.
     *
     * @param StreamRepositoryInterface $streams
     */
    public function handle(StreamRepositoryInterface $streams)
    {
        if (!$this->folder->isForceDeleting()) {
            return;
        }

        if (!$stream = $streams->findBySlugAndNamespace($this->folder->getSlug(), 'files')) {
            return;
        }

        $streams->delete($stream);
    }
}
