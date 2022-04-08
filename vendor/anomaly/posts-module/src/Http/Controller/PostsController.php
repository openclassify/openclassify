<?php namespace Anomaly\PostsModule\Http\Controller;

use Anomaly\PostsModule\Category\Command\AddCategoryBreadcrumb;
use Anomaly\PostsModule\Post\Command\AddPostBreadcrumb;
use Anomaly\PostsModule\Post\Command\AddPostsBreadcrumb;
use Anomaly\PostsModule\Post\Command\AddPostsMetaTitle;
use Anomaly\PostsModule\Post\Command\MakePostResponse;
use Anomaly\PostsModule\Post\Command\MakePreviewResponse;
use Anomaly\PostsModule\Post\Contract\PostRepositoryInterface;
use Anomaly\PostsModule\Post\PostResolver;
use Anomaly\Streams\Platform\Http\Controller\PublicController;

/**
 * Class PostsController
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class PostsController extends PublicController
{

    /**
     * Display recent posts.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $this->dispatch(new AddPostsBreadcrumb());
        $this->dispatch(new AddPostsMetaTitle());

        return $this->view->make('anomaly.module.posts::posts/index');
    }

    /**
     * Preview an existing post.
     *
     * @param PostRepositoryInterface $posts
     * @param                         $id
     * @return null|\Symfony\Component\HttpFoundation\Response
     */
    public function preview(PostRepositoryInterface $posts, $id)
    {
        if (!$post = $posts->findByStrId($id)) {
            abort(404);
        }

        $this->dispatch(new AddPostsBreadcrumb());
        $this->dispatch(new MakePreviewResponse($post));

        if ($category = $post->getCategory()) {
            $this->dispatch(new AddCategoryBreadcrumb($category));
        }

        $this->dispatch(new AddPostBreadcrumb($post));

        return $post->getResponse();
    }

    /**
     * View an existing post.
     *
     * @param  PostResolver $resolver
     * @return null|\Symfony\Component\HttpFoundation\Response
     */
    public function view(PostResolver $resolver)
    {
        if (!$post = $resolver->resolve()) {
            abort(404);
        }

        if (!$post->isLive()) {
            abort(404);
        }

        $this->dispatch(new MakePostResponse($post));

        return $post->getResponse();
    }
}
