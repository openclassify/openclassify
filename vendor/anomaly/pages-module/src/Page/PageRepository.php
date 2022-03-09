<?php namespace Anomaly\PagesModule\Page;

use Anomaly\PagesModule\Page\Command\RemoveRestrictedPages;
use Anomaly\PagesModule\Page\Contract\PageInterface;
use Anomaly\PagesModule\Page\Contract\PageRepositoryInterface;
use Anomaly\Streams\Platform\Entry\EntryRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class PageRepository
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class PageRepository extends EntryRepository implements PageRepositoryInterface
{

    use DispatchesJobs;

    /**
     * The page model.
     *
     * @var PageModel
     */
    protected $model;

    /**
     * Create a new PageRepositoryInterface instance.
     *
     * @param PageModel $model
     */
    public function __construct(PageModel $model)
    {
        $this->model = $model;
    }

    /**
     * Return only routable pages.
     *
     * @return PageCollection
     */
    public function routable()
    {
        return $this->model
            ->newQueryWithoutRelationships()
            ->get();
    }

    /**
     * Return only accessible pages.
     *
     * @return PageCollection
     */
    public function accessible()
    {
        return $this->dispatch(new RemoveRestrictedPages($this->all()));
    }

    /**
     * Return live posts.
     *
     * @return PageCollection
     */
    public function live()
    {
        return $this->model
            ->live()
            ->sorted()
            ->get();
    }

    /**
     * Return the sitemap entries query.
     *
     * @return Builder
     */
    public function sitemap()
    {
        return $this->model
            ->live()
            ->sorted()
            ->where('visible', true);
    }

    /**
     * Unset home pages.
     *
     * @param PageInterface $home
     * @return void
     */
    public function unsetHomePages(PageInterface $home)
    {
        $this->model
            ->where('id', '!=', $home->getId())
            ->update(['home' => false]);
    }

    /**
     * Find a page by it's string ID.
     *
     * @param $id
     * @return null|PageInterface
     */
    public function findByStrId($id)
    {
        return $this->model->where('str_id', $id)->first();
    }

    /**
     * Find a page by it's path.
     *
     * @param $path
     * @return PageInterface|null
     */
    public function findByPath($path)
    {
        return $this->model
            ->whereHas(
                'translations',
                function (Builder $query) use ($path) {
                    $query->where('path', $path);
                }
            )
            ->first();
    }
}
