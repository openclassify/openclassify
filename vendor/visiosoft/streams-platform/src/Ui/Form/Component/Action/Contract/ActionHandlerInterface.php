<?php namespace Anomaly\Streams\Platform\Ui\Form\Component\Action\Contract;

use Anomaly\Streams\Platform\Ui\Form\Form;

/**
 * Interface ActionHandlerInterface
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
interface ActionHandlerInterface
{

    /**
     * Handle the form response.
     *
     * @param Form $form
     */
    public function handle(Form $form);
}
