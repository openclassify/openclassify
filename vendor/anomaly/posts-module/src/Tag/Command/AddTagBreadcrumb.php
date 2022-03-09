<?php namespace Anomaly\PostsModule\Tag\Command;

use Anomaly\Streams\Platform\Ui\Breadcrumb\BreadcrumbCollection;
use Illuminate\Http\Request;

/**
 * Class AddTagBreadcrumb
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class AddTagBreadcrumb
{

    /**
     * The tag string.
     *
     * @var string
     */
    protected $tag;

    /**
     * Create a new AddTagBreadcrumb instance.
     *
     * @param string $tag
     */
    public function __construct($tag)
    {
        $this->tag = $tag;
    }

    /**
     * Handle the command.
     *
     * @param Request              $request
     * @param BreadcrumbCollection $breadcrumbs
     */
    public function handle(Request $request, BreadcrumbCollection $breadcrumbs)
    {
        $breadcrumbs->add(
            trans('anomaly.module.posts::breadcrumb.tagged', ['tag' => $this->tag]),
            $request->fullUrl()
        );
    }
}
