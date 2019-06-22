<?php namespace Visiosoft\LocationModule\Http\Controller\Admin;

use Illuminate\Http\Request;
use Visiosoft\LocationModule\Neighborhood\Form\NeighborhoodFormBuilder;
use Visiosoft\LocationModule\Neighborhood\NeighborhoodModel;
use Visiosoft\LocationModule\Neighborhood\Table\NeighborhoodTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Visiosoft\LocationModule\Village\VillageModel;

class NeighborhoodsController extends AdminController
{

    /**
     * Display an index of existing entries.
     *
     * @param NeighborhoodTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(NeighborhoodTableBuilder $table, Request $request)
    {
        if($this->request->action == "delete") {
            $village = new VillageModel();
            foreach ($this->request->id as $item)
            {
                $village->deleteVillageByNeighborhood($item);
            }
        }
        $neighborhoods = new NeighborhoodModel();
        if(!isset($request->district) || $request->district==""){
            return $table->render();
        }else{
            $neighborhoods = $neighborhoods->getSubNeighborhoods($request->district);
            if (count($neighborhoods) == 0) {
                $this->messages->error('Selected district has no related neighborhood.');
                return redirect('/admin/location/districts');
            }
        }
        $table->setTableEntries($neighborhoods);
        return $table->render();
    }

    /**
     * Create a new entry.
     *
     * @param NeighborhoodFormBuilder $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(NeighborhoodFormBuilder $form,Request $request)
    {
//        dd($request);
        //        return $form->render();
        if($this->request->action == "save") {
            if ($form->hasFormErrors()) {
                return back();
            }
            $form->make();

            return $this->redirect->to('/admin/location/neighborhoods?district='.$request->parent_district_id);
        }

        return $this->view->make('visiosoft.module.location::location/admin-sub-location');
    }

    /**
     * Edit an existing entry.
     *
     * @param NeighborhoodFormBuilder $form
     * @param        $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(NeighborhoodFormBuilder $form, $id)
    {
        return $form->render($id);
    }
}
