<?php namespace Anomaly\Streams\Platform\Entry;

use Anomaly\Streams\Platform\Assignment\Contract\AssignmentInterface;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Carbon\Carbon;

/**
 * Class EntryTranslationsModel
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class EntryTranslationsModel extends EloquentModel
{

    /**
     * This model uses timestamps.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Don't array these.
     *
     * @var array
     */
    protected $hidden = [
        'parent',
    ];

    /**
     * Cache minutes.
     *
     * @var int
     */
    //protected $cacheMinutes = 99999;

    /**
     * Boot the model.
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

        if ($events && !$observing) {
            self::observe(EntryTranslationsObserver::class);
        }
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
     * Get the locale.
     *
     * @return string
     */
    public function getLocale()
    {
        return $this->getAttributeFromArray($this->getLocaleKey());
    }

    /**
     * Get an attribute.
     *
     * @param  string $key
     * @return mixed
     */
    public function getAttribute($key)
    {
        if ($key === 'locale') {
            return parent::getAttribute('locale');
        }

        if (!$parent = $this->getParent()) {
            return $this->attributes[$key];
        }

        /* @var AssignmentInterface $assignment */
        $assignment = $parent->getAssignment($key);

        if (!$assignment) {
            return parent::getAttribute($key);
        }

        $type = $assignment->getFieldType($this);

        $type->setEntry($this);
        $type->setLocale($this->locale);

        $accessor = $type->getAccessor();
        $modifier = $type->getModifier();

        return $modifier->restore($accessor->get($key));
    }

    /**
     * Get the parent.
     *
     * @return EntryModel
     */
    public function getParent()
    {
        return isset($this->relations['parent']) ? $this->relations['parent'] : null;
    }

    /**
     * Flush the parent's cache.
     *
     * @return $this
     */
    public function flushParentCache()
    {
        if ($parent = $this->getParent()) {
            $parent->flushCache();
        }

        return $this;
    }

    /**
     * Set the attribute.
     *
     * @param string $key
     * @param mixed $value
     */
    public function setAttribute($key, $value)
    {
        if (!$parent = $this->getParent()) {
            return null;
        }

        /* @var AssignmentInterface $assignment */
        $assignment = $parent->getAssignment($key);

        if (!$assignment) {

            parent::setAttribute($key, $value);

            return $this;
        }

        $type = $assignment->getFieldType($this);

        $type->setEntry($this);
        $type->setLocale($this->locale);

        $accessor = $type->getAccessor();
        $modifier = $type->getModifier();

        $accessor->set($modifier->modify($value));

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
        if (!$parent = $this->getParent()) {
            return null;
        }

        $assignments = $parent->getAssignments();

        /* @var AssignmentInterface $assignment */
        foreach ($assignments->translatable() as $assignment) {
            $fieldType = $assignment->getFieldType();

            $fieldType->setValue($parent->getFieldValue($assignment->getFieldSlug()));

            $fieldType->setEntry($this);
            $fieldType->setLocale($this->locale);

            $fieldType->fire($trigger, array_merge(compact('fieldType'), $payload));
        }
    }

    /**
     * Truncate the translation's table.
     *
     * @return mixed
     */
    public function truncate()
    {
        return $this->newQuery()->truncate();
    }

    /**
     * Let the parent handle calls if they don't exist here.
     *
     * @param  string $name
     * @param  array $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        if (!$parent = $this->getParent()) {
            return parent::__call($name, $arguments);
        }

        return call_user_func_array([$parent, $name], $arguments);
    }

    /**
     * Get the attribute from the parent
     * if it does not exist here.
     *
     * @param  string $key
     * @return mixed
     */
    public function __get($key)
    {
        $value = parent::__get($key);

        if (!isset($value) && $parent = $this->getParent()) {
            return $parent->{$key};
        }

        return $value;
    }

    /**
     * Clean up the object before serializing.
     *
     * @return array
     */
    function __sleep()
    {

        /**
         * Remove the parent relation
         * as it tends to cause recursion
         * and closure errors when included.
         */
        $this->unsetRelation('parent');

        /**
         * Remove a volatile memory attribute
         * and remove the problematic parent.
         */
        $variables = parent::__sleep();

        $variables = array_diff(
            $variables,
            [
                'parent',
                'cacheCollection',
            ]
        );

        return $variables;
    }
}
