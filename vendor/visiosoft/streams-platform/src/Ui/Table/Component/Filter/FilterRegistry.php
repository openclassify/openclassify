<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\Filter;

use Anomaly\Streams\Platform\Ui\Table\Component\Filter\Type\DatetimeFilter;
use Anomaly\Streams\Platform\Ui\Table\Component\Filter\Type\FieldFilter;
use Anomaly\Streams\Platform\Ui\Table\Component\Filter\Type\InputFilter;
use Anomaly\Streams\Platform\Ui\Table\Component\Filter\Type\SearchFilter;
use Anomaly\Streams\Platform\Ui\Table\Component\Filter\Type\SelectFilter;

/**
 * Class FilterRegistry
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class FilterRegistry
{

    /**
     * Available filters.
     *
     * @var array
     */
    protected $filters = [
        'input'      => [
            'slug'   => 'input',
            'filter' => InputFilter::class,
        ],
        'search'     => [
            'slug'        => 'search',
            'filter'      => SearchFilter::class,
            'placeholder' => 'streams::message.search',
        ],
        'select'     => [
            'slug'   => 'select',
            'filter' => SelectFilter::class,
        ],
        'field'      => [
            'filter' => FieldFilter::class,
        ],
        'datetime'   => [
            'slug'   => 'datetime',
            'filter' => DatetimeFilter::class,
        ],
        'created_at' => [
            'filter'      => DatetimeFilter::class,
            'placeholder' => 'streams::entry.created_at',
        ],
        'updated_at' => [
            'filter'      => DatetimeFilter::class,
            'placeholder' => 'streams::entry.updated_at',
        ],
    ];

    /**
     * Get a filter.
     *
     * @param  $filter
     * @return array
     */
    public function get($filter)
    {
        return array_get($this->filters, $filter);
    }

    /**
     * Register a filter.
     *
     * @param        $filter
     * @param  array $parameters
     * @return $this
     */
    public function register($filter, array $parameters)
    {
        array_set($this->filters, $filter, $parameters);

        return $this;
    }
}
