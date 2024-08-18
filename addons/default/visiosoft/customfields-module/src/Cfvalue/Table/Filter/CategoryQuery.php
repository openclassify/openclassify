<?php namespace Visiosoft\CustomfieldsModule\Cfvalue\Table\Filter;

use Anomaly\Streams\Platform\Ui\Table\Component\Filter\Contract\FilterInterface;
use Illuminate\Database\Eloquent\Builder;
use Visiosoft\CustomfieldsModule\Parent\Contract\ParentRepositoryInterface;

class CategoryQuery
{
    public function handle(
        Builder $query,
        FilterInterface $filter,
        ParentRepositoryInterface $parentRepository
    )
    {
        $customFieldIDs = $parentRepository->findAllByCatID($filter->getValue())->pluck('cf_id')->all();
        $query->whereIn('custom_field_id', $customFieldIDs);
    }
}
