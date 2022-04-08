<?php namespace Anomaly\FilesModule\File\Command;

use Anomaly\FilesModule\File\Contract\FileInterface;
use League\Flysystem\File;
use League\Flysystem\MountManager;

/**
 * Class GetResource
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class GetResource
{

    /**
     * The file instance.
     *
     * @var FileInterface
     */
    protected $file;

    /**
     * Create a new GetResource instance.
     *
     * @param FileInterface $file
     */
    public function __construct(FileInterface $file)
    {
        $this->file = $file;
    }

    /**
     * Handle the command.
     *
     * @param  MountManager $manager
     * @return File
     */
    public function handle(MountManager $manager)
    {
        try {
            return $manager->get($this->file->location());
        } catch (\Exception $e) {
            return null;
        }
    }
}
