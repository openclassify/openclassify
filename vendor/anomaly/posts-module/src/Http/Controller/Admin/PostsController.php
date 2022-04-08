<?php namespace Anomaly\PostsModule\Http\Controller\Admin;

use Anomaly\PostsModule\Post\Contract\PostInterface;
use Anomaly\PostsModule\Post\Contract\PostRepositoryInterface;
use Anomaly\PostsModule\Post\Form\Command\AddEntryFormFromPost;
use Anomaly\PostsModule\Post\Form\Command\AddEntryFormFromRequest;
use Anomaly\PostsModule\Post\Form\Command\AddPostFormFromPost;
use Anomaly\PostsModule\Post\Form\Command\AddPostFormFromRequest;
use Anomaly\PostsModule\Post\Form\PostEntryFormBuilder;
use Anomaly\PostsModule\Post\Table\PostTableBuilder;
use Anomaly\PostsModule\Type\Contract\TypeRepositoryInterface;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Anomaly\Streams\Platform\Support\Authorizer;
use Illuminate\Routing\Redirector;

/**
 * Class PostsController
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class PostsController extends AdminController
{

    /**
     * Return a tree of existing posts.
     *
     * @param PostTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(PostTableBuilder $table)
    {
        return $table->render();
    }

    /**
     * Return the modal for choosing a post type.
     *
     * @param  TypeRepositoryInterface $types
     * @return \Illuminate\View\View
     */
    public function choose(TypeRepositoryInterface $types)
    {
        return $this->view->make('module::admin/posts/choose', ['types' => $types->all()]);
    }

    /**
     * Return the modal for changing a post type.
     *
     * @param  TypeRepositoryInterface $types
     * @param $id
     * @return \Illuminate\View\View
     */
    public function change(TypeRepositoryInterface $types, $id)
    {
        return $this->view->make('module::admin/posts/change', ['types' => $types->all(), 'post' => $id]);
    }

    /**
     * Return the form for creating a new post.
     *
     * @param  PostEntryFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(PostEntryFormBuilder $form)
    {
        $this->dispatch(new AddEntryFormFromRequest($form));
        $this->dispatch(new AddPostFormFromRequest($form));

        return $form->render();
    }

    /**
     * Return the form for editing an existing post.
     *
     * @param  PostRepositoryInterface $posts
     * @param  PostEntryFormBuilder $form
     * @param                                             $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(PostRepositoryInterface $posts, PostEntryFormBuilder $form, $id)
    {
        /* @var PostInterface $post */
        $post = $posts->find($id);

        $this->dispatch(new AddEntryFormFromPost($form, $post));
        $this->dispatch(new AddPostFormFromPost($form, $post));

        return $form->render($post);
    }

    /**
     * Redirect to a post's URL.
     *
     * @param  PostRepositoryInterface $posts
     * @param  Redirector $redirect
     * @param                                    $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function view(PostRepositoryInterface $posts, Redirector $redirect, $id)
    {
        /* @var PostInterface $post */
        $post = $posts->find($id);

        if (!$post->isLive()) {
            return $redirect->to($post->route('preview'));
        }

        return $redirect->to($post->route('view'));
    }

    /**
     * Delete a post and go back.
     *
     * @param  PostRepositoryInterface $posts
     * @param  Authorizer $authorizer
     * @param                                    $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(PostRepositoryInterface $posts, Authorizer $authorizer, $id)
    {
        $authorizer->authorize('anomaly.module.posts::posts.delete');

        $posts->delete($posts->find($id));

        return redirect()->back();
    }
}
