<?php namespace Anomaly\PreferencesModule\Preference\Command;

use Anomaly\PreferencesModule\Preference\Contract\PreferenceInterface;
use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Anomaly\Streams\Platform\Addon\FieldType\FieldTypeBuilder;
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
     * The preference instance.
     *
     * @var PreferenceInterface
     */
    protected $preference;

    /**
     * Create a new GetValueFieldType instance.
     *
     * @param PreferenceInterface $preference
     */
    public function __construct(PreferenceInterface $preference)
    {
        $this->preference = $preference;
    }

    /**
     * Handle the command.
     *
     * @param  FieldTypeBuilder $fieldTypes
     * @param  Repository $config
     * @return FieldType
     */
    public function handle(FieldTypeBuilder $fieldTypes, Repository $config)
    {
        // Get the preference's key.
        $key = $this->preference->getKey();

        // Get the bare value.
        $value = array_get($this->preference->getAttributes(), 'value');

        // Try and find the preference's field configuration.
        if (!$field = $config->get(str_replace('::', '::preferences/preferences.', $key))) {
            $field = $config->get(str_replace('::', '::preferences.', $key));
        }

        // Convert short syntax.
        if (is_string($field)) {
            $field = [
                'type' => $field,
            ];
        }

        /*
         * Try and get the field type that
         * the preference uses. If none exists
         * then just return the value as is.
         */
        if (!$field || !$type = $fieldTypes->build($field)) {
            return null;
        }

        // Setup the field type.
        $type->setEntry($this->preference);
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
