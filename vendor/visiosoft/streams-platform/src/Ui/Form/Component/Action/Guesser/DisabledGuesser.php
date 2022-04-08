<?php namespace Anomaly\Streams\Platform\Ui\Form\Component\Action\Guesser;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class DisabledGuesser
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class DisabledGuesser
{

    /**
     * Guess the action's enabled parameter.
     *
     * @param FormBuilder $builder
     */
    public function guess(FormBuilder $builder)
    {
        $actions = $builder->getActions();

        foreach ($actions as &$action) {

            if ($builder->isLocked()) {
                $action['disabled'] = true;
            }
        }

        $builder->setActions($actions);
    }
}
