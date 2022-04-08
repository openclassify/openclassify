<?php namespace Anomaly\Streams\Platform\Model;

use Anomaly\Streams\Platform\Model\Command\CascadeDelete;
use Anomaly\Streams\Platform\Model\Command\CascadeRestore;
use Anomaly\Streams\Platform\Model\Command\RestrictDelete;
use Anomaly\Streams\Platform\Model\Event\ModelsWereDeleted;
use Anomaly\Streams\Platform\Model\Event\ModelsWereUpdated;
use Anomaly\Streams\Platform\Model\Event\ModelWasCreated;
use Anomaly\Streams\Platform\Model\Event\ModelWasDeleted;
use Anomaly\Streams\Platform\Model\Event\ModelWasRestored;
use Anomaly\Streams\Platform\Model\Event\ModelWasSaved;
use Anomaly\Streams\Platform\Model\Event\ModelWasUpdated;
use Anomaly\Streams\Platform\Support\Observer;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EloquentObserver
 *
 * @link    http://pyrocms.com/
 * @author  PyroCMS, Inc. <support@pyrocms.com>
 * @author  Ryan Thompson <ryan@pyrocms.com>
 */
class EloquentObserver extends Observer
{

    /**
     * Run after a record is created.
     *
     * @param EloquentModel $model
     */
    public function creating(EloquentModel $model)
    {
        //
    }

    /**
     * Run after a record is created.
     *
     * @param EloquentModel $model
     */
    public function created(EloquentModel $model)
    {
        $model->flushCache();

        $this->events->dispatch(new ModelWasCreated($model));
    }

    /**
     * Run after saving a record.
     *
     * @param EloquentModel $model
     */
    public function saved(EloquentModel $model)
    {
        $model->flushCache();

        $this->events->dispatch(new ModelWasSaved($model));
    }

    /**
     * Run after a record has been updated.
     *
     * @param EloquentModel $model
     */
    public function updated(EloquentModel $model)
    {
        $model->flushCache();

        $this->events->dispatch(new ModelWasUpdated($model));
    }

    /**
     * Run after multiple records have been updated.
     *
     * @param EloquentModel $model
     */
    public function updatedMultiple(EloquentModel $model)
    {
        $model->flushCache();

        $this->events->dispatch(new ModelsWereUpdated($model));
    }

    /**
     * Run before a record is deleted.
     *
     * @param  EloquentModel $entry
     * @return bool
     */
    public function deleting(EloquentModel $entry)
    {
        if ($this->dispatchNow(new RestrictDelete($entry))) {
            return false;
        }

        $this->dispatchNow(new CascadeDelete($entry));

        return true;
    }

    /**
     * Run after a record has been deleted.
     *
     * @param EloquentModel $model
     */
    public function deleted(EloquentModel $model)
    {
        $model->flushCache();

        /* @var Model $translation */
        if ($model->isTranslatable()) {
            foreach ($model->translations as $translation) {
                $translation->delete();
            }
        }

        $this->events->dispatch(new ModelWasDeleted($model));
    }

    /**
     * Run after multiple records have been deleted.
     *
     * @param EloquentModel $model
     */
    public function deletedMultiple(EloquentModel $model)
    {
        $model->flushCache();

        $this->events->dispatch(new ModelsWereDeleted($model));
    }

    /**
     * Fired just before restoring.
     *
     * @param EloquentModel $model
     */
    public function restoring(EloquentModel $model)
    {
        //
    }

    /**
     * Run after a record has been restored.
     *
     * @param EloquentModel $model
     */
    public function restored(EloquentModel $model)
    {
        $model->flushCache();

        $this->dispatchNow(new CascadeRestore($model));

        $this->events->dispatch(new ModelWasRestored($model));
    }
}
