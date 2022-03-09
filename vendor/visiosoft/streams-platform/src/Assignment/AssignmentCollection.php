<?php namespace Anomaly\Streams\Platform\Assignment;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Anomaly\Streams\Platform\Assignment\Contract\AssignmentInterface;
use Anomaly\Streams\Platform\Model\EloquentCollection;

/**
 * Class AssignmentCollection
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AssignmentCollection extends EloquentCollection
{

    /**
     * Find an assignment by it's field slug.
     *
     * @param  $slug
     * @return AssignmentInterface
     */
    public function findByFieldSlug($slug)
    {
        foreach ($this->items as $item) {
            /* @var AssignmentInterface $item */
            if ($item->getFieldSlug() == $slug) {
                return $item;
            }
        }

        return null;
    }


    /**
     * Find all fields using
     * the provided field type.
     *
     * @param $namespace
     * @return static
     */
    public function findAllByFieldType($namespace)
    {
        return new static(
            array_filter(
                $this->items,
                function (AssignmentInterface $assignment) use ($namespace) {
                    return $assignment->getFieldTypeValue() == $namespace;
                }
            )
        );
    }

    /**
     * Return assignments only included the provided fields.
     *
     * @param  array $fields
     * @return AssignmentCollection
     */
    public function withFields(array $fields)
    {
        return new static(
            array_filter(
                array_map(
                    function (AssignmentInterface $assignment) use ($fields) {
                        return in_array($assignment->getFieldSlug(), $fields) ? $assignment : null;
                    },
                    $this->items
                )
            )
        );
    }

    /**
     * Return assignments not included the provided fields.
     *
     * @param  array $fields
     * @return AssignmentCollection
     */
    public function withoutFields(array $fields)
    {
        return new static(
            array_filter(
                array_map(
                    function (AssignmentInterface $assignment) use ($fields) {
                        return !in_array($assignment->getFieldSlug(), $fields) ? $assignment : null;
                    },
                    $this->items
                )
            )
        );
    }

    /**
     * Return only assignments that have relation fields.
     *
     * @return AssignmentCollection
     */
    public function relations()
    {
        $relations = [];

        /* @var AssignmentInterface $item */
        /* @var FieldType $type */
        foreach ($this->items as $item) {
            $type = $item->getFieldType();

            if (method_exists($type, 'getRelation')) {
                $relations[] = $item;
            }
        }

        return self::make($relations);
    }

    /**
     * Return only searchable assignments.
     *
     * @return AssignmentCollection
     */
    public function searchable()
    {
        return $this->filter(
            function (AssignmentInterface $assignment) {
                return $assignment->isSearchable();
            }
        );
    }

    /**
     * Return only assignments that have date fields.
     *
     * @return AssignmentCollection
     */
    public function dates()
    {
        return $this->filter(
            function (AssignmentInterface $assignment) {
                $type = $assignment->getFieldType();

                return in_array($type->getColumnType(), ['date', 'datetime']);
            }
        );
    }

    /**
     * Return only assignments that are unique.
     *
     * @return AssignmentCollection
     */
    public function indexed()
    {
        return $this->filter(
            function (AssignmentInterface $assignment) {
                return $assignment->isUnique();
            }
        );
    }

    /**
     * Return only assignments that are required.
     *
     * @return AssignmentCollection
     */
    public function required()
    {
        return $this->filter(
            function (AssignmentInterface $assignment) {
                return $assignment->isRequired();
            }
        );
    }

    /**
     * Return only assignments that are translatable.
     *
     * @return AssignmentCollection
     */
    public function translatable()
    {
        return $this->filter(
            function (AssignmentInterface $assignment) {
                return $assignment->isTranslatable();
            }
        );
    }

    /**
     * Return only assignments that are NOT translatable.
     *
     * @return AssignmentCollection
     */
    public function notTranslatable()
    {
        return $this->filter(
            function (AssignmentInterface $assignment) {
                return !$assignment->isTranslatable();
            }
        );
    }

    /**
     * Return an array of field slugs.
     *
     * @param  null $prefix
     * @return array
     */
    public function fieldSlugs($prefix = null)
    {
        $slugs = [];

        /* @var AssignmentInterface $item */
        foreach ($this->items as $item) {
            $slugs[] = $prefix . $item->getFieldSlug();
        }

        return $slugs;
    }

    /**
     * Return only assignments with locked fields.
     *
     * @return AssignmentCollection
     */
    public function locked()
    {
        $items = [];

        foreach ($this->items as $item) {
            if ($item instanceof AssignmentInterface && $field = $item->getField()) {
                if ($field->isLocked()) {
                    $items[] = $item;
                }
            }
        }

        return new static($items);
    }

    /**
     * Return only assignments with fields
     * that are not locked.
     *
     * @return AssignmentCollection
     */
    public function notLocked()
    {
        $items = [];

        foreach ($this->items as $item) {
            if ($item instanceof AssignmentInterface && $field = $item->getField()) {
                if (!$field->isLocked()) {
                    $items[] = $item;
                }
            }
        }

        return new static($items);
    }

    /**
     * An alias for notLocked();
     *
     * @return AssignmentCollection
     */
    public function unlocked()
    {
        return $this->notLocked();
    }

    /**
     * Return the assignment
     * with column type.
     *
     * @param $type
     * @return AssignmentCollection
     */
    public function column($type)
    {
        return $this->filter(
            function ($item) use ($type) {

                /* @var AssignmentInterface $item */
                $fieldType = $item->getFieldType();

                return $fieldType->getColumnType() == $type;
            }
        );
    }
}
