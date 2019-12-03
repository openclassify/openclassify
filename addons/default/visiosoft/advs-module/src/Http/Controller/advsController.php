<?php namespace Visiosoft\AdvsModule\Http\Controller;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Anomaly\Streams\Platform\Model\Advs\AdvsAdvsEntryModel;
use Anomaly\Streams\Platform\Model\Advs\PurchasePurchaseEntryModel;
use Anomaly\Streams\Platform\Model\Complaints\ComplaintsComplainTypesEntryModel;
use Anomaly\Streams\Platform\Model\Options\OptionsAdvertisementEntryModel;
use Visiosoft\AdvsModule\Adv\Event\showAdPhone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use function PMA\Util\get;
use Sunra\PhpSimple\HtmlDomParser;
use Visiosoft\AdvsModule\Adv\AdvModel;
use Visiosoft\AdvsModule\Adv\Event\ChangeStatusAd;
use Visiosoft\AdvsModule\Adv\Event\CreateAd;
use Visiosoft\AdvsModule\Adv\Event\EditAd;
use Visiosoft\AdvsModule\Adv\Event\priceChange;
use Visiosoft\AdvsModule\Adv\Event\UpdateAd;
use Visiosoft\AdvsModule\Adv\Event\viewAd;
use Visiosoft\AdvsModule\Adv\Form\AdvFormBuilder;
use Visiosoft\CatsModule\Category\CategoryModel;
use Visiosoft\CommentsModule\Comment\CommentModel;
use Visiosoft\DopingsModule\Doping\DopingModel;
use Visiosoft\LocationModule\City\CityModel;
use Visiosoft\LocationModule\Country\CountryModel;
use Visiosoft\AlgoliaModule\Search\SearchModel;
use Visiosoft\AlgoliatestModule\Http\Controller\Admin\IndexController;
use Visiosoft\CloudinaryModule\Video\VideoModel;
use Visiosoft\CustomfieldsModule\CustomField\CustomFieldModel;
use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Visiosoft\FavsModule\Http\Controller\FavsController;
use Visiosoft\LocationModule\District\DistrictModel;
use Visiosoft\LocationModule\Neighborhood\NeighborhoodModel;
use Visiosoft\LocationModule\Village\VillageModel;
use Visiosoft\PackagesModule\Http\Controller\PackageFEController;
use Anomaly\SelectFieldType\SelectFieldType;
use Visiosoft\AdvsModule\Adv\Contract\AdvRepositoryInterface;
use Visiosoft\CatsModule\Category\Contract\CategoryRepositoryInterface;
use Visiosoft\LocationModule\Country\Contract\CountryRepositoryInterface;
use Anomaly\Streams\Platform\Message\MessageBag;
use Visiosoft\PackagesModule\Package\PackageModel;
use Visiosoft\ProfileModule\Profile\Contract\ProfileRepositoryInterface;
use Visiosoft\ProfileModule\Profile\ProfileModel;

use Anomaly\Streams\Platform\Model\Customfields\CustomfieldsCustomFieldsEntryModel;
use Anomaly\Streams\Platform\Model\Customfields\CustomfieldsCustomFieldAdvsEntryModel;

use Illuminate\Contracts\Events\Dispatcher;
use Visiosoft\QrcontactModule\Qr\QrModel;
use Visiosoft\StoreModule\Ad\AdModel;
use Visiosoft\StoreModule\User\UserModel;


class AdvsController extends PublicController
{
    private $adv_model;
    private $adv_repository;

    private $country_repository;

    private $city_model;

    private $district_model;

    private $neighborhood_model;

    private $village_model;

    private $profile_model;
    private $profile_repository;

    private $category_model;
    private $category_repository;

    private $requestHttp;
    private $settings_repository;
    private $event;

    public function __construct(
        AdvModel $advModel,
        AdvRepositoryInterface $advRepository,

        CountryRepositoryInterface $country_repository,

        CityModel $city_model,

        DistrictModel $district_model,

        NeighborhoodModel $neighborhood_model,

        VillageModel $village_model,

        ProfileModel $profile_model,
        ProfileRepositoryInterface $profile_repository,

        CategoryModel $categoryModel,
        CategoryRepositoryInterface $category_repository,

        SettingRepositoryInterface $settings_repository,

        Dispatcher $events,

        Request $request
    )
    {
        $this->adv_model = $advModel;
        $this->adv_repository = $advRepository;

        $this->country_repository = $country_repository;

        $this->city_model = $city_model;

        $this->district_model = $district_model;

        $this->neighborhood_model = $neighborhood_model;

        $this->village_model = $village_model;


        $this->profile_model = $profile_model;
        $this->profile_repository = $profile_repository;

        $this->category_model = $categoryModel;
        $this->category_repository = $category_repository;

        $this->settings_repository = $settings_repository;

        $this->event = $events;

        $this->requestHttp = $request;

        parent::__construct();
    }


    /**
     * @return \Illuminate\Contracts\View\View|mixed
     */
    public function index()
    {
        $customParameters = array();
        $featured_advs = array();
        $subCats = array();

        $param = $this->requestHttp->toArray();
        if (!isset($param['country'])) {
            if (is_null(Cookie::get('country'))) {
                $param['country'] = setting_value('visiosoft.module.advs::default_country');
            } else {
                $param['country'] = Cookie::get('country');
            }
        } else {
            if ($param['country'] != setting_value('visiosoft.module.advs::default_country')) {
                Cookie::queue(Cookie::make('country', $param['country'], 84000));
            }
        }
        $searchedCountry = $param['country'];

        $countries = $this->country_repository->viewAll();

        $isActiveDopings = $this->adv_model->is_enabled('dopings');

        $isActiveCustomFields = $this->adv_model->is_enabled('customfields');

        $advs = $this->adv_repository->searchAdvs('list', $param, $customParameters);

        $advs = $this->adv_repository->addAttributes($advs);


        if ($isActiveDopings) {
            $dopingModel = new DopingModel();
            $featured_advs = $dopingModel->filterAdvs(2, $advs);

            foreach ($featured_advs as $index => $ad) {
                $featured_advs[$index]->detail_url = $this->adv_model->getAdvDetailLinkByModel($ad, 'list');
                $featured_advs[$index] = $this->adv_model->AddAdsDefaultCoverImage($ad);
            }

            $advs = $dopingModel->reFilterAdvs(2, $advs);
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

        if (isset($param['cat']) and $param['cat'] != "") {
            $cat = $param['cat'];
            $seo_keywords = $this->category_model->getMeta_keywords($param['cat']);
            $seo_description = $this->category_model->getMeta_description($param['cat']);
            $seo_title = $this->category_model->getMeta_title($param['cat']);

            $this->template->set('meta_keywords', implode(',', $seo_keywords));
            $this->template->set('meta_description', $seo_description);
            $this->template->set('meta_title', $seo_title);

            $mainCats = $this->category_model->getParentCats($cat, 'category_ids');
            $subCats = $this->category_repository->getSubCatById($cat);
        } else {
            $cat = null;
            $mainCats = $this->category_repository->mainCats();
        }

        if ($isActiveCustomFields) {
            $returnvalues = app('Visiosoft\CustomfieldsModule\Http\Controller\cfController')->index($mainCats, $subCats);
            $checkboxes = $returnvalues['checkboxes'];
            $textfields = $returnvalues['textfields'];
            $topfields = $returnvalues['topfields'];
            $ranges = $returnvalues['ranges'];
        }

        if (!empty($param['user'])) {
            $user = $this->profile_repository->getUser($param['user']);
            $userProfile = $this->profile_repository->getProfile($user->id);
        }

        $compact = compact('advs', 'countries', 'mainCats', 'subCats', 'textfields', 'checkboxes', 'request',
            'user', 'userProfile', 'featured_advs', 'type', 'topfields', 'ranges', 'seenList', 'searchedCountry');

        Cookie::queue(Cookie::make('last_search', $this->requestHttp->getRequestUri(), 84000));

        $viewType = $this->requestHttp->cookie('viewType');

        if (isset($viewType) and $viewType == 'table')
            return $this->view->make('visiosoft.module.advs::list/table', $compact);
        elseif (isset($viewType) and $viewType == 'map')
            return $this->view->make('visiosoft.module.advs::list/map', $compact);

        return $this->view->make('visiosoft.module.advs::list/list', $compact);
    }

    public function viewType($type)
    {
        Cookie::queue(Cookie::make('viewType', $type, 84000));
        return redirect($this->request->headers->get('referer'));
    }

    public function view($seo, $id = null)
    {
        $id = is_null($id) ? $seo : $id;

        $categories = array();
        $categories_id = array();
        $isActiveComplaints = $this->adv_model->is_enabled('complaints');
        $isCommentActive = $this->adv_model->is_enabled('comments');

        if ($isActiveComplaints) {
            $complaints = ComplaintsComplainTypesEntryModel::all();
        }

        $adv = $this->adv_repository->getListItemAdv($id);

        $recommended_advs = $this->adv_repository->getRecommendedAds($adv->id);

        foreach ($recommended_advs as $index => $ad) {
            $recommended_advs[$index]->detail_url = $this->adv_model->getAdvDetailLinkByModel($ad, 'list');
            $recommended_advs[$index] = $this->adv_model->AddAdsDefaultCoverImage($ad);
        }

        for ($i = 1; $i < 7; $i++) {
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

        if ($this->adv_model->is_enabled('customfields')) {
            $features = app('Visiosoft\CustomfieldsModule\Http\Controller\cfController')->view($adv);
        }

        //Cloudinary Module
        $adv->video_url = null;
        $isActiveCloudinary = $this->adv_model->is_enabled('cloudinary');
        if ($isActiveCloudinary) {

            $CloudinaryModel = new VideoModel();
            $Cloudinary = $CloudinaryModel->getVideo($id);

            if (count($Cloudinary->get()) > 0) {
                $adv->video_url = $Cloudinary->first()->toArray()['url'];
            }
        }

        $profile = $this->profile_model->getProfile($adv->created_by_id)->first();


        if ($isCommentActive) {
            $CommentModel = new CommentModel();
            $comments = $CommentModel->getComments($adv->id)->get();
        }
        $this->event->dispatch(new viewAd($adv));//view ad

        $isActiveqrContact = $this->adv_model->is_enabled('qrcontact');
        if ($isActiveqrContact) {
            $qrModel = new QrModel();
            $qrSRC = $qrModel->source($adv);
        }
        $this->template->set('meta_keywords', implode(',', explode(' ', $adv->name)));
        $this->template->set('meta_description', strip_tags($adv->advs_desc, ''));
        $this->template->set('meta_title', $adv->name . "|" . end($categories)['name']);


        if ($adv->created_by_id == isset(auth()->user()->id) OR $adv->status == "approved") {
            return $this->view->make('visiosoft.module.advs::ad-detail/detail', compact('adv', 'complaints', 'recommended_advs', 'categories', 'features', 'profile', 'comments', 'qrSRC'));
        } else {
            return back();
        }

    }

    public function getLocations()
    {
        $table = $this->requestHttp->table;
        $id = $this->requestHttp->id;
        $db = $this->requestHttp->typeDb;

        $location = "";
        if ($table == "cities") {
            $location = $this->city_model->query()->where($db, $id)->get();
        } elseif ($table == "districts") {
            $location = $this->district_model->query()->whereIn($db, $id)->get();
        } elseif ($table == "neighborhoods") {
            $location = $this->neighborhood_model->query()->where($db, $id)->get();
        } elseif ($table == "village") {
            $location = $this->village_model->query()->where($db, $id)->get();
        }

        return $location;
    }

    public function softDeleteAdv(AdvRepositoryInterface $advs, $id)
    {
        if (!Auth::user()) {
            redirect('/login?redirect=' . url()->current())->send();
        }
        $advs->softDeleteAdv($id);
        return back();
    }

    public function getCats($id)
    {
        return $this->category_repository->getSubCatById($id);
    }

    public function getCatsForNewAd($id)
    {
        $cats = $this->getCats($id);
        $count_user_ads = count($this->adv_model->userAdv()->get());

        if (empty($cats->toArray())) {

            $cats = trans('visiosoft.module.advs::message.create_ad_with_post_cat');

            if (setting_value('visiosoft.module.advs::default_adv_limit') <= $count_user_ads) {
                if ($this->adv_model->is_enabled('packages')) {
                    $packageModel = new PackageModel();
                    $parent_cat = $this->category_model->getParentCats($id, 'parent_id');
                    $package = $packageModel->reduceLimit($parent_cat);
                    if ($package != null) {
                        return $package;
                    }
                } else {
                    $msg = trans('visiosoft.module.advs::message.max_ad_limit');
                    return $msg;
                }
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

    public function store
    (
        AdvFormBuilder $form,
        MessageBag $messages,
        Request $request,
        SettingRepositoryInterface $settings,
        AdvRepositoryInterface $advRepository,
        CategoryRepositoryInterface $categoryRepository,
        Dispatcher $events,
        AdvModel $advModel,
        CategoryModel $categoryModel
    )
    {
        if (!Auth::user()) {
            redirect('/login?redirect=' . url()->current())->send();
        }
        $messages->pull('error');
        $isActiveDopings = $advModel->is_enabled('dopings');
        if ($request->action == "update") {
            $error = $form->build($request->update_id)->validate()->getFormErrors()->getMessages();
            if (!empty($error)) {
                return $this->redirect->back();
            }
            /*  Update Adv  */
            $adv = AdvsAdvsEntryModel::find($request->update_id);

            $count_user_ads = count($this->adv_model->userAdv()->get());

            if (setting_value('visiosoft.module.advs::default_adv_limit') < $count_user_ads) {
                if ($advModel->is_enabled('packages') and $adv->slug == "") {
                    $parent_cat = $categoryModel->getParentCats($request->cat1, 'parent_id');
                    $packageModel = new PackageModel();
                    $package = $packageModel->reduceLimit($parent_cat, 'reduce');
                    if ($package != null)
                        $this->messages->error(trans('visiosoft.module.advs::message.please_buy_package'));

                } else
                    $this->messages->error(trans('visiosoft.module.advs::message.max_ad_limit.title'));

                return redirect('/');
            }

            if ($advModel->is_enabled('store')) {
                $StoreAdModel = new AdModel();
                if ($request->store != "0" and $request->store != null) {
                    $StoreAdModel->createStoreAdLoggedInUser($request->store, $request->update_id);
                } else {
                    $StoreAdModel->removeAdStore($request->update_id);
                }
            }
            $adv->is_get_adv = $request->is_get_adv;
            $adv->save();

            //algolia Search Module
            $isActiveAlgolia = $advModel->is_enabled('algolia');
            if ($isActiveAlgolia) {
                $algolia = new SearchModel();
                if ($adv->slug == "") {
                    $algolia->saveAlgolia($adv->toArray(), $settings);
                } else {
                    $algolia->updateAlgolia($request->toArray(), $settings);
                }
            }
            //Cloudinary Module
            $isActiveCloudinary = $advModel->is_enabled('cloudinary');
            if ($isActiveCloudinary) {

                $CloudinaryModel = new VideoModel();
                $CloudinaryModel->updateRequest($request);

                if ($request->url != "") {
                    $adv->cover_photo = "https://res.cloudinary.com/" . $request->cloudName . "/video/upload/w_400,e_loop/" .
                        $request->uploadKey . "/" . $request->filename . "gif";
                    $adv->save();
                }
            }
            if ($advModel->is_enabled('customfields')) {

                $customField_model = new CustomFieldModel();
                if ($adv->slug == "") {
                    //new ads
                    $jsonVal = [];
                    $id = auth()->user()->id;
                    $adv_id = $advRepository->getLastAd($id);

                    for ($i = 1; $i < 7; $i++) {
                        $cat = 'cat' . $i;
                        if ($request->$cat != 0) {
                            $findcustomfields = $customField_model->getCustomfieldsJoinCategoryWithCategoryID($cat);
                            foreach ($findcustomfields as $findcustomfield) {
                                $cs_name = 'cf__' . $findcustomfield->slug;
                                $cf_id = "cf" . $findcustomfield->id;
                                if ($request->$cs_name) {
                                    $new_cs = new CustomfieldsCustomFieldAdvsEntryModel();
                                    $new_cs->parent_adv_id = $adv_id;
                                    $new_cs->custom_field_category_id = $findcustomfield->id;
                                    $new_cs->custom_field_type = $findcustomfield->type;
                                    if (is_array($request->$cs_name)) {
                                        $new_cs->custom_field_value = implode(',', $request->$cs_name);
                                    } else {
                                        $new_cs->custom_field_value = $request->$cs_name;
                                    }
                                    $jsonVal[$cf_id] = $request->$cs_name;
                                    $new_cs->save();
                                }
                            }
                        }
                    }

                    $findcustomfields = $customField_model->getCustomfieldsJoinCategoryWithCategoryID();
                    foreach ($findcustomfields as $findcustomfield) {
                        $cs_name = 'cf__' . $findcustomfield->slug;
                        $cf_id = "cf" . $findcustomfield->id;
                        if ($request->$cs_name) {
                            $new_cs = new CustomfieldsCustomFieldAdvsEntryModel();
                            $new_cs->parent_adv_id = $adv_id;
                            $new_cs->custom_field_category_id = $findcustomfield->id;
                            $new_cs->custom_field_type = $findcustomfield->type;
                            if (is_array($request->$cs_name)) {
                                $new_cs->custom_field_value = implode(',', $request->$cs_name);
                            } else {
                                $new_cs->custom_field_value = $request->$cs_name;
                            }
                            $jsonVal[$cf_id] = $request->$cs_name;
                            $new_cs->save();
                        }
                    }

                    $adv->cf_json = json_encode($jsonVal);
                    $adv->save();

                } else {
                    //update ads
                    $jsonVal = [];
                    for ($i = 1; $i < 7; $i++) {
                        $cat = 'cat' . $i;
                        if ($request->$cat != 0) {
                            $findcustomfields = $customField_model->getCustomfieldsJoinCategoryWithCategoryID($cat);
                            foreach ($findcustomfields as $findcustomfield) {

                                $cs_name = 'cf__' . $findcustomfield->slug;
                                $cf_id = "cf" . $findcustomfield->id;
                                if ($request->$cs_name) {
                                    $new_cs = CustomfieldsCustomFieldAdvsEntryModel::query()->where('parent_adv_id', $request->update_id)->where('custom_field_category_id', $findcustomfield->id)->first();
                                    if (!$new_cs) {
                                        $new_cs = new CustomfieldsCustomFieldAdvsEntryModel();
                                    }
                                    $new_cs->parent_adv_id = $adv->id;
                                    $new_cs->custom_field_category_id = $findcustomfield->id;
                                    $new_cs->custom_field_type = $findcustomfield->type;
                                    if (is_array($request->$cs_name)) {
                                        $new_cs->custom_field_value = implode(',', $request->$cs_name);
                                    } else {
                                        $new_cs->custom_field_value = $request->$cs_name;
                                    }
                                    $jsonVal[$cf_id] = $request->$cs_name;
                                    $new_cs->save();
                                }
                            }
                        }
                    }
                    $findcustomfields = $customField_model->getCustomfieldsJoinCategoryWithCategoryID();
                    foreach ($findcustomfields as $findcustomfield) {

                        $cs_name = 'cf__' . $findcustomfield->slug;
                        $cf_id = "cf" . $findcustomfield->id;
                        if ($request->$cs_name) {
                            $new_cs = CustomfieldsCustomFieldAdvsEntryModel::query()->where('parent_adv_id', $request->update_id)->where('custom_field_category_id', $findcustomfield->id)->first();
                            if (!$new_cs) {
                                $new_cs = new CustomfieldsCustomFieldAdvsEntryModel();
                            }
                            $new_cs->parent_adv_id = $adv->id;
                            $new_cs->custom_field_category_id = $findcustomfield->id;
                            $new_cs->custom_field_type = $findcustomfield->type;
                            if (is_array($request->$cs_name)) {
                                $new_cs->custom_field_value = implode(',', $request->$cs_name);
                            } else {
                                $new_cs->custom_field_value = $request->$cs_name;
                            }
                            $jsonVal[$cf_id] = $request->$cs_name;
                            $new_cs->save();
                        }
                    }
                    $adv->cf_json = json_encode($jsonVal);
                    $adv->save();

                }
            }


            $form->render($request->update_id);
            $post = $form->getPostData();
            $post['id'] = $request->update_id;
            $events->dispatch(new priceChange($post));//price history
            if ($request->url == "") {
                $LastAdv = $advModel->getLastUserAdv();
                $advRepository->cover_image_update($LastAdv);
            }

            if ($form->hasFormErrors()) {
                $cats = $request->toArray();

                $cats_d = array();

                foreach ($cats as $para => $value) {
                    if (substr($para, 0, 3) === "cat") {
                        $id = $cats[$para];
                        $cat = $categoryRepository->getSingleCat($id);
                        if ($cat != null) {
                            $cats_d[$para] = $cat->name;
                        }
                    }
                }
                return redirect('/advs/edit_advs/' . $request->update_id)->with('cats_d', $cats_d)->with('request', $request);
            }

            $foreign_currencies = new AdvModel();
            $isUpdate = $request->update_id;
            $foreign_currencies->foreignCurrency($request->currency, $request->price, $request->currencies, $isUpdate, $settings);

            if ($adv->slug == "") {
                $events->dispatch(new CreateAd($request->update_id, $settings));//Create Notify
            } else {
                $events->dispatch(new EditAd($request->update_id, $settings));//Update Notify
            }


            if ($isActiveDopings) {
                return redirect(route('add_doping', [$request->update_id]));
            } else {
                return redirect('/advs/adv/' . $request->update_id);
            }
        }

        /* New Create Adv */
        $request->publish_at = date('Y-m-d H:i:s');
        $all = $request->all();
        $new = AdvModel::query()->create($all);
        return redirect('/advs/edit_advs/' . $new->id);
    }

    public function edit
    (
        $id,
        AdvFormBuilder $advFormBuilder,
        AdvRepositoryInterface $advRepository,
        CategoryRepositoryInterface $categoryRepository,
        AdvModel $advModel
    )
    {
        $Field = HTMLDomParser::str_get_html($advFormBuilder->render($id)->getContent());
        $nameField = $Field->find('.name', 0);
        if ($nameField !== null) {
            $nameField = $nameField->innertext();
        } else {
            $nameField = "";
        }

        $descField = $Field->find('.advs_desc', 0);
        if ($descField !== null) {
            $descField = $descField->innertext();
        } else {
            $nameField = "";
        }
        if (!Auth::user()) {
            redirect('/login?redirect=' . url()->current())->send();
        }
        $isActive = new AdvModel();
        $adv = $advRepository->getAdvArray($id);


        if ($adv['created_by_id'] != Auth::id() && !Auth::user()->hasRole('admin')) {
            abort(403);
        }
        $cats_d = array();
        $cat = 'cat';
        $cats = array();

        for ($i = 1; $i < 7; $i++) {
            if ($adv[$cat . $i] != null) {
                $name = $categoryRepository->getSingleCat($adv[$cat . $i]);
                if (!is_null($name)) {
                    $cats_d['cat' . $i] = $name->name;
                    $cats['cat' . $i] = $name->id;
                } else {
                    $this->messages->info(trans('visiosoft.module.advs::message.update_category_info'));
                }

            }
        }

        //Cloudinary Module
        $isActiveCloudinary = new AdvModel();
        $isActiveCloudinary = $isActiveCloudinary->is_enabled('cloudinary');
        if ($isActiveCloudinary) {
            $CloudinaryModel = new VideoModel();
            $Cloudinary = $CloudinaryModel->getVideo($id)->get();

            if (count($Cloudinary) > 0) {
                $Cloudinary = $Cloudinary->first()->toArray();
            }

        }

        $request = $cats;

        $categories = array_keys($cats);

        if ($isActive->is_enabled('customfields')) {
            $custom_fields = app('Visiosoft\CustomfieldsModule\Http\Controller\cfController')->edit($adv, $categories, $cats);
        }

        return $this->view->make('visiosoft.module.advs::new-ad/new-create', compact('id', 'cats_d', 'request', 'Cloudinary', 'cities', 'adv', 'custom_fields', 'nameField', 'descField'));
    }

    public function destroy($id)
    {

        $advs = AdvsAdvsEntryModel::find($id);
        if ($advs->id == auth()->user()->id) {
            return redirect('/advs/my_advs')->with('success', 'Basariyla Silindi');
        } else {
            return "Kendinizin olmayan bir ilani silmeye calisiyorsunuz.";
        }

    }

    public function statusAds($id, $type, SettingRepositoryInterface $settings, Dispatcher $events)
    {
        $ad = $this->adv_model->getAdv($id);
        $auto_approved = $settings->value('visiosoft.module.advs::auto_approve');
        $default_published_time = $settings->value('visiosoft.module.advs::default_published_time');

        if ($auto_approved == true AND $type == 'pending_admin') {
            $type = "approved";
        }
        if ($type == "approved" and $auto_approved != true) {
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
            $algolia->updateStatus($id, $type, $settings);
        }

        $this->adv_model->statusAds($id, $type);
        $events->dispatch(new ChangeStatusAd($id, $settings));//Create Notify
        $this->messages->success(trans('streams::message.edit_success', ['name' => 'Status']));
        return back();
    }

    public function cats()
    {
        if (!Auth::user()) {
            redirect('/login?redirect=' . url()->current())->send();
        }
        $main_cats = $this->category_repository->mainCats();

        return $this->view->make('visiosoft.module.advs::new-ad/post-cat', compact('main_cats'));

    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|mixed
     */
    public function editCategoryForAd($id)
    {
        if (!Auth::user()) {
            redirect('/login?redirect=' . url()->current())->send();
        }

        $is_ad = $this->adv_model->userAdv($id)->find($id);

        if (is_null($is_ad)) {
            abort(403);
        }

        if ($this->requestHttp->action == 'update') {
            $params = $this->requestHttp->all();
            unset($params['action']);

            for ($i = 2; $i <= 7; $i++) {
                if (!isset($params['cat' . $i])) {
                    $params['cat' . $i] = NULL;
                }
            }

            $is_ad->update($params);
            $this->messages->success(trans('visiosoft.module.advs::message.updated_category_msg'));
            return redirect('/advs/edit_advs/' . $id);
        }

        $main_cats = $this->category_repository->mainCats();

        return $this->view->make('visiosoft.module.advs::new-ad/edit-cat', compact('main_cats', 'id'));

    }

    public function login()
    {
        if (auth()->check()) {
            return $this->redirect->to($this->request->get('redirect', '/'));
        }

        $urlPrev = str_replace(url('/'), '', url()->previous());

        return $this->view->make('theme::login', compact('urlPrev'));
    }

    public function register()
    {

        if (auth()->check()) {
            return redirect('/');
        }

        return $this->view->make('theme::register');
    }

    public function passwordForgot()
    {
        if (auth()->check()) {
            return redirect('/');
        }

        return $this->view->make('theme::passwords/forgot');
    }

    public function passwordReset(Request $request)
    {
        if (auth()->check()) {
            return redirect('/');
        }
        $code = $request->email;
        return $this->view->make('theme::passwords/reset', compact('code'));
    }

    public function homePage(CategoryRepositoryInterface $repository)
    {
        $cats = $repository->mainCats();

        return $this->view->make('theme::addons/anomaly/pages-module/page', compact('cats'));
    }

    public function map(AdvRepositoryInterface $advRepository,
                        CategoryRepositoryInterface $categories,
                        CountryRepositoryInterface $countries,
                        ProfileRepositoryInterface $profileRepository,
                        Request $request)
    {

        return $this->index($advRepository, $categories, $countries, $profileRepository, $request, true);

    }

    public function mapJson(Request $request, AdvRepositoryInterface $repository)
    {
        $param = $request->toArray();
        $customParameters = array();
        $advModel = new AdvModel();

        $advs = $repository->searchAdvs('map', $param, $customParameters);
        foreach ($advs as $index => $ad) {
            $advs[$index]->seo_link = $advModel->getAdvDetailLinkByModel($ad, 'list');
            $advs[$index] = $advModel->AddAdsDefaultCoverImage($ad);
        }
        return response()->json($advs);
    }

    public function getAdvsByProfile(AdvRepositoryInterface $advRepository, Request $request)
    {
        $my_advs = new AdvModel();
        $type = $request->type;
        if ($type == 'pending') {
            $page_title = trans('visiosoft.module.advs::field.pending_adv.name');
            $my_advs = $my_advs->pendingAdvsByUser();

        } else if ($type == 'archived') {
            $page_title = trans('visiosoft.module.advs::field.archived_adv.name');
            $my_advs = $my_advs->archivedAdvsByUser();

        } else if ($type == 'favs') {
            //Get Favorites Advs
            $isActiveFavs = new AdvModel();
            $isActiveFavs = $isActiveFavs->is_enabled('favs');

            if ($isActiveFavs) {

                $page_title = trans('visiosoft.module.advs::field.favs_adv.name');
                $favs = new FavsController();
                $favs = $favs->getFavsByProfile();

                $fav_ids = array();
                foreach ($favs as $fav) {
                    $fav_ids[] = $fav['adv_name_id'];//fav advs id List
                }
                $my_advs = $my_advs->favsAdvsByUser($fav_ids);
            }
        } else {
            $page_title = trans('visiosoft.module.advs::field.my_adv.name');
            $my_advs = $my_advs->myAdvsByUser();

        }
        $my_advs = $my_advs->orderByDesc('id');
        $my_advs = $advRepository->addAttributes($my_advs->get());
        $files = array();
        foreach ($my_advs as $my_adv) {
            $files[] = $my_adv->files;
        }
        return response()->json(['success' => true, 'content' => $my_advs, 'files' => $files, 'title' => $page_title]);
    }

    public function authCheck()
    {
        if (auth()->check()) {
            return auth()->user();
        }

        return "false";
    }

    public function isActive($slug)
    {
        $query = new AdvModel();

        return $query->is_enabled($slug);
    }

    public function isActiveJson($slug)
    {
        $isActive = $this->isActive($slug);
        return response()->json(array('isActive' => $isActive));
    }

    public function checkParentCat($id)
    {
        $option = new CategoryModel();
        return $option->getParentCats($id);
    }

    public function checkUser()
    {
        if (Auth::check()) {
            return response()->json([
                'success' => true,
            ]);
        } else {
            return response()->json([
                'success' => false,
            ]);
        }
    }

    public function advAddCart($id, $quantity = 1)
    {
        $thisModel = new AdvModel();
        $adv = $thisModel->isAdv($id);
        $response = array();
        if ($adv) {
            $cart = $thisModel->addCart($adv, $quantity);
            $response['status'] = "success";
        } else {
            $response['status'] = "error";
            $response['msg'] = trans('visiosoft.module.advs::message.error_added_cart');
        }
        return back();
    }

    public function addCart(Request $request)
    {
        $id = $request->id;
        $quantity = $request->quantity;
        $thisModel = new AdvModel();
        $adv = $thisModel->isAdv($id);
        $response = array();
        if ($adv) {
            $cart = $thisModel->addCart($adv, $quantity);
            $response['status'] = "success";
        } else {
            $response['status'] = "error";
            $response['msg'] = trans('visiosoft.module.advs::message.error_added_cart');
        }
        return $response;
    }

    public function stockControl(Request $request, AdvRepositoryInterface $advRepository)
    {
        $quantity = $request->quantity;
        $id = $request->id;
        $type = $request->type;
        $advmodel = new AdvModel();
        $adv = $advmodel->getAdv($id);

        $status = $advmodel->stockControl($id, $quantity);

        $response = array();
        if ($status == "true") {
            $response['newQuantity'] = $advRepository->getQuantity($quantity, $type, $adv);

        } else {
            $response['newQuantity'] = $adv->stock;
        }
        $response['status'] = $status;
        $response['newPrice'] = $adv->price * $response['newQuantity'];
        $response['maxQuantity'] = $adv->stock;
        return $response;
    }

    public function showPhoneCounter(Request $request, AdvModel $advModel, Dispatcher $events)
    {
        $ad_id = $request->id;
        $ad = $advModel->getAdv($ad_id);

        if ($advModel->is_enabled('phoneclickcounter')) {
            $events->dispatch(new showAdPhone($ad));//show ad phone events
        }
        return "success";
    }

}
