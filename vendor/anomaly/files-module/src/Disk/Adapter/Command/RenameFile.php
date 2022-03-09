<?php namespace Anomaly\FilesModule\Disk\Adapter\Command;

use Anomaly\FilesModule\Disk\Adapter\AdapterFilesystem;
use Anomaly\FilesModule\File\Contract\FileInterface;
use Anomaly\FilesModule\File\Contract\FileRepositoryInterface;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use Anomaly\Streams\Platform\Model\EloquentModel;
use League\Flysystem\File;

/**
 * Class RenameFile
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class RenameFile
{

    /**
     * The file instance.
     *
     * @var File
     */
    protected $file;

    /**
     * The old file name.
     *
     * @var string
     */
    protected $from;

    /**
     * Create a new RenameFile instance.
     *
     * @param File $file
     */
    function __construct(File $file, $from)
    {
        $this->file = $file;
        $this->from = $from;
    }

    /**
     * Handle the command.
     *
     * @param FileRepositoryInterface $files
     * @param FolderRepositoryInterface $folders
     */
    public function handle(FileRepositoryInterface $files, FolderRepositoryInterface $folders)
    {
        /* @var FileInterface|EloquentModel $file */
        $folder = $folders->findBySlug(dirname($this->file->getPath()));
        $file   = $files->findByNameAndFolder(basename($this->from), $folder);

        return $file ? $files->save($file->setAttribute('name', basename($this->file->getPath()))) : false;
    }
}
