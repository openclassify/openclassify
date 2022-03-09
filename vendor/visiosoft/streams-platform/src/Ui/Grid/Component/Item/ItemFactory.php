<?php namespace Anomaly\Streams\Platform\Ui\Grid\Component\Item;

use Anomaly\Streams\Platform\Support\Hydrator;
use Anomaly\Streams\Platform\Ui\Grid\Component\Item\Contract\ItemInterface;
use Illuminate\Contracts\Container\Container;

/**
 * Class ItemFactory
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ItemFactory
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
     * Create a new ItemFactory instance.
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
     * Make an item.
     *
     * @param  array         $parameters
     * @return ItemInterface
     */
    public function make(array $parameters)
    {
        $item = $this->container->make(Item::class, $parameters);

        $this->hydrator->hydrate($item, $parameters);

        return $item;
    }
}
