<?php namespace Visiosoft\ProfileModule\Http\Controller\Admin;

use Visiosoft\ProfileModule\EducationPart\Form\EducationPartFormBuilder;
use Visiosoft\ProfileModule\EducationPart\Table\EducationPartTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

class EducationPartController extends AdminController
{

    /**
     * Display an index of existing entries.
     *
     * @param EducationPartTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(EducationPartTableBuilder $table)
    {
        return $table->render();
    }

    /**
     * Create a new entry.
     *
     * @param EducationPartFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(EducationPartFormBuilder $form)
    {
        return $form->render();
    }

    /**
     * Edit an existing entry.
     *
     * @param EducationPartFormBuilder $form
     * @param        $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(EducationPartFormBuilder $form, $id)
    {
        return $form->render($id);
    }
}
