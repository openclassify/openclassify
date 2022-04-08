<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\View;

use Anomaly\Streams\Platform\Ui\Table\Component\View\Contract\ViewHandlerInterface;
use Anomaly\Streams\Platform\Ui\Table\Component\View\Contract\ViewInterface;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;
use Illuminate\Contracts\Container\Container;

/**
 * Class ViewHandler
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ViewHandler
{

    /**
     * The service container.
     *
     * @var Container
     */
    protected $container;

    /**
     * Create a new ViewHandler instance.
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Handle the view's table modification.
     *
     * @param TableBuilder  $builder
     * @param ViewInterface $view
     */
    public function handle(TableBuilder $builder, ViewInterface $view)
    {
        if (!$handler = $view->getHandler()) {
            return;
        }

        /*
         * If the handler is a callable string or Closure
         * then call it using the IoC container.
         */
        if (is_string($handler) || $handler instanceof \Closure) {
            $this->container->call($handler, compact('builder'));
        }

        /*
         * If the handle is an instance of ViewHandlerInterface
         * simply call the handle method on it.
         */
        if ($handler instanceof ViewHandlerInterface) {
            $handler->handle($builder);
        }
    }
}
