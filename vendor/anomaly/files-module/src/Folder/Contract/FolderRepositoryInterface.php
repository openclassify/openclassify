<?php namespace Anomaly\FilesModule\Folder\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;

/**
 * Interface FolderRepositoryInterface
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
interface FolderRepositoryInterface extends EntryRepositoryInterface
{

    /**
     * Find a folder by it's slug.
     *
     * @param $slug
     * @return null|FolderInterface
     */
    public function findBySlug($slug);
}
