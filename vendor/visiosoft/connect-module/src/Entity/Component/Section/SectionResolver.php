<?php namespace Anomaly\Streams\Platform\Ui\Entity\Component\Section;

use Anomaly\Streams\Platform\Support\Resolver;
use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;

/**
 * Class SectionResolver
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Component\Section
 */
class SectionResolver
{

    /**
     * The resolver utility.
     *
     * @var Resolver
     */
    protected $resolver;

    /**
     * Create a new SectionResolver instance.
     *
     * @param Resolver $resolver
     */
    public function __construct(Resolver $resolver)
    {
        $this->resolver = $resolver;
    }

    /**
     * Resolve the entity sections.
     *
     * @param EntityBuilder $builder
     */
    public function resolve(EntityBuilder $builder)
    {
        $this->resolver->resolve($builder->getSections(), compact('builder'));
    }
}
