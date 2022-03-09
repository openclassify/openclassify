<?php namespace Anomaly\Streams\Platform\Ui\Form\Component\Action;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class ActionDefaults
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ActionDefaults
{

    /**
     * Default the form actions when none are defined.
     *
     * @param FormBuilder $builder
     */
    public function defaults(FormBuilder $builder)
    {
        if ($builder->getActions() === []) {
            if ($builder->getFormMode() == 'create') {
                $builder->setActions(
                    [
                        'save',
                        'save_create',
                    ]
                );
            } else {
                $builder->setActions(
                    [
                        'update',
                        'save_exit',
                    ]
                );
            }
        }
    }
}
