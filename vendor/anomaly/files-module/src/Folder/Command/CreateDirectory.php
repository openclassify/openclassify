<?php namespace Anomaly\FilesModule\Folder\Command;

use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use League\Flysystem\MountManager;

/**
 * Class CreateDirectory
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class CreateDirectory
{

    /**
     * The folder interface.
     *
     * @var FolderInterface
     */
    protected $folder;

    /**
     * Create a new CreateDirectory instance.
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
        if (!$disk = $this->folder->getDisk()) {
            return;
        }

        if ($manager->has($disk->getSlug() . '://' . $this->folder->getSlug())) {
            return;
        }

        $manager->createDir($disk->getSlug() . '://' . $this->folder->getSlug());
    }
}
