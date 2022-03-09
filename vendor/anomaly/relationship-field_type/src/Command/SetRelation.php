<?php namespace Anomaly\RelationshipFieldType\Command;

use Anomaly\RelationshipFieldType\RelationshipFieldType;
use Anomaly\Streams\Platform\Model\EloquentModel;

/**
 * Class SetRelation
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class SetRelation
{

    /**
     * The field type.
     *
     * @var RelationshipFieldType
     */
    protected $fieldType;

    /**
     * The related model.
     *
     * @var EloquentModel
     */
    protected $model;

    /**
     * Create a new SetRelation instance.
     *
     * @param RelationshipFieldType $fieldType
     * @param EloquentModel         $model
     */
    public function __construct(RelationshipFieldType $fieldType, EloquentModel $model)
    {
        $this->model     = $model;
        $this->fieldType = $fieldType;
    }

    /**
     * Hand the command.
     */
    public function handle()
    {
        if (!$entry = $this->fieldType->getEntry()) {
            return;
        }

        $entry->setRelation($this->fieldType->getField(), $this->model);
    }
}
