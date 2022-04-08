<?php namespace Anomaly\SettingsModule\Setting\Listener;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\Streams\Platform\Addon\Module\Event\ModuleWasUninstalled;

/**
 * Class DeleteModuleSettings
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class DeleteModuleSettings
{

    /**
     * The settings repository.
     *
     * @var SettingRepositoryInterface
     */
    protected $settings;

    /**
     * Create a new DeleteModuleSettings instance.
     *
     * @param SettingRepositoryInterface $settings
     */
    public function __construct(SettingRepositoryInterface $settings)
    {
        $this->settings = $settings;
    }

    /**
     * Handle the event.
     *
     * @param ModuleWasUninstalled $event
     */
    public function handle(ModuleWasUninstalled $event)
    {
        $module = $event->getModule();

        foreach ($this->settings->findAllByNamespace($module->getNamespace()) as $setting) {
            $this->settings->delete($setting);
        }
    }
}
