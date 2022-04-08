<?php namespace Anomaly\Streams\Platform\Ui\Entity\Multiple\Command;

use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;
use Anomaly\Streams\Platform\Ui\Entity\Multiple\MultipleEntityBuilder;
use Illuminate\Support\MessageBag;

/**
 * Class HandleErrors
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Multiple\Command
 */
class HandleErrors
{

    /**
     * The multiple entity builder.
     *
     * @var MultipleEntityBuilder
     */
    protected $builder;

    /**
     * Create a new HandleErrors instance.
     *
     * @param MultipleEntityBuilder $builder
     */
    public function __construct(MultipleEntityBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command.
     */
    public function handle()
    {
        /* @var EntityBuilder $builder */
        foreach ($this->builder->getEntities() as $builder) {
            if ($builder->hasEntityErrors()) {

                // We can't save now!
                $this->builder->setSave(false);

                /**
                 * Merge errors from child entities into the
                 * multiple entity builder's entity instance.
                 */
                $this->mergeErrors($builder->getEntityErrors());
            }
        }
    }

    /**
     * Merge the errors into the multiple entity builder.
     *
     * @param MessageBag $errors
     */
    protected function mergeErrors(MessageBag $errors)
    {
        foreach ($errors->all() as $field => $message) {
            $this->builder->addEntityError($field, $message);
        }
    }
}
