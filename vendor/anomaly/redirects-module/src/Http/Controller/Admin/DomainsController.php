<?php namespace Anomaly\RedirectsModule\Http\Controller\Admin;

use Anomaly\RedirectsModule\Domain\Form\DomainFormBuilder;
use Anomaly\RedirectsModule\Domain\Table\DomainTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

class DomainsController extends AdminController
{

    /**
     * Display an index of existing entries.
     *
     * @param DomainTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(DomainTableBuilder $table)
    {
        return $table->render();
    }

    /**
     * Create a new entry.
     *
     * @param DomainFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(DomainFormBuilder $form)
    {
        return $form->render();
    }

    /**
     * Edit an existing entry.
     *
     * @param DomainFormBuilder $form
     * @param        $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(DomainFormBuilder $form, $id)
    {
        return $form->render($id);
    }
}
