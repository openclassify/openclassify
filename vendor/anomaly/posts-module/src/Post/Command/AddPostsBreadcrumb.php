<?php namespace Anomaly\PostsModule\Post\Command;

use Anomaly\Streams\Platform\Routing\UrlGenerator;
use Anomaly\Streams\Platform\Ui\Breadcrumb\BreadcrumbCollection;

/**
 * Class AddPostsBreadcrumb
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class AddPostsBreadcrumb
{

    /**
     * Handle the command.
     *
     * @param BreadcrumbCollection $breadcrumbs
     * @param UrlGenerator         $url
     */
    public function handle(BreadcrumbCollection $breadcrumbs, UrlGenerator $url)
    {
        $breadcrumbs->add(
            'anomaly.module.posts::breadcrumb.posts',
            $url->route('anomaly.module.posts::posts.index')
        );
    }
}
