<?php namespace Anomaly\ConfigurationModule\Configuration\Command;

use Anomaly\ConfigurationModule\Configuration\Contract\ConfigurationInterface;
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
     * The configuration instance.
     *
     * @var ConfigurationInterface
     */
    protected $configuration;

    /**
     * Create a new GetValueFieldType instance.
     *
     * @param ConfigurationInterface $configuration
     */
    public function __construct(ConfigurationInterface $configuration)
    {
        $this->configuration = $configuration;
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
        // Get the configuration's key.
        $key = $this->configuration->getKey();

        // Get the bare value.
        $value = array_get($this->configuration->getAttributes(), 'value');

        // Try and find the configuration's field configuration.
        if (!$field = $config->get(str_replace('::', '::configuration/configuration.', $key))) {
            $field = $config->get(str_replace('::', '::configuration.', $key));
        }

        // Convert short syntax.
        if (is_string($field)) {
            $field = [
                'type' => $field,
            ];
        }

        /*
         * Try and get the field type that
         * the configuration uses. If none exists
         * then just return the value as is.
         */
        if (!$field || !$type = $fieldTypes->build($field)) {
            return null;
        }

        // Setup the field type.
        $type->setEntry($this->configuration);
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
