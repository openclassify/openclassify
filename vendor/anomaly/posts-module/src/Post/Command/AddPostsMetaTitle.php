<?php namespace Anomaly\PostsModule\Post\Command;

use Anomaly\Streams\Platform\View\ViewTemplate;
use Illuminate\Translation\Translator;

/**
 * Class AddPostsMetaTitle
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class AddPostsMetaTitle
{

    /**
     * Set the meta title.
     *
     * @param ViewTemplate $template
     * @param Translator   $translator
     */
    public function handle(ViewTemplate $template, Translator $translator)
    {
        $template->set('meta_title', $translator->trans('anomaly.module.posts::breadcrumb.posts'));
    }
}
