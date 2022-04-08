<?php namespace Anomaly\Streams\Platform\Entry;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Anomaly\Streams\Platform\Addon\FieldType\FieldTypePresenter;
use Anomaly\Streams\Platform\Addon\FieldType\FieldTypeQuery;
use Anomaly\Streams\Platform\Assignment\AssignmentCollection;
use Anomaly\Streams\Platform\Assignment\Contract\AssignmentInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Field\Contract\FieldInterface;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Anomaly\Streams\Platform\Model\Traits\Versionable;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;
use Anomaly\Streams\Platform\Stream\StreamModel;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Laravel\Scout\ModelObserver;
use Laravel\Scout\Searchable;
use Robbo\Presenter\PresentableInterface;

/**
 * Class EntryModel
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class EntryModel extends EloquentModel implements EntryInterface, PresentableInterface
{

    use Searchable;
    use Versionable;

    /**
     * Enable timestamps.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The foreign key for translations.
     *
     * @var string
     */
    protected $translationForeignKey = 'entry_id';

    /**
     * By default nothing is searchable.
     *
     * @var boolean
     */
    protected $searchable = false;

    /**
     * The validation rules. These are
     * overridden on the compiled models.
     *
     * @var array
     */
    protected $rules = [];

    /**
     * The field slugs. These are
     * overridden on compiled models.
     *
     * @var array
     */
    protected $fields = [];

    /**
     * The entry relationships by field slug.
     *
     * @var array
     */
    protected $relationships = [];

    /**
     * The compiled stream data.
     *
     * @var array|StreamInterface
     */
    protected $stream = [];

    /**
     * Hide these from toArray.
     *
     * @var array
     */
    protected $hidden = [
        'translations',
        'stream',
    ];

    /**
     * Date casted attributes.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();

        $instance = new static;

        $class     = get_class($instance);
        $events    = $instance->getObservableEvents();
        $observer  = substr($class, 0, -5) . 'Observer';
        $observing = class_exists($observer);

        if ($events && $observing) {
            self::observe(app($observer));
        }

        if (!$instance->isSearchable()) {
            ModelObserver::disableSyncingFor(get_class(new static));
        }

        if ($events && !$observing) {
            self::observe(EntryObserver::class);
        }
    }

    /**
     * Sort the query.
     *
     * @param Builder $builder
     * @param string $direction
     */
    public function scopeSorted(Builder $builder, $direction = 'asc')
    {
        $builder->orderBy('sort_order', $direction);
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
     * Get the entry ID.
     *
     * @return mixed
     */
    public function getEntryId()
    {
        return $this->getId();
    }

    /**
     * Get the entry title.
     *
     * @return mixed
     */
    public function getEntryTitle()
    {
        return $this->getTitle();
    }

    /**
     * Get the model's bound name.
     *
     * @return string
     */
    public function getBoundModelName()
    {
        return get_class(app(get_class($this)));
    }

    /**
     * Get the model's bound namespace.
     *
     * @return string
     */
    public function getBoundModelNamespace()
    {
        $namespace = explode('\\', $this->getBoundModelName());

        array_pop($namespace);

        return implode('\\', $namespace);
    }

    /**
     * Get the sort order.
     *
     * @return int
     */
    public function getSortOrder()
    {
        return $this->sort_order;
    }

    /**
     * Get the entries title.
     *
     * @return mixed
     */
    public function getTitle()
    {
        return $this->{$this->getTitleName()};
    }

    /**
     * Get a field value.
     *
     * @param        $fieldSlug
     * @param  null $locale
     * @return mixed
     */
    public function getFieldValue($fieldSlug, $locale = null)
    {
        if (!$locale) {
            $locale = config('app.locale');
        }

        $assignment = $this->getAssignment($fieldSlug);

        $type = $assignment->getFieldType();

        $accessor = $type->getAccessor();
        $modifier = $type->getModifier();

        if ($assignment->isTranslatable()) {
            $entry = $this->translateOrDefault($locale);

            $type->setLocale($locale);
        } else {
            $entry = $this;
        }

        $type->setEntry($entry);

        $value = $modifier->restore($accessor->get());

        $type->setValue($value);

        /**
         * Check for fallback values.
         *
         * @var EntryTranslationsModel $translation
         */
        if (
            !$type->hasValue() &&
            $assignment->isTranslatable() &&
            ($translation = $this->translateOrDefault()) &&
            $translation instanceof EntryTranslationsModel
        ) {
            $type->setValue($value);
            $type->setEntry($translation);
            $type->setLocale($translation->getLocale());

            $value = $modifier->restore($accessor->get());
        }

        return $value;
    }

    /**
     * Set a field value.
     *
     * @param        $fieldSlug
     * @param        $value
     * @param  null $locale
     * @return $this
     */
    public function setFieldValue($fieldSlug, $value, $locale = null)
    {
        if (!$locale) {
            $locale = config('app.locale');
        }

        $assignment = $this->getAssignment($fieldSlug);

        $type = $assignment->getFieldType($this);

        if ($assignment->isTranslatable()) {
            $entry = $this->translateOrNew($locale);

            $type->setLocale($locale);
        } else {
            $entry = $this;
        }

        $type->setEntry($entry);

        $accessor = $type->getAccessor();
        $modifier = $type->getModifier();

        $accessor->set($modifier->modify($value));

        return $this;
    }

    /**
     * Get an entry field.
     *
     * @param  $slug
     * @return FieldInterface|null
     */
    public function getField($slug)
    {
        $assignment = $this->getAssignment($slug);

        if (!$assignment instanceof AssignmentInterface) {
            return null;
        }

        return $assignment->getField();
    }

    /**
     * Return whether an entry has
     * a field with a given slug.
     *
     * @param  $slug
     * @return bool
     */
    public function hasField($slug)
    {
        return ($this->getField($slug) !== null);
    }

    /**
     * Get the field type from a field slug.
     *
     * @param  $fieldSlug
     * @return null|FieldType
     */
    public function getFieldType($fieldSlug)
    {
        $locale = config('app.locale');

        $assignment = $this->getAssignment($fieldSlug);

        if (!$assignment) {
            return null;
        }

        $type = $assignment->getFieldType();

        if ($assignment->isTranslatable()) {
            $entry = $this->translateOrDefault($locale);

            $type->setLocale($locale);
        } else {
            $entry = $this;
        }

        $type->setEntry($entry);

        $type->setValue($this->getFieldValue($fieldSlug));
        $type->setEntry($this);

        return $type;
    }

    /**
     * Get the field type query.
     *
     * @param $fieldSlug
     * @return FieldTypeQuery
     */
    public function getFieldTypeQuery($fieldSlug)
    {
        if (!$type = $this->getFieldType($fieldSlug)) {
            return null;
        }

        return $type->getQuery();
    }

    /**
     * Get the field type presenter.
     *
     * @param $fieldSlug
     * @return FieldTypePresenter
     */
    public function getFieldTypePresenter($fieldSlug)
    {
        if (!$type = $this->getFieldType($fieldSlug)) {
            return null;
        }

        return $type->getPresenter();
    }

    /**
     * Set a given attribute on the model.
     * Override the behavior here to give
     * the field types a chance to modify things.
     *
     * @param  string $key
     * @param  mixed $value
     * @return EntryModel|EloquentModel
     */
    public function setAttribute($key, $value)
    {
        if (!$this->isKeyALocale($key) && !$this->hasSetMutator($key) && $this->getFieldType($key)) {
            return $this->setFieldValue($key, $value);
        }

        return parent::setAttribute($key, $value);
    }

    /**
     * Get a given attribute on the model.
     * Override the behavior here to give
     * the field types a chance to modify things.
     *
     * @param  string $key
     * @return mixed
     */
    public function getAttribute($key)
    {

        // Check if it's a relationship first. Ignore translated relationships as these
        // end up being handled by the field type anyway.
        if (
            in_array($key, array_merge($this->relationships, ['created_by', 'updated_by']))
            && !in_array($key, $this->translatedAttributes)
        ) {
            return parent::getAttribute(camel_case($key));
        }

        if (!$this->hasGetMutator($key) && in_array($key, $this->fields)) {
            return $this->getFieldValue($key);
        }

        return parent::getAttribute($key);
    }

    /**
     * Get a raw unmodified attribute.
     *
     * @param             $key
     * @param  bool $process
     * @return mixed|null
     */
    public function getRawAttribute($key, $process = true)
    {
        if (!$process) {
            return $this->getAttributeFromArray($key);
        }

        return parent::getAttribute($key);
    }

    /**
     * Set a raw unmodified attribute.
     *
     * @param $key
     * @param $value
     * @return $this
     */
    public function setRawAttribute($key, $value)
    {
        parent::setAttribute($key, $value);

        return $this;
    }

    /**
     * Get the stream.
     *
     * @return StreamInterface
     */
    public function getStream()
    {
        return $this->stream();
    }

    /**
     * Get the stream ID.
     *
     * @return int
     */
    public function getStreamId()
    {
        $stream = $this->getStream();

        return $stream->getId();
    }

    /**
     * Get the stream namespace.
     *
     * @return string
     */
    public function getStreamNamespace()
    {
        $stream = $this->getStream();

        return $stream->getNamespace();
    }

    /**
     * Get the stream slug.
     *
     * @return string
     */
    public function getStreamSlug()
    {
        $stream = $this->getStream();

        return $stream->getSlug();
    }

    /**
     * Get the entry's stream name.
     *
     * @return string
     */
    public function getStreamName()
    {
        $stream = $this->getStream();

        return $stream->getName();
    }

    /**
     * Get the stream prefix.
     *
     * @return string
     */
    public function getStreamPrefix()
    {
        $stream = $this->getStream();

        return $stream->getPrefix();
    }

    /**
     * Get the table name.
     *
     * @return string
     */
    public function getTableName()
    {
        $stream = $this->getStream();

        return $stream->getEntryTableName();
    }

    /**
     * Get the translations table name.
     *
     * @return string
     */
    public function getTranslationsTableName()
    {
        $stream = $this->getStream();

        return $stream->getEntryTranslationsTableName();
    }

    /**
     * Get all assignments.
     *
     * @return AssignmentCollection
     */
    public function getAssignments()
    {
        $stream = $this->getStream();

        return $stream->getAssignments();
    }

    /**
     * Get the field slugs for assigned fields.
     *
     * @param  null $prefix
     * @return array
     */
    public function getAssignmentFieldSlugs($prefix = null)
    {
        $assignments = $this->getAssignments();

        return $assignments->fieldSlugs($prefix);
    }

    /**
     * Get all assignments of the
     * provided field type namespace.
     *
     * @param $fieldType
     * @return AssignmentCollection
     */
    public function getAssignmentsByFieldType($fieldType)
    {
        $assignments = $this->getAssignments();

        return $assignments->findAllByFieldType($fieldType);
    }

    /**
     * Get an assignment by field slug.
     *
     * @param  $fieldSlug
     * @return AssignmentInterface
     */
    public function getAssignment($fieldSlug)
    {
        $assignments = $this->getAssignments();

        return $assignments->findByFieldSlug($fieldSlug);
    }

    /**
     * Return translated assignments.
     *
     * @return AssignmentCollection
     */
    public function getTranslatableAssignments()
    {
        $stream      = $this->getStream();
        $assignments = $stream->getAssignments();

        return $assignments->translatable();
    }

    /**
     * Return relation assignments.
     *
     * @return AssignmentCollection
     */
    public function getRelationshipAssignments()
    {
        $stream      = $this->getStream();
        $assignments = $stream->getAssignments();

        return $assignments->relations();
    }

    /**
     * Return pivot relation assignments.
     *
     * @return AssignmentCollection
     */
    public function getPivotRelationshipAssignments()
    {
        $stream      = $this->getStream();
        $assignments = $stream->getAssignments();
        $relations   = $assignments->relations();

        return $relations->filter(
            function (AssignmentInterface $assignment) {
                return $assignment->getFieldType()->getColumnType() === false;
            }
        );
    }

    /**
     * Return required assignments.
     *
     * @return AssignmentCollection
     */
    public function getRequiredAssignments()
    {
        $stream      = $this->getStream();
        $assignments = $stream->getAssignments();

        return $assignments->required();
    }

    /**
     * Return searchable assignments.
     *
     * @return AssignmentCollection
     */
    public function getSearchableAssignments()
    {
        $stream      = $this->getStream();
        $assignments = $stream->getAssignments();

        return $assignments->searchable();
    }

    /**
     * Get the translatable flag.
     *
     * @return bool
     */
    public function isTranslatable()
    {
        $stream = $this->getStream();

        return $stream->isTranslatable();
    }

    /**
     * Return whether the entry is trashable or not.
     *
     * @return bool
     */
    public function isTrashable()
    {
        $stream = $this->getStream();

        return $stream->isTrashable();
    }

    /**
     * Return the last modified datetime.
     *
     * @return Carbon
     */
    public function lastModified()
    {
        return $this->updated_at ?: $this->created_at;
    }

    /**
     * Return the related creator.
     *
     * @return Authenticatable
     */
    public function getCreatedBy()
    {
        return $this->created_by;
    }

    /**
     * Return the creator relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function createdBy()
    {
        return $this->belongsTo(config('auth.providers.users.model'));
    }

    /**
     * Return the related updater.
     *
     * @return Authenticatable
     */
    public function getUpdatedBy()
    {
        return $this->updated_by;
    }

    /**
     * Return the updater relation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function updatedBy()
    {
        return $this->belongsTo(config('auth.providers.users.model'));
    }

    /**
     * Return whether the title column is
     * translatable or not.
     *
     * @return bool
     */
    public function titleColumnIsTranslatable()
    {
        return $this->assignmentIsTranslatable($this->getTitleName());
    }

    /**
     * Return whether or not the assignment for
     * the given field slug is translatable.
     *
     * @param $fieldSlug
     * @return bool
     */
    public function assignmentIsTranslatable($fieldSlug)
    {
        return $this->isTranslatedAttribute($fieldSlug);
    }

    /**
     * Return whether or not the assignment for
     * the given field slug is a relationship.
     *
     * @param $fieldSlug
     * @return bool
     */
    public function assignmentIsRelationship($fieldSlug)
    {
        $relationships = $this->getRelationshipAssignments();

        return in_array($fieldSlug, $relationships->fieldSlugs());
    }

    /**
     * Fire field type events.
     *
     * @param       $trigger
     * @param array $payload
     */
    public function fireFieldTypeEvents($trigger, $payload = [])
    {
        $assignments = $this->getAssignments();

        /* @var AssignmentInterface $assignment */
        foreach ($assignments->notTranslatable() as $assignment) {

            $fieldType = $assignment->getFieldType();

            $fieldType->setValue($this->getRawAttribute($assignment->getFieldSlug()));

            $fieldType->setEntry($this);

            $payload['entry']     = $this;
            $payload['fieldType'] = $fieldType;

            $fieldType->fire($trigger, $payload);
        }
    }

    /**
     * Return the related stream.
     *
     * @return StreamInterface|array
     */
    public function stream()
    {
        if (!$this->stream instanceof StreamInterface) {
            $this->stream = app(StreamModel::class)->make($this->stream);
        }

        return $this->stream;
    }

    /**
     * @param  array $items
     * @return EntryCollection
     */
    public function newCollection(array $items = [])
    {
        $collection = substr(get_class($this), 0, -5) . 'Collection';

        if (class_exists($collection)) {
            return new $collection($items);
        }

        return new EntryCollection($items);
    }

    /**
     * Return the entry presenter.
     *
     * This is against standards but required
     * by the presentable interface.
     *
     * @return EntryPresenter
     */
    public function getPresenter()
    {
        $presenter = substr(get_class($this), 0, -5) . 'Presenter';

        if (class_exists($presenter)) {
            return app()->make($presenter, ['object' => $this]);
        }

        return new EntryPresenter($this);
    }

    /**
     * Return a new presenter instance.
     *
     * @return EntryPresenter
     */
    public function newPresenter()
    {
        return $this->getPresenter();
    }

    /**
     * Return a model route.
     *
     * @param       $route The route name you would like to return a URL for (i.e. "view" or "delete")
     * @param array $parameters
     * @return string
     */
    public function route($route, array $parameters = [])
    {
        $router = $this->getRouter();

        return $router->make($route, $parameters);
    }

    /**
     * Return a new router instance.
     *
     * @return EntryRouter
     */
    public function newRouter()
    {
        return app()->make($this->getRouterName(), ['entry' => $this]);
    }

    /**
     * Get the router.
     *
     * @return EntryRouter
     */
    public function getRouter()
    {
        if (isset($this->cache['router'])) {
            return $this->cache['router'];
        }

        return $this->cache['router'] = $this->newRouter();
    }

    /**
     * Get the router name.
     *
     * @return string
     */
    public function getRouterName()
    {
        $router = substr(get_class($this), 0, -5) . 'Router';

        return class_exists($router) ? $router : EntryRouter::class;
    }

    /**
     * Create a new Eloquent query builder for the model.
     *
     * @param  \Illuminate\Database\Query\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function newEloquentBuilder($query)
    {
        $builder = $this->getQueryBuilderName();

        return new $builder($query);
    }

    /**
     * Get the router name.
     *
     * @return string
     */
    public function getQueryBuilderName()
    {
        $builder = substr(get_class($this), 0, -5) . 'QueryBuilder';

        return class_exists($builder) ? $builder : EntryQueryBuilder::class;
    }

    /**
     * Get the criteria class.
     *
     * @return string
     */
    public function getCriteriaName()
    {
        $criteria = substr(get_class($this), 0, -5) . 'Criteria';

        return class_exists($criteria) ? $criteria : EntryCriteria::class;
    }

    /**
     * Return whether the model is searchable or not.
     *
     * @return boolean
     */
    public function isSearchable()
    {
        return $this->searchable;
    }

    /**
     * Return a searchable array.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = [
            'id' => $this->getId(),
        ];

        $searchable = array_merge(
            $this->searchableAttributes,
            $this
                ->getSearchableAssignments()
                ->fieldSlugs()
        );

        if (!$searchable) {
            $searchable = $this
                ->getAssignments()
                ->fieldSlugs();
        }

        foreach ($searchable as $field) {

            if (!in_array($field, $searchable)) {
                continue;
            }

            $array[$field] = (string)$this
                ->getFieldType($field)
                ->getSearchableValue();
        }

        return $array;
    }

    /**
     * Return the object as an
     * array for comparison.
     *
     * @return array
     */
    public function toArrayForComparison()
    {
        $array = array_diff_key(
            $this->toArrayWithRelations(),
            array_flip($this->getNonVersionedAttributes())
        );

        /* @var AssignmentInterface $assignment */
        foreach ($this->getRelationshipAssignments() as $assignment) {

            $related = $this->{$assignment->getFieldSlug()};

            $type = $assignment->getFieldType();

            if (!method_exists($type, 'toArrayForComparison') && !$type->hasHook('to_array_for_comparison')) {
                continue;
            }

            if ($related instanceof Collection) {

                /* @var EloquentModel $entry */
                $array[$assignment->getFieldSlug()] = app()->call(
                    [$type, 'toArrayForComparison'],
                    ['related' => $related]
                );
            }

            if ($related instanceof EntryModel) {
                $array[$assignment->getFieldSlug()] = app()->call(
                    [$type, 'toArrayForComparison'],
                    ['related' => $related]
                );
            }
        }

        return $array;
    }

    /**
     * Override the __get method.
     *
     * @param  string $key
     * @return EntryPresenter|mixed
     */
    public function __get($key)
    {
        if ($key === 'decorated' || $key === 'decorate') {
            return $this->getPresenter();
        }

        return parent::__get($key); // TODO: Change the autogenerated stub
    }

    /**
     * Clean up the object before serializing.
     *
     * @return array
     */
    function __sleep()
    {
        $variables = parent::__sleep();

        $variables = array_diff(
            $variables,
            [
                'stream',
                'cacheCollection',
            ]
        );

        return $variables;
    }
}
