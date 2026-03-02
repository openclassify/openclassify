<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleProfileCreateBirthdayField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ($stream = $this->streams()->findBySlugAndNamespace('users', 'users')) {
            $field = $this->fields()
                ->newQuery()
                ->where('slug', 'birthday')
                ->where('namespace', 'users')
                ->first();

            if (!$field) {
                $field = $this->fields()->newQuery()->create([
                    'name' => 'visiosoft.module.profile::field.birthday.name',
                    'namespace' => 'users',
                    'slug' => 'birthday',
                    'type' => 'anomaly.field_type.datetime',
                    'locked' => 0,
                    'config' => [
                        "mode" => "date",
                        "picker" => true,
                    ]
                ]);

                $this->assignments()->newQuery()->create([
                    'stream_id' => $stream->id,
                    'field_id' => $field->id
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
