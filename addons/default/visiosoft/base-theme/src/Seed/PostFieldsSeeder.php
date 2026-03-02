<?php namespace Visiosoft\BaseTheme\Seed;

use Anomaly\BlocksModule\Area\Contract\AreaRepositoryInterface;
use Anomaly\BlocksModule\Type\Contract\TypeRepositoryInterface;
use Anomaly\PostsModule\Post\PostModel;
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
        FieldRepositoryInterface      $fieldRepository,
        AssignmentRepositoryInterface $assignmentRepository,
        StreamRepositoryInterface     $streamRepository
    )
    {
        $this->fieldRepository = $fieldRepository;
        $this->assignmentRepository = $assignmentRepository;
        $this->streamRepository = $streamRepository;
    }

    public function run()
    {
        if ($stream = $this->streamRepository->findBySlugAndNamespace('default_posts', 'posts')) {

            // Create content post
            // Create content ads
            // Create cover image field
            $postFields = [
                [
                    'name' => trans('visiosoft.theme.base::field.cover_image'),
                    'namespace' => 'posts',
                    'slug' => 'images',
                    'type' => 'anomaly.field_type.file',
                    'config' => [
                        'folders' => ['images'],
                    ],
                ],
                [
                    'name' => trans('visiosoft.theme.base::field.post_advs'),
                    'namespace' => 'posts',
                    'slug' => 'advs',
                    'type' => 'visiosoft.field_type.multiple',
                    'config' => [
                        'mode' => 'lookup',
                        'related' => AdvModel::class,
                    ],
                ],
                [
                    'name' => trans('visiosoft.theme.base::field.prev_post'),
                    'namespace' => 'posts',
                    'slug' => 'prev_post',
                    'type' => 'anomaly.field_type.relationship',
                    'config' => [
                        'mode' => 'lookup',
                        'related' => PostModel::class,
                    ],
                ],
                [
                    'name' => trans('visiosoft.theme.base::field.next_post'),
                    'namespace' => 'posts',
                    'slug' => 'next_post',
                    'type' => 'anomaly.field_type.relationship',
                    'config' => [
                        'mode' => 'lookup',
                        'related' => PostModel::class,
                    ],
                ],

            ];

            foreach ($postFields as $postField) {
                if (!$field = $this->fieldRepository->findBySlugAndNamespace($postField['slug'], $postField['namespace'])) {
                    $field = $this->fieldRepository->create([
                        'name' => $postField['name'],
                        'namespace' => $postField['namespace'],
                        'slug' => $postField['slug'],
                        'type' => $postField['type'],
                        'config' => $postField['config'],
                        'locked' => 0
                    ]);
                }

                if (!$this->assignmentRepository->findByStreamAndField($stream, $field)) {
                    $this->assignmentRepository->create([
                        'stream_id' => $stream->getId(),
                        'field_id' => $field->id,
                        'label' => $postField['name'],
                    ]);
                }
            }
        }
    }
}
