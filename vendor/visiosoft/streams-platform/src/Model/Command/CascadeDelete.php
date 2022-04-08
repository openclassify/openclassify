<?php

namespace Anomaly\Streams\Platform\Model\Command;

use Anomaly\Streams\Platform\Model\EloquentCollection;
use Anomaly\Streams\Platform\Model\EloquentModel;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * Class CascadeDelete
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class CascadeDelete
{

    /**
     * The eloquent model.
     *
     * @var EloquentModel
     */
    protected $model;

    /**
     * Create a new CascadeDelete instance.
     *
     * @param EloquentModel $model
     */
    public function __construct(EloquentModel $model)
    {
        $this->model = $model;
    }

    /**
     * Handle the command.
     */
    public function handle()
    {
        $action = $this->model->isForceDeleting() ? 'forceDelete' : 'delete';

        /**
         * If the model itself can not be trashed
         * then we have no reason to keep any
         * relations that cascade.
         */
        if (!method_exists($this->model, 'restore')) {
            $action = 'forceDelete';
        }

        foreach ($this->model->getCascades() as $relation) {

            /* @var Relation $relation */
            $relation = $this->model->{$relation}();

            if ($action == 'forceDelete' && method_exists($relation, 'withTrashed')) {
                $relation = $relation->withTrashed();
            }

            $relation = $relation->getResults();

            if ($relation instanceof EloquentModel) {
                $relation->{$action}();
            }

            if ($relation instanceof EloquentCollection) {

                $relation->each(
                    function (EloquentModel $item) use ($action) {
                        $item->{$action}();
                    }
                );
            }
        }
    }
}
