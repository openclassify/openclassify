<?php namespace Anomaly\PagesModule\Page\Form\Command;

use Anomaly\PagesModule\Entry\Form\EntryFormBuilder;
use Anomaly\PagesModule\Page\Contract\PageInterface;
use Anomaly\PagesModule\Page\Form\PageEntryFormBuilder;
use Anomaly\PagesModule\Type\Contract\TypeRepositoryInterface;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class AddEntryFormFromPage
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class AddEntryFormFromPage
{

    use DispatchesJobs;

    /**
     * The multiple form builder.
     *
     * @var PageEntryFormBuilder
     */
    protected $builder;

    /**
     * The page instance.
     *
     * @var PageInterface
     */
    protected $page;

    /**
     * Create a new AddEntryFormFromPage instance.
     *
     * @param PageEntryFormBuilder $builder
     * @param PageInterface $page
     */
    public function __construct(PageEntryFormBuilder $builder, PageInterface $page)
    {
        $this->builder = $builder;
        $this->page    = $page;
    }

    /**
     * Handle the command.
     *
     * @param EntryFormBuilder $builder
     * @param TypeRepositoryInterface $types
     */
    public function handle(EntryFormBuilder $builder, TypeRepositoryInterface $types)
    {
        $type = $this->page->getType();

        if (request()->has('type')) {

            $type = $types->find(request('type'));

            $this->builder->setOption('redirect', 'admin/pages/edit/' . $this->page->getId());
        }

        $builder->setModel($type->getEntryModelName());
        $builder->setEntry($this->page->getEntryId());

        $this->builder->addForm('entry', $builder);
    }
}
