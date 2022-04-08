<?php namespace Anomaly\SettingsModule\Setting\Command;

use Anomaly\SettingsModule\Setting\Contract\SettingInterface;
use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Anomaly\Streams\Platform\Addon\FieldType\FieldTypeBuilder;
use Anomaly\Streams\Platform\Addon\FieldType\FieldTypeCollection;
use Illuminate\Contracts\Config\Repository;

/**
 * Class GetValueFieldType
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class GetValueFieldType
{

    /**
     * The setting instance.
     *
     * @var SettingInterface
     */
    protected $setting;

    /**
     * Create a new GetValueFieldType instance.
     *
     * @param SettingInterface $setting
     */
    public function __construct(SettingInterface $setting)
    {
        $this->setting = $setting;
    }

    /**
     * Handle the command.
     *
     * @param  FieldTypeBuilder $fieldTypes
     * @param  Repository $config
     * @return FieldType|void
     */
    public function handle(FieldTypeBuilder $fieldTypes, Repository $config)
    {
        // Get the setting's key.
        $key = $this->setting->getKey();

        // Get the bare value.
        $value = array_get($this->setting->getAttributes(), 'value');

        /**
         * Try and find the
         * field configuration.
         */
        if (!$field = $config->get(str_replace('::', '::settings/settings.', $key))) {
            $field = $config->get(str_replace('::', '::settings.', $key));
        }

        /**
         * Convert short syntax.
         */
        if (is_string($field)) {
            $field = [
                'type' => $field,
            ];
        }

        /*
         * Try and get the field type that
         * the setting uses. If none exists
         * then just return the value as is.
         */
        if (!$field || !$type = $fieldTypes->build($field)) {
            return null;
        }

        /**
         * Setup the field type.
         */
        $type->setEntry($this->setting);
        $type->mergeRules(array_get($field, 'rules', []));
        $type->mergeConfig(array_get($field, 'config', []));

        /*
         * If the type can be determined then
         * get the modifier and restore the value
         * before returning it.
         */
        $modifier = $type->getModifier();

        $type->setValue($modifier->restore($value));

        return $type;
    }
}
