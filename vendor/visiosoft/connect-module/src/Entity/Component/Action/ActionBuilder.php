<?php namespace Anomaly\Streams\Platform\Ui\Entity\Component\Action;

use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;

/**
 * Class ActionBuilder
 *

 * @package Anomaly\Streams\Platform\Ui\Entity\Component\Action
 */
class ActionBuilder
{

    /**
     * The action reader.
     *
     * @var ActionInput
     */
    protected $input;

    /**
     * The action factory.
     *
     * @var ActionFactory
     */
    protected $factory;

    /**
     * Create a new ActionBuilder instance.
     *
     * @param ActionInput   $input
     * @param ActionFactory $factory
     */
    public function __construct(ActionInput $input, ActionFactory $factory)
    {
        $this->input   = $input;
        $this->factory = $factory;
    }

    /**
     * Build the actions.
     *
     * @param EntityBuilder $builder
     */
    public function build(EntityBuilder $builder)
    {
        $entity = $builder->getEntity();

        $this->input->read($builder);

        foreach ($builder->getActions() as $action) {
            if (array_get($action, 'enabled', true)) {
                $entity->addAction($this->factory->make($action));
            }
        }
    }
}
