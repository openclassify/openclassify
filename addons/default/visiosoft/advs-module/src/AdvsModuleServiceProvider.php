<?php namespace Visiosoft\AdvsModule;

use Anomaly\FilesModule\File\FileModel;
use Anomaly\Streams\Platform\Addon\AddonCollection;
use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Anomaly\Streams\Platform\Model\Location\LocationVillageEntryModel;
use Anomaly\Streams\Platform\Ui\Table\Event\TableIsQuerying;
use Visiosoft\AdvsModule\Adv\Contract\AdvRepositoryInterface;
use Visiosoft\AdvsModule\Adv\AdvRepository;
use Anomaly\Streams\Platform\Model\Advs\AdvsAdvsEntryModel;
use Visiosoft\AdvsModule\Adv\AdvModel;
use Visiosoft\AdvsModule\Adv\Form\AdvFormBuilder;
use Visiosoft\AdvsModule\Http\Middleware\redirectDiffrentLang;
use Visiosoft\AdvsModule\Http\Middleware\SetLang;
use Visiosoft\AdvsModule\Listener\AddAdvsSettingsScript;
use Visiosoft\AdvsModule\Option\Contract\OptionRepositoryInterface;
use Visiosoft\AdvsModule\Option\OptionRepository;
use Visiosoft\AdvsModule\OptionConfiguration\Contract\OptionConfigurationRepositoryInterface;
use Visiosoft\AdvsModule\OptionConfiguration\OptionConfigurationRepository;
use Visiosoft\AdvsModule\Productoption\Contract\ProductoptionRepositoryInterface;
use Visiosoft\AdvsModule\Productoption\ProductoptionRepository;
use Visiosoft\AdvsModule\ProductoptionsValue\Contract\ProductoptionsValueRepositoryInterface;
use Visiosoft\AdvsModule\ProductoptionsValue\ProductoptionsValueRepository;
use Visiosoft\LocationModule\Village\Contract\VillageRepositoryInterface;
use Visiosoft\LocationModule\Village\VillageRepository;
use Visiosoft\LocationModule\Village\VillageModel;
use Visiosoft\CatsModule\Category\Contract\CategoryRepositoryInterface;
use Visiosoft\CatsModule\Category\CategoryRepository;
use Visiosoft\LocationModule\Country\Contract\CountryRepositoryInterface;
use Visiosoft\LocationModule\Country\CountryRepository;

class AdvsModuleServiceProvider extends AddonServiceProvider
{
    protected $plugins = [
        AdvsModulePlugin::class,
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


        // advsController
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
        'advs/adv/{id}' => [
            'as' => 'adv_detail_backup',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\advsController@view'
        ],
        'advs/adv/{id}/{seo}' => [
            'as' => 'adv_detail_seo_backup',
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
        'advs/preview/{id}' => [
            'as' => 'advs_preview',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\advsController@preview'
        ],
        'advs/map?country={country}&city[]={city}&district={districts}' => [
            'as' => 'visiosoft.module.advs::show_ad_map_location',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\advsController@index'
        ],
        'c/{category?}/{city?}' => [
            'as' => 'adv_list_seo',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\advsController@index'
        ],
        'advs/create_adv' => [
            'as' => "advs::create_adv",
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\advsController@cats',
        ],
        'advs/create_adv/post_cat' => [
            'as' => 'post_adv',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\advsController@create',
        ],
        'advs/save_adv' => [
            'as' => 'visiosoft.module.advs::post_cat',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\advsController@store'
        ],
        'advs/edit_advs/{id}' => [
            'middleware' => 'auth',
            'as' => 'visiosoft.module.advs::edit_adv',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\advsController@edit',
        ],
        'advs/status/{id},{type}' => [
            'as' => 'visiosoft.module.advs::status',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\advsController@statusAds'
        ],
        'advs/delete/{id}' => [
            'as' => 'advs::delete',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\advsController@deleteAd',
        ],
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
        'adv/edit/category/{id}' => [
            'as' => 'adv::edit_category',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\advsController@editCategoryForAd',
        ],
        'ajax/getcats/{id}' => [
            'as' => 'ajax::getCats',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\advsController@getCats',
        ],
        'advs/extendAll/{isAdmin?}' => [
            'as' => 'advs::extendAll',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\AdvsController@extendAll',
        ],
        'advs/extend/{adId}' => [
            'as' => 'advs::extendSingle',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\AdvsController@extendSingle',
        ],
        'categories/checkparent/{id}' => 'Visiosoft\AdvsModule\Http\Controller\advsController@checkParentCat',
        'getlocations' => 'Visiosoft\AdvsModule\Http\Controller\advsController@getLocations',
        'class/getcats/{id}' => 'Visiosoft\AdvsModule\Http\Controller\advsController@getCatsForNewAd',
        'mapJson' => 'Visiosoft\AdvsModule\Http\Controller\advsController@mapJson',
        'check_user' => 'Visiosoft\AdvsModule\Http\Controller\advsController@checkUser',

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
            'as' => 'ajax::getAds',
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
            'as' => 'visiosoft.module.advs::configrations.create',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\Admin\OptionConfigurationController@create',
        ],
        'admin/advs/option_configuration' => [
            'as' => 'visiosoft.module.advs::configrations.index',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\Admin\OptionConfigurationController@index',
        ],

        //Configuration Controller
        'advs/option_configuration/create' => [
            'as' => 'visiosoft.module.advs::user.configrations.create',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\OptionConfigurationController@create',
        ],
        'conf/addCart' => [
            'as' => 'configuration::add_cart',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\OptionConfigurationController@confAddCart',
        ],

        // Admin ProductoptionsController
        'admin/advs/product_options' => 'Visiosoft\AdvsModule\Http\Controller\Admin\ProductoptionsController@index',
        'admin/advs/product_options/create' => 'Visiosoft\AdvsModule\Http\Controller\Admin\ProductoptionsController@create',
        'admin/advs/product_options/edit/{id}' => 'Visiosoft\AdvsModule\Http\Controller\Admin\ProductoptionsController@edit',
    ];

    protected $middleware = [
        SetLang::class,
        redirectDiffrentLang::class,
    ];

    protected $listeners = [
        TableIsQuerying::class => [
            AddAdvsSettingsScript::class,
        ],
    ];

    protected $bindings = [
        LocationVillageEntryModel::class => VillageModel::class,
        AdvsAdvsEntryModel::class => AdvModel::class,
        'my_form' => AdvFormBuilder::class,
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
    ];

    public function boot(AddonCollection $addonCollection, FileModel $fileModel)
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
}
