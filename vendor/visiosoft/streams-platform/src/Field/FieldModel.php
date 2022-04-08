<?php namespace Anomaly\Streams\Platform\Field;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Anomaly\Streams\Platform\Addon\FieldType\FieldTypeBuilder;
use Anomaly\Streams\Platform\Assignment\AssignmentCollection;
use Anomaly\Streams\Platform\Assignment\AssignmentModel;
use Anomaly\Streams\Platform\Assignment\Contract\AssignmentInterface;
use Anomaly\Streams\Platform\Field\Contract\FieldInterface;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class FieldModel
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class FieldModel extends EloquentModel implements FieldInterface
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
     * Eager loaded relations.
     *
     * @var array
     */
    protected $with = [
        'translations',
    ];

    /**
     * Hide these from toArray.
     *
     * @var array
     */
    protected $hidden = [
        'translations',
        'assignments',
        'stream',
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
    protected $translationForeignKey = 'field_id';

    /**
     * Translatable attributes.
     *
     * @var array
     */
    protected $translatedAttributes = [
        'name',
        'warning',
        'placeholder',
        'instructions',
    ];

    /**
     * The translation model.
     *
     * @var string
     */
    protected $translationModel = 'Anomaly\Streams\Platform\Field\FieldModelTranslation';

    /**
     * The database table name.
     *
     * @var string
     */
    protected $table = 'streams_fields';

    /**
     * The field type builder.
     *
     * @var FieldTypeBuilder
     */
    protected static $builder;

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        self::$builder = app(FieldTypeBuilder::class);

        parent::boot();
    }

    /**
     * Get the ID.
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->getKey();
    }

    /**
     * Get the name.
     *
     * @param  null|string $locale
     * @return string
     */
    public function getName()
    {
        return $this->name;
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
     * @return string
     */
    public function getInstructions()
    {
        return $this->instructions;
    }

    /**
     * Get the placeholder.
     *
     * @return string
     */
    public function getPlaceholder()
    {
        return $this->placeholder;
    }

    /**
     * Get the slug.
     *
     * @return mixed
     */
    public function getSlug()
    {
        return $this->getAttributeFromArray('slug');
    }

    /**
     * Get the stream.
     *
     * @return string
     */
    public function getStream()
    {
        return $this->stream;
    }

    /**
     * Get the namespace.
     *
     * @return string
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * Get the field type.
     *
     * @param  bool $fresh
     * @return FieldType|null
     * @throws \Exception
     */
    public function getType($fresh = false)
    {
        if ($fresh === false && isset($this->cache['type'])) {
            return $this->cache['type'];
        }

        $type   = $this->type;
        $field  = $this->slug;
        $label  = $this->name;
        $config = $this->config;

        if (!$type) {
            return $this->cache['type'] = null;
        }

        return $this->cache['type'] = self::$builder->build(compact('type', 'field', 'label', 'config'));
    }

    /**
     * Get the field type value.
     *
     * @return string
     */
    public function getTypeValue()
    {
        return $this->getAttributeFromArray('type');
    }

    /**
     * Get the configuration.
     *
     * @return mixed
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Get the related assignments.
     *
     * @return AssignmentCollection
     */
    public function getAssignments()
    {
        return $this->assignments;
    }

    /**
     * Return whether the field
     * has assignments or not.
     *
     * @return bool
     */
    public function hasAssignments()
    {
        $assignments = $this->getAssignments();

        return !$assignments->isEmpty();
    }

    /**
     * Return whether the field is
     * a relationship or not.
     *
     * @return bool
     */
    public function isRelationship()
    {
        return method_exists($this->getType(), 'getRelation');
    }

    /**
     * Get the locked flag.
     *
     * @return mixed
     */
    public function isLocked()
    {
        return ($this->locked);
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
        return (array)unserialize($config);
    }

    /**
     * Get the rules.
     *
     * @return array
     */
    public function getRules()
    {
        return $this->rules;
    }

    /**
     * Set rules attribute.
     *
     * @param array $rules
     */
    public function setRulesAttribute($rules)
    {
        $this->attributes['rules'] = serialize((array)$rules);
    }

    /**
     * Return the decoded rules attribute.
     *
     * @param  $rules
     * @return mixed
     */
    public function getRulesAttribute($rules)
    {
        return (array)unserialize($rules);
    }

    /**
     * Set the stream namespace.
     *
     * @param StreamInterface $stream
     */
    public function setStreamAttribute(StreamInterface $stream)
    {
        $this->attributes['namespace'] = $stream->getNamespace();
    }

    /**
     * Compile the fields's stream.
     *
     * @return FieldInterface
     */
    public function compileStreams()
    {
        /* @var AssignmentInterface $assignment */
        foreach ($this->getAssignments() as $assignment) {
            $assignment->compileStream();
        }

        return $this;
    }

    /**
     * Return the assignments relation.
     *
     * @return HasMany
     */
    public function assignments()
    {
        return $this
            ->hasMany(AssignmentModel::class, 'field_id')
            ->orderBy('sort_order');
    }
}
