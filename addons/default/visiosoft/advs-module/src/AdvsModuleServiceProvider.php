<?php namespace Visiosoft\AdvsModule;

use Anomaly\Streams\Platform\Addon\AddonCollection;
use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Anomaly\Streams\Platform\Model\Location\LocationVillageEntryModel;
use Visiosoft\AdvsModule\Adv\Contract\AdvRepositoryInterface;
use Visiosoft\AdvsModule\Adv\AdvRepository;
use Anomaly\Streams\Platform\Model\Advs\AdvsAdvsEntryModel;
use Visiosoft\AdvsModule\Adv\AdvModel;
use Visiosoft\AdvsModule\Adv\Form\AdvFormBuilder;
use Visiosoft\LocationModule\Village\Contract\VillageRepositoryInterface;
use Visiosoft\LocationModule\Village\VillageRepository;
use Visiosoft\LocationModule\Village\VillageModel;
use Visiosoft\CatsModule\Category\Contract\CategoryRepositoryInterface;
use Visiosoft\CatsModule\Category\CategoryRepository;
use Anomaly\Streams\Platform\Model\Advs\AdvsCategoriesEntryModel;
use Visiosoft\CatsModule\Category\CategoryModel;
use Illuminate\Routing\Router;
use Visiosoft\LocationModule\Country\Contract\CountryRepositoryInterface;
use Visiosoft\LocationModule\Country\CountryRepository;

class AdvsModuleServiceProvider extends AddonServiceProvider
{

    /**
     * Additional addon plugins.
     *
     * @type array|null
     */
    protected $plugins = [
        AdvsModulePlugin::class,
    ];

    /**
     * The addon Artisan commands.
     *
     * @type array|null
     */
    protected $commands = [];

    /**
     * The addon's scheduled commands.
     *
     * @type array|null
     */
    protected $schedules = [];

    /**
     * The addon API routes.
     *
     * @type array|null
     */
    protected $api = [];

    /**
     * The addon routes.
     *
     * @type array|null
     */
    protected $routes = [
        // 'admin/advs/cf_values'           => 'Visiosoft\AdvsModule\Http\Controller\Admin\CfValuesController@index',
        // 'admin/advs/cf_values/create'    => 'Visiosoft\AdvsModule\Http\Controller\Admin\CfValuesController@create',
        // 'admin/advs/cf_values/edit/{id}' => 'Visiosoft\AdvsModule\Http\Controller\Admin\CfValuesController@edit',
        // 'admin/advs/custom_field_advs'           => 'Visiosoft\AdvsModule\Http\Controller\Admin\CustomFieldAdvsController@index',
        // 'admin/advs/custom_field_advs/create'    => 'Visiosoft\AdvsModule\Http\Controller\Admin\CustomFieldAdvsController@create',
        // 'admin/advs/custom_field_advs/edit/{id}' => 'Visiosoft\AdvsModule\Http\Controller\Admin\CustomFieldAdvsController@edit',
        // 'admin/advs/custom_fields'           => 'Visiosoft\AdvsModule\Http\Controller\Admin\CustomFieldsController@index',
        // 'admin/advs/custom_fields/create'    => 'Visiosoft\AdvsModule\Http\Controller\Admin\CustomFieldsController@create',
        // 'admin/advs/custom_fields/edit/{id}' => 'Visiosoft\AdvsModule\Http\Controller\Admin\CustomFieldsController@edit',
        'admin/advs/advs' => 'Visiosoft\AdvsModule\Http\Controller\Admin\AdvsController@index',
        'admin/advs/advs/create' => 'Visiosoft\AdvsModule\Http\Controller\Admin\AdvsController@create',
        'admin/advs/advs/edit/{id}' => 'Visiosoft\AdvsModule\Http\Controller\Admin\AdvsController@edit',
        'admin/advs/village' => 'Visiosoft\AdvsModule\Http\Controller\Admin\VillageController@index',
        'admin/advs/village/create' => 'Visiosoft\AdvsModule\Http\Controller\Admin\VillageController@create',
        'admin/advs/village/edit/{id}' => 'Visiosoft\AdvsModule\Http\Controller\Admin\VillageController@edit',
        'categories/checkparent/{id}' => 'Visiosoft\AdvsModule\Http\Controller\advsController@checkParentCat',
        'admin/advs/ajax' => [
            'as' => 'visiosoft.module.advs::ajax',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\AjaxController@locations',
        ],
        'ajax/viewed/{id}' => [
            'as' => 'advs::viewed',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\AjaxController@viewed',
        ],
        'class/ajax' => [
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\AjaxController@locations',
        ],
        'class/ajaxCategory' => [
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\AjaxController@categories',
        ],
        'admin/advs' => 'Visiosoft\AdvsModule\Http\Controller\Admin\AdvsController@index',
        'admin/advs/create' => 'Visiosoft\AdvsModule\Http\Controller\Admin\AdvsController@create',
        'admin/advs/edit/{id}' => 'Visiosoft\AdvsModule\Http\Controller\Admin\AdvsController@edit',
        'admin/advs/list' => [
            'as' => 'visiosoft.module.advs::admin-list',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\Admin\AdvsController@manage'
        ],
        'admin/class/actions/{id}/{type}' => 'Visiosoft\AdvsModule\Http\Controller\Admin\AdvsController@actions',
        'advs/list' => [
            'as' => 'visiosoft.module.advs::list',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\advsController@index'
        ],
        'advs/list?user={id}' => [
            'as' => 'visiosoft.module.advs::list_user_ad',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\advsController@index',
        ],
        'advs/list?cat={id}' => [
            'as' => 'visiosoft.module.advs::list_cat',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\advsController@index',
        ],
        'getlocations' => 'Visiosoft\AdvsModule\Http\Controller\advsController@getLocations',
        'advs/main' => 'Visiosoft\AdvsModule\Http\Controller\advsController@advsMainPage',
        'advs/adv/{id}' => [
            'as' => 'adv_detail',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\advsController@view'
        ],
        'advs/adv/{id}/{seo}' => [
            'as' => 'adv_detail_seo',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\advsController@view'
        ],
        'ad/{id}' => [
            'as' => 'adv_detail',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\advsController@view'
        ],
        'ad/{seo}/{id}' => [
            'as' => 'adv_detail_seo',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\advsController@view'
        ],
        'advs/map?country={country}&city[]={city}&district={districts}' => [
            'as' => 'visiosoft.module.advs::show_ad_map_location',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\advsController@map'
        ],
        'advs/categories' => 'Visiosoft\AdvsModule\Http\Controller\CategoriesController@index',
        'advs/c/{cat}' => 'Visiosoft\AdvsModule\Http\Controller\CategoriesController@listByCat',
        'c/{category?}/{city?}' => [
            'as' => 'adv_list_seo',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\advsController@index'
        ],
        'advs/module_active' => 'Visiosoft\AdvsModule\Http\Controller\advsController@index',
        'advs/create_adv' => [
            'as' => "advs::create_adv",
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\advsController@cats',
        ],
        'advs/create_adv/post_cat' => [
            'as' => 'post_adv',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\advsController@create',
        ],
        'class/getcats/{id}' => 'Visiosoft\AdvsModule\Http\Controller\advsController@getCatsForNewAd',
        'advs/save_adv' => [
            'as' => 'visiosoft.module.advs::post_cat',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\advsController@store'
        ],
        'advs/my_advs' => 'Visiosoft\AdvsModule\Http\Controller\advsController@myAdvs',
        'advs/my_advs/{params}' => 'Visiosoft\AdvsModule\Http\Controller\advsController@myAdvs',
        'advs/edit_advs/{id}' => 'Visiosoft\AdvsModule\Http\Controller\advsController@edit',
        'advs/status/{id},{type}' => [
            'as' => 'visiosoft.module.advs::status',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\advsController@statusAds'
        ],
        'routes' => 'Visiosoft\AdvsModule\Http\Controller\advsController@routes',
        'advs/map/advs/list' => [
            'as' => 'advs_map_list',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\advsController@map',
        ],
        'advs/map' => [
            'as' => 'advs_map',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\advsController@map',
        ],
        'mapJson' => 'Visiosoft\AdvsModule\Http\Controller\advsController@mapJson',
        'advs/ttr/{id}' => 'Visiosoft\PackagesModule\Http\Controller\packageFEController@advsStatusbyUser',
        'advs/delete/{id}' => [
            'as' => 'advs::delete',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\advsController@deleteAd',
        ],
        'check_user' => 'Visiosoft\AdvsModule\Http\Controller\advsController@checkUser',
        'keySearch' => 'Visiosoft\AdvsModule\Http\Controller\AjaxController@keySearch',
        'adv/addCart/{id}' => [
            'as' => 'adv_AddCart',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\advsController@advAddCart',
        ],
        'ajax/StockControl' => [
            'as' => 'adv_stock_control_ajax',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\advsController@stockControl',
        ],
        'ajax/addCart' => [
            'as' => 'adv_add_cart_ajax',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\advsController@addCart',
        ],
        'ajax/countPhone' => [
            'as' => 'adv_count_show_phone',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\advsController@showPhoneCounter',
        ],
        'view/{type}' => [
            'as' => 'visiosoft.module.advs::view_type',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\advsController@viewType',
        ],
        'admin/assets/clear' => [
            'as' => 'assets_clear',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\Admin\AdvsController@assetsClear',
        ],
        'adv/edit/category/{id}' => [
            'as' => 'adv::edit_category',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\advsController@editCategoryForAd',
        ],
        'ajax/getcats/{id}' => [
            'as' => 'ajax::getCats',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\advsController@getCats',
        ],


        'ajax/getAds' => [
            'as' => 'ajax::getAds',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\AjaxController@getMyAds'
        ],
        'advs/extendAll/{isAdmin?}' => [
            'as' => 'advs::extendAll',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\AdvsController@extendAll',
        ],
        'advs/extend/{adId}' => [
            'as' => 'advs::extendSingle',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\AdvsController@extendSingle',
        ],
    ];

    /**
     * The addon middleware.
     *
     * @type array|null
     */
    protected $middleware = [
        //Visiosoft\AdvsModule\Http\Middleware\ExampleMiddleware::class
    ];

    /**
     * Addon group middleware.
     *
     * @var array
     */
    protected $groupMiddleware = [
        //'web' => [
        //    Visiosoft\AdvsModule\Http\Middleware\ExampleMiddleware::class,
        //],
    ];

    /**
     * Addon route middleware.
     *
     * @type array|null
     */
    protected $routeMiddleware = [];

    /**
     * The addon event listeners.
     *
     * @type array|null
     */
    protected $listeners = [
        //Visiosoft\AdvsModule\Event\ExampleEvent::class => [
        //    Visiosoft\AdvsModule\Listener\ExampleListener::class,
        //],
    ];

    /**
     * The addon alias bindings.
     *
     * @type array|null
     */
    protected $aliases = [
        //'Example' => Visiosoft\AdvsModule\Example::class
    ];

    /**
     * The addon class bindings.
     *
     * @type array|null
     */
    protected $bindings = [
        // AdvsCfValuesEntryModel::class => CfValueModel::class,
        // AdvsCustomFieldAdvsEntryModel::class => CustomFieldAdvModel::class,
        // AdvsCustomFieldsEntryModel::class => CustomFieldModel::class,
        AdvsAdvsEntryModel::class => AdvModel::class,
        LocationVillageEntryModel::class => VillageModel::class,
        AdvsCategoriesEntryModel::class => CategoryModel::class,
        AdvsAdvsEntryModel::class => AdvModel::class,
        'my_form' => AdvFormBuilder::class,
    ];

    /**
     * The addon singleton bindings.
     *
     * @type array|null
     */
    protected $singletons = [
        // CfValueRepositoryInterface::class => CfValueRepository::class,
        // CustomFieldAdvRepositoryInterface::class => CustomFieldAdvRepository::class,
        // CustomFieldRepositoryInterface::class => CustomFieldRepository::class,
        AdvRepositoryInterface::class => AdvRepository::class,
        VillageRepositoryInterface::class => VillageRepository::class,
        CategoryRepositoryInterface::class => CategoryRepository::class,
        CountryRepositoryInterface::class => CountryRepository::class,
        AdvRepositoryInterface::class => AdvRepository::class,
    ];

    /**
     * Additional service providers.
     *
     * @type array|null
     */
    protected $providers = [
        //\ExamplePackage\Provider\ExampleProvider::class
    ];

    /**
     * The addon view overrides.
     *
     * @type array|null
     */
    protected $overrides = [
        'streams::form/form' => 'visiosoft.module.advs::form/form',
        //'streams::errors/404' => 'module::errors/404',
        //'streams::errors/500' => 'module::errors/500',
    ];

    /**
     * The addon mobile-only view overrides.
     *
     * @type array|null
     */
    protected $mobile = [
        //'streams::errors/404' => 'module::mobile/errors/404',
        //'streams::errors/500' => 'module::mobile/errors/500',
    ];

    /**
     * Register the addon.
     */
    public function register()
    {
        // Run extra pre-boot registration logic here.
        // Use method injection or commands to bring in services.
    }

    /**
     * Boot the addon.
     */
    public function boot(AddonCollection $addonCollection)
    {
        // Run extra post-boot registration logic here.
        // Use method injection or commands to bring in services.
        $slug = 'general_settings';
        $section = [
            'title' => 'visiosoft.module.advs::button.general_settings',
            'href' => '/admin/settings/modules/visiosoft.module.advs',
        ];
        $slug2 = 'assets_clear';
        $section2 = [
            'title' => 'visiosoft.module.advs::section.assets_clear.name',
            'href' => '/admin/assets/clear',
        ];
        $addonCollection->get('anomaly.module.settings')->addSection($slug, $section);
        $addonCollection->get('anomaly.module.settings')->addSection($slug2, $section2);
    }

    /**
     * Map additional addon routes.
     *
     * @param Router $router
     */
    // public function map(Router $router)
    // {
    //     // Register dynamic routes here for example.
    //     // Use method injection or commands to bring in services.
    // }
    public function map(Router $router)
    {
    }
}
