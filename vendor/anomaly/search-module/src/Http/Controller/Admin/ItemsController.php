<?php namespace Anomaly\SearchModule\Http\Controller\Admin;

use Anomaly\SearchModule\Item\Table\ItemTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

/**
 * Class ItemsController
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class ItemsController extends AdminController
{

    /**
     * Display an index of existing entries.
     *
     * @param ItemTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(ItemTableBuilder $table)
    {
        return $table->render();
    }
}
