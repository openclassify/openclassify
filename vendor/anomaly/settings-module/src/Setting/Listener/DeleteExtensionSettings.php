<?php namespace Anomaly\SettingsModule\Setting\Listener;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\Streams\Platform\Addon\Extension\Event\ExtensionWasUninstalled;

/**
 * Class DeleteExtensionSettings
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class DeleteExtensionSettings
{

    /**
     * The settings repository.
     *
     * @var SettingRepositoryInterface
     */
    protected $settings;

    /**
     * Create a new DeleteExtensionSettings instance.
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
     * @param ExtensionWasUninstalled $event
     */
    public function handle(ExtensionWasUninstalled $event)
    {
        $extension = $event->getExtension();

        foreach ($this->settings->findAllByNamespace($extension->getNamespace()) as $setting) {
            $this->settings->delete($setting);
        }
    }
}
