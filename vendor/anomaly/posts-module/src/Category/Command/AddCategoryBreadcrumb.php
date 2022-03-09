<?php namespace Anomaly\PostsModule\Category\Command;

use Anomaly\PostsModule\Category\Contract\CategoryInterface;
use Anomaly\Streams\Platform\Ui\Breadcrumb\BreadcrumbCollection;

/**
 * Class AddCategoryBreadcrumb
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AddCategoryBreadcrumb
{

    /**
     * The category instance.
     *
     * @var CategoryInterface
     */
    protected $category;

    /**
     * Create a new AddCategoryBreadcrumb instance.
     *
     * @param CategoryInterface $category
     */
    public function __construct(CategoryInterface $category)
    {
        $this->category = $category;
    }

    /**
     * Handle the command.
     *
     * @param BreadcrumbCollection $breadcrumbs
     */
    public function handle(BreadcrumbCollection $breadcrumbs)
    {
        $breadcrumbs->add(
            $this->category->getName(),
            $this->category->route('view')
        );
    }
}
