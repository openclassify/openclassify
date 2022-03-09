<?php namespace Anomaly\FilesModule\Folder;

use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Anomaly\FilesModule\File\FileCollection;
use Anomaly\FilesModule\Folder\Command\GetStream;
use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use Anomaly\Streams\Platform\Model\Files\FilesFoldersEntryModel;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class FolderModel
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class FolderModel extends FilesFoldersEntryModel implements FolderInterface
{

    /**
     * Always eager load these.
     *
     * @var array
     */
    protected $with = [
        'translations',
    ];

    /**
     * The cascaded relations.
     *
     * @var array
     */
    protected $cascades = [
        'files',
    ];

    /**
     * Return the folder path.
     *
     * @param null $path
     * @return string
     */
    public function path($path = null)
    {
        $disk = $this->getDisk();

        return $disk->path($this->getSlug() . ($path ? '/' . $path : null));
    }

    /**
     * Get the string ID.
     *
     * @return string
     */
    public function getStrId()
    {
        return $this->str_id;
    }

    /**
     * Get the related disk.
     *
     * @return DiskInterface
     */
    public function getDisk()
    {
        return $this->disk;
    }

    /**
     * Get the slug.
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Get the name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the allowed types attribute.
     *
     * @return array
     */
    public function setAllowedTypesAttribute(array $types)
    {
        $this->setFieldValue('allowed_types', $types);

        return $this->allowed_types = array_map(
            function ($type) {
                return strtolower(preg_replace("/[^A-Za-z0-9 ]/", '', $type));
            },
            $this->getAllowedTypes()
        );
    }

    /**
     * Get the allowed types.
     *
     * @return array
     */
    public function getAllowedTypes()
    {
        return $this->allowed_types;
    }

    /**
     * Get the related entry model name.
     *
     * @return string
     */
    public function getEntryModelName()
    {
        $stream = $this->getEntryStream();

        return $stream->getEntryModelName();
    }

    /**
     * Get the related entry stream.
     *
     * @return StreamInterface
     */
    public function getEntryStream()
    {
        return $this->dispatch(new GetStream($this));
    }

    /**
     * Get the related entry stream ID.
     *
     * @return int
     */
    public function getEntryStreamId()
    {
        if (!$stream = $this->getEntryStream()) {
            return null;
        }

        return $stream->getId();
    }

    /**
     * Get related files.
     *
     * @return FileCollection
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * Return the files relation.
     *
     * @return HasMany
     */
    public function files()
    {
        return $this->hasMany('Anomaly\FilesModule\File\FileModel', 'folder_id');
    }
}
