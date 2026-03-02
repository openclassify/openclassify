<?php namespace Visiosoft\StyleSelectorModule\Style\Form;

use Anomaly\SelectFieldType\SelectFieldType;
use Anomaly\Streams\Platform\Addon\Extension\ExtensionCollection;

class StyleFormFields
{
    public function handle(StyleFormBuilder $builder)
    {
        $selected_type_detail = setting_value('visiosoft.module.style_selector::detail');

        $builder->setFields([
            "detail" => [
                "type" => "anomaly.field_type.select",
                "label" => 'visiosoft.module.style_selector::field.detail_page',
                'inputView' => 'visiosoft.module.style_selector::field_type.preview_select',
                "config" => [
                    "handler" => function (SelectFieldType $fieldType, ExtensionCollection $extensions) {
                        $themes = $extensions->search('visiosoft.module.style_selector::provider.*')
                            ->pluck('thumbnail', 'namespace')->all();

                        $fieldType->setOptions($themes);
                    },
                    'default_value' => $selected_type_detail,
                    "mode" => "radio",
                ]
            ]
        ]);
    }
}
