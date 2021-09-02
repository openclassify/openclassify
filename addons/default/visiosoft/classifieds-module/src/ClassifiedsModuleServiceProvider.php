<?php namespace Visiosoft\ClassifiedsModule;


use Anomaly\FilesModule\File\FileModel;
use Anomaly\Streams\Platform\Addon\AddonCollection;
use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Anomaly\Streams\Platform\Model\Classifieds\ClassifiedsStatusEntryModel;
use Anomaly\Streams\Platform\Model\Location\LocationVillageEntryModel;
use Anomaly\Streams\Platform\Ui\Table\Event\TableIsQuerying;
use Visiosoft\ClassifiedsModule\Classified\Contract\ClassifiedRepositoryInterface;
use Visiosoft\ClassifiedsModule\Classified\ClassifiedRepository;
use Anomaly\Streams\Platform\Model\Classifieds\ClassifiedsClassifiedsEntryModel;
use Visiosoft\ClassifiedsModule\Classified\ClassifiedModel;
use Visiosoft\ClassifiedsModule\Classified\Form\ClassifiedFormBuilder;
use Visiosoft\ClassifiedsModule\Http\Middleware\redirectDiffrentLang;
use Visiosoft\ClassifiedsModule\Http\Middleware\SetLang;
use Visiosoft\ClassifiedsModule\Listener\AddClassifiedsSettingsScript;
use Visiosoft\ClassifiedsModule\Listener\AddTotalSales;
use Visiosoft\ClassifiedsModule\Option\Contract\OptionRepositoryInterface;
use Visiosoft\ClassifiedsModule\Option\OptionRepository;
use Visiosoft\ClassifiedsModule\OptionConfiguration\Contract\OptionConfigurationRepositoryInterface;
use Visiosoft\ClassifiedsModule\OptionConfiguration\Form\OptionConfigurationFormBuilder;
use Visiosoft\ClassifiedsModule\OptionConfiguration\OptionConfigurationRepository;
use Visiosoft\ClassifiedsModule\Productoption\Contract\ProductoptionRepositoryInterface;
use Visiosoft\ClassifiedsModule\Productoption\ProductoptionRepository;
use Visiosoft\ClassifiedsModule\ProductoptionsValue\Contract\ProductoptionsValueRepositoryInterface;
use Visiosoft\ClassifiedsModule\ProductoptionsValue\ProductoptionsValueRepository;
use Visiosoft\ClassifiedsModule\Status\Contract\StatusRepositoryInterface;
use Visiosoft\ClassifiedsModule\Status\StatusModel;
use Visiosoft\ClassifiedsModule\Status\StatusRepository;
use Visiosoft\LocationModule\Village\Contract\VillageRepositoryInterface;
use Visiosoft\LocationModule\Village\VillageRepository;
use Visiosoft\LocationModule\Village\VillageModel;
use Visiosoft\CatsModule\Category\Contract\CategoryRepositoryInterface;
use Visiosoft\CatsModule\Category\CategoryRepository;
use Visiosoft\LocationModule\Country\Contract\CountryRepositoryInterface;
use Visiosoft\LocationModule\Country\CountryRepository;
use Visiosoft\OrdersModule\Orderdetail\Event\CreatedOrderDetail;

class ClassifiedsModuleServiceProvider extends AddonServiceProvider
{
    protected $plugins = [
        ClassifiedsModulePlugin::class,
    ];

    protected $routes = [
        // Admin ClassifiedsController
        'admin/classifieds' => [
            'as' => 'visiosoft.module.classifieds::admin_classifieds',
            'uses' => 'Visiosoft\ClassifiedsModule\Http\Controller\Admin\ClassifiedsController@index',
        ],
        'admin/assets/clear' => [
            'as' => 'assets_clear',
            'uses' => 'Visiosoft\ClassifiedsModule\Http\Controller\Admin\ClassifiedsController@assetsClear',
        ],
        'admin/classifieds-users/choose/{classifiedId}' => 'Visiosoft\ClassifiedsModule\Http\Controller\Admin\ClassifiedsController@choose',
        'admin/ajax/multiple/multiple-update' => [
            'as' => 'visiosoft.module.classifieds::ajax_multiple_update',
            'uses' => 'Visiosoft\ClassifiedsModule\Http\Controller\Admin\ClassifiedsController@classifiedancedUpdate',
        ],
        'admin/class/actions/{id}/{type}' => 'Visiosoft\ClassifiedsModule\Http\Controller\Admin\ClassifiedsController@actions',


        //Excel
        'admin/classifieds/export' => [
            'as' => 'classifieds::exportClassifieds',
            'uses' => 'Visiosoft\ClassifiedsModule\Http\Controller\Admin\ClassifiedsController@exportClassifieds',
        ],
        'admin/classifieds/import' => [
            'as' => 'visiosoft.module.classifieds::import.classifieds',
            'uses' => 'Visiosoft\ClassifiedsModule\Http\Controller\Admin\ExcelController@import',
        ],

        // ClassifiedsController
        'classifieds/list' => [
            'as' => 'visiosoft.module.classifieds::list',
            'uses' => 'Visiosoft\ClassifiedsModule\Http\Controller\ClassifiedsController@index'
        ],
        'classifieds/list?user={id}' => [
            'as' => 'visiosoft.module.classifieds::list_user_ad',
            'uses' => 'Visiosoft\ClassifiedsModule\Http\Controller\ClassifiedsController@index',
        ],
        'classifieds/list?cat={id}' => [
            'as' => 'visiosoft.module.classifieds::list_cat',
            'uses' => 'Visiosoft\ClassifiedsModule\Http\Controller\ClassifiedsController@index',
        ],
        'classifieds/classified/{id}' => [
            'as' => 'classified_detail_backup',
            'uses' => 'Visiosoft\ClassifiedsModule\Http\Controller\ClassifiedsController@view'
        ],
        'classifieds/classified/{id}/{seo}' => [
            'as' => 'classified_detail_seo_backup',
            'uses' => 'Visiosoft\ClassifiedsModule\Http\Controller\ClassifiedsController@view'
        ],
        'classified/{id}' => [
            'as' => 'classified_detail',
            'uses' => 'Visiosoft\ClassifiedsModule\Http\Controller\ClassifiedsController@view'
        ],
        'classified/{seo}/{id}' => [
            'as' => 'classified_detail_seo',
            'uses' => 'Visiosoft\ClassifiedsModule\Http\Controller\ClassifiedsController@view'
        ],
        'classifieds/preview/{id}' => [
            'as' => 'classifieds_preview',
            'uses' => 'Visiosoft\ClassifiedsModule\Http\Controller\ClassifiedsController@preview'
        ],
        'classifieds/map?country={country}&city[]={city}&district={districts}' => [
            'as' => 'visiosoft.module.classifieds::show_ad_map_location',
            'uses' => 'Visiosoft\ClassifiedsModule\Http\Controller\ClassifiedsController@index'
        ],
        'c/{category?}/{city?}' => [
            'as' => 'classified_list_seo',
            'uses' => 'Visiosoft\ClassifiedsModule\Http\Controller\ClassifiedsController@index'
        ],
        'classifieds/create_classified' => [
            'as' => "classifieds::create_classified",
            'uses' => 'Visiosoft\ClassifiedsModule\Http\Controller\ClassifiedsController@cats',
        ],
        'classifieds/create_classified/post_cat' => [
            'as' => 'post_classified',
            'uses' => 'Visiosoft\ClassifiedsModule\Http\Controller\ClassifiedsController@create',
        ],
        'classifieds/save_classified' => [
            'as' => 'visiosoft.module.classifieds::post_cat',
            'uses' => 'Visiosoft\ClassifiedsModule\Http\Controller\ClassifiedsController@store'
        ],
        'classifieds/edit_classifieds/{id}' => [
            'middleware' => 'auth',
            'as' => 'visiosoft.module.classifieds::edit_classified',
            'uses' => 'Visiosoft\ClassifiedsModule\Http\Controller\ClassifiedsController@edit',
        ],
        'classifieds/status/{id},{type}' => [
            'as' => 'visiosoft.module.classifieds::status',
            'uses' => 'Visiosoft\ClassifiedsModule\Http\Controller\ClassifiedsController@statusClassifieds'
        ],
        'classifieds/delete/{id}' => [
            'as' => 'classifieds::delete',
            'uses' => 'Visiosoft\ClassifiedsModule\Http\Controller\ClassifiedsController@deleteAd',
        ],
        'classified/addCart/{id}' => [
            'as' => 'classified_AddCart',
            'uses' => 'Visiosoft\ClassifiedsModule\Http\Controller\ClassifiedsController@classifiedAddCart',
        ],
        'ajax/StockControl' => [
            'as' => 'classified_stock_control_ajax',
            'uses' => 'Visiosoft\ClassifiedsModule\Http\Controller\ClassifiedsController@stockControl',
        ],
        'ajax/addCart' => [
            'as' => 'classified_add_cart_ajax',
            'uses' => 'Visiosoft\ClassifiedsModule\Http\Controller\ClassifiedsController@addCart',
        ],
        'view/{type}' => [
            'as' => 'visiosoft.module.classifieds::view_type',
            'uses' => 'Visiosoft\ClassifiedsModule\Http\Controller\ClassifiedsController@viewType',
        ],
        'classified/edit/category/{id}' => [
            'middleware' => 'auth',
            'as' => 'classified::edit_category',
            'uses' => 'Visiosoft\ClassifiedsModule\Http\Controller\ClassifiedsController@editCategoryForAd',
        ],
        'ajax/getcats/{id}' => [
            'as' => 'ajax::getCats',
            'uses' => 'Visiosoft\ClassifiedsModule\Http\Controller\ClassifiedsController@getCats',
        ],
        'classifieds/extendAll/{isAdmin?}' => [
            'as' => 'classifieds::extendAll',
            'uses' => 'Visiosoft\ClassifiedsModule\Http\Controller\ClassifiedsController@extendAll',
        ],
        'classifieds/extend/{adId}' => [
            'as' => 'classifieds::extendSingle',
            'uses' => 'Visiosoft\ClassifiedsModule\Http\Controller\ClassifiedsController@extendSingle',
        ],
        'categories/checkparent/{id}' => 'Visiosoft\ClassifiedsModule\Http\Controller\ClassifiedsController@checkParentCat',
        'getlocations' => 'Visiosoft\ClassifiedsModule\Http\Controller\ClassifiedsController@getLocations',
        'class/getcats/{id}' => 'Visiosoft\ClassifiedsModule\Http\Controller\ClassifiedsController@getCatsForNewAd',
        'mapJson' => 'Visiosoft\ClassifiedsModule\Http\Controller\ClassifiedsController@mapJson',
        'check_user' => 'Visiosoft\ClassifiedsModule\Http\Controller\ClassifiedsController@checkUser',

        // AjaxController
        'admin/classifieds/ajax' => [
            'as' => 'visiosoft.module.classifieds::ajax',
            'uses' => 'Visiosoft\ClassifiedsModule\Http\Controller\AjaxController@locations',
        ],
        'ajax/viewed/{id}' => [
            'as' => 'classifieds::viewed',
            'uses' => 'Visiosoft\ClassifiedsModule\Http\Controller\AjaxController@viewed',
        ],
        'ajax/getClassifieds' => [
            'as' => 'ajax::getClassifieds',
            'uses' => 'Visiosoft\ClassifiedsModule\Http\Controller\AjaxController@getMyClassifieds'
        ],
        'ajax/get-classifieds-by-category/{categoryID}' => [
            'as' => 'ajax::getClassifiedsByCat',
            'uses' => 'Visiosoft\ClassifiedsModule\Http\Controller\AjaxController@getClassifiedsByCat'
        ],
        'class/ajax' => 'Visiosoft\ClassifiedsModule\Http\Controller\AjaxController@locations',
        'class/ajaxCategory' => 'Visiosoft\ClassifiedsModule\Http\Controller\AjaxController@categories',
        'keySearch' => 'Visiosoft\ClassifiedsModule\Http\Controller\AjaxController@keySearch',

        // CategoriesController
        'classifieds/c/{cat}' => 'Visiosoft\ClassifiedsModule\Http\Controller\CategoriesController@listByCat',

        // Others
        'classifieds/ttr/{id}' => 'Visiosoft\PackagesModule\Http\Controller\packageFEController@classifiedsStatusbyUser',

        //Configurations Admin Controller
        'admin/classifieds/option_configuration/create' => [
            'as' => 'visiosoft.module.classifieds::configrations.create',
            'uses' => 'Visiosoft\ClassifiedsModule\Http\Controller\Admin\OptionConfigurationController@create',
        ],
        'admin/classifieds/option_configuration' => [
            'as' => 'visiosoft.module.classifieds::configrations.index',
            'uses' => 'Visiosoft\ClassifiedsModule\Http\Controller\Admin\OptionConfigurationController@index',
        ],

        //Configuration Controller
        'classifieds/option_configuration/create' => [
            'as' => 'visiosoft.module.classifieds::user.configrations.create',
            'uses' => 'Visiosoft\ClassifiedsModule\Http\Controller\OptionConfigurationController@create',
        ],

        'classifieds/configuration/ajax/create' => [
            'middleware' => 'auth',
            'uses' => 'Visiosoft\ClassifiedsModule\Http\Controller\OptionConfigurationController@ajaxCreate'
        ],
        'classifieds/configuration/ajax/delete' => [
            'middleware' => 'auth',
            'uses' => 'Visiosoft\ClassifiedsModule\Http\Controller\OptionConfigurationController@ajaxDelete'
        ],

        'conf/addCart' => [
            'as' => 'configuration::add_cart',
            'uses' => 'Visiosoft\ClassifiedsModule\Http\Controller\OptionConfigurationController@confAddCart',
        ],

	    'api/conf/add-cart' => [
		    'as' => 'configuration::api_add_conf_cart',
		    'uses' => 'Visiosoft\ClassifiedsModule\Http\Controller\OptionConfigurationController@ajaxConfAddCart',
	    ],

        // Admin ProductoptionsController
        'admin/classifieds/product_options' => 'Visiosoft\ClassifiedsModule\Http\Controller\Admin\ProductoptionsController@index',
        'admin/classifieds/product_options/create' => 'Visiosoft\ClassifiedsModule\Http\Controller\Admin\ProductoptionsController@create',
        'admin/classifieds/product_options/edit/{id}' => 'Visiosoft\ClassifiedsModule\Http\Controller\Admin\ProductoptionsController@edit',

        // StatusController
        'classified/{ad_id}/change-status/{status_id}' => [
            'as' => 'visiosoft.module.classifieds::classified.change.status',
            'uses' => 'Visiosoft\ClassifiedsModule\Http\Controller\StatusController@change'
        ],
    ];

    protected $middleware = [
        SetLang::class,
        redirectDiffrentLang::class,
    ];

    protected $listeners = [
        TableIsQuerying::class => [
            AddClassifiedsSettingsScript::class,
        ], CreatedOrderDetail::class => [
			AddTotalSales::class,
	    ]
    ];

    protected $bindings = [
        LocationVillageEntryModel::class => VillageModel::class,
        ClassifiedsClassifiedsEntryModel::class => ClassifiedModel::class,
        ClassifiedsStatusEntryModel::class => StatusModel::class,
        'my_form' => ClassifiedFormBuilder::class,
        'configuration_form' => OptionConfigurationFormBuilder::class,
    ];

    protected $singletons = [
        ClassifiedRepositoryInterface::class => ClassifiedRepository::class,
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
        'streams::form.partials.translations' => 'visiosoft.module.classifieds::form.partials.translations',
    ];

    public function boot(AddonCollection $addonCollection, FileModel $fileModel,CategoryRepositoryInterface $categoryRepository)
    {

        $settings_url = [
            'general_settings' => [
                'title' => 'visiosoft.module.classifieds::button.general_settings',
                'href' => '/admin/settings/modules/visiosoft.module.classifieds',
                'page' => 'anomaly.module.settings'
            ],
            'theme_settings' => [
                'title' => 'visiosoft.theme.defaultadmin::section.theme_settings.name',
                'href' => url('admin/settings/themes/' . setting_value('streams::standard_theme')),
                'page' => 'anomaly.module.settings'
            ],
            'assets_clear' => [
                'title' => 'visiosoft.module.classifieds::section.assets_clear.name',
                'href' => route('assets_clear'),
                'page' => 'anomaly.module.settings'
            ],
            'export' => [
                'title' => 'visiosoft.module.classifieds::button.export',
                'href' => route('classifieds::exportClassifieds'),
                'page' => 'visiosoft.module.classifieds'
            ],
            'import' => [
                'title' => 'visiosoft.module.classifieds::button.import',
                'href' => route('visiosoft.module.classifieds::import.classifieds'),
                'page' => 'visiosoft.module.classifieds'
            ]
        ];

        foreach ($settings_url as $key => $value) {
            $addonCollection->get($value['page'])->addSection($key, $value);
        }

        // Disable file versioning
        $fileModel->disableVersioning();
    }
}
