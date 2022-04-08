<?php namespace Visiosoft\LocationModule\Country\Table\Handler;

use Anomaly\Streams\Platform\Model\EloquentModel;
use Anomaly\Streams\Platform\Ui\Table\Component\Action\ActionHandler;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;
use Visiosoft\LocationModule\Country\Events\DeletedCountry;


class Delete extends ActionHandler
{
    public function handle(TableBuilder $builder, array $selected)
    {
        $count = 0;

        $model = $builder->getTableModel();

        /* @var EloquentModel $entry */
        foreach ($selected as $id) {

            $entry = $model->find($id);

            $deletable = true;

            if ($entry instanceof EloquentModel) {
                $deletable = $entry->isDeletable();
            }

            if ($entry && $deletable && $entry->delete()) {
                $builder->fire('row_deleted', compact('builder', 'model', 'entry'));

                event(new DeletedCountry($entry));

                $count++;
            }
        }

        if ($count) {
            $builder->fire('rows_deleted', compact('count', 'builder', 'model'));
        }

        if ($selected && $count > 0) {
            $this->messages->success(trans('streams::message.delete_success', compact('count')));
        }

        if ($selected && $count === 0) {
            $this->messages->warning(trans('streams::message.delete_success', compact('count')));
        }
    }
}