<?php namespace Anomaly\PagesModule\Page;

use Anomaly\PagesModule\Page\Contract\PageInterface;
use Anomaly\Streams\Platform\Entry\EntryRouter;

/**
 * Class PageRouter
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class PageRouter extends EntryRouter
{

    /**
     * The routed entry.
     *
     * @var PageInterface
     */
    protected $entry;

    /**
     * Return the view route.
     *
     * @return string
     */
    public function view()
    {
        return $this->entry->getPath();
    }
}
