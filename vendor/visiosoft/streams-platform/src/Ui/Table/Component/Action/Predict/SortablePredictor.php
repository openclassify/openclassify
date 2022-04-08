<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\Action\Predict;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Class SortablePredictor
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class SortablePredictor
{

    /**
     * Predict the presence of of the sortable action.
     *
     * @param TableBuilder $builder
     */
    public function predict(TableBuilder $builder)
    {
        if ($builder->getTableOption('sortable')) {
            $builder->setActions(array_merge(['reorder'], $builder->getActions()));
        }
    }
}
