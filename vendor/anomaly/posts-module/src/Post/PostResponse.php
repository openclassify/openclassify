<?php namespace Anomaly\PostsModule\Post;

use Anomaly\PostsModule\Post\Contract\PostInterface;
use Illuminate\Routing\ResponseFactory;

/**
 * Class PostResponse
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class PostResponse
{

    /**
     * The response factory.
     *
     * @var ResponseFactory
     */
    protected $container;

    /**
     * Create a new PostResponse instance.
     *
     * @param ResponseFactory $response
     */
    function __construct(ResponseFactory $response)
    {
        $this->response = $response;
    }

    /**
     * Make the post response.
     *
     * @param PostInterface $post
     */
    public function make(PostInterface $post)
    {
        if (!$post->getResponse()) {

            $response = $this->response->view(
                'anomaly.module.posts::posts.view',
                [
                    'post'    => $post,
                    'content' => $post->getContent(),
                ]
            );

            if (!$post->isLive()) {
                $response->setTtl(0);
            }

            $post->setResponse($response);
        }
    }
}
