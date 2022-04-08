<?php namespace Anomaly\Streams\Platform\Ui\Entity\Command;

use Anomaly\Streams\Platform\Entry\EntryEntityRepository;
use Anomaly\Streams\Platform\Entry\EntryModel;
use Anomaly\Streams\Platform\Model\EloquentEntityRepository;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Anomaly\Streams\Platform\Ui\Entity\EntityBuilder;
use Illuminate\Contracts\Container\Container;

/**
 * Class SetRepository
 *

 * @package Anomaly\Streams\Platform\Ui\Entity\Command
 */
class SetRepository
{

    /**
     * The entity builder.
     *
     * @var EntityBuilder
     */
    protected $builder;

    /**
     * Create a new SetRepository instance.
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
     * @param Container $container
     */
    public function handle(Container $container)
    {
        /**
         * Set the default options handler based
         * on the builder class. Defaulting to
         * no handler.
         */
        if (!$this->builder->getRepository()) {

            $model  = $this->builder->getEntityModel();
            $entity = $this->builder->getEntity();

            $repository = str_replace('EntityBuilder', 'EntityRepository', get_class($this->builder));

            if (!$this->builder->getRepository() && class_exists($repository)) {
                $this->builder->setRepository($container->make($repository, compact('entity', 'model')));
            } elseif (!$this->builder->getRepository() && $model instanceof EntryModel) {
                $this->builder->setRepository(
                    $container->make(EntryEntityRepository::class, compact('entity', 'model'))
                );
            } elseif (!$this->builder->getRepository() && $model instanceof EloquentModel) {
                $this->builder->setRepository(
                    $container->make(EloquentEntityRepository::class, compact('entity', 'model'))
                );
            }
        }
    }
}
