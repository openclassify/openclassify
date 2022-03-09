<?php namespace Anomaly\Streams\Platform\Ui\Form;

use Illuminate\Support\Collection;

/**
 * Class FormCollection
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class FormCollection extends Collection
{

    /**
     * Return only locked forms.
     *
     * @return $this
     */
    public function locked()
    {
        return $this->filter(
            function (FormBuilder $form) {
                return $form->isLocked();
            }
        );
    }
}
