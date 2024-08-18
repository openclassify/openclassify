<?php namespace Visiosoft\CustomfieldsModule\Http\Controller\Admin;

use Visiosoft\CustomfieldsModule\Parent\Form\ParentFormBuilder;
use Visiosoft\CustomfieldsModule\Parent\Table\ParentTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

class ParentController extends AdminController
{

    /**
     * Display an index of existing entries.
     *
     * @param ParentTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(ParentTableBuilder $table)
    {
        return $table->render();
    }

    /**
     * Create a new entry.
     *
     * @param ParentFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(ParentFormBuilder $form)
    {
        return $form->render();
    }

    /**
     * Edit an existing entry.
     *
     * @param ParentFormBuilder $form
     * @param        $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(ParentFormBuilder $form, $id)
    {
        return $form->render($id);
    }
}
