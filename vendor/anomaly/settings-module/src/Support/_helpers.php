<?php

use Anomaly\SettingsModule\Setting\Command\GetSetting;
use Anomaly\SettingsModule\Setting\Command\GetSettingValue;
use Anomaly\SettingsModule\Setting\Command\GetValueFieldType;
use Anomaly\SettingsModule\Setting\Contract\SettingInterface;
use Anomaly\Streams\Platform\Addon\FieldType\FieldType;

if (!function_exists('setting')) {

    /**
     * Get a setting.
     *
     * @param $key
     * @return FieldType
     */
    function setting($key)
    {
        /* @var SettingInterface $setting */
        if (!$setting = dispatch_now(new GetSetting($key))) {
            return null;
        }

        return dispatch_now(new GetValueFieldType($setting));
    }
}

if (!function_exists('setting_value')) {

    /**
     * Get a setting value.
     *
     * @param $key
     * @param null $default
     * @return FieldType
     */
    function setting_value($key, $default = null)
    {
        return dispatch_now(new GetSettingValue($key, $default));
    }
}
