<?php namespace Anomaly\FilesModule\File\Command;

use Anomaly\FilesModule\Disk\Adapter\AdapterFilesystem;
use Anomaly\FilesModule\File\Contract\FileInterface;


/**
 * Class SetDimensions
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class SetDimensions
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
     */
    public function handle()
    {
        if (!in_array($this->file->getExtension(), ['jpg', 'jpeg', 'png'])) {
            return;
        }

        $resource = $this->file->resource();

        /* @var AdapterFilesystem $filesystem */
        $filesystem = $resource->getFilesystem();
        $adapter    = $filesystem->getAdapter();

        if (!method_exists($adapter, 'getPathPrefix') || !$prefix = $adapter->getPathPrefix()) {
            return;
        }

        $path = $prefix . $resource->getPath();

        try {
            list($width, $height) = getimagesize($path);
        } catch (\Exception $e) {

            return;
        }

        $this->file->setAttribute('width', $width);
        $this->file->setAttribute('height', $height);
    }
}
