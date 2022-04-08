<?php namespace Anomaly\Streams\Platform\Entry;

use Anomaly\Streams\Platform\Addon\FieldType\FieldTypeQuery;
use Anomaly\Streams\Platform\Model\EloquentCriteria;
use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class EntryCriteria
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class EntryCriteria extends EloquentCriteria
{

    /**
     * The stream instance.
     *
     * @var StreamInterface
     */
    protected $stream;

    /**
     * Create a new EntryCriteria instance.
     *
     * @param Builder         $query
     * @param StreamInterface $stream
     * @param string          $method
     */
    public function __construct(Builder $query, StreamInterface $stream, $method)
    {
        $this->stream = $stream;

        parent::__construct($query, $method);
    }

    /**
     * Return sorted entries.
     *
     * @param  string $direction
     * @return $this
     */
    public function sorted($direction = 'ASC')
    {
        $this->query->orderBy('sort_order', $direction);

        return $this;
    }

    /**
     * Get a field type criteria.
     *
     * @param $field
     * @return FieldTypeQuery
     */
    public function getFieldTypeCriteria($field)
    {
        return $this->stream
            ->getFieldType($field)
            ->getCriteria($this->query);
    }

    /**
     * Route through __call.
     *
     * @param $name
     * @return Builder|null
     */
    public function __get($name)
    {
        if ($assignment = $this->stream->getAssignment(snake_case($name))) {
            $this->query->where($assignment->getColumnName(), null);

            return $this;
        }

        return parent::__get($name);
    }

    /**
     * Call the method on the query.
     *
     * @param $name
     * @param $arguments
     * @return Builder|null
     */
    public function __call($name, $arguments)
    {
        if ($assignment = $this->stream->getAssignment(snake_case($name))) {
            $this->query->where($assignment->getColumnName(), $arguments ? array_shift($arguments) : null);

            return $this;
        }

        return parent::__call($name, $arguments);
    }
}
