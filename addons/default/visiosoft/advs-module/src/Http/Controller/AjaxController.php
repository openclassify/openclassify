<?php namespace Visiosoft\AdvsModule\Http\Controller;

use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Anomaly\Streams\Platform\Support\Currency;
use Anomaly\UsersModule\User\UserModel;
use Visiosoft\AdvsModule\Adv\AdvModel;
use Illuminate\Http\Request;
use Visiosoft\AdvsModule\Adv\Contract\AdvRepositoryInterface;
use Visiosoft\LocationModule\City\CityModel;
use Visiosoft\LocationModule\District\DistrictModel;
use Visiosoft\LocationModule\Neighborhood\NeighborhoodModel;
use Visiosoft\LocationModule\Village\VillageModel;
use Visiosoft\CatsModule\Category\CategoryModel;
use Visiosoft\NotificationsModule\Notify\Notification\SendLoanApplicationMail;

class AjaxController extends PublicController
{
    private $adv_model;
    private $userModel;

    public function __construct(AdvModel $advModel, UserModel $userModel)
    {
        $this->adv_model = $advModel;
        $this->userModel = $userModel;
        parent::__construct();
    }

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
        if ($request->level == 0) {
            $datas = CategoryModel::whereNull('parent_category_id')->get();
        } else {
            $datas = CategoryModel::where('parent_category_id', $request->cat)->get();
        }
        return response()->json($datas);
    }

    public function viewed(AdvModel $advModel, $id)
    {
        $advModel->viewed_Ad($id);
    }

    public function getMyAds(AdvRepositoryInterface $advRepository, Request $request)
    {
        $my_advs = new AdvModel();
        $type = $request->type;
        if ($type == 'pending') {
            $page_title = trans('visiosoft.module.advs::field.pending_adv.name');
            $my_advs = $my_advs->pendingAdvsByUser();
        } else {
            $page_title = trans('visiosoft.module.advs::field.my_adv.name');
            $my_advs = $my_advs->myAdvsByUser();
        }
        $my_advs = $my_advs->select(['id', 'cover_photo', 'slug', 'price', 'currency', 'city', 'country_id', 'cat1', 'cat2', 'status'])
                           ->orderByDesc('id');

        if (\request()->paginate === 'true') {
            $my_advs = $advRepository->addAttributes($my_advs->paginate(setting_value('streams::per_page')));
        } else {
            $my_advs = $advRepository->addAttributes($my_advs->get());
        }

        foreach ($my_advs as $index => $ad) {
            $my_advs[$index]->detail_url = $this->adv_model->getAdvDetailLinkByModel($ad, 'list');
            $my_advs[$index] = $this->adv_model->AddAdsDefaultCoverImage($ad);
            $my_advs[$index]->formatted_price = app(Currency::class)->format($ad->price, $ad->currency);
        }

        return response()->json(['success' => true, 'content' => $my_advs, 'title' => $page_title]);
    }

    public function getAdvsByCat($categoryID, AdvRepositoryInterface $advRepository)
    {
        return $advRepository->getByCat($categoryID);
    }
}