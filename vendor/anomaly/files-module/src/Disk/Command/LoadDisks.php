<?php namespace Anomaly\FilesModule\Disk\Command;

use Anomaly\FilesModule\Disk\Adapter\Contract\AdapterInterface;
use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Anomaly\FilesModule\Disk\Contract\DiskRepositoryInterface;

/**
 * Class LoadDisks
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class LoadDisks
{

    /**
     * Handle the event.
     */
    public function handle(DiskRepositoryInterface $disks)
    {
        /* @var DiskInterface $disk */
        foreach ($disks->all() as $disk) {

            /* @var AdapterInterface $adapter */
            $adapter = $disk->getAdapter();

            $adapter->load($disk);
        }
    }
}
