<?php namespace Anomaly\Streams\Platform\Ui\Entity\Component\Action;

use Anomaly\Streams\Platform\Ui\Entity\Component\Action\Guesser\EnabledGuesser;
use Anomaly\Streams\Platform\Ui\Entity\Component\Action\Guesser\RedirectGuesser;
use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;

/**
 * Class ActionGuesser
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Component\Action
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
     * The redirect guesser.
     *
     * @var RedirectGuesser
     */
    protected $redirect;

    /**
     * Create a new ActionGuesser instance.
     *
     * @param EnabledGuesser  $enabled
     * @param RedirectGuesser $redirect
     */
    public function __construct(EnabledGuesser $enabled, RedirectGuesser $redirect)
    {
        $this->enabled  = $enabled;
        $this->redirect = $redirect;
    }

    /**
     * Guess action properties.
     *
     * @param EntityBuilder $builder
     */
    public function guess(EntityBuilder $builder)
    {
        $this->enabled->guess($builder);
        $this->redirect->guess($builder);
    }
}
