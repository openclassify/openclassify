<?php namespace Anomaly\PrivateStorageAdapterExtension;

use Anomaly\FilesModule\Disk\Adapter\AdapterExtension;
use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Anomaly\PrivateStorageAdapterExtension\Command\LoadDisk;

/**
 * Class PrivateStorageAdapterExtension
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class PrivateStorageAdapterExtension extends AdapterExtension
{

    /**
     * This module provides the local
     * storage adapter for the files module.
     *
     * @var string
     */
    protected $provides = 'anomaly.module.files::adapter.private';

    /**
     * Load the disk.
     *
     * @param DiskInterface $disk
     */
    public function load(DiskInterface $disk)
    {
        $this->dispatch(new LoadDisk($disk));
    }

}
