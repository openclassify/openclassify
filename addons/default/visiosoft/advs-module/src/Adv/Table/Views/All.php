<?php namespace Visiosoft\AdvsModule\Adv\Table\Views;

use Anomaly\Streams\Platform\Ui\Table\Component\View\Query\AllQuery;
use Anomaly\Streams\Platform\Ui\Table\Component\View\View;
use Illuminate\Database\Eloquent\Builder;


class All extends View
{

    /**
     * The view query.
     *
     * @var string
     */
    protected $query = AllQuery::class;

    public function onQuerying(Builder $query)
    {
        $query->where('slug', "!=", "");
    }
}
