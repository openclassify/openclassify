<?php namespace Anomaly\Streams\Platform\Ui\Table\Component\View\Type;

use Anomaly\Streams\Platform\Ui\Table\Component\View\Query\RecentlyCreatedQuery;
use Anomaly\Streams\Platform\Ui\Table\Component\View\View;

/**
 * Class RecentlyCreated
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class RecentlyCreated extends View
{

    /**
     * The view query.
     *
     * @var string
     */
    protected $query = RecentlyCreatedQuery::class;
}
