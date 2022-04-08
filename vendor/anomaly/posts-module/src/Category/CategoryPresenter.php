<?php namespace Anomaly\PostsModule\Category;

use Anomaly\PostsModule\Category\Command\GetCategoryPath;
use Anomaly\PostsModule\Category\Contract\CategoryInterface;
use Anomaly\Streams\Platform\Entry\EntryPresenter;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class CategoryPresenter
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class CategoryPresenter extends EntryPresenter
{

    use DispatchesJobs;

    /**
     * The presented object.
     * This is for IDE support.
     *
     * @var CategoryInterface
     */
    protected $object;

    /**
     * Return the category path.
     *
     * @return string
     */
    public function path()
    {
        return $this->object->route('view');
    }
}
