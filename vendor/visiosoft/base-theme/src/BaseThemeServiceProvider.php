<?php namespace Visiosoft\BaseTheme;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;

class BaseThemeServiceProvider extends AddonServiceProvider
{
    protected $mobile = [
        'streams::errors/404' => 'visiosoft.theme.base::errors/404',
        'streams::errors/403' => 'visiosoft.theme.base::errors/403',
        'anomaly.module.users::login' => 'visiosoft.theme.base::addons/anomaly/users-module/login',
        'anomaly.module.users::register' => 'visiosoft.theme.base::addons/anomaly/users-module/register',
        'anomaly.module.users::password/forgot' => 'visiosoft.theme.base::addons/anomaly/users-module/password/forgot',
        'anomaly.module.users::password/reset' => 'visiosoft.theme.base::addons/anomaly/users-module/password/reset',
    ];
}
