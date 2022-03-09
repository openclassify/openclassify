<?php namespace Anomaly\FilesModule\File\Contract;

use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;

/**
 * Interface FileRepositoryInterface
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
interface FileRepositoryInterface extends EntryRepositoryInterface
{

    /**
     * Find a file by it's name and folder.
     *
     * @param                     $name
     * @param  FolderInterface    $folder
     * @return null|FileInterface
     */
    public function findByNameAndFolder($name, FolderInterface $folder);
}
