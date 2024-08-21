<?php namespace Visiosoft\RestateTheme;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Illuminate\Routing\Router;
use Visiosoft\RestateTheme\Profile\Form\ProfileFormBuilder;

class RestateThemeServiceProvider extends AddonServiceProvider
{

    protected $bindings = [
        'hepsiProfile' => ProfileFormBuilder::class,
    ];


    protected $plugins = [
        RestateThemePlugin::class,
    ];

    protected $routes = [
        '/contact-us' => '\Visiosoft\RestateTheme\Http\Controller\ThemeController@contactUsPage',
        '/ajax/print-detail-view/{id}' => '\Visiosoft\RestateTheme\Http\Controller\ThemeController@printAdDetailView',
    ];

    protected $overrides = [
        'streams::errors/404' => 'visiosoft.theme.base::errors/404',
        'streams::errors/403' => 'visiosoft.theme.base::errors/403',
        'anomaly.module.users::login' => 'visiosoft.theme.restate::addons/anomaly/users-module/login',
        'anomaly.module.users::register' => 'visiosoft.theme.restate::addons/anomaly/users-module/register',
        'anomaly.module.users::password/forgot' => 'visiosoft.theme.restate::addons/anomaly/users-module/password/forgot',
        'anomaly.module.users::password/reset' => 'visiosoft.theme.restate::addons/anomaly/users-module/password/reset',
    ];
}
