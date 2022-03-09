<?php namespace Anomaly\FilesModule\Disk\Adapter\Command;

use Anomaly\FilesModule\Disk\Adapter\AdapterFilesystem;
use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use Anomaly\FilesModule\Folder\FolderSynchronizer;
use League\Flysystem\Directory;

/**
 * Class SyncFolder
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class SyncFolder
{

    /**
     * The directory instance.
     *
     * @var Directory
     */
    protected $directory;

    /**
     * Create a new SyncFolder instance.
     *
     * @param Directory $directory
     */
    function __construct(Directory $directory)
    {
        $this->directory = $directory;
    }

    /**
     * Handle the command.
     *
     * @param  FolderSynchronizer $synchronizer
     * @return null|FolderInterface
     */
    public function handle(FolderSynchronizer $synchronizer)
    {
        return $synchronizer->sync($this->directory, $this->getFilesystemDisk());
    }

    /**
     * Get the filesystem's disk.
     *
     * @return \Anomaly\FilesModule\Disk\Contract\DiskInterface|null
     */
    protected function getFilesystemDisk()
    {
        $filesystem = $this->directory->getFilesystem();

        if ($filesystem instanceof AdapterFilesystem) {
            return $filesystem->getDisk();
        }

        return null;
    }
}
