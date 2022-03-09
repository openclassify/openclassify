<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\Action\Handler;

use Anomaly\Streams\Platform\Model\Contract\EloquentRepositoryInterface;
use Anomaly\Streams\Platform\Ui\Table\Component\Action\ActionHandler;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class ForceDeleteActionHandler
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ForceDelete extends ActionHandler
{

    /**
     * ForceDelete the selected entries.
     *
     * @param TableBuilder $builder
     * @param array        $selected
     */
    public function handle(TableBuilder $builder, EloquentRepositoryInterface $repository, array $selected)
    {
        $count = 0;

        $repository->setModel($builder->getTableModel());

        /* @var EloquentModel $entry */
        foreach ($selected as $id) {
            if ($entry = $repository->findTrashed($id)) {
                if ($entry->trashed() && $repository->forceDelete($entry)) {
                    $builder->fire('row_deleted', compact('builder', 'entry'));

                    $count++;
                }
            }
        }

        if ($count) {
            $builder->fire('rows_deleted', compact('count', 'builder'));
        }

        if ($selected) {
            $this->messages->success(trans('streams::message.delete_success', compact('count')));
        }
    }
}
