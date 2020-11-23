<?php namespace Visiosoft\ProfileModule\Seed;

use Anomaly\Streams\Platform\Assignment\Contract\AssignmentRepositoryInterface;
use Anomaly\Streams\Platform\Database\Seeder\Seeder;
use Anomaly\Streams\Platform\Field\Contract\FieldRepositoryInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamRepositoryInterface;
use Visiosoft\LocationModule\Country\CountryModel;

class UsersFieldsSeeder extends Seeder
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
                'name' => 'File',
                'slug' => 'file',
                'type' => 'visiosoft.field_type.singlefile',
                'config' => [
                    'folders' => ["images"],
                    'mode' => 'upload',
                ]
            ],
            [
                'name' => 'Country',
                'slug' => 'country',
                'type' => 'anomaly.field_type.relationship',
                'config' => [
                    'related' => CountryModel::class,
                    "default_value" => 0,
                ],
            ],
            [
                'name' => 'City',
                'slug' => 'city',
                'type' => 'anomaly.field_type.select',
                "config" => [
                    "options" => [],
                ]
            ],
            [
                'name' => 'District',
                'slug' => 'district',
                'type' => 'anomaly.field_type.select',
                "config" => [
                    "options" => [],
                ]
            ],
            [
                'name' => 'Neighborhood',
                'slug' => 'neighborhood',
                'type' => 'anomaly.field_type.select',
                "config" => [
                    "options" => [],
                ]
            ],
            [
                'name' => 'Village',
                'slug' => 'village',
                'type' => 'anomaly.field_type.select',
                "config" => [
                    "options" => [],
                ]
            ],
            [
                'name' => 'Gsm Phone',
                'slug' => 'gsm_phone',
                'type' => 'anomaly.field_type.text',
            ],
            [
                'name' => 'Land Phone',
                'slug' => 'land_phone',
                'type' => 'anomaly.field_type.text',
            ],
            [
                'name' => 'Office Phone',
                'slug' => 'office_phone',
                'type' => 'anomaly.field_type.text',
            ],
            [
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
            [
                'name' => 'Identification Number',
                'slug' => 'identification_number',
                'type' => 'anomaly.field_type.text',
            ],
            [
                'name' => 'Notified New Updates',
                'slug' => 'notified_new_updates',
                'type' => 'anomaly.field_type.select',
                'config' => [
                    'default_value' => 1,
                    'options' => [0 => 'Active', 1 => 'Passive'],
                    'separator' => ':',
                ]
            ],
            [
                'name' => 'Notified About Ads',
                'slug' => 'notified_about_ads',
                'type' => 'anomaly.field_type.select',
                'config' => [
                    'default_value' => 1,
                    'options' => [0 => 'Active', 1 => 'Passive'],
                    'separator' => ':',
                ]
            ],
            [
                'name' => 'Receive Messages Email',
                'slug' => 'receive_messages_email',
                'type' => 'anomaly.field_type.select',
                'config' => [
                    'default_value' => 1,
                    'options' => [0 => 'Active', 1 => 'Passive'],
                    'separator' => ':',
                ]
            ],
            [
                'name' => trans('visiosoft.module.profile::field.birthday.name'),
                'slug' => 'birthday',
                'type' => 'anomaly.field_type.datetime',
                'config' => [
                    "mode" => "date",
                    "picker" => true,
                ]
            ],
            [
                'name' => trans('visiosoft.module.profile::field.education.name'),
                'slug' => 'education',
                'type' => 'anomaly.field_type.text',
            ],
            [
                'name' => trans('visiosoft.module.profile::field.state_of_education.name'),
                'slug' => 'state_of_education',
                'type' => 'anomaly.field_type.text',
            ],
            [
                'name' => trans('visiosoft.module.profile::field.profession.name'),
                'slug' => 'profession',
                'type' => 'anomaly.field_type.text',
            ],
        ];

        foreach ($customFields as $customField) {
            $field = $fieldRepository
                ->newQuery()
                ->where('slug', $customField['slug'])
                ->where('namespace', $namespace)
                ->first();

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
