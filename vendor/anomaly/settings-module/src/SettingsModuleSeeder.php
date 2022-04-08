<?php namespace Anomaly\SettingsModule;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\Streams\Platform\Database\Seeder\Seeder;

/**
 * Class SettingsModuleSeeder
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class SettingsModuleSeeder extends Seeder
{

    /**
     * The settings repository.
     *
     * @var SettingRepositoryInterface
     */
    protected $settings;

    /**
     * Create a new SettingsModuleSeeder instance.
     *
     * @param SettingRepositoryInterface $settings
     */
    public function __construct(SettingRepositoryInterface $settings)
    {
        parent::__construct();

        $this->settings = $settings;
    }

    /**
     * Run the command.
     */
    public function run()
    {
        if ($timezone = env('APP_TIMEZONE')) {
            $this->settings->create(
                [
                    'key'   => 'streams::timezone',
                    'value' => $timezone,
                ]
            );
        }

        if ($domain = env('APPLICATION_DOMAIN')) {
            $this->settings->create(
                [
                    'key'   => 'streams::domain',
                    'value' => $domain,
                ]
            );
        }

        if ($locale = env('DEFAULT_LOCALE')) {

            $this->settings->create(
                [
                    'key'   => 'streams::default_locale',
                    'value' => $locale,
                ]
            );

            $this->settings->create(
                [
                    'key'   => 'streams::enabled_locales',
                    'value' => [$locale],
                ]
            );
        }
    }
}
