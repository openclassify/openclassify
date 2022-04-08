<?php namespace Anomaly\Streams\Platform\Ui\Form\Component\Action;

use Anomaly\Streams\Platform\Ui\Form\Component\Action\Guesser\DisabledGuesser;
use Anomaly\Streams\Platform\Ui\Form\Component\Action\Guesser\EnabledGuesser;
use Anomaly\Streams\Platform\Ui\Form\Component\Action\Guesser\RedirectGuesser;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

/**
 * Class ActionGuesser
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ActionGuesser
{

    /**
     * The enabled guesser.
     *
     * @var EnabledGuesser
     */
    protected $enabled;

    /**
     * The disabled guesser.
     *
     * @var DisabledGuesser
     */
    protected $disabled;

    /**
     * The redirect guesser.
     *
     * @var RedirectGuesser
     */
    protected $redirect;

    /**
     * Create a new ActionGuesser instance.
     *
     * @param EnabledGuesser  $enabled
     * @param DisabledGuesser $disabled
     * @param RedirectGuesser $redirect
     */
    public function __construct(
        EnabledGuesser $enabled,
        DisabledGuesser $disabled,
        RedirectGuesser $redirect
    ) {
        $this->enabled  = $enabled;
        $this->disabled = $disabled;
        $this->redirect = $redirect;
    }

    /**
     * Guess action properties.
     *
     * @param FormBuilder $builder
     */
    public function guess(FormBuilder $builder)
    {
        $this->enabled->guess($builder);
        $this->disabled->guess($builder);
        $this->redirect->guess($builder);
    }
}
