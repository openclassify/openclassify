<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\Filter;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class FilterBuilder
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class FilterBuilder
{

    /**
     * The filter reader.
     *
     * @var FilterInput
     */
    protected $input;

    /**
     * The filter factory.
     *
     * @var FilterFactory
     */
    protected $factory;

    /**
     * Create a new FilterBuilder instance.
     *
     * @param FilterInput   $input
     * @param FilterFactory $factory
     */
    public function __construct(FilterInput $input, FilterFactory $factory)
    {
        $this->input   = $input;
        $this->factory = $factory;
    }

    /**
     * Build the filters.
     *
     * @param TableBuilder $builder
     */
    public function build(TableBuilder $builder)
    {
        $table = $builder->getTable();

        $this->input->read($builder);

        foreach ($builder->getFilters() as $filter) {

            if (array_get($filter, 'enabled') === false) {
                continue;
            }

            $table->addFilter($this->factory->make($filter));
        }
    }
}
