<?php namespace Visiosoft\DefaultadminTheme\Listener;

use Anomaly\PreferencesModule\Preference\Contract\PreferenceRepositoryInterface;
use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\Streams\Platform\Ui\ControlPanel\Component\Navigation\Event\SortNavigation;

/**
 * Class ApplySorting
 *
 * @link   http://openclassify.com/
 * @author OpenClassify, Inc. <support@openclassify.com>
 * @author Vedat Akdogan <vedat@openclassify.com>
 */
class ApplySorting
{

    /**
     * The settings repository.
     *
     * @var SettingRepositoryInterface
     */
    protected $settings;

    /**
     * The preferences repository.
     *
     * @var PreferenceRepositoryInterface $preferences
     */
    protected $preferences;

    /**
     * Create a new ApplySorting instance.
     *
     * @param SettingRepositoryInterface    $settings
     * @param PreferenceRepositoryInterface $preferences
     */
    public function __construct(SettingRepositoryInterface $settings, PreferenceRepositoryInterface $preferences)
    {
        $this->settings    = $settings;
        $this->preferences = $preferences;
    }

    /**
     * Handle the event.
     *
     * @param SortNavigation $event
     */
    public function handle(SortNavigation $event)
    {
        $builder    = $event->getBuilder();
        $navigation = $builder->getNavigation();

        if ($settings = $this->settings->value('visiosoft.theme.defaultadmin::navigation')) {
            $navigation = array_merge(array_flip((array)json_decode($settings)), $navigation);
        }

        if ($preferences = $this->preferences->value('visiosoft.theme.defaultadmin::navigation')) {
            $navigation = array_merge(array_flip((array)json_decode($preferences)), $navigation);
        }

        /**
         * Remove non-installed addons
         * cause they won't be in the nav.
         */
        $navigation = array_filter(
            $navigation,
            function ($item) {
                return is_array($item);
            }
        );

        $builder->setNavigation($navigation);
    }
}
