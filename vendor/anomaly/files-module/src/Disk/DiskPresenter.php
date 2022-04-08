<?php namespace Anomaly\FilesModule\Disk;

use Anomaly\FilesModule\Disk\Contract\DiskInterface;
use Anomaly\Streams\Platform\Entry\EntryPresenter;

/**
 * Class DiskPresenter
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class DiskPresenter extends EntryPresenter
{

    /**
     * The decorated object.
     * This is for IDE support.
     *
     * @var DiskInterface
     */
    protected $object;

    /**
     * Return the view link.
     *
     * @return string
     */
    public function viewLink()
    {
        return app('html')->link(
            implode(
                '/',
                array_filter(
                    [
                        'admin',
                        'files',
                        'browser',
                        $this->object->getSlug(),
                    ]
                )
            ),
            $this->object->getName()
        );
    }
}
