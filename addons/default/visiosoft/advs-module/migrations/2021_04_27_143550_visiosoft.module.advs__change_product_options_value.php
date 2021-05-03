<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleAdvsChangeProductOptionsValue extends Migration
{
    public function __construct()
    {
        //Maria DB will be removed when the version is updated.
        \Illuminate\Support\Facades\DB::getDoctrineSchemaManager()
            ->getDatabasePlatform()->registerDoctrineTypeMapping('point', 'string');
    }

    public function up()
    {
        if (!$field = $this->fields()->findBySlugAndNamespace('product_options_value', 'advs')) {
            return;
        }

        $field->setAttribute('type', 'visiosoft.field_type.multiple');

        $this->fields()->save($field);
    }

    public function down()
    {
        if (!$field = $this->fields()->findBySlugAndNamespace('product_options_value', 'advs')) {
            return;
        }

        $field->setAttribute('type', 'anomaly.field_type.multiple');

        $this->fields()->save($field);
    }
}
