<?php namespace Visiosoft\SahibindenTheme\seed;

use Anomaly\Streams\Platform\Application\Application;
use Anomaly\Streams\Platform\Assignment\Contract\AssignmentRepositoryInterface;
use Anomaly\Streams\Platform\Field\Contract\FieldRepositoryInterface;
use Anomaly\Streams\Platform\Model\Repeater\RepeaterHomepageSliderEntryModel;
use Anomaly\Streams\Platform\Stream\Contract\StreamRepositoryInterface;
use Illuminate\Database\Seeder;

class SahibindenRepeaterSeeder extends Seeder{

    private $fieldRepository;
    private $streamRepository;
    private $assignmentRepository;
    public function __construct(
        FieldRepositoryInterface $fieldRepository,
        StreamRepositoryInterface $streamRepository,
        AssignmentRepositoryInterface $assignmentRepository
    )
    {
        $this->streamRepository = $streamRepository;
        $this->fieldRepository = $fieldRepository;
        $this->assignmentRepository = $assignmentRepository;
    }

    public function run()
    {
        $repeaters = [
            [
                'name' => 'Home Page Ads Slider',
                'slug' => 'homepage_slider',
                'translatable' => true,
                'fields' => ['slider_image' ]
            ]
        ];

        $repeatersObjects = array();
        foreach ($repeaters as $repeater) {
            $exists = $this->streamRepository->findBySlugAndNamespace($repeater['slug'], 'repeater');
            $repeatersObjects[$repeater['slug']] = $exists ?: $this->streamRepository->create([
                'name' => $repeater['name'],
                'namespace' => 'repeater',
                'slug' => $repeater['slug'],
                'prefix' => 'repeater_',
                'translatable' => $repeater['translatable'],
            ]);
        }

        $repeatersFields = [
            [
                'name' => 'Slider Image',
                'namespace' => 'repeater',
                'slug' => 'slider_image',
                'type' => 'anomaly.field_type.file',
                'instructions' => 'Recommended 980x380',
                "config" => [
                    "folders" => ['images'],
                    "mode" => 'upload',
                ],
                "assignmentConfig" => [
                    "required" => true,
                    "translatable" => true,
                ],
            ]
        ];

        foreach ($repeatersFields as $repeatersField) {
            $field = $this->fieldRepository->findBySlugAndNamespace($repeatersField['slug'], 'repeater');
            if (!$field) {
                $fieldValue = [
                    'name' => $repeatersField['name'],
                    'namespace' => 'repeater',
                    'slug' => $repeatersField['slug'],
                    'type' => $repeatersField['type'],
                    'locked' => 0,
                ];
                if (isset($repeatersField['config'])) {
                    $fieldValue['config'] = $repeatersField['config'];
                }
                if (isset($repeatersField['instructions'])) {
                    $fieldValue['instructions'] = $repeatersField['instructions'];
                }
                $field = $this->fieldRepository->create($fieldValue);
            }
            foreach ($repeaters as $repeater) {
                if (in_array($field->slug, $repeater['fields'])) {
                    $assign = $this->assignmentRepository->findByStreamAndField(
                        $repeatersObjects[$repeater['slug']],
                        $field
                    );
                    if (!$assign) {
                        $this->assignmentRepository->create(array_merge([
                            'stream_id' => $repeatersObjects[$repeater['slug']]->getId(),
                            'field_id' => $field->id,
                            'label' => $field->name,
                        ], $repeatersField['assignmentConfig']));
                    }
                }
            }
        }

        $app = app(Application::class)->getReference()."_";

        $defaultPagesStream = $this->streamRepository->findBySlugAndNamespace($app.'pages', 'pages');

        $pagesFields = [
            [
                'name' => 'Homepage Banner Slider',
                'slug' => 'homepage_banner_slider',
                "config" => [
                    "related" => RepeaterHomepageSliderEntryModel::class,
                ]
            ]
        ];

        foreach ($pagesFields as $pagesField) {
            $field = $this->fieldRepository->findBySlugAndNamespace($pagesField['slug'], 'pages');
            if (!$field) {
                $field = $this->fieldRepository->create([
                    'name' => $pagesField['name'],
                    'namespace' => 'pages',
                    'slug' => $pagesField['slug'],
                    'type' => 'anomaly.field_type.repeater',
                    'locked' => 0,
                    "config" => $pagesField['config']
                ]);
            }
            $assign = $this->assignmentRepository->findByStreamAndField($defaultPagesStream, $field);
            if (!$assign) {
                $this->assignmentRepository->create([
                    'stream_id' => $defaultPagesStream->getId(),
                    'field_id' => $field->id,
                    'label' => $pagesField['name'],
                ]);
            }
        }

    }


}