<?php namespace Anomaly\FilesModule\Folder\Contract;

use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Anomaly\FilesModule\File\FileCollection;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Interface FolderInterface
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
interface FolderInterface extends EntryInterface
{

    /**
     * Return the folder path.
     *
     * @param null $path
     * @return string
     */
    public function path($path = null);

    /**
     * Get the string ID.
     *
     * @return string
     */
    public function getStrId();

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
     * Get the related disk.
     *
     * @return DiskInterface
     */
    public function getDisk();

    /**
     * Get related files.
     *
     * @return FileCollection
     */
    public function getFiles();

    /**
     * Get the description.
     *
     * @return string
     */
    public function getDescription();

    /**
     * Get the allowed types.
     *
     * @return array
     */
    public function getAllowedTypes();

    /**
     * Get the related entry stream.
     *
     * @return StreamInterface
     */
    public function getEntryStream();

    /**
     * Get the related entry stream ID.
     *
     * @return int
     */
    public function getEntryStreamId();

    /**
     * Get the related entry model name.
     *
     * @return string
     */
    public function getEntryModelName();

    /**
     * Return the files relation.
     *
     * @return HasMany
     */
    public function files();
}
