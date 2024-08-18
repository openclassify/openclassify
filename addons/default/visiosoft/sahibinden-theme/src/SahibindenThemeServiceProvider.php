<?php namespace Visiosoft\SahibindenTheme;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Anomaly\Streams\Platform\Ui\Form\Event\FormWasPosted;
use Anomaly\Streams\Platform\Ui\Form\Event\FormWasSaved;
use Visiosoft\SahibindenTheme\Listeners\PostEntryFormSaved;

class SahibindenThemeServiceProvider extends AddonServiceProvider
{
    /**
     * The addon view overrides.
     *
     * @type array|null
     */
    protected $overrides = [
        'streams::errors/404' => 'visiosoft.theme.sahibinden::errors/404',
        'streams::errors/403' => 'visiosoft.theme.sahibinden::errors/403',
        'anomaly.module.users::login' => 'visiosoft.theme.sahibinden::addons/anomaly/users-module/login',
        'anomaly.module.users::register' => 'visiosoft.theme.sahibinden::addons/anomaly/users-module/register',
        'anomaly.module.users::password/forgot' => 'visiosoft.theme.sahibinden::addons/anomaly/users-module/password/forgot',
        'anomaly.module.users::password/reset' => 'visiosoft.theme.sahibinden::addons/anomaly/users-module/password/reset',
    ];

    protected $listeners = [
        FormWasSaved::class => [
            PostEntryFormSaved::class
        ]
    ];

}
