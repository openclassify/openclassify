<?php namespace Anomaly\Streams\Platform\Assignment;

use Anomaly\Streams\Platform\Assignment\Command\RestoreAssignmentIndexes;
use Anomaly\Streams\Platform\Assignment\Event\AssignmentWasSaved;
use Anomaly\Streams\Platform\Assignment\Event\AssignmentWasUpdated;
use Anomaly\Streams\Platform\Assignment\Event\AssignmentWasCreated;
use Anomaly\Streams\Platform\Assignment\Event\AssignmentWasDeleted;
use Anomaly\Streams\Platform\Assignment\Command\AddAssignmentColumn;
use Anomaly\Streams\Platform\Assignment\Contract\AssignmentInterface;
use Anomaly\Streams\Platform\Assignment\Command\BackupAssignmentData;
use Anomaly\Streams\Platform\Assignment\Command\DropAssignmentColumn;
use Anomaly\Streams\Platform\Assignment\Command\MoveAssignmentColumn;
use Anomaly\Streams\Platform\Assignment\Command\RestoreAssignmentData;
use Anomaly\Streams\Platform\Assignment\Command\UpdateAssignmentColumn;
use Anomaly\Streams\Platform\Assignment\Command\DeleteAssignmentTranslations;
use Anomaly\Streams\Platform\Support\Observer;

/**
 * Class AssignmentObserver
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class AssignmentObserver extends Observer
{

    /**
     * Fired before creating an assignment.
     *
     * @param AssignmentInterface|AssignmentModel $model
     */
    public function creating(AssignmentInterface $model)
    {
        $model->sort_order = $model->newQuery()->count('id') + 1;
    }

    /**
     * Run after a record is created.
     *
     * @param AssignmentInterface $model
     */
    public function created(AssignmentInterface $model)
    {
        $model->flushCache();
        $model->compileStream();

        $this->dispatchNow(new AddAssignmentColumn($model));

        $this->events->dispatch(new AssignmentWasCreated($model));
    }

    /**
     * Run before a record is updated.
     *
     * @param AssignmentInterface $model
     */
    public function updating(AssignmentInterface $model)
    {
        $this->dispatchNow(new BackupAssignmentData($model));
        $this->dispatchNow(new MoveAssignmentColumn($model));
        $this->dispatchNow(new RestoreAssignmentData($model));
        $this->dispatchNow(new RestoreAssignmentIndexes($model));
    }

    /**
     * Run after a record is updated.
     *
     * @param AssignmentInterface $model
     */
    public function updated(AssignmentInterface $model)
    {
        $model->flushCache();
        $model->compileStream();

        $this->dispatchNow(new UpdateAssignmentColumn($model));

        $this->events->dispatch(new AssignmentWasUpdated($model));
    }

    /**
     * Run after saving a record.
     *
     * @param AssignmentInterface $model
     */
    public function saved(AssignmentInterface $model)
    {
        $model->flushCache();
        $model->compileStream();

        $this->events->dispatch(new AssignmentWasSaved($model));
    }

    /**
     * Run after a record has been deleted.
     *
     * @param AssignmentInterface $model
     */
    public function deleted(AssignmentInterface $model)
    {
        $model->flushCache();
        $model->compileStream();

        $this->dispatchNow(new DropAssignmentColumn($model));
        $this->dispatchNow(new DeleteAssignmentTranslations($model));

        $this->events->dispatch(new AssignmentWasDeleted($model));
    }
}
