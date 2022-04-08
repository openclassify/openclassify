<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\Action;

use Anomaly\Streams\Platform\Support\Hydrator;
use Anomaly\Streams\Platform\Support\Translator;
use Anomaly\Streams\Platform\Ui\Table\Component\Action\Contract\ActionInterface;

/**
 * Class ActionFactory
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ActionFactory
{

    /**
     * The default action.
     *
     * @var string
     */
    protected $action = Action::class;

    /**
     * The translator utility.
     *
     * @var Translator
     */
    protected $translator;

    /**
     * The hydrator utility.
     *
     * @var Hydrator
     */
    protected $hydrator;

    /**
     * Create a new ActionFactory instance.
     *
     * @param Hydrator   $hydrator
     * @param Translator $translator
     */
    public function __construct(Hydrator $hydrator, Translator $translator)
    {
        $this->hydrator   = $hydrator;
        $this->translator = $translator;
    }

    /**
     * Make an action.
     *
     * @param  array           $parameters
     * @return ActionInterface
     */
    public function make(array $parameters)
    {
        $parameters = $this->translator->translate($parameters);

        $this->hydrator->hydrate(
            $action = app()->make(array_get($parameters, 'action', $this->action), $parameters),
            $parameters
        );

        return $action;
    }
}
