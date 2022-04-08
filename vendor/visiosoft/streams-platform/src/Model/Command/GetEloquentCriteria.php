<?php namespace Anomaly\Streams\Platform\Model\Command;

use Anomaly\Streams\Platform\Entry\EntryFactory;
use Anomaly\Streams\Platform\Model\EloquentFactory;

/**
 * Class GetEloquentCriteria
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class GetEloquentCriteria
{

    /**
     * The model string.
     *
     * @var string
     */
    protected $model;

    /**
     * The getter method.
     *
     * @var string
     */
    protected $method;

    /**
     * Create a new GetEloquentCriteria instance.
     *
     * @param        $model
     * @param string $method
     */
    public function __construct($model, $method = 'get')
    {
        $this->model  = $model;
        $this->method = $method;
    }

    /**
     * Handle the command.
     *
     * @param  EntryFactory $factory
     * @return \Anomaly\Streams\Platform\Model\EloquentCriteria|null
     */
    public function handle(EloquentFactory $factory)
    {
        return $factory->make($this->model, $this->method);
    }
}
