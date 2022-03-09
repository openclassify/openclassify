<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\Action\Handler;

use Anomaly\Streams\Platform\Model\EloquentModel;
use Anomaly\Streams\Platform\Model\EloquentRepository;
use Anomaly\Streams\Platform\Ui\Table\Component\Action\ActionHandler;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;
use Illuminate\Http\Request;

/**
 * Class ReorderActionHandler
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class Reorder extends ActionHandler
{

    /**
     * Save the order of the entries.
     *
     * @param TableBuilder $builder
     * @param Request $request
     */
    public function handle(TableBuilder $builder, Request $request)
    {
        $items = $request->get($builder->getTableOption('prefix') . 'order', []);

        $repository = (new EloquentRepository())->setModel($model = $builder->getTableModel());

        /* @var EloquentModel $entry */
        $repository->withoutEvents(
            function () use ($repository, $items) {
                foreach ($items as $k => $id) {
                    
                    $repository
                        ->newQuery()
                        ->where('id', $id)
                        ->update(
                            [
                                'sort_order' => $k + 1,
                            ]
                        );
                }
            }
        );

        $model->fireEvent('updatedMany');

        $repository->flushCache();

        $count = count($items);

        $builder->fire('reordered', compact('count', 'builder', 'model'));

        $this->messages->success(trans('streams::message.reorder_success', compact('count')));
    }
}
