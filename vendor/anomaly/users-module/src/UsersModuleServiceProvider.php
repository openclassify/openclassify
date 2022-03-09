<?php namespace Anomaly\UsersModule;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Anomaly\Streams\Platform\Application\Event\ApplicationHasLoaded;
use Anomaly\Streams\Platform\Model\Users\UsersRolesEntryModel;
use Anomaly\Streams\Platform\Model\Users\UsersUsersEntryModel;
use Anomaly\UsersModule\Console\UsersCleanup;
use Anomaly\UsersModule\Http\Middleware\AuthorizeControlPanel;
use Anomaly\UsersModule\Http\Middleware\AuthorizeModuleAccess;
use Anomaly\UsersModule\Http\Middleware\AuthorizeRoutePermission;
use Anomaly\UsersModule\Http\Middleware\AuthorizeRouteRoles;
use Anomaly\UsersModule\Http\Middleware\CheckSecurity;
use Anomaly\UsersModule\Role\Contract\RoleRepositoryInterface;
use Anomaly\UsersModule\Role\RoleModel;
use Anomaly\UsersModule\Role\RoleRepository;
use Anomaly\UsersModule\User\Contract\UserRepositoryInterface;
use Anomaly\UsersModule\User\Event\UserHasRegistered;
use Anomaly\UsersModule\User\Event\UserWasLoggedIn;
use Anomaly\UsersModule\User\Listener\SendNewUserNotifications;
use Anomaly\UsersModule\User\Listener\TouchLastActivity;
use Anomaly\UsersModule\User\Listener\TouchLastLogin;
use Anomaly\UsersModule\User\Login\LoginFormBuilder;
use Anomaly\UsersModule\User\Password\ForgotPasswordFormBuilder;
use Anomaly\UsersModule\User\Password\ResetPasswordFormBuilder;
use Anomaly\UsersModule\User\Register\RegisterFormBuilder;
use Anomaly\UsersModule\User\UserModel;
use Anomaly\UsersModule\User\UserRepository;
use Illuminate\Contracts\Config\Repository;

/**
 * Class UsersModuleServiceProvider
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class UsersModuleServiceProvider extends AddonServiceProvider
{

    /**
     * The addon commands.
     *
     * @var array
     */
    protected $commands = [
        UsersCleanup::class,
    ];

    /**
     * The addon plugins.
     *
     * @var array
     */
    protected $plugins = [
        UsersModulePlugin::class,
    ];

    /**
     * The addon schedules.
     *
     * @var array
     */
    protected $schedules = [
        'daily' => [
            UsersCleanup::class,
        ],
    ];

    /**
     * The module middleware.
     *
     * @var array
     */
    protected $middleware = [
        CheckSecurity::class,
        AuthorizeRouteRoles::class,
        AuthorizeModuleAccess::class,
        AuthorizeControlPanel::class,
        AuthorizeRoutePermission::class,
    ];

    /**
     * The addon event listeners.
     *
     * @var array
     */
    protected $listeners = [
        UserWasLoggedIn::class      => [
            TouchLastLogin::class,
        ],
        UserHasRegistered::class    => [
            SendNewUserNotifications::class,
        ],
        ApplicationHasLoaded::class => [
            TouchLastActivity::class,
        ],
    ];

    /**
     * The class bindings.
     *
     * @var array
     */
    protected $bindings = [
        'login'                     => LoginFormBuilder::class,
        'register'                  => RegisterFormBuilder::class,
        'reset_password'            => ResetPasswordFormBuilder::class,
        'forgot_password'           => ForgotPasswordFormBuilder::class,
        UsersUsersEntryModel::class => UserModel::class,
        UsersRolesEntryModel::class => RoleModel::class,
    ];

    /**
     * The singleton bindings.
     *
     * @var array
     */
    protected $singletons = [
        UserRepositoryInterface::class => UserRepository::class,
        RoleRepositoryInterface::class => RoleRepository::class,
    ];

    /**
     * The addon routes.
     *
     * @var array
     */
    protected $routes = [
        '/users/self'           => [
            'ttl'  => 0,
            'as'   => 'anomaly.module.users::self',
            'uses' => 'Anomaly\UsersModule\Http\Controller\UsersController@self',
        ],
        '@{username}'           => [
            'as'   => 'anomaly.module.users::users.view',
            'uses' => 'Anomaly\UsersModule\Http\Controller\UsersController@view',
        ],
        'login'                 => [
            'ttl'  => 0,
            'as'   => 'anomaly.module.users::login',
            'uses' => 'Anomaly\UsersModule\Http\Controller\LoginController@login',
        ],
        'logout'                => [
            'ttl'  => 0,
            'as'   => 'anomaly.module.users::logout',
            'uses' => 'Anomaly\UsersModule\Http\Controller\LoginController@logout',
        ],
        'register'              => [
            'ttl'  => 0,
            'as'   => 'anomaly.module.users::register',
            'uses' => 'Anomaly\UsersModule\Http\Controller\RegisterController@register',
        ],
        'users/activate'        => [
            'ttl'  => 0,
            'as'   => 'anomaly.module.users::users.activate',
            'uses' => 'Anomaly\UsersModule\Http\Controller\RegisterController@activate',
        ],
        'users/password/reset'  => [
            'ttl'  => 0,
            'as'   => 'anomaly.module.users::users.reset',
            'uses' => 'Anomaly\UsersModule\Http\Controller\PasswordController@reset',
        ],
        'users/password/forgot' => [
            'ttl'  => 0,
            'as'   => 'anomaly.module.users::password.forgot',
            'uses' => 'Anomaly\UsersModule\Http\Controller\PasswordController@forgot',
        ],
        'admin'                 => [
            'ttl'  => 0,
            'uses' => 'Anomaly\UsersModule\Http\Controller\Admin\HomeController@index',
        ],
        'auth/login'            => [
            'ttl'  => 0,
            'uses' => 'Anomaly\UsersModule\Http\Controller\Admin\LoginController@logout',
        ],
        'auth/logout'           => [
            'ttl'  => 0,
            'uses' => 'Anomaly\UsersModule\Http\Controller\Admin\LoginController@logout',
        ],
        'admin/login'           => [
            'ttl'  => 0,
            'uses' => 'Anomaly\UsersModule\Http\Controller\Admin\LoginController@login',
        ],
        'admin/logout'          => [
            'ttl'  => 0,
            'uses' => 'Anomaly\UsersModule\Http\Controller\Admin\LoginController@logout',
        ],
    ];

    /**
     * Register the addon.
     *
     * @param Repository $config
     */
    public function register(Repository $config)
    {
        foreach ($config->get($this->addon->getNamespace('config.permissions')) as $namespace => $group) {
            foreach (array_get($group, 'permissions', []) as $permission => $permissions) {
                foreach ($permissions['available'] as $option) {
                    $config->set($namespace . '::permissions.' . $permission . '.' . $option);
                }
            }
        }
    }
}
