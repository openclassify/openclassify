<?php namespace Anomaly\Streams\Platform\Ui\Entity\Component\Section;

use Anomaly\Streams\Platform\Support\Evaluator;
use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;

/**
 * Class SectionEvaluator
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Component\Section
 */
class SectionEvaluator
{

    /**
     * The evaluator utility.
     *
     * @var Evaluator
     */
    protected $evaluator;

    /**
     * Create a new SectionEvaluator instance.
     *
     * @param Evaluator $evaluator
     */
    public function __construct(Evaluator $evaluator)
    {
        $this->evaluator = $evaluator;
    }

    /**
     * Evaluate the entity sections.
     *
     * @param EntityBuilder $builder
     */
    public function evaluate(EntityBuilder $builder)
    {
        $builder->setSections($this->evaluator->evaluate($builder->getSections(), compact('builder')));
    }
}
