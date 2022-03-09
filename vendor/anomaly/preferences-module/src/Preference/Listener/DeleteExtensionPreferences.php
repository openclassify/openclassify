<?php namespace Anomaly\PreferencesModule\Preference\Listener;

use Anomaly\PreferencesModule\Preference\Contract\PreferenceRepositoryInterface;
use Anomaly\Streams\Platform\Addon\Extension\Event\ExtensionWasUninstalled;

/**
 * Class DeleteExtensionPreferences
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class DeleteExtensionPreferences
{

    /**
     * The settings repository.
     *
     * @var PreferenceRepositoryInterface
     */
    protected $settings;

    /**
     * Create a new DeleteExtensionPreferences instance.
     *
     * @param PreferenceRepositoryInterface $settings
     */
    public function __construct(PreferenceRepositoryInterface $settings)
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
