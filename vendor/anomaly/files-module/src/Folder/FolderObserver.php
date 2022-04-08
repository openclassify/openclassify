<?php namespace Anomaly\FilesModule\Folder;

use Anomaly\FilesModule\Folder\Command\CreateDirectory;
use Anomaly\FilesModule\Folder\Command\CreateStream;
use Anomaly\FilesModule\Folder\Command\DeleteDirectory;
use Anomaly\FilesModule\Folder\Command\DeleteStream;
use Anomaly\FilesModule\Folder\Command\SetStrId;
use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryObserver;

/**
 * Class FolderObserver
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class FolderObserver extends EntryObserver
{

    /**
     * Fired just before an entry is created.
     *
     * @param EntryInterface|FolderInterface $entry
     */
    public function creating(EntryInterface $entry)
    {
        $this->dispatchNow(new SetStrId($entry));

        parent::creating($entry);
    }

    /**
     * Fired just after creating an entry.
     *
     * @param EntryInterface|FolderInterface $entry
     */
    public function created(EntryInterface $entry)
    {
        $this->dispatch(new CreateStream($entry));
        $this->dispatch(new CreateDirectory($entry));

        parent::created($entry);
    }

    /**
     * Fired just before deleting an entry.
     *
     * @param EntryInterface|FolderInterface $entry
     */
    public function deleting(EntryInterface $entry)
    {
        $this->dispatch(new DeleteDirectory($entry));

        parent::deleting($entry);
    }

    /**
     * Fired just after deleting an entry.
     *
     * @param EntryInterface|FolderInterface $entry
     */
    public function deleted(EntryInterface $entry)
    {
        //$this->dispatch(new DeleteStream($entry));

        parent::deleted($entry);
    }
}
