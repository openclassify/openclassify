<?php namespace Anomaly\FilesModule\Disk\Adapter;

use Anomaly\FilesModule\Disk\Adapter\Contract\AdapterInterface;
use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Anomaly\Streams\Platform\Addon\Extension\Extension;

/**
 * Class AdapterExtension
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class AdapterExtension extends Extension implements AdapterInterface
{

    /**
     * Load the disk.
     *
     * @param DiskInterface $disk
     */
    public function load(DiskInterface $disk)
    {
        throw new \Exception('Your adapter must implement the load method.');
    }
}
