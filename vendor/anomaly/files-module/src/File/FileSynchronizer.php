<?php namespace Anomaly\FilesModule\File;

use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Anomaly\FilesModule\File\Contract\FileInterface;
use Anomaly\FilesModule\File\Contract\FileRepositoryInterface;
use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use League\Flysystem\File;

/**
 * Class FileSynchronizer
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class FileSynchronizer
{

    /**
     * The files repository.
     *
     * @var FileRepositoryInterface
     */
    protected $files;

    /**
     * The folder repository.
     *
     * @var FolderRepositoryInterface
     */
    protected $folders;

    /**
     * Create a new FileSynchronizer instance.
     *
     * @param FileRepositoryInterface   $files
     * @param FolderRepositoryInterface $folders
     */
    function __construct(FileRepositoryInterface $files, FolderRepositoryInterface $folders)
    {
        $this->files   = $files;
        $this->folders = $folders;
    }

    /**
     * Sync a file.
     *
     * @param  File          $resource
     * @param  DiskInterface $disk
     * @return null|FileInterface
     */
    public function sync(File $resource, DiskInterface $disk)
    {
        $folder = $this->syncFolder($resource, $disk);

        if (!$file = $this->files->findByNameAndFolder(basename($resource->getPath()), $folder)) {
            $file = $this->files->create(
                [
                    'name'       => basename($resource->getPath()),
                    'folder_id'  => $folder ? $folder->getId() : null,
                    'disk_id'    => $disk->getId(),
                    'size'       => $resource->getSize(),
                    'mime_type'  => $resource->getMimetype(),
                    'extension'  => pathinfo($resource->getPath(), PATHINFO_EXTENSION),
                    'entry_type' => $folder->getEntryModelName(),
                    'deleted_at' => null,
                ]
            );
        } else {

            $file->setAttribute('size', $resource->getSize());

            if ($file->trashed()) {
                $this->files->restore($file);
            }

            $this->files->save($file);
        }

        return $file;
    }

    /**
     * Sync the files folder.
     *
     * @param  File          $resource
     * @param  DiskInterface $disk
     * @return null|FolderInterface
     */
    protected function syncFolder(File $resource, DiskInterface $disk)
    {
        $path = dirname($resource->getPath());

        if ($path === '.') {
            return null;
        }

        foreach (explode('/', $path) as $name) {
            if (!$folder = $this->folders->findBySlug($name)) {
                $folder = $this->folders->create(
                    [
                        'name'      => $name,
                        'disk_id'   => $disk->getId(),
                    ]
                );
            }
        }

        return isset($folder) ? $folder : null;
    }
}
