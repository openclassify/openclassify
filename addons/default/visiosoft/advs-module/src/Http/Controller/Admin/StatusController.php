<?php namespace Visiosoft\AdvsModule\Http\Controller\Admin;

use Visiosoft\AdvsModule\Status\Form\StatusFormBuilder;
use Visiosoft\AdvsModule\Status\Table\StatusTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

class StatusController extends AdminController
{

    /**
     * Display an index of existing entries.
     *
     * @param StatusTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(StatusTableBuilder $table)
    {
        return $table->render();
    }

    /**
     * Create a new entry.
     *
     * @param StatusFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(StatusFormBuilder $form)
    {
        return $form->render();
    }

    /**
     * Edit an existing entry.
     *
     * @param StatusFormBuilder $form
     * @param        $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(StatusFormBuilder $form, $id)
    {
        return $form->render($id);
    }
}
