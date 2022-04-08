<?php namespace Anomaly\Streams\Platform\Entry;

use Anomaly\Streams\Platform\Support\Hydrator;
use Anomaly\Streams\Platform\Traits\FiresCallbacks;
use Illuminate\Contracts\Container\Container;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class EntryFactory
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class EntryFactory
{

    use DispatchesJobs;
    use FiresCallbacks;

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
     * Create a new EntryFactory instance.
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
     * Make a new EntryBuilder instance.
     *
     * @param                     $namespace
     * @param                     $stream
     * @param  string             $method
     * @return EntryCriteria|null
     */
    public function make($namespace, $stream, $method = 'get')
    {
        $stream    = ucfirst(camel_case($stream));
        $namespace = ucfirst(camel_case($namespace));

        if (!class_exists(
            $model = 'Anomaly\Streams\Platform\Model\\' . $namespace . '\\' . $namespace . $stream . 'EntryModel'
        )
        ) {
            return null;
        }

        /* @var EntryModel $model */
        $model = $this->container->make($model);

        return $this->container->make(
            $model->getCriteriaName(),
            [
                'query'  => $model->newQuery(),
                'stream' => $model->getStream(),
                'method' => $method,
            ]
        );
    }
}
