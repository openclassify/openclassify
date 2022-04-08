<?php namespace Anomaly\SettingsModule\Setting;

use Anomaly\SettingsModule\Setting\Form\SettingFormBuilder;

/**
 * Class SettingsWereSaved
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class SettingsWereSaved
{

    /**
     * The setting form builder.
     *
     * @var SettingFormBuilder
     */
    protected $builder;

    /**
     * Create a new SettingsWereSaved instance.
     *
     * @param SettingFormBuilder $builder
     */
    public function __construct(SettingFormBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Get the builder.
     *
     * @return SettingFormBuilder
     */
    public function getBuilder()
    {
        return $this->builder;
    }

}
