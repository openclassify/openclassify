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
                $field = $this->fields()->create([
                    'name' => trans('visiosoft.module.profile::field.birthday.name'),
                    'namespace' => 'users',
                    'slug' => 'birthday',
                    'type' => 'anomaly.field_type.datetime',
                    'locked' => 0,
                    'config' => [
                        "mode" => "date",
                        "picker" => true,
                    ]
                ]);

                $this->assignments()->create([
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
        /*
         * I never go back on my word!
         * That's my nindo: my ninja way!
         * NARUTO
         */
    }
}
