<?php namespace Anomaly\RelationshipFieldType;

use Anomaly\RelationshipFieldType\Command\BuildOptions;
use Anomaly\RelationshipFieldType\Table\ValueTableBuilder;
use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Anomaly\Streams\Platform\Support\Collection;
use Anomaly\Streams\Platform\Stream\Command\GetStream;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;
use Illuminate\Contracts\Cache\Repository;
use Illuminate\Contracts\Container\Container;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Crypt;

/**
 * Class RelationshipFieldType
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\RelationshipFieldType
 */
class RelationshipFieldType extends FieldType
{

    use DispatchesJobs;

    /**
     * The underlying database column type
     *
     * @var string
     */
    protected $columnType = 'integer';

    /**
     * The input view.
     *
     * @var null|string
     */
    protected $inputView = null;
    
    /**
     * The input class.
     *
     * @var null
     */
    protected $class = null;

    /**
     * The filter view.
     *
     * @var string
     */
    protected $filterView = 'anomaly.field_type.relationship::filter';

    /**
     * The pre-defined handlers.
     *
     * @var array
     */
    protected $handlers = [
        'users'       => 'Anomaly\RelationshipFieldType\Handler\Users@handle',
        'fields'      => 'Anomaly\RelationshipFieldType\Handler\Fields@handle',
        'related'     => 'Anomaly\RelationshipFieldType\Handler\Related@handle',
        'assignments' => 'Anomaly\RelationshipFieldType\Handler\Assignments@handle'
    ];

    /**
     * The field type config.
     *
     * @var array
     */
    protected $config = [
        'mode' => 'dropdown'
    ];

    /**
     * The dropdown options.
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
     * Create a new RelationshipFieldType instance.
     *
     * @param Repository $cache
     * @param Container  $container
     */
    public function __construct(Repository $cache, Container $container)
    {
        $this->cache     = $cache;
        $this->container = $container;
    }

    /**
     * Get the ID of the value.
     *
     * @return int|null
     */
    public function id()
    {
        $value = $value = $this->getValue();

        if ($value instanceof EloquentModel) {
            return $value->getId();
        }

        return $value;
    }

    /**
     * Return the config key.
     *
     * @return string
     */
    public function key()
    {
       return Crypt::encrypt($this->getConfig());
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

        if ($value instanceof EntryInterface) {
            $value = $value->getId();
        }

        if ($table = $this->config('value_table')) {
            $table = $this->container->make($table);
        } else {
            $table = $related->newRelationshipFieldTypeValueTableBuilder();
        }

        /* @var ValueTableBuilder $table */
        $table->setConfig(new Collection($this->getConfig()))
            ->setModel($related)
            ->setFieldType($this)
            ->setSelected($value);

        if ($this->isDisabled() || $this->isReadonly()) {
            $table->setButtons([]);
        }

        $table
            ->build()
            ->load();

        return $table->getTableContent();
    }

    /**
     * Get the relation.
     *
     * @return BelongsTo
     */
    public function getRelation()
    {
        $entry = $this->getEntry();
        $model = $this->getRelatedModel();

        return $entry->belongsTo(get_class($model), $this->getColumnName());
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
     * Get the dropdown options.
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
     * @param array $options
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
     * Get the placeholder.
     *
     * @return null|string
     */
    public function getPlaceholder()
    {
        if (!$this->placeholder) {
            return 'anomaly.field_type.relationship::input.placeholder';
        }

        return $this->placeholder;
    }

    /**
     * Return the input view.
     *
     * @return string
     */
    public function getInputView()
    {
        if ($view = parent::getInputView()) {
            return $view;
        }

        return 'anomaly.field_type.relationship::' . $this->config('mode');
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

        if ($this->config('mode') == 'dropdown') {
            return 'custom-select form-control';
        }

        return 'form-control';
    }

    /**
     * Get the database column name.
     *
     * @return null|string
     */
    public function getColumnName()
    {
        return parent::getColumnName() . '_id';
    }

    /**
     * Get the column type.
     *
     * @return string
     */
    public function getColumnType()
    {
        return array_get($this->getConfig(), 'column_type', parent::getColumnType());
    }
}
