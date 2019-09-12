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


    public function index(AdvRepositoryInterface $advRepository,
                          CategoryRepositoryInterface $categories,
                          CountryRepositoryInterface $countries,
                          ProfileRepositoryInterface $profileRepository,
                          Request $request)
    {
        $customParameters = array();
        $param = $request->toArray();
        $advmodel = new AdvModel();
        $isActiveDopings = $advmodel->is_enabled('dopings');
        $isActiveCustomFields = $advmodel->is_enabled('customfields');
        // AdvRepository
        $advs = $advRepository->searchAdvs('list', $param, $customParameters);

        $advs = $advRepository->addAttributes($advs);

        $featured_advs = [];
        if ($isActiveDopings) {
            $dopingModel = new DopingModel();
            $featured_advs = $dopingModel->filterAdvs(2, $advs);
            foreach ($featured_advs as $index => $ad) {
                $featured_advs[$index]->detail_url = $advmodel->getAdvDetailLinkByModel($ad, 'list');
                $featured_advs[$index] = $advmodel->AddAdsDefaultCoverImage($ad);
            }
            $advs = $dopingModel->reFilterAdvs(2, $advs);
        }
        foreach ($advs as $index => $ad) {
            $advs[$index]->detail_url = $advmodel->getAdvDetailLinkByModel($ad, 'list');
            $advs[$index] = $advmodel->AddAdsDefaultCoverImage($ad);
            if ($isActiveCustomFields && isset($param['cat']) and $param['cat'] != "") {
                $rtnvalues = app('Visiosoft\CustomfieldsModule\Http\Controller\cfController')->indexseen($ad, $param['cat'], $advs, $index);
                $advs = $rtnvalues['advs'];
                $seenList = $rtnvalues['seenList'];
            }
        }
        $countries = $countries->viewAll();

        $subCats = [];
        if (isset($param['cat']) and $param['cat'] != "") {
            $cat = $param['cat'];
            $mainCats = new CategoryModel();

            $seo_keywords = $mainCats->getMeta_keywords($param['cat']);
            $seo_description = $mainCats->getMeta_description($param['cat']);
            $seo_title = $mainCats->getMeta_title($param['cat']);

            $this->template->set('meta_keywords', implode(',', $seo_keywords));
            $this->template->set('meta_description', $seo_description);
            $this->template->set('meta_title', $seo_title);

            $mainCats = $mainCats->getParentCats($cat, 'category_ids');
            $subCats = $categories->getSubCatById($cat);
        } else {
            $cat = null;
            $mainCats = $categories->mainCats();
        }

        if ($isActiveCustomFields) {
            $returnvalues = app('Visiosoft\CustomfieldsModule\Http\Controller\cfController')->index($mainCats, $subCats);
            $checkboxes = $returnvalues['checkboxes'];
            $textfields = $returnvalues['textfields'];
            $topfields = $returnvalues['topfields'];
            $ranges = $returnvalues['ranges'];
        }

        if (!empty($param['user'])) {
            $user = $profileRepository->getUser($param['user']);
            $userProfile = $profileRepository->getProfile($user->id);
        }
        $compact = compact('advs', 'countries', 'mainCats', 'subCats', 'textfields', 'checkboxes', 'request',
            'user', 'userProfile', 'featured_advs', 'type', 'topfields', 'ranges', 'seenList');

        Cookie::queue(Cookie::make('last_search', $request->getRequestUri(), 84000));

        $viewType = $request->cookie('viewType');
        if (isset($viewType) and $viewType == 'table') {
            return $this->view->make('visiosoft.module.advs::advs/table', $compact);
        } elseif (isset($viewType) and $viewType == 'map') {
            return $this->view->make('visiosoft.module.advs::advs/map', $compact);
        }
        return $this->view->make('visiosoft.module.advs::advs/list', $compact);
    }

    public function viewType($type)
    {
        Cookie::queue(Cookie::make('viewType', $type, 84000));
        return redirect($this->request->headers->get('referer'));
    }

    public function view
    (
        $id,
        CategoryRepositoryInterface $categoryRepository,
        Dispatcher $events,
        AdvRepositoryInterface $advRepository,
        AdvModel $advModel
    )
    {
        $isActive = new AdvModel();
        $isActiveComplaints = $isActive->is_enabled('complaints');
        $isCommentActive = $isActive->is_enabled('comments');

        if ($isActiveComplaints) {
            $complaints = ComplaintsComplainTypesEntryModel::all();
        }

        $adv = $advRepository->getListItemAdv($id);

        $recommended_advs = $advRepository->getRecommendedAds($adv->id);
        foreach ($recommended_advs as $index => $ad) {
            $recommended_advs[$index]->detail_url = $advModel->getAdvDetailLinkByModel($ad, 'list');
            $recommended_advs[$index] = $advModel->AddAdsDefaultCoverImage($ad);
        }

        $categories = array();
        $categories_id = array();

        for ($i = 1; $i < 7; $i++) {
            $cat = "cat" . $i;
            if ($adv->$cat != null) {
                $item = $categoryRepository->getItem($adv->$cat);
                $categories['cat' . $i] = [
                    'name' => $item->name,
                    'id' => $item->id
                ];
                $categories_id[] = $item->id;
            }
        }

        if ($isActive->is_enabled('customfields')) {
            $features = app('Visiosoft\CustomfieldsModule\Http\Controller\cfController')->view($adv);
        }

        //Cloudinary Module
        $adv->video_url = null;
        $isActiveCloudinary = new AdvModel();
        $isActiveCloudinary = $isActiveCloudinary->is_enabled('cloudinary');
        if ($isActiveCloudinary) {

            $CloudinaryModel = new VideoModel();
            $Cloudinary = $CloudinaryModel->getVideo($id);

            if (count($Cloudinary->get()) > 0) {
                $adv->video_url = $Cloudinary->first()->toArray()['url'];
            }
        }

        $profile = new ProfileModel();
        $profile = $profile->getProfile($adv->created_by_id)->first();


        if ($isCommentActive) {
            $CommentModel = new CommentModel();
            $comments = $CommentModel->getComments($adv->id)->get();
        }
        $events->dispatch(new viewAd($adv));//view ad

        $isActiveqrContact = $isActive->is_enabled('qrcontact');
        if ($isActiveqrContact) {
            $qrModel = new QrModel();
            $qrSRC = $qrModel->source($adv);
        }
        $this->template->set('meta_keywords', implode(',', explode(' ', $adv->name)));
        $this->template->set('meta_description', strip_tags($adv->advs_desc, ''));
        $this->template->set('meta_title', $adv->name . "|" . end($categories)['name']);


        if ($adv->created_by_id == isset(auth()->user()->id) OR $adv->status == "approved") {
            return $this->view->make('visiosoft.module.advs::advs/list-item', compact('adv', 'complaints', 'recommended_advs', 'categories', 'features', 'tags', 'profile', 'comments', 'qrSRC'));
        } else {
            return back();
        }

    }

    public function getLocations(Request $request)
    {
        $table = $request->table;
        $id = $request->id;
        $db = $request->typeDb;

        $location = "";
        if ($table == "cities") {
            $location = CityModel::query()->where($db, $id)->get();
        } elseif ($table == "districts") {
            $location = DistrictModel::query()->whereIn($db, $id)->get();
        } elseif ($table == "neighborhoods") {
            $location = NeighborhoodModel::query()->where($db, $id)->get();
        } elseif ($table == "village") {
            $location = VillageModel::query()->where($db, $id)->get();
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

    public function getCats($id, SettingRepositoryInterface $settings, CategoryRepositoryInterface $category, AdvModel $advModel, CategoryModel $categoryModel)
    {
        $adv = $category->getSubCatById($id);

        if (empty($adv->toArray())) {

            $adv['title'] = trans('visiosoft.module.advs::field.next_add_advs_title.name');
            $adv['msg'] = trans('visiosoft.module.advs::field.next_add_advs_msg.name');
            $adv['nextBtn'] = trans('visiosoft.module.advs::field.next_add_advs_btn.name');
            $adv['cancelBtn'] = trans('visiosoft.module.advs::field.cancel_add_advs_btn.name');
            $adv['link'] = "";

            if ($advModel->is_enabled('packages')) {
                $packageModel = new PackageModel();
                $parent_cat = $categoryModel->getParentCats($id, 'parent_id');
                $package = $packageModel->reduceLimit($parent_cat);
                if ($package != null) {
                    return $package;
                }
            }
        }
        return $adv;
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
        return $this->view->make('visiosoft.module.advs::advs/new-create', compact(
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

            if ($advModel->is_enabled('packages') and $adv->slug == "") {
                $parent_cat = $categoryModel->getParentCats($request->cat1, 'parent_id');
                $packageModel = new PackageModel();
                $package = $packageModel->reduceLimit($parent_cat, 'reduce');
                if ($package != null) {
                    return redirect('/')->with('error', trans('visiosoft.module.advs::message.please_buy_package'));
                }
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

                if ($adv->slug == "") {
                    //new ads
                    $jsonVal = [];
                    $id = auth()->user()->id;
                    $adv_id = $advRepository->getLastAd($id);

                    for ($i = 1; $i < 7; $i++) {
                        $cat = 'cat' . $i;
                        if ($request->$cat != 0) {
                            $findcustomfields = CustomfieldsCustomFieldsEntryModel::query()->where('parent_category', $request->$cat)->get();
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

                    $findcustomfields = CustomfieldsCustomFieldsEntryModel::query()->whereNull('parent_category')->get();
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
                            $findcustomfields = CustomfieldsCustomFieldsEntryModel::query()->where('parent_category', $request->$cat)->get();
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
                    $findcustomfields = CustomfieldsCustomFieldsEntryModel::query()->whereNull('parent_category')->get();
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


        if ($adv['created_by_id'] != Auth::id()) {
            abort(403);
        }
        $cats_d = array();
        $cat = 'cat';
        $cats = array();

        for ($i = 1; $i < 7; $i++) {
            if ($adv[$cat . $i] != null) {
                $name = $categoryRepository->getSingleCat($adv[$cat . $i]);
                $cats_d['cat' . $i] = $name->name;
                $cats['cat' . $i] = $name->id;
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

        return $this->view->make('visiosoft.module.advs::advs/new-create', compact('id', 'cats_d', 'request', 'Cloudinary', 'cities', 'adv', 'custom_fields', 'nameField','descField'));
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

    public function statusAds($id, $type, SettingRepositoryInterface $settings, Dispatcher $events, AdvModel $advModel)
    {
        $ad = $advModel->getAdv($id);
        $auto_approved = $settings->value('visiosoft.module.advs::auto_approve');
        $default_published_time = $settings->value('visiosoft.module.advs::default_published_time');

        if ($auto_approved == true AND $type == 'pending_admin') {
            $type = "approved";
        }

        if ($type == "approved") {
            $advModel->publish_at_Ads($id);
            if ($ad->finish_at == NULL AND $type == "approved") {
                if ($advModel->is_enabled('packages')) {
                    $packageModel = new PackageModel();
                    $published_time = $packageModel->reduceTimeLimit($ad->cat1);
                    if ($published_time != null) {
                        $default_published_time = $published_time;
                    }
                }
                $advModel->finish_at_Ads($id, $default_published_time);
            }
        }

        $isActiveAlgolia = $advModel->is_enabled('algolia');
        if ($isActiveAlgolia) {
            $algolia = new SearchModel();
            $algolia->updateStatus($id, $type, $settings);
        }

        $advModel->statusAds($id, $type);
        $events->dispatch(new ChangeStatusAd($id, $settings));//Create Notify
        return back();
    }

    public function cats(CategoryRepositoryInterface $repository)
    {
        if (!Auth::user()) {
            redirect('/login?redirect=' . url()->current())->send();
        }
        $main_cats = $repository->mainCats();

        return $this->view->make('visiosoft.module.advs::advs/post-cat', compact('main_cats'));

    }

    public function login()
    {
        if (auth()->check()) {
            return $this->redirect->to($this->request->get('redirect', '/'));
        }

        $urlPrev = str_replace(url('/'), '', url()->previous());

        return $this->view->make('visiosoft.theme.default::login', compact('urlPrev'));
    }

    public function register()
    {

        if (auth()->check()) {
            return redirect('/');
        }

        return $this->view->make('visiosoft.theme.default::register');
    }

    public function passwordForgot()
    {
        if (auth()->check()) {
            return redirect('/');
        }

        return $this->view->make('visiosoft.theme.default::passwords/forgot');
    }

    public function passwordReset(Request $request)
    {
        if (auth()->check()) {
            return redirect('/');
        }
        $code = $request->email;
        return $this->view->make('visiosoft.theme.default::passwords/reset', compact('code'));
    }

    public function homePage(CategoryRepositoryInterface $repository)
    {
        $cats = $repository->mainCats();

        return $this->view->make('visiosoft.theme.default::addons/anomaly/pages-module/page', compact('cats'));
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
