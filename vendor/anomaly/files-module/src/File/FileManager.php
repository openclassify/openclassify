<?php namespace Anomaly\FilesModule\File;

use Anomaly\FilesModule\Disk\Adapter\Command\MoveFile;
use League\Flysystem\MountManager;

/**
 * Class FileManager
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class FileManager
{

    /**
     * The mount manager.
     *
     * @var MountManager
     */
    protected $manager;

    /**
     * Create a new FileManager instance.
     *
     * @param MountManager $manager
     */
    public function __construct(MountManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Move a file.
     *
     * @return bool
     */
    public function move($from, $to)
    {
        $result = $this->manager->put($to, $contents = $this->manager->read($from), ['sync' => false]);

        if ($result && $this->manager->has($to)) {
            $result = dispatch_now(new MoveFile($from, $to));
        }

        $this->manager->delete($from);

        return $result;
    }
}
