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
use Visiosoft\LocationModule\Village\Contract\VillageRepositoryInterface;
use Visiosoft\LocationModule\Village\VillageRepository;
use Visiosoft\LocationModule\Village\VillageModel;
use Visiosoft\CatsModule\Category\Contract\CategoryRepositoryInterface;
use Visiosoft\CatsModule\Category\CategoryRepository;
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
     * The addon routes.
     *
     * @type array|null
     */
    protected $routes = [
        // Admin routes
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
        // User choose modal
        'admin/advs-users/choose/{advId}' => 'Visiosoft\AdvsModule\Http\Controller\Admin\AdvsController@choose',
        'admin/advs/list' => [
            'as' => 'visiosoft.module.advs::admin-list',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\Admin\AdvsController@manage'
        ],
        'admin/class/actions/{id}/{type}' => 'Visiosoft\AdvsModule\Http\Controller\Admin\AdvsController@actions',
        'advs/list' => [
            'as' => 'visiosoft.module.advs::list',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\advsController@index'
        ],
        'advs/main' => 'Visiosoft\AdvsModule\Http\Controller\advsController@advsMainPage',
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
        'c/{category?}/{city?}' => [
            'as' => 'adv_list_seo',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\advsController@index'
        ],
        'advs/module_active' => 'Visiosoft\AdvsModule\Http\Controller\advsController@index',
        'advs/create_adv' => [
            'as' => "advs::create_adv",
            'middleware' => "auth",
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\advsController@cats',
        ],
        'advs/create_adv/post_cat' => [
            'as' => 'post_adv',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\advsController@create',
        ],
        'class/getcats/{id}' => 'Visiosoft\AdvsModule\Http\Controller\advsController@getCatsForNewAd',
        'advs/save_adv' => [
            'middleware' => 'auth',
            'as' => 'visiosoft.module.advs::post_cat',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\advsController@store'
        ],
        'advs/my_advs' => 'Visiosoft\AdvsModule\Http\Controller\advsController@myAdvs',
        'advs/my_advs/{params}' => 'Visiosoft\AdvsModule\Http\Controller\advsController@myAdvs',
        'advs/edit_advs/{id}' => [
            'as' => 'visiosoft.module.advs::edit_adv',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\advsController@edit',
        ],
        'advs/status/{id},{type}' => [
            'as' => 'visiosoft.module.advs::status',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\advsController@statusAds'
        ],
        'routes' => 'Visiosoft\AdvsModule\Http\Controller\advsController@routes',
        'map-json' => 'Visiosoft\AdvsModule\Http\Controller\advsController@mapJson',
        'advs/ttr/{id}' => 'Visiosoft\PackagesModule\Http\Controller\packageFEController@advsStatusbyUser',
        'advs/delete/{id}' => [
            'as' => 'advs::delete',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\advsController@deleteAd',
        ],
        'keySearch' => 'Visiosoft\AdvsModule\Http\Controller\AjaxController@keySearch',
        'view/{type}' => [
            'as' => 'visiosoft.module.advs::view_type',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\advsController@viewType',
        ],
        'admin/assets/clear' => [
            'as' => 'assets_clear',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\Admin\AdvsController@assetsClear',
        ],
        'adv/edit/category/{id}' => [
            'middleware' => 'auth',
            'as' => 'adv::edit_category',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\advsController@editCategoryForAd',
        ],

        'ajax/getAdvs' => [
            'as' => 'ajax::getAds',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\AjaxController@getMyAds'
        ],
        'ajax/get-advs-by-category/{categoryID}' => [
            'as' => 'ajax::getAds',
            'uses' => 'Visiosoft\AdvsModule\Http\Controller\AjaxController@getAdvsByCat'
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
        SetLang::class,
        redirectDiffrentLang::class,
    ];

    /**
     * The addon event listeners.
     *
     * @type array|null
     */
    protected $listeners = [
        TableIsQuerying::class => [
            AddAdvsSettingsScript::class,
        ],
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
        'my_form' => AdvFormBuilder::class,
    ];

    /**
     * The addon singleton bindings.
     *
     * @type array|null
     */
    protected $singletons = [
        AdvRepositoryInterface::class => AdvRepository::class,
        VillageRepositoryInterface::class => VillageRepository::class,
        CategoryRepositoryInterface::class => CategoryRepository::class,
        CountryRepositoryInterface::class => CountryRepository::class,
        OptionRepositoryInterface::class => OptionRepository::class,
    ];

    /**
     * The addon view overrides.
     *
     * @type array|null
     */
    protected $overrides = [
        'streams::form/form' => 'visiosoft.module.advs::form/form',
    ];

    /**
     * Boot the addon.
     * @param AddonCollection $addonCollection
     * @param FileModel $fileModel
     */
    public function boot(AddonCollection $addonCollection, FileModel $fileModel)
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

        // Disable file versioning
        $fileModel->disableVersioning();
    }
}
