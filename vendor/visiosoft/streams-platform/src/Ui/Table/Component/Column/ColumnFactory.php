<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\Column;

use Anomaly\Streams\Platform\Support\Hydrator;
use Anomaly\Streams\Platform\Ui\Table\Component\Column\Contract\ColumnInterface;

/**
 * Class ColumnFactory
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class ColumnFactory
{

    /**
     * The default column class.
     *
     * @var string
     */
    protected $column = Column::class;

    /**
     * The hydrator utility.
     *
     * @var Hydrator
     */
    protected $hydrator;

    /**
     * Create a new ColumnFactory instance.
     *
     * @param Hydrator $hydrator
     */
    public function __construct(Hydrator $hydrator)
    {
        $this->hydrator = $hydrator;
    }

    /**
     * Make a column.
     *
     * @param  array           $parameters
     * @return ColumnInterface
     */
    public function make(array $parameters)
    {
        $column = app()->make(array_get($parameters, 'column', $this->column), $parameters);

        $this->hydrator->hydrate($column, $parameters);

        return $column;
    }
}
