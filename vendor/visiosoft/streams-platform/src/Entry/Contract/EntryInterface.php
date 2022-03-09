<?php namespace Anomaly\Streams\Platform\Entry\Contract;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Anomaly\Streams\Platform\Addon\FieldType\FieldTypePresenter;
use Anomaly\Streams\Platform\Addon\FieldType\FieldTypeQuery;
use Anomaly\Streams\Platform\Assignment\AssignmentCollection;
use Anomaly\Streams\Platform\Assignment\Contract\AssignmentInterface;
use Anomaly\Streams\Platform\Entry\EntryPresenter;
use Anomaly\Streams\Platform\Entry\EntryRouter;
use Anomaly\Streams\Platform\Field\Contract\FieldInterface;
use Anomaly\Streams\Platform\Model\EloquentCollection;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Anomaly\Streams\Platform\Model\Traits\Translatable;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Interface EntryInterface
 *
 * @property Carbon $created_at
 * @property int $created_by_id
 * @property Carbon $updated_at
 * @property int $updated_by_id
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
interface EntryInterface
{

    /**
     * Get the ID.
     *
     * @return mixed
     */
    public function getId();

    /**
     * Get the entry ID.
     *
     * @return mixed
     */
    public function getEntryId();

    /**
     * Get the entry title.
     *
     * @return mixed
     */
    public function getEntryTitle();

    /**
     * Get the model's bound name.
     *
     * @return string
     */
    public function getBoundModelName();

    /**
     * Get the model's bound namespace.
     *
     * @return string
     */
    public function getBoundModelNamespace();

    /**
     * Get the sort order.
     *
     * @return int
     */
    public function getSortOrder();

    /**
     * Get the title.
     *
     * @return mixed
     */
    public function getTitle();

    /**
     * Get the title key.
     *
     * @return string
     */
    public function getTitleName();

    /**
     * Get the stream.
     *
     * @return StreamInterface
     */
    public function getStream();

    /**
     * Get the stream ID.
     *
     * @return int
     */
    public function getStreamId();

    /**
     * Get the stream namespace.
     *
     * @return string
     */
    public function getStreamNamespace();

    /**
     * Get the entry's stream slug.
     *
     * @return string
     */
    public function getStreamSlug();

    /**
     * Get the entry's stream name.
     *
     * @return string
     */
    public function getStreamName();

    /**
     * Get the entry's stream prefix.
     *
     * @return string
     */
    public function getStreamPrefix();

    /**
     * Get the table name.
     *
     * @return string
     */
    public function getTableName();

    /*
     * Alias for getTranslation()
     *
     * @return EloquentModel|Translatable|null
     */
    public function translate($locale = null, $withFallback = false);

    /*
     * Alias for getTranslation()
     *
     */
    /**
     * @param null $locale
     * @return EloquentModel|Translatable
     */
    public function translateOrDefault($locale = null);

    /**
     * Get related translations.
     *
     * @return EloquentCollection
     */
    public function getTranslations();

    /**
     * Get the translations table name.
     *
     * @return string
     */
    public function getTranslationsTableName();

    /**
     * Get the translated attributes.
     *
     * @return array
     */
    public function getTranslatedAttributes();

    /**
     * Get a field by it's slug.
     *
     * @param  $slug
     * @return FieldInterface
     */
    public function getField($slug);

    /**
     * Return whether an entry has
     * a field with a given slug.
     *
     * @param  $slug
     * @return bool
     */
    public function hasField($slug);

    /**
     * Get a field value.
     *
     * @param        $fieldSlug
     * @param  null $locale
     * @return mixed
     */
    public function getFieldValue($fieldSlug, $locale = null);

    /**
     * Set a field value.
     *
     * @param        $fieldSlug
     * @param        $value
     * @param  null $locale
     * @return $this
     */
    public function setFieldValue($fieldSlug, $value, $locale = null);

    /**
     * Fill the model attributes.
     *
     * @param  array $attributes
     * @return $this
     */
    public function fill(array $attributes);

    /**
     * Determine if the model or given
     * attribute(s) have been modified.
     *
     * @param  array|string|null $attributes
     * @return bool
     */
    public function isDirty($attributes = null);

    /**
     * Get the attributes that have
     * been changed since last sync.
     *
     * @return array
     */
    public function getDirty();

    /**
     * Get a field's type by the field's slug.
     *
     * @param  $fieldSlug
     * @return FieldType
     */
    public function getFieldType($fieldSlug);

    /**
     * Get the field type query.
     *
     * @param $fieldSlug
     * @return FieldTypeQuery
     */
    public function getFieldTypeQuery($fieldSlug);

    /**
     * Get the field type presenter.
     *
     * @param $fieldSlug
     * @return FieldTypePresenter
     */
    public function getFieldTypePresenter($fieldSlug);

    /**
     * Get all assignments.
     *
     * @return AssignmentCollection
     */
    public function getAssignments();

    /**
     * Get the field slugs for assigned fields.
     *
     * @param  null $prefix
     * @return array
     */
    public function getAssignmentFieldSlugs($prefix = null);

    /**
     * Get all assignments of the
     * provided field type namespace.
     *
     * @param $fieldType
     * @return AssignmentCollection
     */
    public function getAssignmentsByFieldType($fieldType);

    /**
     * Get an assignment by field slug.
     *
     * @param  $fieldSlug
     * @return AssignmentInterface
     */
    public function getAssignment($fieldSlug);

    /**
     * Return translated assignments.
     *
     * @return AssignmentCollection
     */
    public function getTranslatableAssignments();

    /**
     * Return relation assignments.
     *
     * @return AssignmentCollection
     */
    public function getRelationshipAssignments();

    /**
     * Return required assignments.
     *
     * @return AssignmentCollection
     */
    public function getRequiredAssignments();

    /**
     * Return searchable assignments.
     *
     * @return AssignmentCollection
     */
    public function getSearchableAssignments();

    /**
     * Get a specified relationship.
     *
     * @param  string $relation
     * @return mixed
     */
    public function getRelation($relation);

    /**
     * Eager load relations on the model.
     *
     * @param  $relations
     * @return $this
     */
    public function load($relations);

    /**
     * Get the translatable flag.
     *
     * @return bool
     */
    public function isTranslatable();

    /**
     * Return whether an entry is deletable or not.
     *
     * @return bool
     */
    public function isDeletable();

    /**
     * Return if the model is restorable or not.
     *
     * @return bool
     */
    public function isRestorable();

    /**
     * Return whether the entry is trashable or not.
     *
     * @return bool
     */
    public function isTrashable();

    /**
     * Return whether the model is being
     * force deleted or not.
     *
     * @return bool
     */
    public function isForceDeleting();

    /**
     * Return the last modified datetime.
     *
     * @return Carbon
     */
    public function lastModified();

    /**
     * Return if the entry is trashed or not.
     *
     * @return bool
     */
    public function trashed();

    /**
     * Return the object's ETag fingerprint.
     *
     * @return string
     */
    public function etag();

    /**
     * Return a new presenter instance.
     *
     * @return EntryPresenter
     */
    public function newPresenter();

    /**
     * Return a model route.
     *
     * @return string
     */
    public function route($route, array $parameters = []);

    /**
     * Return a new router instance.
     *
     * @return EntryRouter
     */
    public function newRouter();

    /**
     * Get the router.
     *
     * @return EntryRouter
     */
    public function getRouter();

    /**
     * Get the router name.
     *
     * @return string
     */
    public function getRouterName();

    /**
     * Get the query builder name.
     *
     * @return string
     */
    public function getQueryBuilderName();

    /**
     * Return whether the title column is
     * translatable or not.
     *
     * @return bool
     */
    public function titleColumnIsTranslatable();

    /**
     * Return whether or not the assignment for
     * the given field slug is translatable.
     *
     * @param $fieldSlug
     * @return bool
     */
    public function assignmentIsTranslatable($fieldSlug);

    /**
     * Return whether or not the assignment for
     * the given field slug is a relationship.
     *
     * @param $fieldSlug
     * @return bool
     */
    public function assignmentIsRelationship($fieldSlug);

    /**
     * Set an attribute value.
     *
     * @param  $key
     * @param  $value
     * @return $this
     */
    public function setAttribute($key, $value);

    /**
     * Get an attribute value.
     *
     * @param  $key
     * @return mixed
     */
    public function getAttribute($key);

    /**
     * Get a raw unmodified attribute.
     *
     * @param             $key
     * @param  bool $process
     * @return mixed|null
     */
    public function getRawAttribute($key, $process = true);

    /**
     * Set a raw unmodified attribute.
     *
     * @param $key
     * @param $value
     * @return $this
     */
    public function setRawAttribute($key, $value);

    /**
     * Get the entry attributes.
     *
     * @return array
     */
    public function getAttributes();

    /**
     * Cache a value in the
     * model's cache collection.
     *
     * @param $key
     * @param $ttl
     * @param null $value
     * @return mixed
     */
    public function cache($key, $ttl, $value = null);

    /**
     * Cache (forever) a value in
     * the model's cache collection.
     *
     * @param $key
     * @param $value
     * @return mixed
     */
    public function cacheForever($key, $value);

    /**
     * Flush the entry model's cache.
     *
     * @return EntryInterface
     */
    public function flushCache();

    /**
     * Return the entry as an array.
     *
     * @return array
     */
    public function toArray();

    /**
     * Return the entry with
     * relations as an array.
     *
     * @return array
     */
    public function toArrayWithRelations();

    /**
     * Return the searchable array.
     *
     * @return array
     */
    public function toSearchableArray();

    /**
     * Return the routable array.
     *
     * @return array
     */
    public function toRoutableArray();

    /**
     * Fire field type events.
     *
     * @param       $trigger
     * @param array $payload
     */
    public function fireFieldTypeEvents($trigger, $payload = []);

    /**
     * Get the cascading actions.
     *
     * @return array
     */
    public function getCascades();

    /**
     * Return the related creator.
     *
     * @return Authenticatable
     */
    public function getCreatedBy();

    /**
     * Return the creator relation.
     *
     * @return BelongsTo
     */
    public function createdBy();

    /**
     * Return the related updater.
     *
     * @return Authenticatable
     */
    public function getUpdatedBy();

    /**
     * Return the updater relation.
     *
     * @return BelongsTo
     */
    public function updatedBy();

    /**
     * Call a hook.
     *
     * @param        $hook
     * @param  array $parameters
     * @return mixed
     */
    public function call($hook, array $parameters = []);
}
