<?php namespace Anomaly\SettingsModule\Setting\Form;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Illuminate\Contracts\Config\Repository;

/**
 * Class SettingFormFields
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class SettingFormFields
{

    /**
     * The config repository.
     *
     * @var Repository
     */
    protected $config;

    /**
     * Create a new SettingFormFields instance.
     *
     * @param Repository $config
     */
    public function __construct(Repository $config)
    {
        $this->config = $config;
    }

    /**
     * Return the form fields.
     *
     * @param SettingFormBuilder $builder
     */
    public function handle(SettingFormBuilder $builder, SettingRepositoryInterface $settings)
    {
        $namespace = $builder->getFormEntry() . '::';

        /*
         * Get the fields from the config system. Sections are
         * optionally defined the same way.
         */
        if (!$fields = $this->config->get($namespace . 'settings/settings')) {
            $fields = $fields = $this->config->get($namespace . 'settings', []);
        }

        if ($sections = $this->config->get($namespace . 'settings/sections')) {
            $builder->setSections($sections);
        }

        /*
         * Finish each field.
         */
        foreach ($fields as $slug => &$field) {

            /*
             * Force an array. This is done later
             * too in normalization but we need it now
             * because we are normalizing / guessing our
             * own parameters somewhat.
             */
            if (is_string($field)) {
                $field = [
                    'type' => $field,
                ];
            }

            // Make sure we have a config property.
            $field['config'] = array_get($field, 'config', []);

            if (trans()->has(
                $label = array_get(
                    $field,
                    'label',
                    $namespace . 'setting.' . $slug . '.label'
                )
            )
            ) {
                $field['label'] = $label;
            }

            // Default the label.
            $field['label'] = array_get(
                $field,
                'label',
                $namespace . 'setting.' . $slug . '.name'
            );

            // Default the warning.
            if (trans()->has(
                $warning = array_get(
                    $field,
                    'warning',
                    $namespace . 'setting.' . $slug . '.warning'
                )
            )
            ) {
                $field['warning'] = $warning;
            }

            // Default the placeholder.
            if (trans()->has(
                $placeholder = array_get(
                    $field,
                    'placeholder',
                    $namespace . 'setting.' . $slug . '.placeholder'
                )
            )
            ) {
                $field['placeholder'] = $placeholder;
            }

            // Default the instructions.
            if (trans()->has(
                $instructions = array_get(
                    $field,
                    'instructions',
                    $namespace . 'setting.' . $slug . '.instructions'
                )
            )
            ) {
                $field['instructions'] = $instructions;
            }

            // Get the value defaulting to the default value.
            if (!isset($field['value'])) {
                $field['value'] = $settings->value($namespace . $slug, array_get($field['config'], 'default_value'));
            }

            /*
             * Disable the field if it
             * has a set env value.
             */
            if (isset($field['env']) && isset($field['bind']) && env($field['env']) !== null) {
                $field['disabled'] = true;
                $field['warning']  = 'module::message.env_locked';
                $field['value']    = $this->config->get($field['bind']);
            }
        }

        $builder->setFields($fields);
    }
}
