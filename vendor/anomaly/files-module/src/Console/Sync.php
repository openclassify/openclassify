<?php namespace Anomaly\FilesModule\Console;

use Anomaly\FilesModule\File\Contract\FileRepositoryInterface;
use Anomaly\FilesModule\File\FileSynchronizer;
use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use Anomaly\FilesModule\Folder\Contract\FolderRepositoryInterface;
use Illuminate\Console\Command;
use League\Flysystem\File;
use League\Flysystem\MountManager;

/**
 * Class Sync
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class Sync extends Command
{

    /**
     * The command name.
     *
     * @var string
     */
    protected $name = 'files:sync';

    /**
     * The command description.
     *
     * @var string
     */
    protected $description = 'Sync missing files from the filesystem into the database.';

    /**
     * Handle the command.
     *
     * @param MountManager $manager
     * @param FileSynchronizer $synchronizer
     * @param FolderRepositoryInterface $folders
     * @param FileRepositoryInterface $files
     */
    public function handle(
        MountManager $manager,
        FileSynchronizer $synchronizer,
        FolderRepositoryInterface $folders,
        FileRepositoryInterface $files
    ) {
        /* @var FolderInterface $folder */
        foreach ($folders->all() as $folder) {

            $contents = array_filter(
                $manager->listContents($folder->path()),
                function (array $file) {
                    return $file['type'] == 'file';
                }
            );

            $this->info('Checking:' . $folder->path());

            foreach ($contents as $file) {
                if (!$files->findByNameAndFolder($file['basename'], $folder)) {

                    /* @var File $resource */
                    $resource = $manager->get($path = $folder->path($file['basename']));

                    $synchronizer->sync($resource, $folder->getDisk());

                    $this->info('Synced: ' . $path);
                }
            }
        }
    }
}
