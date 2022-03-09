<?php namespace Anomaly\Streams\Platform\Ui\Form\Component\Action;

use Anomaly\Streams\Platform\Ui\Form\Component\Action\Predict\SaveEditNextPredictor;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class ActionPredictor
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ActionPredictor
{

    /**
     * The save and edit next predictor.
     *
     * @var SaveEditNextPredictor
     */
    protected $saveAndEditNext;

    /**
     * Create a new ActionPredictor instance.
     *
     * @param SaveEditNextPredictor $saveAndEditNext
     */
    public function __construct(SaveEditNextPredictor $saveAndEditNext)
    {
        $this->saveAndEditNext = $saveAndEditNext;
    }

    /**
     * Predict some intelligent actions.
     *
     * @param FormBuilder $builder
     */
    public function predict(FormBuilder $builder)
    {
        $this->saveAndEditNext->predict($builder);
    }
}
