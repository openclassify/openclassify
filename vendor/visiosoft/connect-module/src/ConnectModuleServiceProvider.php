<?php namespace Visiosoft\ConnectModule;

use Visiosoft\ConnectModule\Command\LoadKeys;
use Visiosoft\ConnectModule\Command\LoadScopes;
use Visiosoft\ConnectModule\Events\ActivateAccount;
use Visiosoft\ConnectModule\Events\ResetPassword;
use Visiosoft\ConnectModule\Listeners\SendActivationMail;
use Visiosoft\ConnectModule\Listeners\SendResetMail;
use Visiosoft\ConnectModule\Passport\PassportServiceProvider;
use Visiosoft\ConnectModule\User\UserModel;
use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Laravel\Passport\Http\Middleware\CheckForAnyScope;
use Laravel\Passport\Http\Middleware\CheckScopes;
use Laravel\Passport\Passport;

/**
 * Class ConnectModuleServiceProvider
 *

 */
class ConnectModuleServiceProvider extends AddonServiceProvider
{

    /**
     * The addon providers.
     *
     * @var array
     */
    protected $providers = [
        PassportServiceProvider::class,
    ];

    /**
     * The addon route middlewares.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'scopes' => CheckScopes::class,
        'scope' => CheckForAnyScope::class,
    ];

    /**
     * The addon routes.
     *
     * @var array
     */
    protected $routes = [
        'oauth/request' => 'Visiosoft\ConnectModule\Http\Controller\OAuthController@request',
        'admin/connect' => 'Visiosoft\ConnectModule\Http\Controller\Admin\ClientsController@index',
        'admin/connect/create' => 'Visiosoft\ConnectModule\Http\Controller\Admin\ClientsController@create',
        'admin/connect/edit/{id}' => 'Visiosoft\ConnectModule\Http\Controller\Admin\ClientsController@edit',
        'api/login' => 'Visiosoft\ConnectModule\Http\Controller\ApiController@login',
        'api/register' => 'Visiosoft\ConnectModule\Http\Controller\ApiController@register',
        'api/forgot-password' => 'Visiosoft\ConnectModule\Http\Controller\ApiController@forgotPassword',
        'api/renew-password' => 'Visiosoft\ConnectModule\Http\Controller\ApiController@renew',
    ];

    protected $bindings = [
        'Anomaly\Streams\Platform\Exception\ExceptionHandler' => 'Visiosoft\ConnectModule\Exceptions\ExceptionHandler'

    ];

    /**
     * Register the addon.
     *
     * @param Request $request
     * @param Repository $config
     * @param ConnectModule $module
     * @param Factory $views
     */
    public function register(
        Request $request,
        Repository $config,
        ConnectModule $module,
        Factory $views,
        EloquentModel $model
    )
    {
        $views->addNamespace('passport', $module->getPath('resources/views'));

        $config->set('auth.guards.api.driver', 'passport');

        if ($request->segment(1) == 'api') {
            $config->set('auth.providers.users.model', UserModel::class);
        }

        $model->bind(
            'to_array_for_api',
            function () {

                /* @var EloquentModel $this */
                return $this->toArray();
            }
        );
    }

    /**
     * Boot the addon.
     */
    public function boot()
    {
        $this->dispatch(new LoadKeys());
        $this->dispatch(new LoadScopes());
    }

    /**
     * Map additional routes.
     *
     * @param Router $router
     */
    public function map(Router $router)
    {
        $this->mapStreamsApi($router);
        $this->mapEntriesApi($router);

        Passport::routes();
    }

    /**
     * Map the entries API.
     *
     * @param Router $router
     */
    protected function mapEntriesApi(Router $router)
    {
        $router->get(
            'api/entries/{namespace}/{stream}',
            [
                'uses' => 'Visiosoft\ConnectModule\Http\Controller\Resource\EntriesController@index',
                'streams::addon' => 'visiosoft.module.connect',
            ]
        )->middleware('auth:api');

        $router->post(
            'api/entries/{namespace}/{stream}',
            [
                'uses' => 'Visiosoft\ConnectModule\Http\Controller\Resource\EntriesController@store',
                'streams::addon' => 'visiosoft.module.connect',
            ]
        )->middleware('auth:api');

        $router->get(
            'api/entries/{namespace}/{stream}/{id}/{map?}',
            [
                'uses' => 'Visiosoft\ConnectModule\Http\Controller\Resource\EntriesController@show',
                'streams::addon' => 'visiosoft.module.connect',
            ]
        )->where(['map' => '(.*)']);

        $router->post(
            'api/entries/{namespace}/{stream}/{id}',
            [
                'uses' => 'Visiosoft\ConnectModule\Http\Controller\Resource\EntriesController@update',
                'streams::addon' => 'visiosoft.module.connect',
            ]
        )->middleware('auth:api');

        $router->patch(
            'api/entries/{namespace}/{stream}/{id}',
            [
                'uses' => 'Visiosoft\ConnectModule\Http\Controller\Resource\EntriesController@update',
                'streams::addon' => 'visiosoft.module.connect',
            ]
        )->middleware('auth:api');

        $router->post(
            'api/delete-entries/{namespace}/{stream}/{id}',
            [
                'uses' => 'Visiosoft\ConnectModule\Http\Controller\Resource\EntriesController@delete',
                'streams::addon' => 'visiosoft.module.connect',
            ]
        )->middleware('auth:api');


        // Function Routes
        $router->get(
            'api/function/{namespace}/{stream}/{function}/{id}',
            [
                'uses' => 'Visiosoft\ConnectModule\Http\Controller\Resource\FunctionController@show',
                'streams::addon' => 'visiosoft.module.connect',
            ]
        )->middleware('auth:api');

        $router->get(
            'api/function/{namespace}/{stream}/{function}',
            [
                'uses' => 'Visiosoft\ConnectModule\Http\Controller\Resource\FunctionController@index',
                'streams::addon' => 'visiosoft.module.connect',
            ]
        )->middleware('auth:api');

        $router->post(
            'api/function/{namespace}/{stream}/{function}',
            [
                'uses' => 'Visiosoft\ConnectModule\Http\Controller\Resource\FunctionController@store',
                'streams::addon' => 'visiosoft.module.connect',
            ]
        )->middleware('auth:api');

    }

    /**
     * Map the streams API.
     *
     * @param Router $router
     */
    protected function mapStreamsApi(Router $router)
    {
        $router->get(
            'api/streams',
            [
                'uses' => 'Visiosoft\ConnectModule\Http\Controller\Resource\StreamsController@index',
                'streams::addon' => 'visiosoft.module.connect',
            ]
        )->middleware('auth:api');

        $router->post(
            'api/streams',
            [
                'uses' => 'Visiosoft\ConnectModule\Http\Controller\Resource\StreamsController@store',
                'streams::addon' => 'visiosoft.module.connect',
            ]
        )->middleware('auth:api');

        $router->get(
            'api/streams/{namespace}',
            [
                'uses' => 'Visiosoft\ConnectModule\Http\Controller\Resource\StreamsController@streams',
                'streams::addon' => 'visiosoft.module.connect',
            ]
        )->middleware('auth:api');

        $router->get(
            'api/streams/{namespace}/{slug}',
            [
                'uses' => 'Visiosoft\ConnectModule\Http\Controller\Resource\StreamsController@show',
                'streams::addon' => 'visiosoft.module.connect',
            ]
        )->middleware('auth:api');

        $router->put(
            'api/streams/{namespace}/{slug}',
            [
                'uses' => 'Visiosoft\ConnectModule\Http\Controller\Resource\StreamsController@update',
                'streams::addon' => 'visiosoft.module.connect',
            ]
        )->middleware('auth:api');

        $router->patch(
            'api/streams/{namespace}/{slug}',
            [
                'uses' => 'Visiosoft\ConnectModule\Http\Controller\Resource\StreamsController@update',
                'streams::addon' => 'visiosoft.module.connect',
            ]
        )->middleware('auth:api');

        $router->delete(
            'api/streams/{namespace}/{slug}',
            [
                'uses' => 'Visiosoft\ConnectModule\Http\Controller\Resource\StreamsController@delete',
                'streams::addon' => 'visiosoft.module.connect',
            ]
        )->middleware('auth:api');
    }

    protected $listeners = [
        ActivateAccount::class => [
            SendActivationMail::class,
        ],
        ResetPassword::class => [
            SendResetMail::class,
        ],
    ];
}
