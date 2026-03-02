<?php namespace Visiosoft\MultipleFieldType;

use Visiosoft\MultipleFieldType\Command\BuildOptions;
use Visiosoft\MultipleFieldType\Table\ValueTableBuilder;
use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Anomaly\Streams\Platform\Entry\EntryCollection;
use Anomaly\Streams\Platform\Model\EloquentCollection;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Anomaly\Streams\Platform\Stream\Command\GetStream;
use Anomaly\Streams\Platform\Support\Collection;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Illuminate\Container\Container;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Crypt;

class MultipleFieldType extends FieldType
{

    use DispatchesJobs;

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
    protected $inputView = null;

    /**
     * The filter view.
     *
     * @var string
     */
    protected $filterView = 'visiosoft.field_type.multiple::filter';

    /**
     * The pre-defined handlers.
     *
     * @var array
     */
    protected $handlers = [
        'related' => 'Visiosoft\MultipleFieldType\Handler\Related@handle',
        //'fields'      => 'Visiosoft\MultipleFieldType\Handler\Fields@handle',
        //'assignments' => 'Visiosoft\MultipleFieldType\Handler\Assignments@handle'
    ];

    /**
     * The field type rules.
     *
     * @var array
     */
    protected $rules = [
        'array',
    ];

    /**
     * The field type config.
     *
     * @var array
     */
    protected $config = [
        'mode' => 'tags',
    ];

    /**
     * The select input options.
     *
     * @var null|array
     */
    protected $options = null;

    /**
     * The cache repository.
     *
     * @var Repository
     */
    protected $cache;

    /**
     * The service container.
     *
     * @var Container
     */
    protected $container;

    /**
     * Create a new MultipleFieldType instance.
     *
     * @param Repository $cache
     * @param Container $container
     */
    public function __construct(Repository $cache, Container $container)
    {
        $this->cache     = $cache;
        $this->container = $container;
    }

    /**
     * Return the ids.
     *
     * @return array|mixed|static
     */
    public function ids()
    {
        $value = $this->getValue();

        if (is_object($value)) {
            $value = $value->pluck('id')->all();
        }

        return array_filter((array)$value);
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
     * Return the config key.
     *
     * @return string
     */
    public function key()
    {
        return Crypt::encrypt(array_merge(
                $this->getConfig(),
                [
                    'field' => $this->getField(),
                    'entry' => get_class($this->getEntry()),
                ]
            ));
    }

    /**
     * Value table.
     *
     * @return string
     */
    public function table()
    {
        $value   = $this->getValue();
        $related = $this->getRelatedModel();

        if ($table = $this->config('value_table')) {
            $table = $this->container->make($table);
        } else {
            $table = $related->newVMultipleFieldTypeValueTableBuilder();
        }

        /* @var ValueTableBuilder $table */
        $table->setConfig(new Collection($this->getConfig()))
            ->setFieldType($this)
            ->setModel($related);

        if (!$value instanceof EntryCollection) {
            $table->setSelected((array)$value);
        }

        if ($value instanceof EntryCollection) {
            $table->setSelected($value->ids());
        }

        return $table
            ->build()
            ->load()
            ->getTableContent();
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
     * Get the options.
     *
     * @return array
     */
    public function getOptions()
    {
        if ($this->options === null) {
            $this->dispatch(new BuildOptions($this));
        }

        return $this->options;
    }

    /**
     * Set the options.
     *
     * @param  array $options
     * @return $this
     */
    public function setOptions(array $options)
    {
        $this->options = $options;

        return $this;
    }

    /**
     * Get the pre-defined handlers.
     *
     * @return array
     */
    public function getHandlers()
    {
        return $this->handlers;
    }

    /**
     * Return the input view.
     *
     * @return string
     */
    public function getInputView()
    {
        return $this->inputView ?: 'visiosoft.field_type.multiple::' . $this->config('mode');
    }

    /**
     * Get the related model.
     *
     * @return EloquentModel
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
     * Get the pivot table.
     *
     * @return string
     */
    public function getPivotTableName()
    {
        return $this->entry->getTableName() . '_' . $this->getField();
    }

    /**
     * Get the post value.
     *
     * @param  null $default
     * @return array
     */
    public function getPostValue($default = null)
    {
        if (is_array($value = parent::getPostValue($default))) {
            return array_filter($value);
        }

        return array_filter(explode(',', $value));
    }

    /**
     * Get the class.
     *
     * @return null|string
     */
    public function getClass()
    {
        if ($class = parent::getClass()) {
            return $class;
        }

        return $this->config('mode') == 'dropdown' ? 'custom-select form-control' : null;
    }

    /**
     * Handle saving the form data ourselves.
     *
     * @param FormBuilder $builder
     */
    public function handle(FormBuilder $builder)
    {
        $entry = $builder->getFormEntry();

        // See the accessor for how IDs are handled.
        $entry->{$this->getField()} = $this->getPostValue();
    }

    /**
     * Fired just before version comparison.
     *
     * @param EloquentCollection $related
     */
    public function toArrayForComparison(EloquentCollection $related)
    {
        return $related->map(
            function (EloquentModel $model) {
                return array_diff_key(
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
                        ]
                    )
                );
            }
        )->toArray();
    }
}
