<?php namespace Anomaly\FilesModule\File;

use Anomaly\FilesModule\File\Command\DeleteResource;
use Anomaly\FilesModule\File\Command\SetDimensions;
use Anomaly\FilesModule\File\Command\SetStrId;
use Anomaly\FilesModule\File\Contract\FileInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryObserver;

/**
 * Class FileObserver
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class FileObserver extends EntryObserver
{

    /**
     * Fired just before an entry is created.
     *
     * @param EntryInterface|FileInterface $entry
     */
    public function creating(EntryInterface $entry)
    {
        $this->dispatchNow(new SetStrId($entry));

        parent::creating($entry);
    }

    /**
     * Fired before saving the file.
     *
     * @param  EntryInterface|FileInterface $entry
     * @return bool
     */
    public function saving(EntryInterface $entry)
    {
        /*
         * If the resource exists then
         * make sure to set dimensions.
         */
        if ($entry->resource()) {
            $this->dispatch(new SetDimensions($entry));
        }

        return parent::saving($entry);
    }

    /**
     * Fired before deleting the file.
     *
     * @param EntryInterface|FileInterface $entry
     */
    public function deleting(EntryInterface $entry)
    {
        $this->dispatch(new DeleteResource($entry));

        parent::deleting($entry);
    }
}
