<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\Action\Handler;

use Anomaly\Streams\Platform\Model\EloquentModel;
use Anomaly\Streams\Platform\Ui\Table\Component\Action\ActionHandler;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class DeleteActionHandler
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class Delete extends ActionHandler
{

    /**
     * Delete the selected entries.
     *
     * @param TableBuilder $builder
     * @param array        $selected
     */
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
