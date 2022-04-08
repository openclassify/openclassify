<?php namespace Anomaly\PostsModule\Post\Command;

use Anomaly\Streams\Platform\Ui\Breadcrumb\BreadcrumbCollection;
use Illuminate\Http\Request;

/**
 * Class AddArchiveBreadcrumb
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class AddArchiveBreadcrumb
{

    /**
     * Handle the command.
     *
     * @param Request              $request
     * @param BreadcrumbCollection $breadcrumbs
     */
    public function handle(Request $request, BreadcrumbCollection $breadcrumbs)
    {
        $breadcrumbs->add(
            trans('module::breadcrumb.archive'),
            $request->fullUrl()
        );
    }
}
