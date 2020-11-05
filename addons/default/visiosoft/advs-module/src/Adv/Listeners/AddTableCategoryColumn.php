<?php namespace Visiosoft\AdvsModule\Adv\Listeners;

use Anomaly\Streams\Platform\Ui\Table\Event\TableIsQuerying;

class AddTableCategoryColumn
{
    public function handle(TableIsQuerying $event)
    {
        $query = $event->getQuery();

        $query->join('cats_category_translations as cats_trans', 'advs_advs.cat1', '=', 'cats_trans.entry_id')
            ->select('advs_advs.*', 'cats_trans.name as cat');
    }
}