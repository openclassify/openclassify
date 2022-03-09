<?php namespace Visiosoft\ConnectModule\Resource\Command;

use Anomaly\Streams\Platform\Support\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Visiosoft\ConnectModule\Resource\Contract\ResourceRepositoryInterface;
use Visiosoft\ConnectModule\Resource\ResourceBuilder;
use Anomaly\Streams\Platform\Model\EloquentCollection;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Anomaly\Streams\Platform\Support\Evaluator;


/**
 * Class GetResourceEntries
 *
 * @package       Visiosoft\ConnectModule\Resource\Command
 */
class GetResourceEntries
{

    /**
     * The resource builder.
     *
     * @var ResourceBuilder
     */
    protected $builder;

    /**
     * Create a new BuildResourceFormattersCommand instance.
     *
     * @param ResourceBuilder $builder
     */
    public function __construct(ResourceBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command.
     */
    public function handle(Evaluator $evaluator)
    {
        $model = $this->builder->getModel();
        $entries = $this->builder->getEntries();
        $search_type = $this->builder->getResourceOption('search_type', null);

        /**
         * If the builder has an entries handler
         * then call it through the container and
         * let it load the entries itself.
         */
        if (is_string($entries) || $entries instanceof \Closure) {
            app()->call($entries, ['builder' => $this->builder]);
        }

        $entries = $this->builder->getResourceEntries();

        /**
         * If the entries have already been set on the
         * resource then return. Nothing to do here.
         *
         * If the model is not set then they need
         * to load the resource entries themselves.
         */
        if (!$entries->isEmpty() || !$model) {
            return;
        }

        /**
         * Resolve the model out of the container.
         */
        $repository = $this->builder->getRepository();


        /**
         * If the repository is an instance of
         * ResourceRepositoryInterface use it.
         */
        if ($repository instanceof ResourceRepositoryInterface) {

            if ($this->builder->getFunction()) {

                $entries = $repository->getRepositoryEntries($this->builder);

            } else {

                $entries = $repository->get($this->builder);

            }

        }

        if ($entries instanceof EloquentModel) {
            $entries = $entries->newCollection([$entries]);
        }

        if ($entries instanceof BelongsToMany) {
            $entries = $entries->get();
        }

        if (!$entries) {
            $entries = new Collection();
        }


        /**
         * Traverse the resource if a map is present.
         */
        if ($map = $this->builder->getResourceOption('map')) {

            $map = explode('/', $map);

            $entries = $evaluator->evaluate(
                'entry.' . str_replace('/', '.', implode('.', $map)),
                ['entry' => $entries->first()]
            );

            if ($entries instanceof EloquentModel) {
                $entries = $entries->newCollection([$entries]);
            }

            if ($entries instanceof EloquentCollection) {
                $this->builder->setId(null);
            }
        }

        $this->builder->setResourceEntries($entries);
    }
}
