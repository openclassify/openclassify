<?php namespace Anomaly\Streams\Platform\Ui\Entity\Component\Action;

use Anomaly\Streams\Platform\Support\Resolver;
use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;

/**
 * Class ActionResolver
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Component\View
 */
class ActionResolver
{

    /**
     * The resolver utility.
     *
     * @var Resolver
     */
    protected $resolver;

    /**
     * Create a new ActionResolver instance.
     *
     * @param Resolver $resolver
     */
    public function __construct(Resolver $resolver)
    {
        $this->resolver = $resolver;
    }

    /**
     * Resolve entity actions.
     *
     * @param EntityBuilder $builder
     */
    public function resolve(EntityBuilder $builder)
    {
        $this->resolver->resolve($builder->getActions(), compact('builder'));
    }
}
