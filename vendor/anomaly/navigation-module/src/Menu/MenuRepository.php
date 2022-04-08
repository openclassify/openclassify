<?php namespace Anomaly\NavigationModule\Menu;

use Anomaly\NavigationModule\Menu\Contract\MenuInterface;
use Anomaly\NavigationModule\Menu\Contract\MenuRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

/**
 * Class MenuRepository
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class MenuRepository extends EntryRepository implements MenuRepositoryInterface
{

    /**
     * The menu model.
     *
     * @var MenuModel
     */
    protected $model;

    /**
     * Create a new MenuRepository instance.
     *
     * @param MenuModel $model
     */
    public function __construct(MenuModel $model)
    {
        $this->model = $model;
    }

    /**
     * Find a menu by it's slug.
     *
     * @param $slug
     * @return null|MenuInterface
     */
    public function findBySlug($slug)
    {
        return $this->model->where('slug', $slug)->first();
    }
}
