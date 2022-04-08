<?php namespace Anomaly\FilesModule\File\Command;

use Anomaly\FilesModule\File\Contract\FileInterface;
use Anomaly\FilesModule\File\Contract\FileRepositoryInterface;


/**
 * Class DeleteResource
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class DeleteResource
{

    /**
     * The file instance.
     *
     * @var FileInterface
     */
    protected $file;

    /**
     * Create a new GetResource instance.
     *
     * @param FileInterface $file
     */
    public function __construct(FileInterface $file)
    {
        $this->file = $file;
    }

    /**
     * Handle the command.
     *
     * @param FileRepositoryInterface $files
     */
    public function handle(FileRepositoryInterface $files)
    {
        if (!$this->file->isForceDeleting()) {
            return;
        }

        if ($files->findByNameAndFolder($this->file->getName(), $this->file->getFolder())) {
            return;
        }

        if (!$resource = $this->file->resource()) {
            return;
        }

        $resource->delete();
    }
}
