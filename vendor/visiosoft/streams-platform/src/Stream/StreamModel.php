<?php namespace Anomaly\Streams\Platform\Stream;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Anomaly\Streams\Platform\Addon\FieldType\FieldTypeQuery;
use Anomaly\Streams\Platform\Assignment\AssignmentCollection;
use Anomaly\Streams\Platform\Assignment\AssignmentModel;
use Anomaly\Streams\Platform\Assignment\AssignmentModelTranslation;
use Anomaly\Streams\Platform\Assignment\Contract\AssignmentInterface;
use Anomaly\Streams\Platform\Collection\CacheCollection;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryModel;
use Anomaly\Streams\Platform\Field\Contract\FieldInterface;
use Anomaly\Streams\Platform\Field\FieldModel;
use Anomaly\Streams\Platform\Field\FieldModelTranslation;
use Anomaly\Streams\Platform\Model\EloquentCollection;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Anomaly\Streams\Platform\Stream\Command\CompileStream;
use Anomaly\Streams\Platform\Stream\Command\MergeStreamConfig;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;
use Robbo\Presenter\PresentableInterface;
use Robbo\Presenter\Robbo;

/**
 * Class StreamModel
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class StreamModel extends EloquentModel implements StreamInterface, PresentableInterface
{

    /**
     * Don't cache this model.
     *
     * @var int
     */
    protected $ttl = false;

    /**
     * The foreign key for translations.
     *
     * @var string
     */
    protected $translationForeignKey = 'stream_id';

    /**
     * The translation model.
     *
     * @var string
     */
    protected $translationModel = 'Anomaly\Streams\Platform\Stream\StreamModelTranslation';

    /**
     * Translatable attributes.
     *
     * @var array
     */
    protected $translatedAttributes = [
        'name',
        'description',
    ];

    /**
     * The model's database table name.
     *
     * @var string
     */
    protected $table = 'streams_streams';

    /**
     * Default attributes.
     *
     * @var array
     */
    protected $attributes = [
        'config' => 'a:0:{}',
    ];

    /**
     * The streams store.
     *
     * @var StreamStore
     */
    protected static $store;

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        self::$store = app('Anomaly\Streams\Platform\Stream\StreamStore');

        parent::boot();
    }

    /**
     * Make a Stream instance from the provided compile data.
     *
     * @param  array $data
     * @return StreamInterface
     */
    public function make(array $data)
    {
        $payload = $data;

        if ($stream = self::$store->get($data)) {
            return $stream;
        }

        $assignments = [];

        $streamModel        = new StreamModel();
        $streamTranslations = new EloquentCollection();

        if (!is_string(array_get($data, 'config'))) {
            $data['config'] = serialize(array_get($data, 'config', []));
        }

        if ($translations = array_pull($data, 'translations')) {
            foreach ($translations as $attributes) {
                $translation = new StreamModelTranslation();
                $translation->setRawAttributes($attributes);

                $streamTranslations->push($translation);
            }
        }

        $streamModel->setRawAttributes($data);

        $streamModel->setRelation('translations', $streamTranslations);

        unset($this->translations);

        if (array_key_exists('assignments', $data)) {
            foreach ($data['assignments'] as $assignment) {
                if (isset($assignment['field'])) {
                    $assignment['field']['config'] = unserialize($assignment['field']['config']);

                    $fieldModel        = new FieldModel();
                    $fieldTranslations = new EloquentCollection();

                    if (isset($assignment['field']['translations'])) {
                        foreach (array_pull($assignment['field'], 'translations') as $attributes) {
                            $translation = new FieldModelTranslation();
                            $translation->setRawAttributes($attributes);

                            $fieldTranslations->push($translation);
                        }
                    }

                    $assignment['field']['config'] = serialize($assignment['field']['config']);

                    $fieldModel->setRawAttributes($assignment['field']);

                    $fieldModel->setRelation('translations', $fieldTranslations);

                    unset($assignment['field']);

                    $assignmentModel        = new AssignmentModel();
                    $assignmentTranslations = new EloquentCollection();

                    if (isset($assignment['translations'])) {
                        foreach (array_pull($assignment, 'translations') as $attributes) {
                            $translation = new AssignmentModelTranslation();
                            $translation->setRawAttributes($attributes);

                            $assignmentTranslations->push($translation);
                        }
                    }

                    $assignmentModel->setRawAttributes($assignment);
                    $assignmentModel->setRawAttributes($assignment);

                    $assignmentModel->setRelation('field', $fieldModel);
                    $assignmentModel->setRelation('stream', $streamModel);
                    $assignmentModel->setRelation('translations', $assignmentTranslations);

                    $assignments[] = $assignmentModel;
                }
            }
        }

        $assignmentsCollection = new AssignmentCollection($assignments);

        $streamModel->setRelation('assignments', $assignmentsCollection);

        $streamModel->assignments = $assignmentsCollection;

        self::$store->put($payload, $streamModel);

        return $streamModel;
    }

    /**
     * Compile the entry models.
     *
     * @return mixed
     */
    public function compile()
    {
        $this->dispatchNow(new CompileStream($this));
    }

    /**
     * Flush the entry stream's cache.
     *
     * @return StreamInterface
     */
    public function flushCache()
    {
        (new CacheCollection())->setKey($this->getCacheCollectionKey())->flush();
        (new CacheCollection())->setKey((new FieldModel())->getCacheCollectionKey())->flush();
        (new CacheCollection())->setKey((new AssignmentModel())->getCacheCollectionKey())->flush();

        return $this;
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

            $payload['stream']    = $this;
            $payload['fieldType'] = $fieldType;

            $fieldType->fire($trigger, $payload);
        }
    }

    /**
     * Because the stream record holds translatable data
     * we have a conflict. The streams table has translations
     * but not all streams are translatable. This helps avoid
     * the translatable conflict during specific procedures.
     *
     * @param  array $attributes
     * @return StreamModel|EloquentModel
     */
    public function create(array $attributes = [])
    {
        $model = parent::create($attributes);

        $model->saveTranslations();

        return $model;
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
     * Get the namespace.
     *
     * @return mixed
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * Get the slug.
     *
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Get the prefix.
     *
     * @return mixed
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * Get the name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get the config.
     *
     * @param  null $key
     * @param  null $default
     * @return mixed
     */
    public function getConfig($key = null, $default = null)
    {
        if (!isset($this->cache['cache'])) {
            $this->dispatchNow(new MergeStreamConfig($this));
        }

        $this->cache['cache'] = $this->config;

        if ($key) {
            return array_get($this->config, $key, $default);
        }

        return $this->config;
    }

    /**
     * Merge configuration.
     *
     * @param  array $config
     * @return $this
     */
    public function mergeConfig(array $config)
    {
        $this->config = array_merge((array)$this->config, $config);

        return $this;
    }

    /**
     * Get the locked flag.
     *
     * @return bool
     */
    public function isLocked()
    {
        return $this->locked;
    }

    /**
     * Get the hidden flag.
     *
     * @return bool
     */
    public function isHidden()
    {
        return $this->hidden;
    }

    /**
     * Get the sortable flag.
     *
     * @return bool
     */
    public function isSortable()
    {
        return $this->sortable;
    }

    /**
     * Get the searchable flag.
     *
     * @return bool
     */
    public function isSearchable()
    {
        return $this->searchable;
    }

    /**
     * Get the trashable flag.
     *
     * @return bool
     */
    public function isTrashable()
    {
        return $this->trashable;
    }

    /**
     * Get the versionable flag.
     *
     * @return bool
     */
    public function isVersionable()
    {
        return $this->versionable;
    }

    /**
     * Get the translatable flag.
     *
     * @return bool
     */
    public function isTranslatable()
    {
        return $this->translatable;
    }

    /**
     * Get the title column.
     *
     * @return mixed
     */
    public function getTitleColumn()
    {
        return $this->title_column;
    }

    /**
     * Get the title field.
     *
     * @return null|FieldInterface
     */
    public function getTitleField()
    {
        return $this->getField($this->getTitleColumn());
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
     * Get the related date assignments.
     *
     * @return AssignmentCollection
     */
    public function getDateAssignments()
    {
        $assignments = $this->getAssignments();

        return $assignments->dates();
    }

    /**
     * Get the unique translatable assignments.
     *
     * @return AssignmentCollection
     */
    public function getUniqueAssignments()
    {
        $assignments = $this->getAssignments();

        return $assignments->indexed();
    }

    /**
     * Get the only required assignments.
     *
     * @return AssignmentCollection
     */
    public function getRequiredAssignments()
    {
        $assignments = $this->getAssignments();

        return $assignments->required();
    }

    /**
     * Get the related locked assignments.
     *
     * @return AssignmentCollection
     */
    public function getLockedAssignments()
    {
        $assignments = $this->getAssignments();

        return $assignments->locked();
    }

    /**
     * Get the related unlocked assignments.
     *
     * @return AssignmentCollection
     */
    public function getUnlockedAssignments()
    {
        $assignments = $this->getAssignments();

        return $assignments->unlocked();
    }

    /**
     * Get the related translatable assignments.
     *
     * @return AssignmentCollection
     */
    public function getTranslatableAssignments()
    {
        $assignments = $this->getAssignments();

        return $assignments->translatable();
    }

    /**
     * Get the related relationship assignments.
     *
     * @return AssignmentCollection
     */
    public function getRelationshipAssignments()
    {
        $assignments = $this->getAssignments();

        return $assignments->relations();
    }

    /**
     * Get an assignment by it's field's slug.
     *
     * @param  $fieldSlug
     * @return AssignmentInterface
     */
    public function getAssignment($fieldSlug)
    {
        return $this->getAssignments()->findByFieldSlug($fieldSlug);
    }

    /**
     * Return whether a stream
     * has a field assigned.
     *
     * @param $fieldSlug
     * @return bool
     */
    public function hasAssignment($fieldSlug)
    {
        return (bool)$this->getAssignment($fieldSlug);
    }

    /**
     * Get a stream field by it's slug.
     *
     * @param  $slug
     * @return mixed
     */
    public function getField($slug)
    {
        if (!$assignment = $this->getAssignment($slug)) {
            return null;
        }

        return $assignment->getField();
    }

    /**
     * Get a field's type by the field's slug.
     *
     * @param                 $fieldSlug
     * @param  EntryInterface $entry
     * @param  null|string $locale
     * @return FieldType
     */
    public function getFieldType($fieldSlug, EntryInterface $entry = null, $locale = null)
    {
        if (!$assignment = $this->getAssignment($fieldSlug)) {
            return null;
        }

        return $assignment->getFieldType($entry, $locale);
    }

    /**
     * Get a field's query utility by the field's slug.
     *
     * @param                 $fieldSlug
     * @param  EntryInterface $entry
     * @param  null|string $locale
     * @return FieldTypeQuery
     */
    public function getFieldTypeQuery($fieldSlug, EntryInterface $entry = null, $locale = null)
    {
        if (!$fieldType = $this->getFieldType($fieldSlug, $entry, $locale)) {
            return null;
        }

        return $fieldType->getQuery();
    }

    /**
     * Get the entry table name.
     *
     * @return string
     */
    public function getEntryTableName()
    {
        return $this->getPrefix() . $this->getSlug();
    }

    /**
     * Get the entry translations table name.
     *
     * @return string
     */
    public function getEntryTranslationsTableName()
    {
        return $this->getEntryTableName() . '_translations';
    }

    /**
     * Get the entry model.
     *
     * @return EntryModel
     */
    public function getEntryModel()
    {
        return app($this->getBoundEntryModelName());
    }

    /**
     * Get the entry name.
     *
     * @return EntryModel
     */
    public function getEntryModelName()
    {
        $slug      = ucfirst(camel_case($this->getSlug()));
        $namespace = ucfirst(camel_case($this->getNamespace()));

        return "Anomaly\\Streams\\Platform\\Model\\{$namespace}\\{$namespace}{$slug}EntryModel";
    }

    /**
     * Get the bound entry model name.
     *
     * @return string
     */
    public function getBoundEntryModelName()
    {
        return get_class(app($this->getEntryModelName()));
    }

    /**
     * Get the foreign key.
     *
     * @return string
     */
    public function getForeignKey()
    {
        return str_singular($this->getSlug()) . '_id';
    }

    /**
     * Set the config attribute.
     *
     * @param $config
     */
    public function setConfigAttribute($config)
    {
        $this->attributes['config'] = serialize((array)$config);
    }

    /**
     * Get the config attribute.
     *
     * @param  $viewOptions
     * @return mixed
     */
    public function getConfigAttribute($config)
    {
        return unserialize($config);
    }

    /**
     * Set the locked attribute.
     *
     * @param $locked
     */
    public function setLockedAttribute($locked)
    {
        $this->attributes['locked'] = filter_var($locked, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Set the hidden attribute.
     *
     * @param $hidden
     */
    public function setHiddenAttribute($hidden)
    {
        $this->attributes['hidden'] = filter_var($hidden, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Set the sortable attribute.
     *
     * @param $sortable
     */
    public function setSortableAttribute($sortable)
    {
        $this->attributes['sortable'] = filter_var($sortable, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Set the trashable attribute.
     *
     * @param $trashable
     */
    public function setTrashableAttribute($trashable)
    {
        $this->attributes['trashable'] = filter_var($trashable, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Set the translatable attribute.
     *
     * @param $translatable
     */
    public function setTranslatableAttribute($translatable)
    {
        $this->attributes['translatable'] = filter_var($translatable, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Return a created presenter.
     *
     * @return \Robbo\Presenter\Presenter
     */
    public function getPresenter()
    {
        return new StreamPresenter($this);
    }

    /**
     * Return the assignments relation.
     *
     * @return mixed
     */
    public function assignments()
    {
        return $this->hasMany(
            'Anomaly\Streams\Platform\Assignment\AssignmentModel',
            'stream_id'
        )->orderBy('sort_order');
    }
}
