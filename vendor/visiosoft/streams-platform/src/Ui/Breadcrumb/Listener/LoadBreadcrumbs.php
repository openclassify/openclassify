<?php namespace Anomaly\Streams\Platform\Ui\Breadcrumb\Listener;

use Anomaly\Streams\Platform\Ui\Breadcrumb\BreadcrumbCollection;
use Anomaly\Streams\Platform\View\ViewTemplate;

/**
 * Class LoadBreadcrumbs
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class LoadBreadcrumbs
{

    /**
     * The view template.
     *
     * @var ViewTemplate
     */
    protected $template;

    /**
     * The breadcrumb collection.
     *
     * @var BreadcrumbCollection
     */
    protected $breadcrumbs;

    /**
     * Create a new LoadBreadcrumbs instance.
     *
     * @param ViewTemplate         $template
     * @param BreadcrumbCollection $breadcrumbs
     */
    public function __construct(ViewTemplate $template, BreadcrumbCollection $breadcrumbs)
    {
        $this->template    = $template;
        $this->breadcrumbs = $breadcrumbs;
    }

    /**
     * Handle the event.
     */
    public function handle()
    {
        $this->template->set('breadcrumbs', $this->breadcrumbs);
    }
}
