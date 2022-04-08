<?php namespace Anomaly\PagesModule\Page\Form\Command;

use Anomaly\PagesModule\Entry\Form\EntryFormBuilder;
use Anomaly\PagesModule\Page\Form\PageEntryFormBuilder;
use Anomaly\PagesModule\Type\Contract\TypeInterface;
use Anomaly\PagesModule\Type\Contract\TypeRepositoryInterface;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;

/**
 * Class AddEntryFormFromRequest
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class AddEntryFormFromRequest
{

    use DispatchesJobs;

    /**
     * The multiple form builder.
     *
     * @var PageEntryFormBuilder
     */
    protected $builder;

    /**
     * Create a new AddEntryFormFromRequest instance.
     *
     * @param PageEntryFormBuilder $builder
     */
    public function __construct(PageEntryFormBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command.
     *
     * @param TypeRepositoryInterface $types
     * @param EntryFormBuilder $builder
     * @param Request $request
     */
    public function handle(TypeRepositoryInterface $types, EntryFormBuilder $builder, Request $request)
    {
        /* @var TypeInterface $type */
        $type = $types->find($request->get('type'));

        $this->builder->addForm(
            'entry',
            $builder->setModel($type->getEntryModelName())
        );
    }
}
