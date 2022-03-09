<?php

namespace Anomaly\Streams\Platform\Ui\Form\Component\Action;

use Illuminate\Support\Str;
use Illuminate\Contracts\Container\Container;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Anomaly\Streams\Platform\Ui\Form\Component\Action\Contract\ActionInterface;
use Anomaly\Streams\Platform\Ui\Form\Component\Action\Contract\ActionHandlerInterface;

/**
 * Class ActionResponder
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
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
     * Set the form response using the active action
     * form response handler.
     *
     * @param FormBuilder $builder
     * @param             $action
     */
    public function setFormResponse(FormBuilder $builder, ActionInterface $action)
    {
        $handler = $action->getHandler();

        // Self handling implies @handle
        if (is_string($handler) && !Str::contains($handler, '@')) {
            $handler .= '@handle';
        }

        /*
         * If the handler is a closure or callable
         * string then call it using the service container.
         */
        if (is_string($handler) || $handler instanceof \Closure) {
            $this->container->call($handler, compact('builder'));
        }

        /*
         * If the handle is an instance of ActionHandlerInterface
         * simply call the handle method on it.
         */
        if ($handler instanceof ActionHandlerInterface) {
            $handler->handle($builder);
        }
    }
}
