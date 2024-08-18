<?php namespace Visiosoft\AdvsModule\Http\Controller;

use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Anomaly\Streams\Platform\Support\Currency;
use Anomaly\UsersModule\User\UserModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
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
        $keyword = $request->keyword;

        if (!$request->simple) {
            if ($type === 'pending') {
                $page_title = trans('visiosoft.module.advs::field.pending_adv.name');
                $my_advs = $my_advs->pendingAdvsByUser();
            } else {
                $page_title = trans('visiosoft.module.advs::field.my_adv.name');
                $my_advs = $my_advs->myAdvsByUser();
            }
            $my_advs = $my_advs
                ->select(['id', 'cover_photo', 'slug', 'price', 'currency', 'count_show_ad','city', 'country_id', 'cat1', 'cat2', 'status', 'created_at'])
                ->where(function ($q) {
                    if ($this->request->search) {
                        return $q->where('id', 'LIKE', '%' . $this->request->search . '%');
                    }
                    return $q;
                });
        } else {

            $my_advs = $my_advs->userAdv()
                ->leftJoin('advs_advs_translations', function ($join) {
                    $join->on('advs_advs.id', '=', 'advs_advs_translations.entry_id');
                    $join->where('advs_advs_translations.locale', '=', Request()->session()->get('_locale', setting_value('streams::default_locale')));
                })->select(['advs_advs.id', 'advs_advs.cover_photo', 'advs_advs.slug', 'price', 'currency', 'city', 'country_id', 'cat1', 'cat2', 'status', 'advs_advs.created_at', 'ad_note']);

            if ($type == 'approved') {
                $page_title = trans('visiosoft.module.advs::field.my_adv.name');
                $my_advs = $my_advs->where('status','=','approved');
            } else if ($type == 'passive') {
                $page_title = trans('visiosoft.module.advs::field.passive_adv.name');
                $my_advs = $my_advs->where('status','=','passive');
            } else if ($type == 'pending') {
                $page_title = trans('visiosoft.module.advs::field.pending_adv.name');
                $my_advs = $my_advs->where('status','=','pending_user')
                                   ->orWhere('status','=','pending_admin');
            } else if ($type == 'incomplete') {
                $page_title = trans('theme::field.incomplete_ads');
                $my_advs = new AdvModel();
                $my_advs = $my_advs
                    ->select(['id', 'cover_photo', 'slug', 'price', 'currency', 'city', 'country_id', 'cat1', 'cat2', 'status', 'created_at'])
                    ->where('slug','=','')
                    ->where('advs_advs.created_by_id', Auth::id());
            }
        }
        if (!empty($keyword)){
            if (is_numeric($keyword)) {
                $my_advs = $my_advs->where('advs_advs.id', $keyword);
            } else {
                $keywords = explode(' ',$keyword);
                $my_advs = $my_advs->where(function ($query) use ($keywords) {
                    foreach ($keywords as $keyword) {
                        $query->orWhere('slug', 'like', '%' . $keyword . '%')
                            ->orWhere('advs_advs_translations.name', 'like', '%%' . $keyword . '%%');
                    }
                });
            }
        }
        $my_advs = $my_advs->orderByDesc('id');

        if (\request()->paginate === 'true') {
            $my_advs = $advRepository->addAttributes($my_advs->paginate(setting_value('streams::per_page')));
        } else {
            $my_advs = $advRepository->addAttributes($my_advs->get());
        }

        $currencyOptions = $request->currencyOptions ?: [];

        foreach ($my_advs as $ad) {
            $ad->detail_url = $this->adv_model->getAdvDetailLinkByModel($ad, 'list');
            $ad = $this->adv_model->AddAdsDefaultCoverImage($ad);
            $ad->formatted_price = app(Currency::class)->format($ad->price, $ad->currency, $currencyOptions);
            $ad->date = Carbon::create($ad->created_at)->format('d.m.Y');
        }

        return response()->json(['success' => true, 'content' => $my_advs, 'title' => $page_title]);
    }

    public function getAdvsByCat($categoryID, AdvRepositoryInterface $advRepository)
    {
        return $advRepository->getByCat($categoryID);
    }
}