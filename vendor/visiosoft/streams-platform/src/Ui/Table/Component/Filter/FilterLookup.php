<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\Filter;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

class FilterLookup
{

    /**
     * The filter registry.
     *
     * @var FilterRegistry
     */
    protected $filters;

    /**
     * Create a new FilterLookup instance.
     *
     * @param FilterRegistry $filters
     */
    public function __construct(FilterRegistry $filters)
    {
        $this->filters = $filters;
    }

    /**
     * Merge in registered parameters.
     *
     * @param TableBuilder $builder
     */
    public function merge(TableBuilder $builder)
    {
        $filters = $builder->getFilters();

        foreach ($filters as &$parameters) {

            $filter = array_pull($parameters, 'filter');

            if ($filter && $filter = $this->filters->get($filter)) {
                $parameters = array_replace_recursive($filter, array_except($parameters, 'filter'));
            }
        }

        $builder->setFilters($filters);
    }
}
