<?php namespace Visiosoft\BaseTheme\Seed;

use Anomaly\BlocksModule\Area\Contract\AreaRepositoryInterface;
use Anomaly\BlocksModule\Type\Contract\TypeRepositoryInterface;
use Anomaly\Streams\Platform\Assignment\Contract\AssignmentRepositoryInterface;
use Anomaly\Streams\Platform\Field\Contract\FieldRepositoryInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamRepositoryInterface;
use Illuminate\Database\Seeder;
use Anomaly\BlocksModule\Block\Contract\BlockRepositoryInterface;

class RegisterInstructionSeeder extends Seeder
{

    private $areaRepository;
    private $blocksTypeRepository;
    private $fieldRepository;
    private $assignmentRepository;
    private $streamRepository;
    private $blockRepository;

    public function __construct(
        AreaRepositoryInterface $areaRepository,
        TypeRepositoryInterface $blocksTypeRepository,
        FieldRepositoryInterface $fieldRepository,
        AssignmentRepositoryInterface $assignmentRepository,
        StreamRepositoryInterface $streamRepository,
        BlockRepositoryInterface $blockRepository
    ) {
        $this->areaRepository = $areaRepository;
        $this->blocksTypeRepository = $blocksTypeRepository;
        $this->fieldRepository = $fieldRepository;
        $this->assignmentRepository = $assignmentRepository;
        $this->streamRepository = $streamRepository;
        $this->blockRepository = $blockRepository;
    }

    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create block area
        if ($registerInstructionsArea = $this->areaRepository->findBySlug('register-instructions')) {
            $registerInstructionsArea->delete();
        }
        $registerInstructionsArea = $this->areaRepository->create([
            'name' => trans('visiosoft.theme.base::field.register_instructions'),
            'slug' => 'register-instructions',
        ]);

        // Create block type
        if ($blockType = $this->blocksTypeRepository->getModel()->withTrashed()->where('slug', 'list')->first()) {
            $blockType->forceDelete();
        }
        $blockType = $this->blocksTypeRepository->create([
            'name' => trans('visiosoft.theme.base::field.list'),
            'slug' => 'list',
            'category' => 'other',
            'content_layout' => '<div class="border {{ block.area.slug == \'store-register-instructions\' ? \'corporate-advantages\' : \'personal-advantages\' }} py-5 px-5">
                                    <div class="d-flex align-items-center mb-4">
                                        {% if setting_value(\'visiosoft.theme.base::register_page_instruction_logo\') %}
                                            <img class="mr-3" src="{{ file(setting_value(\'visiosoft.theme.base::register_page_instruction_logo\')).url }}">
                                        {% endif %}
                                        <h4 class="mb-0">
                                            {{ block.title }}
                                        </h4>
                                    </div>
                                    <div class="mb-4">
                                        {{ block.instruction_description }}
                                    </div>
                                    <ul class="pl-4">
                                        {% for listItem in block.instruction_list.values %}
                                            <li>{{ listItem }}</li>
                                        {% endfor %}
                                    </ul>
                                </div>',
            'wrapper_layout' => '{% extends "anomaly.module.blocks::types.wrapper" %}'
        ]);

        // Create block stream
        if ($listBlock = $this->streamRepository->findBySlugAndNamespace('list_blocks', 'blocks')) {
            $listBlock->delete();
        }
        $listBlock = $this->streamRepository->create([
            'name' => trans('visiosoft.theme.base::field.list'),
            'namespace' => 'blocks',
            'slug' => 'list_blocks',
            'prefix' => 'blocks_',
            'translatable' => 1,
        ]);

        // Create block fields
        $blocksFields = [
            'instruction_description' => [
                'name' => trans('visiosoft.theme.base::field.instruction_description'),
                'namespace' => 'blocks',
                'slug' => 'instruction_description',
                'type' => 'anomaly.field_type.text',
                "config" => [
                    "type" => "text",
                ]
            ],
            'instruction_list' => [
                'name' => trans('visiosoft.theme.base::field.instruction_list'),
                'namespace' => 'blocks',
                'slug' => 'instruction_list',
                'type' => 'visiosoft.field_type.list',
                "config" => [
                    "type" => "text",
                ]
            ]
        ];
        foreach ($blocksFields as $blocksField) {
            if ($field = $this->fieldRepository->findBySlugAndNamespace($blocksField['slug'], $blocksField['namespace'])) {
                $field->delete();
            }
            $field = $this->fieldRepository->create([
                'name' => $blocksField['name'],
                'namespace' => $blocksField['namespace'],
                'slug' => $blocksField['slug'],
                'type' => $blocksField['type'],
                'locked' => 0,
                "config" => $blocksField['config']
            ]);
            $this->assignmentRepository->create([
                'stream_id' => $listBlock->getId(),
                'field_id' => $field->id,
                'label' => $blocksField['name'],
                'translatable' => 1,
            ]);
        }

        // Add default instructions
        $blockFieldId = $this->fieldRepository->findBySlugAndNamespace('blocks', 'blocks')->getId();
        $block = $this->blockRepository->create([
            'title' => trans('visiosoft.theme.base::field.personal_registration_header'),
            'field' => $blockFieldId,
            'extension' => 'anomaly.extension.list_block',
            'display_title' => false,
        ]);
        $blockInfo = app('Anomaly\Streams\Platform\Model\Blocks\BlocksListBlocksEntryModel')->newQuery()->create([
            'instruction_description' => trans('visiosoft.theme.base::field.personal_registration_body'),
            'instruction_list' => [
                trans('visiosoft.theme.base::field.personal_registration_list_1'),
                trans('visiosoft.theme.base::field.personal_registration_list_2'),
                trans('visiosoft.theme.base::field.personal_registration_list_3'),
            ]
        ]);
        $block->update([
            'area_id' => $registerInstructionsArea->getId(),
            'area_type' => get_class($registerInstructionsArea),
            'entry_id' => $blockInfo->id,
            'entry_type' => get_class($blockInfo),
        ]);
    }
}