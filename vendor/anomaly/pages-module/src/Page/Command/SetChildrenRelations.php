<?php namespace Anomaly\PagesModule\Page\Command;

use Anomaly\PagesModule\Page\Contract\PageInterface;
use Anomaly\PagesModule\Page\PageCollection;
use Anomaly\Streams\Platform\Model\EloquentModel;


/**
 * Class SetChildrenRelations
 *
 * @page          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class SetChildrenRelations
{

    /**
     * The page collection.
     *
     * @var PageCollection
     */
    protected $pages;

    /**
     * Create a new SetChildrenRelations instance.
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
    public function handle()
    {
        /* @var PageInterface|EloquentModel $page */
        foreach ($this->pages as $page) {
            $page->setRelation('children', $this->pages->children($page));
        }
    }
}
