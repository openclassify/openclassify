<?php namespace Anomaly\PostsModule\Post\Command;

use Anomaly\PostsModule\Post\Contract\PostInterface;
use Anomaly\Streams\Platform\Http\Command\PurgeHttpCache;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class PurgeIndexCache
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class PurgeIndexCache
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
     */
    public function handle()
    {
        $this->dispatch(new PurgeHttpCache($this->post->route('posts.index')));
    }

}
