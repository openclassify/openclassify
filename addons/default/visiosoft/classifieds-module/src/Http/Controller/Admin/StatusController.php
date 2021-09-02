<?php namespace Visiosoft\ClassifiedsModule\Http\Controller\Admin;

use Visiosoft\ClassifiedsModule\Status\Contract\StatusRepositoryInterface;
use Visiosoft\ClassifiedsModule\Status\Form\StatusFormBuilder;
use Visiosoft\ClassifiedsModule\Status\Table\StatusTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

class StatusController extends AdminController
{
    public function index(StatusTableBuilder $table)
    {
        return $table->render();
    }

    public function create(StatusFormBuilder $form)
    {
        return $form->render();
    }

    public function edit(StatusFormBuilder $form, StatusRepositoryInterface $statusRepository, $id)
    {
        $status = $statusRepository->find($id);

        if ($status->is_system) {
            $form->skipField('user_access');
        }

        $form->skipField('slug');

        return $form->render($id);
    }
}
