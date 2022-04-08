<?php namespace Anomaly\PostsModule\Tag\Command;

use Anomaly\Streams\Platform\View\ViewTemplate;


/**
 * Class AddTagMetaTitle
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class AddTagMetaTitle
{

    /**
     * The tag string.
     *
     * @var string
     */
    protected $tag;

    /**
     * Create a new AddTagMetaTitle instance.
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
     * @param ViewTemplate $template
     */
    public function handle(ViewTemplate $template)
    {
        $template->set('meta_title', trans('anomaly.module.posts::breadcrumb.tagged', ['tag' => $this->tag]));
    }
}
