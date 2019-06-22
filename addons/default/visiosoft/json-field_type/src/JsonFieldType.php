<?php namespace Visiosoft\JsonFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;

class JsonFieldType extends FieldType
{

    protected $inputView = 'visiosoft.field_type.json::input';

    protected $config = [
    ];

    protected $columnType = 'json';
}
