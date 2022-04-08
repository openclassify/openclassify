<?php namespace Anomaly\Streams\Platform\Assignment;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Anomaly\Streams\Platform\Assignment\Contract\AssignmentInterface;
use Anomaly\Streams\Platform\Field\Contract\FieldInterface;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;
use Robbo\Presenter\PresentableInterface;

/**
 * Class AssignmentModel
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class AssignmentModel extends EloquentModel implements AssignmentInterface, PresentableInterface
{

    /**
     * Don't cache this model.
     *
     * @var bool
     */
    protected $ttl = false;

    /**
     * Do not use timestamps.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Hide these from toArray.
     *
     * @var array
     */
    protected $hidden = [
        'translations',
        'stream',
        'field',
    ];

    /**
     * Default attributes.
     *
     * @var array
     */
    protected $attributes = [
        'config' => 'a:0:{}',
    ];

    /**
     * The foreign key for translations.
     *
     * @var string
     */
    protected $translationForeignKey = 'assignment_id';

    /**
     * Translatable attributes.
     *
     * @var array
     */
    protected $translatedAttributes = [
        'label',
        'warning',
        'placeholder',
        'instructions',
    ];

    /**
     * The translation model.
     *
     * @var string
     */
    protected $translationModel = 'Anomaly\Streams\Platform\Assignment\AssignmentModelTranslation';

    /**
     * The database table name.
     *
     * @var string
     */
    protected $table = 'streams_assignments';

    /**
     * Because the assignment record holds translatable data
     * we have a conflict. The assignment table has translations
     * but not all assignment are translatable. This helps avoid
     * the translatable conflict during specific procedures.
     *
     * @param  array $attributes
     * @return AssignmentModel|EloquentModel
     */
    public function create(array $attributes = [])
    {
        $model = parent::create($attributes);

        $model->saveTranslations();

        return $model;
    }

    /**
     * Set the field attribute.
     *
     * @param FieldInterface $field
     */
    public function setFieldAttribute(FieldInterface $field)
    {
        $this->attributes['field_id'] = $field->getId();
    }

    /**
     * Set the stream attribute.
     *
     * @param StreamInterface $stream
     */
    public function setStreamAttribute(StreamInterface $stream)
    {
        $this->attributes['stream_id'] = $stream->getId();
    }

    /**
     * Get the field slug.
     *
     * @return string
     */
    public function getFieldSlug()
    {
        if (isset($this->cache['field_slug']) && $this->cache['field_slug']) {
            return $this->cache['field_slug'];
        }

        $field = $this->getField();

        return $this->cache['field_slug'] = $field->getSlug();
    }

    /**
     * Get the assignment's field's type.
     *
     * @param  bool $fresh
     * @return FieldType|null
     */
    public function getFieldType($fresh = false)
    {
        $field = $this->getField();

        if (!$field) {
            return null;
        }

        $type = $field->getType($fresh);

        if (!$type) {
            return null;
        }

        $type->setField($field->getSlug());
        $type->mergeConfig($this->getConfig());
        $type->setRequired($this->isRequired());

        return $type;
    }

    /**
     * Get the field type value. This helps
     * avoid spinning up a type instance
     * if you don't really need it.
     *
     * @return string
     */
    public function getFieldTypeValue()
    {
        $field = $this->getField();

        return $field->getTypeValue();
    }

    /**
     * Get the field name.
     *
     * @return string
     */
    public function getFieldName()
    {
        $field = $this->getField();

        return $field->getName();
    }

    /**
     * Get the assignment's field's config.
     *
     * @return string
     */
    public function getFieldConfig()
    {
        $field = $this->getField();

        return $field->getConfig();
    }

    /**
     * Get the assignment's field's rules.
     *
     * @return array
     */
    public function getFieldRules()
    {
        $field = $this->getField();

        return $field->getRules();
    }

    /**
     * Get the config.
     *
     * @return array
     */
    public function getConfig()
    {
        if (isset($this->cache['config']) && $this->cache['config']) {
            return $this->cache['config'];
        }

        if (is_array($this->attributes['config'])) {
            return $this->cache['config'] = $this->attributes['config'];
        }

        return $this->cache['config'] = $this->attributes['config'] = $this->config;
    }

    /**
     * Get the label.
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Get the warning.
     *
     * @return string
     */
    public function getWarning()
    {
        return $this->warning;
    }

    /**
     * Get the instructions.
     *
     * @return null
     */
    public function getInstructions()
    {
        return $this->instructions;
    }

    /**
     * Get the placeholder.
     *
     * @return null
     */
    public function getPlaceholder()
    {
        return $this->placeholder;
    }

    /**
     * Get the related stream.
     *
     * @return StreamInterface
     */
    public function getStream()
    {
        return $this->stream;
    }

    /**
     * Get a fresh stream.
     *
     * @return StreamInterface
     */
    public function getFreshStream()
    {
        return $this
            ->stream()
            ->getResults();
    }

    /**
     * Get the related stream's slug.
     *
     * @return string
     */
    public function getStreamSlug()
    {
        if ($stream = $this->getStream()) {
            return $stream->getSlug();
        }

        return null;
    }

    /**
     * Get the related stream's prefix.
     *
     * @return string
     */
    public function getStreamPrefix()
    {
        if ($stream = $this->getStream()) {
            return $stream->getPrefix();
        }

        return null;
    }

    /**
     * Get the related field.
     *
     * @return FieldInterface
     */
    public function getField()
    {
        if (isset($this->cache['field']) && $this->cache['field']) {
            return $this->cache['field'];
        }

        return $this->cache['field'] = $this->field;
    }

    /**
     * Get the related field ID.
     *
     * @return null|int
     */
    public function getFieldId()
    {
        $field = $this->getField();

        if (!$field) {
            return null;
        }

        return $field->getId();
    }

    /**
     * Get the unique flag.
     *
     * @return mixed
     */
    public function isUnique()
    {
        return $this->getAttributeFromArray('unique');
    }

    /**
     * Get the required flag.
     *
     * @return bool
     */
    public function isRequired()
    {
        return $this->getAttributeFromArray('required');
    }

    /**
     * Get the searchable flag.
     *
     * @return bool
     */
    public function isSearchable()
    {
        return $this->getAttributeFromArray('searchable');
    }

    /**
     * Get the translatable flag.
     *
     * @return bool
     */
    public function isTranslatable()
    {
        $stream = $this->getStream();

        if ($stream && !$stream->isTranslatable()) {
            return false;
        }

        return $this->getAttributeFromArray('translatable');
    }

    /**
     * Get the column name.
     *
     * @return mixed
     */
    public function getColumnName()
    {
        $type = $this->getFieldType();

        return $type->getColumnName();
    }

    /**
     * Set config attribute.
     *
     * @param array $config
     */
    public function setConfigAttribute($config)
    {
        $this->attributes['config'] = serialize((array)$config);
    }

    /**
     * Return the decoded config attribute.
     *
     * @param  $config
     * @return mixed
     */
    public function getConfigAttribute($config)
    {
        if (!is_array($config)) {
            return (array)unserialize($config);
        }

        return $config;
    }

    /**
     * @param  array $items
     * @return AssignmentCollection
     */
    public function newCollection(array $items = [])
    {
        return new AssignmentCollection($items);
    }

    /**
     * Return a created presenter.
     *
     * @return AssignmentPresenter
     */
    public function getPresenter()
    {
        return new AssignmentPresenter($this);
    }

    /**
     * Compile the assignment's stream.
     *
     * @return AssignmentInterface
     */
    public function compileStream()
    {
        if ($stream = $this->getFreshStream()) {
            $stream->compile();
        }

        return $this;
    }

    /**
     * Return the stream relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function stream()
    {
        return $this->belongsTo('Anomaly\Streams\Platform\Stream\StreamModel');
    }

    /**
     * Return the field relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function field()
    {
        return $this->belongsTo('Anomaly\Streams\Platform\Field\FieldModel', 'field_id');
    }
}
