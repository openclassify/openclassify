<?php namespace Anomaly\Streams\Platform\Field\Contract;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Anomaly\Streams\Platform\Assignment\AssignmentCollection;
use Anomaly\Streams\Platform\Model\EloquentCollection;

/**
 * Interface FieldInterface
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
interface FieldInterface
{

    /**
     * Get the ID.
     *
     * @return int
     */
    public function getId();

    /**
     * Get the name.
     *
     * @return string
     */
    public function getName();

    /**
     * Get the warning.
     *
     * @return string
     */
    public function getWarning();

    /**
     * Get the instructions.
     *
     * @return string
     */
    public function getInstructions();

    /**
     * Get the instructions.
     *
     * @return string
     */
    public function getPlaceholder();

    /**
     * Get the stream.
     *
     * @return string
     */
    public function getStream();

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
     * Get the field type.
     *
     * @param  bool      $fresh
     * @return FieldType
     */
    public function getType($fresh = false);

    /**
     * Get the field type value.
     *
     * @return string
     */
    public function getTypeValue();

    /**
     * Get the configuration.
     *
     * @return mixed
     */
    public function getConfig();

    /**
     * Get the related assignments.
     *
     * @return AssignmentCollection
     */
    public function getAssignments();

    /**
     * Return whether the field
     * has assignments or not.
     *
     * @return bool
     */
    public function hasAssignments();

    /**
     * Get related translations.
     *
     * @return EloquentCollection
     */
    public function getTranslations();

    /**
     * Return whether the field is
     * a relationship or not.
     *
     * @return bool
     */
    public function isRelationship();

    /**
     * Get the locked flag.
     *
     * @return bool
     */
    public function isLocked();

    /**
     * Get the rules.
     *
     * @return array
     */
    public function getRules();

    /**
     * Flush the entry model's cache.
     *
     * @return FieldInterface
     */
    public function flushCache();

    /**
     * Compile the fields's streams.
     *
     * @return FieldInterface
     */
    public function compileStreams();
}
