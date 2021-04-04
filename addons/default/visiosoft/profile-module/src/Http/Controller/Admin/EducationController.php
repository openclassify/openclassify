<?php namespace Visiosoft\ProfileModule\Http\Controller\Admin;

use Visiosoft\ProfileModule\Education\Form\EducationFormBuilder;
use Visiosoft\ProfileModule\Education\Table\EducationTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

class EducationController extends AdminController
{
    public function index(EducationTableBuilder $table)
    {
        return $table->render();
    }

    public function create(EducationFormBuilder $form)
    {
        return $form->render();
    }

    public function edit(EducationFormBuilder $form, $id)
    {
        return $form->render($id);
    }
}
