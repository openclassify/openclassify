<?php namespace Anomaly\UsersModule\Assignment;

use Anomaly\Streams\Platform\Assignment\Contract\AssignmentInterface;
use Anomaly\Streams\Platform\Model\EloquentModel;

/**
 * Class AssignmentObserver
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AssignmentObserver extends \Anomaly\Streams\Platform\Assignment\AssignmentObserver
{

    /**
     * Fire after the assignment is deleted.
     *
     * @param AssignmentInterface $model
     */
    public function deleted(AssignmentInterface $model)
    {
        /* @var EloquentModel $field */
        if ($field = $model->getField()) {
            $field->delete();
        }

        parent::deleted($model);
    }

}
