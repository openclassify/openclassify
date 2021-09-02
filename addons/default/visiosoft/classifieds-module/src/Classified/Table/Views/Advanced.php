<?php namespace Visiosoft\ClassifiedsModule\Classified\Table\Views;

use Anomaly\Streams\Platform\Ui\Table\Component\View\Query\AllQuery;
use Anomaly\Streams\Platform\Ui\Table\Component\View\View;
use Illuminate\Database\Eloquent\Builder;

class Advanced extends View
{

    protected $slug = 'classifiedanced';

    protected $text = 'visiosoft.module.classifieds::view.classifiedanced';

    protected $query = AllQuery::class;

    public function onQuerying(Builder $query)
    {
        $query->where('slug', "");
    }

}
