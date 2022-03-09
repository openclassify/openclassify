<?php namespace Anomaly\PagesModule\Page;

use Anomaly\PagesModule\Page\Contract\PageInterface;
use Anomaly\Streams\Platform\Ui\Breadcrumb\BreadcrumbCollection;
use Illuminate\Http\Request;

/**
 * Class PageBreadcrumb
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class PageBreadcrumb
{

    /**
     * The request object.
     *
     * @var Request
     */
    protected $request;

    /**
     * The breadcrumb collection.
     *
     * @var BreadcrumbCollection
     */
    protected $breadcrumbs;

    /**
     * Create a new PageBreadcrumb instance.
     *
     * @param Request              $request
     * @param BreadcrumbCollection $breadcrumbs
     */
    public function __construct(Request $request, BreadcrumbCollection $breadcrumbs)
    {
        $this->request     = $request;
        $this->breadcrumbs = $breadcrumbs;
    }

    /**
     * Make the page breadcrumbs.
     *
     * @param PageInterface $page
     */
    public function make(PageInterface $page)
    {
        $breadcrumbs = [
            $page->getTitle() => $this->request->path(),
        ];

        $this->loadParent($page, $breadcrumbs);

        foreach (array_reverse($breadcrumbs) as $key => $url) {
            $this->breadcrumbs->add($key, $url);
        }
    }

    /**
     * Load the parent breadcrumbs.
     *
     * @param PageInterface $page
     * @param array         $breadcrumbs
     */
    protected function loadParent(PageInterface $page, array &$breadcrumbs)
    {
        if ($parent = $page->getParent()) {

            $breadcrumbs[$parent->getTitle()] = $parent->getPath();

            $this->loadParent($parent, $breadcrumbs);
        }
    }
}
