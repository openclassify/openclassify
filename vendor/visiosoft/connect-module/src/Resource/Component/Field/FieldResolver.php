<?php namespace Visiosoft\ConnectModule\Resource\Component\Field;

use Visiosoft\ConnectModule\Resource\ResourceBuilder;
use Anomaly\Streams\Platform\Support\Resolver;

/**
 * Class FieldResolver
 *

 * @package       Visiosoft\ConnectModule\Resource\Component\View
 */
class FieldResolver
{

    /**
     * The resolver utility.
     *
     * @var Resolver
     */
    protected $resolver;

    /**
     * Create a new FieldResolver instance.
     *
     * @param Resolver $resolver
     */
    public function __construct(Resolver $resolver)
    {
        $this->resolver = $resolver;
    }

    /**
     * Resolve resource views.
     *
     * @param ResourceBuilder $builder
     */
    public function resolve(ResourceBuilder $builder)
    {
        $this->resolver->resolve($builder->getFields(), compact('builder'));
    }
}
