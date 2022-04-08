<?php namespace Anomaly\PagesModule\Page\Form\Command;

use Anomaly\PagesModule\Page\Form\PageEntryFormBuilder;
use Anomaly\PagesModule\Page\Form\PageFormBuilder;
use Anomaly\PagesModule\Type\Contract\TypeRepositoryInterface;
use Illuminate\Http\Request;

/**
 * Class AddPageFormFromRequest
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class AddPageFormFromRequest
{

    /**
     * The multiple form builder.
     *
     * @var PageEntryFormBuilder
     */
    protected $builder;

    /**
     * Create a new AddPageFormFromRequest instance.
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
     * @param PageFormBuilder         $builder
     * @param Request                 $request
     */
    public function handle(TypeRepositoryInterface $types, PageFormBuilder $builder, Request $request)
    {
        $this->builder->addForm('page', $builder->setType($types->find($request->get('type'))));
    }
}
