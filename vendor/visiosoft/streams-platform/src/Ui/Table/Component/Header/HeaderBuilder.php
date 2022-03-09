<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\Header;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class HeaderBuilder
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class HeaderBuilder
{

    /**
     * The input utility.
     *
     * @var HeaderInput
     */
    protected $input;

    /**
     * The header factory.
     *
     * @var HeaderFactory
     */
    protected $factory;

    /**
     * Create a new HeaderBuilder instance.
     *
     * @param HeaderInput   $input
     * @param HeaderFactory $factory
     */
    public function __construct(HeaderInput $input, HeaderFactory $factory)
    {
        $this->input   = $input;
        $this->factory = $factory;
    }

    /**
     * Build the headers.
     *
     * @param TableBuilder $builder
     */
    public function build(TableBuilder $builder)
    {
        $table = $builder->getTable();

        $this->input->read($builder);

        if ($builder->getTableOption('enable_headers') === false) {
            return;
        }

        foreach ($builder->getColumns() as $column) {
            $column['builder'] = $builder;

            $table->addHeader($this->factory->make($column));
        }
    }
}
