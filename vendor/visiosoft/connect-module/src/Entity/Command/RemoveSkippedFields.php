<?php namespace Anomaly\Streams\Platform\Ui\Entity\Command;

use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;


/**
 * Class RemoveSkippedFields
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Command
 */
class RemoveSkippedFields
{

    /**
     * The entity builder.
     *
     * @var EntityBuilder
     */
    protected $builder;

    /**
     * Create a new RemoveSkippedFields instance.
     *
     * @param EntityBuilder $builder
     */
    public function __construct(EntityBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command.
     */
    public function handle()
    {
        if (!$this->builder->canSave()) {
            return;
        }

        $entity = $this->builder->getEntity();

        foreach ($this->builder->getSkips() as $fieldSlug) {
            $entity->removeField($fieldSlug);
        }
    }
}
