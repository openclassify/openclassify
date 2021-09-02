<?php namespace Visiosoft\ClassifiedsModule\Http\Controller;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Anomaly\Streams\Platform\Model\Complaints\ComplaintsComplainTypesEntryModel;
use Anomaly\Streams\Platform\Support\Currency;
use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Visiosoft\ClassifiedsModule\Classified\ClassifiedModel;
use Visiosoft\ClassifiedsModule\Classified\Command\IsOptionsByCategory;
use Visiosoft\ClassifiedsModule\Classified\Contract\ClassifiedRepositoryInterface;
use Visiosoft\ClassifiedsModule\Classified\Event\ChangedStatusClassified;
use Visiosoft\ClassifiedsModule\Classified\Event\CreatedClassified;
use Visiosoft\ClassifiedsModule\Classified\Event\EditedClassified;
use Visiosoft\ClassifiedsModule\Classified\Event\EditedClassifiedCategory;
use Visiosoft\ClassifiedsModule\Classified\Event\PriceChange;
use Visiosoft\ClassifiedsModule\Classified\Event\ViewClassified;
use Visiosoft\ClassifiedsModule\Classified\Form\ClassifiedFormBuilder;
use Visiosoft\ClassifiedsModule\Option\Contract\OptionRepositoryInterface;
use Visiosoft\ClassifiedsModule\OptionConfiguration\Contract\OptionConfigurationRepositoryInterface;
use Visiosoft\ClassifiedsModule\OptionConfiguration\OptionConfigurationModel;
use Visiosoft\ClassifiedsModule\Productoption\Contract\ProductoptionRepositoryInterface;
use Visiosoft\ClassifiedsModule\ProductoptionsValue\Contract\ProductoptionsValueRepositoryInterface;
use Visiosoft\CatsModule\Category\Contract\CategoryRepositoryInterface;
use Visiosoft\LocationModule\City\CityModel;
use Visiosoft\LocationModule\City\CityRepository;
use Visiosoft\LocationModule\Country\Contract\CountryRepositoryInterface;
use Visiosoft\LocationModule\District\DistrictModel;
use Visiosoft\LocationModule\Neighborhood\NeighborhoodModel;
use Visiosoft\LocationModule\Village\VillageModel;
use Visiosoft\PackagesModule\Package\PackageModel;
use Visiosoft\ProfileModule\Adress\Contract\AdressRepositoryInterface;
use Visiosoft\SeoModule\Legend\Command\AddMetaData;

class ClassifiedsController extends PublicController
{
    private $userRepository;

    private $classified_model;
    private $classified_repository;

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

        ClassifiedModel $classifiedModel,
        ClassifiedRepositoryInterface $classifiedRepository,

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

        $this->classified_model = $classifiedModel;
        $this->classified_repository = $classifiedRepository;

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
        $featured_classifieds = array();
        $subCats = array();

        $param = $this->requestHttp->toArray();

        $countries = $this->country_repository->newQuery()->get();

        $isActiveDopings = $this->classified_model->is_enabled('dopings');

        // Search by category slug
        if ($category) { // Slug
            $category = $this->category_repository->findBy('slug', $category);
            if (!$category) {
                $this->messages->error(trans('visiosoft.module.classifieds::message.category_not_exist'));
                return redirect('/');
            }
            if (isset($param['cat'])) {
                unset($param['cat']);
                return redirect(fullLink(
                    $param,
                    route('classified_list_seo', [$category->slug])
                ));
            }
        } elseif (isset($param['cat']) && !empty($param['cat'])) { // Only Param
            $category = $this->category_repository->find($param['cat']);
            if (!$category) {
                $this->messages->error(trans('visiosoft.module.classifieds::message.category_not_exist'));
                return redirect('/');
            }
            unset($param['cat']);
            return redirect(fullLink(
                $param,
                route('classified_list_seo', [$category->slug])
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
                    route('classified_list_seo', [$category->slug, $cityId->slug])
                ));
            } elseif ($isOneCity) { // Param and slug
                $cityId = $this->cityRepository->find($param['city'][0]);
                if ($city !== $cityId->slug) {
                    unset($param['city']);
                    return redirect(fullLink(
                        $param,
                        route('classified_list_seo', [$category->slug, $cityId->slug])
                    ));
                }
            } elseif ($city && $isMultipleCity) { // Slug and multiple param cities
                return redirect(fullLink(
                    $param,
                    route('classified_list_seo', [$category->slug]),
                    array()
                ));
            } elseif ($city) {
                if (isset($param['city'][0]) && empty($param['city'][0])) { // Slug and empty param
                    unset($param['city']);
                    return redirect(fullLink(
                        $param,
                        route('classified_list_seo', [$category->slug])
                    ));
                } else { // Only slug
                    $cityId = $this->cityRepository->findBy('slug', $city);
                    if (!$cityId) {
                        return redirect(fullLink(
                            $param,
                            route('classified_list_seo', [$category->slug])
                        ), 301);
                    }
                }
            }
        }

        $isActiveCustomFields = $this->classified_model->is_enabled('customfields');
        $classifieds = $this->classified_repository->searchClassifieds(
            'list', $param, $customParameters, null, $category, $cityId, false
        );

        if ($isActiveDopings) {
            $featuredClassifiedsQuery = clone $classifieds;
            $response__featured_doping = app('Visiosoft\DopingsModule\Http\Controller\DopingsController')
                ->listFeatures($featuredClassifiedsQuery);

            $featured_classifieds = $response__featured_doping['featured_classifieds'];
            $featured_classifieds_id_list = $response__featured_doping['classified_id_list'];

            $classifieds = $classifieds->whereNotIn('classifieds_classifieds.id', $featured_classifieds_id_list);
        }

        $classifieds = $classifieds->paginate(setting_value('streams::per_page'));
        $classifieds = $this->classified_repository->addAttributes($classifieds);

        if ($classifieds->currentPage() > $classifieds->lastPage()) {
            unset($param['page']);
            return redirect(fullLink(
                $param,
                \request()->url()
            ), 301);
        }

        if (setting_value('visiosoft.module.classifieds::hide_out_of_stock_products_without_listing')) {
            $classifieds = $classifieds->filter(
                function ($entry) {
                    return (($entry->is_get_classified == true && $entry->stock > 0) || ($entry->is_get_classified == false));
                }
            );
        }

        foreach ($classifieds as $index => $classified) {
            $classifieds[$index]->detail_url = $this->classified_model->getClassifiedDetailLinkByModel($classified, 'list');
            $classifieds[$index] = $this->classified_model->AddClassifiedsDefaultCoverImage($classified);

            $foreign_currencies = json_decode($classifieds[$index]->foreign_currencies, true);
            if (isset($_COOKIE['currency']) && $classifieds[$index]->foreign_currencies && array_key_exists($_COOKIE['currency'], $foreign_currencies)) {
                $classifieds[$index]->currency = $_COOKIE['currency'];
                $classifieds[$index]->price = $foreign_currencies[$_COOKIE['currency']];
            }

        }
        $seenList = array();
        if ($isActiveCustomFields) {
            $cfRepository = app('Visiosoft\CustomfieldsModule\CustomField\CustomFieldRepository');

            $return_values = $cfRepository->getSeenList($classifieds);

            $return_values = $cfRepository
                ->getSeenWithCategory($return_values['classifieds'], $return_values['seenList'], $category);

            $classifieds = $return_values['classifieds'];
            $seenList = $return_values['seenList'];
        }


        if ($category) {
            $mainCats = $this->category_repository->getParentCategoryByOrder($category->id);
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
            foreach ($classifieds as $classified) {
                if ($classified->cf_json) {
                    $tempFeatures = app('Visiosoft\CustomfieldsModule\Http\Controller\CustomFieldsController')
                        ->view($classified);
                    $tempFeatures = array_values(array_filter($tempFeatures, function ($tempFeature) {
                        return !is_array($tempFeature['custom_field_value']);
                    }));
                    $features = array();
                    foreach ($listingCFs as $listingCF) {
                        if (($key = array_search($listingCF->slug, array_column($tempFeatures, 'slug'))) !== false) {
                            $features[$listingCF->slug] = $tempFeatures[$key];
                        }
                    }
                    $classified->features = $features;
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
                        'name' => trans('visiosoft.module.classifieds::field.classifieds_with_' . $pV . '.name'),
                        'removalLink' => $removalLink
                    ];
                } else {
                    $cFArray['photoVideo'] = [
                        'name' => trans('visiosoft.module.classifieds::field.photo_video'),
                        'value' => [
                            [
                                'name' => trans('visiosoft.module.classifieds::field.classifieds_with_' . $pV . '.name'),
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
                'name' => trans('visiosoft.module.classifieds::field.classified_date'),
                'value' => [
                    [
                        'name' => trans('visiosoft.module.classifieds::field.in_the_last_' . $dateParam . '.name'),
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
                $name = "$minPrice " . trans('visiosoft.module.classifieds::field.and_above');
            } elseif ($maxPrice) {
                $name = "$maxPrice " . trans('visiosoft.module.classifieds::field.and_below');
            }

            $cFArray[] = [
                'name' => trans('visiosoft.module.classifieds::field.price.name'),
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
                'name' => trans('visiosoft.module.classifieds::field.address'),
                'value' => $value
            ];
        }

        Cookie::queue(Cookie::make('last_search', $this->requestHttp->getRequestUri(), 84000));

        $viewType = $this->requestHttp->cookie('viewType');

        list('catText' => $catText, 'user' => $user) = $this->handleSeo($category, $mainCats, $cityId);

        $compact = compact('classifieds', 'countries', 'mainCats', 'subCats', 'checkboxes', 'param',
            'user', 'featured_classifieds', 'viewType', 'topfields', 'selectDropdown', 'selectRange', 'selectImage', 'ranges',
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
                $catText = end($mainCats)->name;
            } elseif (count($mainCats) > 2) {
                $catArray = array_slice($mainCats, 2);
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
                $metaTitle = $user->name() . ' ' . trans('visiosoft.module.classifieds::field.classifieds');
            }
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
            $viewType = setting_value('visiosoft.module.classifieds::default_view_type');
        }
        if (isset($viewType) and $viewType == 'table') {
            return $this->view->make('visiosoft.module.classifieds::list/table', $compact);
        } elseif (isset($viewType) and $viewType == 'map') {
            return $this->view->make('visiosoft.module.classifieds::list/map', $compact);
        } elseif (isset($viewType) and $viewType == 'gallery') {
            return $this->view->make('visiosoft.module.classifieds::list/gallery', $compact);
        } else {
            return $this->view->make('visiosoft.module.classifieds::list/list', $compact);
        }
    }

    public function viewType($type)
    {
        Cookie::queue(Cookie::make('viewType', $type, 84000));
        return redirect($this->request->headers->get('referer') ?: route('visiosoft.module.classifieds::list'));
    }

    public function view($seo, $id = null)
    {
        if ($id) {
            $classified = $this->classified_repository->findByIDAndSlug($id, $seo);
        } else {
            $id = $seo;
            $classified = $this->classified_repository->getListItemClassified($id);
        }

        if ((auth()->user() and auth()->user()->hasRole('admin')) or ($classified && ((!$classified->expired() && $classified->getStatus() === 'approved') || $classified->created_by_id === \auth()->id()))) {
            // Check if created by exists
            if ((auth()->user() and !auth()->user()->hasRole('admin')) and !$classified->created_by) {
                $this->messages->error('visiosoft.module.classifieds::message.this_ad_is_not_valid_anymore');
                return $this->redirect->route('visiosoft.module.classifieds::list');
            }

            $complaints = null;
            if ($this->classified_model->is_enabled('complaints')) {
                $complaints = ComplaintsComplainTypesEntryModel::all();
            }

            $recommended_classifieds = $this->classified_repository->getRecommendedClassifieds($classified->id);

            foreach ($recommended_classifieds as $index => $classified) {
                $recommended_classifieds[$index]->detail_url = $this->classified_model->getClassifiedDetailLinkByModel($classified, 'list');
                $recommended_classifieds[$index] = $this->classified_model->AddClassifiedsDefaultCoverImage($classified);
            }

            $categories = array();
            $categories_id = array();
            for ($i = 1; $i <= 10; $i++) {
                $cat = "cat" . $i;
                if ($classified->$cat != null) {
                    $item = $this->category_repository->find($classified->$cat);
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
            if ($this->classified_model->is_enabled('customfields')) {
                $features = app('Visiosoft\CustomfieldsModule\Http\Controller\CustomFieldsController')->view($classified);
            }

            $classified->video_url = null;
            if ($this->classified_model->is_enabled('cloudinary')) {
                $classified->video_url = app('Visiosoft\CloudinaryModule\Http\Controller\VideoController')->getVideoUrl($classified->id);
            }

            $options = $this->optionRepository->findAllBy('classified_id', $id);

            $this->event->dispatch(new ViewClassified($classified));//view classified

            if (substr($classified->cover_photo, 0, 4) === "http") {
                $coverPhoto = $classified->cover_photo;
            } else {
                if (substr($classified->cover_photo, 0, 1) === "/") {
                    $coverPhoto = \Illuminate\Support\Facades\Request::root() . $classified->cover_photo;
                } else {
                    $coverPhoto = \Illuminate\Support\Facades\Request::root() . '/' . $classified->cover_photo;
                }
            }

            $metaCatName = end($categories) ? end($categories)['name'] : '|';
            $metaTitle = $classified->name . " " . $metaCatName . ' ' . setting_value('streams::domain');
            $metaDesc = strip_tags($classified->classifieds_desc, '');

            if (is_module_installed('visiosoft.module.seo')) {
                $metaData = dispatch_now(new AddMetaData($classified->cat1, 'classified', $classified->id));
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
            $this->template->set('og_url', $this->classified_model->getClassifiedDetailLinkByModel($classified, 'list'));

            $this->template->set('meta_image', $ogImage);
            $this->template->set('meta_keywords', implode(',', explode(' ', $classified->name)));
            $this->template->set('meta_description', $metaDesc);
            $this->template->set('showTitle', false);
            $this->template->set('meta_title', $metaTitle);

            $configurations = $this->optionConfigurationRepository->getConf($classified->id);

            $foreign_currencies = json_decode($classified->foreign_currencies, true);
            if (isset($_COOKIE['currency']) && $_COOKIE['currency'] && $classified->foreign_currencies && array_key_exists($_COOKIE['currency'], $foreign_currencies)) {
                $classified->currency = $_COOKIE['currency'];
                $classified->price = $foreign_currencies[$_COOKIE['currency']];
            }

            // Check if hide price
            $hidePrice = false;
            if ($hidePriceCats = setting_value('visiosoft.module.classifieds::hide_price_categories')) {
                $hidePrice = in_array($classified['cat1'], $hidePriceCats);
            }

            if ($classified->created_by_id == isset(auth()->user()->id) or $classified->status == "approved") {
                return $this->view->make('visiosoft.module.classifieds::classified-detail/detail', compact('classified', 'complaints',
                    'recommended_classifieds', 'categories', 'features', 'options', 'configurations', 'hidePrice'));
            } else {
                return back();
            }
        } else {
            $this->messages->error(trans('visiosoft.module.classifieds::message.classified_doesnt_exist'));
            return redirect()->route('visiosoft.module.classifieds::list');
        }
    }

    public function preview($id)
    {
        $categories = array();
        $categories_id = array();

        $classified = $this->classified_repository->getListItemClassified($id);

        if (!Auth::check() or ($classified['created_by_id'] != auth()->id() and !Auth::user()->isAdmin())) {
            abort(403);
        }

        for ($i = 1; $i <= 10; $i++) {
            $cat = "cat" . $i;
            if ($classified->$cat != null) {
                $item = $this->category_repository->find($classified->$cat);
                if (!is_null($item)) {
                    $categories['cat' . $i] = [
                        'name' => $item->name,
                        'id' => $item->id
                    ];
                    $categories_id[] = $item->id;
                }

            }
        }

        $options = $this->optionRepository->findAllBy('classified_id', $id);

        $features = array();
        if ($this->classified_model->is_enabled('customfields')) {
            $features = app('Visiosoft\CustomfieldsModule\Http\Controller\CustomFieldsController')->view($classified);
        }

        $isActiveDopings = $this->classified_model->is_enabled('dopings');

        return $this->view->make('visiosoft.module.classifieds::new-classified/preview/preview',
            compact('classified', 'categories', 'features', 'isActiveDopings'));
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

    public function deleteClassified(ClassifiedRepositoryInterface $classifieds, $id)
    {
        $classified = $this->classified_model->find($id);
        if (!Auth::user()) {
            redirect('/login?redirect=' . url()->current())->send();
        }

        if ($classified->created_by_id != Auth::id()) {
            $this->messages->error(trans('visiosoft.module.classifieds::message.delete_author_error'));
        }

        $classified->delete();
        $this->messages->success(trans('visiosoft.module.classifieds::message.success_delete'));
        return back();
    }

    public function getCats($id)
    {
        return $this->category_repository->getCategoryById($id);
    }

    public function getCatsForNewClassified($id)
    {
        if ($this->classified_model->is_enabled('packages') and !setting_value('visiosoft.module.packages::move_the_buy_package_to_the_end')) {
            $cats = app('Visiosoft\PackagesModule\Http\Controller\PackageFEController')->ClassifiedLimitForCategorySelection($id);
        } else {
            $cats = $this->getCats($id);

            if (empty($cats->toArray())) {
                $cats = trans('visiosoft.module.classifieds::message.create_classified_with_post_cat');
            }
        }
        return $cats;
    }

    public function create(ClassifiedFormBuilder $formBuilder, CategoryRepositoryInterface $repository)
    {
        if (!Auth::user()) {
            redirect('/login?redirect=' . url()->current())->send();
        }

        $isActive = new ClassifiedModel();
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

        return $this->view->make('visiosoft.module.classifieds::new-classified/new-create', compact(
            'request', 'formBuilder', 'cats_d', 'custom_fields'));
    }

    public function store
    (
        ClassifiedFormBuilder $form,
        AdressRepositoryInterface $address
    )
    {
        if ($this->request->action == "update") {
            $error = $form->build($this->request->update_id)->validate()->getFormErrors()->getMessages();
            if (!empty($error)) {
                return $this->redirect->back();
            }

            /*  Update Classified  */
            $before_editing = $this->classified_repository->find($this->request->update_id);

            $classified = $before_editing;

            $is_new_create = ($classified->slug == "") ? true : false;

            //Set Old Price
            $old_price = $is_new_create ? $this->request->price : $classified->price;
            $classified->old_price = $old_price;


            $allowPendingClassifiedCreation = false;

            if (is_module_installed('visiosoft.module.packages') and $is_new_create) {
                $cat = app('Visiosoft\PackagesModule\Http\Controller\PackageFEController')->ClassifiedLimitForNewClassified($this->request);
                if (!is_null($cat)) {
                    if (array_key_exists('allowPendingClassifieds', $cat)) {
                        $allowPendingClassifiedCreation = $cat['allowPendingClassifieds'];
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
                    ->where('classified_id', $this->request->update_id)
                    ->delete();
            }

            if (!empty($newOptions)) {
                $newOptions = explode(',', $this->request->new_options);
                foreach ($newOptions as $option) {
                    $this->optionRepository->create([
                        'name' => $option,
                        'classified_id' => $this->request->update_id,
                    ]);
                }
            }

            //Get Categories Settings
            $get_categories_status = false;
            if ($get_categories = setting_value('visiosoft.module.classifieds::get_categories') and $get_categories = in_array($classified->cat1, $get_categories)) {
                $get_categories_status = true;
            }

            $classified->is_get_classified = ($this->request->is_get_classified and $get_categories_status) ? true : false;
            $classified->save();


            //Todo Create Event
            if (is_module_installed('visiosoft.module.customfields')) {
                app('Visiosoft\CustomfieldsModule\Http\Controller\CustomFieldsController')->store($classified, $this->request);
            }

            //Todo Create Event
            // Auto Approve
            $autoApprove = true;

            if ($allowPendingClassifiedCreation) {
                $classifiedLogExists = app('Visiosoft\PackagesModule\ClassifiedsLog\Contract\ClassifiedsLogRepositoryInterface')
                    ->findByClassifiedID($classified->id);
                $autoApprove = $classifiedLogExists ? false : true;
            }

            if (setting_value('visiosoft.module.classifieds::auto_approve') && $autoApprove) {
                $defaultClassifiedPublishTime = setting_value('visiosoft.module.classifieds::default_published_time');

                $update = [
                    'status' => 'approved',
                ];

                if (!setting_value('visiosoft.module.classifieds::show_finish_and_publish_date')) {
                    $update = array_merge($update, [
                        'finish_at' => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' + ' . $defaultClassifiedPublishTime . ' day')),
                        'publish_at' => date('Y-m-d H:i:s')
                    ]);
                }

                $classified->update($update);
            }

            $form->render($this->request->update_id);

            $classified = $this->classified_repository->find($form->getFormEntryId());

            //Create Adress
            if ($this->request->address_id != "") {
                $address = $address->find($this->request->address_id);
                $classified->country_id = $address->country_id;
                $classified->city = $address->city;
                $classified->district = $address->district;
                $classified->neighborhood = null;
                $classified->village = null;
                $classified->save();
            }


            $post = $form->getPostData();
            $post['id'] = $this->request->update_id;

            //Price Change Event
            $this->event->dispatch(new PriceChange($post));

            //Cover Image URL
            if ($this->request->video_url == "") {
                $this->classified_repository->cover_image_update($classified);
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
                return redirect('/classifieds/edit_classifieds/' . $this->request->update_id)
                    ->with('cats_d', $cats_d)
                    ->with('request', $this->request);
            }

            if ($is_new_create) {
                event(new CreatedClassified($classified));
            } else {
                $this->classified_model->foreignCurrency($this->request->currency, $this->request->price, $this->request->update_id, $this->settings_repository, false);
                event(new EditedClassified($before_editing, $classified));
            }

            return redirect(route('classifieds_preview', [$this->request->update_id]));
        }

        /* New Create Classified */
        $this->request->publish_at = date('Y-m-d H:i:s');
        $all = $this->request->all();

        if (is_module_installed('visiosoft.module.packages')) {
            unset($all['pack_id']);
        }

        $classified = $this->classified_repository->create($all);

        if (is_module_installed('visiosoft.module.packages')
            && \request()->pack_id
            && setting_value('visiosoft.module.packages::allow_pending_classified_creation')) {
            $package = app('Visiosoft\PackagesModule\Package\Contract\PackageRepositoryInterface')
                ->find(\request()->pack_id);
            if ($package->price) {
                app('Visiosoft\PackagesModule\Http\Controller\PackageFEController')
                    ->packageAddCart(\request()->pack_id, $classified->id);
            }
        }
        return redirect('/classifieds/edit_classifieds/' . $classified->id);
    }

    public function edit($id)
    {
        $classified = $this->classified_repository->find($id);

        if (is_null($classified)) {
            $this->messages->error(trans('visiosoft.module.classifieds::message.no_add_found'));
            return $this->redirect->to(route('classifieds::create_classified'));
        }

        $classified = $classified->toArray();

        if ($classified['created_by_id'] != auth()->id()
            && !auth()->user()->hasPermission('visiosoft.module.classifieds::classifieds.write')) {
            abort(403);
        }
        $cats_d = array();
        $cat = 'cat';
        $cats = array();

        for ($i = 1; $i <= 10; $i++) {
            if ($classified[$cat . $i]) {
                $name = $this->category_repository->find($classified[$cat . $i]);
                if ($name) {
                    $cats_d['cat' . $i] = $name->name;
                    $cats['cat' . $i] = $name->id;
                } else {
                    $this->messages->info(trans('visiosoft.module.classifieds::message.update_category_info'));
                }

            }
        }

        $options = $this->optionRepository->findAllBy('classified_id', $id);

        $categories = array_keys($cats);

        $custom_fields = array();
        if ($this->classified_model->is_enabled('customfields')) {
            $custom_fields = app('Visiosoft\CustomfieldsModule\Http\Controller\CustomFieldsController')
                ->edit($classified, $categories, $cats);
        }

        // Check if hide price
        $hidePrice = false;
        if (setting_value('visiosoft.module.classifieds::price_area_hidden')) {
            $hidePrice = true;
        } elseif ($hidePriceCats = setting_value('visiosoft.module.classifieds::hide_price_categories')) {
            $hidePrice = in_array($classified['cat1'], $hidePriceCats);
        }

        /* Check Options
         * Added to query if there are product options.
         */
        $is_options = dispatch_now(new IsOptionsByCategory($classified['cat1']));
        $configurations = app(OptionConfigurationRepositoryInterface::class)->getConf($classified['id']);

        return $this->view->make(
            'visiosoft.module.classifieds::new-classified/new-create',
            compact('id', 'cats_d', 'cats', 'classified', 'custom_fields', 'options', 'hidePrice','is_options', 'configurations')
        );
    }

    public function statusClassifieds($id, $type, SettingRepositoryInterface $settings, Dispatcher $events)
    {
        $classified = $this->classified_model->getClassified($id);
        $auto_approved = $settings->value('visiosoft.module.classifieds::auto_approve');
        $default_published_time = $settings->value('visiosoft.module.classifieds::default_published_time');

        if ($auto_approved == true and $type == 'pending_admin') {
            $type = "approved";
        }
        if ($type == "approved" and $auto_approved != true) {
            $type = "pending_admin";
        }

        if ($type == "approved") {
            $this->classified_model->publish_at_Classifieds($id);
            if ($classified->finish_at == NULL and $type == "approved") {
                if ($this->classified_model->is_enabled('packages')) {
                    $packageModel = new PackageModel();
                    $published_time = $packageModel->reduceTimeLimit($classified->cat1);
                    if ($published_time != null) {
                        $default_published_time = $published_time;
                    }
                }
                $this->classified_model->finish_at_Classifieds($id, $default_published_time);
            }
        }

        $this->classified_model->statusClassifieds($id, $type);

        event(new ChangedStatusClassified($classified));//Create Notify

        if ($type === 'approved') {
            $message = trans('visiosoft.module.classifieds::message.approve_status_change');
        } elseif ($type === 'sold') {
            $message = trans('visiosoft.module.classifieds::message.sold_status_change');
        } else {
            $message = trans('visiosoft.module.classifieds::message.passive_status_change');
        }
        $this->messages->success($message);
        return back();
    }

    public function cats()
    {
        if (!Auth::user()) {
            redirect('/login?redirect=' . url()->current())->send();
        }
        $main_cats = $this->category_repository->getMainCategories();

        return $this->view->make('visiosoft.module.classifieds::new-classified/post-cat', compact('main_cats'));
    }

    public function editCategoryForClassified($id)
    {
        $classified = $this->classified_model->userClassified(true)->find($id);
        $before_editing_classified_params = $classified->toArray();

        if (is_null($classified)) {
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

            $classified->update($params);
            $this->event->dispatch(new EditedClassifiedCategory($before_editing_classified_params, $classified));
            $this->messages->success(trans('visiosoft.module.classifieds::message.updated_category_msg'));
            return redirect('/classifieds/edit_classifieds/' . $id);
        }

        $categories = $this->classified_repository->getCategoriesWithClassifiedID($id);

        return $this->view->make('visiosoft.module.classifieds::new-classified/edit-cat', compact('id', 'classified', 'categories'));

    }

    public function mapJson(ClassifiedRepositoryInterface $repository)
    {
        $param = $this->request->toArray();
        $customParameters = array();
        $classifiedModel = new ClassifiedModel();

        $classifieds = $repository->searchClassifieds('map', $param, $customParameters);

        if (setting_value('visiosoft.module.classifieds::hide_out_of_stock_products_without_listing')) {
            $classifieds = $classifieds->filter(
                function ($entry) {
                    return (($entry->is_get_classified == true && $entry->stock > 0) || ($entry->is_get_classified == false));
                }
            );
        }

        foreach ($classifieds as $index => $classified) {
            $classifieds[$index]->seo_link = $classifiedModel->getClassifiedDetailLinkByModel($classified, 'list');
            $classifieds[$index] = $classifiedModel->AddClassifiedsDefaultCoverImage($classified);
        }
        return response()->json($classifieds);
    }

    public function extendAll($isAdmin = null)
    {
        if (\request()->unpublished) {
            $allClassifieds = $this->classified_model->pendingClassifiedsByUser()->pluck('id')->all();
        } else {
            $allClassifieds = true;
        }
        $classifiedsExtended = $this->classified_repository->extendClassifieds($allClassifieds, $isAdmin);
        $this->messages->success(trans('visiosoft.module.classifieds::message.extended', ['number' => $classifiedsExtended]));
        return $this->redirect->back();
    }

    public function extendSingle($classifiedId)
    {
        $classifiedsExtended = $this->classified_repository->extendClassifieds($classifiedId);
        $this->messages->success(trans('visiosoft.module.classifieds::message.extended', ['number' => $classifiedsExtended]));
        return $this->redirect->back();
    }

    public function sold($id, ClassifiedModel $classifiedModel)
    {
        if ($this->request->sold == 'sold') {
            $classifiedModel->find($id)->update(['status' => 'sold']);
        } elseif ($this->request->sold = 'not-sold') {
            $classifiedModel->find($id)->update(['status' => 'approved']);
        }
    }

    public function addCart(Request $request)
    {
        $id = $request->id;
        $quantity = $request->quantity;
        $name = $request->name;
        $thisModel = new ClassifiedModel();
        $classified = $thisModel->isClassified($id);
        $response = array();
        if ($classified and $classified->getStatus() == "approved") {
            $cart = $thisModel->addCart($classified, $quantity, $name);
            $response['status'] = "success";
            $count = $cart->getItems()->count;
            $response['count'] = $count;
            $response['item'] = [
                'id' => $cart->getItems()->last->id,
                'classified_id' => $cart->getItems()->last->entry_id,
                'photo' => url($cart->getItems()->last->entry->cover_photo),
                'url' => $thisModel->getClassifiedDetailLinkByClassifiedId($classified->id),
                'name' => $classified->name,
                'quantity' => $cart->getItems()->last->quantity,
                'price' => app(Currency::class)->format($cart->getItems()->last->price, $cart->getItems()->last->currency),
                'subtotal' => app(Currency::class)->format($cart->subtotal, setting_value('streams::currency'))
            ];
        } else {
            $response['status'] = "error";
            $response['msg'] = trans('visiosoft.module.classifieds::message.error_added_cart');
        }
        return $response;
    }

    public function stockControl(Request $request, ClassifiedRepositoryInterface $classifiedRepository)
    {
        $quantity = $request->quantity;
        $id = $request->id;
        $type = $request->type;
        if ($request->dataType === 'classified-configuration') {
            $optionConf = new  OptionConfigurationModel();
            $classified = $optionConf->newQuery()->find($id);
            $status = $classified->stockControl($id, $quantity);
        } else {
            $classifiedmodel = new ClassifiedModel();
            $classified = $classifiedmodel->getClassified($id);
            $status = $classifiedmodel->stockControl($id, $quantity);
        }

        $response = array();
        if ($status == 1) {
            $response['newQuantity'] = $classifiedRepository->getQuantity($quantity, $type, $classified);

        } else {
            $response['newQuantity'] = $classified->stock;
        }

        $response['newPrice'] = $classified->price * $response['newQuantity'];

        $response['newPrice'] = app(Currency::class)->format($response['newPrice'], strtoupper($classified->currency));
        $response['status'] = $status;
        $response['maxQuantity'] = $classified->stock;
        return $response;
    }
}
