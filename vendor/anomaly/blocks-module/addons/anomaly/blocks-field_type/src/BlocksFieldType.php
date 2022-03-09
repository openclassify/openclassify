<?php namespace Anomaly\BlocksFieldType;

use Anomaly\BlocksFieldType\Command\GetMultiformFromPost;
use Anomaly\BlocksFieldType\Command\GetMultiformFromValue;
use Anomaly\BlocksFieldType\Validation\ValidateBlocks;
use Anomaly\BlocksModule\Block\BlockCollection;
use Anomaly\BlocksModule\Block\BlockExtension;
use Anomaly\BlocksModule\Block\BlockModel;
use Anomaly\BlocksModule\Block\Contract\BlockRepositoryInterface;
use Anomaly\BlocksModule\Block\Form\BlockFormBuilder;
use Anomaly\BlocksModule\Block\Form\BlockInstanceFormBuilder;
use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Field\Contract\FieldInterface;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Anomaly\Streams\Platform\Ui\Form\Multiple\MultipleFormBuilder;
use Illuminate\Contracts\Container\Container;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * Class BlocksFieldType
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class BlocksFieldType extends FieldType
{

    /**
     * The input class.
     *
     * @var string
     */
    protected $class = 'blocks-container';

    /**
     * No database column.
     *
     * @var bool
     */
    protected $columnType = false;

    /**
     * The input view.
     *
     * @var string
     */
    protected $inputView = 'anomaly.field_type.blocks::input';

    /**
     * The filter view.
     *
     * @var string
     */
    protected $filterView = 'anomaly.field_type.blocks::filter';

    /**
     * The field rules.
     *
     * @var array
     */
    protected $rules = [
        'array',
        'blocks',
    ];

    /**
     * The field validators.
     *
     * @var array
     */
    protected $validators = [
        'blocks' => [
            'message' => false,
            'handler' => ValidateBlocks::class,
        ],
    ];

    /**
     * The service container.
     *
     * @var Container
     */
    protected $container;

    /**
     * Create a new BlocksFieldType instance.
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Return the field ID.
     *
     * @return int
     */
    public function id()
    {
        return $this->entry->getField($this->getField())->getId();
    }

    /**
     * Get the relation.
     *
     * @return MorphMany
     */
    public function getRelation()
    {
        $entry = $this->getEntry();
        $field = $entry->getField($this->getField());

        return $entry
            ->morphMany(BlockModel::class, 'area', 'area_type')
            ->where('field_id', $field->getId());
    }

    /**
     * Get the rules.
     *
     * @return array
     */
    public function getRules()
    {
        $rules = parent::getRules();

        if ($min = array_get($this->getConfig(), 'min')) {
            $rules[] = 'min:' . $min;
        }

        if ($max = array_get($this->getConfig(), 'max')) {
            $rules[] = 'max:' . $max;
        }

        return $rules;
    }

    /**
     * Return the input value.
     *
     * @param null $default
     * @return null|MultipleFormBuilder
     */
    public function getInputValue($default = null)
    {
        return $this->dispatch(new GetMultiformFromPost($this));
    }

    /**
     * Return if any posted input is present.
     *
     * @return boolean
     */
    public function hasPostedInput()
    {
        return true;
    }

    /**
     * Get the validation value.
     *
     * @param null $default
     * @return array
     */
    public function getValidationValue($default = null)
    {
        if (!$forms = $this->getInputValue($default)) {
            return [];
        }

        return $forms->getForms()->map(
            function ($builder) {

                /* @var FormBuilder $builder */
                return $builder->getFormEntryId();
            }
        )->all();
    }

    /**
     * Return a form builder instance.
     *
     * @param FieldInterface $field
     * @param BlockExtension $extension
     * @param null $instance
     * @return MultipleFormBuilder
     */
    public function form(FieldInterface $field, BlockExtension $extension, $instance = null)
    {

        /* @var BlockInstanceFormBuilder $form */
        /* @var BlockFormBuilder $block */
        $form  = app(BlockInstanceFormBuilder::class);
        $block = app(BlockFormBuilder::class);

        $form->setOption(
            'prefix',
            $this->getFieldName() . '_' . $instance . '_'
        );

        $block
            ->setExtension($extension)
            ->setOption('locking_enabled', false)
            ->setOption('success_message', false);

        $form->on(
            'saving_block',
            function () use ($form, $block) {
                if ($entry = $form->getChildFormEntry('entry')) {
                    $block->setFormEntryAttribute(
                        'entry',
                        $entry
                    );
                }
            }
        );

        $form->addForm('block', $block);

        $extension->extend($form);

        $form
            ->setOption('locking_enabled', false)
            ->setOption('success_message', false)
            ->setOption('block_instance', $instance)
            ->setOption('block_field', $field->getId())
            ->setOption('block_prefix', $this->getFieldName())
            ->setOption('block_title', $extension->getTitle())
            ->setOption('block_extension', $extension->getNamespace())
            ->setOption('form_view', 'anomaly.field_type.blocks::form')
            ->setOption('wrapper_view', 'anomaly.field_type.blocks::wrapper');

        $extension->fire('extending', ['builder' => $form, 'field' => $field]);

        return $form;
    }

    /**
     * Return an array of entry forms.
     *
     * @return array
     */
    public function forms()
    {
        if (!$forms = $this->dispatch(new GetMultiformFromValue($this))) {
            return [];
        }

        return array_map(
            function (FormBuilder $form) {
                return $form
                    ->make()
                    ->getForm();
            },
            $forms->getForms()->all()
        );
    }

    /**
     * Handle saving the form data ourselves.
     *
     * @param FormBuilder $builder
     * @param BlockRepositoryInterface $blocks
     */
    public function handle(FormBuilder $builder, BlockRepositoryInterface $blocks)
    {
        $entry = $builder->getFormEntry();

        /**
         * If we don't have any forms then
         * there isn't much we can do.
         */
        if (!$forms = $this->getInputValue()) {

            $entry->{$this->getField()} = null;

            return;
        }

        /* @var EntryInterface $entry */
        $entry = $this->getEntry();

        /* @var FieldInterface $field */
        $field = $entry->getField($this->getField());

        /* @var BlockInstanceFormBuilder $form */
        foreach ($forms->getForms()->values() as $key => $form) {

            /* @var BlockFormBuilder $block */
            $block = $form->getChildForm('block');

            $block->setArea($entry);
            $block->setField($field);

            $block->on(
                'saving',
                function () use ($block, $key) {
                    $block->setFormEntryAttribute('sort_order', $key + 1);
                }
            );
        }

        /*
         * Handle the post action
         * for all the child forms.
         */
        $forms->handle();

        $blocks->sync(
            $entry,
            $field,
            $forms->getForms()->map(
                function (BlockInstanceFormBuilder $form) {
                    return $form->getChildFormEntryId('block');
                }
            )->values()->all()
        );
    }

    /**
     * Fired just before version comparison.
     *
     * @param EntryInterface|EloquentModel $entry
     */
    public function onVersioning(EntryInterface $entry)
    {
        $entry
            ->unsetRelation(camel_case($this->getField()))
            ->load(camel_case($this->getField()));
    }

    /**
     * Fired just before version comparison.
     *
     * @param BlockCollection $related
     * @return array
     */
    public function toArrayForComparison(BlockCollection $related)
    {
        return $related->map(
            function (BlockModel $model) {

                $array = array_diff_key(
                    $model->toArrayWithRelations(),
                    array_flip(
                        [
                            'id',
                            'sort_order',
                            'created_at',
                            'created_by_id',
                            'updated_at',
                            'updated_by_id',
                            'deleted_at',
                            'deleted_by_id',

                            'field',
                            'pivot',
                            'area',
                        ]
                    ));

                array_pull($array, 'entry.sort_order');
                array_pull($array, 'entry.created_at');
                array_pull($array, 'entry.created_by_id');
                array_pull($array, 'entry.updated_at');
                array_pull($array, 'entry.updated_by_id');

                return $array;
            }
        )->toArray();
    }
}
