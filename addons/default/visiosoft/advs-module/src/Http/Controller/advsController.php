<?php namespace Visiosoft\AdvsModule\Http\Controller;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Anomaly\Streams\Platform\Model\Advs\AdvsAdvsEntryModel;
use Anomaly\Streams\Platform\Model\Complaints\ComplaintsComplainTypesEntryModel;
use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;
use Visiosoft\AdvsModule\Adv\Command\appendRequestURL;
use Visiosoft\AdvsModule\Adv\Event\ChangedStatusAd;
use Visiosoft\AdvsModule\Adv\Event\CreatedAd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Visiosoft\AdvsModule\Option\Contract\OptionRepositoryInterface;
use Visiosoft\LocationModule\City\CityRepository;
use Visiosoft\ProfileModule\Adress\Contract\AdressRepositoryInterface;
use Visiosoft\AdvsModule\Adv\AdvModel;
use Visiosoft\AdvsModule\Adv\Event\priceChange;
use Visiosoft\AdvsModule\Adv\Event\viewAd;
use Visiosoft\AdvsModule\Adv\Form\AdvFormBuilder;
use Visiosoft\CatsModule\Category\CategoryModel;
use Visiosoft\CommentsModule\Comment\CommentModel;
use Visiosoft\LocationModule\City\CityModel;
use Visiosoft\AlgoliaModule\Search\SearchModel;
use Visiosoft\AlgoliatestModule\Http\Controller\Admin\IndexController;
use Visiosoft\CloudinaryModule\Video\VideoModel;
use Visiosoft\LocationModule\District\DistrictModel;
use Visiosoft\LocationModule\Neighborhood\NeighborhoodModel;
use Visiosoft\LocationModule\Village\VillageModel;
use Visiosoft\AdvsModule\Adv\Contract\AdvRepositoryInterface;
use Visiosoft\CatsModule\Category\Contract\CategoryRepositoryInterface;
use Visiosoft\LocationModule\Country\Contract\CountryRepositoryInterface;
use Anomaly\Streams\Platform\Message\MessageBag;
use Visiosoft\PackagesModule\Package\PackageModel;
use Illuminate\Contracts\Events\Dispatcher;
use Visiosoft\QrcontactModule\Qr\QrModel;
use Visiosoft\StoreModule\Ad\AdModel;

class AdvsController extends PublicController
{
    private $userRepository;

    private $adv_model;
    private $adv_repository;

    private $country_repository;

    private $city_model;
    private $cityRepository;

    private $district_model;

    private $neighborhood_model;

    private $village_model;

    private $category_model;
    private $category_repository;

    private $requestHttp;
    private $settings_repository;
    private $event;

    private $optionRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,

        AdvModel $advModel,
        AdvRepositoryInterface $advRepository,

        CountryRepositoryInterface $country_repository,

        CityModel $city_model,
        CityRepository $cityRepository,

        DistrictModel $district_model,

        NeighborhoodModel $neighborhood_model,

        VillageModel $village_model,

        CategoryModel $categoryModel,
        CategoryRepositoryInterface $category_repository,

        OptionRepositoryInterface $optionRepository,

        SettingRepositoryInterface $settings_repository,

        Dispatcher $events,

        Request $request
    )
    {
        parent::__construct();

        $this->userRepository = $userRepository;

        $this->adv_model = $advModel;
        $this->adv_repository = $advRepository;

        $this->country_repository = $country_repository;

        $this->city_model = $city_model;
        $this->cityRepository = $cityRepository;

        $this->district_model = $district_model;

        $this->neighborhood_model = $neighborhood_model;

        $this->village_model = $village_model;

        $this->category_model = $categoryModel;
        $this->category_repository = $category_repository;

        $this->settings_repository = $settings_repository;

        $this->event = $events;

        $this->requestHttp = $request;

        $this->optionRepository = $optionRepository;
    }

    public function index($category = null, $city = null)
    {
        $customParameters = array();
        $featured_advs = array();
        $subCats = array();

        $param = $this->requestHttp->toArray();

        $countries = $this->country_repository->viewAll();

        $isActiveDopings = $this->adv_model->is_enabled('dopings');

        // Search by category slug
        $categoryId = null;
        if ($category) { // Slug
            $categoryId = $this->category_repository->findBy('slug', $category);
            if (!$categoryId) {
                $this->messages->error(trans('visiosoft.module.advs::message.category_not_exist'));
                return redirect('/');
            }
            if (isset($param['cat'])) {
                unset($param['cat']);
                return redirect($this->fullLink(
                    $param,
                    route('adv_list_seo', [$categoryId->slug]),
                    array()
                ));
            }
        } elseif (isset($param['cat']) && !empty($param['cat'])) { // Only Param
            $categoryId = $this->category_repository->find($param['cat']);
            if (!$categoryId) {
                $this->messages->error(trans('visiosoft.module.advs::message.category_not_exist'));
                return redirect('/');
            }
            unset($param['cat']);
            return redirect($this->fullLink(
                $param,
                route('adv_list_seo', [$categoryId->slug]),
                array()
            ));
        }

        // Search by city slug
        $cityId = null;
        if ($category) {
            $isOneCity = isset($param['city'][0])
                && !empty($param['city'][0])
                && strpos($param['city'][0], ',') === false;
            $isMultipleCity = isset($param['city'][0])
                && !empty($param['city'][0])
                && strpos($param['city'][0], ',') !== false;

            if (is_null($city) && $isOneCity) { // Param and no slug
                $cityId = $this->cityRepository->find($param['city'][0]);
                unset($param['city']);
                return redirect($this->fullLink(
                    $param,
                    route('adv_list_seo', [$categoryId->slug, $cityId->slug]),
                    array()
                ));
            } elseif ($isOneCity) { // Param and slug
                $cityId = $this->cityRepository->find($param['city'][0]);
                if ($city !== $cityId->slug) {
                    unset($param['city']);
                    return redirect($this->fullLink(
                        $param,
                        route('adv_list_seo', [$categoryId->slug, $cityId->slug]),
                        array()
                    ));
                }
            } elseif ($city && $isMultipleCity) { // Slug and multiple param cities
                return redirect($this->fullLink(
                    $param,
                    route('adv_list_seo', [$categoryId->slug]),
                    array()
                ));
            } elseif ($city) {
                if (isset($param['city'][0]) && empty($param['city'][0])) { // Slug and empty param
                    unset($param['city']);
                    return redirect($this->fullLink(
                        $param,
                        route('adv_list_seo', [$categoryId->slug]),
                        array()
                    ));
                } else { // Only slug
                    $cityId = $this->cityRepository->findBy('slug', $city);
                }
            }
        }

        $isActiveCustomFields = $this->adv_model->is_enabled('customfields');
        $advs = $this->adv_repository->searchAdvs('list', $param, $customParameters, null, $categoryId, $cityId);
        $advs = $this->adv_repository->addAttributes($advs);

        if ($isActiveDopings and $param != null) {
            $featured_advs = app('Visiosoft\DopingsModule\Http\Controller\DopingsController')->listFeatures($advs);
        }

        foreach ($advs as $index => $ad) {
            $advs[$index]->detail_url = $this->adv_model->getAdvDetailLinkByModel($ad, 'list');
            $advs[$index] = $this->adv_model->AddAdsDefaultCoverImage($ad);

            if ($isActiveCustomFields && isset($param['cat']) and $param['cat'] != "") {
                $rtnvalues = app('Visiosoft\CustomfieldsModule\Http\Controller\cfController')
                    ->indexseen($ad, $param['cat'], $advs, $index);
                $advs = $rtnvalues['advs'];
                $seenList = $rtnvalues['seenList'];
            }
        }


        if ($categoryId) {
            $seo_keywords = $this->category_model->getMeta_keywords($categoryId->id);
            $seo_description = $this->category_model->getMeta_description($categoryId->id);
            $seo_title = $this->category_model->getMeta_title($categoryId->id);

            $this->template->set('og_description', $seo_description);
            $this->template->set('meta_description', $seo_description);
            $this->template->set('meta_title', $seo_title);
            $this->template->set('meta_keywords', implode(', ', $seo_keywords));

            $mainCats = $this->category_model->getMains($categoryId->id);
            $current_cat = $this->category_model->getCat($categoryId->id);
            $mainCats[] = [
                'id' => $current_cat->id,
                'val' => $current_cat->name,
                'slug' => $current_cat->slug,
            ];
            $subCats = $this->category_repository->getSubCatById($categoryId->id);
        } else {
            $mainCats = $this->category_repository->mainCats();
            $allCats = true;
        }

        if ($isActiveCustomFields) {
            $returnvalues = app('Visiosoft\CustomfieldsModule\Http\Controller\cfController')->index($mainCats, $subCats);
            $checkboxes = $returnvalues['checkboxes'];
            $topfields = $returnvalues['topfields'];
            $selectDropdown = $returnvalues['selectDropdown'];
            $selectRange = $returnvalues['selectRange'];
            $selectImage = $returnvalues['selectImage'];
            $ranges = $returnvalues['ranges'];
            $radio = $returnvalues['radio'];
        }

        Cookie::queue(Cookie::make('last_search', $this->requestHttp->getRequestUri(), 84000));

        $viewType = $this->requestHttp->cookie('viewType');

        if (!isset($allCats)) {
            if (count($mainCats) == 1 || count($mainCats) == 2) {
                $catText = end($mainCats)['val'];
            } elseif (count($mainCats) > 2) {
                $catArray = array_slice($mainCats, 2);
                $catText = '';
                $loop = 0;
                foreach ($catArray as $cat) {
                    $catText = !$loop ? $catText . $cat['val'] : $catText . ' ' . $cat['val'];
                    $loop++;
                }
            }
            $this->template->set('showTitle', false);
            $this->template->set('meta_title', $catText);
        }

        if (!empty($param['user'])) {
            $user = $this->userRepository->find($param['user']);
            $this->template->set('showTitle', false);
            $this->template->set('meta_title', $user->name() . ' ' . trans('visiosoft.module.advs::field.ads'));
        }

        $compact = compact('advs', 'countries', 'mainCats', 'subCats', 'checkboxes', 'request', 'param',
            'user', 'featured_advs', 'viewType', 'topfields', 'selectDropdown', 'selectRange', 'selectImage', 'ranges',
            'seenList', 'searchedCountry', 'radio', 'categoryId', 'cityId', 'allCats', 'catText');

        return $this->viewTypeBasedRedirect($viewType, $compact);
    }

    public function fullLink($request, $url, $newParameters)
    {
        return $this->dispatch(new appendRequestURL($request, $url, $newParameters));
    }

    public function viewTypeBasedRedirect($viewType, $compact)
    {
        if (!$viewType) {
            $viewType = setting_value('visiosoft.module.advs::default_view_type');
        }
        if (isset($viewType) and $viewType == 'table') {
            return $this->view->make('visiosoft.module.advs::list/table', $compact);
        } elseif (isset($viewType) and $viewType == 'map') {
            return $this->view->make('visiosoft.module.advs::list/map', $compact);
        } elseif (isset($viewType) and $viewType == 'gallery') {
            return $this->view->make('visiosoft.module.advs::list/gallery', $compact);
        } else {
            return $this->view->make('visiosoft.module.advs::list/list', $compact);
        }
    }

    public function viewType($type)
    {
        Cookie::queue(Cookie::make('viewType', $type, 84000));
        return redirect($this->request->headers->get('referer') ?: route('visiosoft.module.advs::list'));
    }

    public function view($seo, $id = null)
    {
        $id = is_null($id) ? $seo : $id;

        $adv = $this->adv_repository->getListItemAdv($id);

        if ($adv) {

            if ($this->adv_model->is_enabled('complaints')) {
                $complaints = ComplaintsComplainTypesEntryModel::all();
            }

            $recommended_advs = $this->adv_repository->getRecommendedAds($adv->id);

            foreach ($recommended_advs as $index => $ad) {
                $recommended_advs[$index]->detail_url = $this->adv_model->getAdvDetailLinkByModel($ad, 'list');
                $recommended_advs[$index] = $this->adv_model->AddAdsDefaultCoverImage($ad);
            }

            $categories = array();
            $categories_id = array();
            for ($i = 1; $i <= 10; $i++) {
                $cat = "cat" . $i;
                if ($adv->$cat != null) {
                    $item = $this->category_repository->getItem($adv->$cat);
                    if (!is_null($item)) {
                        $categories['cat' . $i] = [
                            'name' => $item->name,
                            'id' => $item->id,
                            'slug' => $item->slug
                        ];
                        $categories_id[] = $item->id;
                    }

                }
            }

            if ($this->adv_model->is_enabled('customfields')) {
                $features = app('Visiosoft\CustomfieldsModule\Http\Controller\cfController')->view($adv);
            }

            //Cloudinary Module
            $adv->video_url = null;
            if ($this->adv_model->is_enabled('cloudinary')) {

                $CloudinaryModel = new VideoModel();
                $Cloudinary = $CloudinaryModel->getVideo($id);

                if (count($Cloudinary->get()) > 0) {
                    $adv->video_url = $Cloudinary->first()->toArray()['url'];
                }
            }

            $options = $this->optionRepository->findAllBy('adv_id', $id);

            if ($this->adv_model->is_enabled('comments')) {
                $CommentModel = new CommentModel();
                $comments = $CommentModel->getComments($adv->id)->get();
            }
            $this->event->dispatch(new viewAd($adv));//view ad

            $this->template->set('meta_keywords', implode(',', explode(' ', $adv->name)));
            $this->template->set('meta_description', strip_tags($adv->advs_desc, ''));
            $this->template->set('showTitle', false);
            $this->template->set(
                'meta_title',
                $adv->name . " " . end($categories)['name'] . ' ' . setting_value('streams::domain')
            );
            if (substr($adv->cover_photo, 0, 4) === "http") {
                $coverPhoto = $adv->cover_photo;
            } else {
                if (substr($adv->cover_photo, 0, 1) === "/") {
                    $coverPhoto = \Illuminate\Support\Facades\Request::root() . $adv->cover_photo;
                } else {
                    $coverPhoto = \Illuminate\Support\Facades\Request::root() . '/' . $adv->cover_photo;
                }
            }
            $this->template->set('meta_image', $coverPhoto);

            if ($adv->created_by_id == isset(auth()->user()->id) OR $adv->status == "approved") {
                return $this->view->make('visiosoft.module.advs::ad-detail/detail', compact('adv', 'complaints',
                    'recommended_advs', 'categories', 'features', 'comments', 'qrSRC', 'options'));
            } else {
                return back();
            }
        } else {
            $this->messages->error(trans('visiosoft.module.advs::message.ad_doesnt_exist'));
            return redirect()->route('visiosoft.module.advs::list');
        }
    }

    public function preview($id)
    {
        $categories = array();
        $categories_id = array();

        $adv = $this->adv_repository->getListItemAdv($id);

        for ($i = 1; $i <= 10; $i++) {
            $cat = "cat" . $i;
            if ($adv->$cat != null) {
                $item = $this->category_repository->getItem($adv->$cat);
                if (!is_null($item)) {
                    $categories['cat' . $i] = [
                        'name' => $item->name,
                        'id' => $item->id
                    ];
                    $categories_id[] = $item->id;
                }

            }
        }

        $options = $this->optionRepository->findAllBy('adv_id', $id);

        if ($this->adv_model->is_enabled('customfields')) {
            $features = app('Visiosoft\CustomfieldsModule\Http\Controller\cfController')->view($adv);
        }

        $isActiveDopings = $this->adv_model->is_enabled('dopings');

        return $this->view->make('visiosoft.module.advs::new-ad/preview/preview',
            compact('adv', 'categories', 'features', 'isActiveDopings', 'options'));
    }

    public function deleteAd(AdvRepositoryInterface $advs, $id)
    {
        $ad = $this->adv_model->find($id);
        if (!Auth::user()) {
            redirect('/login?redirect=' . url()->current())->send();
        }

        if ($ad->created_by_id != Auth::id()) {
            $this->messages->error(trans('visiosoft.module.advs::message.delete_author_error'));
        }

        $advs->softDeleteAdv($id);
        $this->messages->error(trans('visiosoft.module.advs::message.success_delete'));
        return back();
    }

    public function getCatsForNewAd($id)
    {
        if ($this->adv_model->is_enabled('packages')) {
            $cats = app('Visiosoft\PackagesModule\Http\Controller\PackageFEController')->AdLimitForCategorySelection($id);
        } else {
            $cats = $this->category_repository->getSubCatById($id);

            if (empty($cats->toArray())) {
                $cats = trans('visiosoft.module.advs::message.create_ad_with_post_cat');
            }
        }
        return $cats;
    }

    public function create(Request $request, AdvFormBuilder $formBuilder, CategoryRepositoryInterface $repository)
    {
        if (!Auth::user()) {
            redirect('/login?redirect=' . url()->current())->send();
        }

        $isActive = new AdvModel();
        $cats = $request->toArray();
        unset($cats['_token']);

        $end = count($cats);
        $cats_d = array();
        $categories = array_keys($cats);


        for ($i = 0; $i < $end; $i++) {
            $plus1 = $i + 1;

            $cat = $repository->getSingleCat($cats['cat' . $plus1]);
            $cats_d['cat' . $plus1] = $cat->name;
        }
        if ($isActive->is_enabled('customfields')) {
            $custom_fields = app('Visiosoft\CustomfieldsModule\Http\Controller\cfController')->create($categories);
        }
        //Cloudinary Module
        return $this->view->make('visiosoft.module.advs::new-ad/new-create', compact(
            'request', 'formBuilder', 'cats_d', 'custom_fields'));
    }

    public function store(
        AdvFormBuilder $form,
        MessageBag $messages,
        AdressRepositoryInterface $address
    )
    {
        $messages->pull('error');
        if (\request()->action == "update") {
            $error = $form->build(\request()->update_id)->validate()->getFormErrors()->getMessages();
            if (!empty($error)) {
                return $this->redirect->back();
            }
            /*  Update Adv  */
            $adv = AdvsAdvsEntryModel::find(\request()->update_id);

            if ($this->adv_repository->getModel()->is_enabled('packages') and $adv->slug == "") {
                $cat = app('Visiosoft\PackagesModule\Http\Controller\PackageFEController')->AdLimitForNewAd(\request());
                if (!is_null($cat)) {
                    return redirect('/');
                }
            }

            // Create options
            $deletedOptions = \request()->deleted_options;
            $newOptions = \request()->new_options;
            if (!empty($deletedOptions)) {
                $deletedOptions = explode(',', \request()->deleted_options);
                $this->optionRepository->newQuery()
                    ->whereIn('id', $deletedOptions)
                    ->where('adv_id', \request()->update_id)
                    ->delete();
            }
            if (!empty($newOptions)) {
                $newOptions = explode(',', \request()->new_options);
                foreach ($newOptions as $option) {
                    $this->optionRepository->create([
                        'name' => $option,
                        'adv_id' => \request()->update_id,
                    ]);
                }
            }

            $adv->is_get_adv = \request()->is_get_adv;
            $adv->save();

            //algolia Search Module
            $isActiveAlgolia = $this->adv_repository->getModel()->is_enabled('algolia');
            if ($isActiveAlgolia) {
                $algolia = new SearchModel();
                if ($adv->slug == "") {
                    $algolia->saveAlgolia($adv->toArray());
                } else {
                    $algolia->updateAlgolia(\request()->toArray());
                }
            }
            //Cloudinary Module
            $isActiveCloudinary = $this->adv_repository->getModel()->is_enabled('cloudinary');
            if ($isActiveCloudinary) {

                $CloudinaryModel = new VideoModel();
                $CloudinaryModel->updateRequest(\request());

                if (\request()->url != "") {
                    $adv->cover_photo = "https://res.cloudinary.com/" . \request()->cloudName . "/video/upload/w_400,e_loop/" .
                        \request()->uploadKey . "/" . \request()->filename . "gif";
                    $adv->save();
                }
            }
            if ($this->adv_model->is_enabled('customfields')) {
                app('Visiosoft\CustomfieldsModule\Http\Controller\cfController')->store($adv, \request());
            }

            // Auto approve
            if (setting_value('visiosoft.module.advs::auto_approve')) {
                $defaultAdPublishTime = setting_value('visiosoft.module.advs::default_published_time');
                $adv->update([
                    'status' => 'approved',
                    'finish_at' => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' + ' . $defaultAdPublishTime . ' day')),
                    'publish_at' => date('Y-m-d H:i:s')
                ]);
            }

            $form->render(\request()->update_id);
            $adv = $this->adv_repository->find(\request()->update_id);

            if ($this->request->address_id != "") {
                $address = $address->find($this->request->address_id);
                $adv->country_id = $address->country_id;
                $adv->city = $address->city;
                $adv->district = $address->district;
                $adv->neighborhood = null;
                $adv->village = null;
                $adv->save();
            }
            $post = $form->getPostData();
            $post['id'] = \request()->update_id;
            event(new priceChange($post));
            if (\request()->url == "") {
                $this->adv_repository->cover_image_update($adv);
            }

            if ($form->hasFormErrors()) {
                $cats = \request()->toArray();

                $cats_d = array();

                foreach ($cats as $para => $value) {
                    if (substr($para, 0, 3) === "cat") {
                        $id = $cats[$para];
                        $cat = $this->category_repository->getSingleCat($id);
                        if ($cat != null) {
                            $cats_d[$para] = $cat->name;
                        }
                    }
                }
                return redirect('/advs/edit_advs/' . \request()->update_id)->with('cats_d', $cats_d)->with('request', \request());
            }
            event(new CreatedAd($adv));
            return redirect(route('advs_preview', [\request()->update_id]));
        }

        /* New Create Adv */
        \request()->publish_at = date('Y-m-d H:i:s');
        $all = \request()->all();
        $new = AdvModel::query()->create($all);
        return redirect('/advs/edit_advs/' . $new->id);
    }

    public function edit($id)
    {
        $adv = $this->adv_repository->find($id);

        if (is_null($adv)) {
            $this->messages->error(trans('visiosoft.module.advs::message.no_add_found'));
            return $this->redirect->to(route('advs::create_adv'));
        }

        $adv = $adv->toArray();

        if ($adv['created_by_id'] != auth()->id()
            && !auth()->user()->hasPermission('visiosoft.module.advs::advs.write')) {
            abort(403);
        }
        $cats_d = array();
        $cat = 'cat';
        $cats = array();

        for ($i = 1; $i <= 10; $i++) {
            if ($adv[$cat . $i]) {
                $name = $this->category_repository->getSingleCat($adv[$cat . $i]);
                if ($name) {
                    $cats_d['cat' . $i] = $name->name;
                    $cats['cat' . $i] = $name->id;
                } else {
                    $this->messages->info(trans('visiosoft.module.advs::message.update_category_info'));
                }

            }
        }

        $options = $this->optionRepository->findAllBy('adv_id', $id);

        //Cloudinary Module
        $isActiveCloudinary = $this->adv_model->is_enabled('cloudinary');
        if ($isActiveCloudinary) {
            $CloudinaryModel = new VideoModel();
            $Cloudinary = $CloudinaryModel->getVideo($id)->get();

            if (count($Cloudinary) > 0) {
                $Cloudinary = $Cloudinary->first()->toArray();
            }
        }

        $categories = array_keys($cats);

        if ($this->adv_model->is_enabled('customfields')) {
            $custom_fields = app('Visiosoft\CustomfieldsModule\Http\Controller\cfController')
                ->edit($adv, $categories, $cats);
        }

        return $this->view->make(
            'visiosoft.module.advs::new-ad/new-create',
            compact('id', 'cats_d', 'cats', 'Cloudinary', 'cities', 'adv', 'custom_fields', 'options')
        );
    }

    public function statusAds($id, $type)
    {
        $ad = $this->adv_model->getAdv($id);
        $auto_approved = setting_value('visiosoft.module.advs::auto_approve');
        $default_published_time = setting_value('visiosoft.module.advs::default_published_time');

        if ($type == 'pending_admin' && $auto_approved == true) {
            $type = "approved";
        } elseif ($type == "approved" && $auto_approved != true) {
            $type = "pending_admin";
        }

        if ($type == "approved") {
            $this->adv_model->publish_at_Ads($id);
            if ($ad->finish_at == NULL AND $type == "approved") {
                if ($this->adv_model->is_enabled('packages')) {
                    $packageModel = new PackageModel();
                    $published_time = $packageModel->reduceTimeLimit($ad->cat1);
                    if ($published_time != null) {
                        $default_published_time = $published_time;
                    }
                }
                $this->adv_model->finish_at_Ads($id, $default_published_time);
            }
        }

        $isActiveAlgolia = $this->adv_model->is_enabled('algolia');
        if ($isActiveAlgolia) {
            $algolia = new SearchModel();
            $algolia->updateStatus($id, $type);
        }

        $this->adv_model->statusAds($id, $type);

        event(new ChangedStatusAd($ad));

        $this->messages->success(trans('streams::message.edit_success', ['name' => 'Status']));
        return back();
    }

    public function cats()
    {
        $mainCats = $this->category_repository->mainCats();

        return $this->view->make('visiosoft.module.advs::new-ad/post-cat', compact('mainCats'));
    }

    public function editCategoryForAd($id)
    {
        $adv = $this->adv_model->userAdv(true)->find($id);

        if (!$adv) {
            abort(403);
        }

        if (\request()->action == 'update') {
            $params = \request()->all();
            unset($params['action']);

            for ($i = 2; $i <= 10; $i++) {
                if (!isset($params['cat' . $i])) {
                    $params['cat' . $i] = null;
                }
            }

            $adv->update($params);
            $this->messages->success(trans('visiosoft.module.advs::message.updated_category_msg'));
            return redirect()->route('visiosoft.module.advs::edit_adv', [$id]);
        }

        $categories = $this->adv_repository->getCategoriesWithAdID($id);

        return $this->view->make(
            'visiosoft.module.advs::new-ad/edit-cat',
            compact('id', 'adv', 'categories')
        );
    }

    public function mapJson()
    {
        $param = \request()->toArray();
        $customParameters = array();

        $advs = $this->adv_repository->searchAdvs('map', $param, $customParameters);
        foreach ($advs as $index => $ad) {
            $advs[$index]->seo_link = $this->adv_repository->getModel()->getAdvDetailLinkByModel($ad, 'list');
            $advs[$index] = $this->adv_repository->getModel()->AddAdsDefaultCoverImage($ad);
        }
        return response()->json($advs);
    }

    public function extendAll($isAdmin = null)
    {
        $adsExtended = $this->adv_repository->extendAds(true, $isAdmin);
        $this->messages->success(trans('visiosoft.module.advs::message.extended', ['number' => $adsExtended]));
        return $this->redirect->back();
    }

    public function extendSingle($adId)
    {
        $adsExtended = $this->adv_repository->extendAds($adId);
        $this->messages->success(trans('visiosoft.module.advs::message.extended', ['number' => $adsExtended]));
        return $this->redirect->back();
    }
}