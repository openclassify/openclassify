<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\Header;

use Anomaly\Streams\Platform\Support\Hydrator;
use Anomaly\Streams\Platform\Ui\Table\Component\Header\Contract\HeaderInterface;
use Illuminate\Contracts\Container\Container;

/**
 * Class HeaderFactory
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class HeaderFactory
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
     * Create a new HeaderFactory instance.
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
     * Make a header.
     *
     * @param  array           $parameters
     * @return HeaderInterface
     */
    public function make(array $parameters)
    {
        $header = $this->container->make(Header::class, $parameters);

        $this->hydrator->hydrate($header, $parameters);

        return $header;
    }
}
