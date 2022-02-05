<?php namespace Visiosoft\AdvsModule\Http\Controller;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Anomaly\Streams\Platform\Model\Complaints\ComplaintsComplainTypesEntryModel;
use Anomaly\Streams\Platform\Support\Currency;
use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Visiosoft\AdvsModule\Adv\AdvModel;
use Visiosoft\AdvsModule\Adv\Command\IsOptionsByCategory;
use Visiosoft\AdvsModule\Adv\Command\UpdateClassifiedStatus;
use Visiosoft\AdvsModule\Adv\Contract\AdvRepositoryInterface;
use Visiosoft\AdvsModule\Adv\Event\CreatedAd;
use Visiosoft\AdvsModule\Adv\Event\EditedAd;
use Visiosoft\AdvsModule\Adv\Event\EditedAdCategory;
use Visiosoft\AdvsModule\Adv\Event\PriceChange;
use Visiosoft\AdvsModule\Adv\Event\ViewAd;
use Visiosoft\AdvsModule\Adv\Form\AdvFormBuilder;
use Visiosoft\AdvsModule\Option\Contract\OptionRepositoryInterface;
use Visiosoft\AdvsModule\OptionConfiguration\Contract\OptionConfigurationRepositoryInterface;
use Visiosoft\AdvsModule\OptionConfiguration\OptionConfigurationModel;
use Visiosoft\CatsModule\Category\Contract\CategoryRepositoryInterface;
use Visiosoft\LocationModule\City\CityModel;
use Visiosoft\LocationModule\City\CityRepository;
use Visiosoft\LocationModule\Country\Contract\CountryRepositoryInterface;
use Visiosoft\LocationModule\District\DistrictModel;
use Visiosoft\LocationModule\Neighborhood\NeighborhoodModel;
use Visiosoft\LocationModule\Village\VillageModel;
use Visiosoft\ProfileModule\Adress\Contract\AdressRepositoryInterface;
use Visiosoft\SeoModule\Legend\Command\AddMetaData;

class AdvsController extends PublicController
{
    private $userRepository;

    private $adv_model;
    private $adv_repository;

    private $optionConfigurationRepository;

    private $country_repository;

    private $city_model;
    private $cityRepository;

    private $district_model;

    private $neighborhood_model;

    private $village_model;

    private $category_repository;

    private $requestHttp;
    private $settings_repository;
    private $event;

    private $optionRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,

        AdvModel $advModel,
        AdvRepositoryInterface $advRepository,

        OptionConfigurationRepositoryInterface $optionConfigurationRepository,

        CountryRepositoryInterface $country_repository,

        CityModel $city_model,
        CityRepository $cityRepository,

        DistrictModel $district_model,

        NeighborhoodModel $neighborhood_model,

        VillageModel $village_model,

        CategoryRepositoryInterface $category_repository,

        OptionRepositoryInterface $optionRepository,

        SettingRepositoryInterface $settings_repository,

        Dispatcher $events,

        Request $request
    )
    {
        $this->userRepository = $userRepository;

        $this->adv_model = $advModel;
        $this->adv_repository = $advRepository;

        $this->optionConfigurationRepository = $optionConfigurationRepository;

        $this->country_repository = $country_repository;

        $this->city_model = $city_model;
        $this->cityRepository = $cityRepository;

        $this->district_model = $district_model;

        $this->neighborhood_model = $neighborhood_model;

        $this->village_model = $village_model;

        $this->category_repository = $category_repository;

        $this->settings_repository = $settings_repository;

        $this->event = $events;

        $this->requestHttp = $request;

        $this->optionRepository = $optionRepository;
        parent::__construct();
    }

    public function index($category = null, $city = null)
    {
        $customParameters = array();
        $featured_advs = array();
        $subCats = array();

        $param = $this->requestHttp->toArray();

        $countries = $this->country_repository->newQuery()->get();

        $isActiveDopings = $this->adv_model->is_enabled('dopings');

        // Search by category slug
        if ($category) { // Slug
            $category = $this->category_repository->findBy('slug', $category);
            if (!$category) {
                $this->messages->error(trans('visiosoft.module.advs::message.category_not_exist'));
                return redirect('/');
            }
            if (isset($param['cat'])) {
                unset($param['cat']);
                return redirect(fullLink(
                    $param,
                    route('adv_list_seo', [$category->slug])
                ));
            }
        } elseif (isset($param['cat']) && !empty($param['cat'])) { // Only Param
            $category = $this->category_repository->find($param['cat']);
            if (!$category) {
                $this->messages->error(trans('visiosoft.module.advs::message.category_not_exist'));
                return redirect('/');
            }
            unset($param['cat']);
            return redirect(fullLink(
                $param,
                route('adv_list_seo', [$category->slug])
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
                return redirect(fullLink(
                    $param,
                    route('adv_list_seo', [$category->slug, $cityId->slug])
                ));
            } elseif ($isOneCity) { // Param and slug
                $cityId = $this->cityRepository->find($param['city'][0]);
                if ($city !== $cityId->slug) {
                    unset($param['city']);
                    return redirect(fullLink(
                        $param,
                        route('adv_list_seo', [$category->slug, $cityId->slug])
                    ));
                }
            } elseif ($city && $isMultipleCity) { // Slug and multiple param cities
                return redirect(fullLink(
                    $param,
                    route('adv_list_seo', [$category->slug]),
                    array()
                ));
            } elseif ($city) {
                if (isset($param['city'][0]) && empty($param['city'][0])) { // Slug and empty param
                    unset($param['city']);
                    return redirect(fullLink(
                        $param,
                        route('adv_list_seo', [$category->slug])
                    ));
                } else { // Only slug
                    $cityId = $this->cityRepository->findBy('slug', $city);
                    if (!$cityId) {
                        return redirect(fullLink(
                            $param,
                            route('adv_list_seo', [$category->slug])
                        ), 301);
                    }
                }
            }
        }

        $isActiveCustomFields = $this->adv_model->is_enabled('customfields');
        $advs = $this->adv_repository->searchAdvs(
            'list', $param, $customParameters, null, $category, $cityId, false
        );

        if ($isActiveDopings && empty($param['sort_by'])) {
            $featuredAdvsQuery = clone $advs;
            $response__featured_doping = app('Visiosoft\DopingsModule\Http\Controller\DopingsController')
                ->listFeatures($featuredAdvsQuery);

            $featured_advs = $response__featured_doping['featured_ads'];
            $featured_advs_id_list = $response__featured_doping['ad_id_list'];

            $advs = $advs->whereNotIn('advs_advs.id', $featured_advs_id_list);
        }

        $advs = $advs->paginate(setting_value('streams::per_page'));
        $advs = $this->adv_repository->addAttributes($advs);

        if ($advs->currentPage() > $advs->lastPage()) {
            unset($param['page']);
            return redirect(fullLink(
                $param,
                \request()->url()
            ), 301);
        }

        if (setting_value('visiosoft.module.advs::hide_out_of_stock_products_without_listing')) {
            $advs = $advs->filter(
                function ($entry) {
                    return (($entry->is_get_adv == true && $entry->stock > 0) || ($entry->is_get_adv == false));
                }
            );
        }

        foreach ($advs as $index => $ad) {
            $advs[$index]->detail_url = $this->adv_model->getAdvDetailLinkByModel($ad, 'list');
            $advs[$index] = $this->adv_model->AddAdsDefaultCoverImage($ad);

            $foreign_currencies = json_decode($advs[$index]->foreign_currencies, true);
            if (isset($_COOKIE['currency']) && $advs[$index]->foreign_currencies && array_key_exists($_COOKIE['currency'], $foreign_currencies)) {
                $advs[$index]->currency = $_COOKIE['currency'];
                $advs[$index]->price = $foreign_currencies[$_COOKIE['currency']];
            }

        }
        $seenList = array();
        if ($isActiveCustomFields) {
            $cfRepository = app('Visiosoft\CustomfieldsModule\CustomField\CustomFieldRepository');

            $return_values = $cfRepository->getSeenList($advs);

            $return_values = $cfRepository
                ->getSeenWithCategory($return_values['advs'], $return_values['seenList'], $category);

            $advs = $return_values['advs'];
            $seenList = $return_values['seenList'];
        }


        if ($category) {
            $mainCats = collect($this->category_repository->getParentCategoryByOrder($category->id));
            $subCats = $category->getSubCategories();
            $allCats = false;
        } else {
            $mainCats = $this->category_repository->getMainCategories();
            $allCats = true;
        }

        $cFArray = $checkboxes = $topfields = $selectDropdown = $selectRange = $selectImage = $ranges = $radio = $text = $listingCFs = array();

        if ($isActiveCustomFields) {
            $returnvalues = app('Visiosoft\CustomfieldsModule\Http\Controller\CustomFieldsController')->index($mainCats, $subCats, $category);
            $checkboxes = $returnvalues['checkboxes'];
            $topfields = $returnvalues['topfields'];
            $selectDropdown = $returnvalues['selectDropdown'];
            $selectRange = $returnvalues['selectRange'];
            $selectImage = $returnvalues['selectImage'];
            $ranges = $returnvalues['ranges'];
            $radio = $returnvalues['radio'];
            $text = $returnvalues['text'];

            $listingCFs = app('Visiosoft\CustomfieldsModule\CustomField\Contract\CustomFieldRepositoryInterface')
                ->getSeenCustomFieldsWithCategory($category);
            foreach ($advs as $adv) {
                if ($adv->cf_json) {
                    $tempFeatures = app('Visiosoft\CustomfieldsModule\Http\Controller\CustomFieldsController')
                        ->view($adv);
                    $tempFeatures = array_values(array_filter($tempFeatures, function ($tempFeature) {
                        return !is_array($tempFeature['custom_field_value']);
                    }));
                    $features = array();
                    foreach ($listingCFs as $listingCF) {
                        if (($key = array_search($listingCF->slug, array_column($tempFeatures, 'slug'))) !== false) {
                            $features[$listingCF->slug] = $tempFeatures[$key];
                        }
                    }
                    $adv->features = $features;
                }
            }

            $cFArray = app('Visiosoft\CustomfieldsModule\CustomField\Contract\CustomFieldRepositoryInterface')
                ->getCFParamValues($param);
        }

        $photoVideoParams = ['photo', 'video'];
        $photoExists = false;
        foreach ($photoVideoParams as $pV) {
            if (\request()->{$pV} === 'true') {
                $removalLink = array_filter($param, function ($singleParam) use ($pV) {
                    return $singleParam !== $pV;
                }, ARRAY_FILTER_USE_KEY);
                $removalLink = fullLink($removalLink, \request()->url());

                if ($photoExists) {
                    $cFArray['photoVideo']['value'][] = [
                        'name' => trans('visiosoft.module.advs::field.ads_with_' . $pV . '.name'),
                        'removalLink' => $removalLink
                    ];
                } else {
                    $cFArray['photoVideo'] = [
                        'name' => trans('visiosoft.module.advs::field.photo_video'),
                        'value' => [
                            [
                                'name' => trans('visiosoft.module.advs::field.ads_with_' . $pV . '.name'),
                                'removalLink' => $removalLink
                            ]
                        ]
                    ];
                    $photoExists = true;
                }
            }
        }

        if ($dateParam = \request()->date) {
            $removalLink = array_filter($param, function ($singleParam) {
                return $singleParam !== 'date';
            }, ARRAY_FILTER_USE_KEY);
            $removalLink = fullLink($removalLink, \request()->url());

            $cFArray[] = [
                'name' => trans('visiosoft.module.advs::field.ad_date'),
                'value' => [
                    [
                        'name' => trans('visiosoft.module.advs::field.in_the_last_' . $dateParam . '.name'),
                        'removalLink' => $removalLink
                    ]
                ]
            ];
        }

        $minPrice = \request()->min_price;
        $maxPrice = \request()->max_price;
        if ($minPrice || $maxPrice) {
            $removalLink = array_filter($param, function ($singleParam) {
                return $singleParam !== 'min_price' && $singleParam !== 'max_price' && $singleParam !== 'currency';
            }, ARRAY_FILTER_USE_KEY);
            $removalLink = fullLink($removalLink, \request()->url());

            if ($minPrice && $maxPrice) {
                $name = "$minPrice - $maxPrice";
            } elseif ($minPrice) {
                $name = "$minPrice " . trans('visiosoft.module.advs::field.and_above');
            } elseif ($maxPrice) {
                $name = "$maxPrice " . trans('visiosoft.module.advs::field.and_below');
            }

            $cFArray[] = [
                'name' => trans('visiosoft.module.advs::field.price.name'),
                'value' => [
                    [
                        'name' => $name,
                        'removalLink' => $removalLink
                    ]
                ]
            ];
        }

        if (($cities = \request()->city) && $cities = $cities[0]) {
            $citiesIDs = $cityId ? [$cityId->id] : explode(',', $cities);
            $cities = $this->cityRepository->findAllByIDs($citiesIDs);

            $value = array();
            foreach ($cities as $city) {
                $removalLink = array_filter($param, function ($singleParam) {
                    return $singleParam !== 'city';
                }, ARRAY_FILTER_USE_KEY);
                $removalLink = fullLink(
                    $removalLink,
                    \request()->url(),
                    ['city[]' => implode(
                        ',',
                        array_filter($citiesIDs, function ($singleCity) use ($city) {
                            return $singleCity != $city->id;
                        })
                    )]
                );

                $value[] = [
                    'name' => $city->name,
                    'removalLink' => $removalLink
                ];
            }

            $cFArray[] = [
                'name' => trans('visiosoft.module.advs::field.address'),
                'value' => $value
            ];
        }

        Cookie::queue(Cookie::make('last_search', $this->requestHttp->getRequestUri(), 84000));

        $viewType = $this->requestHttp->cookie('viewType');

        list('catText' => $catText, 'user' => $user) = $this->handleSeo($category, $mainCats, $cityId);

        $compact = compact('advs', 'countries', 'mainCats', 'subCats', 'checkboxes', 'param',
            'user', 'featured_advs', 'viewType', 'topfields', 'selectDropdown', 'selectRange', 'selectImage', 'ranges',
            'text', 'seenList', 'radio', 'category', 'cityId', 'allCats', 'catText', 'cFArray', 'listingCFs');

        return $this->viewTypeBasedRedirect($viewType, $compact);
    }

    private function handleSeo($category, $mainCats, $city)
    {
        $showTitle = true;
        $metaTitle = '';
        $catText = '';

        if ($category) {
            $seo_keywords = $category->getMetaKeywords();
            $seo_description = $category->getMetaDescription();
            $metaTitle = $category->name;
            $metaDesc = $seo_description;

            $this->template->set('meta_keywords', implode(', ', $seo_keywords));

            if ($city) {
                $catText = "$city->name $catText";
            } elseif (count($mainCats) == 1 || count($mainCats) == 2) {
                $catText = $mainCats->last()->name;
            } elseif (count($mainCats) > 2) {
                $catArray = $mainCats->slice(2);
                $loop = 0;
                foreach ($catArray as $cat) {
                    $catText = !$loop ? $catText . $cat->name : $catText . ' ' . $cat->name;
                    $loop++;
                }
            }
            $metaTitle = $catText ?: $metaTitle;

            if (is_module_installed('visiosoft.module.seo')) {
                $metaData = dispatch_now(new AddMetaData($category->id, 'category'));
                if ($metaData) {
                    list('metaTitle' => $seoMetaTitle, 'metaDesc' => $seoMetaDesc) = $metaData;
                    $metaTitle = $seoMetaTitle ?: $metaTitle;
                    $metaDesc = $seoMetaDesc ?: $metaDesc;
                }
            }

            $this->template->set('og_description', $metaDesc);
            $this->template->set('meta_description', $metaDesc);

            $showTitle = false;
        }

        $user = null;
        if (\request()->user) {
            if ($user = $this->userRepository->find(\request()->user)) {
                $showTitle = false;
                $metaTitle = $user->name() . ' ' . trans('visiosoft.module.advs::field.ads');
            }
        }

        if (\request()->page) {
            $metaTitle .= ($metaTitle ? " | " : "") . \request()->page;
        }

        $this->template->set('showTitle', $showTitle);
        $this->template->set('meta_title', $metaTitle);

        // Set rel="canonical"
        if (\request()->sort_by || \request()->doping) {
            $canonParam = \request()->all();
            unset($canonParam['sort_by'], $canonParam['doping']);
            $canonUrl = fullLink($canonParam, \request()->url());
            $this->template->set('additional_meta', "<link rel='canonical' href='$canonUrl'/>");
        }

        return compact('catText', 'user');
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
        if ($id) {
            $adv = $this->adv_repository->findByIDAndSlug($id, $seo);
        } else {
            $id = $seo;
            $adv = $this->adv_repository->getListItemAdv($id);
        }

        if ((auth()->user() and auth()->user()->hasRole('admin')) or ($adv && ((!$adv->expired() && $adv->getStatus() === 'approved') || $adv->created_by_id === \auth()->id()))) {
            // Check if created by exists
            if ((auth()->user() and !auth()->user()->hasRole('admin')) and !$adv->created_by) {
                $this->messages->error('visiosoft.module.advs::message.this_ad_is_not_valid_anymore');
                return $this->redirect->route('visiosoft.module.advs::list');
            }

            $complaints = null;
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
                    $item = $this->category_repository->find($adv->$cat);
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

            $features = null;
            if ($this->adv_model->is_enabled('customfields')) {
                $features = app('Visiosoft\CustomfieldsModule\Http\Controller\CustomFieldsController')->view($adv);
            }

            $adv->video_url = null;
            if ($this->adv_model->is_enabled('cloudinary')) {
                $adv->video_url = app('Visiosoft\CloudinaryModule\Http\Controller\VideoController')->getVideoUrl($adv->id);
            }

            $options = $this->optionRepository->findAllBy('adv_id', $id);

            $this->event->dispatch(new ViewAd($adv));//view ad

            if (substr($adv->cover_photo, 0, 4) === "http") {
                $coverPhoto = $adv->cover_photo;
            } else {
                if (substr($adv->cover_photo, 0, 1) === "/") {
                    $coverPhoto = \Illuminate\Support\Facades\Request::root() . $adv->cover_photo;
                } else {
                    $coverPhoto = \Illuminate\Support\Facades\Request::root() . '/' . $adv->cover_photo;
                }
            }

            $metaCatName = end($categories) ? end($categories)['name'] : '|';
            $metaTitle = $adv->name . " " . $metaCatName . ' ' . setting_value('streams::domain');
            $metaDesc = strip_tags($adv->advs_desc, '');

            if (is_module_installed('visiosoft.module.seo')) {
                $metaData = dispatch_now(new AddMetaData($adv->cat1, 'ad', $adv->id));
                if ($metaData) {
                    list('metaTitle' => $seoMetaTitle, 'metaDesc' => $seoMetaDesc) = $metaData;
                    $metaTitle = $seoMetaTitle ?: $metaTitle;
                    $metaDesc = $seoMetaDesc ?: $metaDesc;
                }
            }

            $coverPhotoInfo = pathinfo($coverPhoto);
            if (substr($coverPhotoInfo['basename'], 0, 3) === "tn-") {
                $ogImage = substr(basename($coverPhotoInfo['basename']), 3);
                $ogImage = $coverPhotoInfo['dirname'] . "/$ogImage";
            } else {
                $ogImage = $coverPhoto;
            }
            //ogMeta Tags
            $this->template->set('og_image', $ogImage);
            $this->template->set('og_url', $this->adv_model->getAdvDetailLinkByModel($adv, 'list'));

            $this->template->set('meta_image', $ogImage);
            $this->template->set('meta_keywords', implode(',', explode(' ', $adv->name)));
            $this->template->set('meta_description', $metaDesc);
            $this->template->set('showTitle', false);
            $this->template->set('meta_title', $metaTitle);

            $configurations = $this->optionConfigurationRepository->getConf($adv->id);

            $foreign_currencies = json_decode($adv->foreign_currencies, true);
            if (isset($_COOKIE['currency']) && $_COOKIE['currency'] && $adv->foreign_currencies && array_key_exists($_COOKIE['currency'], $foreign_currencies)) {
                $adv->currency = $_COOKIE['currency'];
                $adv->price = $foreign_currencies[$_COOKIE['currency']];
            }

            // Check if hide price
            $hidePrice = false;
            if ($hidePriceCats = setting_value('visiosoft.module.advs::hide_price_categories')) {
                $hidePrice = in_array($adv['cat1'], $hidePriceCats);
            }

            if ($adv->created_by_id == isset(auth()->user()->id) or $adv->status == "approved") {
                return $this->view->make('visiosoft.module.advs::ad-detail/detail', compact('adv', 'complaints',
                    'recommended_advs', 'categories', 'features', 'options', 'configurations', 'hidePrice'));
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

        if (!Auth::check() or ($adv['created_by_id'] != auth()->id() and !Auth::user()->isAdmin())) {
            abort(403);
        }

        for ($i = 1; $i <= 10; $i++) {
            $cat = "cat" . $i;
            if ($adv->$cat != null) {
                $item = $this->category_repository->find($adv->$cat);
                if (!is_null($item)) {
                    $categories['cat' . $i] = [
                        'name' => $item->name,
                        'id' => $item->id
                    ];
                    $categories_id[] = $item->id;
                }

            }
        }

        $features = array();
        if ($this->adv_model->is_enabled('customfields')) {
            $features = app('Visiosoft\CustomfieldsModule\Http\Controller\CustomFieldsController')->view($adv);
        }

        $isActiveDopings = $this->adv_model->is_enabled('dopings');

        $this->template->set('meta_title', trans('visiosoft.module.advs::field.preview') . " $adv->name" . ' ' . setting_value('streams::domain'));

        return $this->view->make('visiosoft.module.advs::new-ad/preview/preview',
            compact('adv', 'categories', 'features', 'isActiveDopings'));
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

    public function deleteAd(AdvRepositoryInterface $advs, $id)
    {
        $ad = $this->adv_model->find($id);

        if ($ad->created_by_id != Auth::id()) {
            $this->messages->error(trans('visiosoft.module.advs::message.delete_author_error'));
            return back();
        }

        $ad->delete();
        $this->messages->success(trans('visiosoft.module.advs::message.success_delete'));
        return back();
    }

    public function getCats($id)
    {
        return $this->category_repository->getCategoryById($id);
    }

    public function getCatsForNewAd($id)
    {
        if ($this->adv_model->is_enabled('packages') and !setting_value('visiosoft.module.packages::move_the_buy_package_to_the_end')) {
            $cats = app('Visiosoft\PackagesModule\Http\Controller\PackageFEController')->AdLimitForCategorySelection($id);
        } else {
            $cats = $this->getCats($id);

            if (empty($cats->toArray())) {
                $cats = trans('visiosoft.module.advs::message.create_ad_with_post_cat');
            }
        }
        return $cats;
    }

    public function checkUser()
    {
        return [
            'success' => \auth()->check(),
        ];
    }

    public function create(AdvFormBuilder $formBuilder, CategoryRepositoryInterface $repository)
    {
        $isActive = new AdvModel();
        $cats = $this->request->toArray();
        unset($cats['_token']);

        $end = count($cats);
        $cats_d = array();
        $categories = array_keys($cats);


        for ($i = 0; $i < $end; $i++) {
            $plus1 = $i + 1;

            $cat = $repository->find($cats['cat' . $plus1]);
            $cats_d['cat' . $plus1] = $cat->name;
        }
        if ($isActive->is_enabled('customfields')) {
            $custom_fields = app('Visiosoft\CustomfieldsModule\Http\Controller\CustomFieldsController')->create($categories);
        }

        return $this->view->make('visiosoft.module.advs::new-ad/new-create', compact(
            'formBuilder', 'cats_d', 'custom_fields'
        ));
    }

    public function store
    (
        AdvFormBuilder $form,
        AdressRepositoryInterface $address
    )
    {
        if ($this->request->action == "update") {
            $error = $form->build($this->request->update_id)->validate()->getFormErrors()->getMessages();
            if (!empty($error)) {
                return $this->redirect->back()->withInput();
            }

            /*  Update Adv  */
            $before_editing = $this->adv_repository->find($this->request->update_id);

            $adv = $before_editing;

            $is_new_create = ($adv->slug == "") ? true : false;

            //Set Old Price
            $old_price = $is_new_create ? $this->request->price : $adv->price;
            $adv->old_price = $old_price;


            $allowPendingAdCreation = false;

            if (is_module_installed('visiosoft.module.packages') and $is_new_create) {
                $cat = app('Visiosoft\PackagesModule\Http\Controller\PackageFEController')->AdLimitForNewAd($this->request);
                if (!is_null($cat)) {
                    if (array_key_exists('allowPendingAds', $cat)) {
                        $allowPendingAdCreation = $cat['allowPendingAds'];
                    } else {
                        return redirect($cat['redirect']);
                    }
                }
            }

            // Create options
            $deletedOptions = $this->request->deleted_options;
            $newOptions = $this->request->new_options;

            if (!empty($deletedOptions)) {
                $deletedOptions = explode(',', $this->request->deleted_options);
                $this->optionRepository->newQuery()
                    ->whereIn('id', $deletedOptions)
                    ->where('adv_id', $this->request->update_id)
                    ->delete();
            }

            if (!empty($newOptions)) {
                $newOptions = explode(',', $this->request->new_options);
                foreach ($newOptions as $option) {
                    $this->optionRepository->create([
                        'name' => $option,
                        'adv_id' => $this->request->update_id,
                    ]);
                }
            }

            //Get Categories Settings
            $get_categories_status = false;
            if ($get_categories = setting_value('visiosoft.module.advs::get_categories') and $get_categories = in_array($adv->cat1, $get_categories)) {
                $get_categories_status = true;
            }

            $adv->is_get_adv = ($this->request->is_get_adv and $get_categories_status) ? true : false;
            $adv->save();

            if ($adv->is_get_adv) {
                $orderNote = \request('order_note') ?? '';
                $adv->setConfig('order_note', trim($orderNote));
            }

            //Todo Create Event
            if (is_module_installed('visiosoft.module.customfields')) {
                app('Visiosoft\CustomfieldsModule\Http\Controller\CustomFieldsController')->store($adv, $this->request);
            }

            //Todo Create Event
            // Auto Approve
            $autoApprove = true;

            if ($allowPendingAdCreation) {
                $adLogExists = app('Visiosoft\PackagesModule\AdvsLog\Contract\AdvsLogRepositoryInterface')
                    ->findByAdID($adv->id);
                $autoApprove = $adLogExists ? false : true;
            }

            if (setting_value('visiosoft.module.advs::auto_approve') && $autoApprove) {
                $defaultAdPublishTime = setting_value('visiosoft.module.advs::default_published_time');

                $update = [
                    'status' => 'approved',
                ];

                if (!setting_value('visiosoft.module.advs::show_finish_and_publish_date')) {
                    $update = array_merge($update, [
                        'finish_at' => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' + ' . $defaultAdPublishTime . ' day')),
                        'publish_at' => date('Y-m-d H:i:s')
                    ]);
                }

                $adv->update($update);
            }

            $form->render($this->request->update_id);

            $adv = $this->adv_repository->find($form->getFormEntryId());

            //Create Adress
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
            $post['id'] = $this->request->update_id;

            //Price Change Event
            $this->event->dispatch(new PriceChange($post));

            //Cover Image URL
            if ($this->request->video_url == "") {
                $this->adv_repository->cover_image_update($adv);
            }


            if ($form->hasFormErrors()) {
                $cats = $this->request->toArray();

                $cats_d = array();

                foreach ($cats as $para => $value) {
                    if (substr($para, 0, 3) === "cat") {
                        $id = $cats[$para];
                        $cat = $this->category_repository->find($id);
                        if ($cat != null) {
                            $cats_d[$para] = $cat->name;
                        }
                    }
                }
                return redirect('/advs/edit_advs/' . $this->request->update_id)
                    ->with('cats_d', $cats_d)
                    ->with('request', $this->request);
            }

            if ($is_new_create) {
                event(new CreatedAd($adv));
            } else {
                try {
                    $this->adv_model->foreignCurrency($this->request->currency, $this->request->price, $this->request->update_id, $this->settings_repository, false);
                } catch (\Exception $exception) {
                    $this->messages->error(trans('visiosoft.module.advs::message.currency_converter_not_available'));
                }
                event(new EditedAd($before_editing, $adv));
            }

            if (config('adv.preview_mode')) {
                return redirect(route('advs_preview', [$this->request->update_id]));
            }

            return redirect(route('adv_detail_seo', [$adv->slug, $adv->id]));

        }

        /* New Create Adv */
        $this->request->publish_at = date('Y-m-d H:i:s');
        $all = $this->request->all();

        if (is_module_installed('visiosoft.module.packages')) {
            unset($all['pack_id']);
        }

        $adv = $this->adv_repository->create($all);

        if (is_module_installed('visiosoft.module.packages')
            && \request()->pack_id
            && setting_value('visiosoft.module.packages::allow_pending_ad_creation')) {
            $package = app('Visiosoft\PackagesModule\Package\Contract\PackageRepositoryInterface')
                ->find(\request()->pack_id);
            if ($package->price) {
                app('Visiosoft\PackagesModule\Http\Controller\PackageFEController')
                    ->packageAddCart(\request()->pack_id, $adv->id);
            }
        }
        return redirect('/advs/edit_advs/' . $adv->id);
    }

    public function edit($id)
    {
        $adv = $this->adv_repository->find($id);
        $rawClassified = $adv;

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
                $name = $this->category_repository->find($adv[$cat . $i]);
                if ($name) {
                    $cats_d['cat' . $i] = $name->name;
                    $cats['cat' . $i] = $name->id;
                } else {
                    $this->messages->info(trans('visiosoft.module.advs::message.update_category_info'));
                }

            }
        }

        $options = $this->optionRepository->findAllBy('adv_id', $id);

        $categories = array_keys($cats);

        $custom_fields = array();
        if ($this->adv_model->is_enabled('customfields')) {
            $custom_fields = app('Visiosoft\CustomfieldsModule\Http\Controller\CustomFieldsController')
                ->edit($adv, $categories, $cats);
        }

        // Check if hide price
        $hidePrice = false;
        if (setting_value('visiosoft.module.advs::price_area_hidden')) {
            $hidePrice = true;
        } elseif ($hidePriceCats = setting_value('visiosoft.module.advs::hide_price_categories')) {
            $hidePrice = in_array($adv['cat1'], $hidePriceCats);
        }

        /* Check Options
         * Added to query if there are product options.
         */
        $is_options = dispatch_now(new IsOptionsByCategory($adv['cat1']));
        $configurations = app(OptionConfigurationRepositoryInterface::class)->getConf($adv['id']);

        return $this->view->make(
            'visiosoft.module.advs::new-ad/new-create',
            compact(
                'id', 'cats_d', 'cats', 'adv', 'custom_fields', 'options',
                'hidePrice', 'is_options', 'configurations', 'rawClassified'
            )
        );
    }

    public function statusAds($id, $type)
    {
        $ad = $this->adv_model->getAdv($id);
        $autoApprove = setting_value('visiosoft.module.advs::auto_approve');

        if ($autoApprove && $type == 'pending_admin') {
            $type = "approved";
        }

        if ($type == "approved" && !$autoApprove) {
            $type = "pending_admin";
        }

        $this->dispatch(new UpdateClassifiedStatus($ad, $type));

        if ($type === 'approved') {
            $message = trans('visiosoft.module.advs::message.approve_status_change');
        } elseif ($type === 'sold') {
            $message = trans('visiosoft.module.advs::message.sold_status_change');
        } else {
            $message = trans('visiosoft.module.advs::message.passive_status_change');
        }

        $this->messages->success($message);

        return back();
    }

    public function cats()
    {
        $main_cats = $this->category_repository->getMainCategories();

        return $this->view->make('visiosoft.module.advs::new-ad/post-cat', compact('main_cats'));
    }

    public function editCategoryForAd($id)
    {
        $adv = $this->adv_model->userAdv(true)->find($id);
        $before_editing_ad_params = $adv->toArray();

        if (is_null($adv)) {
            abort(403);
        }

        if ($this->request->action == 'update') {
            $params = $this->request->all();
            unset($params['action']);

            for ($i = 1; $i <= 10; $i++) {
                if (!isset($params['cat' . $i])) {
                    $params['cat' . $i] = NULL;
                }
            }

            $adv->update($params);
            $this->event->dispatch(new EditedAdCategory($before_editing_ad_params, $adv));
            $this->messages->success(trans('visiosoft.module.advs::message.updated_category_msg'));
            return redirect('/advs/edit_advs/' . $id);
        }

        $categories = $this->adv_repository->getCategoriesWithAdID($id);

        return $this->view->make('visiosoft.module.advs::new-ad/edit-cat', compact('id', 'adv', 'categories'));

    }

    public function mapJson(AdvRepositoryInterface $repository)
    {
        $param = $this->request->toArray();
        $customParameters = array();
        $advModel = new AdvModel();

        $advs = $repository->searchAdvs('map', $param, $customParameters);

        if (setting_value('visiosoft.module.advs::hide_out_of_stock_products_without_listing')) {
            $advs = $advs->filter(
                function ($entry) {
                    return (($entry->is_get_adv == true && $entry->stock > 0) || ($entry->is_get_adv == false));
                }
            );
        }

        foreach ($advs as $index => $ad) {
            $advs[$index]->seo_link = $advModel->getAdvDetailLinkByModel($ad, 'list');
            $advs[$index] = $advModel->AddAdsDefaultCoverImage($ad);
        }
        return response()->json($advs);
    }

    public function extendAll($isAdmin = null)
    {
        if (\request()->unpublished) {
            $allAds = $this->adv_model->pendingAdvsByUser()->pluck('id')->all();
        } else {
            $allAds = true;
        }
        $adsExtended = $this->adv_repository->extendAds($allAds, $isAdmin);
        $this->messages->success(trans('visiosoft.module.advs::message.extended', ['number' => $adsExtended]));
        return $this->redirect->back();
    }

    public function extendSingle($adId)
    {
        $adsExtended = $this->adv_repository->extendAds($adId);
        $this->messages->success(trans('visiosoft.module.advs::message.extended', ['number' => $adsExtended]));
        return $this->redirect->back();
    }

    public function sold($id, AdvModel $advModel)
    {
        if ($this->request->sold == 'sold') {
            $advModel->find($id)->update(['status' => 'sold']);
        } elseif ($this->request->sold = 'not-sold') {
            $advModel->find($id)->update(['status' => 'approved']);
        }
    }

    public function addCart(Request $request)
    {
        $id = $request->id;
        $quantity = $request->quantity;
        $name = $request->name;
        $thisModel = new AdvModel();
        $adv = $thisModel->isAdv($id);
        $response = array();
        if ($adv and $adv->getStatus() == "approved") {
            $cart = $thisModel->addCart($adv, $quantity, $name);
            $response['status'] = "success";
            $response['msg'] = trans('visiosoft.module.advs::message.product_added_to_cart');
            $count = $cart->getItems()->count;
            $response['count'] = $count;
            $response['item'] = [
                'id' => $cart->getItems()->last->id,
                'adv_id' => $cart->getItems()->last->entry_id,
                'photo' => url($cart->getItems()->last->entry->cover_photo),
                'url' => $thisModel->getAdvDetailLinkByAdId($adv->id),
                'name' => $adv->name,
                'quantity' => $cart->getItems()->last->quantity,
                'price' => app(Currency::class)->format($cart->getItems()->last->price, $cart->getItems()->last->currency),
                'subtotal' => app(Currency::class)->format($cart->subtotal, setting_value('streams::currency'))
            ];
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
        if ($request->dataType === 'ad-configuration') {
            $optionConf = new  OptionConfigurationModel();
            $adv = $optionConf->newQuery()->find($id);
            $status = $adv->stockControl($id, $quantity);
        } else {
            $advmodel = new AdvModel();
            $adv = $advmodel->getAdv($id);
            $status = $advmodel->stockControl($id, $quantity);
        }

        $response = array();
        if ($status == 1) {
            $response['newQuantity'] = $advRepository->getQuantity($quantity, $type, $adv);

        } else {
            $response['newQuantity'] = $adv->stock;
        }

        $response['newPrice'] = $adv->price * $response['newQuantity'];

        $response['newPrice'] = app(Currency::class)->format($response['newPrice'], strtoupper($adv->currency));
        $response['status'] = $status;
        $response['maxQuantity'] = $adv->stock;
        return $response;
    }

    public function getClassifiedsByCoordinates()
    {
        \request()->validate([
            'lat' => 'required',
            'lng' => 'required',
        ]);

        try {
            return [
                'success' => true,
                'classifieds' => $this->adv_repository->getClassifiedsByCoordinates(\request()->lat, \request()->lng),
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'msg' => $e->getMessage()
            ];
        }
    }
}
