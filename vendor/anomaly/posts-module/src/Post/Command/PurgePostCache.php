<?php namespace Anomaly\PostsModule\Post\Command;

use Anomaly\PostsModule\Post\Contract\PostInterface;
use Anomaly\Streams\Platform\Http\Command\PurgeHttpCache;
use Anomaly\Streams\Platform\Http\HttpCache;
use Anomaly\Streams\Platform\Routing\UrlGenerator;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class PurgePostCache
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class PurgePostCache
{

    use DispatchesJobs;

    /**
     * The post instance.
     *
     * @var PostInterface
     */
    protected $post;

    /**
     * Return the path for a post.
     *
     * @param PostInterface $post
     */
    public function __construct(PostInterface $post)
    {
        $this->post = $post;
    }

    /**
     * Handle the command.
     *
     * @param HttpCache $cache
     */
    public function handle(UrlGenerator $url)
    {
        foreach ($this->post->getTags() as $tag) {
            $this->dispatch(new PurgeHttpCache($url->route('anomaly.module.posts::tags.view', compact('tag'))));
        }
    }

}
