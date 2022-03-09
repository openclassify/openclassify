<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\View;

use Anomaly\Streams\Platform\Support\Hydrator;
use Anomaly\Streams\Platform\Ui\Table\Component\View\Contract\ViewInterface;
use Illuminate\Contracts\Container\Container;

/**
 * Class ViewFactory
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class ViewFactory
{

    /**
     * The default view class.
     *
     * @var string
     */
    protected $view = View::class;

    /**
     * The hydrator utility.
     *
     * @var Hydrator
     */
    protected $hydrator;

    /**
     * The services container.
     *
     * @var Container
     */
    protected $container;

    /**
     * Create a new ViewFactory instance.
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
     * Make a view.
     *
     * @param  array         $parameters
     * @return ViewInterface
     */
    public function make(array $parameters)
    {
        if (!class_exists(array_get($parameters, 'view'))) {
            array_set($parameters, 'view', $this->view);
        }

        $this->hydrator->hydrate(
            $view = $this->container->make(array_get($parameters, 'view'), $parameters),
            $parameters
        );

        return $view;
    }
}
