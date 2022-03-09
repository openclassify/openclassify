<?php namespace Anomaly\Streams\Platform\Ui\Entity\Component\Action;

use Anomaly\Streams\Platform\Ui\Entity\Component\Action\Predict\SaveAndEditNextPredictor;
use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;

/**
 * Class ActionPredictor
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Component\Action
 */
class ActionPredictor
{

    /**
     * The save and edit next predictor.
     *
     * @var SaveAndEditNextPredictor
     */
    protected $saveAndEditNext;

    /**
     * Create a new ActionPredictor instance.
     *
     * @param SaveAndEditNextPredictor $saveAndEditNext
     */
    function __construct(SaveAndEditNextPredictor $saveAndEditNext)
    {
        $this->saveAndEditNext = $saveAndEditNext;
    }

    /**
     * Predict some intelligent actions.
     *
     * @param EntityBuilder $builder
     */
    public function predict(EntityBuilder $builder)
    {
        $this->saveAndEditNext->predict($builder);
    }
}
