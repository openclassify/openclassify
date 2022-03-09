<?php namespace Anomaly\FilesModule\File;

use Anomaly\FilesModule\File\Contract\FileInterface;
use Anomaly\FilesModule\File\Contract\FileRepositoryInterface;
use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

/**
 * Class FileRepository
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class FileRepository extends EntryRepository implements FileRepositoryInterface
{

    /**
     * The file model.
     *
     * @var FileModel
     */
    protected $model;

    /**
     * Create a new FileRepository instance.
     *
     * @param FileModel $model
     */
    function __construct(FileModel $model)
    {
        $this->model = $model;
    }

    /**
     * Find a file by it's name and folder.
     *
     * @param                     $name
     * @param  FolderInterface    $folder
     * @return null|FileInterface
     */
    public function findByNameAndFolder($name, FolderInterface $folder)
    {
        return $this->model
            ->where('name', FileSanitizer::clean($name))
            ->where('folder_id', $folder->getId())
            ->first();
    }
}
