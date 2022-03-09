<?php namespace Anomaly\Streams\Platform\Ui\Form\Component\Action;

use Anomaly\Streams\Platform\Support\Hydrator;
use Anomaly\Streams\Platform\Ui\Form\Component\Action\Contract\ActionInterface;
use Illuminate\Contracts\Container\Container;

/**
 * Class ActionFactory
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ActionFactory
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
     * Create a new ActionFactory instance.
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
     * Make an action.
     *
     * @param  array           $parameters
     * @return ActionInterface
     */
    public function make(array $parameters)
    {
        $action = $this->container->make(array_get($parameters, 'action', Action::class), $parameters);

        $this->hydrator->hydrate($action, $parameters);

        return $action;
    }
}
