<?php namespace Anomaly\FilesModule\Disk\Contract;

use Anomaly\FilesModule\Disk\Adapter\AdapterFilesystem;
use Anomaly\FilesModule\Disk\Adapter\Contract\AdapterInterface;
use Anomaly\FilesModule\Folder\FolderCollection;
use Anomaly\Streams\Platform\Addon\Extension\Extension;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Interface DiskInterface
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
interface DiskInterface extends EntryInterface
{

    /**
     * Return the disk path.
     *
     * @param null $path
     * @return string
     */
    public function path($path = null);

    /**
     * Return the disk's filesystem.
     *
     * @return AdapterFilesystem
     */
    public function filesystem();

    /**
     * Get the name.
     *
     * @return string
     */
    public function getName();

    /**
     * Get the slug.
     *
     * @return string
     */
    public function getSlug();

    /**
     * Get the adapter.
     *
     * @return AdapterInterface|Extension
     */
    public function getAdapter();

    /**
     * Get related folders.
     *
     * @return FolderCollection
     */
    public function getFolders();

    /**
     * Return the folders relation.
     *
     * @return HasMany
     */
    public function folders();
}
