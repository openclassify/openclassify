<?php namespace Anomaly\Streams\Platform\Ui\Form;

/**
 * Class FormHandler
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class FormHandler
{

    /**
     * Handle the form.
     *
     * @param FormBuilder $builder
     */
    public function handle(FormBuilder $builder)
    {
        if (!$builder->canSave()) {
            return;
        }

        $builder->saveForm();
    }
}
