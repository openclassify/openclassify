<?php namespace Visiosoft\ProfileModule\Education;

use Anomaly\Streams\Platform\Database\Seeder\Seeder;
use Visiosoft\ProfileModule\Education\Contract\EducationRepositoryInterface;

class EducationSeeder extends Seeder
{
    public function run()
    {
        $repository = app(EducationRepositoryInterface::class);

        $educations = [
            [
                'en' => [
                    'name' => 'Primary School',
                ],
                'tr' => [
                    'name' => 'İlk Okul',
                ],
            ],
            [
                'en' => [
                    'name' => 'Middle School',
                ],
                'tr' => [
                    'name' => 'Orta Okul',
                ],
            ],
            [
                'en' => [
                    'name' => 'High School',
                ],
                'tr' => [
                    'name' => 'Lise',
                ],
            ],
            [
                'en' => [
                    'name' => 'University',
                ],
                'tr' => [
                    'name' => 'Üniversite',
                ],
            ],
        ];

        foreach ($educations as $education) {
            $repository->create($education);
        }
    }
}
