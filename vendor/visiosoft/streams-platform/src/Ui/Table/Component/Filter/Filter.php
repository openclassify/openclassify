<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\Filter;

use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;
use Anomaly\Streams\Platform\Ui\Table\Component\Filter\Contract\FilterInterface;
use Anomaly\Streams\Platform\Ui\Table\Component\Filter\Query\GenericFilterQuery;
use Closure;

/**
 * Class Filter
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class Filter implements FilterInterface
{

    /**
     * The filter slug.
     *
     * @var string
     */
    protected $slug = 'default';

    /**
     * The filter field.
     *
     * @var string
     */
    protected $field;

    /**
     * The stream object.
     *
     * @var StreamInterface
     */
    protected $stream;

    /**
     * The filter prefix.
     *
     * @var null|string
     */
    protected $prefix = null;

    /**
     * The exact flag.
     *
     * @var bool
     */
    protected $exact = false;

    /**
     * The active flag.
     *
     * @var bool
     */
    protected $active = false;

    /**
     * The filter column.
     *
     * @var bool
     */
    protected $column = null;

    /**
     * The filter value.
     *
     * @var mixed
     */
    protected $value = '__BLANK';

    /**
     * The filter placeholder.
     *
     * @var null|string
     */
    protected $placeholder = null;

    /**
     * The filter query.
     *
     * @var string|Closure
     */
    protected $query = GenericFilterQuery::class;

    /**
     * Get the filter query.
     *
     * @return string|Closure
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * Set the filter query.
     *
     * @param $query
     * @return $this
     */
    public function setQuery($query)
    {
        $this->query = $query;

        return $this;
    }

    /**
     * Get the placeholder.
     *
     * @return null|string
     */
    public function getPlaceholder()
    {
        return $this->placeholder;
    }

    /**
     * Set the placeholder.
     *
     * @param $placeholder
     * @return $this
     */
    public function setPlaceholder($placeholder)
    {
        $this->placeholder = $placeholder;

        return $this;
    }

    /**
     * Get the filter input.
     *
     * @return null|string
     */
    public function getInput()
    {
        return null;
    }

    /**
     * Get the filter value.
     *
     * @return null|string
     */
    public function getValue()
    {
        if ($this->value != '__BLANK') {
            return $this->value;
        }

        return app('request')->get($this->getInputName());
    }

    /**
     * Get the filter value.
     *
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get the filter name.
     *
     * @return string
     */
    public function getInputName()
    {
        return $this->getPrefix() . 'filter_' . $this->getSlug();
    }

    /**
     * Get the filter prefix.
     *
     * @return null|string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * Set the filter prefix.
     *
     * @param  string $prefix
     * @return $this
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;

        return $this;
    }

    /**
     * Get the filter slug.
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set the filter slug.
     *
     * @param $slug
     * @return $this
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Set the exact flag.
     *
     * @param  bool $exact
     * @return $this
     */
    public function setExact($exact)
    {
        $this->exact = $exact;

        return $this;
    }

    /**
     * Return the exact flag.
     *
     * @return bool
     */
    public function isExact()
    {
        return $this->exact;
    }

    /**
     * Set the active flag.
     *
     * @param  bool $active
     * @return $this
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get the active flag.
     *
     * @return bool
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * Get the column.
     *
     * @return bool
     */
    public function getColumn()
    {
        return $this->column;
    }

    /**
     * Set the column.
     *
     * @param $column
     * @return $this
     */
    public function setColumn($column)
    {
        $this->column = $column;

        return $this;
    }

    /**
     * Get the filter field.
     *
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * Set the filter field.
     *
     * @param  $field
     * @return $this
     */
    public function setField($field)
    {
        $this->field = $field;

        return $this;
    }

    /**
     * Get the stream.
     *
     * @return StreamInterface
     */
    public function getStream()
    {
        return $this->stream;
    }

    /**
     * Set the stream.
     *
     * @param  StreamInterface $stream
     * @return $this
     */
    public function setStream(StreamInterface $stream)
    {
        $this->stream = $stream;

        return $this;
    }
}
