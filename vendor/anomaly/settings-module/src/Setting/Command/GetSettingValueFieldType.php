<?php namespace Anomaly\SettingsModule\Setting\Command;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;


/**
 * Class GetSettingValueFieldType
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class GetSettingValueFieldType
{

    /**
     * The setting key.
     *
     * @var string
     */
    protected $key;

    /**
     * Create a new GetSettingValueFieldType instance.
     *
     * @param   $key
     */
    public function __construct($key)
    {
        $this->key = $key;
    }

    /**
     * Handle the command.
     *
     * @param  SettingRepositoryInterface $settings
     * @return \Anomaly\Streams\Platform\Addon\FieldType\FieldType|null
     */
    public function handle(SettingRepositoryInterface $settings)
    {
        if (!$setting = $settings->get($this->key)) {
            return null;
        }

        return $setting->getFieldType('value');
    }
}
