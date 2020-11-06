<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class VisiosoftModuleProfileCreateProfessionAndEducationalFields extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if ($stream = $this->streams()->findBySlugAndNamespace('users', 'users')) {
            $fields = [
                [
                    'name' => trans('visiosoft.module.profile::field.education.name'),
                    'slug' => 'education',
                ],
                [
                    'name' => trans('visiosoft.module.profile::field.state_of_education.name'),
                    'slug' => 'state_of_education',
                ],
                [
                    'name' => trans('visiosoft.module.profile::field.profession.name'),
                    'slug' => 'profession',
                ],
            ];

            foreach ($fields as $field) {
                $exists = $this->fields()
                    ->newQuery()
                    ->where('slug', $field['slug'])
                    ->where('namespace', 'users')
                    ->first();

                if (!$exists) {
                    $userField = $this->fields()->create([
                        'name' => $field['name'],
                        'namespace' => 'users',
                        'slug' => $field['slug'],
                        'type' => 'anomaly.field_type.tags',
                        'locked' => 0,
                    ]);

                    $this->assignments()->create([
                        'stream_id' => $stream->id,
                        'field_id' => $userField->id
                    ]);
                }
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
