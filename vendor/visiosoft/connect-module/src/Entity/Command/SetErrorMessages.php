<?php namespace Anomaly\Streams\Platform\Ui\Entity\Command;

use Anomaly\Streams\Platform\Message\MessageBag;
use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;


/**
 * Class SetErrorMessages
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Command
 */
class SetErrorMessages
{

    /**
     * The entity builder.
     *
     * @var EntityBuilder
     */
    protected $builder;

    /**
     * Create a new SetErrorMessages instance.
     *
     * @param EntityBuilder $builder
     */
    public function __construct(EntityBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command.
     *
     * @param MessageBag $messages
     */
    public function handle(MessageBag $messages)
    {
        if ($this->builder->isAjax()) {
            return;
        }

        $errors = $this->builder->getEntityErrors();

        $messages->error($errors->all());
    }
}
