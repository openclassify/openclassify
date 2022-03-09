<?php namespace Anomaly\Streams\Platform\Ui\Form\Component\Button;

use Anomaly\Streams\Platform\Support\Evaluator;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class ButtonEvaluator
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
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
     * Evaluate the form buttons.
     *
     * @param FormBuilder $builder
     */
    public function evaluate(FormBuilder $builder)
    {
        $entry = $builder->getFormEntry();

        $builder->setButtons($this->evaluator->evaluate($builder->getButtons(), compact('builder', 'entry')));
    }
}
