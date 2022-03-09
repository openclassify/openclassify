<?php namespace Anomaly\Streams\Platform\Field;

use Anomaly\Streams\Platform\Field\Contract\FieldInterface;
use Anomaly\Streams\Platform\Model\EloquentCollection;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;

/**
 * Class FieldCollection
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class FieldCollection extends EloquentCollection
{

    /**
     * Create a new FieldCollection instance.
     *
     * @param array $items
     */
    public function __construct($items = [])
    {
        /* @var FieldInterface $item */
        foreach ($items as $item) {
            if (is_object($item)) {
                $this->items[$item->getSlug()] = $item;
            } else {
                $this->items[] = $item;
            }
        }
    }

    /**
     * Return only unassigned fields.
     *
     * @return FieldCollection
     */
    public function unassigned()
    {
        $unassigned = [];

        /* @var FieldInterface $item */
        foreach ($this->items as $item) {
            if (!$item->hasAssignments()) {
                $unassigned[] = $item;
            }
        }

        return new static($unassigned);
    }

    /**
     * Return fields only assigned
     * to the provided stream.
     *
     * @param  StreamInterface $stream
     * @return FieldCollection
     */
    public function assignedTo(StreamInterface $stream)
    {
        $fieldSlugs = $stream->getAssignmentFieldSlugs();

        return new static(
            array_filter(
                $this->items,
                function (FieldInterface $field) use ($fieldSlugs) {
                    return in_array($field->getSlug(), $fieldSlugs);
                }
            )
        );
    }

    /**
     * Return fields only NOT assigned
     * to the provided stream.
     *
     * @param  StreamInterface $stream
     * @return FieldCollection
     */
    public function notAssignedTo(StreamInterface $stream)
    {
        $fieldSlugs = $stream->getAssignmentFieldSlugs();

        return new static(
            array_filter(
                $this->items,
                function (FieldInterface $field) use ($fieldSlugs) {
                    return !in_array($field->getSlug(), $fieldSlugs);
                }
            )
        );
    }

    /**
     * Return only unlocked fields.
     *
     * @return FieldCollection
     */
    public function unlocked()
    {
        $unlocked = [];

        /* @var FieldInterface $item */
        foreach ($this->items as $item) {
            if (!$item->isLocked()) {
                $unlocked[] = $item;
            }
        }

        return new static($unlocked);
    }
}
