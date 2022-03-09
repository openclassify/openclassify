<?php namespace Anomaly\FilesModule\Folder;

use Anomaly\FilesModule\Folder\Contract\FolderInterface;
use Anomaly\Streams\Platform\Entry\EntryPresenter;

/**
 * Class FolderPresenter
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class FolderPresenter extends EntryPresenter
{

    /**
     * The decorated object.
     * This is for IDE support.
     *
     * @var FolderInterface
     */
    protected $object;

}
