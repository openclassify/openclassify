<?php namespace Anomaly\Streams\Platform\Model\Event;

use Anomaly\Streams\Platform\Model\EloquentModel;

/**
 * Class ModelsWereUpdated
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ModelsWereUpdated
{

    /**
     * The model object.
     *
     * @var EloquentModel
     */
    protected $model;

    /**
     * Create a new ModelsWereUpdated instance.
     *
     * @param EloquentModel $model
     */
    public function __construct(EloquentModel $model)
    {
        $this->model = $model;
    }

    /**
     * Get the model object.
     *
     * @return EloquentModel
     */
    public function getModel()
    {
        return $this->model;
    }
}
