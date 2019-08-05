<?php namespace Visiosoft\ProfileModule;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Barryvdh\Cors\ServiceProvider;
use Visiosoft\ProfileModule\Adress\Contract\AdressRepositoryInterface;
use Visiosoft\ProfileModule\Adress\AdressRepository;
use Anomaly\Streams\Platform\Model\Profile\ProfileAdressEntryModel;
use Visiosoft\ProfileModule\Adress\AdressModel;
use Visiosoft\ProfileModule\Profile\Contract\ProfileRepositoryInterface;
use Visiosoft\ProfileModule\Profile\ProfileRepository;
use Anomaly\Streams\Platform\Model\Profile\ProfileProfileEntryModel;
use Visiosoft\ProfileModule\Profile\ProfileModel;
use Illuminate\Routing\Router;
use Visiosoft\ProfileModule\Profile\Register2\Register2FormBuilder;
use Visiosoft\ProfileModule\Profile\sites\SitesFormBuilder;

class ProfileModuleServiceProvider extends AddonServiceProvider
{

    /**
     * Additional addon plugins.
     *
     * @type array|null
     */
    protected $plugins = [];

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
        'admin/profile/adress' => 'Visiosoft\ProfileModule\Http\Controller\Admin\AdressController@index',
        'admin/profile/adress/create' => 'Visiosoft\ProfileModule\Http\Controller\Admin\AdressController@create',
        'admin/profile/adress/edit/{id}' => 'Visiosoft\ProfileModule\Http\Controller\Admin\AdressController@adresList',
        'admin/profile/adress/editAdress/{id}' => 'Visiosoft\ProfileModule\Http\Controller\Admin\AdressController@edit',
        'admin/profile/adress/update/{id}' => 'Visiosoft\ProfileModule\Http\Controller\Admin\AdressController@adressupdate',
        'admin/profile' => 'Visiosoft\ProfileModule\Http\Controller\Admin\ProfileController@index',
        'admin/profile/edit/{id}' => 'Visiosoft\ProfileModule\Http\Controller\Admin\ProfileController@edit',
        'admin/profile/update/{id}' => 'Visiosoft\ProfileModule\Http\Controller\Admin\ProfileController@update',
        'profile/edit' => 'Visiosoft\ProfileModule\Http\Controller\MyProfileController@edit',
        'profile/update' => 'Visiosoft\ProfileModule\Http\Controller\MyProfileController@update',
        'profile' => [
            'as' => 'visiosoft.module.profile::profile',
            'uses' => 'Visiosoft\ProfileModule\Http\Controller\MyProfileController@home'
        ],
        'profile/adress' => 'Visiosoft\ProfileModule\Http\Controller\MyProfileController@adressList',
        'profile/adress/edit/{id}' => [
            'as' => 'visiosoft.module.profile::address_edit',
            'uses' => 'Visiosoft\ProfileModule\Http\Controller\MyProfileController@adressEdit'
        ],
        'profile/adress/update/{id}' => 'Visiosoft\ProfileModule\Http\Controller\MyProfileController@adressUpdate',
        'profile/class/status/{id},{type}' => 'Visiosoft\ProfileModule\Http\Controller\MyProfileController@statusAds',
        'profile/class/extendTime/{id},{type}' => 'Visiosoft\ProfileModule\Http\Controller\MyProfileController@extendAds',
        'profile/message/show/{id}' => 'Visiosoft\ProfileModule\Http\Controller\MyProfileController@showMessage',
        'profile/closeAccount' => 'Visiosoft\ProfileModule\Http\Controller\MyProfileController@disableAccount',
        'profile/adress/create' => [
            'as' => 'visiosoft.module.profile::adress_create',
            'uses' => 'Visiosoft\ProfileModule\Http\Controller\MyProfileController@adressCreate'
        ],
        'profile/adress/ajaxCreate' => [
            'as' => 'visiosoft.module.profile::adress_ajax_create',
            'uses' => 'Visiosoft\ProfileModule\Http\Controller\MyProfileController@adressAjaxCreate'
        ],
        'profile/order/{id}' => [
            'as' => 'visiosoft.module.profile::profile_order',
            'uses' => 'Visiosoft\ProfileModule\Http\Controller\MyProfileController@orderDetail'
        ],
        'profile/my-sale/{id}' => 'Visiosoft\ProfileModule\Http\Controller\MyProfileController@saleDetail',
        'profile/orders/add-transport-number' => 'Visiosoft\ProfileModule\Http\Controller\MyProfileController@addTrackingNumber',
        'profile/orders/delivered-purchase/{id}' => 'Visiosoft\ProfileModule\Http\Controller\MyProfileController@orderDelivered',
        'profile/orders/not-delivered-purchase/{id}' => 'Visiosoft\ProfileModule\Http\Controller\MyProfileController@orderNotDelivered',
        'profile/orders/report-sales' => 'Visiosoft\ProfileModule\Http\Controller\MyProfileController@reportSales',
        'login-in' => 'Visiosoft\ProfileModule\Http\Controller\UserAuthenticator@attempt',
        'profile/notification' => [
            'uses' => 'Visiosoft\ProfileModule\Http\Controller\MyProfileController@notification',
        ],
        'register/ajax' => [
            'uses' => 'Visiosoft\ProfileModule\Http\Controller\UserAuthenticator@registerAjax',
            'middleware' => [
                \Barryvdh\Cors\HandleCors::class,
            ]
        ]

    ];

    /**
     * The addon middleware.
     *
     * @type array|null
     */
    protected $middleware = [
        //Visiosoft\ProfileModule\Http\Middleware\ExampleMiddleware::class
    ];

    /**
     * Addon group middleware.
     *
     * @var array
     */
    protected $groupMiddleware = [
        //'web' => [
        //    Visiosoft\ProfileModule\Http\Middleware\ExampleMiddleware::class,
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
        //Visiosoft\ProfileModule\Event\ExampleEvent::class => [
        //    Visiosoft\ProfileModule\Listener\ExampleListener::class,
        //],
    ];

    /**
     * The addon alias bindings.
     *
     * @type array|null
     */
    protected $aliases = [
        //'Example' => Visiosoft\ProfileModule\Example::class
    ];

    /**
     * The addon class bindings.
     *
     * @type array|null
     */
    protected $bindings = [
        ProfileAdressEntryModel::class => AdressModel::class,
        ProfileProfileEntryModel::class => ProfileModel::class,
    ];

    /**
     * The addon singleton bindings.
     *
     * @type array|null
     */
    protected $singletons = [
        AdressRepositoryInterface::class => AdressRepository::class,
        ProfileRepositoryInterface::class => ProfileRepository::class,
        'register2' => Register2FormBuilder::class,
        'sites' => SitesFormBuilder::class,
    ];

    /**
     * Additional service providers.
     *
     * @type array|null
     */
    protected $providers = [
        ServiceProvider::class,
    ];

    /**
     * The addon view overrides.
     *
     * @type array|null
     */
    protected $overrides = [
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
    public function boot()
    {
        // Run extra post-boot registration logic here.
        // Use method injection or commands to bring in services.
    }

    /**
     * Map additional addon routes.
     *
     * @param Router $router
     */
    public function map(Router $router)
    {
        // Register dynamic routes here for example.
        // Use method injection or commands to bring in services.
    }

}
