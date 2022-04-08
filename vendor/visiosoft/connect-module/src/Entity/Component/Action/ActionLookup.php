<?php namespace Anomaly\Streams\Platform\Ui\Entity\Component\Action;

use Anomaly\Streams\Platform\Ui\Button\ButtonRegistry;
use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;

/**
 * Class ActionLookup
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Component\Action
 */
class ActionLookup
{

    /**
     * The action registry.
     *
     * @var ActionRegistry
     */
    protected $actions;

    /**
     * The button registry.
     *
     * @var ButtonRegistry
     */
    protected $buttons;

    /**
     * Create a new ActionFactory instance.
     *
     * @param ActionRegistry $actions
     * @param ButtonRegistry $buttons
     */
    function __construct(ActionRegistry $actions, ButtonRegistry $buttons)
    {
        $this->actions = $actions;
        $this->buttons = $buttons;
    }

    /**
     * Merge in registered properties.
     *
     * @param EntityBuilder $builder
     */
    public function merge(EntityBuilder $builder)
    {
        $actions = $builder->getActions();

        foreach ($actions as &$parameters) {

            $action = $original = array_pull($parameters, 'action');

            if ($action && $action = $this->actions->get($action)) {
                $parameters = array_replace_recursive($action, array_except($parameters, 'action'));
            }

            $button = array_get($parameters, 'button', $original);

            if ($button && $button = $this->buttons->get($button)) {
                $parameters = array_replace_recursive($button, array_except($parameters, 'button'));
            }
        }

        $builder->setActions($actions);
    }
}
