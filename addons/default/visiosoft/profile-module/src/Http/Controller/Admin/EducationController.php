<?php namespace Visiosoft\ProfileModule\Http\Controller\Admin;

use Visiosoft\ProfileModule\Education\Form\EducationFormBuilder;
use Visiosoft\ProfileModule\Education\Table\EducationTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

class EducationController extends AdminController
{

    /**
     * Display an index of existing entries.
     *
     * @param EducationTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(EducationTableBuilder $table)
    {
        return $table->render();
    }

    /**
     * Create a new entry.
     *
     * @param EducationFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(EducationFormBuilder $form)
    {
        return $form->render();
    }

    /**
     * Edit an existing entry.
     *
     * @param EducationFormBuilder $form
     * @param        $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(EducationFormBuilder $form, $id)
    {
        return $form->render($id);
    }
}
