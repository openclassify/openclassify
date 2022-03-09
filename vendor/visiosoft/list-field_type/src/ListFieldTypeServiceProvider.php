<?php namespace Visiosoft\ListFieldType;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;

class ListFieldTypeServiceProvider extends AddonServiceProvider
{
    protected $singletons = [
        'Visiosoft\ListFieldType\ListFieldTypeModifier' => 'Visiosoft\ListFieldType\ListFieldTypeModifier'
    ];
}
