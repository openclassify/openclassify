<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleProfileCreateUtmSourceField extends Migration
{
    public function up()
    {
        if (!$this->fields()->findBySlugAndNamespace('utm_source', 'users')) {
            $field = $this->fields()
                ->create(
                    [
                        'slug'      => 'utm_source',
                        'namespace' => 'users',
                        'type'      => 'anomaly.field_type.text',
                        'name'      => 'visiosoft.module.profile::field.utm_source.name',
                        'locked'    => false,
                    ]
                );

            $stream = $this->streams()->findBySlugAndNamespace('users', 'users');

            $this->assignments()
                ->create(
                    [
                        'field'    => $field,
                        'stream'   => $stream,
                    ]
                );
        }
    }

    public function down()
    {
        if ($field = $this->fields()->findBySlugAndNamespace('utm_source', 'users')) {
            $field->delete();
        }
    }
}
