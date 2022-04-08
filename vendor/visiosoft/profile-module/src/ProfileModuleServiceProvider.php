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
use Visiosoft\ProfileModule\Http\Middleware\OGImage;
use Visiosoft\ProfileModule\Profile\BasicRegister\BasicRegisterFormBuilder;
use Visiosoft\ProfileModule\Profile\Password\ForgotPassFormBuilder;
use Visiosoft\ProfileModule\Profile\Password\PasswordFormBuilder;
use Visiosoft\ProfileModule\Profile\Profile\ProfileFormBuilder;
use Visiosoft\ProfileModule\Profile\Register2\Register2FormBuilder;
use Visiosoft\ProfileModule\Profile\SignIn\SignInFormBuilder;
use Visiosoft\ProfileModule\Profile\User\UserFormBuilder;

class ProfileModuleServiceProvider extends AddonServiceProvider
{
    protected $plugins = [
        ProfileModulePlugin::class
    ];

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
            'middleware' => 'auth',
            'uses' => 'Visiosoft\ProfileModule\Http\Controller\MyProfileController@myAds'
        ],
        'profile/adress/ajaxCreate' => [
            'as' => 'visiosoft.module.profile::adress_ajax_create',
            'middleware' => 'auth',
            'uses' => 'Visiosoft\ProfileModule\Http\Controller\MyProfileController@adressAjaxCreate'
        ],
        'profile/adress/ajaxUpdate/{id}' => [
            'as' => 'visiosoft.module.profile::adress_ajax_update',
            'middleware' => 'auth',
            'uses' => 'Visiosoft\ProfileModule\Http\Controller\MyProfileController@adressAjaxUpdate'
        ],
        'profile/adress/ajaxDetail' => [
            'as' => 'visiosoft.module.profile::adress_ajax_detail',
            'middleware' => 'auth',
            'uses' => 'Visiosoft\ProfileModule\Http\Controller\MyProfileController@adressAjaxDetail'
        ],
        'profile' => [
            'as' => 'profile::profile',
            'middleware' => 'auth',
            'uses' => 'Visiosoft\ProfileModule\Http\Controller\MyProfileController@home'
        ],
	    'profile/detail' => [
		    'as' => 'profile::detail',
            'middleware' => 'auth',
            'uses' => 'Visiosoft\ProfileModule\Http\Controller\MyProfileController@detail'
	    ],
	    'profile/password' => [
		    'as' => 'profile::password',
            'middleware' => 'auth',
            'uses' => 'Visiosoft\ProfileModule\Http\Controller\MyProfileController@password'
	    ],
        'profile/class/status/{id},{type}' => [
            'middleware' => 'auth',
            'uses' => 'Visiosoft\ProfileModule\Http\Controller\MyProfileController@statusAds',
        ],
        'profile/class/extendTime/{id},{type}' => [
            'middleware' => 'auth',
            'uses' => 'Visiosoft\ProfileModule\Http\Controller\MyProfileController@extendAds',
        ],
        'profile/message/show/{id}' => [
            'middleware' => 'auth',
            'uses'  => 'Visiosoft\ProfileModule\Http\Controller\MyProfileController@showMessage',
        ],
        'profile/close-account' => [
            'middleware' => 'auth',
        	'as' => 'visiosoft.module.profile::profile_close_account',
	        'uses' => 'Visiosoft\ProfileModule\Http\Controller\MyProfileController@disableAccount'
        ],
        'profile/notification' => [
            'uses' => 'Visiosoft\ProfileModule\Http\Controller\MyProfileController@notification',
            'middleware' => 'auth',
        ],
        'ajax/update-user-info' => [
            'middleware' => 'auth',
            'uses' => 'Visiosoft\ProfileModule\Http\Controller\MyProfileController@updateAjaxProfile',
        ],
	    'api/changeEducation' => [
            'middleware' => 'auth',
            'uses' => 'Visiosoft\ProfileModule\Http\Controller\MyProfileController@changeEducation',
        ],
	    'api/getEducation' => [
            'middleware' => 'auth',
            'uses' => 'Visiosoft\ProfileModule\Http\Controller\MyProfileController@getEducation',
        ],

        // UserAuthenticator
        'login-in' => 'Visiosoft\ProfileModule\Http\Controller\UserAuthenticator@attempt',
        'ajax/phone-validation' => 'Visiosoft\ProfileModule\Http\Controller\UserAuthenticator@phoneValidation',
        'auth-auto' => 'Visiosoft\ProfileModule\Http\Controller\UserAuthenticator@authAuto',

        // RegisterController
        'register' => [
            'middleware' => [
                authCheck::class,
                OGImage::class
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

        // Admin ReportController
        'admin/api/profile/report/latest' => 'Visiosoft\ProfileModule\Http\Controller\Admin\ReportController@latest',
        'admin/api/profile/report/login' => 'Visiosoft\ProfileModule\Http\Controller\Admin\ReportController@login',
    ];

    protected $aliases = [
        'Excel' => Excel::class,
        'Anomaly\UsersModule\User\UserApiCollection' => \Visiosoft\ProfileModule\UserApiCollection::class
    ];

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

    protected $singletons = [
        AdressRepositoryInterface::class => AdressRepository::class,
        EducationRepositoryInterface::class => EducationRepository::class,
        'register2' => Register2FormBuilder::class,
        'basic_register' => BasicRegisterFormBuilder::class,
        'forgot_pass' => ForgotPassFormBuilder::class,
    ];

    protected $providers = [
        ExcelServiceProvider::class,
    ];

    public function boot(AddonCollection $addonCollection)
    {
        $request = app('Illuminate\Http\Request');

        ($utm_source = $request->get('utm_source')) ? setcookie('utm_source', $utm_source) : null;
        ($utm_medium = $request->get('utm_medium')) ? setcookie('utm_medium', $utm_medium) : null;
        ($utm_campaign = $request->get('utm_campaign')) ? setcookie('utm_campaign', $utm_campaign) : null;
        ($utm_term = $request->get('utm_term')) ? setcookie('utm_term', $utm_term) : null;
        ($utm_content = $request->get('utm_content')) ? setcookie('utm_content', $utm_content) : null;


        $slug = 'export';
        $section = [
            'title' => 'visiosoft.module.profile::button.export',
            'href' => route('users::exportUsers'),
        ];
        $addonCollection->get('anomaly.module.users')->addSection($slug, $section);
    }
}
