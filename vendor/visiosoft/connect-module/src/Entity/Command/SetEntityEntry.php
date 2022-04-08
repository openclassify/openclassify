<?php namespace Anomaly\Streams\Platform\Ui\Entity\Command;

use Anomaly\Streams\Platform\Ui\Entity\Contract\EntityRepositoryInterface;
use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;


/**
 * Class SetEntityEntry
 *

 * @package Anomaly\Streams\Platform\Ui\Entity\Command
 */
class SetEntityEntry
{

    /**
     * The entity builder.
     *
     * @var \Anomaly\Streams\Platform\Ui\Entity\EntityBuilder
     */
    protected $builder;

    /**
     * Create a new BuildEntityColumnsCommand instance.
     *
     * @param EntityBuilder $builder
     */
    public function __construct(EntityBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Set the entity model object from the builder's model.
     */
    public function handle()
    {
        $entry      = $this->builder->getEntry();
        $repository = $this->builder->getRepository();

        /**
         * If the entry is null or an ID and the
         * model is an instance of EntityModelInterface
         * then use the model to fetch the entry
         * or create a new one.
         */
        if (is_numeric($entry) || $entry === null) {
            if ($repository instanceof EntityRepositoryInterface) {

                $this->builder->setEntityEntry($repository->findOrNew($entry));

                return;
            }
        }

        /**
         * If the entry is a plain 'ole
         * object  then just use it as is.
         */
        if (is_object($entry)) {

            $this->builder->setEntityEntry($entry);

            return;
        }

        /**
         * Whatever it is - just use it.
         */
        $this->builder->setEntityEntry($entry);
    }
}
