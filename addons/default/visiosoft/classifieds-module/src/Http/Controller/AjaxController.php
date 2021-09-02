<?php namespace Visiosoft\ClassifiedsModule\Http\Controller;

use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Anomaly\Streams\Platform\Support\Currency;
use Anomaly\UsersModule\User\UserModel;
use Visiosoft\ClassifiedsModule\Classified\ClassifiedModel;
use Illuminate\Http\Request;
use Visiosoft\ClassifiedsModule\Classified\Contract\ClassifiedRepositoryInterface;
use Visiosoft\LocationModule\City\CityModel;
use Visiosoft\LocationModule\District\DistrictModel;
use Visiosoft\LocationModule\Neighborhood\NeighborhoodModel;
use Visiosoft\LocationModule\Village\VillageModel;
use Visiosoft\CatsModule\Category\CategoryModel;
use Visiosoft\NotificationsModule\Notify\Notification\SendLoanApplicationMail;

class AjaxController extends PublicController
{
    private $classified_model;
    private $userModel;

    public function __construct(ClassifiedModel $classifiedModel, UserModel $userModel)
    {
        $this->classified_model = $classifiedModel;
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

    public function viewed(ClassifiedModel $classifiedModel, $id)
    {
        $classifiedModel->viewed_Ad($id);
    }

    public function getMyClassifieds(ClassifiedRepositoryInterface $classifiedRepository, Request $request)
    {
        $my_classifieds = new ClassifiedModel();
        $type = $request->type;
        if ($type == 'pending') {
            $page_title = trans('visiosoft.module.classifieds::field.pending_classified.name');
            $my_classifieds = $my_classifieds->pendingClassifiedsByUser();
        } else {
            $page_title = trans('visiosoft.module.classifieds::field.my_classified.name');
            $my_classifieds = $my_classifieds->myClassifiedsByUser();
        }
        $my_classifieds = $my_classifieds->select(['id', 'cover_photo', 'slug', 'price', 'currency', 'city', 'country_id', 'cat1', 'cat2', 'status'])
                           ->orderByDesc('id');

        if (\request()->paginate === 'true') {
            $my_classifieds = $classifiedRepository->addAttributes($my_classifieds->paginate(setting_value('streams::per_page')));
        } else {
            $my_classifieds = $classifiedRepository->addAttributes($my_classifieds->get());
        }

        foreach ($my_classifieds as $index => $classified) {
            $my_classifieds[$index]->detail_url = $this->classified_model->getClassifiedDetailLinkByModel($classified, 'list');
            $my_classifieds[$index] = $this->classified_model->AddClassifiedsDefaultCoverImage($classified);
            $my_classifieds[$index]->formatted_price = app(Currency::class)->format($classified->price, $classified->currency);
        }

        return response()->json(['success' => true, 'content' => $my_classifieds, 'title' => $page_title]);
    }

    public function getClassifiedsByCat($categoryID, ClassifiedRepositoryInterface $classifiedRepository)
    {
        return $classifiedRepository->getByCat($categoryID);
    }
}