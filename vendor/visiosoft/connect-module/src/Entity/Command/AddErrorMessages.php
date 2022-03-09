<?php namespace Anomaly\Streams\Platform\Ui\Entity\Command;

use Anomaly\Streams\Platform\Message\MessageBag;
use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;

/**
 * Class AddErrorMessages
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Command
 */
class AddErrorMessages
{

    /**
     * The entity builder.
     *
     * @var EntityBuilder
     */
    protected $builder;

    /**
     * Create a new AddErrorMessages instance.
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
        $entity = $this->builder->getEntity();

        $errors = $entity->getErrors();

        if ($errors instanceof \Illuminate\Support\MessageBag) {
            $messages->error($errors->all());
        }
    }
}
