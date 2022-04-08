<?php namespace Anomaly\PostsModule;

use Anomaly\PostsModule\Category\CategoryModel;
use Anomaly\PostsModule\Category\CategoryRepository;
use Anomaly\PostsModule\Category\Contract\CategoryRepositoryInterface;
use Anomaly\PostsModule\Http\Controller\Admin\AssignmentsController;
use Anomaly\PostsModule\Http\Controller\Admin\FieldsController;
use Anomaly\PostsModule\Http\Controller\Admin\VersionsController;
use Anomaly\PostsModule\Post\Contract\PostRepositoryInterface;
use Anomaly\PostsModule\Post\PostModel;
use Anomaly\PostsModule\Post\PostRepository;
use Anomaly\PostsModule\Type\Contract\TypeRepositoryInterface;
use Anomaly\PostsModule\Type\TypeModel;
use Anomaly\PostsModule\Type\TypeRepository;
use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Anomaly\Streams\Platform\Assignment\AssignmentRouter;
use Anomaly\Streams\Platform\Field\FieldRouter;
use Anomaly\Streams\Platform\Model\Posts\PostsCategoriesEntryModel;
use Anomaly\Streams\Platform\Model\Posts\PostsPostsEntryModel;
use Anomaly\Streams\Platform\Model\Posts\PostsTypesEntryModel;
use Anomaly\Streams\Platform\Version\VersionRouter;

/**
 * Class PostsModuleServiceProvider
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class PostsModuleServiceProvider extends AddonServiceProvider
{
    /**
     * The class bindings.
     *
     * @var array
     */
    protected $bindings = [
        PostsPostsEntryModel::class      => PostModel::class,
        PostsTypesEntryModel::class      => TypeModel::class,
        PostsCategoriesEntryModel::class => CategoryModel::class,
    ];

    /**
     * The singleton bindings.
     *
     * @var array
     */
    protected $singletons = [
        PostRepositoryInterface::class     => PostRepository::class,
        TypeRepositoryInterface::class     => TypeRepository::class,
        CategoryRepositoryInterface::class => CategoryRepository::class,
    ];

    /**
     * Map the addon.
     *
     * @param FieldRouter $fields
     * @param VersionRouter $versions
     * @param AssignmentRouter $assignments
     */
    public function map(FieldRouter $fields, VersionRouter $versions, AssignmentRouter $assignments)
    {
        $fields->route($this->addon, FieldsController::class);
        $versions->route($this->addon, VersionsController::class);
        $assignments->route($this->addon, AssignmentsController::class);
    }

    /**
     * Get the Post Modules URL base via conig, or default to posts.
     *
     * @return string
     */
    public function postsUrlBase()
    {
        return $this->app->config->get('anomaly.module.posts::permalink.url_base', 'posts');
    }
}
