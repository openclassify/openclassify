<?php namespace Anomaly\PostsModule\Post;

use Anomaly\PostsModule\Post\Contract\PostInterface;
use Anomaly\PostsModule\Post\Contract\PostRepositoryInterface;
use Illuminate\Routing\Route;

/**
 * Class PostResolver
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class PostResolver
{

    /**
     * The post repository.
     *
     * @var PostRepositoryInterface
     */
    protected $posts;

    /**
     * The route object.
     *
     * @var Route
     */
    protected $route;

    /**
     * Create a new PostResolver instance.
     *
     * @param PostRepositoryInterface $posts
     * @param Route                   $route
     */
    public function __construct(PostRepositoryInterface $posts, Route $route)
    {
        $this->posts = $posts;
        $this->route = $route;
    }

    /**
     * Resolve the post.
     *
     * @return PostInterface|null
     */
    public function resolve()
    {
        return $this->posts->findBySlug($this->route->parameter('slug'));
    }
}
