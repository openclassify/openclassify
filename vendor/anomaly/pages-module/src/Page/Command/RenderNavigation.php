<?php namespace Anomaly\PagesModule\Page\Command;

use Anomaly\PagesModule\Page\Contract\PageRepositoryInterface;
use Anomaly\PagesModule\Page\PageCollection;
use Anomaly\Streams\Platform\Support\Collection;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\View\Factory;

/**
 * Class RenderNavigation
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class RenderNavigation
{

    use DispatchesJobs;

    /**
     * The rendering options.
     *
     * @var Collection
     */
    protected $options;

    /**
     * Create a new RenderNavigation instance.
     *
     * @param Collection $options
     */
    public function __construct(Collection $options)
    {
        $this->options = $options;
    }

    /**
     * Handle the command.
     *
     * @param PageRepositoryInterface $pages
     * @param Factory $view
     * @return string
     */
    public function handle(PageRepositoryInterface $pages, Factory $view)
    {
        $options = $this->options;

        /* @var PageCollection $pages */
        $pages = $pages->sorted();

        $pages = $pages->live();
        $pages = $pages->visible();

        $this->dispatch(new SetCurrentPage($pages));
        $this->dispatch(new SetActivePages($pages));
        $this->dispatch(new RemoveRestrictedPages($pages));

        // After modifying set the relations.
        $this->dispatch(new SetParentRelations($pages));
        $this->dispatch(new SetChildrenRelations($pages));

        if ($options->has('root')) {
            if ($page = $this->dispatch(new GetPage($options->get('root')))) {
                $options->put('parent', $page);
            }
        }

        return $view->make(
            $options->get('view', 'anomaly.module.pages::structure'),
            compact('pages', 'options')
        )->render();
    }
}
