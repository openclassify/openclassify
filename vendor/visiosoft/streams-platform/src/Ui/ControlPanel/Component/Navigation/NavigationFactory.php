<?php namespace Anomaly\Streams\Platform\Ui\ControlPanel\Component\Navigation;

use Anomaly\Streams\Platform\Support\Hydrator;
use Anomaly\Streams\Platform\Ui\ControlPanel\Component\Navigation\Contract\NavigationLinkInterface;
use Illuminate\Contracts\Container\Container;

/**
 * Class NavigationFactory
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class NavigationFactory
{

    /**
     * The navigation link class.
     *
     * @var NavigationLink
     */
    protected $link = NavigationLink::class;

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
    protected $container;

    /**
     * Create a new NavigationFactory instance.
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
     * Make the navigation link.
     *
     * @param  array                   $parameters
     * @return NavigationLinkInterface
     */
    public function make(array $parameters)
    {
        $link = $this->container->make(array_get($parameters, 'link', $this->link), $parameters);

        $this->hydrator->hydrate($link, $parameters);

        return $link;
    }
}
