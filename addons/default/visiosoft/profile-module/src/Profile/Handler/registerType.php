<?php namespace Visiosoft\ProfileModule\Profile\Handler;

use Anomaly\SelectFieldType\SelectFieldType;

class registerType
{
    public function handle(SelectFieldType $fieldType)
    {
        $fieldType->setOptions(
            [
                '1' => trans('visiosoft.module.profile::field.individual.name'),
                '2' => trans('visiosoft.module.profile::field.corporate.name')
            ]
        );
    }
}