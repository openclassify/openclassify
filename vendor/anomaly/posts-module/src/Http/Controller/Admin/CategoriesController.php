<?php namespace Anomaly\PostsModule\Http\Controller\Admin;

use Anomaly\PostsModule\Category\Contract\CategoryInterface;
use Anomaly\PostsModule\Category\Contract\CategoryRepositoryInterface;
use Anomaly\PostsModule\Category\Form\CategoryFormBuilder;
use Anomaly\PostsModule\Category\Table\CategoryTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Anomaly\Streams\Platform\Stream\Contract\StreamRepositoryInterface;

/**
 * Class CategoriesController
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class CategoriesController extends AdminController
{

    /**
     * Return an index of existing categories.
     *
     * @param  CategoryTableBuilder $table
     * @return \Illuminate\Http\Response
     */
    public function index(CategoryTableBuilder $table)
    {
        return $table->render();
    }

    /**
     * Create the form for creating a new category.
     *
     * @param  CategoryFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(CategoryFormBuilder $form)
    {
        return $form->render();
    }

    /**
     * Return the form for editing an existing category.
     *
     * @param  CategoryFormBuilder                        $form
     * @param                                             $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(CategoryFormBuilder $form, $id)
    {
        return $form->render($id);
    }

    /**
     * Redirect to a category's URL.
     *
     * @param  CategoryRepositoryInterface       $categories
     * @param                                    $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function view(CategoryRepositoryInterface $categories, $id)
    {
        /* @var CategoryInterface $category */
        $category = $categories->find($id);

        return $this->redirect->to($category->route('view'));
    }

    /**
     * Go to assignments.
     *
     * @param StreamRepositoryInterface $streams
     * @return \Illuminate\Http\RedirectResponse
     */
    public function assignments(StreamRepositoryInterface $streams)
    {
        $stream = $streams->findBySlugAndNamespace('categories', 'posts');

        return $this->redirect->to('admin/posts/assignments/' . $stream->getId());
    }
}
