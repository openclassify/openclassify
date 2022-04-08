<?php namespace Anomaly\FilesModule\File\Contract;

use Anomaly\FilesModule\Disk\Adapter\AdapterFilesystem;
use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Image\Image;
use League\Flysystem\File;

/**
 * Interface FileInterface
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
interface FileInterface extends EntryInterface
{

    /**
     * Return the file type.
     *
     * @return string
     */
    public function type();

    /**
     * Return the file path.
     *
     * @return string
     */
    public function path();

    /**
     * Return the file location.
     *
     * @return string
     */
    public function location();

    /**
     * Return the filename.
     *
     * @return string
     */
    public function filename();

    /**
     * Return an Image instance.
     *
     * @return Image
     */
    public function image();

    /**
     * Return an Image instance.
     *
     * @return Image
     */
    public function make();

    /**
     * Return the file resource.
     *
     * @return File
     */
    public function resource();

    /**
     * Return the resource filesystem.
     *
     * @return AdapterFilesystem
     */
    public function filesystem();

    /**
     * Return the filesystem URL.
     *
     * @return string
     */
    public function url();

    /**
     * Get the string ID.
     *
     * @return string
     */
    public function getStrId();

    /**
     * Get the alt text.
     *
     * @return string
     */
    public function getAltText();

    /**
     * Return the alt text or default.
     *
     * @return string
     */
    public function altText($default = null);

    /**
     * Return if the image can
     * be previewed or not.
     *
     * @return boolean
     */
    public function canPreview();

    /**
     * Return the file's primary mime type.
     *
     * @return string
     */
    public function primaryMimeType();

    /**
     * Return the file's sub mime type.
     *
     * @return string
     */
    public function secondaryMimeType();

    /**
     * Get the name.
     *
     * @return string
     */
    public function getName();

    /**
     * Get the related disk.
     *
     * @return DiskInterface
     */
    public function getDisk();

    /**
     * Get the related disk's slug.
     *
     * @return string
     */
    public function getDiskSlug();

    /**
     * Get the size.
     *
     * @return int
     */
    public function getSize();

    /**
     * Get the width.
     *
     * @return null|int
     */
    public function getWidth();

    /**
     * Get the height.
     *
     * @return null|int
     */
    public function getHeight();

    /**
     * Get the related folder.
     *
     * @return null|FolderInterface
     */
    public function getFolder();

    /**
     * Get the mime type.
     *
     * @return string
     */
    public function getMimeType();

    /**
     * Get the extension.
     *
     * @return string
     */
    public function getExtension();

    /**
     * Get the keywords.
     *
     * @return array
     */
    public function getKeywords();

    /**
     * Get the description.
     *
     * @return string
     */
    public function getDescription();

    /**
     * Get the related entry.
     *
     * @return EntryInterface
     */
    public function getEntry();
}
