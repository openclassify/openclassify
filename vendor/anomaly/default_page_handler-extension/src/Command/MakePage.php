<?php namespace Anomaly\DefaultPageHandlerExtension\Command;

use Anomaly\PagesModule\Page\Contract\PageInterface;
use Anomaly\PagesModule\Page\PageAuthorizer;
use Anomaly\PagesModule\Page\PageBreadcrumb;
use Anomaly\PagesModule\Page\PageContent;
use Anomaly\PagesModule\Page\PageLoader;
use Anomaly\PagesModule\Page\PageResponse;


/**
 * Class MakePage
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class MakePage
{

    /**
     * The page instance.
     *
     * @var PageInterface
     */
    protected $page;

    /**
     * Create a new MakePage instance.
     *
     * @param PageInterface $page
     */
    public function __construct(PageInterface $page)
    {
        $this->page = $page;
    }

    /**
     * Handle the command.
     *
     * @param PageLoader     $loader
     * @param PageContent    $content
     * @param PageResponse   $response
     * @param PageAuthorizer $authorizer
     * @param PageBreadcrumb $breadcrumb
     */
    public function handle(
        PageLoader $loader,
        PageContent $content,
        PageResponse $response,
        PageAuthorizer $authorizer,
        PageBreadcrumb $breadcrumb
    ) {
        $authorizer->authorize($this->page);
        $breadcrumb->make($this->page);
        $loader->load($this->page);

        $content->make($this->page);
        $response->make($this->page);
    }
}
