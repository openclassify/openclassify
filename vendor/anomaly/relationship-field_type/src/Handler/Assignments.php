<?php namespace Anomaly\RelationshipFieldType\Handler;

use Anomaly\RelationshipFieldType\RelationshipFieldType;

/**
 * Class Assignments
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class Assignments
{

    /**
     * Handle the options.
     *
     * @param  RelationshipFieldType $fieldType
     * @return array
     */
    public function handle(RelationshipFieldType $fieldType)
    {
        $model = $fieldType->getRelatedModel();

        $query = $model->newQuery();

        $fieldType->setOptions(
            $query->get()->pluck(
                $model->getTitleName(),
                $model->getKeyName()
            )->all()
        );
    }
}
