<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleCatsChangeIconFieldType extends Migration
{

    public function up()
    {
        if (!$field = $this->fields()->findBySlugAndNamespace('icon', 'cats')) {
            return;
        }

        $field->setAttribute('type', 'visiosoft.field_type.input_file');
        $field->setAttribute('config', []);
        $this->fields()->save($field);
    }
}
