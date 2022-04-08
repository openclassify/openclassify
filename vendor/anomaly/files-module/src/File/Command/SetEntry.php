<?php namespace Anomaly\FilesModule\File\Command;

use Anomaly\FilesModule\File\Contract\FileInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;

class SetEntry
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
     */
    public function handle(EntryRepositoryInterface $repository)
    {
        if (!$this->file->getAttribute('entry_id')) {
            $folder = $file->getFolder();

            $repository->setModel($folder->getEntryModel());
            $entry = $repository->create();

            $this->file->setAttribute();
        }
    }
}
