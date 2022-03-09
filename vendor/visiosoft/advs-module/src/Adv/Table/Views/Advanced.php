<?php namespace Visiosoft\AdvsModule\Adv\Table\Views;

use Anomaly\Streams\Platform\Ui\Table\Component\View\Query\AllQuery;
use Anomaly\Streams\Platform\Ui\Table\Component\View\View;
use Illuminate\Database\Eloquent\Builder;

class Advanced extends View
{

    protected $slug = 'advanced';

    protected $text = 'visiosoft.module.advs::view.advanced';

    protected $query = AllQuery::class;

    public function onQuerying(Builder $query)
    {
        $query->where('slug', "");
    }

}
