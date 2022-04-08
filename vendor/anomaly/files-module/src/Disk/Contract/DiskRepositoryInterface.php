<?php namespace Anomaly\FilesModule\Disk\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;

/**
 * Interface DiskRepositoryInterface
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
interface DiskRepositoryInterface extends EntryRepositoryInterface
{

    /**
     * Find a disk by slug.
     *
     * @param $slug
     * @return null|DiskInterface
     */
    public function findBySlug($slug);
}
