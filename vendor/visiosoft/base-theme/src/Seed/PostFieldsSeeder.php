<?php namespace Visiosoft\BaseTheme\Seed;

use Anomaly\BlocksModule\Area\Contract\AreaRepositoryInterface;
use Anomaly\BlocksModule\Type\Contract\TypeRepositoryInterface;
use Anomaly\Streams\Platform\Assignment\Contract\AssignmentRepositoryInterface;
use Anomaly\Streams\Platform\Field\Contract\FieldRepositoryInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamRepositoryInterface;
use Illuminate\Database\Seeder;
use Anomaly\BlocksModule\Block\Contract\BlockRepositoryInterface;
use Visiosoft\AdvsModule\Adv\AdvModel;

class PostFieldsSeeder extends Seeder
{

    private $fieldRepository;
    private $assignmentRepository;
    private $streamRepository;

    public function __construct(
        FieldRepositoryInterface $fieldRepository,
        AssignmentRepositoryInterface $assignmentRepository,
        StreamRepositoryInterface $streamRepository
    ) {
        $this->fieldRepository = $fieldRepository;
        $this->assignmentRepository = $assignmentRepository;
        $this->streamRepository = $streamRepository;
    }

    public function run()
    {
        if ($stream = $this->streamRepository->findBySlugAndNamespace('default_posts', 'posts')) {
            // Create cover image field
            $coverImageField = [
                'name' => trans('visiosoft.theme.base::field.cover_image'),
                'namespace' => 'posts',
                'slug' => 'cover_image',
                'type' => 'anomaly.field_type.file',
                'config' => [
                    'folders' => ['images'],
                ],
            ];

            if (!$field = $this->fieldRepository->findBySlugAndNamespace($coverImageField['slug'], $coverImageField['namespace'])) {
                $field = $this->fieldRepository->create([
                    'name' => $coverImageField['name'],
                    'namespace' => $coverImageField['namespace'],
                    'slug' => $coverImageField['slug'],
                    'type' => $coverImageField['type'],
                    'config' => $coverImageField['config'],
                    'locked' => 0
                ]);
            }

            if (!$this->assignmentRepository->findByStreamAndField($stream, $field)) {
                $this->assignmentRepository->create([
                    'stream_id' => $stream->getId(),
                    'field_id' => $field->id,
                    'label' => $coverImageField['name'],
                ]);
            }
        }
    }
}
