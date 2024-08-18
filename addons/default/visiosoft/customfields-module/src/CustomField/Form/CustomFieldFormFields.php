<?php namespace Visiosoft\CustomfieldsModule\CustomField\Form;

class CustomFieldFormFields
{
    public function handle(CustomFieldFormBuilder $builder)
    {
        $entry = $builder->getFormEntry();
        if ($builder->getFormMode() == "edit") {
            $fields = ['name', 'description', 'required', 'seenList', 'show_filter', 'hide_addetail'];

            $type_integer = ['integer', 'range'];
            if (in_array($entry->getType(), $type_integer)) {

                $config_entry = json_decode($entry->config, true);
                $config_fields = [
                    'config_min' => [
                        'label' => 'visiosoft.module.customfields::field.min',
                        'value' => (isset($config_entry['config_min'])) ? $config_entry['config_min'] : '',
                        'required' => true,
                        'type' => 'anomaly.field_type.integer',
                        'config' => [
                            'min' => 0
                        ],
                    ],
                    'config_max' => [
                        'label' => 'visiosoft.module.customfields::field.max',
                        'value' => (isset($config_entry['config_max'])) ? $config_entry['config_max'] : '',
                        'required' => true,
                        'type' => 'anomaly.field_type.integer',
                        'config' => [
                            'min' => 0
                        ],
                    ]
                ];

                $fields = array_merge($fields, $config_fields);
            }

        } else {
            $fields = [
                'name' => [
                    'translatable' => true,
                    'required' => true,
                ],
                'slug',
                'description',
                'required',
                'seenList',
                'show_filter',
                'hide_addetail'
            ];

            $customfieldType = [
                "checkboxes" => trans("visiosoft.module.customfields::field.checkboxes_type"),
                "decimal" => trans("visiosoft.module.customfields::field.decimal_type"),
                "integer" => trans("visiosoft.module.customfields::field.integer_type"),
                "radio" => trans("visiosoft.module.customfields::field.radio_type"),
                "range" => trans("visiosoft.module.customfields::field.range_type"),
                "select" => trans("visiosoft.module.customfields::field.select_type"),
                "selectdropdown" => trans("visiosoft.module.customfields::field.selectdropdown_type"),
                "selecttop" => trans("visiosoft.module.customfields::field.selecttop_type"),
                "selectrange" => trans("visiosoft.module.customfields::field.selectrange_type"),
                "selectimage" => trans("visiosoft.module.customfields::field.selectimage_type"),
                "text" => trans("visiosoft.module.customfields::field.text_type"),
                "datetime" => trans("visiosoft.module.customfields::field.datetime_type"),
            ];

            /*
             * If you add more custom fields,
             * don't forget to add them to this JS file
             * (visiosoft.module.customfields::js/admin/customfields.js)
             */
            $fields = array_merge([
                'type' => [
                    'instructions' => function () {
                        $message = '<div class="alert alert-info alert-dismissible"><ul class="list-unstyled">';
                        foreach (trans('visiosoft.module.customfields::message.field_type.instructions') as $key => $item) {
                            $message .= "<li><b>" . trans('visiosoft.module.customfields::field.' . $key . '_type') . ":</b> " . $item . "</li>";
                        }
                        $message .= "</ul></div>";
                        return $message;
                    },
                    'config' => [
                        'required' => true,
                        'mode' => 'dropdown',
                        'options' => $customfieldType
                    ]
                ],
            ], $fields);
        }

        $builder->setFields($fields);
    }
}
