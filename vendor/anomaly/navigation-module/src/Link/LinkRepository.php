<?php namespace Anomaly\NavigationModule\Link;

use Anomaly\NavigationModule\Link\Contract\LinkRepositoryInterface;
use Anomaly\NavigationModule\Menu\Contract\MenuInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;

/**
 * Class LinkRepository
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class LinkRepository extends EntryRepository implements LinkRepositoryInterface
{

    /**
     * The link model.
     *
     * @var LinkModel
     */
    protected $model;

    /**
     * Create a new LinkRepository instance.
     *
     * @param LinkModel $model
     */
    public function __construct(LinkModel $model)
    {
        $this->model = $model;
    }

    /**
     * Return links belonging to
     * the provided menu.
     *
     * @param  MenuInterface  $menu
     * @return LinkCollection
     */
    public function findAllByMenu(MenuInterface $menu)
    {
        return $this->model->where('menu_id', $menu->getId())->get();
    }
}
