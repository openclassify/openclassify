<?php namespace Visiosoft\AdvsModule;

use Anomaly\FilesModule\File\FileModel;
use Anomaly\Streams\Platform\Addon\AddonCollection;
use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Anomaly\Streams\Platform\Model\Advs\AdvsStatusEntryModel;
use Anomaly\Streams\Platform\Model\Location\LocationVillageEntryModel;
use Anomaly\Streams\Platform\Ui\Table\Event\TableIsQuerying;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Routing\Router;
use Laravel\Passport\Passport;
use Visiosoft\AdvsModule\Adv\Contract\AdvRepositoryInterface;
use Visiosoft\AdvsModule\Adv\AdvRepository;
use Anomaly\Streams\Platform\Model\Advs\AdvsAdvsEntryModel;
use Visiosoft\AdvsModule\Adv\AdvModel;
use Visiosoft\AdvsModule\Adv\Form\AdvFormBuilder;
use Visiosoft\AdvsModule\Console\Commands\DeleteNonExistingCoverPhotos;
use Visiosoft\AdvsModule\Http\Middleware\redirectDiffrentLang;
use Visiosoft\AdvsModule\Http\Middleware\SetLang;
use Visiosoft\AdvsModule\Http\Middleware\Pages;
use Visiosoft\AdvsModule\Listener\AddAdvsSettingsScript;
use Visiosoft\AdvsModule\Listener\AddTotalSales;
use Visiosoft\AdvsModule\Option\Contract\OptionRepositoryInterface;
use Visiosoft\AdvsModule\Option\OptionRepository;
use Visiosoft\AdvsModule\OptionConfiguration\Contract\OptionConfigurationRepositoryInterface;
use Visiosoft\AdvsModule\OptionConfiguration\Form\OptionConfigurationFormBuilder;
use Visiosoft\AdvsModule\OptionConfiguration\OptionConfigurationRepository;
use Visiosoft\AdvsModule\Productoption\Contract\ProductoptionRepositoryInterface;
use Visiosoft\AdvsModule\Productoption\ProductoptionRepository;
use Visiosoft\AdvsModule\ProductoptionsValue\Contract\ProductoptionsValueRepositoryInterface;
use Visiosoft\AdvsModule\ProductoptionsValue\ProductoptionsValueRepository;
use Visiosoft\AdvsModule\Status\Contract\StatusRepositoryInterface;
use Visiosoft\AdvsModule\Status\StatusModel;
use Visiosoft\AdvsModule\Status\StatusRepository;
use Visiosoft\LocationModule\Village\Contract\VillageRepositoryInterface;
use Visiosoft\LocationModule\Village\VillageRepository;
use Visiosoft\LocationModule\Village\VillageModel;
use Visiosoft\CatsModule\Category\Contract\CategoryRepositoryInterface;
use Visiosoft\CatsModule\Category\CategoryRepository;
use Visiosoft\LocationModule\Country\Contract\CountryRepositoryInterface;
use Visiosoft\LocationModule\Country\CountryRepository;
use Visiosoft\OrdersModule\Orderdetail\Event\CreatedOrderDetail;

class AdvsModuleServiceProvider extends AddonServiceProvider
{

    protected $plugins = [
        AdvsModulePlugin::class,
    ];

    protected $commands = [
        DeleteNonExistingCoverPhotos::class
    ];

    protected $routes = [
        // Admin AdvsController
        'admin/advs' => [
            'as' => 'visiosoft.module.advs::admin_advs',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\Admin\AdvsController@index',
        ],
        'admin/assets/clear' => [
            'as' => 'assets_clear',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\Admin\AdvsController@assetsClear',
        ],
        'admin/advs-users/choose/{advId}' => 'Visiosoft\AdvsModule\Http\Controller\Admin\AdvsController@choose',
        'admin/ajax/multiple/multiple-update' => [
            'as' => 'visiosoft.module.advs::ajax_multiple_update',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\Admin\AdvsController@advancedUpdate',
        ],
        'admin/class/actions/{id}/{type}' => 'Visiosoft\AdvsModule\Http\Controller\Admin\AdvsController@actions',


        //Excel
        'admin/advs/export' => [
            'as' => 'advs::exportAdvs',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\Admin\AdvsController@exportAdvs',
        ],
        'admin/advs/import' => [
            'as' => 'visiosoft.module.advs::import.advs',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\Admin\ExcelController@import',
        ],

        // AdvsController

        'advs/list' => [
            'as' => 'visiosoft.module.advs::list',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\AdvsController@index'
        ],
        'ad/{seo}/{id}' => [
            'as' => 'adv_detail_seo',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\AdvsController@view'
        ],
        'ad/{id}' => [
            'as' => 'adv_detail',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\AdvsController@view'
        ],
        'c/{category?}/{city?}' => [
            'as' => 'adv_list_seo',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\AdvsController@index'
        ],
        'advs/list?user={id}' => [
            'as' => 'visiosoft.module.advs::list_user_ad',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\AdvsController@index',
        ],
        'advs/list?cat={id}' => [
            'as' => 'visiosoft.module.advs::list_cat',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\AdvsController@index',
        ],
        'advs/map?country={country}&city[]={city}&district={districts}' => [
            'as' => 'visiosoft.module.advs::show_ad_map_location',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\AdvsController@index'
        ],
        'advs/adv/{id}' => [
            'as' => 'adv_detail_backup',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\AdvsController@view'
        ],
        'advs/adv/{id}/{seo}' => [
            'as' => 'adv_detail_seo_backup',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\AdvsController@view'
        ],
        'advs/preview/{id}' => [
            'as' => 'advs_preview',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\AdvsController@preview'
        ],
        'advs/create_adv' => [
            'as' => "advs::create_adv",
            'middleware' => 'auth',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\AdvsController@cats',
        ],
        'advs/create_adv/post_cat' => [
            'as' => 'post_adv',
            'middleware' => 'auth',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\AdvsController@create',
        ],
        'advs/save_adv' => [
            'as' => 'visiosoft.module.advs::post_cat',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\AdvsController@store'
        ],
        'advs/edit_advs/{id}' => [
            'middleware' => 'auth',
            'as' => 'visiosoft.module.advs::edit_adv',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\AdvsController@edit',
        ],
        'advs/status/{id},{type}' => [
            'as' => 'visiosoft.module.advs::status',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\AdvsController@statusAds'
        ],
        'advs/delete/{id}' => [
            'as' => 'advs::delete',
            'middleware' => 'auth',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\AdvsController@deleteAd',
        ],

        'advs/multiple_operations' => [
            'as' => 'multiple_operations',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\AdvsController@multipleOperations',
        ],

        'adv/addCart/{id}' => [
            'as' => 'adv_AddCart',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\AdvsController@advAddCart',
        ],
        'ajax/StockControl' => [
            'as' => 'adv_stock_control_ajax',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\AdvsController@stockControl',
        ],
        'ajax/addCart' => [
            'as' => 'adv_add_cart_ajax',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\AdvsController@addCart',
        ],
        'view/{type}' => [
            'as' => 'visiosoft.module.advs::view_type',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\AdvsController@viewType',
        ],
        'adv/edit/category/{id}' => [
            'middleware' => 'auth',
            'as' => 'adv::edit_category',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\AdvsController@editCategoryForAd',
        ],
        'ajax/getcats/{id}' => [
            'as' => 'ajax::getCats',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\AdvsController@getCats',
        ],
        'advs/extendAll/{isAdmin?}' => [
            'as' => 'advs::extendAll',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\AdvsController@extendAll',
        ],
        'advs/extend/{adId}' => [
            'as' => 'advs::extendSingle',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\AdvsController@extendSingle',
        ],
        'categories/checkparent/{id}' => 'Visiosoft\AdvsModule\Http\Controller\AdvsController@checkParentCat',
        'getlocations' => 'Visiosoft\AdvsModule\Http\Controller\AdvsController@getLocations',
        'class/getcats/{id}' => 'Visiosoft\AdvsModule\Http\Controller\AdvsController@getCatsForNewAd',
        'mapJson' => 'Visiosoft\AdvsModule\Http\Controller\AdvsController@mapJson',
        'check_user' => 'Visiosoft\AdvsModule\Http\Controller\AdvsController@checkUser',
        'api/classified/get-by-coordinates' => 'Visiosoft\AdvsModule\Http\Controller\AdvsController@getClassifiedsByCoordinates',

        // AjaxController
        'admin/advs/ajax' => [
            'as' => 'visiosoft.module.advs::ajax',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\AjaxController@locations',
        ],
        'ajax/viewed/{id}' => [
            'as' => 'advs::viewed',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\AjaxController@viewed',
        ],
        'ajax/getAdvs' => [
            'as' => 'ajax::getAds',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\AjaxController@getMyAds'
        ],
        'ajax/get-advs-by-category/{categoryID}' => [
            'as' => 'ajax::getAdvsByCat',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\AjaxController@getAdvsByCat'
        ],
        'class/ajax' => 'Visiosoft\AdvsModule\Http\Controller\AjaxController@locations',
        'class/ajaxCategory' => 'Visiosoft\AdvsModule\Http\Controller\AjaxController@categories',
        'keySearch' => 'Visiosoft\AdvsModule\Http\Controller\AjaxController@keySearch',

        // CategoriesController
        'advs/c/{cat}' => 'Visiosoft\AdvsModule\Http\Controller\CategoriesController@listByCat',

        // Others
        'advs/ttr/{id}' => 'Visiosoft\PackagesModule\Http\Controller\packageFEController@advsStatusbyUser',

        //Configurations Admin Controller
        'admin/advs/option_configuration/create' => [
            'middleware' => 'auth',
            'as' => 'visiosoft.module.advs::configrations.create',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\Admin\OptionConfigurationController@create',
        ],
        'admin/advs/option_configuration' => [
            'as' => 'visiosoft.module.advs::configrations.index',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\Admin\OptionConfigurationController@index',
        ],

        //Configuration Controller
        'advs/option_configuration/create' => [
            'middleware' => 'auth',
            'as' => 'visiosoft.module.advs::user.configrations.create',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\OptionConfigurationController@create',
        ],

        'classified/configuration/ajax/create' => [
            'middleware' => 'auth',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\OptionConfigurationController@ajaxCreate'
        ],
        'classified/configuration/ajax/delete' => [
            'middleware' => 'auth',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\OptionConfigurationController@ajaxDelete'
        ],

        'api/classified/configuration/getOptions' => [
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\OptionConfigurationController@ajaxGetOptions',
        ],
        'api/classified/configuration/createOptions' => [
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\OptionConfigurationController@ajaxCreateOptions',
        ],

        'conf/addCart' => [
            'as' => 'configuration::add_cart',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\OptionConfigurationController@confAddCart',
        ],

        'api/conf/add-cart' => [
            'as' => 'configuration::api_add_conf_cart',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\OptionConfigurationController@ajaxConfAddCart',
        ],

        // Admin ProductoptionsController
        'admin/advs/product_options' => 'Visiosoft\AdvsModule\Http\Controller\Admin\ProductoptionsController@index',
        'admin/advs/product_options/create' => 'Visiosoft\AdvsModule\Http\Controller\Admin\ProductoptionsController@create',
        'admin/advs/product_options/edit/{id}' => 'Visiosoft\AdvsModule\Http\Controller\Admin\ProductoptionsController@edit',

        // StatusController
        'ad/{ad_id}/change-status/{status_id}' => [
            'as' => 'visiosoft.module.advs::ad.change.status',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\StatusController@change'
        ],

        // Admin ReportController
        'admin/api/classified/report/stock' => 'Visiosoft\AdvsModule\Http\Controller\Admin\ReportController@stock',
        'admin/api/classified/report/status' => 'Visiosoft\AdvsModule\Http\Controller\Admin\ReportController@status',
        'admin/api/classified/report/unexplained' => 'Visiosoft\AdvsModule\Http\Controller\Admin\ReportController@unexplained',
        'admin/api/classified/report/no-image' => 'Visiosoft\AdvsModule\Http\Controller\Admin\ReportController@noImage',
        'admin/api/classified/report/page' => 'Visiosoft\AdvsModule\Http\Controller\Admin\ReportController@page',
        'admin/api/query-advs' => 'Visiosoft\AdvsModule\Http\Controller\Admin\AdvsController@queryAdvs',

        // Cron Routes
        'cron/update-created-at-date' => 'Visiosoft\AdvsModule\Http\Controller\AdvsController@updateCreatedAtDates',
        '/eidsReturn' => 'Visiosoft\AdvsModule\Http\Controller\EidsController@eidsReturn'
    ];

    protected $middleware = [
        SetLang::class,
        redirectDiffrentLang::class,
    ];

    protected $providers = [];

    protected $listeners = [
        TableIsQuerying::class => [
            AddAdvsSettingsScript::class,
        ],
        CreatedOrderDetail::class => [
            AddTotalSales::class,
        ]
    ];

    protected $bindings = [
        LocationVillageEntryModel::class => VillageModel::class,
        AdvsAdvsEntryModel::class => AdvModel::class,
        AdvsStatusEntryModel::class => StatusModel::class,
        'my_form' => AdvFormBuilder::class,
        'configuration_form' => OptionConfigurationFormBuilder::class,
    ];

    protected $singletons = [
        AdvRepositoryInterface::class => AdvRepository::class,
        VillageRepositoryInterface::class => VillageRepository::class,
        CategoryRepositoryInterface::class => CategoryRepository::class,
        CountryRepositoryInterface::class => CountryRepository::class,
        OptionRepositoryInterface::class => OptionRepository::class,
        ProductoptionRepositoryInterface::class => ProductoptionRepository::class,
        OptionConfigurationRepositoryInterface::class => OptionConfigurationRepository::class,
        ProductoptionsValueRepositoryInterface::class => ProductoptionsValueRepository::class,
        StatusRepositoryInterface::class => StatusRepository::class,
    ];

    protected $overrides = [
        'streams::form.partials.translations' => 'visiosoft.module.advs::form.partials.translations',
    ];

    public function boot(AddonCollection $addonCollection, FileModel $fileModel, CategoryRepositoryInterface $categoryRepository)
    {

        $settings_url = [
            'general_settings' => [
                'title' => 'visiosoft.module.advs::button.general_settings',
                'href' => '/admin/settings/modules/visiosoft.module.advs',
                'page' => 'anomaly.module.settings'
            ],
            'theme_settings' => [
                'title' => 'visiosoft.theme.defaultadmin::section.theme_settings.name',
                'href' => url('admin/settings/themes/' . setting_value('streams::standard_theme')),
                'page' => 'anomaly.module.settings'
            ],
            'assets_clear' => [
                'title' => 'visiosoft.module.advs::section.assets_clear.name',
                'href' => route('assets_clear'),
                'page' => 'anomaly.module.settings'
            ],
            'export' => [
                'title' => 'visiosoft.module.advs::button.export',
                'href' => route('advs::exportAdvs'),
                'page' => 'visiosoft.module.advs'
            ],
            'import' => [
                'title' => 'visiosoft.module.advs::button.import',
                'href' => route('visiosoft.module.advs::import.advs'),
                'page' => 'visiosoft.module.advs'
            ]
        ];

        foreach ($settings_url as $key => $value) {
            $addonCollection->get($value['page'])->addSection($key, $value);
        }

        // Disable file versioning
        $fileModel->disableVersioning();
    }

    public function mapRouters(Router $router)
    {
        $router->get(
            '{path}?user={id}',
            [
                'as' => 'visiosoft.module.advs::list_user_ad_mlang',
                'uses' => 'Visiosoft\AdvsModule\Http\Controller\AdvsController@changeableAdSlug',
            ]
        );

        $router->get(
            '{path}?cat={id}',
            [
                'as' => 'visiosoft.module.advs::list_cat_mlang',
                'uses' => 'Visiosoft\AdvsModule\Http\Controller\AdvsController@changeableAdSlug',
            ]
        );

        $router->get(
            '{path}/map?country={country}&city[]={city}&district={districts}',
            [
                'as' => 'visiosoft.module.advs::show_ad_map_location_mlang',
                'uses' => 'Visiosoft\AdvsModule\Http\Controller\AdvsController@changeableAdSlug'
            ]
        );


        $router->get(
            '{path}/{seo}/{id}',
            [
                'as' => 'adv_detail_seo_mlang',
                'uses' => 'Visiosoft\AdvsModule\Http\Controller\AdvsController@changeableAdSlug',
                'where' => [
                    'path' => '^(?!api|admin|ajax|form)([\w\/-]*)$'
                ],
            ]
        );

        $router->get(
            '{category}/{city}',
            [
                'as' => 'adv_list_seo_mlang',
                'uses' => 'Visiosoft\AdvsModule\Http\Controller\AdvsController@changeableAdSlug',
                'where' => [
                    'category' => '^(?!api|admin|ajax|form)([\w\/-]*)$',
                ],
            ]
        );


        $router->get(
            '{path}',
            [
                'as' => 'visiosoft.module.advs::list_mlang',
                'uses' => 'Visiosoft\AdvsModule\Http\Controller\AdvsController@changeableAdSlug',
                'middleware' => [SetLang::class],
                'where' => [
                    'path' => '^(?!api|admin|ajax|form)([\w\/-]*)$'
                ],
            ]
        );

    }

    public function map(Router $router)
    {
        $this->mapRouters($router);
    }
}
