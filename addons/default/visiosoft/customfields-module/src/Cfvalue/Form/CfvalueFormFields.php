<?php namespace Visiosoft\CustomfieldsModule\Cfvalue\Form;


class CfvalueFormFields
{
	public function handle(CfvalueFormBuilder $builder)
	{
		$builder->setFields(($builder->getFormMode() === "create") ? [
			'custom_field_value' => [
				'type' => 'anomaly.field_type.tags'
			],
            'cf_value_icon' => [
                'type' => 'anomaly.field_type.file'
            ]
		] : [
			'custom_field_value' => [
				'type' => 'anomaly.field_type.text'
			],
            'cf_value_icon' => [
                'type' => 'anomaly.field_type.file'
            ]
		]);
	}
}
