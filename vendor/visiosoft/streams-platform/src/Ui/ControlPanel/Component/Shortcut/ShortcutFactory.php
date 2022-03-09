<?php namespace Anomaly\Streams\Platform\Ui\ControlPanel\Component\Shortcut;

use Anomaly\Streams\Platform\Support\Hydrator;
use Illuminate\Contracts\Container\Container;

/**
 * Class ShortcutFactory
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ShortcutFactory
{

    /**
     * The default shortcut class.
     *
     * @var string
     */
    protected $shortcut = Shortcut::class;

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
     * Create a new ShortcutFactory instance.
     *
     * @param Hydrator $hydrator
     */
    public function __construct(Hydrator $hydrator, Container $container)
    {
        $this->hydrator  = $hydrator;
        $this->container = $container;
    }

    /**
     * Make the shortcut from it's parameters.
     *
     * @param  array $parameters
     * @return mixed
     */
    public function make(array $parameters)
    {
        $shortcut = $this->container->make(array_get($parameters, 'shortcut', $this->shortcut), $parameters);

        $this->hydrator->hydrate($shortcut, $parameters);

        return $shortcut;
    }
}
