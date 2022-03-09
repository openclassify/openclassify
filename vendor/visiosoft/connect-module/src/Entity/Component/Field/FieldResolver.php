<?php namespace Anomaly\Streams\Platform\Ui\Entity\Component\Field;

use Anomaly\Streams\Platform\Support\Resolver;
use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;

/**
 * Class FieldResolver
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Component\View
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
     * Resolve entity fields.
     *
     * @param EntityBuilder $builder
     */
    public function resolve(EntityBuilder $builder)
    {
        $this->resolver->resolve($builder->getFields(), compact('builder'));
    }
}
