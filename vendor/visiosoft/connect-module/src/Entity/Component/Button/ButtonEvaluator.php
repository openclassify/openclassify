<?php namespace Anomaly\Streams\Platform\Ui\Entity\Component\Button;

use Anomaly\Streams\Platform\Support\Evaluator;
use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;

/**
 * Class ButtonEvaluator
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Component\Button
 */
class ButtonEvaluator
{

    /**
     * The evaluator utility.
     *
     * @var Evaluator
     */
    protected $evaluator;

    /**
     * Create a new ButtonEvaluator instance.
     *
     * @param Evaluator $evaluator
     */
    public function __construct(Evaluator $evaluator)
    {
        $this->evaluator = $evaluator;
    }

    /**
     * Evaluate the entity buttons.
     *
     * @param EntityBuilder $builder
     */
    public function evaluate(EntityBuilder $builder)
    {
        $entry = $builder->getEntityEntry();

        $builder->setButtons($this->evaluator->evaluate($builder->getButtons(), compact('builder', 'entry')));
    }
}
