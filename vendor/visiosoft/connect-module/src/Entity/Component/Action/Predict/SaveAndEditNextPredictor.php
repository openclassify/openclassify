<?php namespace Anomaly\Streams\Platform\Ui\Entity\Component\Action\Predict;

use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;

/**
 * Class SaveAndEditNextPredictor
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Component\Action\Predict
 */
class SaveAndEditNextPredictor
{

    /**
     * Predict if the save_and_edit_next action
     * should be included.
     *
     * @param EntityBuilder $builder
     */
    public function predict(EntityBuilder $builder)
    {
        if (array_filter(explode(',', $builder->getRequestValue('edit_next')))) {
            $builder->setActions(array_merge(['save_and_edit_next'], $builder->getActions()));
        }
    }
}
