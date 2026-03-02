<?php namespace Visiosoft\LocationModule\Http\Controller\Admin;

use Illuminate\Http\Request;
use Visiosoft\LocationModule\Village\Contract\VillageRepositoryInterface;
use Visiosoft\LocationModule\Village\Form\VillageFormBuilder;
use Visiosoft\LocationModule\Village\Table\VillageTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

class VillageController extends AdminController
{
    public function index(VillageTableBuilder $table, Request $request)
    {
        $villages = app(VillageRepositoryInterface::class);

        if(!isset($request->neighborhood) || $request->neighborhood==""){
            return $table->render();
        }else{
            $villages = $villages->getVillagesByNeighborhoodId($request->neighborhood);
            if (count($villages) == 0) {
                $this->messages->error('Selected neighborhood has no related village.');
                return back();
            }
        }
        $table->setTableEntries($villages);
        return $table->render();
    }

    public function create(VillageFormBuilder $form)
    {
        $form->setNeighborhood($this->request->get('village'));

        return $form->render();
    }

    public function edit(VillageFormBuilder $form, $id)
    {
        return $form->render($id);
    }
}
