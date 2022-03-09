<?php namespace Anomaly\Streams\Platform\Ui\Entity\Component\Section;

use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;

/**
 * Class SectionInput
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Component\Section
 */
class SectionInput
{

    /**
     * The resolver utility.
     *
     * @var SectionResolver
     */
    protected $resolver;

    /**
     * The section evaluator.
     *
     * @var SectionEvaluator
     */
    protected $evaluator;

    /**
     * Create a new SectionInput instance.
     *
     * @param SectionResolver  $resolver
     * @param SectionEvaluator $evaluator
     */
    function __construct(SectionResolver $resolver, SectionEvaluator $evaluator)
    {
        $this->resolver  = $resolver;
        $this->evaluator = $evaluator;
    }

    /**
     * Read the entity section input.
     *
     * @param EntityBuilder $builder
     */
    public function read(EntityBuilder $builder)
    {
        $this->resolver->resolve($builder);
        $this->evaluator->evaluate($builder);
    }
}
