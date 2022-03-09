<?php namespace Visiosoft\ConnectModule;

use Anomaly\Streams\Platform\Assignment\Contract\AssignmentRepositoryInterface;
use Anomaly\Streams\Platform\Database\Seeder\Seeder;
use Anomaly\Streams\Platform\Field\Contract\FieldRepositoryInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamRepositoryInterface;

class ConnectModuleSeeder extends Seeder
{

    public function run(
        FieldRepositoryInterface $fieldRepository,
        AssignmentRepositoryInterface $assignmentRepository,
        StreamRepositoryInterface $streamRepository
    )
    {

        $namespace = 'users';
        $locked = 0;
        $stream = $streamRepository->findBySlugAndNamespace('users', 'users');

        $customFields = [
            [
                'name' => 'referrer',
                'slug' => 'referrer',
                'type' => 'anomaly.field_type.text',
            ]
        ];

        foreach ($customFields as $customField) {
            $field = $fieldRepository->findBySlugAndNamespace($customField['slug'], $namespace);

            if (!$field) {
                $data = [
                    'name' => $customField['name'],
                    'namespace' => $namespace,
                    'slug' => $customField['slug'],
                    'type' => $customField['type'],
                    'locked' => $locked
                ];
                if (isset($customField['config'])) {
                    $data['config'] = $customField['config'];
                }

                $field = $fieldRepository->create($data);

                $assignmentRepository->create([
                    'stream_id' => $stream->id,
                    'field_id' => $field->id
                ]);
            }
        }
    }
}
