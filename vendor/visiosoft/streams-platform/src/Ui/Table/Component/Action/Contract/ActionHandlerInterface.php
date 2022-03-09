<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\Action\Contract;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Interface ActionHandlerInterface
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
interface ActionHandlerInterface
{

    /**
     * Handle the action.
     *
     * @param  TableBuilder $builder
     * @param  array        $selected
     * @return mixed
     */
    public function handle(TableBuilder $builder, array $selected);
}
