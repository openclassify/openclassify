<?php namespace Visiosoft\ConnectModule\Resource\Component\Formatter;

use Visiosoft\ConnectModule\Resource\ResourceBuilder;
use Anomaly\Streams\Platform\Support\Resolver;

/**
 * Class FormatterResolver
 *

 * @package       Visiosoft\ConnectModule\Resource\Component\View
 */
class FormatterResolver
{

    /**
     * The resolver utility.
     *
     * @var Resolver
     */
    protected $resolver;

    /**
     * Create a new FormatterResolver instance.
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
        $this->resolver->resolve($builder->getFormatters(), compact('builder'));
    }
}
