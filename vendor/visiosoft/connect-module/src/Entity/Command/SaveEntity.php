<?php namespace Anomaly\Streams\Platform\Ui\Entity\Command;

use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;


/**
 * Class SaveEntity
 *

 * @package       Anomaly\Streams\Platform\Ui\Entity\Command
 */
class SaveEntity
{

    /**
     * The entity builder.
     *
     * @var EntityBuilder
     */
    protected $builder;

    /**
     * Create a new SaveEntity instance.
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
        $this->builder->fire('saving', ['builder' => $this->builder]);
        $this->builder->fireFieldEvents('entity_saving');

        $repository = $this->builder->getRepository();

        $repository->save($this->builder);

        $this->builder->fire('saved', ['builder' => $this->builder]);
        $this->builder->fireFieldEvents('entity_saved');
    }
}
