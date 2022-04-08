<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\Filter\Type;

use Anomaly\Streams\Platform\Ui\Table\Component\Filter\Contract\SearchFilterInterface;
use Anomaly\Streams\Platform\Ui\Table\Component\Filter\Filter;
use Anomaly\Streams\Platform\Ui\Table\Component\Filter\Query\SearchFilterQuery;
use Closure;

/**
 * Class SearchFilter
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class SearchFilter extends Filter implements SearchFilterInterface
{

    /**
     * The fields to search.
     *
     * @var array
     */
    protected $fields = [];

    /**
     * The columns to search.
     *
     * @var array
     */
    protected $columns = [];

    /**
     * The filter query.
     *
     * @var string|Closure
     */
    protected $query = SearchFilterQuery::class;

    /**
     * Get the input HTML.
     *
     * @return string
     */
    public function getInput()
    {
        return app('form')->input(
            'text',
            $this->getInputName(),
            $this->getValue(),
            [
                'class'       => 'form-control',
                'placeholder' => trans($this->getPlaceholder()),
            ]
        );
    }

    /**
     * Get the columns.
     *
     * @return array
     */
    public function getColumns()
    {
        return $this->columns;
    }

    /**
     * Set the columns.
     *
     * @param  array $columns
     * @return $this
     */
    public function setColumns(array $columns)
    {
        $this->columns = $columns;

        return $this;
    }

    /**
     * Get the fields.
     *
     * @return array
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * Set the fields.
     *
     * @param  array $fields
     * @return $this
     */
    public function setFields(array $fields)
    {
        $this->fields = $fields;

        return $this;
    }
}
