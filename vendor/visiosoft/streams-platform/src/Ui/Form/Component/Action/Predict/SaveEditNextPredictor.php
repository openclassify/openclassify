<?php namespace Anomaly\Streams\Platform\Ui\Form\Component\Action\Predict;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class SaveEditNextPredictor
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class SaveEditNextPredictor
{

    /**
     * Predict if the save_and_edit_next action
     * should be included.
     *
     * @param FormBuilder $builder
     */
    public function predict(FormBuilder $builder)
    {
        if (array_filter(explode(',', $builder->getRequestValue('edit_next')))) {
            $builder->setActions(array_merge(['save_edit_next'], $builder->getActions()));
        }
    }
}
