<?php namespace Anomaly\SettingsModule;

use Anomaly\SettingsModule\Console\Dump;
use Anomaly\SettingsModule\Listener\RefreshSettingsModule;
use Anomaly\SettingsModule\Setting\Command\DumpSettings;
use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\SettingsModule\Setting\Listener\ClearHttpCache;
use Anomaly\SettingsModule\Setting\Listener\DeleteExtensionSettings;
use Anomaly\SettingsModule\Setting\Listener\DeleteModuleSettings;
use Anomaly\SettingsModule\Setting\SettingModel;
use Anomaly\SettingsModule\Setting\SettingRepository;
use Anomaly\SettingsModule\Setting\SettingsWereSaved;
use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Anomaly\Streams\Platform\Addon\Extension\Event\ExtensionWasUninstalled;
use Anomaly\Streams\Platform\Addon\Module\Event\ModuleWasUninstalled;
use Anomaly\Streams\Platform\Application\Event\SystemIsRefreshing;
use Anomaly\Streams\Platform\Model\Settings\SettingsSettingsEntryModel;

/**
 * Class SettingsModuleServiceProvider
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class SettingsModuleServiceProvider extends AddonServiceProvider
{

    /**
     * The addon commands.
     *
     * @var array
     */
    protected $commands = [
        Dump::class,
    ];

    /**
     * The addon plugins.
     *
     * @var array
     */
    protected $plugins = [
        SettingsModulePlugin::class,
    ];

    /**
     * The addon listeners.
     *
     * @var array
     */
    protected $listeners = [
        SettingsWereSaved::class       => [
            ClearHttpCache::class,
        ],
        SystemIsRefreshing::class      => [
            RefreshSettingsModule::class,
        ],
        ModuleWasUninstalled::class    => [
            DeleteModuleSettings::class,
        ],
        ExtensionWasUninstalled::class => [
            DeleteExtensionSettings::class,
        ],
    ];

    /**
     * The class bindings.
     *
     * @var array
     */
    protected $bindings = [
        SettingsSettingsEntryModel::class => SettingModel::class,
    ];

    /**
     * The singleton bindings.
     *
     * @var array
     */
    protected $singletons = [
        SettingRepositoryInterface::class => SettingRepository::class,
    ];

    /**
     * The addon routes.
     *
     * @var array
     */
    protected $routes = [
        'admin/settings'                => 'Anomaly\SettingsModule\Http\Controller\Admin\SystemController@edit',
        'admin/settings/{type}'         => 'Anomaly\SettingsModule\Http\Controller\Admin\AddonsController@index',
        'admin/settings/{type}/{addon}' => 'Anomaly\SettingsModule\Http\Controller\Admin\AddonsController@edit',
    ];

    /**
     * Boot the addon.
     */
    public function boot()
    {
        if (!file_exists($config = app_storage_path('settings/config.php'))) {
            dispatch_now(new DumpSettings());
        }

        config(require $config);
    }

}
