<?php namespace Anomaly\FilesModule\Folder;

use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use League\Flysystem\Directory;

/**
 * Class FolderSynchronizer
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class FolderSynchronizer
{

    /**
     * The folder repository.
     *
     * @var FolderRepositoryInterface
     */
    protected $folders;

    /**
     * Create a new FolderSynchronizer instance.
     *
     * @param FolderRepositoryInterface $folders
     */
    function __construct(FolderRepositoryInterface $folders)
    {
        $this->folders = $folders;
    }

    /**
     * Sync a file.
     *
     * @param  Directory     $resource
     * @param  DiskInterface $disk
     * @return null|FolderInterface
     */
    public function sync(Directory $resource, DiskInterface $disk)
    {
        $path = $resource->getPath();

        if ($path === '.') {
            return null;
        }

        if (!$folder = $this->folders->findBySlug($path)) {
            $folder = $this->folders->create(
                [
                    'name'    => $path,
                    'disk_id' => $disk->getId(),
                ]
            );
        }

        return $folder;
    }
}
