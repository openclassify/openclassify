<?php namespace Anomaly\RepeaterFieldType;

use Anomaly\RepeaterFieldType\Command\GetMultiformFromPost;
use Anomaly\RepeaterFieldType\Command\GetMultiformFromValue;
use Anomaly\RepeaterFieldType\Validation\ValidateRepeater;
use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryModel;
use Anomaly\Streams\Platform\Field\Contract\FieldInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Anomaly\Streams\Platform\Ui\Form\Multiple\MultipleFormBuilder;
use Illuminate\Contracts\Container\Container;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Anomaly\Streams\Platform\Stream\Command\GetStream;

/**
 * Class RepeaterFieldType
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class RepeaterFieldType extends FieldType
{

    /**
     * No database column.
     *
     * @var bool
     */
    protected $columnType = false;

    /**
     * The input class.
     *
     * @var string
     */
    protected $class = 'repeater-container';

    /**
     * The input view.
     *
     * @var string
     */
    protected $inputView = 'anomaly.field_type.repeater::input';

    /**
     * The field rules.
     *
     * @var array
     */
    protected $rules = [
        'array',
        'repeater',
    ];

    /**
     * The field validators.
     *
     * @var array
     */
    protected $validators = [
        'repeater' => [
            'message' => false,
            'handler' => ValidateRepeater::class,
        ],
    ];

    /**
     * The service container.
     *
     * @var Container
     */
    protected $container;

    /**
     * Create a new RepeaterFieldType instance.
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
     * @return BelongsToMany
     */
    public function getRelation()
    {
        $entry = $this->getEntry();
        $model = $this->getRelatedModel();

        return $entry->belongsToMany(
            get_class($model),
            $this->getPivotTableName(),
            'entry_id',
            'related_id'
        )->orderBy($this->getPivotTableName() . '.sort_order', 'ASC');
    }

    /**
     * Get the pivot table.
     *
     * @return string
     */
    public function getPivotTableName()
    {
        return $this->entry->getTableName() . '_' . $this->getField();
    }

    /**
     * Get the related table.
     *
     * @return string
     */
    public function getRelatedTableName()
    {
        return $this->getRelatedModel()->getTableName();
    }

    /**
     * Get the related model.
     *
     * @return null|EntryInterface|EntryModel
     */
    public function getRelatedModel()
    {
        $model = $this->config('related');

        if (strpos($model, '.')) {

            /* @var StreamInterface $stream */
            $stream = $this->dispatch(new GetStream($model));

            return $stream->getEntryModel();
        }

        return $this->container->make($model);
    }

    /**
     * Get the related stream.
     *
     * @return null|StreamInterface
     */
    public function getRelatedStream()
    {
        $model = $this->getRelatedModel();

        return $model->getStream();
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
     * Get the value to index.
     *
     * @return string
     */
    public function getSearchableValue()
    {
        return json_encode(
            array_filter(
                array_map(
                    function ($row) {
                        return $row->toSearchableArray();
                    },
                    $this->entry->{$this->getField()}->all()
                )
            )
        );
    }

    /**
     * Return a form builder instance.
     *
     * @param FieldInterface $field
     * @param null           $instance
     * @return FormBuilder
     */
    public function form(FieldInterface $field, $instance = null)
    {
        /* @var EntryInterface $model */
        $model = $this->getRelatedModel();

        /* @var FormBuilder $builder */
        $builder = $model->newRepeaterFieldTypeFormBuilder()
            ->setModel($model)
            ->setOption('success_message', false)
            ->setOption('repeater_instance', $instance)
            ->setOption('repeater_field', $field->getId())
            ->setOption('repeater_prefix', $this->getFieldName())
            ->setOption('prefix', $this->getFieldName() . '_' . $instance . '_');
        
        $builder
            ->setOption('form_view', $builder->getOption('form_view', 'anomaly.field_type.repeater::form'))
            ->setOption('wrapper_view', $builder->getOption('wrapper_view', 'anomaly.field_type.repeater::wrapper'));

        return $builder;
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
     */
    public function handle(FormBuilder $builder)
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

        /**
         * Skip self handling field types since they
         * will handle themselves later. Otherwise
         * this causes some mad recursion issues.
         *
         * @var FormBuilder $form
         */
        foreach ($forms->getForms() as $form) {

            $skips = $form
                ->getFormFields()
                ->selfHandling()
                ->fieldSlugs();

            $form->setSkips($skips);
        }

        /**
         * Handle the post action
         * for all the child forms.
         */
        $forms->handle();

        // See the accessor for how IDs are handled.
        $entry->{$this->getField()} = $forms->getForms()->map(
            function ($builder) {

                /* @var FormBuilder $builder */
                return $builder->getFormEntryId();
            }
        )->all();
    }

    /**
     * Get the placeholder.
     *
     * @return null
     */
    public function getPlaceholder()
    {
        /* @var StreamInterface $stream */
        $stream = $this->getRelatedStream();

        if ($this->placeholder == null) {
            $this->setPlaceholder(str_singular(trans($stream->getName())));
        }

        return $this->placeholder;
    }
}
