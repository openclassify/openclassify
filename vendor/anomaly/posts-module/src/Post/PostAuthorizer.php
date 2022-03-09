<?php namespace Anomaly\PostsModule\Post;

use Anomaly\PostsModule\Post\Contract\PostInterface;
use Anomaly\Streams\Platform\Support\Authorizer;

/**
 * Class PostAuthorizer
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class PostAuthorizer
{

    /**
     * The authorizer utility.
     *
     * @var Authorizer
     */
    protected $authorizer;

    /**
     * Create a new PostAuthorizer instance.
     *
     * @param Authorizer $authorizer
     */
    public function __construct(Authorizer $authorizer)
    {
        $this->authorizer = $authorizer;
    }

    /**
     * Authorize the post.
     *
     * @param PostInterface $post
     */
    public function authorize(PostInterface $post)
    {
        /*
         * If the post is not enabled yet check and make
         * sure that we are allowed to preview it first.
         */
        if (!$post->isLive() && !$this->authorizer->authorize('anomaly.module.posts::posts.preview')) {
            abort(403);
        }
    }
}
