<?php namespace Visiosoft\CustomfieldsModule\CustomField\Table\Filter;

use Anomaly\Streams\Platform\Ui\Table\Component\Filter\Contract\FilterInterface;
use Illuminate\Database\Eloquent\Builder;

class CategoryFilterQuery
{

    public function handle(Builder $query, FilterInterface $filter)
    {
        $query->leftJoin('customfields_parent','customfields_parent.cf_id','=','customfields_custom_fields.id')
                        ->where('customfields_parent.cat_id', $filter->getValue());
    }
}
