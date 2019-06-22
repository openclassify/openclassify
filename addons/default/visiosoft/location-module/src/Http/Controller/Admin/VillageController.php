<?php namespace Visiosoft\LocationModule\Http\Controller\Admin;

use Illuminate\Http\Request;
use Visiosoft\LocationModule\Village\Form\VillageFormBuilder;
use Visiosoft\LocationModule\Village\Table\VillageTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Visiosoft\LocationModule\Village\VillageModel;

class VillageController extends AdminController
{

    /**
     * Display an index of existing entries.
     *
     * @param VillageTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(VillageTableBuilder $table, Request $request)
    {
        $villages = new VillageModel();
        if(!isset($request->neighborhood) || $request->neighborhood==""){
            return $table->render();
        }else{
            $villages = $villages->getSubVillages($request->neighborhood);
            if (count($villages) == 0) {
                $this->messages->error('Selected neighborhood has no related village.');
                return back();
            }
        }
        $table->setTableEntries($villages);
        return $table->render();
    }

    /**
     * Create a new entry.
     *
     * @param VillageFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(VillageFormBuilder $form,Request $request)
    {
        //        return $form->render();
        if($this->request->action == "save") {
            if ($form->hasFormErrors()) {
                return back();
            }
            $form->make();
            return $this->redirect->to('/admin/location/village?neighborhood='.$request->parent_neighborhood_id);
        }

        return $this->view->make('visiosoft.module.location::location/admin-sub-location');
    }

    /**
     * Edit an existing entry.
     *
     * @param VillageFormBuilder $form
     * @param        $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(VillageFormBuilder $form, $id)
    {
        return $form->render($id);
    }
}
