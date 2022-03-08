<?php namespace Visiosoft\NotificationsModule\Http\Controller\Admin;

use Visiosoft\NotificationsModule\Template\Form\TemplateFormBuilder;
use Visiosoft\NotificationsModule\Template\Table\TemplateTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

class TemplateController extends AdminController
{

    /**
     * Display an index of existing entries.
     *
     * @param TemplateTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(TemplateTableBuilder $table)
    {
        return $table->render();
    }

    /**
     * Create a new entry.
     *
     * @param TemplateFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(TemplateFormBuilder $form)
    {
        return $form->render();
    }

    /**
     * Edit an existing entry.
     *
     * @param TemplateFormBuilder $form
     * @param        $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(TemplateFormBuilder $form, $id)
    {
        return $form->render($id);
    }
}
