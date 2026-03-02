<?php

use Anomaly\Streams\Platform\Assignment\Contract\AssignmentRepositoryInterface;
use \Anomaly\Streams\Platform\Database\Migration\Migration;
use Anomaly\Streams\Platform\Field\Contract\FieldRepositoryInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamRepositoryInterface;

class VisiosoftModuleAdvsAddEidsFieldsToUser extends Migration
{

    public function up()
    {
        $streamRepository = app(StreamRepositoryInterface::class);
        $fieldRepository = app(FieldRepositoryInterface::class);
        $assignmentRepository = app(AssignmentRepositoryInterface::class);
        $stream = $streamRepository->findBySlugAndNamespace('users', 'users');

        if ($stream) {

            $fields = [
                [
                    'name' => 'Eids Auth Code',
                    'namespace' => 'users',
                    'slug' => 'eids_auth_code',
                    'type' => 'anomaly.field_type.text',
                    'locked' => 0
                ],
                [
                    'name' => 'Is Eids Verified',
                    'namespace' => 'users',
                    'slug' => 'is_eids_verified',
                    'type' => 'anomaly.field_type.boolean',
                    'locked' => 0
                ],
            ];

            foreach ($fields as $field) {
                $checkField = $fieldRepository->findBySlugAndNamespace($field['slug'], 'users');
                if (!$checkField) {
                    $field = $fieldRepository->create($field);
                    $assignmentRepository->create([
                        'stream_id' => $stream->id,
                        'field_id' => $field->id
                    ]);
                }
            }
        }
    }

    public function down()
    {

        if ($field = $this->fields()->findBySlugAndNamespace('eids_auth_code', 'users')) {
            $field->delete();
        }

        if ($field = $this->fields()->findBySlugAndNamespace('is_eids_verified', 'users')) {
            $field->delete();
        }
    }

}
