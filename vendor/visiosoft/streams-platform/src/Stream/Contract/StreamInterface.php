<?php namespace Anomaly\Streams\Platform\Stream\Contract;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Anomaly\Streams\Platform\Addon\FieldType\FieldTypeQuery;
use Anomaly\Streams\Platform\Assignment\AssignmentCollection;
use Anomaly\Streams\Platform\Assignment\Contract\AssignmentInterface;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryModel;
use Anomaly\Streams\Platform\Field\Contract\FieldInterface;
use Anomaly\Streams\Platform\Model\EloquentCollection;

/**
 * Interface StreamInterface
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
interface StreamInterface
{

    /**
     * Compile the entry models.
     *
     * @return mixed
     */
    public function compile();

    /**
     * Flush the entry stream's cache.
     *
     * @return StreamInterface
     */
    public function flushCache();

    /**
     * Fire field type events.
     *
     * @param       $trigger
     * @param array $payload
     */
    public function fireFieldTypeEvents($trigger, $payload = []);

    /**
     * Get the ID.
     *
     * @return null|int
     */
    public function getId();

    /**
     * Get the namespace.
     *
     * @return string
     */
    public function getNamespace();

    /**
     * Get the slug.
     *
     * @return string
     */
    public function getSlug();

    /**
     * Get the prefix.
     *
     * @return string
     */
    public function getPrefix();

    /**
     * Get the name.
     *
     * @return string
     */
    public function getName();

    /**
     * Get the description.
     *
     * @return string
     */
    public function getDescription();

    /**
     * Get the config.
     *
     * @param  null $key
     * @param  null $default
     * @return mixed
     */
    public function getConfig($key = null, $default = null);

    /**
     * Merge configuration.
     *
     * @param  array $config
     * @return $this
     */
    public function mergeConfig(array $config);

    /**
     * Get the locked flag.
     *
     * @return bool
     */
    public function isLocked();

    /**
     * Get the hidden flag.
     *
     * @return bool
     */
    public function isHidden();

    /**
     * Get the sortable flag.
     *
     * @return bool
     */
    public function isSortable();

    /**
     * Get the searchable flag.
     *
     * @return bool
     */
    public function isSearchable();

    /**
     * Get the trashable flag.
     *
     * @return bool
     */
    public function isTrashable();

    /**
     * Get the versionable flag.
     *
     * @return bool
     */
    public function isVersionable();

    /**
     * Get the translatable flag.
     *
     * @return bool
     */
    public function isTranslatable();

    /**
     * Get the title column.
     *
     * @return string
     */
    public function getTitleColumn();

    /**
     * Get the title field.
     *
     * @return null|FieldInterface
     */
    public function getTitleField();

    /**
     * Get the related assignments.
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
     * Get the related date assignments.
     *
     * @return AssignmentCollection
     */
    public function getDateAssignments();

    /**
     * Get the related unique assignments.
     *
     * @return AssignmentCollection
     */
    public function getUniqueAssignments();

    /**
     * Get the related required assignments.
     *
     * @return AssignmentCollection
     */
    public function getRequiredAssignments();

    /**
     * Get the related locked assignments.
     *
     * @return AssignmentCollection
     */
    public function getLockedAssignments();

    /**
     * Get the related unlocked assignments.
     *
     * @return AssignmentCollection
     */
    public function getUnlockedAssignments();

    /**
     * Get the related translatable assignments.
     *
     * @return AssignmentCollection
     */
    public function getTranslatableAssignments();

    /**
     * Get the related relationship assignments.
     *
     * @return AssignmentCollection
     */
    public function getRelationshipAssignments();

    /**
     * Get an assignment by it's field's slug.
     *
     * @param  $fieldSlug
     * @return AssignmentInterface
     */
    public function getAssignment($fieldSlug);

    /**
     * Return whether a stream
     * has a field assigned.
     *
     * @param $fieldSlug
     * @return bool
     */
    public function hasAssignment($fieldSlug);

    /**
     * Get a stream field by it's slug.
     *
     * @param  $slug
     * @return FieldInterface
     */
    public function getField($slug);

    /**
     * Get the entry model.
     *
     * @return EntryModel
     */
    public function getEntryModel();

    /**
     * Get the entry model name.
     *
     * @return string
     */
    public function getEntryModelName();

    /**
     * Get the bound entry model name.
     *
     * @return string
     */
    public function getBoundEntryModelName();

    /**
     * Get a field's type by the field's slug.
     *
     * @param                 $fieldSlug
     * @param  EntryInterface $entry
     * @param  null|string    $locale
     * @return FieldType
     */
    public function getFieldType($fieldSlug, EntryInterface $entry = null, $locale = null);

    /**
     * Get a field's query utility by the field's slug.
     *
     * @param                 $fieldSlug
     * @param  EntryInterface $entry
     * @param  null|string    $locale
     * @return FieldTypeQuery
     */
    public function getFieldTypeQuery($fieldSlug, EntryInterface $entry = null, $locale = null);

    /**
     * Get the entry table name.
     *
     * @return string
     */
    public function getEntryTableName();

    /**
     * Get the entry translations table name.
     *
     * @return string
     */
    public function getEntryTranslationsTableName();

    /**
     * Get related translations.
     *
     * @return EloquentCollection
     */
    public function getTranslations();

    /**
     * Get the foreign key.
     *
     * @return string
     */
    public function getForeignKey();

    /**
     * @return array
     */
    public function toArray();
}
