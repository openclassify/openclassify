<?php namespace Visiosoft\ProfileModule;

use Anomaly\Streams\Platform\Addon\AddonCollection;
use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Anomaly\Streams\Platform\Model\Profile\ProfileEducationEntryModel;
use Maatwebsite\Excel\ExcelServiceProvider;
use Maatwebsite\Excel\Facades\Excel;
use Visiosoft\ProfileModule\Adress\Contract\AdressRepositoryInterface;
use Visiosoft\ProfileModule\Adress\AdressRepository;
use Anomaly\Streams\Platform\Model\Profile\ProfileAdressEntryModel;
use Visiosoft\ProfileModule\Adress\AdressModel;
use Visiosoft\ProfileModule\Adress\Form\AdressFormBuilder;
use Visiosoft\ProfileModule\Adress\FormCompany\AddressCompanyFormBuilder;
use Visiosoft\ProfileModule\Education\Contract\EducationRepositoryInterface;
use Visiosoft\ProfileModule\Education\EducationModel;
use Visiosoft\ProfileModule\Education\EducationRepository;
use Visiosoft\ProfileModule\Http\Middleware\authCheck;
use Visiosoft\ProfileModule\Profile\Password\ForgotPassFormBuilder;
use Visiosoft\ProfileModule\Profile\Password\PasswordFormBuilder;
use Visiosoft\ProfileModule\Profile\Profile\ProfileFormBuilder;
use Illuminate\Routing\Router;
use Visiosoft\ProfileModule\Profile\Register2\Register2FormBuilder;
use Visiosoft\ProfileModule\Profile\SignIn\SignInFormBuilder;
use Visiosoft\ProfileModule\Profile\sites\SitesFormBuilder;
use Visiosoft\ProfileModule\Profile\User\UserFormBuilder;

class ProfileModuleServiceProvider extends AddonServiceProvider
{

    /**
     * Additional addon plugins.
     *
     * @type array|null
     */
    protected $plugins = [
        ProfileModulePlugin::class
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
        // Admin AdressController
        'admin/profile' => 'Visiosoft\ProfileModule\Http\Controller\Admin\AdressController@index',
        'admin/profile/create' => 'Visiosoft\ProfileModule\Http\Controller\Admin\AdressController@create',
        'admin/profile/update/{id}' => 'Visiosoft\ProfileModule\Http\Controller\Admin\AdressController@adressupdate',

        // Admin UsersController
        'admin/users/export' => [
            'as' => 'users::exportUsers',
            'uses' => 'Visiosoft\ProfileModule\Http\Controller\Admin\UsersController@exportUsers'
        ],
        'api/profile/query-users' => 'Visiosoft\ProfileModule\Http\Controller\Admin\UsersController@queryUsers',

        // MyProfileController
        'profile/ads' => [
            'as' => 'profile::ads',
            'uses' => 'Visiosoft\ProfileModule\Http\Controller\MyProfileController@myAds'
        ],
        'profile/adress/ajaxCreate' => [
            'as' => 'visiosoft.module.profile::adress_ajax_create',
            'uses' => 'Visiosoft\ProfileModule\Http\Controller\MyProfileController@adressAjaxCreate'
        ],
        'profile/adress/ajaxUpdate/{id}' => [
            'as' => 'visiosoft.module.profile::adress_ajax_update',
            'uses' => 'Visiosoft\ProfileModule\Http\Controller\MyProfileController@adressAjaxUpdate'
        ],
        'profile/adress/ajaxDetail' => [
            'as' => 'visiosoft.module.profile::adress_ajax_detail',
            'uses' => 'Visiosoft\ProfileModule\Http\Controller\MyProfileController@adressAjaxDetail'
        ],
        'profile' => [
            'as' => 'profile::profile',
            'uses' => 'Visiosoft\ProfileModule\Http\Controller\MyProfileController@home'
        ],
        'profile/class/status/{id},{type}' => 'Visiosoft\ProfileModule\Http\Controller\MyProfileController@statusAds',
        'profile/class/extendTime/{id},{type}' => 'Visiosoft\ProfileModule\Http\Controller\MyProfileController@extendAds',
        'profile/message/show/{id}' => 'Visiosoft\ProfileModule\Http\Controller\MyProfileController@showMessage',
        'profile/close-account' => [
        	'as' => 'visiosoft.module.profile::profile_close_account',
	        'uses' => 'Visiosoft\ProfileModule\Http\Controller\MyProfileController@disableAccount'
        ],
        'profile/notification' => 'Visiosoft\ProfileModule\Http\Controller\MyProfileController@notification',
        'ajax/update-user-info' => 'Visiosoft\ProfileModule\Http\Controller\MyProfileController@updateAjaxProfile',
	    'api/setEducation' => 'Visiosoft\ProfileModule\Http\Controller\MyProfileController@setEducation',
	    'api/getEducation' => 'Visiosoft\ProfileModule\Http\Controller\MyProfileController@getEducation',

        // UserAuthenticator
        'login-in' => 'Visiosoft\ProfileModule\Http\Controller\UserAuthenticator@attempt',
        'ajax/phone-validation' => 'Visiosoft\ProfileModule\Http\Controller\UserAuthenticator@phoneValidation',

        // RegisterController
        'register' => [
            'middleware' => [
                authCheck::class
            ],
            'ttl' => 0,
            'uses' => 'Anomaly\UsersModule\Http\Controller\RegisterController@register',
        ],
        'users/activate' => [
            'ttl'  => 0,
            'uses' => 'Visiosoft\ProfileModule\Http\Controller\RegisterController@activate',
        ],

        // AddressController
        'profile/address' => [
            'as' => 'profile::address',
            'uses' => 'Visiosoft\ProfileModule\Http\Controller\AddressController@index',
        ],
        'profile/adress/create' => [
            'as' => 'visiosoft.module.profile::adress_create',
            'uses' => 'Visiosoft\ProfileModule\Http\Controller\AddressController@create'
        ],
        'profile/adress/edit/{id}' => [
            'as' => 'visiosoft.module.profile::address_edit',
            'uses' => 'Visiosoft\ProfileModule\Http\Controller\AddressController@edit'
        ],
        'profile/adress/delete/{id}' => [
            'as' => 'visiosoft.module.profile::address_soft_delete',
            'uses' => 'Visiosoft\ProfileModule\Http\Controller\AddressController@delete'
        ],

        // CacheController
        'ajax/get-user-info' => 'Visiosoft\ProfileModule\Http\Controller\CacheController@getUserInfo',
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
        'Excel' => Excel::class,
    ];

    /**
     * The addon class bindings.
     *
     * @type array|null
     */
    protected $bindings = [
        'updatePassword' => PasswordFormBuilder::class,
        'userProfile' => UserFormBuilder::class,
        'profile' => ProfileFormBuilder::class,
        'signIn' => SignInFormBuilder::class,
        'address' => AdressFormBuilder::class,
        'addressCompany' => AddressCompanyFormBuilder::class,
        ProfileAdressEntryModel::class => AdressModel::class,
        ProfileEducationEntryModel::class => EducationModel::class,
    ];

    /**
     * The addon singleton bindings.
     *
     * @type array|null
     */
    protected $singletons = [
        AdressRepositoryInterface::class => AdressRepository::class,
        EducationRepositoryInterface::class => EducationRepository::class,
        'register2' => Register2FormBuilder::class,
        'sites' => SitesFormBuilder::class,
        'forgot_pass' => ForgotPassFormBuilder::class,
    ];

    /**
     * Additional service providers.
     *
     * @type array|null
     */
    protected $providers = [
        ExcelServiceProvider::class,
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
    public function boot(AddonCollection $addonCollection)
    {
        $slug = 'export';
        $section = [
            'title' => 'visiosoft.module.profile::button.export',
            'href' => route('users::exportUsers'),
        ];
        $addonCollection->get('anomaly.module.users')->addSection($slug, $section);
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
