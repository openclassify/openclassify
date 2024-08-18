<?php namespace Visiosoft\CustomfieldsModule\Cfvalue\Table\Filter;

use Anomaly\Streams\Platform\Model\Cats\CatsCategoryEntryModel;
use Anomaly\Streams\Platform\Ui\Table\Component\Filter\Contract\SelectFilterInterface;

class CategoryFilterOptions
{

    public function handle(SelectFilterInterface $filter)
    {
        $cfarray = array();
        $customfields = CatsCategoryEntryModel::get();
        foreach($customfields as $cf){
            $cfarray[$cf->id] = $cf->name;
        }
        $filter->setOptions($cfarray);
    }
}
