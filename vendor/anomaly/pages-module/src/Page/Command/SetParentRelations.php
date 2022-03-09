<?php namespace Anomaly\PagesModule\Page\Command;

use Anomaly\PagesModule\Page\Contract\PageInterface;
use Anomaly\PagesModule\Page\PageCollection;
use Anomaly\Streams\Platform\Model\EloquentModel;


/**
 * Class SetParentRelations
 *
 * @page          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class SetParentRelations
{

    /**
     * The page collection.
     *
     * @var PageCollection
     */
    protected $pages;

    /**
     * Create a new SetParentRelations instance.
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

            /* @var PageInterface $parent */
            if (($id = $page->getParentId()) && $parent = $this->pages->find($id)) {
                $page->setRelation('parent', $parent);
            }
        }
    }
}
