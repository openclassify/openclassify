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
                'name' => 'visiosoft.module.profile::field.file.name',
                'slug' => 'file',
                'type' => 'visiosoft.field_type.singlefile',
                'config' => [
                    'folders' => ["images"],
                    'mode' => 'upload',
                ]
            ],
            [
                'slug'      => 'utm_source',
                'namespace' => 'users',
                'type'      => 'anomaly.field_type.text',
                'name'      => 'visiosoft.module.profile::field.utm_source.name',
                'locked'    => false,
            ],
            [
                'name' => 'visiosoft.module.profile::field.country.name',
                'slug' => 'country',
                'type' => 'anomaly.field_type.relationship',
                'config' => [
                    'related' => CountryModel::class,
                    "default_value" => 0,
                ],
            ],
            [
                'name' => 'visiosoft.module.profile::field.city.name',
                'slug' => 'city',
                'type' => 'anomaly.field_type.select',
            ],
            [
                'name' => 'visiosoft.module.profile::field.district.name',
                'slug' => 'district',
                'type' => 'anomaly.field_type.select',
            ],
            [
                'name' => 'visiosoft.module.profile::field.neighborhood.name',
                'slug' => 'neighborhood',
                'type' => 'anomaly.field_type.select',
            ],
            [
                'name' => 'visiosoft.module.profile::field.village.name',
                'slug' => 'village',
                'type' => 'anomaly.field_type.select',
            ],
            [
                'name' => 'visiosoft.module.profile::field.gsm_phone.name',
                'slug' => 'gsm_phone',
                'type' => 'anomaly.field_type.text',
            ],
            [
                'name' => 'visiosoft.module.profile::field.land_phone.name',
                'slug' => 'land_phone',
                'type' => 'anomaly.field_type.text',
            ],
            [
                'name' => 'visiosoft.module.profile::field.office_phone.name',
                'slug' => 'office_phone',
                'type' => 'anomaly.field_type.text',
            ],
            [
                'name' => 'visiosoft.module.profile::field.register_type.name',
                'slug' => 'register_type',
                'type' => 'anomaly.field_type.select',
                "config" => [
                    'options' => '1: ' . 'visiosoft.module.profile::field.individual.name' . "\n2: " . 'visiosoft.module.profile::field.corporate.name'
                ]
            ],
            [
                'name' => 'visiosoft.module.profile::field.identification_number.name',
                'slug' => 'identification_number',
                'type' => 'anomaly.field_type.text',
            ],
            [
                'name' => 'visiosoft.module.profile::field.notified_new_updates.name',
                'slug' => 'notified_new_updates',
                'type' => 'anomaly.field_type.select',
                'config' => [
                    'default_value' => 1,
                    'options' => "0: Active\n1: Passive",
                    'separator' => ':',
                ]
            ],
            [
                'name' => 'visiosoft.module.profile::field.notified_about_ads.name',
                'slug' => 'notified_about_ads',
                'type' => 'anomaly.field_type.select',
                'config' => [
                    'default_value' => 1,
                    'options' => "0: Active\n1: Passive",
                    'separator' => ':',
                ]
            ],
            [
                'name' => 'visiosoft.module.profile::field.receive_messages_email.name',
                'slug' => 'receive_messages_email',
                'type' => 'anomaly.field_type.select',
                'config' => [
                    'default_value' => 1,
                    'options' => "0: Active\n1: Passive",
                    'separator' => ':',
                ]
            ],
            [
                'name' => 'visiosoft.module.profile::field.birthday.name',
                'slug' => 'birthday',
                'type' => 'anomaly.field_type.datetime',
                'config' => [
                    "mode" => "date",
                    "picker" => true,
                ]
            ],
	        [
		        'name' => 'visiosoft.module.profile::field.education.name',
		        'slug' => 'education',
		        'type' => 'anomaly.field_type.text',
	        ],
	        [
		        'name' => 'visiosoft.module.profile::field.state_of_education.name',
		        'slug' => 'state_of_education',
		        'type' => 'anomaly.field_type.text',
	        ],
	        [
		        'name' => 'visiosoft.module.profile::field.profession.name',
		        'slug' => 'profession',
		        'type' => 'anomaly.field_type.select',
	        ],
	        [
		        'name' => 'visiosoft.module.profile::field.education_part.name',
		        'slug' => 'education_part',
		        'type' => 'anomaly.field_type.select',
	        ],
	        [
	        	'name' => 'visiosoft.module.profile::field.facebook_address.name',
		        'slug' => 'facebook_address',
		        'type' => 'anomaly.field_type.text',
	        ],
	        [
	        	'name' => 'visiosoft.module.profile::field.google_address.name',
		        'slug' => 'google_address',
		        'type' => 'anomaly.field_type.text',
	        ],
            [
                'name' => 'visiosoft.module.profile::field.utm_source.name',
                'slug' => 'utm_source',
                'type' => 'anomaly.field_type.text',
            ],
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
