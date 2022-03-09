<?php namespace Anomaly\Streams\Platform\Ui\Table\Command;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;
use Illuminate\Http\Request;
use Illuminate\Session\Store;

/**
 * Class SaveTableState
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class SaveTableState
{

    /**
     * The table builder.
     *
     * @var TableBuilder
     */
    protected $builder;

    /**
     * Create a new SetDefaultOptions instance.
     *
     * @param TableBuilder $builder
     */
    public function __construct(TableBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * @param Store   $session
     * @param Request $request
     */
    public function handle(Store $session, Request $request)
    {
        $session->put('table::' . $request->url(), $request->getQueryString());
    }
}
