<?php namespace Anomaly\SearchModule\Http\Controller\Admin;

use Anomaly\SearchModule\Item\Table\ItemTableBuilder;
use Anomaly\Streams\Platform\Http\Controller\AdminController;

/**
 * Class SearchController
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class SearchController extends AdminController
{

    /**
     * Display an index of existing entries.
     *
     * @param ItemTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        return view('anomaly.module.search::test');
    }
}
