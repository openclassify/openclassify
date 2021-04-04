<?php namespace Visiosoft\ProfileModule\Http\Controller\Admin;

use Visiosoft\ProfileModule\EducationPart\Form\EducationPartFormBuilder;
use Visiosoft\ProfileModule\EducationPart\Table\EducationPartTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

class EducationPartController extends AdminController
{
    public function index(EducationPartTableBuilder $table)
    {
        return $table->render();
    }

    public function create(EducationPartFormBuilder $form)
    {
        return $form->render();
    }

    public function edit(EducationPartFormBuilder $form, $id)
    {
        return $form->render($id);
    }
}
