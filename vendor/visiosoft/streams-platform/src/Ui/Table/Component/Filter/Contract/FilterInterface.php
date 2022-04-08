<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\Filter\Contract;

use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;
use Closure;

/**
 * Interface FilterInterface
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
interface FilterInterface
{

    /**
     * Set the filter query.
     *
     * @param $handler
     * @return $this
     */
    public function setQuery($query);

    /**
     * Get the filter query.
     *
     * @return string|Closure
     */
    public function getQuery();

    /**
     * Get the filter input.
     *
     * @return null|string
     */
    public function getInput();

    /**
     * Get the filter name.
     *
     * @return string
     */
    public function getInputName();

    /**
     * Get the filter value.
     *
     * @return null|string
     */
    public function getValue();

    /**
     * Set the filter value.
     *
     * @param $value
     * @return $this
     */
    public function setValue($value);

    /**
     * Set the exact flag.
     *
     * @param  bool $exact
     * @return $this
     */
    public function setExact($exact);

    /**
     * Get the exact flag.
     *
     * @return bool
     */
    public function isExact();

    /**
     * Set the active flag.
     *
     * @param  bool $active
     * @return $this
     */
    public function setActive($active);

    /**
     * Get the active flag.
     *
     * @return bool
     */
    public function isActive();

    /**
     * Get the column.
     *
     * @return bool
     */
    public function getColumn();

    /**
     * Set the column.
     *
     * @param $column
     * @return $this
     */
    public function setColumn($column);

    /**
     * Set the field.
     *
     * @param  $field
     * @return mixed
     */
    public function setField($field);

    /**
     * Get the field.
     *
     * @return mixed
     */
    public function getField();

    /**
     * Set the field stream.
     *
     * @param  StreamInterface $stream
     * @return mixed
     */
    public function setStream(StreamInterface $stream);

    /**
     * Get the field stream.
     *
     * @return StreamInterface
     */
    public function getStream();

    /**
     * Set the filter prefix.
     *
     * @param  string $prefix
     * @return $this
     */
    public function setPrefix($prefix);

    /**
     * Get the filter prefix.
     *
     * @return null|string
     */
    public function getPrefix();

    /**
     * Set the filter slug.
     *
     * @param $slug
     * @return $this
     */
    public function setSlug($slug);

    /**
     * Get the filter slug.
     *
     * @return string
     */
    public function getSlug();
}
