<?php namespace Visiosoft\AdvsModule\Http\Controller;

use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Visiosoft\AdvsModule\Adv\AdvModel;
use Illuminate\Http\Request;
use Visiosoft\LocationModule\City\CityModel;
use Visiosoft\LocationModule\District\DistrictModel;
use Visiosoft\LocationModule\Neighborhood\NeighborhoodModel;
use Visiosoft\LocationModule\Village\VillageModel;
use Visiosoft\CatsModule\Category\CategoryModel;

class AjaxController extends PublicController
{
    public function locations(Request $request)
    {
        $datas = [];
        if ($request->level == 1) {
            $datas = CityModel::where('parent_country_id', $request->cat)->get();
        } else if ($request->level == 2) {
            $datas = DistrictModel::where('parent_city_id', $request->cat)->get();
        } else if ($request->level == 3) {
            $datas = NeighborhoodModel::where('parent_district_id', $request->cat)->get();
        } else if ($request->level == 4) {
            $datas = VillageModel::where('parent_neighborhood_id', $request->cat)->get();
        }
        return response()->json($datas);
    }

    public function categories(Request $request)
    {
        $datas = [];
        if ($request->level == 0) {
            $datas = CategoryModel::whereNull('parent_category_id')->get();
        } else {
            $datas = CategoryModel::where('parent_category_id', $request->cat)->get();
        }
        return response()->json($datas);
    }

    public function keySearch(Request $request)
    {
        $datas = [];
        $catModel = new CategoryModel();
        $datas['category'] = $catModel->searchKeyword($request->q, $request->selected);
        return response()->json($datas);
    }

    public function viewed(AdvModel $advModel, $id)
    {
        $advModel->viewed_Ad($id);
    }
}