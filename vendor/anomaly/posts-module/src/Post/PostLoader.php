<?php namespace Anomaly\PostsModule\Post;

use Anomaly\PostsModule\Post\Contract\PostInterface;
use Anomaly\Streams\Platform\View\ViewTemplate;

/**
 * Class PostLoader
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class PostLoader
{

    /**
     * The template data.
     *
     * @var ViewTemplate
     */
    protected $template;

    /**
     * Create a new PostLoader instance.
     *
     * @param ViewTemplate $template
     */
    public function __construct(ViewTemplate $template)
    {
        $this->template = $template;
    }

    /**
     * Load post data to the template.
     *
     * @param PostInterface $post
     */
    public function load(PostInterface $post)
    {
        $this->template->set('post', $post);
        $this->template->set('title', $post->getTitle());
        $this->template->set('meta_title', $post->getMetaTitle());
        $this->template->set('meta_description', $post->getMetaDescription());
    }
}
