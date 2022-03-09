<?php namespace Visiosoft\AdvsModule\Adv\Table\Views;

use Anomaly\Streams\Platform\Ui\Table\Component\View\Query\AllQuery;
use Anomaly\Streams\Platform\Ui\Table\Component\View\View;
use Illuminate\Database\Eloquent\Builder;

class unfinished extends View
{


    protected $slug = 'table';


    protected $text = 'visiosoft.module.advs::view.unfinished';


    protected $icon = 'fa fa-tasks';


    protected $query = AllQuery::class;

    public function onQuerying(Builder $query)
    {
        $query->where('slug', "");
    }

}
