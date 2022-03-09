<?php namespace Anomaly\FilesModule\Folder\Command;

use Anomaly\FilesModule\Folder\Contract\FolderInterface;

/**
 * Class SetStrId
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class SetStrId
{

    /**
     * The folder instance.
     *
     * @var FolderInterface
     */
    protected $folder;

    /**
     * Create a new SetStrId instance.
     *
     * @param FolderInterface $folder
     */
    public function __construct(FolderInterface $folder)
    {
        $this->folder = $folder;
    }

    /**
     * Handle the command.
     */
    public function handle()
    {
        if (!$this->folder->getStrId()) {
            $this->folder->setRawAttribute('str_id', str_random(24));
        }
    }
}
