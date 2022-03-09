<?php namespace Anomaly\PostsModule\Http\Controller;

use Anomaly\PostsModule\Category\Command\AddCategoryBreadcrumb;
use Anomaly\PostsModule\Category\Command\AddCategoryMetadata;
use Anomaly\PostsModule\Category\Contract\CategoryRepositoryInterface;
use Anomaly\PostsModule\Post\Command\AddPostsBreadcrumb;
use Anomaly\Streams\Platform\Http\Controller\PublicController;

/**
 * Class CategoriesController
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class CategoriesController extends PublicController
{

    /**
     * Return an index of category posts.
     *
     * @param  CategoryRepositoryInterface $categories
     * @param                              $category
     * @return \Illuminate\View\View
     */
    public function index(CategoryRepositoryInterface $categories, $category)
    {
        if (!$category = $categories->findBySlug($category)) {
            abort(404);
        }

        $this->dispatch(new AddPostsBreadcrumb());
        $this->dispatch(new AddCategoryBreadcrumb($category));
        $this->dispatch(new AddCategoryMetadata($category));

        return $this->view->make('anomaly.module.posts::categories/index', compact('category'));
    }
}
