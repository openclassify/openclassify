<?php namespace Visiosoft\ProfileModule\Seed;

use Anomaly\Streams\Platform\Assignment\AssignmentModelTranslation;
use Anomaly\Streams\Platform\Assignment\Contract\AssignmentRepositoryInterface;
use Anomaly\Streams\Platform\Database\Seeder\Seeder;
use Anomaly\Streams\Platform\Entry\EntryTranslationsModel;
use Anomaly\Streams\Platform\Field\Contract\FieldRepositoryInterface;
use Anomaly\Streams\Platform\Field\FieldModelTranslation;
use Anomaly\Streams\Platform\Stream\Contract\StreamRepositoryInterface;
use Anomaly\Streams\Platform\Stream\StreamModelTranslation;
use Visiosoft\LocationModule\Country\CountryModel;

class UsersFieldsSeeder extends Seeder
{
    /**
     * Run the seeder.
     * @param FieldRepositoryInterface $fieldRepository
     * @param AssignmentRepositoryInterface $assignmentRepository
     * @param StreamRepositoryInterface $streamRepository
     * @param FieldModelTranslation $fieldModelTranslation
     * @param AssignmentModelTranslation $assignmentModelTranslation
     */
    public function run(
        FieldRepositoryInterface $fieldRepository,
        AssignmentRepositoryInterface $assignmentRepository,
        StreamRepositoryInterface $streamRepository,
        FieldModelTranslation $fieldModelTranslation,
        AssignmentModelTranslation $assignmentModelTranslation
    )
    {
        $namespace = 'users';
        $locked = 0;
        $stream = $streamRepository->findBy('slug', 'users');
        $assignmentConfig = 'a:0:{}';

        $customFields = [
            0 => [
                'name' => 'File',
                'slug' => 'file',
                'type' => 'visiosoft.field_type.singlefile',
                'config' => [
                    'folders' => ["images"],
                    'mode' => 'upload',
                ]
            ],
            1 => [
                'name' => 'Country',
                'slug' => 'country',
                'type' => 'anomaly.field_type.relationship',
                'config' => [
                    'related' => CountryModel::class,
                    "default_value" => 0,
                ],
            ],
            2 => [
                'name' => 'City',
                'slug' => 'city',
                'type' => 'anomaly.field_type.select',
                "config" => [
                    "options" => [],
                ]
            ],
            3 => [
                'name' => 'District',
                'slug' => 'district',
                'type' => 'anomaly.field_type.select',
                "config" => [
                    "options" => [],
                ]
            ],
            4 => [
                'name' => 'Neighborhood',
                'slug' => 'neighborhood',
                'type' => 'anomaly.field_type.select',
                "config" => [
                    "options" => [],
                ]
            ],
            5 => [
                'name' => 'Village',
                'slug' => 'village',
                'type' => 'anomaly.field_type.select',
                "config" => [
                    "options" => [],
                ]
            ],
            6 => [
                'name' => 'Gsm Phone',
                'slug' => 'gsm_phone',
                'type' => 'anomaly.field_type.text',
            ],
            7 => [
                'name' => 'Land Phone',
                'slug' => 'land_phone',
                'type' => 'anomaly.field_type.text',
            ],
            8 => [
                'name' => 'Office Phone',
                'slug' => 'office_phone',
                'type' => 'anomaly.field_type.text',
            ],
            9 => [
                'name' => 'Register Type',
                'slug' => 'register_type',
                'type' => 'anomaly.field_type.select',
                "config" => [
                    "options" => [
                        '1' => trans('visiosoft.module.profile::field.individual.name'),
                        '2' => trans('visiosoft.module.profile::field.corporate.name')
                    ],
                ]
            ],
            10 => [
                'name' => 'Identification Number',
                'slug' => 'identification_number',
                'type' => 'anomaly.field_type.text',
            ],
            11 => [
                'name' => 'Notified New Updates',
                'slug' => 'notified_new_updates',
                'type' => 'anomaly.field_type.select',
                'config' => [
                    'default_value' => 1,
                    'options' => [0 => 'Active', 1 => 'Passive'],
                    'separator' => ':',
                ]
            ],
            12 => [
                'name' => 'Notified About Ads',
                'slug' => 'notified_about_ads',
                'type' => 'anomaly.field_type.select',
                'config' => [
                    'default_value' => 1,
                    'options' => [0 => 'Active', 1 => 'Passive'],
                    'separator' => ':',
                ]
            ],
            13 => [
                'name' => 'Receive Messages Email',
                'slug' => 'receive_messages_email',
                'type' => 'anomaly.field_type.select',
                'config' => [
                    'default_value' => 1,
                    'options' => [0 => 'Active', 1 => 'Passive'],
                    'separator' => ':',
                ]
            ],
        ];

        foreach ($customFields as $customField) {
            $fields = $fieldRepository
                ->newQuery()
                ->where('slug', $customField['slug'])
                ->where('namespace', $namespace)
                ->get();

            if ($fields) {
                foreach ($fields as $field) {
                    $fieldModelTranslation->newQuery()->where('field_id', $field->id)->delete();

                    $assignment = $assignmentRepository
                        ->newQuery()
                        ->where('stream_id', $stream->id)
                        ->where('field_id', $field->id)
                        ->first();
                    if ($assignment) {
                        $assignmentModelTranslation->newQuery()->where('assignment_id', $assignment->id)->delete();
                        $assignment->delete();
                    }

                    $field->delete();
                }
            }

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
