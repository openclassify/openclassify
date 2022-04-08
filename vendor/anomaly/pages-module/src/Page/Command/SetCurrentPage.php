<?php namespace Anomaly\PagesModule\Page\Command;

use Anomaly\PagesModule\Page\Contract\PageInterface;
use Anomaly\PagesModule\Page\PageCollection;
use Anomaly\Streams\Platform\View\ViewTemplate;


/**
 * Class SetCurrentPage
 *
 * @page          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class SetCurrentPage
{

    /**
     * The page collection.
     *
     * @var PageCollection
     */
    protected $pages;

    /**
     * Create a new SetCurrentPage instance.
     *
     * @param PageCollection $pages
     */
    public function __construct(PageCollection $pages)
    {
        $this->pages = $pages;
    }

    /**
     * Handle the command.
     */
    public function handle(ViewTemplate $template)
    {
        /* @var PageInterface $page */
        if (!$page = $template->get('page')) {
            return;
        }

        /* @var PageInterface $current */
        if ($current = $this->pages->find($page->getId())) {
            $current->setCurrent(true);
        }
    }
}
