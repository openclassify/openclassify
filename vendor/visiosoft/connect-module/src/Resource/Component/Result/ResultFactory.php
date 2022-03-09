<?php namespace Visiosoft\ConnectModule\Resource\Component\Result;

use Visiosoft\ConnectModule\Resource\Component\Result\Contract\ResultInterface;
use Anomaly\Streams\Platform\Support\Hydrator;
use Illuminate\Contracts\Container\Container;

/**
 * Class ResultFactory
 *

 */
class ResultFactory
{

    /**
     * The hydrator utility.
     *
     * @var Hydrator
     */
    protected $hydrator;

    /**
     * The service container.
     *
     * @var Container
     */
    private $container;

    /**
     * Create a new ResultFactory instance.
     *
     * @param Hydrator  $hydrator
     * @param Container $container
     */
    public function __construct(Hydrator $hydrator, Container $container)
    {
        $this->hydrator  = $hydrator;
        $this->container = $container;
    }

    /**
     * Make a result.
     *
     * @param  array $parameters
     * @return ResultInterface
     */
    public function make(array $parameters)
    {
        $result = $this->container->make(Result::class, $parameters);

        $this->hydrator->hydrate($result, $parameters);

        return $result;
    }
}
