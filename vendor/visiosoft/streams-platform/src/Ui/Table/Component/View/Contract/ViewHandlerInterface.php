<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\View\Contract;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * Interface ViewHandlerInterface
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
interface ViewHandlerInterface
{

    /**
     * Handle the view's table modification.
     *
     * @param TableBuilder $builder
     */
    public function handle(TableBuilder $builder);
}
