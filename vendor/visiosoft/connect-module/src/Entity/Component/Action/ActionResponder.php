<?php namespace Anomaly\Streams\Platform\Ui\Entity\Component\Action;

use Anomaly\Streams\Platform\Ui\Entity\Component\Action\Contract\ActionHandlerInterface;
use Anomaly\Streams\Platform\Ui\Entity\Component\Action\Contract\ActionInterface;
use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;
use Illuminate\Contracts\Container\Container;

/**
 * Class ActionResponder
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Component\Action
 */
class ActionResponder
{

    /**
     * The service container.
     *
     * @var Container
     */
    private $container;

    /**
     * Create a new ActionResponder instance.
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Set the entity response using the active action
     * entity response handler.
     *
     * @param EntityBuilder $builder
     * @param               $action
     */
    public function setEntityResponse(EntityBuilder $builder, ActionInterface $action)
    {
        $handler = $action->getHandler();

        // Self handling implies @handle
        if (is_string($handler) && !str_contains($handler, '@') && class_implements($handler, SelfHandling::class)) {
            $handler .= '@handle';
        }

        /**
         * If the handler is a closure or callable
         * string then call it using the service container.
         */
        if (is_string($handler) || $handler instanceof \Closure) {
            $this->container->call($handler, compact('builder'));
        }

        /**
         * If the handle is an instance of ActionHandlerInterface
         * simply call the handle method on it.
         */
        if ($handler instanceof ActionHandlerInterface) {
            $handler->handle($builder);
        }
    }
}
