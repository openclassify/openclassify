<?php namespace Anomaly\PostsModule\Post\Command;

use Anomaly\PostsModule\Post\Contract\PostInterface;
use Anomaly\PostsModule\Post\PostAuthorizer;
use Anomaly\PostsModule\Post\PostContent;
use Anomaly\PostsModule\Post\PostLoader;
use Anomaly\PostsModule\Post\PostResponse;


/**
 * Class MakePreviewResponse
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class MakePreviewResponse
{

    /**
     * The post instance.
     *
     * @var PostInterface
     */
    private $post;

    /**
     * Create a new MakePreviewResponse instance.
     *
     * @param PostInterface $post
     */
    public function __construct(PostInterface $post)
    {
        $this->post = $post;
    }

    /**
     * Handle the command
     *
     * @param PostLoader     $loader
     * @param PostContent    $content
     * @param PostResponse   $response
     * @param PostAuthorizer $authorizer
     */
    public function handle(
        PostLoader $loader,
        PostContent $content,
        PostResponse $response,
        PostAuthorizer $authorizer
    ) {
        $authorizer->authorize($this->post);
        $loader->load($this->post);
        $content->make($this->post);
        $response->make($this->post);
    }
}
