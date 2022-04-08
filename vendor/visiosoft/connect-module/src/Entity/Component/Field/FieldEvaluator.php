<?php namespace Anomaly\Streams\Platform\Ui\Entity\Component\Field;

use Anomaly\Streams\Platform\Support\Evaluator;
use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;

/**
 * Class FieldEvaluator
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Component\Field
 */
class FieldEvaluator
{

    /**
     * The evaluator utility.
     *
     * @var Evaluator
     */
    protected $evaluator;

    /**
     * Create a new FieldEvaluator instance.
     *
     * @param Evaluator $evaluator
     */
    public function __construct(Evaluator $evaluator)
    {
        $this->evaluator = $evaluator;
    }

    /**
     * Evaluate the entity fields.
     *
     * @param EntityBuilder $builder
     */
    public function evaluate(EntityBuilder $builder)
    {
        $builder->setFields($this->evaluator->evaluate($builder->getFields(), compact('builder')));
    }
}
