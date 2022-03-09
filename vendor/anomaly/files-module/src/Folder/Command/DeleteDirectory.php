<?php namespace Anomaly\FilesModule\Folder\Command;

use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use League\Flysystem\MountManager;

/**
 * Class DeleteDirectory
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class DeleteDirectory
{

    /**
     * The folder interface.
     *
     * @var FolderInterface
     */
    protected $folder;

    /**
     * Create a new DeleteDirectory instance.
     *
     * @param FolderInterface $folder
     */
    public function __construct(FolderInterface $folder)
    {
        $this->folder = $folder;
    }

    /**
     * Handle the command.
     *
     * @param MountManager $manager
     */
    public function handle(MountManager $manager)
    {
        if (!$this->folder->isForceDeleting()) {
            return;
        }

        if (!$disk = $this->folder->getDisk()) {
            return;
        }

        if (!$manager->has($disk->getSlug() . '://' . $this->folder->getSlug())) {
            return;
        }

        $manager->deleteDir($disk->getSlug() . '://' . $this->folder->getSlug());
    }
}
