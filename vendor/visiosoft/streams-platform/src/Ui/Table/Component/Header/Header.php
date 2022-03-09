<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\Header;

/*
 * Class Header
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 * @package       Anomaly\Streams\Platform\Ui\Table\Component\Header
 */
use Anomaly\Streams\Platform\Ui\Table\Component\Header\Contract\HeaderInterface;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class Header
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class Header implements HeaderInterface
{

    /**
     * The table builder.
     *
     * @var TableBuilder
     */
    protected $builder;

    /**
     * The header heading.
     *
     * @var string
     */
    protected $heading;

    /**
     * The sort column.
     *
     * @var string
     */
    protected $sortColumn;

    /**
     * The sortable flag.
     *
     * @var bool
     */
    protected $sortable = false;

    /**
     * Get the query string with
     * this column being sorted.
     *
     * @return string
     */
    public function getQueryString()
    {
        $query = $_GET;

        $builder   = $this->getBuilder();
        $direction = $this->getDirection('asc');

        array_set($query, $builder->getTableOption('prefix') . 'order_by', $this->getSortColumn());
        array_set($query, $builder->getTableOption('prefix') . 'sort', $direction == 'asc' ? 'desc' : 'asc');

        return http_build_query($query);
    }

    /**
     * Get the table builder.
     *
     * @return TableBuilder
     */
    public function getBuilder()
    {
        return $this->builder;
    }

    /**
     * Set the table builder.
     *
     * @param  TableBuilder $builder
     * @return $this
     */
    public function setBuilder(TableBuilder $builder)
    {
        $this->builder = $builder;

        return $this;
    }

    /**
     * Get the current direction
     * defaulting to ascending.
     *
     * @param  null        $default
     * @return string|null
     */
    public function getDirection($default = null)
    {
        $query = $_GET;

        $builder = $this->getBuilder();

        if (array_get($query, $builder->getTableOption('prefix') . 'order_by') !== $this->getSortColumn()) {
            return null;
        }

        return array_get($query, $builder->getTableOption('prefix') . 'sort', $default);
    }

    /**
     * Get the sort column.
     *
     * @return string
     */
    public function getSortColumn()
    {
        return $this->sortColumn;
    }

    /**
     * Set the sort column.
     *
     * @param  string $sortColumn
     * @return $this
     */
    public function setSortColumn($sortColumn)
    {
        $this->sortColumn = $sortColumn;

        return $this;
    }

    /**
     * Get the header heading.
     *
     * @return mixed
     */
    public function getHeading()
    {
        return $this->heading;
    }

    /**
     * Set the header heading.
     *
     * @param $heading
     * @return $this
     */
    public function setHeading($heading)
    {
        $this->heading = $heading;

        return $this;
    }

    /**
     * Get the sortable flag.
     *
     * @return boolean
     */
    public function isSortable()
    {
        return $this->sortable;
    }

    /**
     * Set the sortable flag.
     *
     * @param  boolean $sortable
     * @return $this
     */
    public function setSortable($sortable)
    {
        $this->sortable = $sortable;

        return $this;
    }
}
