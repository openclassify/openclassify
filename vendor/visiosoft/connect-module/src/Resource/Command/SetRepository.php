<?php namespace Visiosoft\ConnectModule\Resource\Command;

use Visiosoft\ConnectModule\Resource\Repository\EloquentResourceRepository;
use Visiosoft\ConnectModule\Resource\Repository\EntryResourceRepository;
use Visiosoft\ConnectModule\Resource\ResourceBuilder;
use Anomaly\Streams\Platform\Entry\EntryModel;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Illuminate\Contracts\Container\Container;

/**
 * Class SetRepository
 *

 * @package Visiosoft\ConnectModule\Resource\Command
 */
class SetRepository
{

    /**
     * The resource builder.
     *
     * @var ResourceBuilder
     */
    protected $builder;

    /**
     * Create a new SetRepository instance.
     *
     * @param ResourceBuilder $builder
     */
    public function __construct(ResourceBuilder $builder)
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

            $model = $this->builder->getResourceModel();

            if (!$this->builder->getRepository() && $model instanceof EntryModel) {
                $this->builder->setRepository($container->make(EntryResourceRepository::class, compact('model')));
            } elseif (!$this->builder->getRepository() && $model instanceof EloquentModel) {
                $this->builder->setRepository($container->make(EloquentResourceRepository::class, compact('model')));
            }
        }
    }
}
